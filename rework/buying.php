<?php include('server.php') ?>
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
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Search for product:</label>
      <input type="text" name="search_product" value="<?php echo $search_product;?>">
    </div>
    <p><button type="submit" class="btn" name="search_product_submit">Search</button></p>
    <p>
      <a href="index.php">Home Page</a>
    </p>
    <p>
      <a href="index.php?logout='1'">Logout</a></p></center>
    </div>
  </form>
</body>
</html>
