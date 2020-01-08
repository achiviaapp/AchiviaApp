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
                0: {
                    'title': 'new',
                    'class': ' btn-label-brand'
                },

                null: {
                    'title': 'new',
                    'class': ' btn-label-brand'
                },

                1: {
                    'title': 'done',
                    'class': ' btn-label-success'
                },
                2: {
                    'title': 'following',
                    'class': ' btn-label-success'
                },
                3: {
                    'title': 'comingVisit',
                    'class': ' btn-label-info'
                },
                4: {
                    'title': 'meeting',
                    'class': ' btn-label-info'
                },
                5: {
                    'title': 'Scouting',
                    'class': ' btn-label-primary'
                },
                6: {
                    'title': 'Convert to another project',
                    'class': ' btn-label-primary'
                },

                7: {
                    'title': 'No Answer',
                    'class': ' btn-label-warning'
                },
                8: {
                    'title': 'Not Available Or Closed',
                    'class': ' btn-label-warning'
                },
                9: {
                    'title': 'Low Budget',
                    'class': ' btn-label-warning'
                },
                10: {
                    'title': 'Trash',
                    'class': ' btn-label-danger'
                },
                11: {
                    'title': 'Invitation',
                    'class': ' btn-label-info'
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
                        			<p class="btn btn-bold btn-sm btn-font-sm ' + status[data.detail.actionId].class + '">' + status[data.detail.actionId].title + ' At ' + data.detail.notificationDate + ' ' + data.detail.notificationTime + '</p>\
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
        function info(data) {
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
                    @if(Auth::user()->role->name == 'admin')\
                    <p class="kt-user-card-v2__name"> Assign To : ' + data.detail.saleName + '  </p>\
                    @endif\
                    <p class="kt-user-card-v2__name"> Join Date: ' + data.created_at + '  </p>\
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



