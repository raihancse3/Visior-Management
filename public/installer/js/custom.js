
    $(document).ready(function() {
          $(window).keydown(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
            }
          });
        });

     // calculate amount with item quantity
    $(document).on('keyup', '.no_qty', function(){
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
      
     var taxRateValue = parseFloat( $("#rowid"+id+' .taxList').find(':selected').val());
     var amountByRow =$("#rowid"+id+" .amount").val();

      $("#rowid"+id+' .cgst').text(amountByRow*taxRateValue/200);
      $("#rowid"+id+' .sgst').text(amountByRow*taxRateValue/200);
      var taxByRow = roundToTwo(amountByRow*taxRateValue/100);

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
      $("#grandTotal").val(roundToTwo(grandTotal));
    });

     // calculate amount with discount
    $(document).on('keyup', '.discount', function(ev){
     
      var discount = parseFloat($(this).val());

      if(isNaN(discount)){
          discount = 0;
       }
     
      var id = $(this).closest("tr").prop("id").replace('rowid', '');
      var qty = parseFloat($("#rowid"+id+" .no_qty").val());
      var rate = parseFloat($("#rowid"+id+" .unitprice").val());
      var discountRate = parseFloat($("#rowid"+id+" .discount").val());
      var price = calculatePrice(qty,rate); 
      var discountPrice = calculateDiscountPrice(price,discountRate);       
      $("#rowid"+id+" .amount").val(discountPrice);

     var taxRateValue = parseFloat( $("#rowid"+id+' .taxList').find(':selected').val());
     var amountByRow =$("#rowid"+id+" .amount").val(); 

      $("#rowid"+id+' .cgst').text(amountByRow*taxRateValue/200);
      $("#rowid"+id+' .sgst').text(amountByRow*taxRateValue/200);
      $("#rowid"+id+' .igst').text(amountByRow*taxRateValue/100);

     var taxByRow = roundToTwo(amountByRow*taxRateValue/100);
     $("#rowid"+id+" .taxAmount").text(taxByRow);

      // Calculate subTotal
      var subTotal = calculateSubTotal();
      $("#subTotal").val(subTotal);
      // Calculate taxTotal
      var taxTotal = calculateTaxTotal();
      $("#taxTotal").val(taxTotal);
      // Calculate GrandTotal
      var grandTotal = (subTotal + taxTotal);
      $("#grandTotal").val(roundToTwo(grandTotal));

    });

     // calculate amount with unit price
    $(document).on('keyup', '.unitprice', function(){
     
      var unitprice = parseFloat($(this).val());

      if(isNaN(unitprice)){
          unitprice = 0;
       }
     
      var id = $(this).closest("tr").prop("id").replace('rowid', '');
      var qty = parseFloat($("#rowid"+id+" .no_qty").val());
     
      var discountRate = parseFloat($("#rowid"+id+" .discount").val());

      var price = calculatePrice(qty,unitprice);  
      var discountPrice = calculateDiscountPrice(price,discountRate);     
      $("#rowid"+id+" .amount").val(discountPrice);

     var taxRateValue = parseFloat( $("#rowid"+id+' .taxList').find(':selected').val());
     var amountByRow =$("#rowid"+id+" .amount").val(); 

      $("#rowid"+id+' .cgst').text(amountByRow*taxRateValue/200);
      $("#rowid"+id+' .sgst').text(amountByRow*taxRateValue/200);

     var taxByRow = roundToTwo(amountByRow*taxRateValue/100);
     $("#rowid"+id+" .taxAmount").text(taxByRow);

      // Calculate subTotal
      var subTotal = calculateSubTotal();
      $("#subTotal").val(subTotal);
      // Calculate taxTotal
      var taxTotal = calculateTaxTotal();
      $("#taxTotal").val(taxTotal);
      // Calculate GrandTotal
      var grandTotal = (subTotal + taxTotal);
      $("#grandTotal").val(roundToTwo(grandTotal));

    });

    $(document).on('change', '.taxList', function(ev){
      var taxRateValue = $(this).find(':selected').val();
      var id = $(this).closest("tr").prop("id").replace('rowid', '');
      var amountByRow =$("#rowid"+id+" .amount").val();
      
      $("#rowid"+id+' .cgst').text(amountByRow*taxRateValue/200);
      $("#rowid"+id+' .sgst').text(amountByRow*taxRateValue/200);

      var taxByRow = roundToTwo(amountByRow*taxRateValue/100);

      $("#rowid"+id+" .taxAmount").text(taxByRow);

      // Calculate subTotal
      var subTotal = calculateSubTotal();
      $("#subTotal").val(subTotal);
      // Calculate taxTotal
      var taxTotal = calculateTaxTotal();
      $("#taxTotal").val(taxTotal);
      // Calculate GrandTotal
      var grandTotal = (subTotal + taxTotal);
      $("#grandTotal").val(roundToTwo(grandTotal));

    });

    // Delete item row
    $(document).ready(function(e){
      $('#orderForm').on('click', '.delete_item', function() {
            var id = $(this).attr("id");
            stack = jQuery.grep(stack, function(value) {
              return value != id;
            });
            
            $(this).closest("tr").remove();
            
           var taxRateValue = parseFloat( $("#rowid"+id+' .taxList').find(':selected').val());
           var amountByRow = $("#rowid"+id+" .amount").val(); 
           var taxByRow = roundToTwo(amountByRow*taxRateValue/100);
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
            $("#grandTotal").val(roundToTwo(grandTotal));   

            var rowCount = $('#itemTable tr.rowsAdded').length;
            
            if(rowCount==0){
              $("#btnSubmit").hide();
            }


        });
    });
      

      function calculateQtyTotal (){
          var total = 0;
            $('.no_qty').each(function() {
                total += parseFloat($(this).val());
            });
            return roundToTwo(total);
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
            return roundToTwo(totalTax);
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
        return roundToTwo(subTotal);
      }

      /**
      * Calcualte price
      *@return price
      */
      function calculatePrice (qty,rate){
         var price = (qty*rate);
         return roundToTwo(price);
      }   
      // calculate tax 
      function caculateTax(p,t){
       var tax = (p*t)/100;
       return roundToTwo(tax);
      }   

      // calculate discont amount
      function calculateDiscountPrice(p,d){
        var discount = [(d*p)/100];
        var result = (p-discount); 
        return roundToTwo(result);
      }
      function roundToTwo(num) {    
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



         // Reference Number Nalidation
  $(document).ready(function(){
    //var customer;
      var customer_id = $("#customer_id").val();
     // localStorage.removeItem(customer);
      localStorage.setItem("customer",customer_id);
       $.ajax({
        url: SITE_URL+"/customer/check_state",
        type: "post",
        data: {customer_id: customer_id} ,
        success: function (response) {
           result = JSON.parse(response);  
           if(result.status == 1){
            $(".igstTable").remove();
            $(".gstTable").css('display','block');
           }else{
            $(".gstTable").remove();
            $(".igstTable").css('display','block');
           } 
        }
    });
  });

           // Reference Number Nalidation
 /* $(document).on('change','#customer_id',function(){

      var customer_id = $("#customer_id").val();
      localStorage.setItem("customer",customer_id);
      location.reload();
      
       $.ajax({
        url: SITE_URL+"/customer/check_state",
        type: "post",
        data: {customer_id: customer_id} ,
        success: function (response) {
           result = JSON.parse(response);  
           if(result.status == 1){
            $(".igstTable").remove();
            $(".gstTable").css('display','block');
           }else{
            $(".gstTable").remove();
            $(".igstTable").css('display','block');
           } 

        }
    });
    

  });*/

