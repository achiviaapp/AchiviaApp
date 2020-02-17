@extends('layouts.app')
<!--begin::Page Custom Styles(used by this page) -->

@section('head')
    <link href="{{url('assets/css/pages/wizard/wizard-4.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .alert {
            display: block !important;
        }
    </style>
@endsection
<!--end::Page Custom Styles -->
@section('content')

    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

            <!-- begin:: Content -->
            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                <div class="kt-wizard-v4" id="kt_user_add_user" data-ktwizard-state="step-first">
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
                        </div>
                    </div>

                    <!--end: Form Wizard Nav -->
                    <div class="kt-portlet">
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-grid">
                                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                    <!--begin: Form Wizard Form-->
                                    <form class="kt-form" id="" method="POST" action="{{url('project-custom-store')}}"
                                          enctype="multipart/form-data">
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
                                                                    <label class="col-form-label col-lg-3 col-sm-12">
                                                                        Project </label>
                                                                    <div class=" col-lg-9 col-md-9 col-sm-12">
                                                                        <input id="" name="projectId"
                                                                               class="form-control"
                                                                               type="text"
                                                                               value="{{$project['id']}}" hidden>

                                                                        <input id="" name=""
                                                                               class="form-control"
                                                                               type="text"
                                                                               value="{{$project['name']}}" disabled>

                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">

                                                                        Campaign Name</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input id="" name="name" class="form-control"
                                                                               type="text" value="{{ old('name') }}">
                                                                    </div>
                                                                </div>


                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">

                                                                        Campaign Description</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input id="" name="description"
                                                                               class="form-control"
                                                                               type="text"
                                                                               value="{{ old('description') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-lg-3">Select
                                                                        Marketers </label>
                                                                    <div class="col-lg-9 col-md-9">
                                                                        <select class="form-control kt-select2"
                                                                                id="kt_select2_3" name="marketers[]"
                                                                                multiple="multiple">
                                                                            <option value="">Select Marketers</option>
                                                                            @foreach($marketers as $marketer)
                                                                                <option value="{{$marketer['id']}}">{{$marketer['name']}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-lg-3">
                                                                        Links </label>
                                                                    <span class="col-lg-4">{{ url('/') }}</span>

                                                                    <div class="col-lg-5 col-md-5">

                                                                        <input id="" name="link"
                                                                               class="form-control" type="text"
                                                                               value="">
                                                                    </div>

                                                                </div>
                                                                {{--<div class="form-group row">--}}
                                                                    {{--<label class="col-form-label col-lg-3">--}}
                                                                        {{--Links </label>--}}
                                                                    {{--<span class="col-lg-4">{{ url('/') }}</span>--}}

                                                                    {{--<div class="col-lg-5 col-md-5">--}}

                                                                        {{--<input id="" name="links[]"--}}
                                                                               {{--class="form-control" type="text"--}}
                                                                               {{--value="">--}}
                                                                    {{--</div>--}}

                                                                {{--</div>--}}
                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-lg-3">
                                                                        Platform </label>
                                                                    <select id="platform" name="platform"
                                                                            class="form-control col-lg-9 col-xl-9">
                                                                        <option selected value="0">Select Platform
                                                                        </option>
                                                                        <option value="DirectCall"> Direct Call</option>
                                                                        <option disabled>──────────</option>
                                                                        <option value="FacebookAds"> Facebook Ads
                                                                        </option>
                                                                        <option value="Facebookmoderation"> Facebook
                                                                            moderation
                                                                        </option>
                                                                        <option disabled>──────────</option>
                                                                        <option value="Instagram"> Instagram</option>
                                                                        <option value="Whatsapp"> Whatsapp</option>
                                                                        <option value="Google"> Google</option>
                                                                        <option value="Twitter"> Twitter</option>
                                                                        <option value="Youtube"> Youtube</option>
                                                                        <option value="LinkedIn"> LinkedIn</option>
                                                                        <option disabled>──────────</option>
                                                                        <option value="SMScampaign"> SMS campaign
                                                                        </option>
                                                                        <option value="Emailcampaign"> Email campaign
                                                                        </option>
                                                                        <option value="Website"> Website</option>
                                                                        <option value="Event"> Event</option>
                                                                        <option disabled>──────────</option>
                                                                        <option value="ColdCall"> Cold Call</option>
                                                                        <option value="Clientreferral"> Client
                                                                            referral
                                                                        </option>
                                                                        <option value="PersonalReferral"> Personal
                                                                            Referral
                                                                        </option>
                                                                        <option value="BusinessCard"> Business Card
                                                                        </option>

                                                                    </select>
                                                                </div>

                                                                <hr>
                                                                <div class="kt-heading kt-heading--md">Landing Page
                                                                    Detail:
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Landing Page Template</label>
                                                                    <div class="col-lg-9 col-md-9">
                                                                        <select class="form-control"
                                                                                name="templateName">
                                                                            <option value="">Select LandingPage</option>

                                                                            <option value="classic_landing">Classic
                                                                                Landing Page
                                                                            </option>
                                                                            <option value="default_landing">Default
                                                                                Landing Page
                                                                            </option>
                                                                            <option value="advanced_landing">Advanced
                                                                                Landing Page
                                                                            </option>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="kt-heading kt-heading--md">Landing Page
                                                                    Content:
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                    Article
                                                                    </label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input id="" name="article" class="form-control"
                                                                               type="text" value="">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{----}}
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-lg-9 ml-lg-auto">
                                                    <button type="submit"
                                                            class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u">
                                                        Submit
                                                    </button>
                                                </div>
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
    <script> window.HREF = "{{ url('/') }}"; </script>
    <script src="{{url('assets/js/pages/crud/file-upload/ktavatar.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/pages/crud/forms/widgets/select2.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/pages/custom/user/add-project-detail.js')}}" type="text/javascript"></script>

@endsection

