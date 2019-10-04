
    $(document).ready(function() {
          $(window).keydown(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
            }
          });
        });

     // calculate amount with item quantity
    $(document).on('keyup', '.qty_val', function(){

      var id = $(this).closest("tr").prop("id").replace('rowid', '');

      var qty = parseInt($(this).val());
     
      if(isNaN(qty)){
          qty = 0;
       }
       
      var rate = parseFloat($("#rowid"+id+" .unitprice").val());
      var price = calculatePrice(qty,rate);  

      var discountRate = parseFloat($("#rowid"+id+" .discount").val());     
      if(isNaN(discountRate)){
          discountRate = 0;
       }
      var discountPrice = calculateDiscountPrice(price,discountRate); 
      $("#rowid"+id+" .amount").val(discountPrice);
      
     var taxRateValue = parseFloat( $("#rowid"+id+' .taxInfo').find(':selected').val());
     var amountByRow =$("#rowid"+id+" .amount").val();

      $("#rowid"+id+' .cgst').text(amountByRow*taxRateValue/200);
      $("#rowid"+id+' .sgst').text(amountByRow*taxRateValue/200);
      var taxByRow = roundCalculator(amountByRow*taxRateValue/100);

      $("#rowid"+id+" .taxAmount").text(taxByRow);
      $("#rowid"+id+" .igstAmount").text(taxByRow);
      $("#rowid"+id+" .gstAmount").text(taxByRow/2);
      // Calculate qtyTotal
      var qtyTotal = calculateQtyTotal();
      $("#quantityTotal").val(qtyTotal);
      // Calculate subTotal
      var subTotal = calculateSubTotal();
      $("#subTotal").val(subTotal);
      // Calculate taxTotal
      var taxTotal = calculateTaxTotal();
      $("#taxTotal").val(taxTotal);
      // Calculate GrandTotal
      var grandTotal = (subTotal + taxTotal);
      $("#grandTotal").val(roundCalculator(grandTotal));


    });

     // calculate amount with discount
    $(document).on('keyup', '.discount', function(ev){
     
      var discount = parseFloat($(this).val());

      if(isNaN(discount)){
          discount = 0;
       }
     
      var id = $(this).closest("tr").prop("id").replace('rowid', '');
      var qty = parseFloat($("#rowid"+id+" .qty_val").val());
      var rate = parseFloat($("#rowid"+id+" .unitprice").val());
      var discountRate = parseFloat($("#rowid"+id+" .discount").val());
      var price = calculatePrice(qty,rate); 
      var discountPrice = calculateDiscountPrice(price,discountRate);       
      $("#rowid"+id+" .amount").val(discountPrice);

     var taxRateValue = parseFloat( $("#rowid"+id+' .taxInfo').find(':selected').val());
     var amountByRow =$("#rowid"+id+" .amount").val(); 

      $("#rowid"+id+' .cgst').text(amountByRow*taxRateValue/200);
      $("#rowid"+id+' .sgst').text(amountByRow*taxRateValue/200);
      $("#rowid"+id+' .igst').text(amountByRow*taxRateValue/100);

     var taxByRow = roundCalculator(amountByRow*taxRateValue/100);
     $("#rowid"+id+" .taxAmount").text(taxByRow);

      // Calculate subTotal
      var subTotal = calculateSubTotal();
      $("#subTotal").val(subTotal);
      // Calculate taxTotal
      var taxTotal = calculateTaxTotal();
      $("#taxTotal").val(taxTotal);
      // Calculate GrandTotal
      var grandTotal = (subTotal + taxTotal);
      $("#grandTotal").val(roundCalculator(grandTotal));

    });

     // calculate amount with unit price
    $(document).on('keyup', '.unitprice', function(){
     
      var unitprice = parseFloat($(this).val());

      if(isNaN(unitprice)){
          unitprice = 0;
       }
     
      var id = $(this).closest("tr").prop("id").replace('rowid', '');
      var qty = parseFloat($("#rowid"+id+" .qty_val").val());
     
      var discountRate = parseFloat($("#rowid"+id+" .discount").val());

      var price = calculatePrice(qty,unitprice);  
      var discountPrice = calculateDiscountPrice(price,discountRate);     
      $("#rowid"+id+" .amount").val(discountPrice);

     var taxRateValue = parseFloat( $("#rowid"+id+' .taxInfo').find(':selected').val());
     var amountByRow =$("#rowid"+id+" .amount").val(); 

      $("#rowid"+id+' .cgst').text(amountByRow*taxRateValue/200);
      $("#rowid"+id+' .sgst').text(amountByRow*taxRateValue/200);

     var taxByRow = roundCalculator(amountByRow*taxRateValue/100);
     $("#rowid"+id+" .taxAmount").text(taxByRow);

      // Calculate subTotal
      var subTotal = calculateSubTotal();
      $("#subTotal").val(subTotal);
      // Calculate taxTotal
      var taxTotal = calculateTaxTotal();
      $("#taxTotal").val(taxTotal);
      // Calculate GrandTotal
      var grandTotal = (subTotal + taxTotal);
      $("#grandTotal").val(roundCalculator(grandTotal));

    });

    $(document).on('change', '.taxInfo', function(ev){
      var taxRateValue = $(this).find(':selected').val();
      var id = $(this).closest("tr").prop("id").replace('rowid', '');
      var amountByRow =$("#rowid"+id+" .amount").val();
      
      $("#rowid"+id+' .cgst').text(amountByRow*taxRateValue/200);
      $("#rowid"+id+' .sgst').text(amountByRow*taxRateValue/200);

      var taxByRow = roundCalculator(amountByRow*taxRateValue/100);

      $("#rowid"+id+" .taxAmount").text(taxByRow);

      // Calculate subTotal
      var subTotal = calculateSubTotal();
      $("#subTotal").val(subTotal);
      // Calculate taxTotal
      var taxTotal = calculateTaxTotal();
      $("#taxTotal").val(taxTotal);
      // Calculate GrandTotal
      var grandTotal = (subTotal + taxTotal);
      $("#grandTotal").val(roundCalculator(grandTotal));

    });

    // Delete item row
    $(document).ready(function(e){
      $('#orderForm').on('click', '.delete_row', function() {

            var id = $(this).attr("id");

            trackArray = jQuery.grep(trackArray, function(value) {
              return value != id;
            });
            
            $(this).closest("tr").remove();
            
           var taxRateValue = parseFloat( $("#rowid"+id+' .taxInfo').find(':selected').val());
           var amountByRow = $("#rowid"+id+" .amount").val(); 
           var taxByRow = roundCalculator(amountByRow*taxRateValue/100);
           $("#rowid"+id+" .taxAmount").text(taxByRow);

            // Calculate qtyTotal
            var qtyTotal = calculateQtyTotal();
            $("#quantityTotal").val(qtyTotal);
            
            var subTotal = calculateSubTotal();
            $("#subTotal").val(subTotal);
           
            var taxTotal = calculateTaxTotal();
            $("#taxTotal").val(taxTotal);
            // Calculate GrandTotal
            var grandTotal = (subTotal + taxTotal);
            $("#grandTotal").val(roundCalculator(grandTotal));   

            var rowCount = $('#itemTable tr.rowsAdded').length;
         
            if(rowCount == 0){
              $("#btnSubmit").hide();
            }else{
              $("#btnSubmit").show();
            }


        });
    });
      

      function calculateQtyTotal (){
          var total = 0;
            $('.qty_val').each(function() {
                total += parseFloat($(this).val());
            });
            return roundCalculator(total);
      }

      /**
      * Calcualte Total tax
      *@return totalTax for row wise
      */
      function calculateTaxTotal (){
          var totalTax = 0;
            $('.taxAmount').each(function() {
                totalTax += parseFloat($(this).text());
            });
            return roundCalculator(totalTax);
      }
      
      /**
      * Calcualte Sub Total 
      *@return subTotal
      */
      function calculateSubTotal (){
        var subTotal = 0;
        $('.amount').each(function() {
            subTotal += parseFloat($(this).val());
        });
        return roundCalculator(subTotal);
      }

      /**
      * Calcualte price
      *@return price
      */
      function calculatePrice (qty,rate){
         var price = (qty*rate);
         return roundCalculator(price);
      }   
      // calculate tax 
      function caculateTax(p,t){
       var tax = (p*t)/100;
       return roundCalculator(tax);
      }   

      // calculate discont amount
      function calculateDiscountPrice(p,d){
        var discount = [(d*p)/100];
        var result = (p-discount); 
        return roundCalculator(result);
      }
      function roundCalculator(num) {    
          return +(Math.round(num + "e+2")  + "e-2");
      }     

  function in_array(search, array)
    {
      for (i = 0; i < array.length; i++)
      {
        if(array[i] ==search )
        {
          return true;
        }
      }
        return false;
    }



         // Reference Number Nalidation
  $(document).on('keyup', '#reference', function(){
     reference_type
      var reference = $("#reference").val();
      var reference_type = $("#reference_type").val();
       $.ajax({
        url: SITE_URL+"/check_reference",
        type: "post",
        data: {reference: reference,reference_type:reference_type} ,
        success: function (response) {
           result = JSON.parse(response);  
           if(result.status == 0){
            $("#ref_mgs").html('Available');
           }else{
            $("#ref_mgs").html('Exist');
           } 
        }
    });
  });