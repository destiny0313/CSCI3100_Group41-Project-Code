<?php
include('server.php');

if (!isset($_SESSION['username'])){
  header('location: login.php');
} ?>
<!DOCTYPE html>
<html>
<head>
  <title>Price Estimation</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <center>
  <div class="logo_banner">
    <img src = "Logo.png" width = "400px">
  </div>
  <div class = "header">
    <h2>Price Estimation</h2>
  </div>

  <form method="post" action="estimation.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Search for price:</label>
      <input type="text" name="search_price" value="<?php echo $search_price; ?>">
    </div>
    <p><button type="submit" class="btn" name="search_price_submit">Search</button>
    <button type="submit" class="btn" name="clear_price">Clear</button></p>
    <p><?php include('estimate_result.php');?>
  <p>
    <a href="index.php">Home Page</a>
  </p>
  <p>
    <a href="index.php?logout='1'">Logout</a></p></center>
  </div>
</form>
</body>
</html>
