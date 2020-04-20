<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$userid = "";
$errors = array();

//initializing selling variables
$product_name = "";
$price = "";
$photo = "";

//initializing searching
$search_price = "";
$search_product = "";

//initializing product marquee
$photo_display="";
$product_name_display="";
$price_display="";

//initializing purchase
$purchase_this="";
$purchase_method="";
$creditcardno="";
$securitycode="";
$name="";
$expireYY="";
$expireMM="";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'T4T');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already used.");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already used.");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password)
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Successful registration";
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($results);
    $_SESSION['userid'] = $user['id'];
  	header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "Successful login";
      $user = mysqli_fetch_assoc($results);
      $_SESSION['userid'] = $user['id'];
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password. Please try again.");
  	}
  }
}

//selling
  if (isset($_POST['sell_this'])){

    $product_name = mysqli_real_escape_string($db, $_POST['product_name']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $photo = mysqli_real_escape_string($db, $_POST['photo']);

//error message for invalid input
    if (empty($product_name)){
      array_push($errors, "Product Name is required");
    }

    if (empty($price)){
      array_push($errors, "Price is required");
    }

    if (empty($photo)){
      array_push($errors, "Photo is required");
    }

    if (count($errors) == 0){
      $_SESSION['success'] = "Your product is now on the list.";
      $userid = $_SESSION['userid'];
      $query = "INSERT INTO products (productname, price, photo, sellerid, status)
    			  VALUES('$product_name', '$price', '$photo', '$userid', 'onlist')";
      mysqli_query($db, $query);
      header('location: index.php');
    }
  }

//price estimation
  if(isset($_POST['search_price_submit'])){
    $search_price=$_POST['search_price'];

    if (empty($search_price)){
      array_push($errors, "Please input something to search price.");
    }
  }

  if(isset($_POST['reset_price'])){$search_price="";}

//product searching
  if(isset($_POST['search_product_submit'])){
    $search_product=$_POST['search_product'];

    if(empty($search_product)){
      array_push($errors, "Please input something to be searched.");
    }
  }

  if(isset($_POST['clear_search'])){$search_product="";}

  //purchasing
  if(isset($_POST['purchase_this_submit'])){
    $purchase_this=$_POST['purchase_this'];
    $query="SELECT status FROM products WHERE product_id = '$purchase_this'";
    $results=mysqli_query($db, $query);
    if(mysqli_num_rows($results)==0){
      array_push($errors, "Product with this id is not on list");
    }
    else{
      $row = $results->fetch_assoc();
      if($row['status']!='onlist'){
        array_push($errors, "Product with this id is not ont list.");
      }
    }
    $_SESSION['purchase_this'] = $purchase_this;


    if(empty($purchase_this)){
      array_push($errors, "Please input product id to make purchase.");
    }

    if(count($errors)==0){
      header('location: purchase.php');
    }
  }

  //make payment
  if(isset($_POST['purchase_submit'])){

    $purchase_method=$_POST['purchase_method'];
    $creditcardno=$_POST['cardnumber'];
    $securitycode=$_POST['code'];
    $name=$_POST['name'];
    $expireMM=$_POST['expireMM'];
    $expireYY=$_POST['expireYY'];
    $product_id=$_SESSION['purchase_this'];
    $change_item=$_POST['change'];

    if(empty($purchase_method)){
      array_push($errors, "Please choose a payment method");
    }

    //Barter
    if($purchase_method=="Barter"){
      if(empty($_POST['change'])){array_push($errors, "Please offer a thing if you trade by barter.");}
      else{
        $_SESSION['success']="Request is sent, please wait for approval.";
        $query = "SELECT * FROM products WHERE product_id = '$product_id'";
        $product=mysqli_query($db, $query);
        $data=$product->fetch_assoc();
        $userid=$_SESSION['userid'];
        $sellerid=$data['sellerid'];
        $query = "INSERT INTO request (sellerid, buyerid, status, product_id, change_item)
      			  VALUES('$sellerid', '$userid', 'Pending', '$product_id', '$change_item')";
        mysqli_query($db, $query);
        unset($_SESSION['purchase_this']);
        header("location: index.php");
      }
    }

    //purchase directly
    if($purchase_method=="Direct"){
      mysqli_query($db, "DELETE FROM products WHERE product_id='$product_id'");
      unset($_SESSION['purchase_this']);
      $_SESSION['success']="Purchase recorded. Please deliver your cash to office on time.";
      header("location: index.php");
    }

    //purchase by card
    if($purchase_method=="Credit_card"){
      if(empty($creditcardno)){
        array_push($errors, "Please input credit card number.");
      }
      if(empty($securitycode)){array_push($errors, "Please input security code.");}
      if(empty($name)){array_push($errors, "Please input the name on your card.");}
      if(empty($expireMM)){array_push($errors, "Please input the expiry month.");}
      if(empty($expireYY)){array_push($errors, "Please input the expiry year.");}

      if(count($errors)==0){
          $query = "SELECT * FROM card_information WHERE cardno='$creditcardno'AND code='$securitycode' AND expireMM='$expireMM' AND expireYY='$expireYY' AND name='$name'";
          $results = mysqli_query($db, $query);
          $purchase_this=$_SESSION['purchase_this'];
          if(mysqli_num_rows($results)==1){
            mysqli_query($db, "DELETE FROM products WHERE product_id='$purchase_this'");
            $_SESSION['success']="Payment Successful";
            unset($_SESSION['purchase_this']);
            header("location: index.php");
          }
          else{
            array_push($errors, "Card authenticatin failed: Wrong information.");
          }
        }
    }
  }

  //request action
  if(isset($_POST['accept_btn'])||isset($_POST['reject_btn'])){
    $userid=$_SESSION['userid'];
    if(empty($_POST['action_id'])){array_push($errors, "Please enter a request id.");}
    else{
      $action_on=$_POST['action_id'];
      $query="SELECT * FROM request WHERE requestid = '$action_on' AND (sellerid = '$userid' || buyerid = '$userid')";
      $result = mysqli_query($db, $query);
      if(mysqli_num_rows($result)==0){array_push($errors, "Please enter a valid id.");}
      else{
        if(isset($_POST['accept_btn'])){
          mysqli_query($db, "UPDATE request SET status='Accepted' WHERE requestid='$action_on'");
        }
        if(isset($_POST['reject_btn'])){
          mysqli_query($db, "UPDATE request SET status='Rejected' WHERE requestid='$action_on'");
        }
      }
    }
  }
?>
