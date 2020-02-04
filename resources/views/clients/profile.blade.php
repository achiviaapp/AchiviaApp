@extends('layouts.app')
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body kt-portlet__body--fit">

                <!--begin: Datatable -->
                <div class="kt-datatable" id="kt_apps_user_list_datatable">

                </div>

                <!--end: Datatable -->
            </div>
        </div>

        <!--end::Portlet-->

        <!--begin::Modal-->
        <div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Modal-->


        <!--begin::Modal-->
        <div class="modal fade" id="kt_datatable_records_fetch_modal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Selected Records</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="kt-scroll" data-scroll="true" data-height="200">
                            <ul id="kt_apps_user_fetch_records_selected"></ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-brand" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Modal-->
    </div>

    <!-- end:: Content -->
@endsection


@section('script')
    <script> HREF = "{{ url('client/get-profile-data/'.$clientId) }}"; </script>
    <script>
        function last(data) {
            var status = {

                null: {
                    'class': 'btn-label-brand',
                },

                1 : {
                    'class': 'btn-label-success',
                },
                2: {
                    'class': 'btn-label-brand',
                },
                3: {
                    'class': 'btn-label-success',
                },
                4: {
                    'class': 'btn-label-primary',
                },
                5: {
                    'class': 'btn-label-primary',
                },
                6: {
                    'class': 'btn-label-warning',
                },

                7 : {
                    'class': 'btn-label-warning',
                },
                8: {
                    'class': 'btn-label-danger',
                },
                9: {
                    'class': 'btn-label-info',
                },
                10: {
                    'class': 'btn-label-danger',
                },
                11: {
                    'class': 'btn-label-primary',
                },
                12 : {
                    'class': 'btn-label-brand',
                },
                13: {
                    'class': 'btn-label-success',
                },
                14: {
                    'class': 'btn-label-danger',
                },

            };

            var methods = {

                null: {
                    'title': 'Not Yet',
                },

                1: {
                    'title': 'Phone',
                },
                2: {
                    'title': 'WhatsApp',
                },
                3: {
                    'title': 'Email',
                },
                4: {
                    'title': 'Visit',
                },

            };


            var summery = {

                null: {
                    'title': 'Not Yet',
                },

                1: {
                    'title': 'Replied',
                },
                2: {
                    'title': 'Switched Off',
                },
                3: {
                    'title': 'No Answer',
                },
                4: {
                    'title': 'Wrong Number',
                },

            };
            return '<div class="kt-user-card-v2">\
                        			<div class="kt-user-card-v2__details">\
                        			 <p class="btn btn-bold btn-sm btn-font-sm ' + status[data.detail.actionId].class + '">' + data.detail.statusName + ' At ' + data.detail.notificationDate + ' ' + data.detail.notificationTime + '</p>\
                        			<p class="kt-user-card-v2__name"> Via ' + methods[data.detail.viaMethodId].title + '  </p>\
                        			<p class="kt-user-card-v2__name"> Summery : ' + summery[data.detail.summery].title + '  </p>\
                        			<p class="kt-user-card-v2__name"> Note : ' + data.detail.notes + '  </p>\
                        		</div>\
                        		</div>\
                        		<div>\
                        		<input type="text" hidden class="user" value="' + data.id + '"> \
                        	<button type="button" class="getHistory btn btn-bold btn-label-brand btn-lg" style="width:160px; margin-bottom:10px">Load History</button>\
                            <a  href="https://wa.me/'+ data.phone +'" target="_blank" class="whats btn btn-bold btn-label-success btn-lg" style="width:160px;">\
                             <i class="fab fa-whatsapp"></i>whatsApp</a>\
                              </div>';

        }
    </script>

    <script>
        function output(data) {
            console.log(data);
            return '<form class="kt-form" id="updateForm" method="POST" action="{{url('/client-update')}}">\n' +
                '    @csrf\n' +
                '                    <input name="_id" type="text" hidden value="' + data.detail.userId + '">\n' +
                '                    <div class="form-group row">\n' +
                '                      <div class="col-lg-4">\n' +
                '                            <select class="form-control" id="hadeer" name="actionId">\n' +
                '                                <option selected value="">Select Action</option>\n' +
                '                                @foreach($actions as $action)\n' +
                '                                    <option value="{{$action['id']}}">{{$action['name']}}</option>\n' +
                '                                @endforeach\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    <div class="col-lg-4">\n' +
                '                            <div class="input-group date hidden">\n' +
                '                                <input type="date" class="form-control"\n' +
                '                                       placeholder="Select date" id="kt_datepicker_2"\n' +
                '                                       name="notificationDate"/>\n' +
                '                                <div class="input-group-append">\n' +
                '                                    <span class="input-group-text">\n' +
                '                                        <i class="la la-calendar-check-o"></i>\n' +
                '                                    </span>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                        <div class="col-lg-4">\n' +
                '                            <div class="input-group timepicker hidden">\n' +
                '                                <input class="form-control" id="kt_timepicker_2"\n' +
                '                                       placeholder="Select time" type="time"\n' +
                '                                       name="notificationTime"/>\n' +
                '                                <div class="input-group-append">\n' +
                '                                    <span class="input-group-text">\n' +
                '                                        <i class="la la-clock-o"></i>\n' +
                '                                    </span>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '</div>\n' +
                ' <div class="form-group row">\n' +
                ' <div class="col-lg-12 col-xl-12">\n' +
                ' <input class="form-control" name="notes" type="text" value="" placeholder="Note">\n' +
                '</div>\n' +
                ' </div>\n' +
                ' <div class="form-group row">\n' +
                '<div class="col-3">\n' +
                '<select name="priority" class="form-control">\n' +
                ' <option selected value="">Select Priority \n' +
                ' </option>\n' +
                '<option value="High"> High</option>\n' +
                ' <option value="Normal"> Normal</option>\n' +
                '<option value="Low"> Low</option>\n' +
                '</select>\n' +
                '</div>\n' +
                '<div class="col-3">\n' +
                '<select class="form-control" id="" name="via_method">\n' +
                ' <option selected value="">Select Method</option>\n' +
                ' @foreach($methods as $method)\n' +
                '<option value="{{$method['id']}}">{{$method['name']}}</option>\n' +
                ' @endforeach \n' +
                '</select>\n' +
                ' </div>\n' +
                '<div class="col-lg-3">\n' +
                ' <select id="" name="summery" class="form-control">\n' +
                '<option selected value="">Select Summery</option>\n' +
                '<option value="1"> Replied </option>\n' +
                ' <option value="2"> Switched Off </option>\n' +
                '<option value="3"> No Answer </option>\n' +
                '<option value="4"> Wrong Number </option>\n' +
                ' </select>\n' +
                '</div>\n' +
                '<div class="btn-group col-lg-3">\n' +
                '<button type="submit" class="btn btn-brand" id="">\n' +
                '<span class="kt-hidden-mobile">Submit</span>\n' +
                '</button>\n' +
                '</div>\n' +
                '</div>\n' +
                '                        </div>\n' +

                '                    </div>\n' +
                '</form>\n';
        }
    </script>

    <script>
        function info(data) {
            console.log(data);
            var pos = data.roleId;
            var position = [
                'none',
                'Root',
                'Admin',
                'TeamLeader',
                'SaleMan',
                'Client',
            ];
            var stateNo = KTUtil.getRandomInt(0, 6);
            var states = [
                'success',
                'brand',
                'danger',
                'warning',
                'primary',
                'info'
            ];
            var state = states[stateNo];

            return '<div class="kt-user-card-v2">\
                <!--<div class="kt-user-card-v2__pic">\
                        <div class="kt-badge kt-badge--xl kt-badge--' + state + '">' + data.name.substring(0, 1) + '</div>\
                    </div>\-->\
                    <div class="kt-user-card-v2__details">\
                    <p class="kt-user-card-v2__name">Name : ' + data.name + '</p>\
                    <p class="kt-user-card-v2__name"> Email : ' + data.email + '  </p>\
                   <p class="kt-user-card-v2__name"> Phone : \
                              <a href="tel:' + data.phone + '">' + data.phone + '</a>  </p>\
                    <p class="kt-user-card-v2__name"> Interested Project : ' + data.detail.projectName + '  </p>\
                    <p class="kt-user-card-v2__name"> Job Title : ' + data.detail.jobTitle + '  </p>\
                    <p class="kt-user-card-v2__name"> Notes : ' + data.detail.notes + '  </p>\
                    @if(Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root')\
                    <p class="kt-user-card-v2__name"> Assign To : ' + data.detail.saleName + '  </p>\
                    @endif\
                    <p class="kt-user-card-v2__name"> Join Date: ' + data.created_at + '  </p>\
                    <p class="kt-user-card-v2__name"> Property: ' + data.detail.property + '  </p>\
                    <p class="kt-user-card-v2__name"> Property Location: ' + data.detail.propertyLocation + '  </p>\
                    <p class="kt-user-card-v2__name"> Property Utility: ' + data.detail.propertyUtility + '  </p>\
                    <p class="kt-user-card-v2__name"> Area : ' + 'From ' + data.detail.areaFrom +' To ' + data.detail.areaTo + ' </p>\
                    <p class="kt-user-card-v2__name"> Budget: ' + data.detail.budget + '  </p>\
                    <p class="kt-user-card-v2__name"> deliveryDate: ' + data.detail.deliveryDateId + '  </p>\
                </div>\
                </div>\
                     ';

        }

    </script>
    <script>
        var methods = {

            null: {
                'title': 'Not Yet',
            },

            1: {
                'title': 'Phone',
            },
            2: {
                'title': 'whatsApp',
            },
            3: {
                'title': 'Email',
            },
            4: {
                'title': 'Visit',
            },

        };

        var summery = {

            null: {
                'title': 'Not Yet',
            },

            1: {
                'title': 'Replied',
            },
            2: {
                'title': 'Switched Off',
            },
            3: {
                'title': 'No Answer',
            },
            4: {
                'title': 'Wrong Number',
            },

        };

        $(document).on('click', 'button.getHistory', function () {

            $.get(
                "{{ url('client/load-history')}}",
                {
                    option: $(this).parent().find('input.user').val()
                },
                function (data) {

                    var modalBody = $('#kt_modal_4 .modal-body .row');

                    modalBody.empty();
                    $.each(data, function (index, element) {
                        modalBody.append("<div class='col-lg-3'>" +
                            "<p>" + element.actionName + " </p>" +
                            "<p>" + element.created_at +' | ' + methods[element.viaMethodId].title + " </p>" +
                            "<p>" + summery[element.summery].title+ " </p>" +
                            "<p>" + element.createdBy + " </p>" +
                            "<p>" + element.state + " </p>" +
                            "</div>");
                    });

                    $('#kt_modal_4').modal('show');
                }
            );
        });
    </script>
    <script> URL = "{{ url('/') }}"; </script>
    <script> title = "Last Action"; </script>
    <script src="{{url('assets/js/pages/custom/user/list-datatable-profile.js')}}" type="text/javascript"></script>

@endsection



