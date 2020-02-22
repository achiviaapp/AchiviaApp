<?php

namespace App\Http\Controllers;

use App\Models\ClientDetail;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Events\PushNotificationEvent;
use App\Models\Team;
use App\Models\SaleLog;

class UserController extends Controller
{
    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * view  index of users
     */
    public function index()
    {
        $requestData = $this->model->all()->toArray();

        return View('users.view', compact('requestData'));
    }

    /**
     * view create page to store user
     */
    public function create()
    {
        $roles = Role::all()->toArray();
        return View('users.add', compact('roles'));
    }

    public function getAllData(Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if ($paginationOptions['perpage'] == -1) {
            $paginationOptions['perpage'] = 0;
        }

        $data = $this->model->where('roleId', '!=', 5)->with('role')->whereHas('role')
            ->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);

        $key = 0;
        foreach ($data as $one) {
            $teamId = User::where('id', $one['id'])->first()['teamId'];
            $teamName = Team::where('teamLeaderId', $teamId)->first()['name'];
            $data[$key]['teamName'] = $teamName;
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
     * save user
     */
    public function save($request)
    {
//        $projectId = 2;
        $phone = $request->countryCode . ltrim($request->phone, '0');
        $userExist = $this->model->where('phone', $phone)->orWhere('email', $request->email)->first();
        $sale = ClientDetail::where('userId', $userExist['id'])->first();
        $actionId = $sale['actionId'];


//        $projectIdExist = $userExist->with('detail')->whereHas('detail')->first()['detail']['projectId'];

//        if ($userExist && $projectIdExist == $projectId ) {

        if ($userExist && $actionId != null) {
            $model = $this->model->find($userExist['id']);
            $countDuplicated = $userExist['duplicated'];
            $model->duplicated = $countDuplicated + 1;
            $user = $model->save();
            $sale = User::where('id', $sale['assignToSaleManId'])->first();
            $client = User::where('id', $userExist['id'])->first();
            event(new PushNotificationEvent($sale, $client));

            return ['user' => $model, 'exist' => 'yes'];

        } elseif ($userExist && $actionId == null) {
            $model = $this->model->find($userExist['id']);
            return ['user' => $model, 'exist' => 'yes'];

        } else {
            $password = null;
            if ($request->password) {
                $password = Hash::make($request->password);
            }
            $image = null;
            if ($request->image) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
            }
            $teamId = $request->teamId;
            if ($request->teamId == 0) {
                $teamId = null;
            }
            $created = null;
            if ($request->createdBy != 0) {
                $created = $request->createdBy;
            }
            $userData = array(
                'name' => $request->name,
                'password' => $password,
                'image' => $image,
                'email' => $request->email,
                'roleId' => $request->roleId,
                'createdBy' => $created,
                'userName' => '',
                'phone' => $phone,
                'teamId' => $teamId,
                'mangerId' => $request->mangerId,
                'userStatus' => 1,
                'saleManPunished' => $request->saleManPunished,
                'saleManAssignedToClient' => $request->saleManAssignedToClient,
                'saleManSendingMsgLimit' => $request->saleManSendingMsgLimit,
                'active' => 1,
            );
            $user = $this->model->create($userData);
            return ['user' => $user, 'exist' => 'no'];
        }
    }

    /**
     * store user
     */
    public
    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'phone' => 'required',
            'createdBy' => 'required',
            'roleId' => 'required|not_in:0',
            'teamId' => 'required_if:roleId,4',
        ], [
            'teamId.required_if' => 'select team leader if you select user type salesman',
        ]);

        $created = $this->save($request);

        return redirect('/users')->with('success', 'Stored successfully');
    }

    /**
     * view edit page to update user
     */
    public
    function edit($id)
    {
        $requestData = $this->model->find($id);
        $roles = Role::all()->toArray();

        return View('users.edit', compact('requestData', 'roles'));
    }

    public function updateUser($id, $request)
    {
        $model = $this->model->find($id);
        $password = $model['password'];
        if ($request->password) {
            $password = Hash::make($request->password);
        }
        $teamId = $model['teamId'];
        if ($request->teamId) {
            $teamId = $request->teamId;
        }

        $model->name = $request->name;
        $model->email = $request->email;
        $model->password = $password;
        $model->phone = $request->phone;
        $model->roleId = $request->roleId;
        $model->teamId = $teamId;
        $model->userStatus = 1;
        $model->active = 1;
        $updated = $model->save();
        return $updated;
    }

    /**
     * update user
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->id,
            'phone' => 'required',
            'createdBy' => 'required',
            'roleId' => 'required|not_in:0',
        ]);

        $updated = $this->updateUser($request->id, $request);

        return redirect('/users')->withMessage('Updated successfully');
    }

    /**
     * delete user
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return redirect('/users')->withMessage('Deleted successfully');
    }


    public
    function dropDownTeams(Request $request)
    {
        $roleId = $request->option;

        if ($roleId == 4) {
            $teams = User::where('roleId', 3)->get()->toArray();

            return Response::make($teams);
        }

    }

    public function salesActive()
    {
        $salesActive = SaleLog::where('last_login_at', '!=', null)->where('last_logout_at', null)->get()->toArray();
        foreach ($salesActive as $key => $one){
            $salesActive[$key]['name'] = User::where('id', $one['userId'])->first()['name'];
        }

        return $salesActive;
    }

}
