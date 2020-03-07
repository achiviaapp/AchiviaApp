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
                    Clients
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <div class="kt-subheader__group" id="kt_subheader_search">
										<span class="kt-subheader__desc" id="kt_subheader_total">
											450 Total </span>
                    <form class="kt-margin-l-20" id="kt_subheader_search_form">
                        <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
                            <input type="text" class="form-control" placeholder="Search Name or Phone..." id="generalSearch">
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
                                    <option value="0">SaleMan</option>
                                    @foreach($sales as $sale)
                                        <option value=" {{$sale['id']}}">  {{$sale['name']}} </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
                            <select class="form-control" id="projectFilter">
                                <option value="0">Project</option>
                                @foreach($projects as $project)
                                    <option value=" {{$project['id']}}">  {{$project['name']}} </option>
                                @endforeach
                            </select>
                        </div>


                        
                    </form>
                </div>

                @if(Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root')
                    <div class="kt-subheader__group" id="kt_subheader_group_actions">
                        <div class="kt-subheader__desc"><span id="kt_subheader_group_selected_rows"></span> Selected:
                        </div>
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
                            <button class="btn btn-label-danger btn-bold btn-sm btn-icon-h"
                                    id="kt_subheader_group_actions_delete_all">
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
                            <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Created At</span>&nbsp;
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
                
                    <div class="accordion accordion-solid accordion-toggle-plus  accordion-svg-icon" id="accordionExample7">
                        <div class="card">
                            <div class="card-header" id="headingOne7">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne7" aria-expanded="false" aria-controls="collapseOne7">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                                        </g>
                                    </svg>More Filters
                                </div>
                            </div>
                            <div id="collapseOne7" class="collapse" aria-labelledby="headingOne7" data-parent="#accordionExample7" style="">
                                <div class="card-body">
                                    <form class="kt-form kt-form--fit kt-margin-b-20 row">
                                    
                                        <select class="col-12 col-md-3 col-lg-2 form-control m-2" id="priorityFilter">
                                            <option value="0">Priorty</option>
                                            <option value="High">High</option>
                                            <option value="normal">normal</option>
                                            <option value="low">low</option>
                                        </select>
                                    
                                        <select class="col-12 col-md-3 col-lg-2 form-control m-2" id="statusFilter">
                                            <option value="0">Status</option>
                                            <option value="delayed">Delayed</option>
                                            <option value="notDelayed">Not Delayed</option>
                                        </select>
                                    
                                        <select class="col-12 col-md-3 col-lg-2 form-control m-2" id="propertyFilter">
                                            <option value="0">Property</option>
                                            <option value="residential">Residential</option>
                                            <option value="commercial">Commercial</option>
                                            <option value="administrative">Administrative</option>
                                            <option value="medical"> Medical</option>
                                        </select>
                                        <input type="num" class="col-12 col-md-3 col-lg-2 form-control m-2" placeholder="area..." id="areaFilter">
                                        <input type="text" class="col-12 col-md-3 col-lg-2 form-control m-2" placeholder="BUdget..." id="budgetFilter">
                                        <select class="col-12 col-md-3 col-lg-2 form-control m-2" id="convertToProjectFilter">
                                            <option value="0">Convert to Project</option>
                                            @foreach($projects as $project)
                                                <option value=" {{$project['id']}}">  {{$project['name']}} </option>
                                            @endforeach
                                        </select>
                                        <select class="col-12 col-md-3 col-lg-2 form-control m-2" id="marketerFilter">
                                            <option value="0">Marketer</option>
                                        </select>
                                    
                                        <select class="col-12 col-md-3 col-lg-2 form-control m-2" id="customLinkFilter">
                                            <option value="0">Cusotm Link</option>
                                        </select>
                                    
                                        <select class="col-12 col-md-3 col-lg-2 form-control m-2" id="campaignFilter">
                                            <option value="0">Campaign</option>
                                        </select>
                                    
                                        <select class="col-12 col-md-3 col-lg-2 form-control m-2" id="platformFilter">
                                            <option selected value="0">Platform</option>
                                            <option value="DirectCall"> Direct Call</option>
                                            <option disabled>──────────</option>
                                            <option value="FacebookAds"> Facebook Ads</option>
                                            <option value="Facebookmoderation"> Facebook moderation</option>
                                            <option disabled>──────────</option>
                                            <option value="Instagram"> Instagram</option>
                                            <option value="Whatsapp"> Whatsapp</option>
                                            <option value="Google"> Google</option>
                                            <option value="Twitter"> Twitter</option>
                                            <option value="Youtube"> Youtube</option>
                                            <option value="LinkedIn"> LinkedIn</option>
                                            <option disabled>──────────</option>
                                            <option value="SMScampaign"> SMS campaign</option>
                                            <option value="Emailcampaign"> Email campaign</option>
                                            <option value="Website"> Website</option>
                                            <option value="Event"> Event</option>
                                            <option disabled>──────────</option>
                                            <option value="ColdCall"> Cold Call</option>
                                            <option value="Clientreferral"> Client referral</option>
                                            <option value="PersonalReferral"> Personal Referral</option>
                                            <option value="BusinessCard"> Business Card</option>
                                        </select>
                                    
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-slow m-0">
                        <div class="kt-portlet__body p-4">
                            <div class="kt-iconbox__body">
                                <div class="kt-iconbox__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                        </g>
                                    </svg> </div>
                                <div class="kt-iconbox__desc w-100">
                                    <h3 class="kt-iconbox__title mt-4">
                                        User History
                                    </h3>
                                    <div class="kt-iconbox__content">
                                       <div class="row modal-info p-3">

                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script> HREF = "{{ url('client/get_data/'.$actionId) }}"; </script>
    <script>
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
        function output(data) {
            return '<form class="kt-form" id="updateForm" method="POST" action="{{url('/client-update')}}">\n' +
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
                ' <option selected value="">Priority \n' +
                ' </option>\n' +
                '<option value="High"> High</option>\n' +
                ' <option value="Normal"> Normal</option>\n' +
                '<option value="Low"> Low</option>\n' +
                '</select>\n' +
                '</div>\n' +
                '<div class="col-3">\n' +
                '<select class="form-control" id="" name="via_method">\n' +
                ' <option selected value="">Method</option>\n' +
                ' @foreach($methods as $method)\n' +
                '<option value="{{$method['id']}}">{{$method['name']}}</option>\n' +
                ' @endforeach \n' +
                '</select>\n' +
                ' </div>\n' +
                '<div class="col-lg-3">\n' +
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
                '</form>\n';
        }
    </script>

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

                1: {
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

                7: {
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
                12: {
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
                        			<p class="btn btn-bold btn-sm btn-font-sm ' + status[data.actionId].class + '">' + data.statusName + ' At ' + data.notificationDate + ' ' + data.notificationTime + '</p>\
                        			<p class="kt-user-card-v2__name"> Via ' + data.methodName + '  </p>\
                        			<p class="kt-user-card-v2__name"> Summery : ' + summery[data.summery].title + '  </p>\
                        			<p class="kt-user-card-v2__name"> Note : ' + data.notes + '  </p>\
                        		</div>\
                        		</div>\
                        		<div>';

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
            var stateNo = KTUtil.getRandomInt(0, 5);
            var states = [
                'success',
                'brand',
                'danger',
                'warning',
                'primary',
                'info'
            ];
            var state = states[stateNo];

            var return_data = " ";

            //open the kt-widget
            return_data = '<div class="kt-widget kt-widget--user-profile-1 pb-0">';
            
            //add clinet's name and the status if delayed or not
            //not delayed
            if(data.delayed === false){
                return_data = return_data + '<div class="kt-widget__head">\
                                                <div class="kt-widget__content pl-0">\
                                                    <div class="kt-widget__section left-status left-status-success">\
                                                        <a href="' + URL + '/client-profile/' + data.userId + '" class="kt-widget__username">' + data.name + '</a>\
                                                        <span class="kt-widget__subtitle">Project: ' + data.projectName + '</span>\
                                                    </div>\
                                                </div>\
                                            </div>';
            }
            //delayed
            else if(data.delayed === true){
                return_data = return_data + '<div class="kt-widget__head">\
                                                <div class="kt-widget__content pl-0">\
                                                    <div class="kt-widget__section left-status left-status-danger">\
                                                        <a href="' + URL + '/client-profile/' + data.userId + '" class="kt-widget__username">' + data.name + '</a>\
                                                        <span class="kt-widget__subtitle">Project: ' + data.projectName + '</span>\
                                                    </div>\
                                                </div>\
                                            </div>';
            }
            //open the kt-widget__body and kt-widget__content
            return_data = return_data + '<div class="kt-widget__body">\
													<div class="kt-widget__content">';
            //adding client's phone
            if(data.phone !== null){
                return_data = return_data + '<div class="kt-widget__info">\
											<span class="kt-widget__label">Phone:</span>\
											<a href="tel:' + data.phone + '" class="kt-widget__data">' + data.phone + '</a>\
										</div>';
            }
            //adding client's emial
            if(data.email !== null){
                return_data = return_data + '<div class="kt-widget__info">\
											    <span class="kt-widget__label">Email:</span>\
												<a href="mailto:' + data.email + '" class="kt-widget__data">' + data.email + '</a>\
											</div>';
            }
            //adding client's job title
            if(data.jobTitle !== null){
                return_data = return_data + '<div class="kt-widget__info">\
												<span class="kt-widget__label">Job Title:</span>\
												<span class="kt-widget__data">' + data.jobTitle + '</span>\
                                            </div>';
            }
            //adding client's Notes
            if(data.notes !== null){
                return_data = return_data + '<div class="kt-widget__info">\
												<span class="kt-widget__label">Notes:</span>\
												<span class="kt-widget__data">' + data.notes + '</span>\
                                            </div>';
            }
            //adding client's saleName
            if(data.notes !== null){
                return_data = return_data + '@if(Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root')\
                                                <div class="kt-widget__info">\
													<span class="kt-widget__label">Salesman:</span>\
													<span class="kt-widget__data font-weight-bold">' + data.saleName + '</span>\
                                                </div>\
                                             @endif';
            }
            //Close the kt-widget__body and kt-widget__content
            return_data = return_data + '</div></div>';

            //open the kt-widget__body and kt-widget__content
            return_data = return_data + '<div class="kt-widget__body">\
													<div class="kt-widget__content">';
            //adding client's created at and by
            if( (data.created_at !== null) && (data.created_by !== null) ){
                return_data = return_data + '@if(Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root')\
                                                <div class="kt-widget__info">\
													<span class="kt-widget__label">Created at:</span>\
													<span class="kt-widget__data">' + data.created_at + '</span>\
                                                </div>\
                                                <div class="kt-widget__info">\
													<span class="kt-widget__label">Created By:</span>\
													<span class="kt-widget__data">' + data.created_by + '</span>\
                                                </div>\
                                             @endif';
            }
            //adding client's marketer
            if(data.marketer !== null){
                return_data = return_data + '<div class="kt-widget__info">\
												<span class="kt-widget__label">Marketer:</span>\
												<span class="kt-widget__data font-weight-bold">' + data.marketer + '</span>\
                                            </div>';
            }
            //adding client's campaign
            if(data.campaign !== null){
                return_data = return_data + '<div class="kt-widget__info">\
												<span class="kt-widget__label">Campaign:</span>\
												<span class="kt-widget__data font-weight-bold">' + data.campaign + '</span>\
                                            </div>';
            }
            //adding client's custom_link
            if(data.custom_link !== null){
                return_data = return_data + '<div class="kt-widget__info">\
												<span class="kt-widget__label">Custom Link:</span>\
												<span class="kt-widget__data font-weight-bold">' + data.custom_link + '</span>\
                                            </div>';
            }
            //adding client's platform
            if(data.platform !== null){
                return_data = return_data + '<div class="kt-widget__info">\
												<span class="kt-widget__label">Platform:</span>\
												<span class="kt-widget__data font-weight-bold">' + data.platform + '</span>\
                                            </div>';
            }
            //Close the kt-widget__body and kt-widget__content
            return_data = return_data + '</div></div>';
            //Close the kt-widget
            return_data = return_data + ' <div class="my-3 text-center">\
                                                <input type="text" hidden class="user" value="' + data.userId + '"> \
                                                    <button type="button" class=" getHistory btn btn-brand btn-upper btn-bold">Load History</button>\
                                                    <a  href="https://wa.me/' + data.phone + '" target="_blank" type="button" class=" whats btn btn-success btn-upper btn-bold"><i class="fab fa-whatsapp"></i> Whatsapp</a>\
                                            </div></div>';

            return return_data;
            

            return '<div class="border-left-green kt-widget kt-widget--user-profile-1 pb-0">\
												<div class="kt-widget__head">\
													<div class="kt-widget__content pl-0">\
														<div class="kt-widget__section left-status left-status-danger">\
															<a href="' + URL + '/client-profile/' + data.userId + '" class="kt-widget__username">\
																' + data.name + '\
															</a>\
															<span class="kt-widget__subtitle">Project: \
																' + data.projectName + '\
															</span>\
                                                        </div>\
													</div>\
												</div>\
												<div class="kt-widget__body">\
													<div class="kt-widget__content">\
														<div class="kt-widget__info">\
															<span class="kt-widget__label">Phone:</span>\
															<a href="tel:' + data.phone + '" class="kt-widget__data">' + data.phone + '</a>\
														</div>\
                                                        <div class="kt-widget__info">\
															<span class="kt-widget__label">Email:</span>\
															<a href="mailto:' + data.email + '" class="kt-widget__data">' + data.email + '</a>\
														</div>\
                                                        <div class="kt-widget__info">\
															<span class="kt-widget__label">Job Title:</span>\
															<span class="kt-widget__data">' + data.jobTitle + '</span>\
                                                        </div>\
                                                        <div class="kt-widget__info">\
															<span class="kt-widget__label">Notes:</span>\
															<span class="kt-widget__data">' + data.notes + '</span>\
                                                        </div>\
                                                        @if(Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root')\
                                                        <div class="kt-widget__info">\
															<span class="kt-widget__label">Salesman:</span>\
															<span class="kt-widget__data font-weight-bold">' + data.saleName + '</span>\
                                                        </div>\
                                                        @endif\
													</div>\
												</div>\
                                                <div class="kt-widget__body">\
													<div class="kt-widget__content p-0">\
														@if(Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root')\
                                                        <div class="kt-widget__info">\
															<span class="kt-widget__label">Created at:</span>\
															<span class="kt-widget__data">' + data.created_at + '</span>\
                                                        </div>\
                                                        <div class="kt-widget__info">\
															<span class="kt-widget__label">Created By:</span>\
															<span class="kt-widget__data">' + data.created_by + '</span>\
                                                        </div>\
                                                        @endif\
                                                        <div class="kt-widget__info">\
															<span class="kt-widget__label">Marketer:</span>\
															<span class="kt-widget__data">' + data.marketer + '</span>\
                                                        </div>\
                                                        <div class="kt-widget__info">\
															<span class="kt-widget__label">Custom Link:</span>\
															<span class="kt-widget__data">' + data.custom_link + '</span>\
                                                        </div>\
                                                        <div class="kt-widget__info">\
															<span class="kt-widget__label">Campaign:</span>\
															<span class="kt-widget__data">' + data.campaign + '</span>\
                                                        </div>\
                                                        <div class="kt-widget__info">\
															<span class="kt-widget__label">Platform:</span>\
															<span class="kt-widget__data">' + data.platform + '</span>\
                                                        </div>\
													</div>\
												</div>\
											</div>\
                                            <div class="my-3 text-center">\
                                                <input type="text" hidden class="user" value="' + data.userId + '"> \
                                                    <button type="button" class=" getHistory btn btn-brand btn-upper btn-bold">Load History</button>\
                                                    <a  href="https://wa.me/' + data.phone + '" target="_blank" type="button" class=" whats btn btn-success btn-upper btn-bold"><i class="fab fa-whatsapp"></i> Whatsapp</a>\
                                            </div>\
                </div>\
                     ';

        }

    </script>
    <script> URL = "{{ url('/') }}"; </script>
    <script> user = "{{ Auth::user()->role->name }}"; </script>
    <script>
        var summery = {

            null: {
                'title': '-',
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
                    var modalBody = $('#kt_modal_4 .modal-info');

                    modalBody.empty();
                    $.each(data, function (index, element) {
                        var history = '<div class="col-6">';
                        if(element.actionName !== null){
                            history = history + '<p> Action: <strong>' + element.actionName + '</strong></p>';
                        }
                        if(element.date !== null){
                            history = history + '<p> Date: <strong>' + element.date + '</strong></p>';
                        }
                        if(element.methodName !== null){
                            history = history + '<p> Method: <strong>' + element.methodName + '</strong></p>';
                        }
                        if(summery[element.summery].title !== null){
                            history = history + '<p> Action: <strong>' + summery[element.summery].title + '</strong></p>';
                        }
                        if(element.state !== null){
                            history = history + '<p> State: <strong>' + element.state + '</strong></p>';
                        }
                        if(element.notes !== null){
                            history = history + '<p> Notes: <strong>' + element.notes + '</strong></p>';
                        }
                        history = history + '</div>';
                        modalBody.append(history);
                    });

                    $('#kt_modal_4').modal('show');
                }
            );
        });
    </script>
    <script> title = "Last Action"; </script>
    <script src="{{url('assets/js/pages/custom/user/list-datatable.js')}}" type="text/javascript"></script>
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
@endsection



