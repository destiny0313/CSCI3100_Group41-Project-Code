<?php

if(!(empty($search_price))){
  $search_query = "SELECT * FROM pricedb WHERE productname LIKE '$search_price'";
  $search_result = mysqli_query($db, $search_query);
  if(mysqli_num_rows($search_result)==0){
    array_push($errors, "No result found");
  }
  else{
    echo "<p align='left'><strong>Search Result: </strong></p>";
    echo "<marquee behavior ='scroll' scrollmount='2.5' direction='up'
      onmouseover='this.stop();' onmouseout='this.start();' height='150px'>";
      while($searchrow = $search_result->fetch_assoc()){
        echo "<center><p><strong>Product: </strong>";
        echo $searchrow['productname'];
        echo "<p><strong>Market average price: HKD </strong>";
        echo $searchrow['market_price'];
        echo "</p><p><strong>Depreciate per year:</strong> ";
        echo $searchrow['depreciation'];
        echo "%</p><br/>";
        echo "</center>";
      }
      echo "</marquee>";
    }
  }
