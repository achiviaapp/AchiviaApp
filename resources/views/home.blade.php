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
        <div class="row justify-content-center">
            <div class="col-6 col-md-2">
                <div class="card bg-success text-white">
                    <div class="card-body">Success card</div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card bg-danger text-white">
                    <div class="card-body">Success card</div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card bg-info text-white">
                    <div class="card-body">Success card</div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card bg-primary text-white">
                    <div class="card-body">Success card</div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card bg-warning text-white">
                    <div class="card-body">Success card</div>
                </div>
            </div>
            
        </div>

        <div class="row">
        </div>
        
        {{--<div style="height: 750px">--}}
        {{--</div>--}}
        <p>{{ var_dump($firstBar)}}</p>
        <p>{{ var_dump($statusBar)}}</p>
        <p>{{ var_dump($projectsChartBar)}}</p>
        <p>{{ var_dump($salesChartBar)}}</p>

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
