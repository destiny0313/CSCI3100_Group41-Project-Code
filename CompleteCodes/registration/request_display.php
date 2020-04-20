<?php
echo "<style>table{border: 1px solid black; width: 100%;}td{text-align: center;}</style>";
$userid=$_SESSION['userid'];
$query="SELECT * FROM request WHERE buyerid='$userid'";
$result=mysqli_query($db, $query);
echo "<p><h2><strong>Request sent</strong></p></h2><hr>";
echo "<table>
<tr><th>Seller ID</th><th>Product</th><th>Offer</th><th>Status</th><th>Request ID</th></tr>";
while($row=$result->fetch_assoc()){
  $product_id=$row['product_id'];
  $name_query="SELECT * FROM products WHERE product_id='$product_id'";
  $name=mysqli_query($db, $name_query);
  $name_output=mysqli_fetch_assoc($name);
  echo "<tr><td>";
  echo $row['sellerid'];
  echo "</td><td>";
  echo $name_output['productname'];
  echo "</td><td>";
  echo $row['change_item'];
  echo "</td><td>";
  echo $row['status'];
  echo "</td><td>";
  echo $row['requestid'];
  echo "</td></tr>";
}
echo "</table><br/>";


$query="SELECT * FROM request WHERE sellerid='$userid'";
$result=mysqli_query($db, $query);
echo "<p><h2><strong>Request received</strong></h2></p><hr>";
echo "<table>
<tr><th>Buyer ID</th><th>Product</th><th>Offer</th><th>Status</th><th>Request ID</th></tr>";
while($row=$result->fetch_assoc()){
  $product_id=$row['product_id'];
  $name_query="SELECT * FROM products WHERE product_id='$product_id'";
  $name=mysqli_query($db, $name_query);
  $name_output=mysqli_fetch_assoc($name);
  echo "<tr><td>";
  echo $row['buyerid'];
  echo "</td><td>";
  echo $name_output['productname'];
  echo "</td><td>";
  echo $row['change_item'];
  echo "</td><td>";
  echo $row['status'];
  echo "</td><td>";
  echo $row['requestid'];
  echo "</td></tr>";
}
echo "</table><br/>";
 ?>
