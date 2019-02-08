       <div class="footer">
            <div class="pull-right">
                <strong></strong>
            </div>
            <div>
                <strong>Copyright</strong>  Genesis Group Nigeria &copy; 2018
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
                $('#beneficiary').val(data.beneficiary);
                $('#amount').val(data.amount);
                $('#description').val(data.description);
                $('#entrydate').val(data.entrydate);
                $('#paydate').val(data.paydate);
                $('#status').val(data.status);
                $('#record_id').val(data.id);

              }
            })

        })
      })
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
                $('#id').val(data.id);

              }
            })

        })
      })
    </script>

</body>

</html>
