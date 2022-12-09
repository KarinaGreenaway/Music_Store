<?php
include_once 'header.php';
$error="";
?>



<section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 mt-5 px-4 ">

                <div class="d-flex list-group list-group-horizontal justify-content-center" >

                    <!-- Profile Form-->
                    <form action="includes/account.inc.php" method="post" id="registerForm" class="" style="width: 23rem;" >

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
                        } elseif ($_GET["error"] == "invalidusername") {
                            echo "
                            <div class='alert alert-light alert-dismissible fade show' role='alert'>
                                <strong>Please enter a valid username.</strong>
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
                        } elseif ($_GET["error"] == "invalidemail") {
                            echo "
                            <div class='alert alert-light alert-dismissible fade show' role='alert'>
                                <strong>Please enter valid email. Must be formatted as name@email.com</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>    
                            ";
                        } elseif ($_GET["error"] == "stmtfailed") {
                            echo "
                            <div class='alert alert-light alert-dismissible fade show' role='alert'>
                                <strong>Oops! There was a connection issue on our end. Try again later.</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>    
                            ";
                        } elseif ($_GET["error"] == "none") {
                            echo "
                            <div class='alert alert-light alert-dismissible fade show' role='alert'>
                                <strong>Account updated successfully!</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>    
                            ";
                        }
                    }
                    ?>

                        <?php

                        require_once 'includes/connection.php';


                         $userId=$_SESSION['users_id'];
                         $sql="SELECT * FROM users WHERE users_id='$userId'";

                         $userData=mysqli_query($connection, $sql);

                         if (!$userData){
                             echo "
                                <div class='alert alert-light alert-dismissible fade show' role='alert'>
                                    <strong>Could not fetch your account data. Try again later.</strong>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>  
                             ";
                         }
                         else {
                             while ($userRow = mysqli_fetch_assoc($userData)) {
                                 $usernameInput = $userRow["users_username"];
                                 $firstName = $userRow["users_forename"];
                                 $lastName = $userRow["users_surname"];
                                 $email = $userRow["users_email"];
                                 echo "

                                 <h3 class='fw-normal mb-4 pb-3 text-light'>My Account Details</h3>

                        <div class='form-outline mb-4'>
                            <input type='text' name='name' id='name' class='form-control form-control-lg' value='$usernameInput'' />
                            <label class='form-label text-secondary'>Username</label>
                        </div>

                        <div class='form-outline mb-4'>
                            <input type='text' name='firstName' id='firstName' class='form-control form-control-lg' value='$firstName' />
                            <label class='form-label text-secondary'>First Name</label>
                        </div>

                        <div class='form-outline mb-4'>
                            <input type='text' name='lastName' id='lastName' class='form-control form-control-lg' value='$lastName' />
                            <label class='form-label text-secondary'>Last Name</label>
                        </div>

                        <div class='form-outline mb-4'>
                            <input type='email' name='email' id='email' class='form-control form-control-lg' value='$email' />
                            <label class='form-label text-secondary '>Email address</label>
                        </div>

                        <div class='pt-1 mb-4'>
                            <input type='submit' name='editAccountSubmit' class='btn btn-secondary btn-lg btn-block' value='Save Changes'>
                        </div>

                        <div class='pt-1 mb-4'>
                            <a onclick='javascript:confirmationDelete($(this));return false;' href='includes/deleteAccount.php' type='submit' name='deleteAccountSubmit' class='btn btn-secondary btn-lg btn-block' value='Delete Account'>Delete</a>
                        </div>
                                 ";

                             }
                         }
                        ?>



                    </form>
                    <!-- Profile Form End-->
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
