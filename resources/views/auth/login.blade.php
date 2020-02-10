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
    <link href="{{url('assets/css/pages/login/login-6.css')}}" rel="stylesheet" type="text/css"/>
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
    <script src="{{url('assets/plugins/general/sweetalert2/dist/sweetalert2.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/js/global/integration/plugins/sweetalert2.init.js')}}"
        type="text/javascript"></script>
    <style>
            /*Background canvas particals*/
                .particles-js-canvas-el{
                display:block;
                vertical-align:bottom;
                position: absolute;
                top: 0;
                }
                .kt-login.kt-login--v6 .kt-login__aside .kt-login__wrapper{
                        z-index: 100;
                }
    </style>

</head>

<!-- end::Head -->

<!-- begin::Body -->
<body style="overflow-x: hidden;" class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
@if(session()->has('message'))
        <script>
                Swal.fire({
                        text: "{{ session()->get('message') }}",
                        icon: 'info',
                        showCloseButton: true,
                        showCancelButton: false,
                        showConfirmButton: false,
                })
        </script>
@endif

@if ($errors->any())
        <script>
                Swal.fire({
                        title: 'You Got Some Errors!',
                        html: "@foreach ($errors->all() as $error){{ $error }} <br>@endforeach",
                        icon: 'error',
                        showCloseButton: true,
                        showCancelButton: false,
                        showConfirmButton: false,
                })
        </script>
@endif
		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v6 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
					<div class="kt-grid__item kt-grid__item--fluid kt-grid__item--center kt-grid kt-grid--ver kt-login__content" style="background-image: url(assets/media/bg/bg-4.jpg);">
						<div class="kt-login__section">
							<div class="kt-login__block">
								<h3 class="kt-login__title">Join Our Community</h3>
								<div class="kt-login__desc">
									Lorem ipsum dolor sit amet, coectetuer adipiscing
									<br>elit sed diam nonummy et nibh euismod
								</div>
							</div>
						</div>
					</div>


                    <div id="particles-js" class="kt-grid__item  kt-grid__item--order-tablet-and-mobile-2  kt-grid kt-grid--hor kt-login__aside">
						<div class="kt-login__wrapper">
							<div class="kt-login__container">
								<div class="kt-login__body">
									<div class="kt-login__logo">
										<a href="#">
											<img src="{{url('images/favicon.png')}}">
										</a>
									</div>
									<div class="kt-login__signin">
										<div class="kt-login__head">
											<h3 class="kt-login__title">Sign In To Admin</h3>
										</div>
										<div class="kt-login__form">
											<form class="kt-form" id="target" method="POST" action="{{ url('login') }}">
												@csrf
                                                <div class="form-group">
													<input id="email" class="form-control" type="email" placeholder="Email" name="email" autocomplete="on">
												</div>
												<div class="form-group">
													<input id="password" class="form-control" type="password" placeholder="Password" name="password">
												</div>
												<div class="kt-login__extra">
													<label class="kt-checkbox">
														<input type="checkbox" name="remember"> Remember me
														<span></span>
													</label>
													<a href="javascript:;" id="kt_login_forgot">Forget Password ?</a>
												</div>
												<div class="kt-login__actions">
                                                    <button type="submit" class="btn btn-brand btn-pill btn-elevate">
                                                        {{ __('Sign In') }}
                                                    </button>
												</div>
											</form>
										</div>
									</div>
									<div class="kt-login__signup">
										<div class="kt-login__head">
											<h3 class="kt-login__title">Sign Up</h3>
											<div class="kt-login__desc">Enter your details to create your account:</div>
										</div>
										<div class="kt-login__form">
											<form class="kt-form" action="">
												<div class="form-group">
													<input class="form-control" type="text" placeholder="Fullname" name="fullname">
												</div>
												<div class="form-group">
													<input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
												</div>
												<div class="form-group">
													<input class="form-control" type="password" placeholder="Password" name="password">
												</div>
												<div class="form-group">
													<input class="form-control form-control-last" type="password" placeholder="Confirm Password" name="rpassword">
												</div>
												<div class="kt-login__extra">
													<label class="kt-checkbox">
														<input type="checkbox" name="agree"> I Agree the <a href="#">terms and conditions</a>.
														<span></span>
													</label>
												</div>
												<div class="kt-login__actions">
													<button id="kt_login_signup_submit" class="btn btn-brand btn-pill btn-elevate">Sign Up</button>
													<button id="kt_login_signup_cancel" class="btn btn-outline-brand btn-pill">Cancel</button>
												</div>
											</form>
										</div>
									</div>
									<div class="kt-login__forgot">
										<div class="kt-login__head">
											<h3 class="kt-login__title">Forgotten Password ?</h3>
											<div class="kt-login__desc">Enter your email to reset your password:</div>
										</div>
										<div class="kt-login__form">
											<form class="kt-form" method="POST" action="{{ route('password.email') }}">
                                            @csrf
												<div class="form-group">
													<input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
												</div>
												<div class="kt-login__actions">
													<button id="" type="submit" class="btn btn-brand btn-pill btn-elevate">Request</button>
													<button id="kt_login_forgot_cancel" class="btn btn-outline-brand btn-pill">Cancel</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="kt-login__account">
								<!--<span class="kt-login__account-msg">
									Don't have an account yet ?
								</span>&nbsp;&nbsp;
								<a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Sign Up!</a>-->
                                <a href="{{url('/join-to-us')}}" type="button"
                                   class="kt-login__account-link" style="line-height:2.0">
                                    Join To Us
                                </a>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#2c77f4",
						"light": "#ffffff",
						"dark": "#282a3c",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts(used by this page) -->
		<script src="assets/js/pages/custom/login/login-general.js" type="text/javascript"></script>







<!--begin::Global Theme Bundle(used by all pages) -->

<!--begin:: Vendor Plugins -->
<script src="{{url('assets/plugins/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/sticky-js/dist/sticky.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/wnumb/wNumb.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/jquery-form/dist/jquery.form.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/block-ui/jquery.blockUI.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/js/global/integration/plugins/bootstrap-datepicker.init.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/js/global/integration/plugins/bootstrap-timepicker.init.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/bootstrap-daterangepicker/daterangepicker.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/bootstrap-maxlength/src/bootstrap-maxlength.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/plugins/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/bootstrap-select/dist/js/bootstrap-select.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/bootstrap-switch/dist/js/bootstrap-switch.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/js/global/integration/plugins/bootstrap-switch.init.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/ion-rangeslider/js/ion.rangeSlider.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/typeahead.js/dist/typeahead.bundle.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/handlebars/dist/handlebars.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/inputmask/dist/jquery.inputmask.bundle.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/inputmask/dist/inputmask/inputmask.date.extensions.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/nouislider/distribute/nouislider.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/owl.carousel/dist/owl.carousel.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/autosize/dist/autosize.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/clipboard/dist/clipboard.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/dropzone/dist/dropzone.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/js/global/integration/plugins/dropzone.init.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/quill/dist/quill.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/@yaireo/tagify/dist/tagify.polyfills.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/@yaireo/tagify/dist/tagify.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/summernote/dist/summernote.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/markdown/lib/markdown.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/bootstrap-markdown/js/bootstrap-markdown.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/js/global/integration/plugins/bootstrap-markdown.init.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/bootstrap-notify/bootstrap-notify.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/js/global/integration/plugins/bootstrap-notify.init.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/jquery-validation/dist/jquery.validate.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/jquery-validation/dist/additional-methods.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/js/global/integration/plugins/jquery-validation.init.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/toastr/build/toastr.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/dual-listbox/dist/dual-listbox.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/raphael/raphael.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/morris.js/morris.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/chart.js/dist/Chart.bundle.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/plugins/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/plugins/jquery-idletimer/idle-timer.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/general/waypoints/lib/jquery.waypoints.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/counterup/jquery.counterup.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/es6-promise-polyfill/promise.min.js')}}" type="text/javascript"></script>

<script src="{{url('assets/plugins/general/jquery.repeater/src/lib.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/jquery.repeater/src/jquery.input.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/jquery.repeater/src/repeater.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/general/dompurify/dist/purify.js')}}" type="text/javascript"></script>

<!--end:: Vendor Plugins -->
<script src="{{url('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>

<!--begin:: Vendor Plugins for custom pages -->
<script src="{{url('assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/@fullcalendar/core/main.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/@fullcalendar/daygrid/main.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/@fullcalendar/google-calendar/main.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/@fullcalendar/interaction/main.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/@fullcalendar/list/main.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/@fullcalendar/timegrid/main.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/gmaps/gmaps.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/flot/dist/es5/jquery.flot.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/flot/source/jquery.flot.resize.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/flot/source/jquery.flot.categories.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/flot/source/jquery.flot.pie.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/flot/source/jquery.flot.stack.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/flot/source/jquery.flot.crosshair.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/flot/source/jquery.flot.axislabels.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net/js/jquery.dataTables.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/js/global/integration/plugins/datatables.init.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-autofill/js/dataTables.autoFill.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-autofill-bs4/js/autoFill.bootstrap4.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/jszip/dist/jszip.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/pdfmake/build/pdfmake.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/pdfmake/build/vfs_fonts.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-buttons/js/dataTables.buttons.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-buttons/js/buttons.colVis.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-buttons/js/buttons.flash.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-buttons/js/buttons.html5.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-buttons/js/buttons.print.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-colreorder/js/dataTables.colReorder.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-fixedcolumns/js/dataTables.fixedColumns.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-responsive/js/dataTables.responsive.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-rowgroup/js/dataTables.rowGroup.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-rowreorder/js/dataTables.rowReorder.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-scroller/js/dataTables.scroller.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/datatables.net-select/js/dataTables.select.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/jstree/dist/jstree.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/jqvmap/dist/jquery.vmap.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/uppy/dist/uppy.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/tinymce/tinymce.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/tinymce/themes/silver/theme.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/custom/tinymce/themes/mobile/theme.js')}}" type="text/javascript"></script>
<script src="{{url('assets/js/particles.js')}}"></script>
<script src="{{url('assets/js/app.js')}}"></script>

<!--end:: Vendor Plugins for custom pages -->

<!--end::Global Theme Bundle -->


<!--begin::Page Scripts(used by this page) -->
<script src="{{url('assets/js/pages/custom/login/login-general.js')}}" type="text/javascript"></script>

<!--end::Page Scripts -->
<script>
    $(document).ready(function(){
        if (window.ReactNativeWebView) {
            var form = document.getElementById("target");
            var email = document.getElementById('email');
            var password = document.getElementById('password');
            if (credentials.email && credentials.password) {
                email.value = credentials.email;
                password.value = credentials.password;
                form.submit();
            } else {
                // login form on submit
                form.addEventListener(function(){
                    // get credentials from it and send them to mobile app
                    const loginData = {
                        type: 'login',
                        credentials: {
                            email: email.value,
                            password: password.value
                        }
                    };

                    window.ReactNativeWebView.postMessage(JSON.stringify(loginData))
                });
            }
        }
    });
</script>

</body>

<!-- end::Body -->
</html>