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

    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Users
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <div class="kt-subheader__group" id="kt_subheader_search">
										<span class="kt-subheader__desc" id="kt_subheader_total">
											450 Total </span>
                    <form class="kt-margin-l-20" id="kt_subheader_search_form">
                        <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
                            <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                            <span class="kt-input-icon__icon kt-input-icon__icon--right">
													<span>
														<svg xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                             height="24px" viewBox="0 0 24 24" version="1.1"
                                                             class="kt-svg-icon">
															<g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24"/>
																<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                                      fill="#000000" fill-rule="nonzero" opacity="0.3"/>
																<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                                      fill="#000000" fill-rule="nonzero"/>
															</g>
														</svg>

                                                        <!--<i class="flaticon2-search-1"></i>-->
													</span>
												</span>
                        </div>
                        @if(Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root')
                            <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
                                <select class="form-control" id="saleFilter">
                                    <option value="0">Select SaleMan</option>
                                    @foreach($sales as $sale)
                                        <option value=" {{$sale['id']}}">  {{$sale['name']}} </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
                            <select class="form-control" id="projectFilter">
                                <option value="0">Select Project</option>
                                @foreach($projects as $project)
                                    <option value=" {{$project['id']}}">  {{$project['name']}} </option>
                                @endforeach
                            </select>
                        </div>
                        {{--<div class="kt-input-icon kt-input-icon--right kt-subheader__search">--}}
                        {{--<input type="date" class="form-control" placeholder="Search..." id="fromDateFilter">--}}
                        {{--</div>--}}
                        {{--<div class="kt-input-icon kt-input-icon--right kt-subheader__search">--}}
                        {{--<input type="date" class="form-control" placeholder="Search..." id="toDateFilter">--}}
                        {{--</div>--}}
                    </form>
                </div>
                @if(Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root')
                <div class="kt-subheader__group" id="kt_subheader_group_actions">
                    <div class="kt-subheader__desc"><span id="kt_subheader_group_selected_rows"></span> Selected:</div>
                    <div class="btn-toolbar kt-margin-l-20">
                        <div class="dropdown" id="kt_subheader_group_actions_status_change">
                            <button type="button" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle"
                                    data-toggle="dropdown">
                                Select Assign To
                            </button>
                            <div class="dropdown-menu">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text"> Select SalesMan:</span>
                                    </li>
                                    @foreach($sales as $sale)
                                        <li class="kt-nav__item">
                                            <a class="kt-nav__link" data-toggle="status-change" data-type="sale"
                                               data-status="{{$sale['id']}}">
                                                <span class="kt-nav__link-text">
                                                    <span class="sale kt-badge kt-badge--unified-success kt-badge--inline kt-badge--bold">
                                                        {{$sale['name']}}
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text"> Select Team:</span>
                                    </li>
                                    @foreach($teams as $team)
                                        <li class="kt-nav__item">
                                            <a class="kt-nav__link" data-toggle="status-change"
                                               data-status="{{$team['id']}}" data-type="team">
                                                <span class="kt-nav__link-text">
                                                    <span class="sale kt-badge kt-badge--unified-success kt-badge--inline kt-badge--bold">
                                                        {{$team['name']}}
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button class="btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_subheader_group_actions_delete_all">
                            Delete
                        </button>
                    </div>
                </div>
                    @endif
            </div>
            <div class="kt-kt-subheader__main">
                <div class="kt-subheader__toolbar" style="padding: 15px">
                    <div class="kt-subheader__wrapper">
                        <a class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker"
                           data-toggle="kt-tooltip" title="Select dashboard daterange" data-placement="left">
                            <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Select Date Range</span>&nbsp;
                            <span class="kt-subheader__btn-daterange-date"
                                  id="kt_dashboard_daterangepicker_date"></span>
                            <i class="flaticon2-calendar-1"></i>
                        </a>
                        @if(Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root')
                            <a class="btn kt-subheader__btn-primary btn-icon">
                                <i class="flaticon-download-1"></i>
                            </a>
                            <a class="btn kt-subheader__btn-primary btn-icon">
                                <i class="flaticon2-fax"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- end:: Content Head -->
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body kt-portlet__body--fit">

                <!--begin: Datatable -->
                <div class="kt-datatable" id="kt_apps_user_list_datatable"></div>

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
    <script>
        function takeAction(data) {
            return '<div class="kt-widget kt-widget--project-1">\
                <div class="kt-widget__head p-0">\
                    <div class="kt-widget__label">\
                        <div class=" kt-widget__info p-0">\
							<p class="kt-widget__title mb-0 text-info">\
								Last Action\
							</p>\
						</div>\
                    </div>\
                    <div class="kt-widget__section">\
                        <div class="kt-widget__stats">\
								<div class="mx-1 kt-widget__item float-left">\
									<span class="kt-widget__date">\
                                        ' + data.statusName + '\
									</span>\
								    <div class="kt-widget__label">\
										<span class="w-100 btn btn-label-danger btn-sm btn-bold btn-upper">' + data.notificationDate + ' ' + data.notificationTime + '</span>\
									</div>\
                                </div>\
                                <div class="mx-1 kt-widget__item float-left">\
									<span class="kt-widget__date">\
										Method\
									</span>\
								    <div class="kt-widget__label">\
										<span class="w-100 btn btn-label-brand btn-sm btn-bold btn-upper">Via ' + data.methodName + '</span>\
									</div>\
                                </div>\
                                <div class="mx-1 kt-widget__item float-left">\
									<span class="kt-widget__date">\
										Summary\
									</span>\
								    <div class="kt-widget__label">\
										<span class="w-100 btn btn-label-warning btn-sm btn-bold btn-upper">' + summery[data.summery].title + '</span>\
									</div>\
								</div>\
                                <div class="mx-1 kt-widget__item float-left">\
									<span class="kt-widget__date">\
										# of Actions\
									</span>\
								    <div class="kt-widget__label">\
										<span class="w-100 btn btn-label-success btn-sm btn-bold btn-upper">' + data.num_of_actions + '</span>\
									</div>\
								</div>\
							</div>\
                    </div>\
                </div>\
                <div class="kt-widget__body p-0">\
							<span class="kt-widget__text mt-2">\
								<div class="kt-portlet kt-portlet--height-fluid" style="box-shadow: unset!important;margin: 20px 0 5px 0;">\
                                                        <div class="kt-notes">\
                                                            <div class="kt-notes__items">\
                                                                <div class="kt-notes__item pb-2 pr-4 float-left">\
                                                                    <div class="kt-notes__media">\
                                                                        <span class="kt-notes__icon kt-notes__icon--danger">\
                                                                            <i class="fas fa-sticky-note kt-font-info"></i>\
                                                                        </span>\
                                                                    </div>\
                                                                    <div class="kt-notes__content">\
                                                                        <div class="kt-notes__section">\
                                                                            <div class="kt-notes__info">\
                                                                                <p class="kt-notes__title">\
                                                                                    Notes\
                                                                                </p><br>\
                                                                                <span class="kt-notes__desc">\
                                                                                    '+data.notes+'\
                                                                                </span>\
                                                                            </div>\
                                                                        </div>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
							</span>\
                        </div>\
                    </div>'+
                '<div class="kt-portlet kt-iconbox kt-iconbox--success kt-iconbox--animate-slow mt-3">\
                                    <div class="kt-portlet__body">\
                                        <div class="kt-iconbox__body">\
                                            <div class="kt-iconbox__desc">\
                                                <h3 class="kt-iconbox__title text-success">\
                                                    Next Action\
                                                </h3>\
                                                <div class="kt-iconbox__content">'+
                '<form class="kt-form" id="updateForm" method="POST" action="{{url('/client-update')}}">\n' +
                '    @csrf\n' +
                '                    <input name="_id" type="text" hidden value="' + data.userId + '">\n' +
                '                    <div class="form-group row">\n' +
                '                      <div class="col-lg-4">\n' +
                '                            <select class="form-control actionId"  name="actionId">\n' +
                '                                <option selected value="">Action</option>\n' +
                '                                @foreach($actions as $action)\n' +
                '                                    <option value="{{$action['id']}}">{{$action['name']}}</option>\n' +
                '                                @endforeach\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    <div class="col-lg-4">\n' +
                '                            <div class="input-group date hidden hide-select">\n' +
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
                '                            <div class="input-group timepicker hidden hide-select">\n' +
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
                ' <textarea class="form-control" name="notes" type="text" value="" placeholder="Notes" rows="2"></textarea>\n' +
                '</div>\n' +
                ' </div>\n' +
                ' <div class="form-group row">\n' +
                '<div class="col-3 hide-select">\n' +
                '<select name="priority" class="form-control">\n' +
                ' <option selected value="">Priority \n' +
                ' </option>\n' +
                '<option value="High"> High</option>\n' +
                ' <option value="Normal"> Normal</option>\n' +
                '<option value="Low"> Low</option>\n' +
                '</select>\n' +
                '</div>\n' +
                '<div class="col-3 hide-select">\n' +
                '<select class="form-control" id="" name="via_method">\n' +
                ' <option selected value="">Method</option>\n' +
                ' @foreach($methods as $method)\n' +
                '<option value="{{$method['id']}}">{{$method['name']}}</option>\n' +
                ' @endforeach \n' +
                '</select>\n' +
                ' </div>\n' +
                '<div class="col-lg-3 hide-select">\n' +
                ' <select id="" name="summery" class="form-control">\n' +
                '<option selected value="">Summery</option>\n' +
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
                '</form>\n'

                +'</div>\
												</div>\
											</div>\
										</div>\
									</div>\
                            ';
        }
        function clientsQuestions(data){
            if(data.statusName === 'No Answer' || data.statusName === 'Low Budget' || data.statusName === 'Not Interested' || data.statusName === 'Trash'){
                $('.hide-select').css({"opacity": 0});
            }

            var returend_data = '';
            //open kt-portlet and kt-notes and kt-notes__items
            returend_data = '<div class="kt-portlet kt-portlet--height-fluid">\
                                <div class="kt-notes">\
                                    <div class="kt-notes__items">';
            if(data.property !== null){
                returend_data = returend_data + '<div class="kt-notes__item pb-2 pr-4 float-left">\
														<div class="kt-notes__media">\
															<span class="kt-notes__icon kt-notes__icon--danger">\
																<i class="fa fa-building kt-font-info"></i>\
															</span>\
														</div>\
														<div class="kt-notes__content">\
															<div class="kt-notes__section">\
																<div class="kt-notes__info">\
																	<p class="kt-notes__title">\
																		Property\
																	</p><br>\
																	<span class="kt-notes__desc">\
																		'+data.property+'\
																	</span>\
																</div>\
															</div>\
                                                        </div>\
                                                    </div>';
            }
            if(data.propertyLocation !== null){
                returend_data = returend_data + '<div class="kt-notes__item pb-2 pr-4 float-left">\
														<div class="kt-notes__media">\
															<span class="kt-notes__icon kt-notes__icon--danger">\
																<i class="flaticon2-location kt-font-info"></i>\
															</span>\
														</div>\
														<div class="kt-notes__content">\
															<div class="kt-notes__section">\
																<div class="kt-notes__info">\
																	<p class="kt-notes__title">\
																		Property Location\
																	</p>\
																	<span class="kt-notes__desc">\
																		'+data.propertyLocation+'\
																	</span>\
																</div>\
															</div>\
														</div>\
                                                    </div>';
            }
            if(data.propertyUtility !== null){
                returend_data = returend_data + '<div class="kt-notes__item pb-2 pr-4 float-left">\
														<div class="kt-notes__media">\
															<span class="kt-notes__icon kt-notes__icon--danger">\
																<i class="flaticon2-information kt-font-info"></i>\
															</span>\
														</div>\
														<div class="kt-notes__content">\
															<div class="kt-notes__section">\
																<div class="kt-notes__info">\
																	<p class="kt-notes__title">\
																		Property Utility\
																	</p>\
																	<span class="kt-notes__desc">\
																		'+data.propertyUtility+'\
																	</span>\
																</div>\
															</div>\
														</div>\
                                                    </div>';
            }
            if(data.areaFrom !== null && data.areaTo !== null){
                returend_data = returend_data + '<div class="kt-notes__item pb-2 pr-4 float-left">\
														<div class="kt-notes__media">\
															<span class="kt-notes__icon kt-notes__icon--danger">\
																<i class="flaticon-squares kt-font-info"></i>\
															</span>\
														</div>\
														<div class="kt-notes__content">\
															<div class="kt-notes__section">\
																<div class="kt-notes__info">\
																	<p class="kt-notes__title">\
																		Area\
																	</p>\
																	<span class="kt-notes__desc">From \
																		'+data.areaFrom+' : To '+ data.areaTo+'\
																	</span>\
																</div>\
															</div>\
														</div>\
                                                    </div>';
            }
            if(data.budget !== null){
                returend_data = returend_data + '<div class="kt-notes__item pb-2 pr-4 float-left">\
														<div class="kt-notes__media">\
															<span class="kt-notes__icon kt-notes__icon--danger">\
																<i class="fa fa-dollar-sign kt-font-info"></i>\
															</span>\
														</div>\
														<div class="kt-notes__content">\
															<div class="kt-notes__section">\
																<div class="kt-notes__info">\
																	<p class="kt-notes__title">\
																		Budget\
																	</p>\
																	<span class="kt-notes__desc">\
																		'+data.budget+'\
																	</span>\
																</div>\
															</div>\
														</div>\
                                                    </div>';
            }
            if(data.deliveryDateId !== null){
                returend_data = returend_data + '<div class="kt-notes__item pb-2 pr-4 float-left">\
														<div class="kt-notes__media">\
															<span class="kt-notes__icon kt-notes__icon--danger">\
																<i class="fa fa-calendar-check kt-font-info"></i>\
															</span>\
														</div>\
														<div class="kt-notes__content">\
															<div class="kt-notes__section">\
																<div class="kt-notes__info">\
																	<p class="kt-notes__title">\
																		Delievry Date\
																	</p>\
																	<span class="kt-notes__desc">\
																		'+data.deliveryDateId+'\
																	</span>\
																</div>\
															</div>\
														</div>\
                                                    </div>';
            }
            if(data.convertProject1 !== null){
                returend_data = returend_data + '<div class="kt-notes__item pb-2 pr-4 float-left">\
														<div class="kt-notes__media">\
															<span class="kt-notes__icon kt-notes__icon--danger">\
																<i class="fa fa-project-diagram kt-font-info"></i>\
															</span>\
														</div>\
														<div class="kt-notes__content">\
															<div class="kt-notes__section">\
																<div class="kt-notes__info">\
																	<p class="kt-notes__title">\
																		Convert Project 1\
																	</p>\
																	<span class="kt-notes__desc">\
																		'+data.convertProject1+'\
																	</span>\
																</div>\
															</div>\
														</div>\
                                                    </div>';
            }
            if(data.convertProject2 !== null){
                returend_data = returend_data + '<div class="kt-notes__item pb-2 pr-4 float-left">\
														<div class="kt-notes__media">\
															<span class="kt-notes__icon kt-notes__icon--danger">\
																<i class="fa fa-project-diagram kt-font-info"></i>\
															</span>\
														</div>\
														<div class="kt-notes__content">\
															<div class="kt-notes__section">\
																<div class="kt-notes__info">\
																	<p class="kt-notes__title">\
																		Convert Project 2\
																	</p>\
																	<span class="kt-notes__desc">\
																		'+data.convertProject2+'\
																	</span>\
																</div>\
															</div>\
														</div>\
                                                    </div>';
            }
            if(data.property === null && data.propertyLocation === null && data.propertyUtility === null && data.areaFrom === null && data.areaTo === null
                && data.budget === null && data.deliveryDateId === null && data.convertProject1 === null && data.convertProject2 === null ){
                returend_data = returend_data + '<div class="kt-notes__item pb-2 pr-2">\
													<div class="kt-notes__media">\
														<span class="kt-notes__icon kt-notes__icon--danger">\
															<i class="fas fa-times"></i>\
														</span>\
													</div>\
													<div class="kt-notes__content">\
														<div class="kt-notes__section">\
															<div class="kt-notes__info">\
																<p class="kt-notes__title">\
																	No Questions Available\
																</p>\
															</div>\
														</div>\
                                                    </div>\
                                                </div>';
            }

            //Close kt-portlet and kt-notes and kt-notes__items
            returend_data = returend_data + '</div></div></div>';

            return returend_data;
        }
    </script>
    <script>
        function output(data) {
            return '<form class="kt-form" id="updateForm" method="POST" action="{{url('/client-update')}}">\n' +
                '    @csrf\n' +
                '                    <input name="_id" type="text" hidden value="' + data.userId + '">\n' +
               ' <div class="form-group row">\n' +
            '                      <div class="col-lg-4">\n' +
            '                            <select class="form-control actionId"  name="actionId">\n' +
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
                '<div class="form-group row">\n' +
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
        function last(data) {

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
            return '<div class="kt-user-card-v2">\
                        			<div class="kt-user-card-v2__details">\
                        		   <p class="kt-user-card-v2__name"> Assigned At : ' + data.assignedDate + '  ' + data.assignedTime + '  </p>\
                        			<p class="btn btn-bold btn-sm btn-font-sm ' + status[data.actionId].class + ' ">' + data.statusName + ' At ' + data.notificationDate + ' ' + data.notificationTime + '</p>\
                        		   <p class="kt-user-card-v2__name"> Via : ' + data.methodName + '  </p>\
                        			<p class="kt-user-card-v2__name"> Summery : ' + summery[data.summery].title + '  </p>\
                        			<p class="kt-user-card-v2__name"> Note : ' + data.notes + '  </p>\
                        		</div>\
                        		</div>\
                        		<div>\
                        		<input type="text" hidden class="user" value="' + data.userId + '"> \
                        	<button type="button" class="getHistory btn btn-bold btn-label-brand btn-lg" style="width:160px; margin-bottom:10px">Load History</button>\
                      <a  href="https://wa.me/'+ data.phone +'" target="_blank" class="whats btn btn-bold btn-label-success btn-lg" style="width:160px;">\
                                    <i class="fab fa-whatsapp"></i>whatsApp</a>\
                        		</div>\
                        		';
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
                        			</div>-->\
                        			<div class="kt-user-card-v2__details">\
                        			  <p class="kt-user-card-v2__name"> Name : \
                                      <a href="'+ URL +'/client-profile/'+data.userId +'"> ' + data.name + '</a>\
                                     </p>\
                        			<p class="kt-user-card-v2__name"> Email : ' + data.email + '  </p>\
                        			<p class="kt-user-card-v2__name"> Phone : \
                                           <a href="tel:' + data.phone + '">' + data.phone + '</a>  </p>\
                        			<p class="kt-user-card-v2__name"> Interested Project : ' + data.projectName + '  </p>\
                        			<p class="kt-user-card-v2__name"> Job Title : ' + data.jobTitle + '  </p>\
                        			<p class="kt-user-card-v2__name"> Notes : ' + data.notes + '  </p>\
                        			@if(Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root')\
                        			<p class="kt-user-card-v2__name"> Assign To : ' + data.saleName + '  </p>\
                        			@endif\
                        			<p class="kt-user-card-v2__name"> Join Date: ' + data.created_at + '  </p>\
                        		</div>\
                        		</div>';

        }

    </script>
    <script>

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
                            "<p>" + element.date + " </p>" +
                            "<p>" + data.methodName + " </p>" +
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
    <script>
        $(document).on('change', '.actionId', function () {
            var actionId = $(this).val();
            if (actionId == 10 || actionId == 9|| actionId == 7 ) {
                $(this).parents('.form-group.row').find ('.hidden').css({"opacity": 0});
            } else {
                $(this).parents('.form-group.row').find ('.hidden').css({"opacity": 1});
            }
        });
    </script>
    <script> HREF = "{{ url('client/get_duplicated_data') }}"; </script>
    <script> URL = "{{ url('/') }}"; </script>
    <script> title = "Last Action"; </script>
    <script> user = "{{ Auth::user()->role->name }}"; </script>
    <script src="{{url('assets/js/pages/custom/user/list-datatable.js')}}" type="text/javascript"></script>

@endsection



