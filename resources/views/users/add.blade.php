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
                            {{--</div>--}}
                        </div>

                        <!--end: Form Wizard Nav -->
                        <div class="kt-portlet">
                            <div class="kt-portlet__body kt-portlet__body--fit">
                                <div class="kt-grid">
                                    <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                        <!--begin: Form Wizard Form-->
                                        <form class="kt-form" id="" method="POST" action="{{url('/user-store')}}"
                                              enctype="multipart/form-data">
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

                                                                    <input name="createdBy" hidden class="form-control"
                                                                           type="text" value="{{Auth()->id()}}">

                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                                                        <div class="col-lg-9 col-xl-9">
                                                                            <input id="name" name="name"
                                                                                   class="form-control"
                                                                                   type="text" value="">
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
                                                                                    <option data-countryCode="EG"
                                                                                            value="20" Selected>Egypt
                                                                                        (+20)
                                                                                    </option>
                                                                                    <optgroup label="Other countries">
                                                                                        <option data-countryCode="SA"
                                                                                                value="966">Saudi Arabia
                                                                                            (+966)
                                                                                        </option>
                                                                                        <option data-countryCode="BH"
                                                                                                value="973">Bahrain
                                                                                            (+973)
                                                                                        </option>
                                                                                        <option data-countryCode="IQ"
                                                                                                value="964">Iraq (+964)
                                                                                        </option>
                                                                                        <option data-countryCode="JO"
                                                                                                value="962">Jordan
                                                                                            (+962)
                                                                                        </option>
                                                                                        <option data-countryCode="KW"
                                                                                                value="965">Kuwait
                                                                                            (+965)
                                                                                        </option>
                                                                                        <option data-countryCode="LB"
                                                                                                value="961">Lebanon
                                                                                            (+961)
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
                                                                                                value="216">Tunisia
                                                                                            (+216)
                                                                                        </option>
                                                                                        <option data-countryCode="SI"
                                                                                                value="963">Syria (+963)
                                                                                        </option>
                                                                                        <option data-countryCode="SD"
                                                                                                value="249">Sudan (+249)
                                                                                        </option>
                                                                                        <option data-countryCode="DZ"
                                                                                                value="213">Algeria
                                                                                            (+213)
                                                                                        </option>
                                                                                        <option data-countryCode="KM"
                                                                                                value="269">Comoros
                                                                                            (+269)
                                                                                        </option>
                                                                                        <option data-countryCode="MA"
                                                                                                value="212">Morocco
                                                                                            (+212)
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
                                                                                       value=""
                                                                                       name="email"
                                                                                       aria-describedby="basic-addon1">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                                            Password</label>
                                                                        <div class="col-lg-9 col-xl-9">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend"><span
                                                                                            class="input-group-text"><i
                                                                                                class="la la-at"></i></span>
                                                                                </div>
                                                                                <input id="password" type="password"
                                                                                       class="form-control"
                                                                                       value=""
                                                                                       name="password"
                                                                                       aria-describedby="basic-addon1">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                                            User Photo</label>
                                                                        <div class="col-lg-9 col-xl-9">
                                                                            <div class="kt-avatar kt-avatar--outline"
                                                                                 id="kt_user_avatar_1">
                                                                                <div class="kt-avatar__holder"
                                                                                     style="background-image: url({{url('')}})"></div>
                                                                                <label class="kt-avatar__upload"
                                                                                       data-toggle="kt-tooltip" title=""
                                                                                       data-original-title="Change">
                                                                                    <i class="fa fa-pen"></i>
                                                                                    <input type="file" name="image"
                                                                                           accept=".png, .jpg, .jpeg">
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
                                                                            User Type</label>
                                                                        <select id="roleId" name="roleId"
                                                                                class="form-control col-lg-9 col-xl-9">
                                                                            <option selected value="0">Select Type
                                                                            </option>
                                                                            @foreach($roles as $role)
                                                                                <option value="{{$role['id']}}">{{$role['name']}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="show form-group row hidden">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                                            User Type</label>
                                                                        <select id="teamId" name="teamId"
                                                                                class="form-control col-lg-9 col-xl-9">
                                                                        </select>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--end: Form Wizard Step 1-->

                                            <!--begin: Form Wizard Step 4-->
                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                                <div class="kt-heading kt-heading--md">Review your Details and Submit
                                                </div>
                                                <div class="kt-form__section kt-form__section--first">
                                                    <div class="kt-wizard-v4__review">
                                                        <div class="kt-wizard-v4__review-item">
                                                            <div class="kt-wizard-v4__review-title">
                                                                Your Account Details
                                                            </div>
                                                            <div class="kt-wizard-v4__review-content">
                                                                <p id="myName"></p>
                                                                <p> Phone: <span id="myPhone"></span></p>
                                                                <p>Email: <span id="myEmail"></span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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

                                            <!--end: Form Wizard Step 4-->

                                        {{--<!--begin: Form Actions -->--}}
                                        {{--<div class="kt-form__actions">--}}
                                        {{--<div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"--}}
                                        {{--data-ktwizard-type="action-prev">--}}
                                        {{--Previous--}}
                                        {{--</div>--}}
                                        {{--<div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"--}}
                                        {{--data-ktwizard-type="action-submit">--}}
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
            <script> window.HREF = "{{ url('/home') }}"; </script>
            <script src="{{url('assets/js/pages/custom/user/add-user.js')}}" type="text/javascript"></script>
            <script src="{{url('assets/js/pages/crud/file-upload/ktavatar.js')}}" type="text/javascript"></script>

            <script>
                jQuery(document).ready(function (e) {

                    $('.hidden').hide();

                    $('#roleId').change(function () {
                        var roleId = $('#roleId').val();
                        $.get(
                            "{{ url('api/dropdown/teams')}}",
                            {
                                option: $(this).val()
                            },
                            function (data) {

                                var teamId = $('#teamId');
                                teamId.empty();
                                teamId.append("<option value='0'> Select Team Leader  </option>");
                                $.each(data, function (index, element) {
                                    teamId.append("<option value='" + element.id + "'>" + element.name + "</option>");
                                });
                                if (roleId == 4) {
                                    $('.hidden').show();
                                }else{
                                    $('.hidden').hide();
                                }
                            }
                        );
                    });

                });
            </script>

@endsection

