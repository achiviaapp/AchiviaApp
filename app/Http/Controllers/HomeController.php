<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ClientDetail;
use App\Models\Project;
use App\Models\UserNote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Events\PushNotificationEvent;

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
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welCome()
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


    public function login(Request $request)
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

    public function reGenerateApiToken($user)
    {
        $api_token = md5(bcrypt($user->email));
        $user->api_token = $api_token;
        $user->save();

    }

    public function facebookForm(Request $request)
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
    public function landingStore(Request $request)
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

    public function mobData(Request $request)
    {
        $user_id = @Auth::user()->id;
        $device_id = $request->device_id;
        $user = User::where('id', $user_id);

        $updated = $user->update(['device_id' => $device_id]);

        return $user->first();
    }
}
