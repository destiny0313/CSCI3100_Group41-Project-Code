<?php
  session_start();

  if (!isset($_SESSION['username'])) {
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to T4T!</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="logo_banner">
    <img src = "Logo.png" width ="400px">
  </div>
<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php
          	echo $_SESSION['success'];
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p><center>Welcome! <strong><?php echo $_SESSION['username']; ?></strong>, what do you want to do?</p>
      <img src="truck.png" width="93%">
      <button onclick="location.href='selling.php'" class="btn" name="selling_link">Sell</button>
      <button onclick="location.href='buying.php'" class="btn" name="buying_link">Buy</button>
      <button onclick="location.href='messaging.php'" class="btn" name="messaging_link">Message</button>
      <button onclick="location.href='estimation.php'" class="btn" name="estimation_link">Price Estimation</button>
      <p><a href="index.php?logout='1'">logout</a></p></center>
    <?php endif ?>
</div>

</body>
</html>
