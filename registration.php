<?php
include_once 'header.php';
?>

<section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">

                <div class="d-flex align-items-center" >

                    <!-- Registration Form-->
                    <form action="includes/register.inc.php" method="post" id="registerForm" style="width: 23rem;" >

                        <h3 class="fw-normal mb-3 pb-3 text-light">Register</h3>

                        <div class="form-outline mb-4">
                            <input type="text" name="username" id="username" class="form-control form-control-lg" />
                            <label class="form-label text-secondary">Username</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" name="firstName" id="firstName" class="form-control form-control-lg" />
                            <label class="form-label text-secondary">First Name</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" name="lastName" id="lastName" class="form-control form-control-lg" />
                            <label class="form-label text-secondary">Last Name</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="email" name="email" id="email" class="form-control form-control-lg" />
                            <label class="form-label text-secondary ">Email address</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" name="pwd" id="pwd" class="form-control form-control-lg" />
                            <label class="form-label text-secondary">Password</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" name="pwdRepeat" id="pwdRepeat" class="form-control form-control-lg" />
                            <label class="form-label text-secondary">Confirm Password</label>
                        </div>

                        <div class="pt-1 mb-4">
                            <input type="submit" name="registerSubmit" class="btn btn-secondary btn-lg btn-block" value="Register">
                        </div>

                        <!--In case of errors-->
                        <div class="text-light">
                            <?php
                            if ($_GET["error"] == "emptyinput"){
                                echo "<p>Please fill in all fields.</p>";
                            }
                            elseif ($_GET["error"] == "invalidusername"){
                                echo "<p>Please choose a valid username.</p>";
                            }
                            elseif ($_GET["error"] == "invalidemail"){
                                echo "<p>Please use a valid email address.</p>";
                            }
                            elseif ($_GET["error"] == "passwordsdontmatch"){
                                echo "<p>Your passwords do not match.</p>";
                            }
                            elseif ($_GET["error"] == "usernametaken"){
                                echo "<p>This username is already taken.</p>";
                            }
                            elseif ($_GET["error"] == "stmtfailed"){
                                echo "<p>Something went wrong, please try again.</p>";
                            }
                            elseif ($_GET["error"] == "none"){
                                echo "<p>Sign up successful!</p>";
                            }
                            ?>
                        </div>
                        <!--In case of errors End-->


                    </form>
                    <!-- Registration Form End-->

                </div>
            </div>

            <!-- Side Image-->
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="Images/instrument-3.jpg"
                     alt="Registration image" class="w-100 h-100" style="object-fit: cover; object-position: left;">
            </div>
            <!-- Side Image end-->

        </div>
    </div>
</section>


<?php
include_once 'footer.php';
?>