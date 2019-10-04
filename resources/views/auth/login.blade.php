<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Admin Panel" />
        <meta name="author" content="" />
        <link rel="icon" href="{{ asset('public/images/favicon.ico')}}">
        <title>Admin | Login</title>
        <link rel="stylesheet" href="{{ asset('public/asset/css/jquery-ui-1.10.3.custom.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/asset/css/entypo.css')}}">
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
        <link rel="stylesheet" href="{{asset('public/asset/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('public/asset/css/neon-core.css')}}">
        <link rel="stylesheet" href="{{asset('public/asset/css/neon-theme.css')}}">
        <link rel="stylesheet" href="{{asset('public/asset/css/neon-forms.css')}}">
        <link rel="stylesheet" href="{{asset('public/asset/css/custom.css')}}">
        <script src="{{asset('public/asset/js/jquery-1.11.3.min.js')}}"></script>
        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="page-body login-page login-form-fall">
        <!-- This is needed when you send requests via Ajax -->
        <script type="text/javascript">
        var baseurl = "{{url('/')}}";
        </script>
        <div class="login-container">
            
            <div class="login-progressbar">
                <div></div>
            </div>
            
            <div class="login-form">
                
                <div class="login-content">
                    
                    <div class="form-login-error">
                        <h3>Invalid login</h3>
                        <p>Enter <strong>demo</strong>/<strong>demo</strong> as login and password.</p>
                    </div>
                    <h3 style="color:white">Admin | Login</h3>
                    <form method="post" role="form" id="form_logins" action="{{url('/authenticate')}}">
                        {{csrf_field()}}
                        
                        <div class="form-group">
                            
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="entypo-user"></i>
                                </div>
                                
                                <input type="text" class="form-control" name="email" id="email" placeholder="Username" autocomplete="off" value=""/>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="entypo-key"></i>
                                </div>
                                
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" value="" />
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-login">
                            <i class="entypo-login"></i>
                            Login In
                            </button>
                        </div>
                        
                        
                    </form>
                    
                    
                    <div class="login-bottom-links">
                        
                       <!--  <a href="{{url('password/reset')}}" class="link">Forgot your password?</a> -->
                        
                    </div>
                    <div>
                     <!--   <table class="table table-border" style="color: white">
                            <thead>
                                <tr>
                                    <th style="color: white">Email</th>
                                    <th style="color: white">Password</th>
                                    <th style="color: white">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>admin@webtune.org</td>
                                    <td>123456</td>
                                    <td>Admin</td>
                                </tr>
                                <tr>
                                    <td>manager@webtune.org</td>
                                    <td>123456</td>
                                    <td>Manager</td>
                                </tr>

                            </tbody>
                        </table>-->
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        <!-- Bottom scripts (common) -->
        <script src="{{asset('public/asset/js/TweenMax.min.js')}}"></script>
        <script src="{{asset('public/asset/js//jquery-ui-1.10.3.minimal.min.js')}}"></script>
        <script src="{{asset('public/asset/js/bootstrap.js')}}"></script>
        <script src="{{asset('public/asset/js/joinable.js')}}"></script>
        <script src="{{asset('public/asset/js/resizeable.js')}}"></script>
        <script src="{{asset('public/asset/js/neon-api.js')}}"></script>
        <script src="{{asset('public/asset/js/jquery.validate.min.js')}}"></script>
        <script src="{{asset('public/asset/js/neon-login.js')}}"></script>
        <!-- JavaScripts initializations and stuff -->
        <script src="{{asset('public/asset/js/neon-custom.js')}}"></script>
        <!-- Demo Settings -->
        <script src="{{asset('public/asset/js/neon-demo.js')}}"></script>
    </body>
</html>