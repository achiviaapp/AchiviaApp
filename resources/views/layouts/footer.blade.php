<!-- begin:: Footer -->
<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-footer__copyright">
            2019&nbsp;&copy;&nbsp;<a href="{{url('/')}}" target="_blank" class="kt-link">Achivia App</a>
        </div>
        <div class="kt-footer__menu">
            <a href="{{url('/')}}" target="_blank" class="kt-footer__menu-link kt-link">Home</a>
            @if(@Auth::user()->role->name != 'client' && @Auth::user()->role->name != 'Ambassador' && @Auth::user()->role->name != 'Visit Dubai')
            <a href="{{url('/client-create')}}" target="_blank" class="kt-footer__menu-link kt-link">Add New Client</a>
            <a href="{{url('/client-quick-create')}}" target="_blank" class="kt-footer__menu-link kt-link">Quick Add Client</a>
      @endif
        </div>
    </div>
</div>

<!-- end:: Footer -->
