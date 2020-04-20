<?php include('server.php');
if (!isset($_SESSION['username'])) {
  header('location: login.php');
}?>
<!DOCTYPE html>
<html>
<head>
  <style>
  .accept_btn {
    margin: 10px;
    padding: 10px;
    font-size: 12px;
    color: #000000;
    background: #3FBF3F;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .reject_btn {
    padding: 10px;
    font-size: 12px;
    color: #000000;
    background: #E21C51;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
</style>
  <title>My Request</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <center>
    <div class="logo_banner">
      <img src = "Logo.png" width = "400px">
    </div>
    <div class = "header">
      <h2>My Request</h2>
    </div>
    <form method="post" action="request.php">
      <?php include('errors.php')?>
      <?php include('request_display.php')?>
      <div class="input-group">
        <label>Action to request received (Please input request id)</label>
        <p><input type="number" name=action_id></p>
        <button type="submit" class="accept_btn" name="accept_btn">Accept</button>
        <button type="submit" class="reject_btn" name="reject_btn">Reject</button>
      <p><a href="index.php">Home Page</a></p>
      <p><a href="index.php?logout='1'">Logout</a></p>
    </form>
  </center>
</body>
</html>
