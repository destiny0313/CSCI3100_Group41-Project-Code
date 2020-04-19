<?php
include('server.php');
if (!isset($_SESSION['username'])){
  header('location: login.php');
} ?>
<!DOCTYPE html>
<html>
<head>
  <title>Buying on T4T!</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <center>
  <div class="logo_banner">
    <img src = "Logo.png" width = "400px">
  </div>
  <div class ="header">
    <h2>Buying</h2>
  </div>

  <form method="post" action="buying.php">
    <?php include('errors.php');?>
    <div class="input-group">
      <label>Search for product:</label>
      <input type="text" name="search_product" value="<?php echo $search_product;?>">
    </div>
    <p><button type="submit" class="btn" name="search_product_submit">Search</button>
    <button type="submit" class="btn" name="clear_search">Clear</button></p>
    <p><br/></p>
    <?php include ('search_result.php')?>

      <div class="input-group">
        <label> Purchase: (Please input product id)</label>
        <input type="number" name="purchase_this" value="<?php echo $purchase_this;?>">
      </div>
      <p><button onclick="location.href='purchase.php'" type="submit" class="btn" name="purchase_this_submit">Purchase</button></p>
    <p>
      <a href="index.php"><br/>Home Page</a>
    </p>
    <p>
      <a href="index.php?logout='1'">Logout</a></p></center>
    </div>
  </form>
</body>
</html>
