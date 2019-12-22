<?php

namespace App\Http\Controllers;

use App\Events\UserSalesUpdatedEvent;
use App\Models\Action;
use App\Models\ClientDetail;
use App\Models\Project;
use App\Models\UserNote;
use App\Models\ClientHistory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        dd($projectId);
        $phone = ltrim($request->phone, '+');
        $userExist = User::where('phone', $phone)->orWhere('email', $request->email)->first();
        if ($userExist) {
            $model = User::find($userExist['id']);
            $countDuplicated = $userExist['duplicated'];
            $model->duplicated = $countDuplicated + 1;
            $user = $model->save();
            return $model;

        } else {

            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $phone,
                'roleId' => 5,
                'userStatus' => 1,
                'active' => 1,
                'createdBy' => 0,
            ];

            $user = User::create($userData);
            $userCreated = $user;

            event(new UserSalesUpdatedEvent($userCreated));

            $clientDetailsData = [
                'userId' => $user->id,
                'projectId' => $projectId,
            ];

            //insert record
            $userClient = ClientDetail::create($clientDetailsData);

            return $user;
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

            event(new UserSalesUpdatedEvent($userCreated));

            $user = ClientDetail::create($clientDetailsData);
            $clientCreated = $user;


            if ($request->notes) {
                $note = UserNote::create(['userId' => $userCreated['userId'], 'name' => $request->notes]);
            }

            $history = ClientHistory::create([
                'userId' => $clientCreated['userId'],
                'actionId' => 0,
                'summery' => $clientCreated->summery,
                'viaMethodId' => $clientCreated->viaMethodId,
                'createdBy' => Auth::user()->id,
                'state' => 'Re assigned',
                'notes' => $clientCreated['notes'],
            ]);

        }
//
//        //insert record


        return $user;
    }
}
