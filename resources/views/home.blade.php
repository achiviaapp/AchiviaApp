@extends('web.layouts.app')

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <div style="height: 750px">
            <p>{{ var_dump($firstBar)}}</p>
            <p>{{ var_dump($secondBar)}}</p>
        </div>

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
