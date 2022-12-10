<?php
include_once 'header.php';
?>

  <section class="min-vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 mt-5 px-4 ">
          <div class="d-flex list-group list-group-horizontal justify-content-center" >

           <form action="includes/signin.inc.php" method="post" id="signinForm" style="width: 23rem;" >

            <h3 class="fw-normal mb-3 pb-3 text-light ">Log in</h3>

            <?php

              if (isset($_GET["error"])) {

                if ($_GET["error"] == "wronglogin") {
                  echo "
                        <div class='alert alert-light alert-dismissible fade show' role='alert'>
                            <strong>This account does not exist, check that your details are correct.</strong>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>    
                        ";
                } elseif ($_GET["error"] == "emptyinput") {
                  echo "
                        <div class='alert alert-light alert-dismissible fade show' role='alert'>
                            <strong>Please fill in all fields.</strong>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>    
                        ";
                }
              }

              ?>            

            <div class="form-outline mb-4">
              <input type="text" name="user" id="user" class="form-control form-control-lg" />
              <label class="form-label text-secondary">Username or Email address</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" name="pwd" id="pwd" class="form-control form-control-lg" />
              <label class="form-label text-secondary">Password</label>
            </div>

                <div class="pt-1 mb-4">
                    <input type="submit" name="signinSubmit" class="btn btn-secondary btn-lg btn-block" value="Sign In">
                </div>

            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
            <p class="text-muted" >Don't have an account? <a href="registration.php" class="text-light">Register now</a></p>

          </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="Images/instrument-1.jpg"
          alt="Login image" class="w-100 h-100"  style="object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</section>

<?php
include_once 'footer.php';
?>