<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ClientDetail;
use App\Models\Project;
use App\Models\UserNote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use App\Events\PushNotificationEvent;
use Carbon\Carbon;

class HomeController extends Controller
{
    private $action, $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Action $action, UserController $user)
    {
        $this->action = $action;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $projectsChartBar = [];
        $salesChartBar = [];
        $filter = $request->input('query');
        $userId = Auth::user()->id;
        $query = new user();
        $firstBar = $this->firstBar($query, $userId);
        $statusBar = $this->statusBar($query, $userId, $filter);
        if (Auth::user()->role->name != 'Visit Dubai' && Auth::user()->role->name != 'Ambassador') {
            $projectsChartBar = $this->projectsChartBar($userId, $filter);
            $salesChartBar = $this->salesChartBar($userId, $filter);
        }
        return view('home', compact('firstBar', 'statusBar', 'projectsChartBar', 'salesChartBar'));
    }

    public function firstBar($query, $userId)
    {
        $totalDuplicated = count($this->totalDuplicated($query, $userId));
        $totalTransferred = count($this->totalTransferred($query, $userId));
        $totalNew = count($this->totalNew($query, $userId));
        $totalNextToday = count($this->totalNextToday($query, $userId));
        $totalDelay = count($this->totalDelay($query, $userId));
        $firstBar = [
            'totalDuplicated' => $totalDuplicated,
            'totalTransferred' => $totalTransferred,
            'totalNew' => $totalNew,
            'totalNextToday' => $totalNextToday,
            'totalDelay' => $totalDelay,
        ];
        return $firstBar;
    }

    public function totalDuplicated($query, $userId)
    {
        $totalDuplicated = [];
        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $totalDuplicated = $query->with('detail')->whereHas('detail', function ($q) {
                $q->where('assignToSaleManId', '!=', null);
            })->where('duplicated', '>', 1)->get()->toArray();
        } elseif ((Auth::user()->role->name == 'sale Man' || Auth::user()->role->name == 'Sales Team Leader')) {
            $totalDuplicated = $query->with('detail')->whereHas('detail', function ($q) use ($userId) {
                $q->where('assignToSaleManId', $userId);
            })->where('duplicated', '>', 1)->get()->toArray();

        }

        return $totalDuplicated;

    }

    public function totalTransferred($query, $userId)
    {
        $totalTransfered = [];
        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $totalTransfered = $query->with('detail')->whereHas('detail', function ($q) {
                $q->where('assignToSaleManId', '!=', null)
                    ->where('transferred', 1);
            })->get()->toArray();
        } elseif ((Auth::user()->role->name == 'sale Man' || Auth::user()->role->name == 'Sales Team Leader')) {
            $totalTransfered = $query->with('detail')->whereHas('detail', function ($q) use ($userId) {
                $q->where('assignToSaleManId', $userId)
                    ->where('transferred', 1);
            })->get()->toArray();

        }

        return $totalTransfered;

    }

    public function totalNew($query, $userId)
    {
        $totalNew = [];
        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $totalNew = $query->with('detail')->whereHas('detail', function ($q) {
                $q->where('assignToSaleManId', '!=', null)
                    ->where('actionId', null);
            })->where('duplicated', '=', 1)->get()->toArray();
        } elseif ((Auth::user()->role->name == 'sale Man' || Auth::user()->role->name == 'Sales Team Leader')) {
            $totalNew = $query->with('detail')->whereHas('detail', function ($q) use ($userId) {
                $q->where('assignToSaleManId', $userId)
                    ->where('actionId', null);
            })->where('duplicated', '=', 1)->get()->toArray();

        }

        return $totalNew;

    }

    public function totalNextToday($query, $userId)
    {
        $totalNext = [];
        $from = date('Y-m-d H:i:s');
        $to = date('Y-m-d H:i:s');

        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $totalNext = $query->with('detail')->whereHas('detail', function ($q) use ($from, $to) {
                $q->where('assignToSaleManId', '!=', null)
                    ->whereDate('notificationDate', '>=', $from)
                    ->whereDate('notificationDate', '<=', $to)
                    ->where(function ($query) {
                        $query->orWhere('transferred', 1)
                            ->orWhereIn('actionId', [2, 3, 4, 5, 11, 12, null]);
                    });
            })->where('duplicated', '=', 1)->get()->toArray();

        } elseif ((Auth::user()->role->name == 'sale Man' || Auth::user()->role->name == 'Sales Team Leader')) {
            $totalNext = $query->with('detail')->whereHas('detail', function ($q) use ($userId, $from, $to) {
                $q->where('assignToSaleManId', $userId)
                    ->whereDate('notificationDate', '>=', $from)
                    ->whereDate('notificationDate', '<=', $to)
                    ->where(function ($query) {
                        $query->orWhere('transferred', 1)
                            ->orWhereIn('actionId', [2, 3, 4, 5, 11, 12, null]);
                    });
            })->where('duplicated', '=', 1)->get()->toArray();
        }

        return $totalNext;


    }

    public function totalDelay($query, $userId)
    {
        $totalDelay = [];
        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $totalDelay = $query->with('detail')->whereHas('detail', function ($q) {
                $q->where('assignToSaleManId', '!=', null);
            })->where('duplicated', '=', 1)->get()->toArray();
        } elseif ((Auth::user()->role->name == 'sale Man' || Auth::user()->role->name == 'Sales Team Leader')) {
            $totalDelay = $query->with('detail')->whereHas('detail', function ($q) use ($userId) {
                $q->where('assignToSaleManId', $userId);
            })->where('duplicated', '=', 1)->get()->toArray();

        }

        return $totalDelay;
    }

    public function statusBar($query, $userId, $filter)
    {
        $from = date('Y-m-d H:i:s', strtotime('1970-01-01'));
        $time = strtotime(date('Y-m-d') . ' +365 days');
        $to = date('Y-m-d H:i:s', $time);
        if ($filter['createDate']) {
            $dates = explode(' - ', $filter['createDate']);
            $from = $dates[0];
            $to = $dates[0];
            if (isset($dates[1])) {
                $to = $dates[1];
            }
        }
        $status = Action::where('active', 1)->select('id', 'name')->get()->toArray();
        $allStatus = [];
        $total = [];
        foreach ($status as $state) {
            if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
                $total = $query->with('detail')->whereHas('detail', function ($q) use ($state, $from, $to) {
                    $q->where('assignToSaleManId', '!=', null)
                        ->whereDate('notificationDate', '>=', $from)
                        ->whereDate('notificationDate', '<=', $to)
                        ->where('transferred', '=', 0)
                        ->where('actionId', $state['id']);
                })->where('duplicated', '=', 1)->get()->toArray();
            } elseif ((Auth::user()->role->name == 'sale Man' || Auth::user()->role->name == 'Sales Team Leader')) {
                $total = $query->with('detail')->whereHas('detail', function ($q) use ($userId, $state, $from, $to) {
                    $q->where('assignToSaleManId', $userId)
                        ->whereDate('notificationDate', '>=', $from)
                        ->whereDate('notificationDate', '<=', $to)
                        ->where('transferred', '=', 0)
                        ->where('actionId', $state['id']);
                })->where('duplicated', '=', 1)->get()->toArray();
            }

            $allStatus[$state['id']]['name'] = $state['name'];
            $allStatus[$state['id']]['total'] = count($total);
        }
        return $allStatus;
    }

    public function projectsChartBar($userId, $filter)
    {
        $from = date('Y-m-d');
        $to = date('Y-m-d');

        if ($filter['createDate']) {
            $dates = explode(' - ', $filter['createDate']);
            $from = $dates[0];
            $to = $dates[0];
            if (isset($dates[1])) {
                $to = $dates[1];
            }
        }

        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $query = ClientDetail::
            whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->where('platform', '!=', null)
                ->where('projectId', '!=', null)
                ->get();

        } elseif ((Auth::user()->role->name == 'sale Man' || Auth::user()->role->name == 'Sales Team Leader')) {
            $query = ClientDetail::
            whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->where('platform', '!=', null)
                ->where('projectId', '!=', null)
                ->where('assignToSaleManId', $userId)->get();
        }

        $projectsWithPlatforms = $query->groupBy(['projectId', 'platform'])->toArray();
        $data = [];
        foreach ($projectsWithPlatforms as $key => $one) {
            $projectName = Project::where('id', $key)->first()['name'];
            foreach ($one as $platform => $value) {
                $data[$projectName][$platform] = count($value);
            }
        }

        return $data;
    }

    public function salesChartBar($userId, $filter)
    {
        $from = date('Y-m-d');
        $to = date('Y-m-d');

        if ($filter['createDate']) {
            $dates = explode(' - ', $filter['createDate']);
            $from = $dates[0];
            $to = $dates[0];
            if (isset($dates[1])) {
                $to = $dates[1];
            }
        }

        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root') {
            $query = ClientDetail::
            whereDate('notificationDate', '>=', $from)
                ->whereDate('notificationDate', '<=', $to)
                ->where('actionId', '!=', null)
                ->where('assignToSaleManId', '!=', null)->get();

        } elseif ((Auth::user()->role->name == 'sale Man' || Auth::user()->role->name == 'Sales Team Leader')) {

            $query = ClientDetail::
            whereDate('notificationDate', '>=', $from)
                ->whereDate('notificationDate', '<=', $to)
                ->where('actionId', '!=', null)
                ->where('assignToSaleManId', $userId)->get();
        }

        $salesWithStatus = $query->groupBy(['assignToSaleManId', 'actionId'])->toArray();
        $data = [];
        foreach ($salesWithStatus as $key => $one) {
            $saleName = User::where('id', $key)->first()['name'];
            foreach ($one as $action => $value) {
                $statusName = Action::where('id', $action)->first()['name'];
                $data[$saleName][$statusName] = count($value);
            }
        }

        return $data;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public
    function welCome()
    {
        $projects = Project::all()->toArray();
        $projectsIgnore = Project::with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }
        return view('welcome', compact('projects'));
    }


    public
    function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !(Hash::check($request->password, $user->password))) {

            return ['message' => 'Invalid Credentials'];
        }

        if ($user && Hash::check($request->password, $user->password)) {
            //generate api token
            $this->reGenerateApiToken($user);
            return $user;
        }

    }

    public
    function reGenerateApiToken($user)
    {
        $api_token = md5(bcrypt($user->email));
        $user->api_token = $api_token;
        $user->save();

    }

    public
    function facebookForm(Request $request)
    {
        $projectName = $request->projectName;
        $projectId = Project::where('name', 'like', '%' . $projectName . '%')->get()->first()['id'];
        $phone = ltrim($request->phone, '+');
        $userExist = User::where('phone', $phone)->orWhere('email', $request->email)->first();
        $sale = ClientDetail::where('userId', $userExist['id'])->first();
        $actionId = $sale['actionId'];
        if ($userExist && $actionId != null) {
            $model = User::find($userExist['id']);
            $countDuplicated = $userExist['duplicated'];
            $model->duplicated = $countDuplicated + 1;
            $user = $model->save();
            $sale = User::where('id', $sale['assignToSaleManId'])->first();
            $client = User::where('id', $userExist['id'])->first();
            event(new PushNotificationEvent($sale, $client));
            return $model;

        } elseif ($userExist && $actionId == null) {
            $model = User::find($userExist['id']);
            return ['user' => $model, 'exist' => 'yes'];

        } else {

            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $phone,
                'roleId' => 5,
                'userStatus' => 1,
                'active' => 1,
                'createdBy' => null,
            ];

            $user = User::create($userData);
            $clientDetailsData = [
                'userId' => $user->id,
                'projectId' => $projectId,
                'property' => $request->property,
                'propertyLocation' => $request->propertyLocation,
                'propertyUtility' => $request->propertyUtility,
                'areaFrom' => $request->areaFrom,
                'areaTo' => $request->areaTo,
                'budget' => $request->budget,
                'deliveryDateId' => $request->deliveryDateId,
                'notes' => $request->notes,
                'jobTitle' => $request->jobTitle,
            ];

            $userClient = ClientDetail::create($clientDetailsData);

            return $userClient;
        }
    }


    /**
     * store user
     */
    public
    function landingStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:100',
            'phone' => 'required|numeric|regex:/[0-9]/',
            'roleId' => 'required',
            'countryCode' => 'required',
            'projectId' => 'required|integer',
        ]);

        $created = $this->user->save($request);
        $user = $created['user'];
        $userCreated = $created['user'];
        $exist = $created['exist'];
        if ($exist == 'no') {
            $clientDetailsData = array(
                'userId' => $user->id,
                'jobTitle' => $request->jobTitle,
                'projectId' => $request->projectId,
                'notes' => $request->notes,
                'typeClient' => 0,
                'addedClientFrom' => 'landingPage',
                'addedClientLink' => url('/'),
            );

            $user = ClientDetail::create($clientDetailsData);
            if ($request->notes) {
                $note = UserNote::create(['userId' => $userCreated['userId'], 'note' => $request->notes]);
            }
        }
        return $user;
    }

    public
    function mobData(Request $request)
    {
        $user_id = @Auth::user()->id;
        $device_id = $request->device_id;
        $user = User::where('id', $user_id);

        $updated = $user->update(['device_id' => $device_id]);

        return $user->first();
    }
}
