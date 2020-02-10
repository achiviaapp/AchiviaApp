@extends('web.layouts.app')

@section('content')

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

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">

                <!--begin:: Widgets/Trends-->
                <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
                    <div class="kt-portlet__head kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Trends
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(31px, 32px, 0px);">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                <span class="kt-nav__link-text">Reports</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-send"></i>
                                                <span class="kt-nav__link-text">Messages</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                <span class="kt-nav__link-text">Charts</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                <span class="kt-nav__link-text">Members</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                <span class="kt-nav__link-text">Settings</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fluid kt-portlet__body--fit">
                        <div class="kt-widget4 kt-widget4--sticky">
                            <div class="kt-widget4__chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="kt_chart_trends_stats" style="height: 240px; display: block; width: 430px;" width="537" height="300" class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="kt-widget4__items kt-widget4__items--bottom kt-portlet__space-x kt-margin-b-20">
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__img kt-widget4__img--logo">
                                        <img src="assets/media/client-logos/logo3.png" alt="">
                                    </div>
                                    <div class="kt-widget4__info">
                                        <a href="#" class="kt-widget4__title">
                                            Phyton
                                        </a>
                                        <span class="kt-widget4__sub">
                                            A Programming Language
                                        </span>
                                    </div>
                                    <span class="kt-widget4__ext">
                                        <span class="kt-widget4__number kt-font-danger">+$17</span>
                                    </span>
                                </div>
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__img kt-widget4__img--logo">
                                        <img src="assets/media/client-logos/logo1.png" alt="">
                                    </div>
                                    <div class="kt-widget4__info">
                                        <a href="#" class="kt-widget4__title">
                                            FlyThemes
                                        </a>
                                        <span class="kt-widget4__sub">
                                            A Let's Fly Fast Again Language
                                        </span>
                                    </div>
                                    <span class="kt-widget4__ext">
                                        <span class="kt-widget4__number kt-font-danger">+$300</span>
                                    </span>
                                </div>
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__img kt-widget4__img--logo">
                                        <img src="assets/media/client-logos/logo2.png" alt="">
                                    </div>
                                    <div class="kt-widget4__info">
                                        <a href="#" class="kt-widget4__title">
                                            AirApp
                                        </a>
                                        <span class="kt-widget4__sub">
                                            Awesome App For Project Management
                                        </span>
                                    </div>
                                    <span class="kt-widget4__ext">
                                        <span class="kt-widget4__number kt-font-danger">+$6700</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Trends-->
            </div>
        </div>
        <div style="height: 750px">
            <p>{{ var_dump($firstBar)}}</p>
            <p>{{ var_dump($secondBar)}}</p>
        </div>
        {{--<div style="height: 750px">--}}
            {{--<p>{{ var_dump($firstBar)}}</p>--}}
            {{--<p>{{ var_dump($secondBar)}}</p>--}}
        {{--</div>--}}

    </div>

@endsection

@section('script')
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{url('assets/js/pages/components/charts/morris-charts.js')}}" type="text/javascript"></script>
    <!--begin::Page Vendors(used by this page) -->
    <script src="//www.google.com/jsapi" type="text/javascript"></script>

    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{url('assets/js/pages/components/charts/google-charts.js')}}" type="text/javascript"></script>

    <script>
        jQuery(document).ready(function (e) {
            function initNotification() {
                if (!window.isMobile) return;
                if (!window.FCMToken) return;

                $.get(
                    "{{ url('api/mobile-data')}}",
                    {
                        device_id: window.FCMToken
                    },
                    function (data) {
                        console.log(data);
                    }
                );
            }

            initNotification();
        });
    </script>
    <!--end::Page Scripts -->
@endsection
