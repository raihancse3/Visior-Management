<div class="sidebar-menu">
  <div class="sidebar-menu-inner">
    
    <header class="logo-env">
      <!-- logo -->
      <div class="logo" style="color: white;font-size: 20px; font-weight: bold;">
        <a href="{{url('dashboard')}}">
          Safe
        </a>
      </div>
      <!-- logo collapse icon -->
      <div class="sidebar-collapse">
        <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
        <i class="entypo-menu">SF</i>
      </a>
    </div>
    
    <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
    <div class="sidebar-mobile-menu visible-xs">
      <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
      <i class="entypo-menu"></i>
    </a>
  </div>
</header>


<ul id="main-menu" class="main-menu">
  <li>
    <a href="{{url('dashboard')}}">
      <i class="entypo-monitor"></i>
      <span class="title">{{ trans('message.menu.dashboard') }}</span>
    </a>
  </li>

  <li>
    <a href="{{url('visitor/movements')}}">
      <i class="entypo-monitor"></i>
      <span class="title">Visitor Logs</span>
    </a>
  </li>

  <!--<li>
    <a href="{{url('vehicle/movements')}}">
      <i class="entypo-monitor"></i>
      <span class="title">Vehicle Logs</span>
    </a>
  </li>  -->

  @if(Helpers::has_permission(Auth::user()->id, 'manage_people'))
  <li class="<?= ( $menu == 'people') ? 'opened active has-sub' : ''?>" >
    <a href="#">
      <i class="entypo-newspaper"></i>
      <span class="title">{{ trans('message.menu.people') }}</span>
    </a>
    <ul>

     @if(Helpers::has_permission(Auth::user()->id, 'manage_visitor'))
      <li <?= isset($sub_menu) && $sub_menu == 'visitor' ? ' class="active"' : ''?> >
        <a href="{{url('visitors')}}">
          <span class="title">Visitors</span>
        </a>
      </li>
      @endif
     @if(Helpers::has_permission(Auth::user()->id, 'manage_driver'))
     <!-- <li <?= isset($sub_menu) && $sub_menu == 'driver' ? ' class="active"' : ''?> >
        <a href="{{url('drivers')}}">
          <span class="title">Drivers</span>
        </a>
      </li>-->
      @endif

      @if(Helpers::has_permission(Auth::user()->id, 'manage_user'))      
      <li <?= isset($sub_menu) && $sub_menu == 'user' ? ' class="active"' : ''?> >
        <a href="{{url('user/list')}}">
          <span class="title">{{ trans('message.menu.users') }}</span>
        </a>
      </li>
      @endif
    </ul>
  </li>
   @endif


@if(Helpers::has_permission(Auth::user()->id, 'manage_setting'))
       <li class="<?= ( $menu == 'setting') ? 'opened active has-sub' : ''?>" >
          <a href="#">
            <i class="entypo-flow-tree"></i>
            <span class="title">{{ trans('message.menu.settings') }}</span>
          </a>
          <ul>
            <li {{ isset($sub_menu) &&  $sub_menu == 'department' ? 'class=active' : ''}}><a href="{{ URL::to("departments")}}">Departments</a>
            </li>

         </ul>
      </li>    
@endif

  @if(Helpers::has_permission(Auth::user()->id, 'manage_role'))
  <li {{ isset($sub_menu) &&  $sub_menu == 'role' ? 'class=active' : ''}}><a href="{{ URL::to("admin/roles")}}">{{ trans('message.menu.user_role') }}</a></li>
  @endif
</ul>

</div>
</div>