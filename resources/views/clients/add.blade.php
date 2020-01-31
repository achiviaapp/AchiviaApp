@extends('layouts.app')

@section ('head')
    <link href="{{url('assets/css/pages/wizard/wizard-4.css')}}" rel="stylesheet" type="text/css"/>
@endsection
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
                                            Interested
                                        </div>
                                        <div class="kt-wizard-v4__nav-label-desc">
                                            User's Interested Information
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v4__nav-body">
                                    <div class="kt-wizard-v4__nav-number">
                                        3
                                    </div>
                                    <div class="kt-wizard-v4__nav-label">
                                        <div class="kt-wizard-v4__nav-label-title">
                                            More Details
                                        </div>
                                        <div class="kt-wizard-v4__nav-label-desc">
                                            Customer Questions
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v4__nav-body">
                                    <div class="kt-wizard-v4__nav-number">
                                        4
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
                                          action="{{url('/client-store')}}">
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
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Notes</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input id="note" class="form-control"
                                                                               name="notes"
                                                                               type="text" value="{{old('notes')}}">
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--end: Form Wizard Step 1-->

                                        <!--begin: Form Wizard Step 2-->
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                            <div class="kt-heading kt-heading--md">Setup Your Interested</div>
                                            <div class="kt-form__section kt-form__section--first">
                                                <div class="kt-wizard-v4__form">

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
                                                            <option selected value="">Select Campaign</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            Marketer</label>
                                                        <select id="marketerId" name="marketerId"
                                                                class="form-control col-lg-9 col-xl-9">
                                                            <option selected value="">Select Marketer</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            Platform</label>
                                                        <select id="platform" name="platform"
                                                                class="form-control col-lg-9 col-xl-9">
                                                            <option selected value="0">Select Platform
                                                            </option>
                                                            <option value="Direct Call"> Direct Call</option>
                                                            <option disabled>──────────</option>
                                                            <option value="Facebook Ads"> Facebook Ads</option>
                                                            <option value="Facebook moderation"> Facebook moderation</option>
                                                            <option disabled>──────────</option>
                                                            <option value="Instagram"> Instagram</option>
                                                            <option value="Whatsapp"> Whatsapp</option>
                                                            <option value="Google"> Google</option>
                                                            <option value="Twitter"> Twitter</option>
                                                            <option value="Youtube"> Youtube</option>
                                                            <option value="LinkedIn"> LinkedIn</option>
                                                            <option disabled>──────────</option>
                                                            <option value="SMS campaign"> SMS campaign</option>
                                                            <option value="Email campaign"> Email campaign</option>
                                                            <option value="Website"> Website</option>
                                                            <option value="Event"> Event</option>
                                                            <option disabled>──────────</option>
                                                            <option value="Cold Call"> Cold Call</option>
                                                            <option value="Client referral"> Client referral</option>
                                                            <option value="Personal Referral"> Personal Referral</option>
                                                            <option value="Business Card"> Business Card</option>
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
                                                </div>
                                            </div>
                                        </div>

                                        <!--end: Form Wizard Step 2-->

                                        <!--begin: Form Wizard Step 3-->
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <div class="col-lg-9 col-xl-6">
                                                                        <h3 class="kt-section__title kt-section__title-md">
                                                                            Customer Questions</h3>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Property </label>

                                                                    <select id="property" name="property"
                                                                            class="form-control col-lg-9 col-xl-9">
                                                                        <option selected value="">Select Property</option>
                                                                        <option value="residential"> Residential
                                                                        </option>
                                                                        <option value="commercial"> Commercial</option>
                                                                        <option value="administrative"> Administrative
                                                                        </option>
                                                                        <option value="medical"> Medical</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Property
                                                                        Location</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input id="propertyLocation"
                                                                               class="form-control"
                                                                               name="propertyLocation"
                                                                               type="text"
                                                                               value="{{old('propertyLocation')}}">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Property Utility</label>
                                                                    <select id="propertyUtility" name="propertyUtility"
                                                                            class="form-control col-lg-9 col-xl-9">
                                                                        <option selected value ="">Select Property Utility
                                                                        </option>
                                                                        <option value="personal"> personal use</option>
                                                                        <option value="investment"> investment</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Area</label>
                                                                    <div class="col-lg-4 col-xl-4">
                                                                        <input id="from" class="form-control"
                                                                               name="areaFrom"
                                                                               type="number" value="{{old('areaFrom')}}"
                                                                               placeholder="From">
                                                                    </div>
                                                                    <div class="col-xs-1 col-lg-1  col-lg-offset-1 col-xs-offset-1"></div>
                                                                    <div class="col-lg-4 col-xl-4">
                                                                        <input id="to" class="form-control"
                                                                               name="areaTo"
                                                                               type="number" value="{{old('areaTo')}}"
                                                                               placeholder="To">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Approximate Budget</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input id="budget" class="form-control"
                                                                               name="budget"
                                                                               type="text" value="{{old('budget')}}">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Delivery Date</label>
                                                                    <select id="date" name="deliveryDateId"
                                                                            class="form-control col-lg-9 col-xl-9">
                                                                        <option selected value="">Select Delivery Date
                                                                        </option>
                                                                        @foreach($dates as $date)
                                                                            <option value="{{$date['id']}}">{{$date['name']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Convert
                                                                        to
                                                                        Project 1</label>

                                                                    <select id="projectId" name="convertProject1"
                                                                            class="projectOne form-control col-lg-9 col-xl-9">
                                                                        <option selected value="">Select Project
                                                                        </option>
                                                                        @foreach($projects as $project)
                                                                            <option value="{{$project['id']}}">{{$project['name']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Convert
                                                                        To Project 2
                                                                        Project</label>

                                                                    <select id="projectId" name="convertProject2"
                                                                            class="projectTwo form-control col-lg-9 col-xl-9">
                                                                        <option selected value="">Select Project
                                                                        </option>
                                                                        @foreach($projects as $project)
                                                                            <option value="{{$project['id']}}">{{$project['name']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--end: Form Wizard Step 3-->

                                        <!--begin: Form Wizard Step 4-->
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                            <div class="kt-heading kt-heading--md">Review your Details and Submit</div>
                                            <div class="kt-form__section kt-form__section--first">
                                                <div class="kt-wizard-v4__review">
                                                    <div class="kt-wizard-v4__review-item">
                                                        <div class="kt-wizard-v4__review-title">
                                                            Your Account Details
                                                        </div>
                                                        <input type="text" name="interestsUserProjects" id="interest"
                                                               hidden>

                                                        <div class="kt-wizard-v4__review-content">
                                                            <p> Name: <span id="myName"></span></p>
                                                            <p> Phone: <span id="myPhone"></span></p>
                                                            <p>Email: <span id="myEmail"></span></p>
                                                            <p class="hidden">Job Title: <span id="myTitle"></span></p>
                                                            <p class="hidden">Note: <span id="myNote"></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="kt-wizard-v4__review-item">
                                                        <div class="kt-wizard-v4__review-title">
                                                            Interested Information
                                                        </div>
                                                        <div class="kt-wizard-v4__review-content">
                                                            <p>Project: <span id="myProject"></span></p>
                                                            <p class="hidden">Campaign: <span id="myCampaign"></span>
                                                            </p>
                                                            <p class="hidden">Marketer: <span id="myMarketer"></span>
                                                            </p>
                                                            <p>Platform: <span id="myPlatform"></span></p>
                                                            <p class="hidden">AssignTo: <span id="mySale"></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="kt-wizard-v4__review-item">
                                                        <div class="kt-wizard-v4__review-title">
                                                            Customer Question
                                                        </div>
                                                        <div class="kt-wizard-v4__review-content">
                                                            <p id=""></p>
                                                            <p class="hidden">Property: <span id="myProperty"></span></p>
                                                            <p class="hidden">Property Location: <span id="myPropertyLocation"></span>
                                                            </p>
                                                            <p class="hidden">Property Utility: <span id="myPropertyUtility"></span>
                                                            </p>
                                                            <p class="hidden">Budget: <span id="myBudget"></span></p>
                                                            <p class="hidden">Date: <span id="myDate"></span></p>
                                                            <p class="hidden">Area: <span id="myArea"></span></p>
                                                            <p class="hidden">Convert To Project 1: <span id="myProjectOne"></span></p>
                                                            <p class="hidden">Convert To Project 2: <span id="myProjectTwo"></span></p>

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
    <script> window.HREF = "{{ url('/client-create') }}"; </script>
    <script src="{{url('assets/js/pages/custom/user/add-user.js')}}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function (e) {

            $('#campaignId').change(function () {
                $.get(
                    "{{ url('api/dropdown/marketer')}}",
                    {
                        option: $(this).val()
                    },
                    function (data) {
                        var marketerId = $('#marketerId');
                        marketerId.empty();
                        marketerId.append("<option value=''> Select Marketer </option>");
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

