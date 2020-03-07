@extends('layouts.app')

@section('content')

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
    <script> HREF = "{{ url('client/get_new_requests_data') }}"; </script>
    <script> URL = "{{ url('/') }}"; </script>
    <script> user = "{{ Auth::user()->role->name }}"; </script>
    <script src="{{url('assets/js/pages/custom/user/list-datatable_original.js')}}" type="text/javascript"></script>

@endsection



