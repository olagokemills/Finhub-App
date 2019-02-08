       <div class="footer">
            <div class="pull-right">
                <strong></strong>
            </div>
            <div>
                <strong>Copyright</strong> Genesis Group Nigeria &copy; 2018
            </div>
        </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../assets/js/jquery-3.1.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="../assets/js/plugins/flot/jquery.flot.js"></script>
    <script src="../assets/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../assets/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="../assets/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../assets/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="../assets/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="../assets/js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="../assets/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="../assets/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../assets/js/inspinia.js"></script>
    <script src="../assets/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="../assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="../assets/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="../assets/js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="../assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="../assets/js/demo/sparkline-demo.js"></script>



    <script src="../assets/js/plugins/dataTables/datatables.min.js"></script>

        <!-- Bootstrap markdown -->
    <script src="../assets/js/plugins/bootstrap-markdown/bootstrap-markdown.js"></script>
    <script src="../assets/js/plugins/bootstrap-markdown/markdown.js"></script>


    
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });

    </script>


   <script type="text/javascript">
      $(document).ready(function(){
        $('#contact').click(function(event){
      event.preventDefault();
      $("#uploadIm").show();
        $.ajax({
          url:"mailer.php",
          method: "post",
          data:$('form').serialize(),
          dataType:"text",
          success:function(strMessage){
            
            $("#uploadIm").hide();
            $('#message').text(strMessage);
            $('#form').trigger("reset");
          }
        })
        })
      })
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#edit').click(function(event){
      event.preventDefault();
        $("#uploadIm").show();
        $.ajax({
          url:"editor.php",
          method: "post",
          data:$('form').serialize(),
          dataType:"text",
          success:function(strMessage){
            $("#uploadIm").hide();
            $('#message').text(strMessage);
            $('#form').trigger("reset");
          }
        })
        })
      })
    </script>

     <script type="text/javascript">
      $(document).ready(function(){
        $(document).on('click', '.edit', function(){
          event.preventDefault();
           $("#uploadIm").show();
          var id = $(this).attr("name");
            $.ajax({
              url:"fetch.php",
              method:"POST",
              data:{id : id},
              dataType:"json",
              success: function(data){
                $("#uploadIm").hide();
                $('#beneficiary').val(data.beneficiary);
                $('#amount').val(data.amount);
                $('#description').val(data.description);
                $('#entrydate').val(data.entrydate);
                $('#forecast').val(data.forecastdate);
                // $('#status').val(data.status);
                $('#record_id').val(data.id);

              }
            })

        })
      })
    </script>

   <script type="text/javascript">
      $(document).ready(function(){
        $(document).on('click', '.pay', function(){
          event.preventDefault();
          var id = $(this).attr("name");
            $.ajax({
              url:"pay.php",
              method:"POST",
              data:{id:id},
              dataType:"text",
              success: function(strMessage){

                 var $text= 'Marked as Paid Successfully';

          var $pops = $('<div class="alert alert-warning alert-dismissible show" id="marked" role="alert">'+ $text +'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                      );

              $(".ibox-content").prepend($pops);

               console.log(strMessage);

               location.reload();

              }
            });

            });
      });
    </script>



     <script type="text/javascript">
      $(document).ready(function(){
        $(document).on('click', '.delete', function(){
          event.preventDefault();
           $("#uploadIm").show();
          var id = $(this).attr("name");
            $.ajax({
              url:"fetch.php",
              method:"POST",
              data:{id : id},
              dataType:"json",
              success: function(data){
                $("#uploadIm").hide();
                $('#id').val(data.id);

              }
            })

        })
      })
    </script>

    <script>

$('select[name=role]').change(function () {
    if ($(this).val() == 'Tracker') {
        $('#supervisor').show('fadeIn', 3000);
    }
    else{
      $('#supervisor').hide();
    }
});
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#filter').click(function(event){
      event.preventDefault();
      $("#uploadIm").show();
      var $from = $('#from').val();
      var $to = $('#to').val();

      $('.appended').remove();

      if($from >= $to)
      {
        alert('Invalid Selection');
      }else
      (

        $.ajax({
          url:"filter.php",
          method: "POST",
          data:$('form').serialize(),
          dataType:"json",
          success:function(data){
            $('.fil').hide();
            $('.result').show();
            // console.log(data['all'][0].total);
            $('.total').append('<span class="appended">'+data['all'][0].total+'</span>');

            $('.paid').append('<span class="appended">'+data['paid'][0].total+'</span>');


            $('.pending').append('<span class="appended">'+data['pending'][0].total+'</span>');
            // console.log(data['paid'][0].total);

            $('.overdue').append('<span class="appended">'+data['overdue'][0].total+'</span>');
            // console.log(data['pending'][0].total);
            // console.log(data['overdue'][0].total);

              }
            })
          )
        })
      })
    </script>
</body>

</html>
