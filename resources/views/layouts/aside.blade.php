
<!-- begin:: Aside -->
	<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
		<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
			<!-- begin:: Aside -->
			<div class="kt-aside__brand kt-grid__item  " id="kt_aside_brand">
				<div class="kt-aside__brand-logo">
					<a href="{{url('/')}}">
						<img alt="Logo" src="{{url('images/favicon.png')}}" />
					</a>
				</div>
			</div>
			<!-- end:: Aside -->

    @if(@Auth::user()->role->name != 'client')
    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
		<div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
			<ul class="kt-menu__nav ">
                <li class="kt-menu__item" aria-haspopup="true"><a href="{{url('/')}}" class="kt-menu__link"><i
                                class="kt-menu__link-icon flaticon2-protection"></i><span class="kt-menu__link-text">Dashboard</span></a>
                </li>
                <li class="kt-menu__item" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                                class="kt-menu__link-icon flaticon2-group"><span></span></i><span
                                class="kt-menu__link-text">Add Clients</span><i
                                class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                        href="{{url('client-create')}}" class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon-user-add"><span></span></i><span
                                            class="kt-menu__link-text">Add New Client</span></a>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                        href="{{url('client-quick-create')}}" class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon-upload-1"><span></span></i><span
                                            class="kt-menu__link-text">Quick Add Clients</span></a>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                        href="{{url('client-upload-view')}}" class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon-upload-1"><span></span></i><span
                                            class="kt-menu__link-text">Upload Clients</span></a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                                class="kt-menu__link-icon flaticon-settings-1"><span></span></i><span
                                class="kt-menu__link-text">Clients Status</span><i
                                class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @if(@Auth::user()->role->name == 'admin' || @Auth::user()->role->name == 'root')
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('new-requests')}}"
                                                                                   class="kt-menu__link "><i
                                                class="kt-menu__link-bullet kt-menu__link-icon flaticon2-group"><span></span></i><span
                                                class="kt-menu__link-text">New Requests</span></a></li>
                            @endif
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('new-clients')}}"
                                                                               class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon2-group"><span></span></i><span
                                            class="kt-menu__link-text">My New Clients</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('duplicated-clients')}}"
                                                                               class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon2-group"><span></span></i><span
                                            class="kt-menu__link-text">Duplicated Requests</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('transfered-clients')}}"
                                                                               class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon2-group"><span></span></i><span
                                            class="kt-menu__link-text">Re Assigned</span></a></li>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-sm"></div>
                            @foreach($list as $one)
                                @if($one['order'] == 9)
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-sm"></div>
                                    <li class="kt-menu__item " aria-haspopup="true"><a
                                                href="{{url('action-client/' . $one['id'])}}"
                                                class="kt-menu__link "><i
                                                    class="kt-menu__link-bullet kt-menu__link-icon flaticon-avatar"><span></span></i><span
                                                    class="kt-menu__link-text">{{$one['name']}}</span></a>
                                    </li>
                                @else
                                    <li class="kt-menu__item " aria-haspopup="true"><a
                                                href="{{url('action-client/' . $one['id'])}}"
                                                class="kt-menu__link "><i
                                                    class="kt-menu__link-bullet kt-menu__link-icon flaticon-avatar"><span></span></i><span
                                                    class="kt-menu__link-text">{{$one['name']}}</span></a>
                                    </li>
                                @endif
                            @endforeach

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-sm"></div>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('all-clients')}}"
                                                                               class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon2-group"><span></span></i><span
                                            class="kt-menu__link-text">All Clients</span></a></li>

                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                                class="kt-menu__link-icon  flaticon-calendar"></i><span
                                class="kt-menu__link-text">Calendar</span><span
                                class="kt-menu__link-badge"></span><i
                                class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                        class="kt-menu__link"><span
                                            class="kt-menu__link-text">Calendar</span><span
                                            class="kt-menu__link-badge"><span
                                                class="kt-badge kt-badge--brand"></span></span></span></li>
                            {{--<li class="kt-menu__item " aria-haspopup="true"><a href="{{url('hot-data')}}" class="kt-menu__link "><i--}}
                                            {{--class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span--}}
                                            {{--class="kt-menu__link-text">Hot ToDo </span></a></li>--}}
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('todo-hot-data')}}" class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                            class="kt-menu__link-text">Hot ToDo </span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('todo-data')}}" class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                            class="kt-menu__link-text">VIP ToDo </span></a></li>
                        </ul>
                    </div>
                </li>
                @if(@Auth::user()->role->name == 'admin' || @Auth::user()->role->name == 'root')
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                        data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                                    class="kt-menu__link-icon  flaticon2-calendar-6"></i><span
                                    class="kt-menu__link-text">Reports</span><span
                                    class="kt-menu__link-badge"></span><i
                                    class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                            class="kt-menu__link"><span class="kt-menu__link-text">Reports</span><span
                                                class="kt-menu__link-badge"><span
                                                    class="kt-badge kt-badge--brand"></span></span></span></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a
                                            href="{{url('all-reports/'.Auth()->id())}}" class="kt-menu__link "><i
                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                class="kt-menu__link-text">All Reports</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a
                                            href="{{url('team-report/'.Auth()->id())}}" class="kt-menu__link "><i
                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                class="kt-menu__link-text">Team Report</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a
                                            href="{{url('sale-man-report/'.Auth()->id())}}" class="kt-menu__link "><i
                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                class="kt-menu__link-text">SaleMan Report</span></a></li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if(@Auth::user()->role->name == 'admin' || @Auth::user()->role->name == 'root')
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                        data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                                    class="kt-menu__link-icon  flaticon-statistics"></i><span
                                    class="kt-menu__link-text">Statistic</span><span
                                    class="kt-menu__link-badge"></span><i
                                    class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                            class="kt-menu__link"><span
                                                class="kt-menu__link-text">Statistics</span><span
                                                class="kt-menu__link-badge"><span
                                                    class="kt-badge kt-badge--brand"></span></span></span></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><i
                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                class="kt-menu__link-text">SalesMen Statistic</span></a></li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if(@Auth::user()->role->name == 'admin' || @Auth::user()->role->name == 'root')
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                        data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                                    class="kt-menu__link-icon flaticon-settings-1"></i><span class="kt-menu__link-text">Root Panel</span><span
                                    class="kt-menu__link-badge"></span><i
                                    class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                            class="kt-menu__link"><span
                                                class="kt-menu__link-text">Root Panel</span><span
                                                class="kt-menu__link-badge"><span
                                                    class="kt-badge kt-badge--brand"></span></span></span></li>

                                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                                          class="kt-menu__link kt-menu__toggle"><i
                                                class="kt-menu__link-bullet kt-menu__link-icon flaticon2-group"><span></span></i><span
                                                class="kt-menu__link-text">Users</span><i
                                                class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item " aria-haspopup="true"><a
                                                        href="{{url('user-create')}}"
                                                        class="kt-menu__link "><i
                                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon-user-add"><span></span></i><span
                                                            class="kt-menu__link-text">Add User</span></a></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/users')}}"
                                                                                               class="kt-menu__link "><i
                                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon-eye"><span></span></i><span
                                                            class="kt-menu__link-text">view Users</span></a></li>
                                        </ul>
                                    </div>
                                </li>

                                {{--<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"--}}
                                {{--data-ktmenu-submenu-toggle="hover"><a href="javascript:;"--}}
                                {{--class="kt-menu__link kt-menu__toggle"><i--}}
                                {{--class="kt-menu__link-bullet  kt-menu__link-icon flaticon-list-1"><span></span></i><span--}}
                                {{--class="kt-menu__link-text">Project Cities</span><i--}}
                                {{--class="kt-menu__ver-arrow la la-angle-right"></i></a>--}}
                                {{--<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>--}}
                                {{--<ul class="kt-menu__subnav">--}}
                                {{--<li class="kt-menu__item " aria-haspopup="true"><a--}}
                                {{--href="{{url('city-create')}}" class="kt-menu__link "><i--}}
                                {{--class="kt-menu__link-bullet kt-menu__link-icon flaticon-plus"><span></span></i><span--}}
                                {{--class="kt-menu__link-text">Add Project City</span></a></li>--}}
                                {{--<li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/cities')}}"--}}
                                {{--class="kt-menu__link "><i--}}
                                {{--class="kt-menu__link-bullet kt-menu__link-icon flaticon-eye"><span></span></i><span--}}
                                {{--class="kt-menu__link-text">view Project Cities</span></a></li>--}}
                                {{--</ul>--}}
                                {{--</div>--}}
                                {{--</li>--}}

                                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                                          class="kt-menu__link kt-menu__toggle"><i
                                                class="kt-menu__link-bullet  kt-menu__link-icon flaticon-list-1"><span></span></i><span
                                                class="kt-menu__link-text">projects</span><i
                                                class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item " aria-haspopup="true"><a
                                                        href="{{url('project-create')}}" class="kt-menu__link "><i
                                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon-plus"><span></span></i><span
                                                            class="kt-menu__link-text">Add Project</span></a></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a
                                                        href="{{url('/projects')}}"
                                                        class="kt-menu__link "><i
                                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon-eye"><span></span></i><span
                                                            class="kt-menu__link-text">view Projects</span></a></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a
                                                        href="{{url('/add-sub-project')}}"
                                                        class="kt-menu__link "><i
                                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon-eye"><span></span></i><span
                                                            class="kt-menu__link-text">Add Sub Projects</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                                          class="kt-menu__link kt-menu__toggle"><i
                                                class="kt-menu__link-bullet  kt-menu__link-icon flaticon2-group"><span></span></i><span
                                                class="kt-menu__link-text">Teams</span><i
                                                class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item " aria-haspopup="true"><a
                                                        href="{{url('team-create')}}"
                                                        class="kt-menu__link "><i
                                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon-plus"><span></span></i><span
                                                            class="kt-menu__link-text">Add Team</span></a></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/teams')}}"
                                                                                               class="kt-menu__link "><i
                                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon-eye"><span></span></i><span
                                                            class="kt-menu__link-text">view Teams</span></a></li>

                                        </ul>
                                    </div>
                                </li>

                                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                                          class="kt-menu__link kt-menu__toggle"><i
                                                class="kt-menu__link-bullet  kt-menu__link-icon flaticon-list-1"><span></span></i><span
                                                class="kt-menu__link-text">Sending Message</span><i
                                                class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item " aria-haspopup="true"><a
                                                        href="{{url('sending-create')}}" class="kt-menu__link "><i
                                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon-plus"><span></span></i><span
                                                            class="kt-menu__link-text">Add message</span></a></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a
                                                        href="{{url('/sending')}}"
                                                        class="kt-menu__link "><i
                                                            class="kt-menu__link-bullet kt-menu__link-icon flaticon-eye"><span></span></i><span
                                                            class="kt-menu__link-text">view messages</span></a></li>
                                        </ul>
                                    </div>
                                </li>

                                @endif



                                {{--<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"--}}
                                {{--data-ktmenu-submenu-toggle="hover"><a href="javascript:;"--}}
                                {{--class="kt-menu__link kt-menu__toggle"><i--}}
                                {{--class="kt-menu__link-bullet  kt-menu__link-icon flaticon-settings-1"><span></span></i><span--}}
                                {{--class="kt-menu__link-text">Actions</span><i--}}
                                {{--class="kt-menu__ver-arrow la la-angle-right"></i></a>--}}
                                {{--<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>--}}
                                {{--<ul class="kt-menu__subnav">--}}
                                {{--<li class="kt-menu__item " aria-haspopup="true"><a--}}
                                {{--href="{{url('action-create')}}" class="kt-menu__link "><i--}}
                                {{--class="kt-menu__link-bullet kt-menu__link-icon flaticon-plus"><span></span></i><span--}}
                                {{--class="kt-menu__link-text">Add Action</span></a></li>--}}
                                {{--<li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/actions')}}"--}}
                                {{--class="kt-menu__link "><i--}}
                                {{--class="kt-menu__link-bullet kt-menu__link-icon flaticon-eye"><span></span></i><span--}}
                                {{--class="kt-menu__link-text">view Actions</span></a></li>--}}
                                {{--</ul>--}}
                                {{--</div>--}}
                                {{--</li>--}}

                                {{--<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"--}}
                                {{--data-ktmenu-submenu-toggle="hover"><a href="javascript:;"--}}
                                {{--class="kt-menu__link kt-menu__toggle"><i--}}
                                {{--class="kt-menu__link-bullet  kt-menu__link-icon flaticon-list-1"><span></span></i><span--}}
                                {{--class="kt-menu__link-text">Methods</span><i--}}
                                {{--class="kt-menu__ver-arrow la la-angle-right"></i></a>--}}
                                {{--<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>--}}
                                {{--<ul class="kt-menu__subnav">--}}
                                {{--<li class="kt-menu__item " aria-haspopup="true"><a--}}
                                {{--href="{{url('method-create')}}" class="kt-menu__link "><i--}}
                                {{--class="kt-menu__link-bullet kt-menu__link-icon flaticon-plus"><span></span></i><span--}}
                                {{--class="kt-menu__link-text">Add Method</span></a></li>--}}
                                {{--<li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/methods')}}"--}}
                                {{--class="kt-menu__link "><i--}}
                                {{--class="kt-menu__link-bullet kt-menu__link-icon flaticon-eye"><span></span></i><span--}}
                                {{--class="kt-menu__link-text">view Methods</span></a></li>--}}

                                {{--</ul>--}}
                                {{--</div>--}}
                                {{--</li>--}}

                            </ul>
                        </div>
                    </li>

            </ul>
        </div>
    </div>
@endif

    <!-- end:: Aside Menu -->
</div>

<!-- end:: Aside -->