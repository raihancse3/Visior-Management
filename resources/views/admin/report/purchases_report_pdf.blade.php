<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Purchase Report</title>
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
        <strong style="font-weight: bold;font-size: 32px;">Purchase Report</strong><br>
        <table>
          <tr><td>Date</td><td>:</td><td><?= date('d-m-Y',strtotime($from)) ?> To <?= date('d-m-Y',strtotime($to)) ?></td></tr>
          <tr><td>Supplier </td><td>:</td><td>{{$supplier}}</td></tr>
          <tr><td>Warehouse </td><td>:</td><td>{{$warehouse}}</td></tr>
        </table>
      </div>
  </div>

  <div class="clearfix" style="clear: both;"></div>
  <div class="cotainer" style="width: 100%; margin-top: 15px;">
        <table width="100%" style="text-align: center;">
          <thead>
          <tr style="background: gray; color: white;">
            <td>Date</td>
            <td>Ref</td>
            <td>Quantity</td>
           <td>Amount({{Session::get('currency_symbol')}})</td>
          </tr>
          </thead>
           <tbody>
                <?php
                  $qty = 0;
                  $amount = 0;
                ?>
                @foreach ($purchaseReportData as $item)
                <?php
                $qty += $item->quantity;
                $amount += $item->total;
                ?>

                <tr style="background-color:#fff; text-align:center; font-size:13px; font-weight:normal;"> 
                  <td>{{ date('d-m-Y',strtotime($item->date)) }}</td>
                  <td>{{ PURCHASE.$item->reference }}</td> 
                  <td>{{ $item->quantity }}</td>
                  <td>{{ numberRound($item->total) }}</td>
                </tr>
                @endforeach  

           </tbody>
            <tfoot>

              <tr style="background-color:#f0f0f0; text-align:right; font-size:13px; font-weight:normal;">
                <td colspan="2"><strong>TOTAL</stong></td>
                <td align="center"><strong>{{$qty}}</stong></td>
                <td align="center"><strong>{{numberRound(abs($amount)) }}</stong></td>  
              </tr>

            </tfoot>
        </table>
  </div>
  <div class="clearfix" style="clear: both;"></div>
</div>
</body>
</html>