      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb bg-white">
          <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <h4 class="page-title">Settings</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                  <li><a href="#" class="fw-normal">Settings</a></li>
                </ol>
              </div>
            </div>
          </div>
          <!-- /.col-lg-12 -->
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Three charts -->
          <!-- ============================================================== -->
          <div class="row justify-content-center">
            <div class="col-lg-4">
              <div class="white-box analytics-info">

              <form action='settings'>
                  <div class="errorbox"></div>
                  <div class="form-group">
                     <label>Name</label>
                     <input type="text" name='name' class="form-control" placeholder="John Smith" autofocu value='<?php echo $user->name; ?>'s>
                  </div>
                  <div class="form-group">
                     <label>Email address</label>
                     <input type="email" name='email' class="form-control" placeholder="Email address" value='<?php echo $user->email; ?>'>
                  </div>
                  <div class="form-group">
                    <hr />
                    <p>You'll only need to fill out the password fields if you are updating your password.</p>
                  </div>
                  <div class="form-group">
                     <label>Current password</label>
                     <input type="password" name='password' class="form-control" placeholder="Password" >
                  </div>
                  <div class="form-group">
                     <label>New password</label>
                     <input type="password" name='new_password' class="form-control" placeholder="Password" >
                  </div>
                  <div class="form-group">
                     <label>Re-enter new password</label>
                     <input type="password" name='re_new_password' class="form-control" placeholder="Password" >
                  </div>
                  <button type="submit" class="btn btn-success btn-md">Update</button>
                  <!-- <button type="submit" class="btn btn-secondary">Register</button> -->
               </form>

              </div>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
      <script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>
      <script>
        $(function() {

         // Remove errors from input on change
         $('form[action=settings]').delegate('input', 'change', function(e){
            $(this).removeClass('haserror');
            
            // Remove the error text as well

         });

            $('form[action=settings]').on('submit', function(e){
                e.preventDefault();

                // Remove all form errors
                $('.form-input-error').remove();
                $('.haserror').removeClass('haserror');

                var formData = $(this).serialize();
                $('.errorbox').html('');

               $.ajax({
                  type: "POST",
                  url: "/settings/submit",
                  data: formData,
               }).done(function (data) {
                  if(typeof data.status !== "undefined"){

                     // Check status 
                     if(data.status == '1'){
                        $('.errorbox').html('<div class="alert alert-success" role="alert">'+data.message+'</div>');
                     } else {
                        // Add error to error box 
                        $('.errorbox').html('<div class="alert alert-warning" role="alert">'+data.message+'</div>');

                        // Check if there is more than one error in the response 
                        if(typeof data.errors !== "undefined"){
                           $.each(data.errors, function(key,value) {
                              $('input[name='+key+']').addClass('haserror');
                              $('input[name='+key+']').after('<p for='+key+' class="form-input-error">'+value+'</p>');
                              console.log(key, value);
                           }); 

                        }

                     }

                  } else {
                     // Add error to error box
                     $('.errorbox').html('<div class="alert alert-warning" role="alert">There was an error, please try again later.</div>');
                  }
               });

            })

        });
    </script>