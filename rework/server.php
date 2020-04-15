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

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');

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

    $errors = 0;
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
      $query = "INSERT INTO products (productname, price, photo, sellerid)
    			  VALUES('$product_name', '$price', '$photo', $userid)";
      mysqli_query($db, $query);
      header('location: index.php');
    }
  }

?>
