<!DOCTYPE html>
<html>
<header></header>
<body>
<php?
  require_once "price_config.php";
  
  $sql="SELECT * FROM price WHERE product_name LIKE" .$product;
  $result=conn->query($sql);
  
  if($result->row_num>0){
    while($row=$result->fetch_assoc()){
      $estimation=$row[marketprice]*(1-$row[depre_per_year]*$year);
      echo "Estimated price of", $row[product_name], ":", $estimation;
    }
  }else{
    echo "No result found."
  }
  
  mysqli_close($link);
  ?>
  <a href="shopping.php>Back</a>
  </body>
  </html>
