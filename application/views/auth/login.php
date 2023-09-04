<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

    <!-- Custom CSS -->
    <link
      href="/plugins/bower_components/chartist/dist/chartist.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css"
    />
    <!-- Custom CSS -->
    <link href="/css/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/login.css">

<div class="sidenav">
         <div class="login-main-text">
            <h2>Application<br> Login Page</h2>
            <p>You'll need to be logged in to access this application.</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form action='login'>
                  <div class="errorbox"></div>
                  <div class="form-group">
                     <label>Email address</label>
                     <input type="email" name='email' class="form-control" placeholder="Email address" autofocus required>
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" name='password' class="form-control" placeholder="Password" required>
                  </div>
                  <button type="submit" class="btn btn-black">Login</button>
                  <!-- <button type="submit" class="btn btn-secondary">Register</button> -->
               </form>
            </div>
         </div>
      </div>

      <script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>
      <script>
        $(function() {

            $('form[action=login]').on('submit', function(e){
                e.preventDefault();

                var formData = $(this).serialize();

               $.ajax({
                  type: "POST",
                  url: "/auth/login",
                  data: formData,
               }).done(function (data) {
                  if(typeof data.status !== "undefined"){

                     // Check status 
                     if(data.status == '1'){
                        location.replace("/");
                     } else {
                        // Add error to error box 
                        $('.errorbox').html('<div class="alert alert-warning" role="alert">'+data.message+'</div>');
                     }

                  } else {
                     // Add error to error box
                     $('.errorbox').html('<div class="alert alert-warning" role="alert">There was an error, please try again later.</div>');
                  }
               });

            })

        });
    </script>