<?php
include_once 'header.php';
?>



<section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 mt-5 px-4 ">

                <div class="d-flex align-items-center offset-3" >

                    <!-- Profile Form-->
                    <form action="includes/account.inc.php" method="post" id="registerForm" class="align-middle" style="width: 23rem;" >

                        <?php

                        require_once 'includes/connection.php';


                         $userId=$_SESSION['users_id'];
                         $sql="SELECT * FROM users WHERE users_id='$userId'";

                         $userData=mysqli_query($connection, $sql);

                         if (!$userData){
                             echo " <h1 class='alert alert-danger'>Could not fetch your account data. Try again later.</h1> ";
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
                            <input type='submit' name='deleteAccountSubmit' class='btn btn-secondary btn-lg btn-block' value='Delete Account'>
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
            <div class="col-sm-6 px-0 d-none d-sm-block vh-100">
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
