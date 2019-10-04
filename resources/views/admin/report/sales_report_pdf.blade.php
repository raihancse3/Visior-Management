<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sales Report</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body onload="window.print();">
<div class="wrapper">
  
  <div class="cotainer" style="min-height: 1px; width: 100%">
      <div style="width: 60%; float: left;">
        <address>
          <strong style="font-weight: bold;font-size: 25px;">{{ Session::get('company_name') }}</strong><br>
          {{ Session::get('company_street') }}, {{ Session::get('company_city') }}<br>
         {{ Session::get('company_state') }}, {{ Session::get('company_country_id') }}, {{ Session::get('company_zipCode') }}<br>
          Phone: {{ Session::get('company_phone') }}<br>
          Email: {{ Session::get('company_email') }}
        </address>

      </div>
      <div style="width: 40%; float: left;">
        <strong style="font-weight: bold;font-size: 32px;">Sales Report</strong><br>
        <table>
          <tr><td>Date</td><td>:</td><td><?= date('d-m-Y',strtotime($from)) ?> To <?= date('d-m-Y',strtotime($to)) ?></td></tr>
          <tr><td>Customer </td><td>:</td><td><?= $customer ?></td></tr>
        </table>
      </div>
  </div>

  <div class="clearfix" style="clear: both;"></div>
  <div class="cotainer" style="width: 100%; margin-top: 15px;">
        <table width="100%" style="text-align: center;">
          <thead>
          <tr style="background: gray; color: white;">
             <td>Date</td>
             <td>Quantity</td>
             <td>Sales Value({{Session::get('currency_symbol')}})</td>
             <td>Costs Value({{Session::get('currency_symbol')}})</td>
             <td>Profit({{Session::get('currency_symbol')}})</td>
          </tr>
          </thead>
           <tbody>
             
            <?php
                  $qty = 0;
                  $sales = 0;
                  $cost = 0;
                  $profit = 0;
                ?>
              @foreach ($salesReportData as $item)
                <?php
                $qty += $item->quanty;
                $sales += $item->sales;
                $cost += $item->cost;
                $profit = $sales-$cost;
                ?>

              <tr style="background-color:#fff; text-align:center; font-size:13px; font-weight:normal;"> 
              <td>{{ $item->date }}</td> 
              <td>{{ $item->quanty }}</td>
              <td>{{ number_format(($item->sales),2,'.',',') }}</td>
              <td>{{ number_format(($item->cost),2,'.',',') }}</td>
              <td>{{ number_format(($item->sales-$item->cost),2,'.',',') }}</td>
              </tr>
              @endforeach  

           </tbody>
            <tfoot>
              <tr style="background-color:#f0f0f0; text-align:right; font-size:13px; font-weight:normal;">
                <td colspan="1"><strong>Total</stong></td>
               
                <td align="center"><strong>{{$qty}}</stong></td>
                <td align="center"><strong>{{number_format(abs($sales),2,'.',',') }}</stong></td>
                <td align="center"><strong>{{number_format(abs($cost),2,'.',',') }}</stong></td>
                <td align="center"><strong>{{number_format($profit,2,'.',',') }}</stong></td>            
              </tr>
            </tfoot>
        </table>
  </div>
  <div class="clearfix" style="clear: both;"></div>
</div>
</body>
</html>