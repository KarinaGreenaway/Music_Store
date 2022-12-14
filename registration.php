<?php
include_once 'header.php';
?>

<section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 mt-5 px-4">

                <div class="d-flex list-group list-group-horizontal justify-content-center" >

                    <!-- Registration Form-->
                    <form action="includes/register.inc.php" method="post" id="registerForm" style="width: 23rem;" >

                        <!--In case of errors-->
                        <div class="text-light">
                            <?php

                            if (isset($_GET["error"])) {

                                if ($_GET["error"] == "emptyinput") {
                                    echo "
                                    <div class='alert alert-light alert-dismissible fade show' role='alert'>
                                        <strong>Please fill in all fields.</strong>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>    
                                ";
                                } elseif ($_GET["error"] == "invalidname") {
                                    echo "
                                    <div class='alert alert-light alert-dismissible fade show' role='alert'>
                                        <strong>Please enter valid names. No symbols or numbers.</strong>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>    
                                    ";
                                }elseif ($_GET["error"] == "invalidusername") {
                                    echo "
                                    <div class='alert alert-light alert-dismissible fade show' role='alert'>
                                        <strong>Please enter a valid username.</strong>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>    
                                ";
                                } elseif ($_GET["error"] == "invalidemail") {
                                    echo "
                                    <div class='alert alert-light alert-dismissible fade show' role='alert'>
                                        <strong>Please enter valid email. Must be formatted as name@email.com.</strong>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>    
                                ";
                                } elseif ($_GET["error"] == "passwordsdontmatch") {
                                    echo "
                                    <div class='alert alert-light alert-dismissible fade show' role='alert'>
                                        <strong>Please enter matching passwords</strong>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>    
                                ";
                                } elseif ($_GET["error"] == "usernametaken") {
                                    echo "
                                    <div class='alert alert-light alert-dismissible fade show' role='alert'>
                                        <strong>This username/email is taken. Please enter a new one.</strong>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>    
                                ";
                                } elseif ($_GET["error"] == "stmtfailed") {
                                    echo "
                                    <div class='alert alert-light alert-dismissible fade show' role='alert'>
                                        <strong>Something went wrong. Please try again.</strong>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>    
                                    ";
                                } elseif ($_GET["error"] == "none") {
                                    echo "
                                    <div class='alert alert-light alert-dismissible fade show' role='alert'>
                                        <strong>Sign up successful!</strong>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>    
                                ";
                                }
                            }   
                            ?>
                        </div>
                        <!--In case of errors-->                    

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