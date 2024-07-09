<div id="menu-main" class="menu menu-box-right menu-box-detached rounded-m" data-menu-width="260"z data-menu-active="nav-welcome" data-menu-effect="menu-over" style="display: block; width: 260px;">
  <div class="menu-header">
    <a href="#" data-menu="menu-main" class="border-right-0" style="border-color: transparent;"></a>
    <a href="#"  class="border-right-0" style="border-color: transparent;"></a>
    <a href="#"  class="border-right-0" style="border-color: transparent;"></a>
    <a href="#" class="border-right-0" style="border-color: transparent;"></a>
    <a href="#" class="close-menu border-right-0" style="border-color: transparent;"><i class="fa font-12 color-red-dark fa-times"></i></a>
  </div>

  <div class="menu-logo text-center">
      
      <a href="#">
          @if(Auth::guard('customer')->user()->profile)
          <img class="rounded-circle bg-highlight" width="80" src="{{asset('uploads/customer')}}/{{Auth::guard('customer')->user()->profile}}">
          @else
          <img class="rounded-circle bg-highlight" width="80" src="{{ url('public/images/avatars/5s.png') }}">
          @endif
          </a>
      
    @if(Auth::guard('customer')->user())
      <h1 class="pt-3 font-800 font-28 text-uppercase">{{Auth::guard('customer')->user()->username}}</h1>
      @else
      <h1 class="pt-3 font-800 font-28 text-uppercase">{{ __('messages.Pojecttitle') }}</h1>
      @endif
  </div>

  <div class="menu-items mb-4">
      
      <a id="nav-welcome" href="{{ route('field-executive.dashboard')}}">
          <span>{{ __('messages.menu1') }}</span>
          <i class="fa fa-circle"></i>
      </a>
      @if(Auth::guard('customer')->user())
      <a id="nav-pages" href="{{ route('field-executive.logout')}}">
          <span>Logout</span>
          <i class="fa fa-circle"></i>
      </a>
      @endif
  </div>

  <div class="text-center">
  </div>
</div>
