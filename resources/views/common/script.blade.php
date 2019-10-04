<!-- Imported styles on this page -->
    <script src="{{ asset('public/asset/js/jquery-1.11.3.min.js')}}"></script>

    <script src="{{ asset('public/asset/js/gsap/TweenMax.min.js')}}"></script>
    <script src="{{ asset('public/asset/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js')}}"></script>
    <script src="{{ asset('public/asset/js/bootstrap.js')}}"></script>
    <script src="{{ asset('public/asset/js/joinable.js')}}"></script>
    <script src="{{ asset('public/asset/js/resizeable.js')}}"></script>
    <script src="{{ asset('public/asset/js/neon-api.js')}}"></script>

    <script src="{{ asset('public/asset/js/jquery.sparkline.min.js')}}"></script>
    <script src="{{ asset('public/asset/js/rickshaw/vendor/d3.v3.js')}}"></script>
    <script src="{{ asset('public/asset/js/rickshaw/rickshaw.min.js')}}"></script>
    <script src="{{ asset('public/asset/js/raphael-min.js')}}"></script>
    <script src="{{ asset('public/asset/js/morris.min.js')}}"></script>

    <script src="{{ asset('public/asset/js/datatables/datatables.js')}}"></script>

    <script src="{{ asset('public/asset/js/neon-custom.js')}}"></script>
    <script src="{{ asset('public/asset/js/neon-demo.js')}}"></script>
    <script src="{{ asset('public/asset/js/jquery-ui.js')}}"></script>

    <script src="{{ asset('public/asset/js/select2/select2.min.js')}}"></script>
    <script src="{{ asset('public/asset/js/selectboxit/jquery.selectBoxIt.min.js')}}"></script>
    
    <script src="{{ asset('public/asset/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('public/asset/js/wysihtml5/wysihtml5-0.4.0pre.min.js')}}"></script>
    <script src="{{ asset('public/asset/js/wysihtml5/bootstrap-wysihtml5.js') }}"></script>

    <!--Calendar-->
    <script src="{{ asset('public/asset/js/moment.min.js')}}"></script>
    <script src="{{ asset('public/asset/js/fullcalendar.min.js')}}"></script>

    <script src="{{ asset('public/asset/js/custom.js')}} "></script>
    <script type="text/javascript">
      
      // $.ajaxSetup({
      //    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      // });


  $('.lang').on('click', function() {
    var lang = $(this).attr('id');
    var url = "{{url('language/change')}}";
    var token = "{{csrf_token()}}";
    $.ajax({
            url   :url,
            async : false,
            data:{                 
                _token:token,
                lang:lang
            },
            type:"POST",            
            success:function(data){
                if(data == 1) {
                    location.reload();

                }
                
            },
             error: function(xhr, desc, err) {
                
                return 0;
            }
        });
  });      
    </script>