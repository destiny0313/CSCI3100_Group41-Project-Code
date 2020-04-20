<?php

if(!(empty($search_product))){
  $search_query = "SELECT * FROM products WHERE productname LIKE '%{$search_product}%'";
  $search_result = mysqli_query($db, $search_query);
  if(mysqli_num_rows($search_result)==0){
    echo "<strong>No result found.</strong>";
  }
  else{
    echo "<p align='left'><strong>Search Result: </strong></p>";
    echo "<marquee behavior ='scroll' scrollmount='2.5' direction='up'
      onmouseover='this.stop();' onmouseout='this.start();' height='250px'>";
      while($searchrow = $search_result->fetch_assoc()){
        echo "<center><p><strong>Product ID: </strong>";
        echo $searchrow['product_id'];
        echo "</p><p><img src='";
        echo $searchrow['photo'];
        echo "' width=50%></p>";
        echo "<p><strong>Product:</strong>";
        echo $searchrow['productname'];
        echo "</p><p><strong>Value:</strong> HKD ";
        echo $searchrow['price'];
        echo "</p><br/>";
        echo "</center>";
      }
      echo "</marquee>";
    }
  }
  else{
    $productdb = "SELECT productname, price, photo, product_id FROM products";
    $productdb_result = $db->query($productdb);
    if($productdb_result->num_rows > 0){
      echo "<marquee behavior='scroll' scrollmount='2.5' direction='up'
            onmouseover='this.stop();' onmouseout='this.start();' height='250px'>";
      while($row = $productdb_result->fetch_assoc()){
        echo "<center>";
        echo "<p><strong>ID: </strong>";
        echo $row['product_id'];
        echo "</p><p><img src='";
        echo $row['photo'];
        echo "' width=50%></p>";
        echo "<p><strong>Product: </strong>";
        echo $row['productname'];
        echo "</p><p><strong>Value:</strong> HKD ";
        echo $row['price'];
        echo "</p><br/>";
        echo "</center>";
      }
      echo "</marquee>";
    }else{echo "<h4>No product available at the moment.</h4>";}
  }
