 <div class="row">
     <?php
        if(!empty(Auth::user()->picture)) {
          $userProfile = Auth::user()->picture; 
        }
    ?>               
                
    <div class="col-md-6 col-sm-8 clearfix">
        
        <ul class="user-info pull-left pull-none-xsm">
            
            <!-- Profile Info -->
            <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
           
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if(!empty($userProfile))
              <img src='{{url("public/uploads/user/$userProfile")}}' class="img-circle" width="80">
            @else
              <img src='{{url("public/uploads/user/avatar.jpg")}}' class="img-circle" width="80">
            @endif 

            {{Auth::user()->name}}

            </a>

            <ul class="dropdown-menu">
                
                <!-- Reverse Caret -->
                <li class="caret"></li>
                
                <!-- Profile sub-links -->
                <li>
                    <a href="{{url('edit/current-user')}}">
                        <i class="entypo-user"></i>
                        Edit Profile
                    </a>
                </li>
                
            </ul>
        </li>
        
    </ul>

    
</div>           
            <!-- Raw Links -->
            <div class="col-md-6 col-sm-4 clearfix hidden-xs">
                
                <ul class="list-inline links-list pull-right">
                
                    
                    
                    <li class="sep"></li>
                    
                    <li>
                        <a href="{{url('logout')}}">
                            Log Out <i class="entypo-logout right"></i>
                        </a>
                    </li>
                </ul>
                
            </div>
            
        </div>