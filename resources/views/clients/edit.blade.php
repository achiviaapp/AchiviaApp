@extends('layouts.app')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile"
                     id="kt_page_portlet">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url('/home')}}" class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">Back</span>
                            </a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-brand" id="updateClient">
                                    <i class="la la-check"></i>
                                    <span class="kt-hidden-mobile">Save</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <form class="kt-form" id="updateForm" method="POST" action="{{url('/client-form-update')}}">
                            @csrf
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <h3 class="kt-section__title kt-section__title-lg">Customer Info:</h3>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Name</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" readonly
                                                           value="{{$requestData['name']}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Contact Phone</label>
                                                <div class="col-9">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span
                                                                    class="input-group-text"><i
                                                                        class="la la-phone"></i></span></div>
                                                        <input type="text" class="form-control" readonly
                                                               value="{{$requestData['phone']}}" placeholder="Phone"
                                                               aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Email Address</label>
                                                <div class="col-9">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span
                                                                    class="input-group-text"><i
                                                                        class="la la-at"></i></span></div>
                                                        <input type="text" class="form-control" readonly
                                                               value="{{$requestData['email']}}" placeholder="Email"
                                                               aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Job Title</label>
                                                <div class="col-9">
                                                    @if($requestData['detail']['jobTitle'])
                                                        <input class="form-control" type="text" name="jobTitle" readonly
                                                               value="{{$requestData['detail']['jobTitle']}}">
                                                    @else
                                                        <input class="form-control" type="text"
                                                               value="" name="jobTitle">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Notes</label>
                                                <div class="col-9">
                                                    @if($requestData['detail']['notes'])
                                                        <input class="form-control" type="text" name="notes"
                                                               value="{{$requestData['detail']['notes']}}">
                                                    @else
                                                        <input class="form-control" type="text" name="notes"
                                                               value="">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                    <div class="kt-section">
                                        <div class="kt-section__body">
                                            <h3 class="kt-section__title kt-section__title-lg">Project Info:</h3>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Project</label>
                                                <select id="projectId" name="projectId"
                                                        class="form-control col-lg-9 col-xl-9">
                                                    <option selected value="0">Select Project</option>
                                                    @foreach($projects as $project)
                                                        <option value="{{$project['id']}}" {{ $project['id'] == $requestData['detail']['projectId'] ? 'selected' : '' }} >{{$project['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Campaign</label>
                                                <select id="campaignId" name="campaignId"
                                                        class="form-control col-lg-9 col-xl-9">
                                                    <option selected  value = "0"> Select Campaign </option>
                                                </select>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Marketer</label>
                                                <select id="marketerId" name="marketerId"
                                                        class="form-control col-lg-9 col-xl-9">
                                                    <option selected value ='0' >Select Marketer</option>
                                                </select>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Platform</label>

                                                <select id="" name="platform"
                                                        class="form-control col-lg-9 col-xl-9">
                                                    <option value="facebook" {{'facebook' == $requestData['detail']['platform'] ? 'selected' : '' }} > FaceBook</option>
                                                    <option value="google" {{'google' == $requestData['detail']['platform'] ? 'selected' : '' }}> Google</option>
                                                    <option value="instgram" {{'instgram' == $requestData['detail']['platform'] ? 'selected' : '' }}> Instagram</option>
                                                    <option value="linkedin" {{'linkedin' == $requestData['detail']['platform'] ? 'selected' : '' }}> LinkedIn</option>
                                                    <option value="twitter" {{'twitter' == $requestData['detail']['platform'] ? 'selected' : '' }}> Twitter</option>
                                                    <option value="youtube" {{'youtube' == $requestData['detail']['platform'] ? 'selected' : '' }}> YouTube</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                    <div class="kt-section">
                                        <div class="kt-section__body">
                                            <h3 class="kt-section__title kt-section__title-lg">Customer Questions
                                                :</h3>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            Property </label>

                                        <select id="" name="property"
                                                class="form-control col-lg-9 col-xl-9">
                                            <option value="residential" {{'residential' == $requestData['detail']['property'] ? 'selected' : '' }}> Residential
                                            </option>
                                            <option value="commercial" {{'commercial' == $requestData['detail']['property'] ? 'selected' : '' }}> Commercial</option>
                                            <option value="administrative" {{'administrative' == $requestData['detail']['property'] ? 'selected' : '' }}> Administrative
                                            </option>
                                            <option value="medical" {{'medical' == $requestData['detail']['property'] ? 'selected' : '' }}> Medical</option>
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Property
                                            Location</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input id="" class="form-control"
                                                   name="propertyLocation"
                                                   type="text"
                                                   value="{{$requestData['detail']['propertyLocation']}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            Property Utility</label>
                                        <select id="" name="propertyUtility"
                                                class="form-control col-lg-9 col-xl-9">
                                            <option value="personal" {{'personal' == $requestData['detail']['propertyUtility'] ? 'selected' : '' }}> personal use</option>
                                            <option value="investment" {{'investment' == $requestData['detail']['propertyUtility'] ? 'selected' : '' }}> investment</option>
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Area</label>
                                        <div class="col-lg-4 col-xl-4">
                                            <input id="" class="form-control"
                                                   name="areaFrom"
                                                   type="number"  value="{{$requestData['detail']['areaFrom']}}" placeholder="From">
                                        </div>
                                        <div class="col-xs-1 col-lg-1  col-lg-offset-1 col-xs-offset-1"></div>
                                        <div class="col-lg-4 col-xl-4">
                                            <input id="" class="form-control"
                                                   name="areaTo"
                                                   type="number"  value="{{$requestData['detail']['areaTo']}}" placeholder="To">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            Approximate Budget</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input id="" class="form-control"
                                                   name="budget"
                                                   type="number" value="{{$requestData['detail']['budget']}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            Delivery Date</label>
                                        <select id="" name="deliveryDateId"
                                                class="form-control col-lg-9 col-xl-9">
                                            @foreach($dates as $date)
                                                <option value="{{$date['id']}}" {{$date['id'] == $requestData['detail']['deliveryDateId'] ? 'selected' : '' }}>{{$date['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Convert to
                                            Project 1</label>
                                        <select id="projectId" name="convertProject1"
                                                class="form-control col-lg-9 col-xl-9">
                                            @foreach($projects as $project)
                                                <option value="{{$project['id']}}" {{$project['id'] == $requestData['detail']['convertProject1'] ? 'selected' : '' }}>{{$project['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Convert To Project 2
                                            Project</label>

                                        <select id="projectId" name="convertProject2"
                                                class="form-control col-lg-9 col-xl-9">
                                            @foreach($projects as $project)
                                                <option value="{{$project['id']}}" {{$project['id'] == $requestData['detail']['convertProject2'] ? 'selected' : '' }}>{{$project['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                    <div class="kt-section">
                                        <div class="kt-section__body">
                                            <input name="_id" class="form-control" type="text" hidden
                                                   value="{{$requestData['id']}}">
                                            <h3 class="kt-section__title kt-section__title-lg">Customer Questions
                                                :</h3>
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-3 col-sm-12">Date</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" readonly
                                                               placeholder="Select date" id="kt_datepicker_2"
                                                               name="notificationDate"/>
                                                        <div class="input-group-append">
														<span class="input-group-text">
															<i class="la la-calendar-check-o"></i>
														</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Time</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <div class="input-group timepicker">
                                                        <input class="form-control" id="kt_timepicker_2" readonly
                                                               placeholder="Select time" type="text"
                                                               name="notificationTime"/>
                                                        <div class="input-group-append">
														<span class="input-group-text">
															<i class="la la-clock-o"></i>
														</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Action</label>
                                                <select id="cityId" name="actionId"
                                                        class="form-control col-lg-9 col-xl-9">
                                                    <option selected value="0">Select Action</option>
                                                    @foreach($actions as $action)
                                                        <option value="{{$action['id']}}">{{$action['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group form-group-last row">
                                                <label class="col-3 col-form-label">Communication</label>
                                                <div class="col-9">
                                                    <div class="form-group row">
                                                        <div class="kt-radio-inline">
                                                            @foreach($methods as $method)
                                                                <label class="kt-radio">
                                                                    <input type="radio" value="{{$method['id']}}"
                                                                           name="via_method">
                                                                    {{$method['name']}}
                                                                    <span></span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-group-last row">
                                                <label class="col-3 col-form-label">Summery</label>
                                                <div class="col-9">
                                                    <div class="form-group row">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" value="1" name="summery">
                                                                Replied
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" value="2" name="summery">
                                                                Switched
                                                                Off

                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" value="3" name="summery"> No
                                                                Answer
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" value="4" name="summery"> Wrong
                                                                Number
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Assigned To</label>
                                                <select id="" name="assignToSaleManId"
                                                        class="form-control col-lg-9 col-xl-9">
                                                    <option selected>Assigned To</option>
                                                    @foreach($sales as $sale)
                                                        <option value="{{$sale['id']}}" {{ $sale['id'] == $requestData['detail']['assignToSaleManId'] ? 'selected' : '' }}>{{$sale['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <!--end::Portlet-->
            </div>
        </div>
    </div>

    <!-- end:: Content -->

@endsection
@section('script')
    <script src="{{url('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            var projectID = $('#projectId').val();
            $.get(
                "{{ url('api/dropdown/sales')}}",
                {
                    option: projectID
                },
                function (data) {

                    var saleId = $('#saleId');
                    var campaignId = $('#campaignId');

                    campaignId.empty();
                    campaignId.append("<option value='0'> Select Campaign </option>");
                    $.each(data.campaigns, function (index, element) {
                        campaignId.append("<option value='" + element.id + "' > " + element.name + "</option>");
                    });

                    saleId.empty();
                    saleId.append("<option value='0'> Assigned To </option>");
                    $.each(data.sales, function (index, element) {
                        saleId.append("<option value='" + element.id + "'>" + element.name + "</option>");
                    });
                }
            );


            $("#updateClient").click(function () {
                $("#updateForm").submit();
            });

            $('#campaignId').change(function () {
                $.get(
                    "{{ url('api/dropdown/marketer')}}",
                    {
                        option: $(this).val()
                    },
                    function (data) {
                        var marketerId = $('#marketerId');
                        marketerId.empty();
                        marketerId.append("<option value='0'> Select CampaignMarketer </option>");
                        $.each(data, function (index, element) {
                            marketerId.append("<option value='" + element.id + "'>" + element.name + "</option>");
                        });
                    }
                );
            });


            $('#projectId').change(function () {
                $.get(
                    "{{ url('api/dropdown/sales')}}",
                    {
                        option: $(this).val()
                    },
                    function (data) {
                        console.log(data);

                        var saleId = $('#saleId');
                        var campaignId = $('#campaignId');

                        campaignId.empty();
                        campaignId.append("<option value='0'> Select Campaign </option>");
                        $.each(data.campaigns, function (index, element) {
                            campaignId.append("<option value='" + element.id + "'>" + element.name + "</option>");
                        });

                        saleId.empty();
                        saleId.append("<option value='0'> Assigned To </option>");
                        $.each(data.sales, function (index, element) {
                            saleId.append("<option value='" + element.id + "'>" + element.name + "</option>");
                        });
                    }
                );
            });
        });
    </script>



@endsection