<?php

//Functions for registration Users

/**
 * emptyInputRegister checks if any of the
 * registration forms inputs have not been filled in.
 * This is then used in register.inc.php to pass the relevent 
 * error using a header.
 * @param mixed $username
 * @param mixed $email
 * @param mixed $firstName
 * @param mixed $lastName
 * @param mixed $pwd
 * @param mixed $pwdRepeat
 * @return bool
 */
function emptyInputRegister($username, $email, $firstName,$lastName, $pwd, $pwdRepeat){
    $result=false;
    if(empty($username)||empty($email)||empty($firstName)||empty($lastName)||empty($pwd)||empty($pwdRepeat)){
        $result=true;
    }
    return $result;
}

/**
 * invalidUsername checks that the username entered during 
 * registration only contains letters or numbers.
 * @param mixed $username
 * @return bool
 */
function invalidUsername($username){
    $result=false;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result=true;
    }
    return $result;
}

/**
 * invalidEmail checks that the email entered during registration is of valid email format
 * @param mixed $email
 * @return bool
 */
function invalidEmail($email){
    $result=false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result=true;
    }
    return $result;
}

/**
 * pwdMatch checks that both the password 
 * entries during registration are identical to each other.
 * @param mixed $pwd
 * @param mixed $pwdRepeat
 * @return bool
 */
function pwdMatch($pwd,$pwdRepeat){
    $result=false;
    if($pwd !== $pwdRepeat){
        $result=true;
    }
    return $result;
}

/**
 * usernameExists checks if there is already a
 * user in the database with an identical username or email as entered in the registration form.
 * This function uses prepared statements  so users cannot insert their own sql script through 
 * the variables $username and $email as they will not be directly embedded.
 * If the statement fails the error is passed through a header which will be checked and echoed 
 * in registration.php
 * @param mixed $connection
 * @param mixed $username
 * @param mixed $email
 * @return array|bool|null
 */
function usernameExists($connection, $username, $email){
    $sql= "SELECT * FROM users WHERE users_username = ? OR users_email = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../registration.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss",$username, $email);
    mysqli_stmt_execute($stmt);

    $resultData= mysqli_stmt_get_result($stmt);

    if ($row=mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result=false;
        return $result;
    }
}

/**
 * createUser uses the registration input entries to insert
 * the new user into the database.
 * This function uses prepared statements  so users cannot insert their own sql script through 
 * the variables $username and $email as they will not be directly embedded.
 * If the statement fails the error is passed through a header which will be checked and echoed 
 * in registration.php
 * 
 * @param mixed $connection
 * @param mixed $firstName
 * @param mixed $lastName
 * @param mixed $email
 * @param mixed $usernameInput
 * @param mixed $pwd
 * @return never
 */
function createUser($connection, $firstName, $lastName, $email, $usernameInput, $pwd){
    $sql= "INSERT INTO users(users_forename, users_surname, users_email, users_username, users_password) VALUES (?,?,?,?,?);";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../registration.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
   
    $fmtdFirstName = ucfirst($firstName);
    $fmtdLastName = ucfirst($lastName);

    mysqli_stmt_bind_param($stmt, "sssss", $fmtdFirstName,$fmtdLastName, $email, $usernameInput, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    signinUser($connection, $usernameInput, $pwd);
    exit();
}

//Functions for sign in page

/**
 * emptyInputSignin checks if any of the
 * sign in forms inputs have not been filled in.
 * This is then used in signin.inc.php to pass the relevent 
 * error using a header.
 * @param mixed $user
 * @param mixed $pwd
 * @return bool
 */
function emptyInputSignin($user, $pwd){
    $result=false;
    if(empty($user)||empty($pwd)){
        $result=true;
    }
    return $result;
}

/**
 * signinUser uses the sign in input entries $user and $pwd to sign in
 * the user then set the session variables. The $user variable can hold either the username 
 * or email of the user as both of the relevent columns of the database are checked.
 * If there is no matching user in the database a header is used to pass this error.
 * If the user exists the password entered is verified against the password stored in 
 * the database. For security the password stored is hashed, so the one entered will 
 * be hashed before verification.
 * @param mixed $connection
 * @param mixed $user
 * @param mixed $pwd
 * @return never
 */
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

/**
 * getProducts uses the $connection variable to run through each 
 * assoociative array created from each tuple of the product table and 
 * creates the html card for each product.
 * @param mixed $connection
 * @return void
 */
function getProducts($connection){
    $sql= "SELECT * FROM product order by rand() LIMIT 0,12;";

    $resultData= mysqli_query($connection,$sql);

    while($productRow=mysqli_fetch_assoc($resultData)){
        $productId=$productRow["product_id"];
        $productName=$productRow["product_name"];
        $categoryName=$productRow["category_name"];
        $productPrice=$productRow["product_sell_price"];
        $productImage=$productRow["product_image"];

        echo "

        <div class='col-sm-6 col-md-4 col-lg-4 col-xl-3 pt-4'>
           <div class='card bg-light border-secondary border-2' style='height: 70vh' >
               <img class='card-img-top' src='admin/product_images/$productImage' alt='$productName Image' style='width: 100%; height: 30vh; object-fit: contain;'>
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

//Functions for search results page

/**
 * getResults uses LIKE and the % wildcard to search for the pattern 
 * specified by the users text search within the name, category and description 
 * columns of the product table. This returns the results as product cards.
 * @param mixed $connection
 * @param mixed $search
 * @return void search results
 */
function getResults($connection, $search){

    $sql = "SELECT * FROM product WHERE product_name LIKE '%$search%' OR category_name LIKE '%$search%' OR product_description LIKE '%$search%'";

    $resultData= mysqli_query($connection,$sql);

    if ($resultData->num_rows>0){
        while ($productRow = mysqli_fetch_assoc($resultData)) {

            $productName=$productRow["product_name"];
            $categoryName=$productRow["category_name"];
            $productPrice=$productRow["product_sell_price"];
            $productImage=$productRow["product_image"];

            echo "

            <div class='col-sm-6 col-md-4 col-lg-4 col-xl-3 pt-4'>
            <div class='card bg-light border-secondary border-2' style='height: 70vh' >
                <img class='card-img-top' src='admin/product_images/$productImage' alt='$productName Image' style='width: 100%; height: 30vh; object-fit: contain;'>
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

else{
    echo "0 records";
}
}

//Functions for admin page

/**
 * getProductTable reads all the products within the product table
 * of the database by running through an associative array of each
 * row and creating an html row for each to be displayed in admin.php
 * @param mixed $connection
 * @return void products table
 */
function getProductTable($connection){

    $sql= "SELECT * FROM product;";
    $resultData= mysqli_query($connection,$sql);

    while($productRow=mysqli_fetch_assoc($resultData)){

        echo "
 
            <tr>
                <td>$productRow[product_id]</td>
                <td>$productRow[product_name]</td>
                <td>$productRow[category_name]</td>
                <td data-toggle='tooltip' title='$productRow[product_description]' style='max-width: 250px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;'>
                    $productRow[product_description]</td>
                <td>$productRow[product_stock]</td>
                <td>£$productRow[product_buy_price]</td>
                <td>£$productRow[product_sell_price]</td>
                <td>$productRow[product_image]</td>
                <td class='d-flex flex-row'>
                    <a class='btn btn-outline-secondary m-1' href='updateProduct.php?id=$productRow[product_id]'> Edit </a>
                    <input type='hidden' name='id' value='$productRow[product_id]'/>
                    <input type='submit' name='deleteProductSubmit' class='btn btn-outline-secondary m-1' value='Delete' />

                </td>
            </tr>
    ";
    }
}

/**
 * getProductCategories reads all the rows of the category table by
 * running through an associative array of each and creating the resultant
 * html option for the category selection dropdown in admin.php
 * @param mixed $connection
 * @return void category selection drop down
 */
function getProductCategories($connection){

    $sql= "SELECT * FROM category;";
    $resultData= mysqli_query($connection,$sql);

    while($categoryRow=mysqli_fetch_assoc($resultData)){
        echo "
        <option value='$categoryRow[category_name]'>$categoryRow[category_name]</option>
        ";
    }
}

/**
 * emptyInputCreateProduct checks if any of the inputs of the 
 * add product or update product form have not been filled in. The boolean result is 
 * then used in createProduct.inc.php to pass an error to admin.php 
 * through a header if necessary.
 * @param mixed $name
 * @param mixed $category
 * @param mixed $description
 * @param mixed $stock
 * @param mixed $buyPrice
 * @param mixed $sellPrice
 * @param mixed $image
 * @return bool
 */
function emptyInputCreateProduct($name,$category,$description,$stock,$buyPrice,$sellPrice,$image){
    $result=false;
    if(empty($name)||empty($category)||empty($description)||empty($stock)||empty($buyPrice)||empty($sellPrice)||empty($image)||($category==="Select a Category")){
        $result=true;
    }
    return $result;
}

/**
 * invalidProductStock checks that the stock number entered into
 * the add product or update product form is above 0. If the result 
 * is true (stock 0 or below) this result is used to pass an error 
 * through a header to the admin page to notify the user. 
 * @param mixed $stockInput
 * @return bool
 */
function invalidProductStock($stockInput){
    $result=false;
    if($stockInput<=0){
        $result=true;
    }
    return $result;
}

/**
 * invalidProductPrice checks that the buy price and sell price entered into
 * the add product or update product form is above 0 and no more than 2 decimal places.
 * If the result is true (price below 0 or above 2 decimal places) this result is used to 
 * pass an error through a header to the admin page to notify the user. 
 * @param mixed $buyPriceInput
 * @param mixed $sellPriceInput
 * @return bool
 */
function invalidProductPrice($buyPriceInput,$sellPriceInput){
    $result=false;
    if($buyPriceInput<0||$sellPriceInput<0||preg_match('/\.\d{3,}/', $buyPriceInput)||preg_match('/\.\d{3,}/', $sellPriceInput)){
        $result=true;
    }
    return $result;
}

/**
 * productExists checks if a product with an identical name and 
 * category already exists within the product table and if so, 
 * returns the row. This result would then be used to pass an 
 * error through a header to the admin page which is used to 
 * notify the user.
 * @param mixed $connection
 * @param mixed $nameInput
 * @param mixed $categoryInput
 * @return array|bool|null
 */
function productExists($connection, $name, $category){
    $sql= "SELECT * FROM product WHERE product_name = ? AND category_name = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss",$name, $category);
    mysqli_stmt_execute($stmt);

    $resultData= mysqli_stmt_get_result($stmt);

    if ($row=mysqli_fetch_assoc($resultData)){ 
        return $row;
    }
    else{
        $result=false;
        return $result;
    }
}

/**
 * uploadImage moves the image file uploaded by the user
 * through the add product or update product form to the 
 * product_images folder within the admin folder. This same 
 * file name is later stored in the database so it can call 
 * this image file when needed.
 * @param mixed $image
 * @param mixed $tmp_image
 * @return void
 */
function uploadImage($image, $tmp_image){
    move_uploaded_file($tmp_image, "../admin/product_images/$image");
}

/**
 * createProduct uses the add product forms input entries to insert
 * the new product and its details into the database.
 * This function uses prepared statements  so users cannot insert their own sql script through 
 * the variables inputted as they will not be directly embedded in the sql script.
 * If the statement fails the error is passed through a header which will be checked and echoed 
 * in admin.php
 * @param mixed $connection
 * @param mixed $name
 * @param mixed $category
 * @param mixed $description
 * @param mixed $stock
 * @param mixed $buyPrice
 * @param mixed $sellPrice
 * @param mixed $image
 * @return never
 */
function createProduct($connection, $name, $category, $description, $stock, $buyPrice, $sellPrice, $image){

    $sql= "INSERT INTO product(product_name,category_name, product_description, product_stock,product_buy_price, product_sell_price,product_image) VALUES (?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../admin.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssidds", $name, $category, $description, $stock, $buyPrice, $sellPrice, $image);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=createnone"); 
    exit();
}

/**
 * updateProduct uses the update product forms input entries to update the selected product 
 * and its details in the database.
 * This function uses prepared statements so users cannot insert their own sql script through 
 * the variables inputted as they will not be directly embedded in the sql script.
 * If the statement fails the error is passed through a header which will be checked and echoed 
 * in admin.php
 * @param mixed $connection
 * @param mixed $id
 * @param mixed $nameInput
 * @param mixed $categoryInput
 * @param mixed $descriptionInput
 * @param mixed $stockInput
 * @param mixed $buyPriceInput
 * @param mixed $sellPriceInput
 * @param mixed $imageInput
 * @param mixed $tmpImageInput
 * @return never
 */
function updateProduct($connection,$id, $nameInput, $categoryInput, $descriptionInput, $stockInput, $buyPriceInput, $sellPriceInput, $imageInput,$tmpImageInput){
    move_uploaded_file($tmpImageInput, "../admin/product_images/$imageInput");

    $sql = "UPDATE product SET product_name=?, category_name=?, product_description=?, product_stock=?, product_buy_price=?, product_sell_price=?, product_image=? WHERE product_id='$id';";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $errorMessage = "Invalid query: " . $connection->error;
        exit;
    }
    mysqli_stmt_bind_param($stmt, "sssidds", $nameInput, $categoryInput, $descriptionInput, $stockInput, $buyPriceInput, $sellPriceInput, $imageInput);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=updatenone");
    exit;
}

/**
 * deleteProduct uses the $id variable of the product table rows hidden input value
 * to delete the specified product from the products table in the database.
 * If the statement fails the error is passed through a header which will be checked and echoed 
 * in admin.php
 * @param mixed $connection
 * @param mixed $id
 * @return never
 */
function deleteProduct($connection, $id){

    $sql = "DELETE from product WHERE product_id='$id'";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin.php?error=deletenone");
    exit();
}


// Functions for account page

/**
 * emptyInputUpdateAccount checks if any of the inputs of the update
 * account form have not been filled in. The boolean result is 
 * then used in account.inc.php to pass an error to profile.php 
 * through a header if necessary.
 * @param mixed $usernameInput
 * @param mixed $firstName
 * @param mixed $lastName
 * @param mixed $email
 * @return bool
 */
function emptyInputUpdateAccount($usernameInput, $firstName, $lastName, $email){ 
    $result=false;
    if(empty($usernameInput)||empty($firstName)||empty($lastName)||empty($email)){
        $result=true;
    }
    return $result;
}

/**
 * invalidName checks if the first name or last name inputs of the update
 * account form only contain letters. The boolean result is 
 * then used in account.inc.php to pass an error to profile.php 
 * through a header if necessary.
 * @param mixed $firstName
 * @param mixed $lastName
 * @return bool
 */
function invalidName($firstName, $lastName){
    $result=false;
    if(!preg_match("/^[a-zA-Z]+$/", $firstName)||!preg_match("/^[a-zA-Z]+$/", $lastName)){
        $result=true;
    }
    return $result;
}

/**
 * updateAccount uses the update account forms input entries to update the current users 
 * details in the users table in the database.
 * This function uses prepared statements so users cannot insert their own sql script through 
 * the variables inputted as they will not be directly embedded in the sql script.
 * If the statement fails the error is passed through a header which will be checked and echoed 
 * in profile.php
 * @param mixed $connection
 * @param mixed $usernameInput
 * @param mixed $firstName
 * @param mixed $lastName
 * @param mixed $email
 * @param mixed $id
 * @return never
 */
function updateAccount($connection, $usernameInput, $firstName, $lastName, $email, $id){
    $sql2 = "UPDATE users SET users_username=?, users_forename=?,users_surname=?,users_email=? WHERE users_id='$id';";
    $stmt2 = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
        header("location: ../profile.php?error=stmtfailed");
        exit();
    }

    $fmtdFirstName = ucfirst($firstName);
    $fmtdLastName = ucfirst($lastName);

    mysqli_stmt_bind_param($stmt2, "ssss", $usernameInput, $fmtdFirstName, $fmtdLastName, $email);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);
    header("location: ../profile.php?error=none");
    exit();
}

/**
 * deleteAccount uses the $id variable taken from the session variable users_id
 * to delete the user from the users table in the database.
 * If the statement fails the error is passed through a header which will be checked and echoed 
 * in admin.php
 * @param mixed $connection
 * @param mixed $id
 * @return never
 */
function deleteAccount($connection, $id){
    $sql = "DELETE from users WHERE users_id='$id'";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../profile.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    require_once 'signout.inc.php';

    //header("location: ../index.php?error=none");
    exit();
}