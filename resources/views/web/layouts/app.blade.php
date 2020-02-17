<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("web.layouts.head")

@yield('head')

<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
    @include("web.layouts.headerMobile")
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            @include("web.layouts.aside")
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                @include("web.layouts.header")

                @yield('content')

                @include("layouts.footer")
            </div>

            @include("web.layouts.scripts")

            @yield('script')
        </div>
    </div>
</div>
</body>
</html>


