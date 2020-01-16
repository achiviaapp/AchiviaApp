<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ClientDetail;
use App\Models\Method;
use App\Models\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\PushNotificationEvent;

class ClientActionController extends Controller
{
    private $model, $clientModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $model, ClientDetail $clientModel)
    {
        $this->model = $model;
        $this->clientModel = $clientModel;
    }

    /**
     * view  index allClients
     */
    public function allClients()
    {
        $actionId = 'all';
        $sales = User::where('roleId', 4)->get()->toArray();
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }

        return View('client_action.all_clients', compact('actionId', 'sales', 'projects'));
    }

    public function getAllData(Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if ($paginationOptions['perpage'] == -1) {
            $paginationOptions['perpage'] = 0;
        }


        $userId = Auth::user()->id;
        $filter = $request->input('query');
        $from = date('Y-m-d H:i:s', strtotime('1970-01-01'));
        $to = date('Y-m-d H:i:s');
        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $from = $dates[0];
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');

        if ((Auth::user()->role->name == 'admin')) {
            $query->when($filter['sale'] ?? '', function ($query) use ($filter) {
                $query->where('assignToSaleManId', $filter['sale']);
            });
        } elseif ((Auth::user()->role->name == 'sale Man')) {

            $query->where('assignToSaleManId', $userId);
        }

        $query->whereDate('users.created_at', '>=', $from)
            ->whereDate('users.created_at', '<=', $to)
            ->when($filter['project'] ?? '', function ($query) use ($filter) {
                $query->where('projectId', $filter['project']);
            })
            ->when($filter['name'] ?? '', function ($query) use ($filter) {
                $query->where('name', 'like', '%' . $filter['name'] . '%')
                    ->orWhere('phone', 'like', '%' . $filter['name'] . '%');
            })
            ->select('users.*', 'client_details.*');

        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);


        $key = 0;
        foreach ($data as $one) {
            $projectName = Project::where('id', $one['projectId'])->first()['name'];
            $saleName = User::where('id', $one['assignToSaleManId'])->first()['name'];
            $data[$key]['projectName'] = $projectName;
            $data[$key]['saleName'] = $saleName;
            $key = $key + 1;
        }


        $meta = [
            "page" => $data->currentPage(),
            "pages" => intval($data->total() / $data->perPage()),
            "perpage" => $data->perPage(),
            "total" => $data->total(),
            "sort" => "asc",
            "field" => "id",
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data->items(),
        ];

        return $requestData;
    }

    /**
     * view  index newRequests
     */
    public
    function newRequests()
    {
        $actionId = 0;
        $sales = User::where('roleId', 4)->get()->toArray();

        return View('client_action.new_requests', compact('actionId', 'sales'));
    }

    /**
     * view  index newClients
     */
    public
    function getNewRequestsData(Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if ($paginationOptions['perpage'] == -1) {
            $paginationOptions['perpage'] = 0;
        }

        $filter = $request->input('query');
        $query = $this->model;

        if (isset($filter['name'])) {
            $query = $query->where('name', 'like', $filter['name']);
        }

        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $query = $query->whereDate('created_at', '>=', $dates[0]);
        }

        if (isset($dates[1])) {
            $query = $query->whereDate('created_at', '<=', $dates[1]);
        }

        if ((Auth::user()->role->name == 'admin')) {
            $data = $query->with('detail')->whereHas('detail', function ($q) {
                $q->where('actionId', null)->where('assignToSaleManId', null);
            })->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);

            $key = 0;
            foreach ($data as $one) {
                $projectName = Project::where('id', $one['detail']['projectId'])->first()['name'];
                $saleName = User::where('id', $one['detail']['assignToSaleManId'])->first()['name'];
                $data[$key]['detail']['projectName'] = $projectName;
                $data[$key]['detail']['saleName'] = $saleName;
                $key = $key + 1;
            }

            $meta = [
                "page" => $data->currentPage(),
                "pages" => intval($data->total() / $data->perPage()),
                "perpage" => $data->perPage(),
                "total" => $data->total(),
                "sort" => "asc",
                "field" => "id",
            ];

            $requestData = [
                'meta' => $meta,
                'data' => $data->items(),
            ];

            return $requestData;
        }
    }


    /**
     * view  index newClients
     */
    public
    function newClients()
    {
        $sales = $this->model->where('roleId', 4)->get(['id', 'name']);
        $actionId = 0;
        $methods = Method::all()->toArray();
        $actions = Action::all()->sortBy('order')->toArray();
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }

        if ((Auth::user()->role->name == 'sale Man')) {
            $sales = $this->model->where('id', Auth::user()->id)->get(['id', 'name']);
        }
        return View('client_action.new_clients', compact('projects', 'sales', 'actionId', 'actions', 'methods'));
    }


    /**
     * view  index actionClient
     */
    public function actionClient($id)
    {
        $sales = $this->model->where('roleId', 4)->get(['id', 'name']);
        $actionId = $id;
//        $requestData = $this->getData($actionId)['data'];
        $methods = Method::all()->toArray();
        $actions = Action::all()->sortBy('order')->toArray();
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }

        if ((Auth::user()->role->name == 'sale Man')) {
            $sales = $this->model->where('id', Auth::user()->id)->get(['id', 'name']);
        }
        return View('client_action.action_client', compact('projects', 'sales', 'actionId', 'actions', 'methods'));

    }


    /**
     * view  index get data
     */
    public function getData($id, Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if ($paginationOptions['perpage'] == -1) {
            $paginationOptions['perpage'] = 0;
        }

        if ($id == 0) {
            $id = null;
        }

        $userId = Auth::user()->id;
        $filter = $request->input('query');
        $from = date('Y-m-d H:i:s', strtotime('1970-01-01'));
        $to = date('Y-m-d H:i:s');
        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $from = $dates[0];
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');

        if ((Auth::user()->role->name == 'admin')) {
            $query->when($filter['sale'] ?? '', function ($query) use ($filter) {
                $query->where('assignToSaleManId', $filter['sale']);
            });


        } elseif ((Auth::user()->role->name == 'sale Man')) {

            $query->where('assignToSaleManId', $userId);
        }

        $query->whereDate('users.created_at', '>=', $from)
            ->whereDate('users.created_at', '<=', $to)
            ->where('duplicated', '=', 1)
            ->where('client_details.actionId', $id)
            ->where('client_details.transferred', '=', 0)
            ->where('client_details.assignToSaleManId', '!=', null)
            ->when($filter['project'] ?? '', function ($query) use ($filter) {
                $query->where('projectId', $filter['project']);
            })
            ->when($filter['name'] ?? '', function ($query) use ($filter) {
                $query->where('name', 'like', '%' . $filter['name'] . '%')
                    ->orWhere('phone', 'like', '%' . $filter['name'] . '%');
            })
            ->select('users.*', 'client_details.*');

        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);


        $key = 0;
        foreach ($data as $one) {
            $projectName = Project::where('id', $one['projectId'])->first()['name'];
            $saleName = User::where('id', $one['assignToSaleManId'])->first()['name'];
            $data[$key]['projectName'] = $projectName;
            $data[$key]['saleName'] = $saleName;
            $key = $key + 1;
        }

//        $userId = Auth::user()->id;
//        $filter = $request->input('query');
//        $query = $this->model;
//
//        if (isset($filter['name'])) {
//            $query = $query->where('name', 'like', $filter['name']);
//        }
//
//        if (isset($filter['date'])) {
//            $dates = explode(' - ', $filter['date'] ?? '');
//            $query = $query->whereDate('created_at', '>=', $dates[0]);
//        }
//
//        if (isset($dates[1])) {
//            $query = $query->whereDate('created_at', '<=', $dates[1]);
//        }
//
//        if ((Auth::user()->role->name == 'admin')) {
//            $data = $query->with('detail')->whereHas('detail', function ($q) use ($id, $filter) {
//                if (isset($filter['sale']) && $filter['sale'] != 0) {
//                    $q->where('actionId', $id)->where('assignToSaleManId', $filter['sale'])->where('transferred', '=', 0);
//                } else {
//                    $q->where('actionId', $id)->where('assignToSaleManId', '!=', null)->where('transferred', '=', 0);
//                }
//            })->where('duplicated', '=', 1)
//                ->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);
//
//        } elseif ((Auth::user()->role->name == 'sale Man')) {
//            $data = $query->with('detail')->whereHas('detail', function ($q) use ($id, $userId) {
//                $q->where('actionId', $id)->where('assignToSaleManId', $userId)->where('transferred', '=', 0);
//            })->where('duplicated', '=', 1)
//                ->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);
//        }
//
//        $key = 0;
//        foreach ($data as $one) {
//            $projectName = Project::where('id', $one['detail']['projectId'])->first()['name'];
//            $saleName = User::where('id', $one['detail']['assignToSaleManId'])->first()['name'];
//            $data[$key]['detail']['projectName'] = $projectName;
//            $data[$key]['detail']['saleName'] = $saleName;
//            $key = $key + 1;
//        }

        $meta = [
            "page" => $data->currentPage(),
            "pages" => intval($data->total() / $data->perPage()),
            "perpage" => $data->perPage(),
            "total" => $data->total(),
            "sort" => "asc",
            "field" => "id",
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data->items(),
        ];

        return $requestData;
    }


    /**
     * view  index duplicated
     */
    public
    function duplicated()
    {
        $actionId = 'duplicated';
        $methods = Method::all()->toArray();
        $actions = Action::all()->sortBy('order')->toArray();
        $sales = $this->model->where('roleId', 4)->get(['id', 'name']);
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }

        return View('client_action.duplicated', compact('projects', 'actionId', 'sales', 'actions', 'methods'));
    }

    public
    function getDuplicatedData(Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if ($paginationOptions['perpage'] == -1) {
            $paginationOptions['perpage'] = 0;
        }

        $userId = Auth::user()->id;
        $filter = $request->input('query');
        $from = date('Y-m-d H:i:s', strtotime('1970-01-01'));
        $to = date('Y-m-d H:i:s');
        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $from = $dates[0];
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');

        if ((Auth::user()->role->name == 'admin')) {
            $query->when($filter['sale'] ?? '', function ($query) use ($filter) {
                $query->where('assignToSaleManId', $filter['sale']);
            });


        } elseif ((Auth::user()->role->name == 'sale Man')) {

            $query->where('assignToSaleManId', $userId);
        }

        $query->where('duplicated', '>', 1)
            ->whereDate('users.created_at', '>=', $from)
            ->whereDate('users.created_at', '<=', $to)
            ->when($filter['project'] ?? '', function ($query) use ($filter) {
                $query->where('projectId', $filter['project']);
            })
            ->when($filter['name'] ?? '', function ($query) use ($filter) {
                $query->where('name', 'like', '%' . $filter['name'] . '%')
                    ->orWhere('phone', 'like', '%' . $filter['name'] . '%');
            })
            ->select('users.*', 'client_details.*');

        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);


        $key = 0;
        foreach ($data as $one) {
            $projectName = Project::where('id', $one['projectId'])->first()['name'];
            $saleName = User::where('id', $one['assignToSaleManId'])->first()['name'];
            $data[$key]['projectName'] = $projectName;
            $data[$key]['saleName'] = $saleName;
            $key = $key + 1;
        }

//
//        $userId = Auth::user()->id;
//        $filter = $request->input('query');
//        $query = $this->model;
//
//        if (isset($filter['name'])) {
//            $query = $query->where('name', 'like', $filter['name']);
//        }
//
//        if (isset($filter['date'])) {
//            $dates = explode(' - ', $filter['date'] ?? '');
//            $query = $query->whereDate('created_at', '>=', $dates[0]);
//        }
//
//        if (isset($dates[1])) {
//            $query = $query->whereDate('created_at', '<=', $dates[1]);
//        }
//
//
//        if ((Auth::user()->role->name == 'admin')) {
//            $data = $query->where('duplicated', '>', 1)->with('detail')->whereHas('detail', function ($q) use ($userId, $filter) {
//                if (isset($filter['sale']) && $filter['sale'] != 0) {
//                    $q->where('assignToSaleManId', $filter['sale']);
//                }
//            })->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);
//        } elseif ((Auth::user()->role->name == 'sale Man')) {
//            $data = $query->where('duplicated', '>', 1)->with('detail')->whereHas('detail', function ($q) use ($userId) {
//                $q->where('assignToSaleManId', $userId);
//            })->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);
//        }
//        $key = 0;
//        foreach ($data as $one) {
//            $projectName = Project::where('id', $one['detail']['projectId'])->first()['name'];
//            $saleName = User::where('id', $one['detail']['assignToSaleManId'])->first()['name'];
//            $data[$key]['detail']['projectName'] = $projectName;
//            $data[$key]['detail']['saleName'] = $saleName;
//            $key = $key + 1;
//        }

        $meta = [
            "page" => $data->currentPage(),
            "pages" => intval($data->total() / $data->perPage()),
            "perpage" => $data->perPage(),
            "total" => $data->total(),
            "sort" => "asc",
            "field" => "id",
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data->items(),
        ];

        return $requestData;
    }

    /**
     * view  index transfered
     */
    public
    function transfered()
    {
        $actionId = 'transfered';
        $methods = Method::all()->toArray();
        $actions = Action::all()->sortBy('order')->toArray();
        $sales = $this->model->where('roleId', 4)->get(['id', 'name']);
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }

        return View('client_action.transfered', compact('projects', 'actionId', 'sales', 'actions', 'methods'));
    }

    public function getTransferedData(Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if ($paginationOptions['perpage'] == -1) {
            $paginationOptions['perpage'] = 0;
        }

        $userId = Auth::user()->id;
        $filter = $request->input('query');
        $from = date('Y-m-d H:i:s', strtotime('1970-01-01'));
        $to = date('Y-m-d H:i:s');
        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $from = $dates[0];
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');

        if ((Auth::user()->role->name == 'admin')) {
            $query->when($filter['sale'] ?? '', function ($query) use ($filter) {
                $query->where('assignToSaleManId', $filter['sale']);
            });


        } elseif ((Auth::user()->role->name == 'sale Man')) {

            $query->where('assignToSaleManId', $userId);
        }

        $query->whereDate('users.created_at', '>=', $from)
            ->whereDate('users.created_at', '<=', $to)
            ->where('client_details.transferred', 1)
            ->when($filter['project'] ?? '', function ($query) use ($filter) {
                $query->where('projectId', $filter['project']);
            })
            ->when($filter['name'] ?? '', function ($query) use ($filter) {
                $query->where('name', 'like', '%' . $filter['name'] . '%')
                    ->orWhere('phone', 'like', '%' . $filter['name'] . '%');
            })
            ->select('users.*', 'client_details.*');

        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);


        $key = 0;
        foreach ($data as $one) {
            $projectName = Project::where('id', $one['projectId'])->first()['name'];
            $saleName = User::where('id', $one['assignToSaleManId'])->first()['name'];
            $data[$key]['projectName'] = $projectName;
            $data[$key]['saleName'] = $saleName;
            $key = $key + 1;
        }


//        $userId = Auth::user()->id;
//        $filter = $request->input('query');
//        $query = $this->model;
//
//        if (isset($filter['name'])) {
//            $query = $query->where('name', 'like', $filter['name']);
//        }
//
//        if (isset($filter['date'])) {
//            $dates = explode(' - ', $filter['date'] ?? '');
//            $query = $query->whereDate('created_at', '>=', $dates[0]);
//        }
//
//        if (isset($dates[1])) {
//            $query = $query->whereDate('created_at', '<=', $dates[1]);
//        }
//
//        if ((Auth::user()->role->name == 'admin')) {
//            $data = $query->with('detail')->whereHas('detail', function ($q) use ($filter) {
//                if (isset($filter['sale']) && $filter['sale'] != 0) {
//                    $q->where('transferred', 1)->where('assignToSaleManId', $filter['sale']);
//                } else {
//                    $q->where('transferred', 1);
//                }
//            })->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);
//        } elseif ((Auth::user()->role->name == 'sale Man')) {
//            $data = $query->with('detail')->whereHas('detail', function ($q) use ($userId) {
//                $q->where('transferred', 1)->where('assignToSaleManId', $userId);
//            })->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);
//        }
//        $key = 0;
//        foreach ($data as $one) {
//            $projectName = Project::where('id', $one['detail']['projectId'])->first()['name'];
//            $saleName = User::where('id', $one['detail']['assignToSaleManId'])->first()['name'];
//            $data[$key]['detail']['projectName'] = $projectName;
//            $data[$key]['detail']['saleName'] = $saleName;
//            $key = $key + 1;
//        }
        $meta = [
            "page" => $data->currentPage(),
            "pages" => intval($data->total() / $data->perPage()),
            "perpage" => $data->perPage(),
            "total" => $data->total(),
            "sort" => "asc",
            "field" => "id",
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data->items(),
        ];

        return $requestData;
    }


    /**
     * view  index actionClient
     */
    public function toDoClients()
    {
        $sales = $this->model->where('roleId', 4)->get(['id', 'name']);
        $actionId = 'todo';
        $methods = Method::all()->toArray();
        $actions = Action::all()->sortBy('order')->toArray();
        if ((Auth::user()->role->name == 'sale Man')) {
            $sales = $this->model->where('id', Auth::user()->id)->get(['id', 'name']);
        }
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }
        return View('client_action.todo_client', compact('projects', 'sales', 'actionId', 'actions', 'methods'));

    }


    /**
     * view  index get data
     */
    public function getToDoData(Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if ($paginationOptions['perpage'] == -1) {
            $paginationOptions['perpage'] = 0;
        }
        $userId = Auth::user()->id;

        $filter = $request->input('query');

        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $from = $dates[0];
        } else {
            $time = strtotime(date('Y-m-d') . ' -6 days');
            $from = date('Y-m-d H:i:s', $time);
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        } else {
            $to = date('Y-m-d H:i:s');
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');


        if ((Auth::user()->role->name == 'admin')) {
            $query->when($filter['sale'] ?? '', function ($query) use ($filter) {
                $query->where('assignToSaleManId', $filter['sale']);
            });
        } elseif ((Auth::user()->role->name == 'sale Man')) {

            $query->where('assignToSaleManId', $userId);
        }

        $query->where('users.duplicated', '=', 1)
            ->where('client_details.transferred', '=', 0)
            ->whereIn('client_details.actionId', [2, 3, 4, 5, 11])
            ->whereDate('client_details.notificationDate', '>=', $from)
            ->whereDate('client_details.notificationDate', '<=', $to)
            ->when($filter['project'] ?? '', function ($query) use ($filter) {
                $query->where('projectId', $filter['project']);
            })
            ->when($filter['name'] ?? '', function ($query) use ($filter) {
                $query->where('name', 'like', '%' . $filter['name'] . '%')
                    ->orWhere('phone', 'like', '%' . $filter['name'] . '%');
            })
            ->orderBy('client_details.notificationDate', 'desc')
            ->orderBy('client_details.notificationTime', 'asc')
            ->select('users.*', 'client_details.*');

        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);

        $key = 0;
        foreach ($data as $one) {
            $projectName = Project::where('id', $one['projectId'])->first()['name'];
            $saleName = User::where('id', $one['assignToSaleManId'])->first()['name'];
            $data[$key]['projectName'] = $projectName;
            $data[$key]['saleName'] = $saleName;
            $key = $key + 1;
        }

        $meta = [
            "page" => $data->currentPage(),
            "pages" => intval($data->total() / $data->perPage()),
            "perpage" => $data->perPage(),
            "total" => $data->total(),
            "sort" => "asc",
            "field" => "notificationDate",
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data->items(),
        ];

        return $requestData;
    }


    /**
     * view  index actionClient
     */
    public function toDoHotClients()
    {
        $sales = $this->model->where('roleId', 4)->get(['id', 'name']);
        $actionId = 'todo';
        $methods = Method::all()->toArray();
        $actions = Action::all()->sortBy('order')->toArray();
        if ((Auth::user()->role->name == 'sale Man')) {
            $sales = $this->model->where('id', Auth::user()->id)->get(['id', 'name']);
        }
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }
        return View('client_action.todo_hot_client', compact('projects', 'sales', 'actionId', 'actions', 'methods'));

    }


    /**
     * view  index get data
     */
    public function getToDoHotData(Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if ($paginationOptions['perpage'] == -1) {
            $paginationOptions['perpage'] = 0;
        }
        $userId = Auth::user()->id;

        $filter = $request->input('query');

        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $from = $dates[0];
        } else {
            $time = strtotime(date('Y-m-d') . ' -6 days');
            $from = date('Y-m-d H:i:s', $time);
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        } else {
            $to = date('Y-m-d H:i:s');
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');


        if ((Auth::user()->role->name == 'admin')) {
            $query->when($filter['sale'] ?? '', function ($query) use ($filter) {
                $query->where('assignToSaleManId', $filter['sale']);
            });
        } elseif ((Auth::user()->role->name == 'sale Man')) {

            $query->where('assignToSaleManId', $userId);
        }

        $query->whereDate('client_details.notificationDate', '>=', $from)
            ->whereDate('client_details.notificationDate', '<=', $to)
            ->where(function ($query) {
                $query->where('users.duplicated', '>', 1)
                    ->orWhere('client_details.transferred', 1)
                    ->orWhere('client_details.actionId', null);
            })
            ->when($filter['project'] ?? '', function ($query) use ($filter) {
                $query->where('projectId', $filter['project']);
            })
            ->when($filter['name'] ?? '', function ($query) use ($filter) {
                $query->where('name', 'like', '%' . $filter['name'] . '%')
                    ->orWhere('phone', 'like', '%' . $filter['name'] . '%');
            })
            ->orderBy('client_details.notificationDate', 'desc')
            ->orderBy('client_details.notificationTime', 'asc')
            ->select('users.*', 'client_details.*');

        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);
        $key = 0;
        foreach ($data as $one) {
            $projectName = Project::where('id', $one['projectId'])->first()['name'];
            $saleName = User::where('id', $one['assignToSaleManId'])->first()['name'];
            $data[$key]['projectName'] = $projectName;
            $data[$key]['saleName'] = $saleName;
            $key = $key + 1;
        }

        $meta = [
            "page" => $data->currentPage(),
            "pages" => intval($data->total() / $data->perPage()),
            "perpage" => $data->perPage(),
            "total" => $data->total(),
            "sort" => "asc",
            "field" => "notificationDate",
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data->items(),
        ];

        return $requestData;
    }

    /**
     * view  index history
     */
    public
    function history($id)
    {
        $userId = $id;
        return View('client_action.history_client', compact('userId'));
    }

    public
    function getHistory($id, Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if ($paginationOptions['perpage'] == -1) {
            $paginationOptions['perpage'] = 0;
        }

        $user = $this->model->where('id', $id)->with('history')->whereHas('history')
            ->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);
        $data = $user['history'];
        $key = 0;
        foreach ($data as $one) {
            $actionName = Action::where('id', $one['actionId'])->first()['name'];
            $name = $user['name'];
            $data[$key]['actionName'] = $actionName;
            $data[$key]['name'] = $name;
            $key = $key + 1;
        }


        $meta = [
            "page" => $data->currentPage(),
            "pages" => intval($data->total() / $data->perPage()),
            "perpage" => $data->perPage(),
            "total" => $data->total(),
            "sort" => "asc",
            "field" => "id",
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data->items(),
        ];


        return $requestData;
    }

    public
    function assignUser(Request $request)
    {
        $request->validate([
            'ids' => 'required',
            'sale' => 'required',
        ]);

        $clients = $request->ids;
        $saleId = $request->sale;
        foreach ($clients as $client) {
            ClientDetail::where('userId', $client)->update([
                'assignToSaleManId' => $saleId,
                'transferred' => 1,
                'assignedDate' => now()->format('Y-m-d'),
                'assignedTime' => now()->format('H:i:s'),
            ]);

            $sale = User::where('id', $saleId)->first();
            $user = User::where('id', $client)->first();
            event(new PushNotificationEvent($sale, $user));
            return 'done';
        }
    }

    public
    function loadHistory(Request $request)
    {
        $id = $request->option;

        $user = $this->model->where('id', $id)->with('history')->whereHas('history')->first()->toArray();
        $data = $user['history'];
        $key = 0;
        foreach ($data as $one) {
            $actionName = Action::where('id', $one['actionId'])->first()['name'];
            $createdBy = User::where('id', $one['createdBy'])->first()['name'];
            $name = $user['name'];
            $data[$key]['actionName'] = $actionName;
            $data[$key]['createdBy'] = $createdBy;
            $data[$key]['name'] = $name;
            $key = $key + 1;
        }
        return $data;
    }

}
