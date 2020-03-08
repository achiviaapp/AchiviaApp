<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root' || Auth::user()->role->name == 'Sales Team Leader') {
            $leaves_app = Leave::latest('id')->get();
        }
        elseif(Auth::user()->role->name == 'sale Man' ){
            $leaves_app = Leave::where('userId', $userId)->latest('id')->get();
        }
        return view('leaves.index', compact('leaves_app'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sales = User::where('roleId', 4)->orWhere('roleId', 3)->get()->toArray();
        return view('leaves.create', compact('sales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required',
            'leave_days' => 'required',
            'userId' => 'required',
        ]);

        $input = $request->all();
        $leave = Leave::create($input);
        return redirect('leave-app')->withSuccess("leave created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Leave $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leave $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Leave $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }


    public function updateLeave(Request $request)
    {
        $status = $request->status;
        Leave::find($request->id)->update(['status' => $status]);
        if ($status == 1) {
            $leave = Leave::find($request->id);
            User::find($leave->userId)->update(['assign' => '1']);
        }
        return back()->withSuccess("Leave Application reject successfully");
    }


    public function filter(Request $request)
    {
        $input = $request->option;
        $users = Leave::where('status', $input)->with('user')->get()->toArray();

        return $users;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leave $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }

}
