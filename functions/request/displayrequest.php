<!DOCTYPE html>
<html>
  <header><title>Requests</title></header>
  <body>
    <h1>My Request</h1><br>
    <table>
      <tr>
        <th>Product ID
        <th>Seller ID
      </tr>  
    <php?
          require_once "request_config.php";
          
          $sql = "SELECT * FROM request WHERE buyer_id = $_SESSION[username]";
          $result = $conn -> query($sql);
          if(result->row_num>0){
                  while($row=$result->fetch_assoc()){
                      echo "<tr><td>", $row[product_id], "</td><td>", $row[seller_id], "</td></tr>
                  }
          }else{
          echo "No request.";
          }
          mysqli_close($link);
      ?>
      <h1>Request to me</h1><br>
      <table>
      <tr>
        <th>Product ID
        <th>Buyer ID
      </tr>
        
    <php?
          $sql = "SELECT * FROM request WHERE seller_id = $SESSION[username]";
          $result = $conn -> query($sql);
          if(result->row_num>0){
                  while($row=$result->fetch_assoc()){
                        echo "<tr><td>", $row[product_id], "</td><td>", $row[buyer_id], "</td></tr>";
                  }
          }else{
          echo "No request.";
          }
          mysqli_close($link);
      ?>
    echo "</table>";
        <a href = "shopping.php">Back</a>
        </body>
      </html>
      
                        
                 
