<!DOCTYPE html>
<html>
<header>Results:</header>
<body>
  <table>
    <ph?

    require_once "product_config.php";

    $sql = "SELECT * FROM product_list WHERE Product_Name LIKE" .$search;
    $result = mysql_query($sql);
  
    if($result->num_row>0){

      while($row=mysql_fetch_array($result)){
        $image = $row[Photo];
        $imagedata = base64_encode(file_get_contents($image));
        echo "<tr><td>", $row[Product_ID], "</td><td>", $row[Product_Name], "</td><td>", $row[Price], </td><td>, $row[Stock], </td><td>, '<img src="data:image/jpeg;base64,'.$imagedata.'">', "</td><td>", $row[Seller_ID], "</td></tr>";
      }
    }else{
      echo "No result found.";
    }
    echo "</table>;

    mysqli_close($link);
    ?>
  <a href = "welcome.php">Back</a>
  </body>
  </html>

