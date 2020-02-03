@extends('layouts.app')
<!--begin::Page Custom Styles(used by this page) -->
<link href="{{url('assets/css/pages/wizard/wizard-4.css')}}" rel="stylesheet" type="text/css"/>
<style>
    .alert {
        display: block !important;
    }
</style>
<!--end::Page Custom Styles -->
@section('content')

    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

            <!-- begin:: Content -->
            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                <div class="kt-wizard-v4" id="kt_user_add_user" data-ktwizard-state="step-first">
                    <div class="alert alert-danger" style="display:none">

                    </div>

                    <!--begin: Form Wizard Nav -->
                    <div class="kt-wizard-v4__nav">
                        <div class="kt-wizard-v4__nav-items nav">

                            <!--doc: Replace A tag with SPAN tag to disable the step link click -->
                            <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step"
                                 data-ktwizard-state="current">
                                <div class="kt-wizard-v4__nav-body">
                                    <div class="kt-wizard-v4__nav-number">
                                        1
                                    </div>
                                    <div class="kt-wizard-v4__nav-label">
                                        <div class="kt-wizard-v4__nav-label-title">
                                            Profile
                                        </div>
                                        <div class="kt-wizard-v4__nav-label-desc">
                                            User's Personal Information
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v4__nav-body">
                                    <div class="kt-wizard-v4__nav-number">
                                        2
                                    </div>
                                    <div class="kt-wizard-v4__nav-label">
                                        <div class="kt-wizard-v4__nav-label-title">
                                            Review
                                        </div>
                                        <div class="kt-wizard-v4__nav-label-desc">
                                            Review your Details
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end: Form Wizard Nav -->
                    <div class="kt-portlet">
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-grid">
                                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                    <!--begin: Form Wizard Form-->
                                    <form class="kt-form" id="kt_user_add_form" method="POST"
                                          action="{{url('/client-quick-store')}}">
                                    @csrf
                                    <!--begin: Form Wizard Step 1-->
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                             data-ktwizard-state="current">
                                            <div class="kt-heading kt-heading--md">User's Profile Details:</div>
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <input name="roleId" hidden class="form-control"
                                                                       type="text" value="5">

                                                                <input name="createdBy" hidden class="form-control"
                                                                       type="text" value="{{Auth()->id()}}">

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input id="name" name="name"
                                                                               class="form-control"
                                                                               type="text" value="{{ old('name') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Contact
                                                                        Phone</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend"><span
                                                                                        class="input-group-text"><i
                                                                                            class="la la-phone"></i></span>
                                                                            </div>
                                                                            <!-- country codes (ISO 3166) and Dial codes. -->
                                                                            <select class="form-control"
                                                                                    name="countryCode" id="">
                                                                                <option data-countryCode="EG" value="20"
                                                                                        Selected>Egypt (+20)
                                                                                </option>
                                                                                <optgroup label="Other countries">
                                                                                    <option data-countryCode="SA"
                                                                                            value="966">Saudi Arabia
                                                                                        (+966)
                                                                                    </option>
                                                                                    <option data-countryCode="BH"
                                                                                            value="973">Bahrain (+973)
                                                                                    </option>
                                                                                    <option data-countryCode="IQ"
                                                                                            value="964">Iraq (+964)
                                                                                    </option>
                                                                                    <option data-countryCode="JO"
                                                                                            value="962">Jordan (+962)
                                                                                    </option>
                                                                                    <option data-countryCode="KW"
                                                                                            value="965">Kuwait (+965)
                                                                                    </option>
                                                                                    <option data-countryCode="LB"
                                                                                            value="961">Lebanon (+961)
                                                                                    </option>
                                                                                    <option data-countryCode="LY"
                                                                                            value="218">Libya (+218)
                                                                                    </option>
                                                                                    <option data-countryCode="OM"
                                                                                            value="968">Oman (+968)
                                                                                    </option>
                                                                                    <option data-countryCode="QA"
                                                                                            value="974">Qatar (+974)
                                                                                    </option>
                                                                                    <option data-countryCode="AE"
                                                                                            value="971">United Arab
                                                                                        Emirates (+971)
                                                                                    </option>
                                                                                    <option data-countryCode="YE"
                                                                                            value="967">Yemen
                                                                                        (South)(+967)
                                                                                    </option>
                                                                                    <option data-countryCode="TN"
                                                                                            value="216">Tunisia (+216)
                                                                                    </option>
                                                                                    <option data-countryCode="SI"
                                                                                            value="963">Syria (+963)
                                                                                    </option>
                                                                                    <option data-countryCode="SD"
                                                                                            value="249">Sudan (+249)
                                                                                    </option>
                                                                                    <option data-countryCode="DZ"
                                                                                            value="213">Algeria (+213)
                                                                                    </option>
                                                                                    <option data-countryCode="KM"
                                                                                            value="269">Comoros (+269)
                                                                                    </option>
                                                                                    <option data-countryCode="MA"
                                                                                            value="212">Morocco (+212)
                                                                                    </option>
                                                                                </optgroup>
                                                                            </select>
                                                                            <input type="text" class="form-control"
                                                                                   id="phone"
                                                                                   name="phone"
                                                                                   value="{{ old('phone') }}"
                                                                                   aria-describedby="basic-addon1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Email
                                                                        Address</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend"><span
                                                                                        class="input-group-text"><i
                                                                                            class="la la-at"></i></span>
                                                                            </div>
                                                                            <input id="email" type="text"
                                                                                   class="form-control"
                                                                                   value="{{ old('email') }}"
                                                                                   name="email"
                                                                                   aria-describedby="basic-addon1">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Job
                                                                        Title</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input id="title" class="form-control"
                                                                               type="text"
                                                                               name="jobTitle"
                                                                               value="{{ old('jobTitle') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Notes</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input id="note" class="form-control"
                                                                               type="text"
                                                                               name="notes"
                                                                               value="{{ old('notes') }}">
                                                                    </div>
                                                                </div>
                                                                {{--<div class="form-group row">--}}
                                                                {{--<label class="col-xl-3 col-lg-3 col-form-label">Project--}}
                                                                {{--City</label>--}}
                                                                {{--<select id="cityId" name="projectCity"--}}
                                                                {{--class="form-control col-lg-9 col-xl-9">--}}
                                                                {{--<option selected>Select City</option>--}}
                                                                {{--@foreach($cities as $city)--}}
                                                                {{--<option value="{{$city['id']}}">{{$city['name']}}</option>--}}
                                                                {{--@endforeach--}}
                                                                {{--</select>--}}
                                                                {{--</div>--}}

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Interest
                                                                        Project</label>
                                                                    <select id="projectId" name="projectId"
                                                                            class="form-control col-lg-9 col-xl-9">
                                                                        <option selected>Select Project</option>
                                                                        @foreach($projects as $project)
                                                                            <option value="{{$project['id']}}">{{$project['name']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Campaign</label>
                                                                    <select id="campaignId" name="campaignId"
                                                                            class="form-control col-lg-9 col-xl-9">
                                                                        <option value="" selected>Select Campaign
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Marketer</label>
                                                                    <select id="marketerId" name="marketerId"
                                                                            class="form-control col-lg-9 col-xl-9">
                                                                        <option value="" selected>Select Marketer
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Platform</label>
                                                                    <select id="platform" name="platform"
                                                                            class="form-control col-lg-9 col-xl-9">
                                                                        <option selected value="0">Select Platform
                                                                        </option>
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
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Assigned To</label>
                                                                    <select id="saleId" name="assignToSaleManId"
                                                                            class="form-control col-lg-9 col-xl-9">
                                                                        <option selected value="0">Assigned To</option>
                                                                    </select>
                                                                </div>
                                                                {{--<div class="form-group row">--}}
                                                                {{--<label class="col-xl-3 col-lg-3 col-form-label">Gender</label>--}}
                                                                {{--<div class="kt-radio-inline">--}}
                                                                {{--<label class="kt-radio">--}}
                                                                {{--<input type="radio" value="0" name="gender">--}}
                                                                {{--Male--}}
                                                                {{--<span></span>--}}
                                                                {{--</label>--}}
                                                                {{--<label class="kt-radio">--}}
                                                                {{--<input type="radio" value="1" name="gender">--}}
                                                                {{--Female--}}
                                                                {{--<span></span>--}}
                                                                {{--</label>--}}
                                                                {{--</div>--}}
                                                                {{--</div>--}}

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--end: Form Wizard Step 1-->

                                        <!--begin: Form Wizard Step 4-->
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                            <div class="kt-heading kt-heading--md">Review your Details and Submit</div>
                                            <div class="kt-form__section kt-form__section--first">
                                                <div class="kt-wizard-v4__review">
                                                    <div class="kt-wizard-v4__review-item">
                                                        <div class="kt-wizard-v4__review-title">
                                                            Your Account Details
                                                        </div>
                                                        <div class="kt-wizard-v4__review-content">
                                                            <p id="myName"></p>
                                                            <p>Phone: <span id="myPhone"></span></p>
                                                            <p>Email: <span id="myEmail"></span></p>
                                                            <p>Job Title: <span id="myTitle"></span></p>
                                                            <p>Note: <span id="myNote"></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="kt-wizard-v4__review-item">
                                                        <div class="kt-wizard-v4__review-title">
                                                            Interested Information
                                                        </div>
                                                        <div class="kt-wizard-v4__review-content">
                                                            <p>Project: <span id="myProject"></span></p>
                                                            <p>Campaign: <span id="myCampaign"></span></p>
                                                            <p>Marketer: <span id="myMarketer"></span></p>
                                                            <p>Platform: <span id="myPlatform"></span></p>
                                                            <p>AssignTo: <span id="mySale"></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!--end: Form Wizard Step 4-->

                                        <!--begin: Form Actions -->
                                        <div class="kt-form__actions">
                                            <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                                 data-ktwizard-type="action-prev">
                                                Previous
                                            </div>
                                            <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                                 data-ktwizard-type="action-submit">
                                                Submit
                                            </div>
                                            <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                                 data-ktwizard-type="action-next">
                                                Next Step
                                            </div>
                                        </div>

                                        <!--end: Form Actions -->
                                    </form>

                                    <!--end: Form Wizard Form-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end:: Content -->
        </div>

    </div>
    <!-- end:: Page -->
@endsection

@section('script')
    <script> window.HREF = "{{ url('/client-quick-create') }}"; </script>
    <script src="{{url('assets/js/pages/custom/user/add-user.js')}}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function (e) {

            {{--$('#cityId').change(function () {--}}
            {{--$.get(--}}
            {{--"{{ url('api/dropdown')}}",--}}
            {{--{--}}
            {{--option: $(this).val()--}}
            {{--},--}}
            {{--function (data) {--}}
            {{--var projectId = $('#projectId');--}}
            {{--projectId.empty();--}}
            {{--projectId.append("<option value=''> Select Project </option>");--}}
            {{--$.each(data, function (index, element) {--}}
            {{--projectId.append("<option value='" + element.id + "'>" + element.name + "</option>");--}}
            {{--});--}}
            {{--}--}}
            {{--);--}}
            {{--});--}}

            $('#campaignId').change(function () {
                $.get(
                    "{{ url('api/dropdown/marketer')}}",
                    {
                        option: $(this).val()
                    },
                    function (data) {
                        var marketerId = $('#marketerId');
                        marketerId.empty();
                        marketerId.append("<option value=''> Select CampaignMarketer </option>");
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
                        campaignId.append("<option value=''> Select Campaign </option>");
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

