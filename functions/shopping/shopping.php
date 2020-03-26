<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>
  <table>
    <tr>
      <th>Product ID
      <th>Name
      <th>Price
      <th>Stock
      <th>Photo
      <th>Seller ID
    </tr>
    <?php
      require_once "product_config.php";
      
      $sql = "SELECT Product_ID, Product_Name, Price, Stock, Photo, Seller_ID FROM products";
      $result = $conn-> query($sql);
      
      if($result-> num_row > 0){
        while($row = $result->fetch_assoc()){
          $image = $row[Photo];
          $imagedata = base64_encode(file_get_contents($image));
          echo "<tr><td>", $row[Product_ID], "</td><td>", $row[Product_Name], "</td><td>", $row[Price], </td><td>, $row[Stock], </td><td>, '<img src="data:image/jpeg;base64,'.$imagedata.'">', "</td><td>", $row[Seller_ID], "</td></tr>";
          }
        echo "</table>";
      }else{
        echo "Oh no! There is no product on the list.";
      }
      
      mysqli_close($link);
    ?>
</body>
</html>
