<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="{{url('/')}}">
		<meta charset="utf-8" />
		<title>Achivia App</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Custom Styles(used by this page) -->
		<link href="{{url('assets/css/pages/error/error-6.css')}}" rel="stylesheet" type="text/css" />

		<!--end::Page Custom Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="{{url('assets/plugins/global/plugins.bundle.css" rel="stylesheet')}}" type="text/css" />
		<link href="{{url('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v6" style="background-image: url(assets/media/error/bg6.jpg);">
				<div class="kt-error_container">
					<div class="kt-error_subtitle kt-font-light">
						<h1>Oops...</h1>
					</div>
					<p class="kt-error_description kt-font-light">
						Looks like something went wrong.<br>
						We're working on it
					</p>
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
		<script src="{{url('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
		<script src="{{url('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->
	</body>

	<!-- end::Body -->
</html>