@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="portlet light bordered form-fit">

            <div class="panel-heading">

                <h3 class="panel-title">Create</h3>

            </div>

            <div class="portlet-body form">

                <form class="" id="" method="POST" action="{{url('/leave-app/store')}}">
                    @csrf
                    @if(@Auth::user()->role->name == 'admin' || @Auth::user()->role->name == 'root'|| @Auth::user()->role->name == 'Sales Team Leader')
                        <select id="" name="userId"
                                class="form-control col-lg-9 col-xl-9">
                            <option selected value="0">Select User</option>
                            @foreach($sales as $sale)
                                <option value="{{$sale['id']}}">{{$sale['name']}}</option>
                            @endforeach
                        </select>

                    @else
                        <input name="userId" type="hidden" class="form-control" value={{ Auth::user()->id }}>
                    @endif
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Start Date</label>

                        </div>
                        <div class="col-sm-10">
                            <input type="date" class='form-control' name="start_date">
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>End Date</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="date" class='form-control' name="end_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>vacation days</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="number" class='form-control' name="leave_days">
                        </div>
                    </div>


                    <div class="form-group hidden" id="reason">
                        <label class="col-sm-2"> <b> Reason </b></label>
                        <div class="col-sm-10">
                            <textarea name="reason" class='form-control'> </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-actions">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" class="btn btn-default">Submit</button>
                                <a onclick="return confirm('Confirm Cancel Operation !')" href="{{url('/leave-app')}}"
                                   type="button"
                                   class="btn btn-default"> Cancel </a>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection