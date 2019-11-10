<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
        return View('users.add');
    }

    /**
     * save user
     */
    public function save($request)
    {
        $userData = array(
            'name' => $request->name,
            'email' => $request->email,
            'roleId' => $request->roleId,
            'createdBy' => $request->createdBy,
            'userName' => $request->userName,
            'phone' => $request->phone,
            'teamId' => $request->teamId,
            'mangerId' => $request->mangerId,
            'userStatus' => 0 ,
            'assign' => $request->assign,
            'password' => $request->password,
            'saleManPunished' => $request->saleManPunished,
            'saleManAssignedToClient' => $request->saleManAssignedToClien,
            'saleManSendingMsgLimit' => $request->saleManSendingMsgLimit,
            'active' => 1,
        );

        $created = $this->model->create($userData);
        return $created;
    }

    /**
     * store user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'userName' => 'required',
            'phone' => 'required',
            'roleId' => 'required',
            'createdBy' => 'required',
        ]);

        $created = $this->save($request);

        return redirect('/users')->with('success', 'Stored successfully');
    }

    /**
     * view edit page to update user
     */
    public function edit($id)
    {
        $requestData = $this->model->find($id);

        return View('users.edit', compact('requestData'));
    }

    public function updateUser($id, $request)
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
        $model->lastAssigned = $request->lastAssigned;
        $model->active = 1;

        $updated = $model->save();
        return $updated;
    }

    /**
     * update user
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required',
            'userName' => 'required',
            'phone' => 'required',
            'roleId' => 'required',
            'teamId' => 'required',
            'mangerId' => 'required',
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
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return redirect('/users')->with('success', 'Deleted successfully');
    }

}
