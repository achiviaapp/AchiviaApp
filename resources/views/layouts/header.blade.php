<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">

    <!-- begin:: Aside -->
    <div class="kt-header__brand kt-grid__item  " id="kt_header_brand">
        <div class="kt-header__brand-logo">
            <a href="{{url('/')}}">
                <img alt="Logo" src="{{url('images/favicon.png')}}" style="width: 75px"/>
            </a>
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Title -->
    <h3 class="kt-header__title kt-grid__item">
        Achivia App
    </h3>

    <!-- end:: Title -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">

        {{--<!--end: Search -->--}}
        @if(@Auth::user()->role->name != 'client' && @Auth::user()->role->name != 'Ambassador' && @Auth::user()->role->name != 'Visit Dubai')

            <!--begin: Notifications -->
        <div class="kt-header__topbar-item dropdown">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-header__topbar-icon kt-header__topbar-icon--success"><i
                            class="flaticon2-bell-alarm-symbol"></i></span>
                <span class="kt-hidden kt-badge kt-badge--danger"></span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                <form>

                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b"
                         style="background-image: url({{url('assets/media/misc/bg-1.jpg')}})">
                        <h3 class="kt-head__title">My Notifications
                            &nbsp;
                            <span class="btn btn-success btn-sm btn-bold btn-font-md">
                                <a class="nav-link active show" data-toggle="tab" href="{{url('/')}}" role="tab"
                                   aria-selected="true">23 new</a>
                                </span>
                        </h3>

                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-success kt-notification-item-padding-x"
                            role="tablist">
                        </ul>
                    </div>
                    <!--end: Head -->
                    {{--<div class="tab-content">--}}
                    {{--<div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">--}}
                    {{--<div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-line-chart kt-font-success"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New order has been received--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--2 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-box-1 kt-font-brand"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New customer is registered--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--3 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-chart2 kt-font-danger"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--Application has been approved--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--3 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-image-file kt-font-warning"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New file has been uploaded--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--5 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-drop kt-font-info"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New user feedback received--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--8 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-pie-chart-2 kt-font-success"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--System reboot has been successfully completed--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--12 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-favourite kt-font-danger"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New order has been placed--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--15 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item kt-notification__item--read">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-safe kt-font-primary"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--Company meeting canceled--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--19 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-psd kt-font-success"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New report has been received--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--23 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon-download-1 kt-font-danger"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--Finance report has been generated--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--25 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon-security kt-font-warning"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New customer comment recieved--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--2 days ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-pie-chart kt-font-success"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New customer is registered--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--3 days ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">--}}
                    {{--<div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-psd kt-font-success"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New report has been received--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--23 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon-download-1 kt-font-danger"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--Finance report has been generated--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--25 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-line-chart kt-font-success"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New order has been received--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--2 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-box-1 kt-font-brand"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New customer is registered--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--3 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-chart2 kt-font-danger"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--Application has been approved--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--3 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-image-file kt-font-warning"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New file has been uploaded--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--5 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-drop kt-font-info"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New user feedback received--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--8 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-pie-chart-2 kt-font-success"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--System reboot has been successfully completed--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--12 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-favourite kt-font-brand"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New order has been placed--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--15 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item kt-notification__item--read">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-safe kt-font-primary"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--Company meeting canceled--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--19 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-psd kt-font-success"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New report has been received--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--23 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon-download-1 kt-font-danger"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--Finance report has been generated--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--25 hrs ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon-security kt-font-warning"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New customer comment recieved--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--2 days ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="kt-notification__item">--}}
                    {{--<div class="kt-notification__item-icon">--}}
                    {{--<i class="flaticon2-pie-chart kt-font-success"></i>--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-details">--}}
                    {{--<div class="kt-notification__item-title">--}}
                    {{--New customer is registered--}}
                    {{--</div>--}}
                    {{--<div class="kt-notification__item-time">--}}
                    {{--3 days ago--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">--}}
                    {{--<div class="kt-grid kt-grid--ver" style="min-height: 200px;">--}}
                    {{--<div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">--}}
                    {{--<div class="kt-grid__item kt-grid__item--middle kt-align-center">--}}
                    {{--All caught up!--}}
                    {{--<br>No new notifications.--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </form>
            </div>
        </div>

        <!--end: Notifications -->

        <!--begin: Quick actions -->
        <div class="kt-header__topbar-item dropdown">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-header__topbar-icon kt-header__topbar-icon--warning"><i
                            class="flaticon2-gear"></i></span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark"
                         style="background-image: url({{url('assets/media/misc/bg-1.jpg')}})">
                        <h3 class="kt-head__title">
                            Quick Actions
                            <span class="kt-space-15"></span>
                            {{--<span class="btn btn-success btn-sm btn-bold btn-font-md">23 tasks pending</span>--}}
                        </h3>
                    </div>

                    <!--end: Head -->

                    <!--begin: Grid Nav -->
                    <div class="kt-grid-nav kt-grid-nav--skin-light">
                        <div class="kt-grid-nav__row">
                            <a href="{{'/client-create'}}" class="kt-grid-nav__item">
													<span class="kt-grid-nav__icon flaticon-user-add">

                                                    </span>
                                <span class="kt-grid-nav__title">Add New Client</span>

                            </a>
                            <a href="{{'/client-quick-create'}}" class="kt-grid-nav__item">
													<span class="kt-grid-nav__icon flaticon-user-add">
                                                    </span>
                                <span class="kt-grid-nav__title">Quick Add Client</span>
                            </a>
                        </div>
                        <div class="kt-grid-nav__row">
                            <a href="{{'/new-clients'}}" class="kt-grid-nav__item">
													<span class="kt-grid-nav__icon flaticon-user-settings">
                                                    </span>
                                <span class="kt-grid-nav__title">My New Clients</span>
                            </a>
                            <a href="{{'/sending-create'}}" class="kt-grid-nav__item">
													<span class="kt-grid-nav__icon flaticon2-envelope">
                                                    </span>
                                <span class="kt-grid-nav__title">Add Message</span>
                            </a>
                        </div>
                    </div>

                    <!--end: Grid Nav -->
                </form>
            </div>
        </div>
      @endif

    <!--end: Quick actions -->


        <!--begin: User bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-hidden kt-header__topbar-welcome">Hi,</span>
                <span class="kt-hidden kt-header__topbar-username">Nick</span>
                <img class="kt-hidden" alt="Pic" src="{{url('assets/media/users/300_21.jpg')}}"/>
                <span class="kt-header__topbar-icon kt-hidden-"><i class="flaticon2-user-outline-symbol"></i></span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                     style="background-image: url({{url('assets/media/misc/bg-1.jpg')}})">
                    <div class="kt-user-card__avatar">
                        <img class="kt-hidden" alt="Pic" src="{{url('assets/media/users/300_25.jpg')}}"/>

                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success"> {{@substr(Auth::user()->name ,0 ,1)}}</span>
                    </div>
                    <div class="kt-user-card__name">
                        {{@Auth::user()->name}}
                    </div>
                </div>

                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">

                    <div class="kt-notification__custom kt-space-between" aria-labelledby="navbarDropdown">
                        <a class="btn btn-label btn-label-brand btn-sm btn-bold" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            Sign Out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                <!--end: Navigation -->
            </div>
        </div>

        <!--end: User bar -->

    </div>

    <!-- end:: Header Topbar -->
</div>

<!-- end:: Header -->