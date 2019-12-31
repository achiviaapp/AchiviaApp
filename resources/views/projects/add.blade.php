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
    @if(session()->has('message'))
        <div class="alert alert-danger">
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

    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

            <!-- begin:: Content -->
            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                <div class="kt-wizard-v4" id="kt_user_add_user" data-ktwizard-state="step-first">

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
                                           Project
                                        </div>
                                        <div class="kt-wizard-v4__nav-label-desc">
                                            Project Information
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step">--}}
                                {{--<div class="kt-wizard-v4__nav-body">--}}
                                    {{--<div class="kt-wizard-v4__nav-number">--}}
                                        {{--2--}}
                                    {{--</div>--}}
                                    {{--<div class="kt-wizard-v4__nav-label">--}}
                                        {{--<div class="kt-wizard-v4__nav-label-title">--}}
                                            {{--Review--}}
                                        {{--</div>--}}
                                        {{--<div class="kt-wizard-v4__nav-label-desc">--}}
                                            {{--Review your Details--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>

                    <!--end: Form Wizard Nav -->
                    <div class="kt-portlet">
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-grid">
                                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                    <!--begin: Form Wizard Form-->
                                    <form class="kt-form" id="" method="POST" action="{{url('/project-store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <!--begin: Form Wizard Step 1-->
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                             data-ktwizard-state="current">
                                            <div class="kt-heading kt-heading--md">Project Details:</div>
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Project
                                                                        Name</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input id="" name="name" class="form-control"
                                                                               type="text" value="{{ old('name') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Project Photo</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <div class="kt-avatar kt-avatar--outline"
                                                                             id="kt_user_avatar_1">
                                                                            <div class="kt-avatar__holder"
                                                                                 style="background-image: url({{url('')}})"></div>
                                                                            <label class="kt-avatar__upload"
                                                                                   data-toggle="kt-tooltip" title=""
                                                                                   data-original-title="Change">
                                                                                <i class="fa fa-pen"></i>
                                                                                <input type="file" name="image" accept=".png, .jpg, .jpeg">
                                                                            </label>
                                                                            <span class="kt-avatar__cancel"
                                                                                  data-toggle="kt-tooltip" title=""
                                                                                  data-original-title="Cancel">
														                     <i class="fa fa-times"></i>
													                        </span>
                                                                        </div>
                                                                        <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Project Country
                                                                    </label>
                                                                    <select class="form-control col-lg-9 col-xl-9"
                                                                            name="country" id="country">
                                                                        <option data-countryCode="" value="0">Select
                                                                            Country
                                                                        </option>
                                                                        <option data-countryCode="EG" value="Egypt">
                                                                            Egypt
                                                                        </option>
                                                                        <option data-countryCode="SA"
                                                                                value="Saudi Arabia">Saudi Arabia
                                                                        </option>
                                                                        <option data-countryCode="BH" value="Bahrain">
                                                                            Bahrain
                                                                        </option>
                                                                        <option data-countryCode="IQ" value="Iraq">
                                                                            Iraq
                                                                        </option>
                                                                        <option data-countryCode="JO" value="Jordan">
                                                                            Jordan
                                                                        </option>
                                                                        <option data-countryCode="KW" value="Kuwait">
                                                                            Kuwait
                                                                        </option>
                                                                        <option data-countryCode="LB" value="Lebanon">
                                                                            Lebanon
                                                                        </option>
                                                                        <option data-countryCode="LY" value="Libya">
                                                                            Libya
                                                                        </option>
                                                                        <option data-countryCode="OM" value="Oman">
                                                                            Oman
                                                                        </option>
                                                                        <option data-countryCode="QA" value="Qatar">
                                                                            Qatar
                                                                        </option>
                                                                        <option data-countryCode="AE"
                                                                                value="United Arab Emirates">United Arab
                                                                            Emirates
                                                                        </option>
                                                                        <option data-countryCode="YE" value="Yemen">
                                                                            Yemen
                                                                        </option>
                                                                        <option data-countryCode="TN" value="Tunisia">
                                                                            Tunisia
                                                                        </option>
                                                                        <option data-countryCode="SI" value="Syria">
                                                                            Syria
                                                                        </option>
                                                                        <option data-countryCode="SD" value="Sudan">
                                                                            Sudan
                                                                        </option>
                                                                        <option data-countryCode="DZ" value="Algeria">
                                                                            Algeria
                                                                        </option>
                                                                        <option data-countryCode="KM" value="Comoros">
                                                                            Comoros
                                                                        </option>
                                                                        <option data-countryCode="MA" value="Morocco">
                                                                            Morocco
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Project City</label>
                                                                    <select id="cityId" name="cityId"
                                                                            class="form-control col-lg-9 col-xl-9">
                                                                        <option selected>Select Project City</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Target
                                                                        Location
                                                                    </label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input class="form-control" type="text"
                                                                               name="location"
                                                                               value="{{ old('location') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Project Description</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <div class="input-group">

                                                                            <input type="text" class="form-control"
                                                                                   id=""
                                                                                   name="description"
                                                                                   value="{{ old('description') }}"
                                                                                   aria-describedby="basic-addon1">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-lg-3 col-sm-12">Select
                                                                        Teams </label>
                                                                    <div class=" col-lg-9 col-md-9 col-sm-12">
                                                                        <select class="form-control kt-select2"
                                                                                id="kt_select2_3" name="teams[]"
                                                                                multiple="multiple">
                                                                            @foreach($teams as $team)
                                                                                <option value="{{$team['id']}}">{{$team['name']}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                    {{--<div class="form-group form-group-last row" id="kt_repeater_1">--}}
                                                                        {{--<label class="col-lg-3 col-form-label">Links:</label>--}}

                                                                        {{--<div data-repeater-list="links" class="col-lg-6">--}}
                                                                            {{--<div data-repeater-item class="form-group row align-items-center">--}}
                                                                                {{--<div class="col-md-6">--}}
                                                                                    {{--<div class="kt-form__group--inline">--}}
                                                                                        {{--<div class="kt-form__label">--}}
                                                                                        {{--</div>--}}
                                                                                        {{--<div class="kt-form__control">--}}
                                                                                            {{--<input type="text" class="form-control" placeholder="Link" name="">--}}
                                                                                        {{--</div>--}}
                                                                                    {{--</div>--}}
                                                                                    {{--<div class="d-md-none kt-margin-b-10"></div>--}}
                                                                                {{--</div>--}}

                                                                                {{--<div class="col-md-4">--}}
                                                                                    {{--<a href="javascript:;" data-repeater-delete class="btn-sm btn btn-label-danger btn-bold">--}}
                                                                                        {{--<i class="la la-trash-o"></i>--}}
                                                                                        {{--Delete--}}
                                                                                    {{--</a>--}}
                                                                                {{--</div>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}

                                                                        {{--<div class="form-group col-lg-2">--}}
                                                                            {{--<div class="">--}}
                                                                                {{--<button type="button" data-repeater-create class="btn btn-bold btn-sm btn-label-brand">--}}
                                                                                    {{--<i class="la la-plus"></i> Add--}}
                                                                                {{--</button>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}

                                                                    {{--</div>--}}

                                                                {{--<div class="form-group row">--}}
                                                                {{--<label class="col-xl-3 col-lg-3 col-form-label">--}}
                                                                {{--Campaign</label>--}}
                                                                {{--<select id="campaignId" name="campaignId"--}}
                                                                {{--class="form-control col-lg-9 col-xl-9">--}}
                                                                {{--<option selected>Select Campaign</option>--}}
                                                                {{--</select>--}}
                                                                {{--</div>--}}

                                                                {{--<div class="form-group row">--}}
                                                                {{--<label class="col-xl-3 col-lg-3 col-form-label">--}}
                                                                {{--CampaignMarketer</label>--}}
                                                                {{--<select id="marketerId" name="marketerId"--}}
                                                                {{--class="form-control col-lg-9 col-xl-9">--}}
                                                                {{--<option selected>Select CampaignMarketer</option>--}}
                                                                {{--</select>--}}
                                                                {{--</div>--}}


                                                                {{--<div class="form-group row">--}}
                                                                {{--<label class="col-xl-3 col-lg-3 col-form-label">--}}
                                                                {{--Assigned To</label>--}}
                                                                {{--<select id="saleId" name="assignToSaleManId"--}}
                                                                {{--class="form-control col-lg-9 col-xl-9">--}}
                                                                {{--<option selected>Assigned To</option>--}}
                                                                {{--</select>--}}
                                                                {{--</div>--}}


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="kt-form__actions">
                                                <div class="row">
                                                    <div class="col-lg-9 ml-lg-auto">
                                                        <button type="submit" class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u">Submit</button>
                                                    </div>
                                                </div>
                                            </div>


                                        <!--end: Form Wizard Step 1-->

                                        <!--begin: Form Actions -->
                                        {{--<div class="kt-form__actions">--}}
                                            {{--<div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"--}}
                                                 {{--data-ktwizard-type="action-prev">--}}
                                                {{--Previous--}}
                                            {{--</div>--}}
                                            {{--<div type="submit" class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"--}}
                                                 {{--data-ktwizard-type="">--}}
                                                {{--Submit--}}
                                            {{--</div>--}}
                                            {{--<div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"--}}
                                                 {{--data-ktwizard-type="action-next">--}}
                                                {{--Next Step--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

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
    <script> window.HREF = "{{ url('/') }}"; </script>
    <script src="{{url('assets/js/pages/custom/user/add-user.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/pages/crud/file-upload/ktavatar.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/pages/crud/forms/widgets/select2.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>

    <script>
        jQuery(document).ready(function (e) {

            $('#country').change(function () {
                $.get(
                    "{{ url('api/dropdown/cities')}}",
                    {
                        option: $(this).val()
                    },
                    function (data) {
                        console.log(data);
                        var cityId = $('#cityId');
                        cityId.empty();
                        cityId.append("<option value=''> Select Project City </option>");
                        $.each(data, function (index, element) {
                            cityId.append("<option value='" + element.id + "'>" + element.name + "</option>");
                        });
                    }
                );
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

