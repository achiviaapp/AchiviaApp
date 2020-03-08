@extends('layouts.app')

@section('title','Leave App'." - ".'Index')

@section('content')



    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"> Index </h3>
                        <!--filter-->
                        {{--<div class="row">--}}
                        {{--{{ Form::open(['method'=>'GET','route' => "filter_leave_app"]) }}--}}
                        {{----}}
                        {{--<div class="form-group">--}}
                        {{--<div class="col-md-6">--}}
                        {{--{{ Form::select('status', ['5' => 'Filter By Status', '1' => 'Approved', '0' => 'Reject' , '2'=> 'Pending'], null, array('class' => 'form-control' , 'id'=>'filter')) }}--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        {{--{{ Form::submit('Filter', ['class' => 'btn btn-default']) }}--}}

                        {{--{{ form::close() }}--}}
                        {{--</div>--}}
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                {{--<th> ID</th>--}}
                                <th> Emp Name</th>
                                <th> Start Data</th>
                                <th> End Data</th>
                                <th> Reason</th>
                                <th> created At</th>
                                <th> Status</th>
                                <th> Note</th>
                                <th> Actions</th>
                            </tr>
                            </thead>
                            <tbody id="get_data">

                            @foreach($leaves_app as $leave_app)
                                <tr class="odd gradeX">
                                    {{--<td> {{ $leave_app->id }} </td>--}}
                                    <td> {{ $leave_app->user ? $leave_app->user->name : 'Unknow'}} </td>
                                    <td> {{ $leave_app->start_date }}</td>
                                    <td> {{ $leave_app->end_date }}</td>
                                    <td>
                                        {{ $leave_app->reason}}
                                    </td>
                                    <td> {{ $leave_app->created_at}}</td>
                                    <td>
                                        @if($leave_app->status ==1)
                                            <span class="label label-success">Approved</span>
                                        @elseif($leave_app->status ==0)
                                            <span class="label label-danger">Reject</span>
                                        @else
                                            <span class="label label-info">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $leave_app->note}}
                                    </td>
                                    <td>
                                        @if($leave_app->status ==2)
                                            <a class="btn btn-primary" data-toggle="modal"
                                               href='#modal-{{ $leave_app->id }}'>Take an action</a>
                                        @else
                                            <a data-toggle="modal" href='#modal-{{ $leave_app->id }}'
                                               class="btn btn-default">No Action Available</a>
                                        @endif
                                        <div class="modal fade" id="modal-{{ $leave_app->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">&times
                                                        </button>
                                                        <h4 class="modal-title">{{$leave_app->user->name}}
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="table-responsive" id="" method="POST"
                                                              action="{{url('leave-app/status' )}}">
                                                            @csrf
                                                            <table class="table table-hover">
                                                                <tbody>
                                                                <tr>
                                                                    <td><span class="label label-primary label-raduis">
                                                                    </td>
                                                                    <td>Name</td>
                                                                    <td>  {{ $leave_app->user->name }} </td>
                                                                    <td><span class="label label-primary label-raduis">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span class="label label-info label-raduis">
                                                                    </td>
                                                                    <td>Reason</td>
                                                                    <td>{{ $leave_app->reason }}</td>
                                                                    <td><span class="label label-info label-raduis">
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td><span class="label label-danger label-raduis">
                                                                    </td>
                                                                    <td>Start Date</td>
                                                                    <td>{{ $leave_app->start_date }}</td>
                                                                    <td><span class="label label-danger label-raduis">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span class="label label-danger label-raduis">
                                                                    </td>
                                                                    <td>End Date</td>
                                                                    <td>{{ $leave_app->end_date }}</td>
                                                                    <td><span class="label label-danger label-raduis">
                                                                    </td>
                                                                </tr>
                                                                <input name="id" value="{{$leave_app->id}}" hidden >
                                                                @if ($leave_app->status == 2)
                                                                    <tr>
                                                                        <td colspan="30">
                                                                            <textarea class="form-control" name="note"
                                                                                      placeholder="Write your note here ..."></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <button type="submit" name="status"
                                                                                    value="1"
                                                                                    class="btn btn-success center-block">
                                                                                Approve
                                                                            </button>
                                                                        </td>
                                                                        <td colspan="2">
                                                                            <button type="submit" name="status"
                                                                                    value="0"
                                                                                    class="btn btn-danger center-block">
                                                                                Rejeact
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @else
                                                                    <tr>
                                                                    <tr>
                                                                        <td><span class="label label-info label-raduis">
                                                                        </td>
                                                                        <td>Note</td>
                                                                        <td>{{ $leave_app->note }}</td>
                                                                        <td><span class="label label-info label-raduis">
                                                                        </td>
                                                                    </tr>
                                                                    </tr>
                                                                    <tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="label label-default label-raduis">
                                                                        </td>
                                                                        <td>Status</td>
                                                                        <td>
                                                                            @if($leave_app->status ==1)
                                                                                <span class="label label-success">Approved</span>
                                                                            @elseif($leave_app->status ==0)
                                                                                <span class="label label-danger">Reject</span>
                                                                            @else
                                                                                <span class="label label-info">Pending</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <span class="label label-default label-raduis">
                                                                        </td>
                                                                    </tr>
                                                                    </tr>
                                                                @endif

                                                                </tbody>
                                                            </table>
                                                        </form>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                    </div>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->
    {{-- @section('script')
      <script>

        jQuery(document).ready(function(){

            $('#filter').change(function(){
                $.get("{{ url('hr/api/fetch-leave-app-status')}}",
                { option: $(this).val() },
                function(data) {
                    var get_data = $('#get_data');
                    get_data.empty();
                    $.each(data, function(index, element) {
                        get_data.append(`
                          <tr>
                            <td>`+element.id+`</td>
                            <td>`+(element.user_id == null ? 'Not Recorded' : element.user.name)+`</td>
                            <td>`+(element.user_id == null ? 'Not Recorded' : element.user.vacation_balance)+`</td>
                            <td>`+(element.type == 1 ? 'Leave Request' : 'Permission Request')+`</td>
                            <td>`+(element.leave_id == 0 ? 'Unknow' :element.leave_id == null ? 'Not Recorded' : element.leave.name)+`</td>
                            <td>`+(element.type == 0 ? element.date : '' )+`</td>
                            <td>`+(element.type ? element.start_date : element.start_time)+`</td>
                            <td>`+(element.type ? element.end_date : element.end_time)+`</td>
                             <td></td>
                            <td>`+element.created_at+`</td>
                            <td>`+(element.status == 1 ? 'Approved' : (element.status == 2 ? "Pending" : "Rejected") )+`</td>
                             <td></td>
                             <td>
                                <form method="POST" action="{{url('hr/leave-app')}}/`+element.id+`/approve">
                                    <button type="submit" class="btn btn-success"> Approve
                                    </button>                  {{ csrf_field() }}
                                </form>
                            </td>

                            <td>
                              <form method="POST" action="{{url('hr/leave-app')}}/`+element.id+`/reject">
                                    <button type="submit" class="btn btn-danger"> Reject </button>
                                                    {{ csrf_field() }}
                              </form>
                            </td>


                          </tr>
                          `);
                    });
                });
            });

        });
    </script> --}}
    {{-- <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover({
                html : true,
            });

        });
    </script>


    @endsection --}}
@stop