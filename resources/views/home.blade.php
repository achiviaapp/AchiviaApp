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
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="row row-no-padding row-col-separator-xl">
                        <div class="d-none d-xl-block col-xl-1"></div>
                        <div class="kt-widget1 col-md-12 col-lg-12 col-xl-2 px-4">
                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info w-75">
                                    <h3 class="kt-widget1__title">Total Duplicated</h3>
                                    <span class="kt-widget1__desc">Your Daily Progress</span>
                                    <div class="kt-widget31__progress">
                                        <a href="#" class="kt-widget31__stats">
                                            <span>63%</span>
                                        </a>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <span class="kt-widget1__number kt-font-info">{{ $firstBar['totalDuplicated'] }}</span>
                            </div>
                        </div>
                        <div class="kt-widget1 col-md-12 col-lg-12 col-xl-2 px-4">
                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info w-75">
                                    <h3 class="kt-widget1__title">Total Transferred</h3>
                                    <span class="kt-widget1__desc">Your Daily Progress</span>
                                    <div class="kt-widget31__progress">
                                        <a href="#" class="kt-widget31__stats">
                                            <span>63%</span>
                                        </a>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <span class="kt-widget1__number kt-font-danger">{{ $firstBar['totalTransferred'] }}</span>
                            </div>
                        </div>
                        <div class="kt-widget1 col-md-12 col-lg-12 col-xl-2 px-4">
                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info w-75">
                                    <h3 class="kt-widget1__title">Total Next Today</h3>
                                    <span class="kt-widget1__desc">Your Daily Progress</span>
                                    <div class="kt-widget31__progress">
                                        <a href="#" class="kt-widget31__stats">
                                            <span>63%</span>
                                        </a>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <span class="kt-widget1__number kt-font-success">{{ $firstBar['totalNextToday'] }}</span>
                            </div>
                        </div>
                        <div class="kt-widget1 col-md-12 col-lg-12 col-xl-2 px-4">
                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info w-75">
                                    <h3 class="kt-widget1__title">Total New</h3>
                                    <span class="kt-widget1__desc">Your Daily Progress</span>
                                    <div class="kt-widget31__progress">
                                        <a href="#" class="kt-widget31__stats">
                                            <span>63%</span>
                                        </a>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <span class="kt-widget1__number kt-font-info">{{ $firstBar['totalNew'] }}</span>
                            </div>
                        </div>
                        <div class="kt-widget1 col-md-12 col-lg-12 col-xl-2 px-4">
                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info w-75">
                                    <h3 class="kt-widget1__title">Total Delay</h3>
                                    <span class="kt-widget1__desc">Your Daily Progress</span>
                                    <div class="kt-widget31__progress">
                                        <a href="#" class="kt-widget31__stats">
                                            <span>63%</span>
                                        </a>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <span class="kt-widget1__number kt-font-warning">{{ $firstBar['totalDelay'] }}</span>
                            </div>
                        </div>
                        <div class="d-none d-xl-block col-xl-1"></div>
                        <!--end:: Widgets/Stats2-1 -->
                </div>
            </div>
        </div>

        <div class="row">
        </div>
        
        {{--<div style="height: 750px">--}}
        {{--</div>--}}
        <!--<p>{{ var_dump($firstBar)}}</p>-->
        <p>{{ var_dump($statusBar)}}</p>
        
        <!--<p>{{ var_dump($projectsChartBar)}}</p>
        <p>{{ var_dump($salesChartBar)}}</p>-->

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
