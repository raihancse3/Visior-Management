<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Neon Admin Panel" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="assets/images/favicon.ico">
        <title> {{isset($header) ? $header : ''}}</title>
        @include('common.style')
        <script src="{{ asset('public/asset/js/jquery-1.11.3.min.js') }}"></script>
        <script type="text/javascript">
          $.ajaxSetup({
             headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
          });

        var  SITE_URL = "{!! url('/') !!}";
        
        </script>

        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="page-body  page-fade">
        <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        
        @include('common.navbar')
        <div class="main-content">
             @include('common.header')
        <hr />
        @yield('main')


@include('common.footer')
    </div>
@include('common.chat')
</div>
@include('common.script')
 @yield('js')
</body>
</html>