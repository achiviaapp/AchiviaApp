<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Campaign;
use App\Models\ClientDetail;
use App\Models\ClientHistory;
use App\Models\Method;
use App\Models\Project;
use App\Models\ProjectLink;
use App\Models\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\PushNotificationEvent;
use DateTime;
use App\Services\AutoAssignService;
use App\Events\CkeckAbssentSaleEvent;
use Carbon\Carbon;

class ClientActionController extends Controller
{
    private $model, $clientModel, $autoAssign;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $model, ClientDetail $clientModel, AutoAssignService $autoAssign)
    {
        $this->model = $model;
        $this->clientModel = $clientModel;
        $this->autoAssign = $autoAssign;
    }

    /**
     * view  index allClients
     */
    public function allClients()
    {
        $actionId = 'all';
        $sales = User::where('roleId', 4)->orWhere('roleId', 3)->where('saleManPunished', null)->get()->toArray();
        $teams = Team::all()->toArray();
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }

        return View('client_action.all_clients', compact('actionId', 'sales', 'projects', 'teams'));

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
        $time = strtotime(date('Y-m-d') . ' +365 days');
        $to = date('Y-m-d H:i:s', $time);
        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $from = $dates[0];
            $to = $dates[0];
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');

        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $query->when($filter['sale'] ?? '', function ($query) use ($filter) {
                $query->where('assignToSaleManId', $filter['sale']);
            });
        } elseif ((Auth::user()->role->name == 'sale Man' || Auth::user()->role->name == 'Sales Team Leader')) {

            $query->where('assignToSaleManId', $userId);
        }

        $query->where(function ($q) use ($from, $to) {
            $q->whereDate('client_details.notificationDate', '>=', $from)
                ->whereDate('client_details.notificationDate', '<=', $to)
                ->orWhere('client_details.notificationDate', null);
        });

        $this->filters($query, $filter)
            ->orderBy('client_details.notificationDate', 'desc')
            ->orderBy('client_details.notificationTime', 'desc')
            ->select('users.*', 'client_details.*');

//        dd($query->toSql());
        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);


        $data = $this->TransformData($data);

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

    public function AllClientWithNextAction()
    {
        $actionId = 'all';
        $sales = User::where('roleId', 4)->orWhere('roleId', 3)->where('saleManPunished', null)->get()->toArray();
        $teams = Team::all()->toArray();
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }

        $methods = Method::all()->toArray();
        $actions = Action::where('active', 1)->orderBy('order')->get()->toArray();

        return View('client_action.all_clients_actions', compact('actions', 'methods', 'actionId', 'sales', 'projects', 'teams'));

    }

    public function getAllClientWithNextActionData(Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if ($paginationOptions['perpage'] == -1) {
            $paginationOptions['perpage'] = 0;
        }

        $userId = Auth::user()->id;
        $filter = $request->input('query');
        $from = date('Y-m-d H:i:s', strtotime('1970-01-01'));
        $time = strtotime(date('Y-m-d') . ' +365 days');
        $to = date('Y-m-d H:i:s', $time);
        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $from = $dates[0];
            $to = $dates[0];
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');

        $query->where('assignToSaleManId', $userId);

        $query->where(function ($q) use ($from, $to) {
            $q->whereDate('client_details.notificationDate', '>=', $from)
                ->whereDate('client_details.notificationDate', '<=', $to)
                ->orWhere('client_details.notificationDate', null);
        });

        $this->filters($query, $filter)
            ->orderBy('client_details.notificationDate', 'desc')
            ->orderBy('client_details.notificationTime', 'desc')
            ->select('users.*', 'client_details.*');

//        dd($query->toSql());
        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);


        $data = $this->TransformData($data);

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
        $teams = Team::all()->toArray();
        $sales = User::where('roleId', 4)->orWhere('roleId', 3)->where('saleManPunished', null)->get()->toArray();

        return View('client_action.new_requests', compact('actionId', 'sales', 'teams'));
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
            $query->when($filter['name'] ?? '', function ($query) use ($filter) {
                $query->where(function ($query) use ($filter) {
                    $query->where('name', 'like', '%' . $filter['name'] . '%')
                        ->orWhere('phone', 'like', '%' . $filter['name'] . '%');
                });
            });
        }

        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $query = $query->whereDate('created_at', '>=', $dates[0]);
        }

        if (isset($dates[1])) {
            $query = $query->whereDate('created_at', '<=', $dates[1]);
        }

        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $data = $query->with('detail')->whereHas('detail', function ($q) {
                $q->where('actionId', null)->where('assignToSaleManId', null);

            })->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);

            $data = $this->TransformData($data);

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
        $sales = User::where('roleId', 4)->orWhere('roleId', 3)->where('saleManPunished', null)->get(['id', 'name']);
        $actionId = 0;
        $teams = Team::all()->toArray();
        $methods = Method::all()->toArray();
        $actions = Action::where('active', 1)->orderBy('order')->get()->toArray();
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
        return View('client_action.new_clients', compact('projects', 'sales', 'actionId', 'actions', 'methods', 'teams'));
    }


    /**
     * view  index actionClient
     */
    public function actionClient($id)
    {
        $sales = User::where('roleId', 4)->orWhere('roleId', 3)->where('saleManPunished', null)->get(['id', 'name']);
        $actionId = $id;
        $teams = Team::all()->toArray();
        $methods = Method::all()->toArray();
        $actions = Action::where('active', 1)->orderBy('order')->get()->toArray();
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
        return View('client_action.action_client', compact('projects', 'sales', 'actionId', 'actions', 'methods', 'teams'));

    }


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
        $time = strtotime(date('Y-m-d') . ' +365 days');
        $to = date('Y-m-d H:i:s', $time);
        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $from = $dates[0];
            $to = $dates[0];
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');

        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $query->when($filter['sale'] ?? '', function ($query) use ($filter) {
                $query->where('assignToSaleManId', $filter['sale']);
            });

        } elseif ((Auth::user()->role->name == 'sale Man' || Auth::user()->role->name == 'Ambassador' || Auth::user()->role->name == 'Sales Team Leader')) {

            $query->where('assignToSaleManId', $userId);
        }

        if ($id == null) {
            $query->whereDate('client_details.assignedDate', '>=', $from)
                ->whereDate('client_details.assignedDate', '<=', $to)
                ->where('client_details.transferred', '=', 0);
        } else {
            $query->whereDate('client_details.notificationDate', '>=', $from)
                ->whereDate('client_details.notificationDate', '<=', $to)
                ->where('client_details.transferred', '=', 0);
        }

        $query->where('duplicated', '=', 1)
            ->where('client_details.actionId', $id)
            ->where('client_details.assignToSaleManId', '!=', null);

        $this->filters($query, $filter)
            ->when($id == null, function ($query) {
                $query->orderBy('client_details.assignedDate', 'asc')
                    ->orderBy('client_details.assignedTime', 'asc');
            }, function ($query) {
                $query->orderBy('client_details.notificationDate', 'asc')
                    ->orderBy('client_details.notificationTime', 'asc');
            })
            ->select('users.*', 'client_details.*');

        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);

        $data = $this->TransformData($data);

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
    public function visitDubai()
    {
        $sales = User::where('roleId', 4)->orWhere('roleId', 3)->where('saleManPunished', null)->get(['id', 'name']);
        $actionId = 10;
        $teams = Team::all()->toArray();
        $methods = Method::all()->toArray();
        $actions = Action::where('active', 1)->orderBy('order')->get()->toArray();
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }

        return View('client_action.visit_dubai', compact('projects', 'sales', 'actionId', 'actions', 'methods', 'teams'));
    }

    /**
     * view  index get data
     */
    public function getVisitDubaiData(Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if ($paginationOptions['perpage'] == -1) {
            $paginationOptions['perpage'] = 0;
        }

        $id = 10;
        $userId = Auth::user()->id;
        $filter = $request->input('query');
        $from = date('Y-m-d H:i:s', strtotime('1970-01-01'));
        $time = strtotime(date('Y-m-d') . ' +365 days');
        $to = date('Y-m-d H:i:s', $time);
        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $from = $dates[0];
            $to = $dates[0];
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');

        $query->where('assignToSaleManId', $userId);
        $query->whereDate('client_details.notificationDate', '>=', $from)
            ->whereDate('client_details.notificationDate', '<=', $to)
            ->where('client_details.transferred', '=', 0);

        $query->where('duplicated', '=', 1)
            ->where('client_details.actionId', $id)
            ->where('client_details.assignToSaleManId', '!=', null);

        $this->filters($query, $filter)
            ->orderBy('client_details.notificationDate', 'asc')
            ->orderBy('client_details.notificationTime', 'asc')
            ->select('users.*', 'client_details.*');

        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);


        $data = $this->TransformData($data);

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
    public function DoneDeal()
    {
        $sales = User::where('roleId', 4)->orWhere('roleId', 3)->where('saleManPunished', null)->get(['id', 'name']);
        $actionId = 1;
        $teams = Team::all()->toArray();
        $methods = Method::all()->toArray();
        $actions = Action::where('active', 1)->orderBy('order')->get()->toArray();
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }

        return View('client_action.done_deal', compact('projects', 'sales', 'actionId', 'actions', 'methods', 'teams'));
    }

    /**
     * view  index get data
     */
    public function getDoneDealData(Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if ($paginationOptions['perpage'] == -1) {
            $paginationOptions['perpage'] = 0;
        }

        $id = 1;
        $userId = Auth::user()->id;
        $filter = $request->input('query');
        $from = date('Y-m-d H:i:s', strtotime('1970-01-01'));
        $time = strtotime(date('Y-m-d') . ' +365 days');
        $to = date('Y-m-d H:i:s', $time);
        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $from = $dates[0];
            $to = $dates[0];
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');

        $query->where('assignToSaleManId', $userId);
        $query->whereDate('client_details.notificationDate', '>=', $from)
            ->whereDate('client_details.notificationDate', '<=', $to)
            ->where('client_details.transferred', '=', 0);

        $query->where('duplicated', '=', 1)
            ->where('client_details.actionId', $id)
            ->where('client_details.assignToSaleManId', '!=', null);

        $this->filters($query, $filter)
            ->orderBy('client_details.notificationDate', 'asc')
            ->orderBy('client_details.notificationTime', 'asc')
            ->select('users.*', 'client_details.*');

        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);


        $data = $this->TransformData($data);

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
        $teams = Team::all()->toArray();
        $actions = Action::where('active', 1)->orderBy('order')->get()->toArray();
        $sales = User::where('roleId', 4)->orWhere('roleId', 3)->where('saleManPunished', null)->get(['id', 'name']);
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }

        return View('client_action.duplicated', compact('projects', 'actionId', 'sales', 'actions', 'methods', 'teams'));
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
        $time = strtotime(date('Y-m-d') . ' +365 days');
        $to = date('Y-m-d H:i:s', $time);
        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $from = $dates[0];
            $to = $dates[0];
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');

        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $query->when($filter['sale'] ?? '', function ($query) use ($filter) {
                $query->where('assignToSaleManId', $filter['sale']);
            });


        } elseif ((Auth::user()->role->name == 'sale Man')) {

            $query->where('assignToSaleManId', $userId);
        }

        $query->where('duplicated', '>', 1)
            ->whereDate('client_details.assignedDate', '>=', $from)
            ->whereDate('client_details.assignedDate', '<=', $to);
        $this->filters($query, $filter)->orderBy('client_details.assignedDate', 'asc')
            ->orderBy('client_details.assignedTime', 'asc')
            ->select('users.*', 'client_details.*');

        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);


        $data = $this->TransformData($data);

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
        $teams = Team::all()->toArray();
        $actions = Action::where('active', 1)->orderBy('order')->get()->toArray();
        $sales = User::where('roleId', 4)->orWhere('roleId', 3)->where('saleManPunished', null)->get(['id', 'name']);
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }

        return View('client_action.transfered', compact('projects', 'actionId', 'sales', 'actions', 'methods', 'teams'));
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
        $time = strtotime(date('Y-m-d') . ' +365 days');
        $to = date('Y-m-d H:i:s', $time);
        if (isset($filter['date'])) {
            $dates = explode(' - ', $filter['date'] ?? '');
            $from = $dates[0];
            $to = $dates[0];
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');

        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $query->when($filter['sale'] ?? '', function ($query) use ($filter) {
                $query->where('assignToSaleManId', $filter['sale']);
            });


        } elseif ((Auth::user()->role->name == 'sale Man')) {

            $query->where('assignToSaleManId', $userId);
        }

        $query->whereDate('client_details.assignedDate', '>=', $from)
            ->whereDate('client_details.assignedDate', '<=', $to)
            ->where('client_details.transferred', 1);
        $this->filters($query, $filter)
            ->orderBy('client_details.assignedDate', 'asc')
            ->orderBy('client_details.assignedTime', 'asc')
            ->select('users.*', 'client_details.*');

        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);


        $data = $this->TransformData($data);

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
        $sales = User::where('roleId', 4)->orWhere('roleId', 3)->where('saleManPunished', null)->get(['id', 'name']);
        $actionId = 'todo';
        $teams = Team::all()->toArray();
        $methods = Method::all()->toArray();
        $actions = Action::where('active', 1)->orderBy('order')->get()->toArray();
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
        return View('client_action.todo_client', compact('projects', 'sales', 'actionId', 'actions', 'methods', 'teams'));

    }


    /**
     * view  index get data
     */
    public function getToDoData(Request $request)
    {
        $date = new DateTime();
        $timeZone = $date->getTimezone();
        date_default_timezone_set($timeZone->getName());
//        date_default_timezone_set('Africa/Cairo');
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
            $from = date('Y-m-d H:i:s');
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        } else {

            $time = strtotime(date('Y-m-d') . ' +7 days');
            $to = date('Y-m-d H:i:s', $time);
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');

        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $query->when($filter['sale'] ?? '', function ($query) use ($filter) {
                $query->where('assignToSaleManId', $filter['sale']);
            });
        } elseif ((Auth::user()->role->name == 'sale Man')) {

            $query->where('assignToSaleManId', $userId);
        }

        $query->where('users.duplicated', '=', 1)
            ->where('client_details.transferred', '=', 0)
            ->whereIn('client_details.actionId', [2, 3, 4, 5, 11, 12])
            ->whereDate('client_details.notificationDate', '>=', $from)
            ->whereDate('client_details.notificationDate', '<=', $to);
        $this->filters($query, $filter)
            ->orderBy('client_details.notificationDate', 'asc')
            ->orderBy('client_details.notificationTime', 'asc')
            ->select('users.*', 'client_details.*');

        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);

        $data = $this->TransformData($data);

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
        $sales = User::where('roleId', 4)->orWhere('roleId', 3)->where('saleManPunished', null)->get(['id', 'name']);
        $actionId = 'todo';
        $teams = Team::all()->toArray();
        $methods = Method::all()->toArray();
        $actions = Action::where('active', 1)->orderBy('order')->get()->toArray();
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
        return View('client_action.todo_hot_client', compact('projects', 'sales', 'actionId', 'actions', 'methods', 'teams'));

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
            $from = date('Y-m-d H:i:s', strtotime('1970-01-01'));
        }

        if (isset($dates[1])) {
            $to = $dates[1];
        } else {
            $to = date('Y-m-d H:i:s');
        }

        $query = User::join('client_details', 'users.id', '=', 'client_details.userId');


        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $query->when($filter['sale'] ?? '', function ($query) use ($filter) {
                $query->where('assignToSaleManId', $filter['sale']);
            });
        } elseif ((Auth::user()->role->name == 'sale Man')) {

            $query->where('assignToSaleManId', $userId);
        }

        $query->whereDate('client_details.assignedDate', '>=', $from)
            ->whereDate('client_details.assignedDate', '<=', $to)
            ->where(function ($query) {
                $query->where('users.duplicated', '>', 1)
                    ->orWhere('client_details.transferred', 1)
                    ->orWhere('client_details.actionId', null);
            });
        $this->filters($query, $filter)
            ->orderBy('client_details.assignedDate', 'asc')
            ->orderBy('client_details.assignedTime', 'asc')
            ->select('users.*', 'client_details.*');

        $data = $query->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);
        $data = $this->TransformData($data);

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


    public function assignUser(Request $request)
    {
        $request->validate([
            'ids' => 'required',
            'sale' => 'required',
            'type' => 'required',
        ]);

        $clients = $request->ids;
        $assignId = $request->sale;
        $type = $request->type;
        $transferred = 0;
        foreach ($clients as $client) {
            if ($type == 'sale') {
                $clientDetail = ClientDetail::where('userId', $client)->first();
                $assignSaleId = $clientDetail['assignToSaleManId'];
                $actionId = $clientDetail['actionId'];
                if ($assignSaleId != null && $actionId != null) {
                    $transferred = 1;
                }

                ClientDetail::where('userId', $client)->update([
                    'assignToSaleManId' => $assignId,
                    'transferred' => $transferred,
                    'assignedDate' => now()->format('Y-m-d'),
                    'assignedTime' => now()->format('H:i:s'),
                ]);

                $sale = User::where('id', $assignId)->first();
                $user = User::where('id', $client)->first();
                event(new PushNotificationEvent($sale, $user));

            } elseif ($type == 'team') {

                $this->assignTeam($assignId, $client);
            }
        }

        return 'done';
    }


    public function assignTeam($teamId, $client)
    {
        $user = User::where('id', $client)->first();
        $sales = [];
        $team = Team::find($teamId);
        $teamleader = User::where('id', $team['teamLeaderId'])->get()->toArray();
        $sales[] = $teamleader;
        $sales[] = $team->teamLeader->sales()->get()->toArray();
        $selectedSales = call_user_func_array("array_merge", $sales);
        $mySelectedSales = $this->autoAssign->checkSales($selectedSales);

        foreach ($mySelectedSales as $sale) {
            $saleMan = User::where('id', $sale['id']);
            $sale = $saleMan->first();
            event(new CkeckAbssentSaleEvent($sale));
            if (($sale['lastAssigned'] == 0 || $sale['weight'] > $sale['lastAssigned']) && $sale['assign'] == 0) {
                $clientDetail = ClientDetail::where('userId', $client)->first();
                $assignSaleId = $clientDetail['assignToSaleManId'];
                $actionId = $clientDetail['actionId'];
                $transferred = 0;
                if ($assignSaleId != null && $actionId != null) {
                    $transferred = 1;
                }
                ClientDetail::where('userId', $client)->update([
                    'assignToSaleManId' => $sale['id'],
                    'transferred' => $transferred,
                    'assignedDate' => now()->format('Y-m-d'),
                    'assignedTime' => now()->format('H:i:s'),
                ]);

                $saleMan->update(['lastAssigned' => ($sale['lastAssigned'] + 1)]);

                event(new PushNotificationEvent($sale, $user));
                return;
            }
        }
    }

    /**
     * view  index history
     */
    public function history($id)
    {
        $userId = $id;
        return View('client_action.history_client', compact('userId'));
    }

    public function getHistory($id, Request $request)
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

    public function loadHistory(Request $request)
    {
        $id = $request->option;

        $user = $this->model->where('id', $id)->with('history')->whereHas('history')->first()->toArray();
        $data = $user['history'];
        $key = 0;
        foreach ($data as $one) {
            $actionName = Action::where('id', $one['actionId'])->first()['name'];
            $createdBy = User::where('id', $one['createdBy'])->first()['name'];
            $methodName = Method::where('id', $one['viaMethodId'])->first()['name'];
            $name = $user['name'];
            $data[$key]['actionName'] = $actionName;
            $data[$key]['createdBy'] = $createdBy;
            $data[$key]['methodName'] = $methodName;
            $data[$key]['name'] = $name;
            $key = $key + 1;
        }
        return $data;
    }

    public function filters($query, $filter)
    {
        $query->when($filter['project'] ?? '', function ($query) use ($filter) {
            $query->where('client_details.projectId', $filter['project']);
        })
            ->when($filter['done'] ?? '', function ($query) use ($filter) {
                $query->where('client_details.done', $filter['done']);
            })
            ->when($filter['name'] ?? '', function ($query) use ($filter) {
                $query->where(function ($query) use ($filter) {
                    $query->where('name', 'like', '%' . $filter['name'] . '%')
                        ->orWhere('phone', 'like', '%' . $filter['name'] . '%');
                });
            })
            ->when($filter['createDate'] ?? '', function ($query) use ($filter) {
                $query->where(function ($query) use ($filter) {
                    $dates = explode(' - ', $filter['createDate']);
                    $createdTo = $dates[0];
                    if (isset($dates[1])) {
                        $createdTo = $dates[1];
                    }
                    $query->whereDate('client_details.updated_at', '>=', $dates[0])
                        ->whereDate('client_details.updated_at', '<=', $createdTo);
                });
            })
            ->when($filter['joinDate'] ?? '', function ($query) use ($filter) {
                $query->where(function ($query) use ($filter) {
                    $dates = explode(' - ', $filter['joinDate']);
                    $joinedTo = $dates[0];
                    if (isset($dates[1])) {
                        $joinedTo = $dates[1];
                    }
                    $query->whereDate('client_details.created_at', '>=', $dates[0])
                        ->whereDate('client_details.created_at', '<=', $joinedTo);
                });
            })
            ->when($filter['deliveryDate'] ?? '', function ($query) use ($filter) {
                $query->where('client_details.deliveryDateId', $filter['deliveryDate']);
            })
            ->when($filter['priority'] ?? '', function ($query) use ($filter) {
                $query->where('client_details.priority', 'like', '%' . $filter['priority'] . '%');
            })
            ->when($filter['property'] ?? '', function ($query) use ($filter) {
                $query->where('client_details.property', 'like', '%' . $filter['property'] . '%');
            })
            ->when($filter['platform'] ?? '', function ($query) use ($filter) {
                $query->where('client_details.platform', 'like', '%' . $filter['platform'] . '%');
            })
            ->when($filter['status'] ?? '', function ($query) use ($filter) {
                $query->where('client_details.actionId', $filter['status']);
            })
            ->when($filter['convertToProject'] ?? '', function ($query) use ($filter) {
                $query->where(function ($query) use ($filter) {
                    $query->where('convertProject1', $filter['convertToProject'])
                        ->orWhere('convertProject2', $filter['convertToProject']);
                });
            })
            ->when($filter['area'] ?? '', function ($query) use ($filter) {
                $query->where(function ($query) use ($filter) {
                    $query->where('areaFrom', '>=', $filter['area'])
                        ->Where('areaTo', '<=', $filter['area']);
                });
            })
            ->when($filter['budget'] ?? '', function ($query) use ($filter) {
                $query->where('client_details.budget', '>=', $filter['budget']);
            })
            ->when($filter['customLink'] ?? '', function ($query) use ($filter) {
                $query->where('client_details.addClientLinkId', $filter['customLink']);
            })
            ->when($filter['marketer'] ?? '', function ($query) use ($filter) {
                $query->where('client_details.marketerId', $filter['marketer']);
            })
            ->when($filter['campaign'] ?? '', function ($query) use ($filter) {
                $query->where('client_details.campaignId', $filter['campaign']);
            });
        return $query;

    }

    public function TransformData($data)
    {
        $key = 0;
        foreach ($data as $one) {
            $projectName = Project::where('id', $one['projectId'])->first()['name'];
            $saleName = User::where('id', $one['assignToSaleManId'])->first()['name'];
            $statusName = Action::where('id', $one['actionId'])->first()['name'];
            $methodName = Method::where('id', $one['viaMethodId'])->first()['name'];
            $createdByName = User::where('id', $one['createdBy'])->first()['name'];
            $marketerName = User::where('id', $one['marketerId'])->first()['name'];
            $campaignName = Campaign::where('id', $one['campaignId'])->first()['name'];
            $LinkName = ProjectLink::where('id', $one['addClientLinkId'])->first()['link'];
            $clientActions = [];
            $clientActions = ClientHistory::where('userId', $one['userId'])->where('actionId', '!=', null)->get()->toArray();
            $today = Carbon::now()->format('Y-m-d H:i:s');
            $nextAction = Carbon::parse($one['notificationDate'] . $one['notificationTime'])->format('Y-m-d H:i:s');
            $delayed = false;
            if ($today > $nextAction) {
                $delayed = true;
            }
            $data[$key]['projectName'] = $projectName;
            $data[$key]['saleName'] = $saleName;
            $data[$key]['statusName'] = $statusName;
            $data[$key]['methodName'] = $methodName;
            $data[$key]['created_by'] = $createdByName;
            $data[$key]['marketer'] = $marketerName;
            $data[$key]['campaign'] = $campaignName;
            $data[$key]['custom_link'] = $LinkName;
            $data[$key]['num_of_actions'] = count($clientActions);
            $data[$key]['delayed'] = $delayed;
            $key = $key + 1;
        }

        return $data;
    }

}
