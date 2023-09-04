</div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>

    <script>
        $(function() {

            $('#NewContact').on('click', function(e){
                e.preventDefault();
                $('#NewContactBox').modal('show');

            });

        });
    </script>

  </body>
  <div class="modal fade" id="NewContactBox" tabindex="-1" role="dialog" aria-labelledby="NewContactBox" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new contact</h5>
      </div>
      <div class="modal-body">

      <form action="" id='#NewContactform'>

        <div class="form-group">
            <label for="contact_firstname">First name</label>
            <input type="text" class="form-control" id="contact_firstname" name='first_name' placeholder="John">
        </div>

        <div class="form-group">
            <label for="contact_lastname">Last name</label>
            <input type="text" class="form-control" id="contact_lastname" name='last_name' placeholder="Smith">
        </div>

        <div class="form-group">
            <label for="contact_email">Email</label>
            <input type="text" class="form-control" id="contact_email" name='email'  placeholder="JohnSmith@example.com">
        </div>

        <div class="form-group">
            <label for="contact_phone">Phone</label>
            <input type="tel" class="form-control" id="contact_phone" name='phone'  placeholder="07000000000">
        </div>

        <div class="form-group">
            <label for="contact_notes">Notes</label>
            <textarea class="form-control" id="contact_notes" rows="3" name='notes'></textarea>
        </div>

      </form>

      </div>
      <div class="modal-footer">
        <button type="submit" id='NewContactSubmitBTN'  class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</html>
