<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ID CARD</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <style type="text/css">
    
body {
      background-color: #d7d6d3;
      font-family:'verdana';
    }
    .id-card-holder {
      width: 225px;
        padding: 4px;
        margin: 0 auto;
        position: relative;
    }

    .id-card {
      
      background-color: #fff;
      padding: 10px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 1.5px 0px #b9b9b9;
    }
    .id-card img {
      margin: 0 auto;
    }
    .header img {
      width: 100px;
        margin-top: 15px;
    }
    .photo img {
      width: 80px;
        margin-top: 15px;
    }
    h2 {
      font-size: 15px;
      margin: 5px 0;
    }
    h3 {
      font-size: 12px;
      margin: 2.5px 0;
      font-weight: 300;
    }
    .qr-code img {
      width: 50px;
    }
    p {
      font-size: 5px;
      margin: 2px;
    }
    .id-card-hook {
      background-color: #000;
        width: 70px;
        margin: 0 auto;
        height: 15px;
        border-radius: 5px 5px 0 0;
    }
    .id-card-hook:after {
      content: '';
        background-color: #d7d6d3;
        width: 47px;
        height: 6px;
        display: block;
        margin: 0px auto;
        position: relative;
        top: 6px;
        border-radius: 4px;
    }
    .id-card-tag-strip {
      width: 45px;
        height: 40px;
        background-color: #0950ef;
        margin: 0 auto;
        border-radius: 5px;
        position: relative;
        top: 9px;
        z-index: 1;
        border: 1px solid #0041ad;
    }
    .id-card-tag-strip:after {
      content: '';
        display: block;
        width: 100%;
        height: 1px;
        background-color: #c1c1c1;
        position: relative;
        top: 10px;
    }
    .id-card-tag {
      width: 0;
      height: 0;
      border-left: 100px solid transparent;
      border-right: 100px solid transparent;
      border-top: 100px solid #0958db;
      margin: -10px auto -30px auto;
    }
    .id-card-tag:after {
      content: '';
        display: block;
        width: 0;
        height: 0;
        border-left: 50px solid transparent;
        border-right: 50px solid transparent;
        border-top: 100px solid #d7d6d3;
        margin: -10px auto -30px auto;
        position: relative;
        top: -130px;
        left: -50px;
    }    

  </style>
</head>
<body>
<div class="wrapper">

  <div class="id-card-holder">
    <div class="id-card">
      <div class="header">
        <img src="{{url('public/logo.png')}}">
      </div>
      <div class="photo">
          @if($driver->picture)
          <img src="{{url("public/uploads/driver/$driver->picture")}}">
          @else
          <img src="{{url("public/uploads/avatar.jpg")}}">
          @endif
      </div>
      <h2>Name : {{$driver->name}}</h2>
      <h2>ID : {{$driver->emp_id}}</h2>
      <div class="qr-code">
        {!! QrCode::size(100)->color(0,51,0)->generate($driver->emp_id); !!}
      </div>
      <hr>
      <br>
      Authorize signature
      <hr>
      <p style="font-size: 8px">CORPORATE OFFICE : </p><p style="font-size: 8px"> 225, Tejgaon I/A (1st Floor) <p>
      <p style="font-size: 8px">Dhaka-1208, Bangladesh</p>
      <p style="font-size: 8px">Tel +880 2 984964-6, Fax +880 2 9849446</p>

    </div>
  </div>
</div>
</body>
</html>