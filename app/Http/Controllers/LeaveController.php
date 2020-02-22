<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\User;

use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::latest('id')->get();
        return view('leaves.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leaves.create');
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
        return redirect('leaves')->withSuccess("leave created successfully");
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


    public function rejectLeave($id)
    {
        $update = Leave::find($id)->update(['status' => '0']);
        return back()->withSuccess("Leave Application reject successfully");
    }


    public function approveLeave($id)
    {
        $leave = Leave::find($id);
        $update = $leave->update(['status' => '1']);
        $update = User::find($leave->userId)->update(['assign' => '1']);
        return back()->with('success', "Leave Application approve successfully");
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
