<?php
include_once 'header.php';
?>

  <section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
  
          <div class="d-flex align-items-center" >
  
           <form action="includes/signin.inc.php" method="post" id="signinForm" style="width: 23rem;" >

            <h3 class="fw-normal mb-3 pb-3 text-light ">Log in</h3>

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

                <div class="text-light">
                    <?php
                    if ($_GET["error"] == "emptyinput"){
                        echo "<p>Please fill in all fields.</p>";
                    }
                    elseif ($_GET["error"] == "wronglogin"){
                        echo "<p>Incorrect login information.</p>";
                    }

                    ?>
                </div>


          </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block vh-100">
        <img src="Images/instrument-1.jpg"
          alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;>
      </div>
    </div>
  </div>
</section>

<?php
include_once 'footer.php';
?>