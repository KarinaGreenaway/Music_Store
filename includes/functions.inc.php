<?php

//Functions for registration Users

function emptyInputRegister($username, $email, $firstName,$lastName, $pwd, $pwdRepeat){
    $result=false;
    if(empty($username)||empty($email)||empty($firstName)||empty($lastName)||empty($pwd)||empty($pwdRepeat)){
        $result=true;
    }
    return $result;
}

function invalidUsername($username){
    $result=false;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result=true;
    }
    return $result;
}

function invalidEmail($email){
    $result=false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result=true;
    }
    return $result;
}

function pwdMatch($pwd,$pwdRepeat){
    $result=false;
    if($pwd !== $pwdRepeat){
        $result=true;
    }
    return $result;
}

function usernameExists($connection, $username, $email){
    $sql= "SELECT * FROM users WHERE users_username = ? OR users_email = ?;";
    //prepared statements so users cannot insert their own sql script through the
    // variables $username and $email as they are not directly embedded
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../registration.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss",$username, $email);
    mysqli_stmt_execute($stmt);

    $resultData= mysqli_stmt_get_result($stmt);

    if ($row=mysqli_fetch_assoc($resultData)){ //fetch data as associative array if it exists and create variable for log in
        return $row;
    }
    else{
        $result=false;
        return $result;
    }
    //mysqli_stmt_close($stmt);
}

function createUser($connection, $firstName, $lastName, $email, $username, $pwd){
    $sql= "INSERT INTO users(users_forename, users_surname, users_email, users_username, users_password) VALUES (?,?,?,?,?);";
    //prepared statements so users cannot insert their own sql script through the
    // variables needed as they are not directly embedded
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../registration.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $firstName,$lastName, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../index.php?error=none");
    exit();
}

function emptyInputSignin($user, $pwd){
    $result=false;
    if(empty($user)||empty($pwd)){
        $result=true;
    }
    return $result;
}

//Functions for sign in page

function signinUser($connection,$user,$pwd){
    $usernameExists=usernameExists($connection, $user, $user);
    if ($usernameExists === false){
        header("location:../signin.php?error=wronglogin");
        exit();
    }
    $pwdHashed = $usernameExists["users_password"];
    $checkPwd= password_verify($pwd, $pwdHashed);

    if ($checkPwd === false){
        header("location:../signin.php?error=wronglogin");
        exit();
    }
    //elseif ($checkPwd === true){
    else{
        session_start();
        $_SESSION["users_id"]= $usernameExists["users_id"];
        $_SESSION["users_username"]= $usernameExists["users_username"];
        $_SESSION["users_is_admin"]= $usernameExists["users_is_admin"];
        header("location:../index.php");
        exit();
    }
}

//Functions for home page

function getProducts($connection){
    $sql= "SELECT * FROM product order by rand() LIMIT 0,12;";

    $resultData= mysqli_query($connection,$sql);

    //$productRow=mysqli_fetch_assoc($resultData);
    //echo $productRow["product_name"];

    while($productRow=mysqli_fetch_assoc($resultData)){
        $productId=$productRow["product_id"];
        $productName=$productRow["product_name"];
        $categoryName=$productRow["category_name"];
        $productPrice=$productRow["product_sell_price"];
        $productImage=$productRow["product_image"];

        echo "

        <div class='col-sm-6 col-md-3 col-lg-2 pt-4'>
           <div class='card bg-light border-secondary' style='height: 50vh' >
               <img class='card-img-top' src='admin/product_images/$productImage' alt='$productName Image' style='width: 100%; height: 25vh; object-fit: contain;'>
               <div class='card-body h-100 d-flex flex-column'>
                   <h5 class='card-title'>$productName</h5>
                   <h6 class='card-subtitle mb-2 text-muted'>$categoryName</h6>
                   <p class='card-text'>£$productPrice</p>
                   <a href='#' class='card-link text-secondary'>Read More</a>
        <a href='#' class='btn btn-dark mt-auto'>Add to Cart</a>
               </div>
           </div>
       </div>
       
        ";
    }
}

//Functions for admin page

function getProductTable($connection){

    //Below reads all rows from the product table in the database
    $sql= "SELECT * FROM product;";
    $resultData= mysqli_query($connection,$sql);

    //Below runs through an associative array of the product table data and echoes it as rows for the admins table
    while($productRow=mysqli_fetch_assoc($resultData)){

        echo "
 
            <tr>
                <td>$productRow[product_id]</td>
                <td>$productRow[product_name]</td>
                <td>$productRow[category_name]</td>
                <td data-toggle='tooltip' title='$productRow[product_description]' style='max-width: 250px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;'>
                    $productRow[product_description]</td>
                <td>$productRow[product_stock]</td>
                <td>$productRow[product_buy_price]</td>
                <td>$productRow[product_sell_price]</td>
                <td>$productRow[product_image]</td>
                <td class='d-flex flex-row'>
                    <a class='btn btn-outline-secondary m-1' href='includes/editProduct.inc.php?id=$productRow[product_id]'> Edit </a>
                    <a class='btn btn-outline-secondary m-1' href='includes/deleteProduct.inc.php?id=$productRow[product_id]'>Delete</a>

                </td>
            </tr>
    ";
    }
}

// Error handling for empty inputs
function emptyInputCreateProduct($name,$category,$description,$stock,$buyPrice,$sellPrice,$image){
    $result=false;
    if(empty($name)||empty($category)||empty($description)||empty($stock)||empty($buyPrice)||empty($sellPrice)||empty($image)){
        $result=true;
    }
    return $result;
}

function invalidProductName($name){
    $result=false;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $name)){
        $result=true;
    }
    return $result;
}

function invalidProductStock($email){
    $result=false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result=true;
    }
    return $result;
}

function invalidProductPrice($pwd,$pwdRepeat){
    $result=false;
    if($pwd !== $pwdRepeat){
        $result=true;
    }
    return $result;
}

function productExists($connection, $username, $email){
    $sql= "SELECT * FROM users WHERE users_username = ? OR users_email = ?;";
    //prepared statements so users cannot insert their own sql script through the
    // variables $username and $email as they are not directly embedded
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../registration.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss",$username, $email);
    mysqli_stmt_execute($stmt);

    $resultData= mysqli_stmt_get_result($stmt);

    if ($row=mysqli_fetch_assoc($resultData)){ //fetch data as associative array if it exists and create variable for log in
        return $row;
    }
    else{
        $result=false;
        return $result;
    }
}

function createProduct($connection, $firstName, $lastName, $email, $username, $pwd){
    $sql= "INSERT INTO users(users_forename, users_surname, users_email, users_username, users_password) VALUES (?,?,?,?,?);";
    //prepared statements so users cannot insert their own sql script through the
    // variables needed as they are not directly embedded
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../registration.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $firstName,$lastName, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../index.php?error=none");
    exit();
}
