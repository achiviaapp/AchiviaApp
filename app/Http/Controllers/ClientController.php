<?php

namespace App\Http\Controllers;

use App\Events\PushNotificationEvent;
use App\Events\UserSalesUpdatedEvent;
use App\Imports\ImportClients;
use App\Models\Action;
use App\Models\Campaign;
use App\Models\ClientDetail;
use App\Models\ClientHistory;
use App\Models\DeliveryDate;
use App\Models\Method;
use App\Models\Project;
use App\Models\ProjectCity;
use App\Models\Team;
use App\Models\UserNote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    private $model, $clientModel, $user, $project, $city;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $model, ClientDetail $clientModel, UserController $user, Project $project, ProjectCity $city)
    {
        $this->model = $model;
        $this->user = $user;
        $this->clientModel = $clientModel;
        $this->project = $project;
        $this->city = $city;
    }

    /**
     * view  index of users
     */
    public function index()
    {
        $requestData = $this->model->with('detail')->whereHas('detail')->get()->toArray();

        return View('clients.view', compact('requestData'));
    }

    /**
     * view create page to store user
     */
    public function create()
    {
        $projects = $this->project->all()->toArray();
        $projectsIgnore = $this->project->with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }

        $dates = DeliveryDate::all()->toArray();

        return View('clients.add', compact('projects', 'dates'));

    }

    /**
     * store user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:100',
            'phone' => 'required|numeric|regex:/[0-9]/',
            'roleId' => 'required',
            'createdBy' => 'required',
            'projectId' => 'required|integer',
            'countryCode' => 'required',
            'platform' => 'required',
        ]);

        $created = $this->user->save($request);
        $user = $created['user'];
        $userCreated = $created['user'];
        $exist = $created['exist'];
        if ($exist == 'no') {
            $saleManAssignedToClient = 0;
            if ($request->assignToSaleManId != 0) {
                $saleManAssignedToClient = 1;
            }

            $assignedDate = now()->format('Y-m-d');
            $assignedTime = now()->format('H:i:s');
            $assignToSaleManId = $request->assignToSaleManId;
            if ($request->assignToSaleManId == 0) {
                $assignToSaleManId = null;
                $assignedDate = null;
                $assignedTime = null;
            }

            $clientDetailsData = array(
                'userId' => $user->id,
                'projectId' => $request->projectId,
                'projectCity' => 0,
                'space' => $request->space,
                'jobTitle' => $request->jobTitle,
                'address' => '',
                'notes' => $request->notes,
                'gender' => 0,
                'interestsUserProjects' => $request->projectId,
                'typeClient' => 0,
                'addedClientFrom' => $request->addedClientFrom,
                'addedClientPlatform' => $request->addedClientPlatform,
                'addedClientLink' => $request->addedClientLink,
                'ZipCode' => '',
                'ip' => $request->ip,
                'region' => '',
                'country' => '',
                'city' => '',
                'assignToSaleManId' => $assignToSaleManId,
                'lastAssigned' => $saleManAssignedToClient,
                'assignedDate' => $assignedDate,
                'assignedTime' => $assignedTime,
                'platform' => $request->platform,
                'campaignId' => $request->campaignId,
                'marketerId' => $request->marketerId,
                'property' => $request->property,
                'propertyLocation' => $request->propertyLocation,
                'propertyUtility' => $request->propertyUtility,
                'areaFrom' => $request->areaFrom,
                'areaTo' => $request->areaTo,
                'budget' => $request->budget,
                'deliveryDateId' => $request->deliveryDateId,
                'convertProject1' => $request->convertProject1,
                'convertProject2' => $request->convertProject2,
            );
//
//        //insert record
            $user = $this->clientModel->create($clientDetailsData);

            if ($request->assignToSaleManId != 0) {
                $sale = User::where('id', $request->assignToSaleManId)->first();
                event(new PushNotificationEvent($sale, $userCreated));
                event(new UserSalesUpdatedEvent($userCreated));
                $state = '';
                if ($request->assignToSaleManId != 0) {
                    $state = 'Re assigned';
                }

                $history = ClientHistory::create([
                    'userId' => $user['userId'],
                    'actionId' => null,
                    'summery' => $user->summery,
                    'viaMethodId' => $user->viaMethodId,
                    'createdBy' => Auth::user()->id,
                    'state' => $state,
                    'notes' => $user['notes'],
                    'date' => $user['notificationDate'] . ' ' . $user['notificationTime'],

                ]);
            }

            if ($request->notes) {
                $note = UserNote::create(['userId' => $user['userId'], 'note' => $request->notes]);
            }

        }

        return $user;
    }

    /**
     * view create page to store user
     */
    public function quickCreate()
    {
        $projects = $this->project->all()->toArray();
        $projectsIgnore = $this->project->with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }
        return View('clients.quick_create', compact('projects'));
    }

    /**
     * store user
     */
    public function quickStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:100',
            'roleId' => 'required',
            'createdBy' => 'required',
            'phone' => 'required|numeric|regex:/[0-9]/',
            'countryCode' => 'required',
            'projectId' => 'required|integer',
            'platform' => 'required',
        ]);

        $created = $this->user->save($request);
        $user = $created['user'];
        $userCreated = $created['user'];
        $exist = $created['exist'];
        if ($exist == 'no') {

            $assignedDate = now()->format('Y-m-d');
            $assignedTime = now()->format('H:i:s');
            $assignToSaleManId = $request->assignToSaleManId;
            if ($request->assignToSaleManId == 0) {
                $assignToSaleManId = null;
                $assignedDate = null;
                $assignedTime = null;
            }

            $clientDetailsData = array(
                'userId' => $user->id,
                'jobTitle' => $request->jobTitle,
                'notes' => $request->notes,
                'typeClient' => 0,
                'projectId' => $request->projectId,
                'platform' => $request->platform,
                'campaignId' => $request->campaignId,
                'marketerId' => $request->marketerId,
                'assignToSaleManId' => $assignToSaleManId,
                'assignedDate' => $assignedDate,
                'assignedTime' => $assignedTime,

            );

//        //insert record
            $user = $this->clientModel->create($clientDetailsData);
            if ($request->assignToSaleManId != 0) {
                $sale = User::where('id', $request->assignToSaleManId)->first();
                event(new PushNotificationEvent($sale, $userCreated));
                event(new UserSalesUpdatedEvent($userCreated));
                $state = '';
                if ($request->assignToSaleManId != 0) {
                    $state = 'Re assigned';
                }
                $history = ClientHistory::create([
                    'userId' => $user['userId'],
                    'actionId' => null,
                    'summery' => $user->summery,
                    'viaMethodId' => $user->viaMethodId,
                    'createdBy' => Auth::user()->id,
                    'state' => $state,
                    'notes' => $user['notes'],
                    'date' => $user['notificationDate'] .' ' . $user['notificationTime'],

                ]);
            }

            if ($request->notes) {
                $note = UserNote::create(['userId' => $user['userId'], 'note' => $request->notes]);
            }
        }


        return $user;
    }

    /**
     * view edit page to update user
     */
    public function edit($id)
    {
        $sales = [];
        $projects = [];
        $requestData = $this->model->where('id', $id)->with('detail')->whereHas('detail')->first()->toArray();
        $methods = Method::all()->toArray();
        $actions = Action::where('active', 1)->orderBy('order')->get()->toArray();
        $projects = $this->project->all()->toArray();
        $projectsIgnore = $this->project->with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }
        if ($requestData['detail']['projectId']) {
            $cities = [];
            $project = $this->project::find($requestData['detail']['projectId']);
            $projectName = $project->name;
            $cityName = ProjectCity::where('id', $project->cityId)->first()['name'];

            $teams = $project->teams()->get()->toArray();

            foreach ($teams as $team) {

                $team = Team::find($team['id']);

                $allSales = $team->teamLeader->sales()->get(['id', 'name'])->toArray();

                if ((Auth::user()->role->name != 'sale Man')) {
                    foreach ($allSales as $sale) {
                        $sales[$sale['id']]['id'] = $sale['id'];
                        $sales[$sale['id']]['name'] = $sale['name'];
                    }
                }

                if ((Auth::user()->role->name == 'sale Man')) {
                    $sales[Auth::user()->id]['id'] = Auth::user()->id;
                    $sales[Auth::user()->id]['name'] = Auth::user()->name;
                }
            }
        } else {
            $projectName = '';
            $cityName = '';
            $projects = $this->project->all()->toArray();
            $projectsIgnore = $this->project->with('parentProject')->whereHas('parentProject')->get()->toArray();
            foreach ($projects as $key => $project) {
                foreach ($projectsIgnore as $ignore) {
                    if ($ignore['id'] == $project['id']) {
                        unset($projects[$key]);
                    }
                }
            }
            if ((Auth::user()->role->name == 'sale Man')) {
                $sales = $this->model->where('id', (Auth::user()->id)->get(['id', 'name']));
            }
            if ((Auth::user()->role->name != 'sale Man')) {
                $sales = User::where('roleId', 4)->orWhere('roleId' , 3)->get(['id', 'name']);
            }
        }
        $dates = DeliveryDate::all()->toArray();

        return View('clients.edit', compact('dates', 'requestData', 'cityName', 'projectName', 'sales', 'actions', 'methods', 'projects'));

    }

    public function updateForm(Request $request)
    {
//        $updated = $this->user->updateUser($id, $request);
        $client = $this->clientModel->where('userId', $request->_id)->first()->toArray();
        $user = User::where('id', $client['userId'])->first();

        $notificationDate = $client['newActionDate'];
        $notificationTime = $client['notificationTime'];
        if ($request->notificationDate != null) {
            $notificationDate = date("Y-m-d", strtotime($request->notificationDate));
        }
        if ($request->notificationDate == null) {
            $notificationDate = $request->notificationDate;
        }

        if ($request->notificationTime) {
            $notificationTime = $request->notificationTime;
        }

        $transferred = 0;
        if ($client['assignToSaleManId'] != $request->assignToSaleManId && $request->assignToSaleManId != 0) {
            $transferred = 1;
        }
        $newActionDate = $client['newActionDate'];
        $newActionTime = $client['newActionTime'];
        if ($client['actionId'] == null && $client['newActionDate'] == null && $client['newActionTime'] == null && $request->actionId != '0') {
            $newActionDate = now()->format('Y-m-d');
            $newActionTime = now()->format('H:i:s');
        }
        $saleManAssignedToClient = 0;
        if ($request->assignToSaleManId != 0) {
            $saleManAssignedToClient = 1;
        }
        $assignedDate = $client['assignedDate'];
        $assignedTime = $client['assignedTime'];
        if ($client['assignToSaleManId'] == 0 && $client['assignedDate'] == null && $client['assignedTime'] == null && $request->assignToSaleManId != 0) {
            $assignedDate = now()->format('Y-m-d');
            $assignedTime = now()->format('H:i:s');
        }

        $via_method = $client['viaMethodId'];
        if ($request->via_method) {
            $via_method = $request->via_method;
        }

        $actionId = $client['actionId'];
        if ($request->actionId != 0) {
            $actionId = $request->actionId;
        }

        $summery = $client['summery'];
        if ($request->summery) {
            $summery = $request->summery;
        }
        $jobTitle = $client['jobTitle'];
        if ($request->jobTitle) {

            $jobTitle = $request->jobTitle;
        }

        $projectId = $client['projectId'];
        if ($request->projectId != 0) {

            $projectId = $request->projectId;
        }

        $notes = $client['notes'];
        if ($request->notes) {
            $notes = $request->notes;
        }

        $marketerId = $client['marketerId'];
        if ($request->marketerId != 0) {
            $marketerId = $request->marketerId;
        }

        $campaignId = $client['campaignId'];
        if ($request->campaignId != 0) {
            $campaignId = $request->campaignId;
        }

        $platform = $client['platform'];
        if ($request->platform != 0) {
            $platform = $request->platform;
        }

        $priority = $client['priority'];
        if ($request->priority != '') {
            $priority = $request->priority;
        }

        $assignToSaleManId = $client['assignToSaleManId'];
        if ($request->assignToSaleManId != 0) {
            $assignToSaleManId = $request->assignToSaleManId;
        }

        $clientDetailsData = array(
            'assignToSaleManId' => $assignToSaleManId,
            'notes' => $notes,
            'viaMethodId' => $via_method,
            'actionId' => $actionId,
            'summery' => $summery,
            'newActionDate' => $newActionDate,
            'newActionTime' => $newActionTime,
            'notificationDate' => $notificationDate,
            'notificationTime' => $notificationTime,
            'transferred' => $transferred,
            'projectId' => $projectId,
            'interestsUserProjects' => $projectId,
            'typeClient' => 0,
            'jobTitle' => $jobTitle,
            'saleManAssignedToClient' => $saleManAssignedToClient,
            'assignedDate' => $assignedDate,
            'assignedTime' => $assignedTime,
            'platform' => $platform,
            'campaignId' => $campaignId,
            'marketerId' => $marketerId,
            'property' => $request->property,
            'propertyLocation' => $request->propertyLocation,
            'propertyUtility' => $request->propertyUtility,
            'areaFrom' => $request->areaFrom,
            'areaTo' => $request->areaTo,
            'budget' => $request->budget,
            'deliveryDateId' => $request->deliveryDateId,
            'convertProject1' => $request->convertProject1,
            'convertProject2' => $request->convertProject2,
            'priority' => $priority,
        );

        //update record
        $this->clientModel->where('userId', $request->_id)->update($clientDetailsData);
        if ($client['assignToSaleManId'] == 0 && $request->assignToSaleManId != 0) {
            $sale = User::where('id', $request->assignToSaleManId)->first();
            event(new PushNotificationEvent($sale, $user));
            event(new UserSalesUpdatedEvent($user));
        }
        if ($request->actionId != 0) {
            $state = 'same action';
            if ($request->actionId != $client['actionId']) {
                $state = 'change State';
            }
            $history = ClientHistory::create([
                'userId' => $request->_id,
                'actionId' => $request->actionId,
                'summery' => $request->summery,
                'viaMethodId' => $request->via_method,
                'createdBy' => Auth::user()->id,
                'state' => $state,
                'notes' => $request->notes,
                'date' => $user['notificationDate'] .' ' . $user['notificationTime'],
            ]);
        }
        if ($request->notes != '') {
            $note = UserNote::create(['userId' => $request->_id, 'note' => $request->notes]);
        }

        return redirect('client-profile/'. $request->_id )->withMessage('Updated successfully');
    }


    /**
     * update user
     */
    public function update(Request $request)
    {
        $request->validate([
            'summery' => 'required|min:1',
            'actionId' => 'required|integer',
            'notificationDate' =>  'required_if:actionId,1,2,3,4,5,6,8,11,12,13,14',
            'notificationTime' =>  'required_if:actionId,1,2,3,4,5,6,8,11,12,13,14',
            'notes' => 'required',
            'via_method' => 'required|integer',
            'priority' => 'required',
        ]);

        $client = $this->clientModel->where('userId', $request->_id)->first()->toArray();
        $user = User::where('id', $client['userId'])->first();


        if ($request->notificationDate != null) {
            $notificationDate = date("Y-m-d", strtotime($request->notificationDate));
        }else{
            $notificationDate = $request->notificationDate;
        }

        $transferred = 0;
        if ($client['assignToSaleManId'] != $request->assignToSaleManId && $request->assignToSaleManId != 0) {
            $transferred = 1;
        }
        $newActionDate = $client['newActionDate'];
        $newActionTime = $client['newActionTime'];
        if ($client['actionId'] == null && $client['newActionDate'] == null && $client['newActionTime'] == null && $request->actionId != '0') {
            $newActionDate = now()->format('Y-m-d');
            $newActionTime = now()->format('H:i:s');
        }
        $saleManAssignedToClient = 0;
        if ($request->assignToSaleManId != 0) {
            $saleManAssignedToClient = 1;
        }
        $assignedDate = $client['assignedDate'];
        $assignedTime = $client['assignedTime'];
        if ($client['assignToSaleManId'] == 0 && $client['assignedDate'] == null && $client['assignedTime'] == null && $request->assignToSaleManId != 0) {
            $assignedDate = now()->format('Y-m-d');
            $assignedTime = now()->format('H:i:s');
        }

        $via_method = $client['viaMethodId'];
        if ($request->via_method) {
            $via_method = $request->via_method;
        }

        $actionId = $client['actionId'];
        if ($request->actionId != 0) {
            $actionId = $request->actionId;
        }
        $summery = $client['summery'];
        if ($request->summery) {
            $summery = $request->summery;
        }
        $jobTitle = $client['jobTitle'];
        if ($request->jobTitle) {

            $jobTitle = $request->jobTitle;
        }

        $projectId = $client['projectId'];
        if ($request->projectId != 0) {

            $projectId = $request->projectId;
        }

        $notes = $client['notes'];
        if ($request->notes) {
            $notes = $request->notes;
        }

        $assignToSaleManId = $client['assignToSaleManId'];
        if ($request->assignToSaleManId != 0) {
            $assignToSaleManId = $request->assignToSaleManId;
        }

        $priority = $client['priority'];
        if ($request->priority != '') {
            $priority = $request->priority;
        }

        $clientDetailsData = array(
            'assignToSaleManId' => $assignToSaleManId,
            'notes' => $notes,
            'viaMethodId' => $via_method,
            'actionId' => $actionId,
            'summery' => $summery,
            'newActionDate' => $newActionDate,
            'newActionTime' => $newActionTime,
            'notificationDate' => $notificationDate,
            'notificationTime' => $request->notificationTime,
            'transferred' => $transferred,
            'projectId' => $projectId,
            'interestsUserProjects' => $projectId,
            'typeClient' => 0,
            'jobTitle' => $jobTitle,
            'saleManAssignedToClient' => $saleManAssignedToClient,
            'assignedDate' => $assignedDate,
            'assignedTime' => $assignedTime,
            'priority' => $priority,

        );

        //update record
        $this->clientModel->where('userId', $request->_id)->update($clientDetailsData);

        if ($client['assignToSaleManId'] == 0 && $request->assignToSaleManId != 0) {
            $sale = User::where('id', $request->assignToSaleManId)->first();
            event(new PushNotificationEvent($sale, $user));
            event(new UserSalesUpdatedEvent($user));
        }
        if ($request->actionId != 0) {
            $state = 'same action';
            if ($request->actionId != $client['actionId']) {
                $state = 'change State';
            }
            $history = ClientHistory::create([
                'userId' => $request->_id,
                'actionId' => $request->actionId,
                'summery' => $request->summery,
                'viaMethodId' => $request->via_method,
                'createdBy' => Auth::user()->id,
                'state' => $state,
                'notes' => $notes,
                'date' => $client['notificationDate'] .' '. $client['notificationTime'],

            ]);
        }
        if ($request->notes != '') {
            $note = UserNote::create(['userId' => $request->_id, 'note' => $request->notes]);
        }

        return redirect()->back()->withMessage('Updated successfully');
    }

    /**
     * delete user
     */
    public function destroy(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $model = $this->model->find($id);
            $model->detail()->delete();
            $model->history()->delete();
            $model->notes()->delete();
            $model->delete();
        }
        return 'ok';
    }

    /**
     * uploadView user
     */
    public
    function uploadView()
    {
        $projects = $this->project->all()->toArray();
        $projectsIgnore = $this->project->with('parentProject')->whereHas('parentProject')->get()->toArray();
        foreach ($projects as $key => $project) {
            foreach ($projectsIgnore as $ignore) {
                if ($ignore['id'] == $project['id']) {
                    unset($projects[$key]);
                }
            }
        }
        return View('clients.upload', compact('projects'));
    }

    /**
     * upload user
     */
    public
    function upload(Request $request)
    {
        $file = $request->file('file');
        if (!$file) {
            return back()->withMessage('Please Upload File');
        }

        $ext = $file->getClientOriginalExtension();

        if ($ext != 'csv') {
            return back()->withMessage('Please Upload File With CSV Extension.');
        }

        $request->validate([
            'phoneCol' => 'required',
            'emailCol' => 'required',
            'nameCol' => 'required',
            'codeCol' => 'required',
            'projectCol' => 'required|integer',
            'platformCol' => 'required',
        ]);

        $data = Excel::import(new ImportClients($request->all()), request()->file('file'));

        return redirect('/client-upload-view')->withMessage('Insert Records successfully');
    }

//    public function dropDown(Request $request)
//    {
//        $cityId = $request->option;
//
//        $city = $this->city::find($cityId);
//        $projects = $city->project();
//
//        return Response::make($projects->get(['id', 'name']));
//
//    }
    public
    function dropDownMarketer(Request $request)
    {
        $campaignId = $request->option;
        $campaign = Campaign::find($campaignId);
        $marketers = $campaign->marketers();

        return Response::make($marketers->get());

    }

    public function dropDownSale(Request $request)
    {
        $sales = [];
        $projectId = $request->option;

        $project = $this->project::find($projectId);

        $teams = $project->teams()->get()->toArray();

        foreach ($teams as $team) {
            $team = Team::find($team['id']);
            $allSales = $team->teamLeader->sales()->get()->toArray();

            if ((Auth::user()->role->name != 'sale Man')) {
                foreach ($allSales as $sale) {
                    $sales[$sale['id']]['id'] = $sale['id'];
                    $sales[$sale['id']]['name'] = $sale['name'];
                }
            }

            if ((Auth::user()->role->name == 'sale Man')) {
                $sales[Auth::user()->id]['id'] = Auth::user()->id;
                $sales[Auth::user()->id]['name'] = Auth::user()->name;
            }
        }

        $campaigns = $project->campaigns()->get()->toArray();

        return ['sales' => $sales,
            'campaigns' => $campaigns,];

    }

    public function profile($id)
    {
        $sales = $this->model->where('roleId', 4)->get(['id', 'name']);
        $clientId = $id;
        $methods = Method::all()->toArray();
        $actions = Action::where('active', 1)->orderBy('order')->get()->toArray();
        if ((Auth::user()->role->name == 'sale Man')) {
            $sales = $this->model->where('id', Auth::user()->id)->get(['id', 'name']);
        }
        return View('clients.profile', compact('sales', 'actions', 'methods' , 'clientId'));
    }

    /**
     * view  index get data
     */
    public function getProfileData($id)
    {
        $data = User::where('id', $id)->with('detail')->whereHas('detail')->first();
        $projectName = Project::where('id', $data['detail']['projectId'])->first()['name'];
        $saleName = User::where('id', $data['detail']['assignToSaleManId'])->first()['name'];
        $statusName = Action::where('id', $data['detail']['actionId'])->first()['name'];
        $data['detail']['projectName'] = $projectName;
        $data['detail']['saleName'] = $saleName;
        $data['detail']['statusName'] = $statusName;

        $meta = [
            "page" => '',
            "pages" => '',
            "perpage" => '',
            "total" => '',
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data,
        ];

        return $requestData;
    }

}
