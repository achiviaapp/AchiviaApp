<?php

namespace App\Http\Controllers;

use App\Models\ClientDetail;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

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
        if($paginationOptions['perpage'] == -1){
            $paginationOptions['perpage'] = 0;
        }

        $data = $this->model->where('roleId','!=',5)->with('role')->whereHas('role')
            ->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);


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
        $actionId = ClientDetail::where('userId', $userExist['id'])->first()['actionId'];

//        $projectIdExist = $userExist->with('detail')->whereHas('detail')->first()['detail']['projectId'];

//        if ($userExist && $projectIdExist == $projectId ) {

        if ($userExist && $actionId != null) {
            $model = $this->model->find($userExist['id']);
            $countDuplicated = $userExist['duplicated'];
            $model->duplicated = $countDuplicated + 1;
            $user = $model->save();
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
            $userData = array(
                'name' => $request->name,
                'password' => $password,
                'image' => $image,
                'email' => $request->email,
                'roleId' => $request->roleId,
                'createdBy' => $request->createdBy,
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

        return View('users.edit', compact('requestData'));
    }

    public
    function updateUser($id, $request)
    {
        $model = $this->model->find($id);
        $model->name = $request->name;
        $model->email = $request->email;
        $model->password = $request->password;
        $model->userName = $request->userName;
        $model->phone = $request->phone;
        $model->roleId = $request->roleId;
        $model->teamId = $request->teamId;
        $model->assignToSaleManId = $request->assignToSaleManId;
        $model->mangerId = $request->mangerId;
        $model->userStatus = 1;
        $model->assign = $request->assign;
        $model->saleManPunished = $request->saleManPunished;
        $model->saleManAssignedToClient = $request->saleManAssignedToClient;
        $model->saleManSendingMsgLimit = $request->saleManSendingMsgLimit;
        $model->assignedTime = $request->assignedTime;
        $model->assignedDate = $request->assignedDate;
        $model->saleManAssignedToClient = $request->saleManAssignedToClient;
        $model->active = 1;

        $updated = $model->save();
        return $updated;
    }

    /**
     * update user
     */
    public
    function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required',
            'userName' => 'required',
            'phone' => 'required',
            'roleId' => 'required',
            'assign' => 'required',
            'saleManPunished' => 'required',
            'saleManAssignedToClient' => 'required',
            'saleManSendingMsgLimit' => 'required',
        ]);

        $updated = $this->updateUser($id, $request);

        return redirect('/users')->with('success', 'Updated successfully');
    }

    /**
     * delete user
     */
    public
    function destroy($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return redirect('/users')->with('success', 'Deleted successfully');
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

}
