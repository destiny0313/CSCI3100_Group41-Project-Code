<?php
include('server.php');

if(!isset($_SESSION['username'])){
  header('location: login.php');

if(!isset($_SESSION['purchase_this'])){
  header('location: buying.php');
}
}?>

<!DOCTYPE html>
<html>
<head>
  <title>Purchase now</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <center>
    <div class="logo_banner">
      <img src = "Logo.png" width = "400px">
    </div>
    <div class = "header">
      <h2>Purchase</h2>
    </div>

    <form method="post" action="purchase.php">
      <?php include('errors.php'); ?>
      <p align="left">Product id: <?php echo $_SESSION['purchase_this']?>
        <br/><br/></p>
      <label for='purchase_method'>Choose a purchasing method:</label>
      <select name='purchase_method'>
        <option value="">-Select-</option>
        <option value="Credit_card">Credit Card</option>
        <option value="Direct">Direct</option>
        <option value="Barter">Barter</option>
      </select>
      <p><strong><br/>*Give a thing you offer if you trade by barter.*</strong></p>
      <label><br/>I offer</label>
      <input type="text" name="change">
      <p><strong><br/>*Fill in the followings if you purchase by credit card.*</strong></p>
      <div class="input-group">
        <label>Credit card number</label>
        <input type="number" name="cardnumber">
      </div>
      <div class="input-group">
        <label>Security code</label>
        <input type="password" name="code">
      </div>
      <div class="input-group">
        <label>Name</label>
         <input type="text" name="name">
       </div>
       <p align="left"><br/>Expiry Date:
       <select name='expireMM' id='expireMM'>
    <option value=''>-Month-</option>
    <option value='01'>January</option>
    <option value='02'>February</option>
    <option value='03'>March</option>
    <option value='04'>April</option>
    <option value='05'>May</option>
    <option value='06'>June</option>
    <option value='07'>July</option>
    <option value='08'>August</option>
    <option value='09'>September</option>
    <option value='10'>October</option>
    <option value='11'>November</option>
    <option value='12'>December</option>
</select>
<select name='expireYY' id='expireYY'>
    <option value=''>-Year-</option>
    <option value='2020'>2020</option>
    <option value='2021'>2021</option>
    <option value='2022'>2022</option>
    <option value='2023'>2023</option>
    <option value='2024'>2024</option>
    <option value='2025'>2025</option>
    <option value='2026'>2026</option>
</select>
</p>
<br/>
<div class="input-group">
  <button type="submit" class="btn" name="purchase_submit">Submit</button>
</div>
<p><a href='index.php'>Home Page</a></p>
<p><a href='index.php?logout="1"'>Logout</a></p>
</div>
</form>
</body>
</html>
