<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }


    /**
     * view  index of settings
     */
    public function index()
    {
        $requestData = $this->model->all()->toArray();

        return View('settings.index', compact('requestData'));
    }

    /**
     * view edit page to update settings
     */
    public function edit($id)
    {
        $requestData = $this->model->find($id);

        return View('settings.edit', compact('requestData'));
    }

    /**
     * update settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'usersNo' =>'required_if:name,limitation'
        ]);

        $model = $this->model->find($request->id);
        $model->type = $request->type;
        $model->usersNo = $request->usersNo;
        $model->save();

        return redirect('/settings')->with('success', 'Updated successfully');
    }

    public function getAllData(Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if($paginationOptions['perpage'] == -1){
            $paginationOptions['perpage'] = 0;
        }

        $data = $this->model->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);


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
