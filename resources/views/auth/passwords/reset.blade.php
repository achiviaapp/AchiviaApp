<!DOCTYPE html>

<html lang="en">

<!-- begin::Head -->
<head>
    <base href="../../../">
    <meta charset="utf-8"/>
    <title>Login Page</title>
    <meta name="description" content="Login">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{url('assets/css/pages/login/login-2.css')}}" rel="stylesheet" type="text/css"/>

    <!--end::Page Custom Styles -->
    <!--begin::Global Theme Styles(used by all pages) -->

    <!--begin:: Vendor Plugins -->
    <link href="{{url('assets/plugins/general/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/plugins/general/tether/dist/css/tether.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/bootstrap-timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/plugins/general/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/plugins/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/plugins/general/nouislider/distribute/nouislider.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/plugins/general/owl.carousel/dist/assets/owl.carousel.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/plugins/general/owl.carousel/dist/assets/owl.theme.default.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/plugins/general/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/quill/dist/quill.snow.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/@yaireo/tagify/dist/tagify.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/plugins/general/animate.css/animate.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/toastr/build/toastr.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/dual-listbox/dist/dual-listbox.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/morris.js/morris.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/sweetalert2/dist/sweetalert2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/socicon/css/socicon.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/plugins/line-awesome/css/line-awesome.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/plugins/general/plugins/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/plugins/flaticon2/flaticon.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/general/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <!--end:: Vendor Plugins -->
    <link href="{{url('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>

    <!--begin:: Vendor Plugins for custom pages -->
    <link href="{{url('assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/@fullcalendar/core/main.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/@fullcalendar/daygrid/main.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/@fullcalendar/list/main.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/@fullcalendar/timegrid/main.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/plugins/custom/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/datatables.net-autofill-bs4/css/autoFill.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/datatables.net-colreorder-bs4/css/colReorder.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/datatables.net-keytable-bs4/css/keyTable.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/datatables.net-rowreorder-bs4/css/rowReorder.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/datatables.net-scroller-bs4/css/scroller.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/jstree/dist/themes/default/style.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/plugins/custom/jqvmap/dist/jqvmap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/plugins/custom/uppy/dist/uppy.min.css')}}" rel="stylesheet" type="text/css"/>

    <!--end:: Vendor Plugins for custom pages -->

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{url('assets/media/logos/favicon.ico')}}"/>
</head>

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">

    <div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v2 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
             style="background-image: url({{url('assets/media/bg/bg-1.jpg')}});">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper" style="margin:0;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{ __('Reset Password') }}</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="form-group row">
                                            <label for="email"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ $email ?? old('email') }}" required
                                                       autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" required autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control"
                                                       name="password_confirmation" required
                                                       autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Reset Password') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    // reset password page
    if (window.ReactNativeWebView !== undefined) {

        // reset password form on submit
        // get password from it and send it to mobile app
        const resetPasswordData = {
            type: 'reset',
            credentials: {
                password: document.getElementById('password').value
            }
        };
        ReactNativeWebView.postMessage(JSON.stringify(resetPasswordData))
    }
</script>
</body>
