<?php 
include "db.php";
 $quer2="SELECT * FROM temp";
  $run2=mysqli_query($con,$quer2);
   $run=mysqli_query($con,$quer2);
  
  echo "<tr class='w3-green'>
 	<th>S.No</th>
 	<th>Goods</th>
 	<th>Hsn No</th>
 	<th>Expiry</th>
 	<th>Mrp</th>
 	<th>Quantity</th>
 	<th>Rate</th>
 	<th>Taxable Amount</th>
 	<th>GST</th>
 	<th>CGST</th>
 	<th>SGST</th>
 	<th>Total</th>
  <th>Disc</th> 
  <th>TotalWithDiscount</th>  
  <th></th>

 </tr>";

   $amount=0;
   $cgst=0;
   $discamount=0;
   $i=0;
   $count=mysqli_num_rows($quer2);
   
   

  while($row2=mysqli_fetch_assoc($run2)){ 
    $i=$i+1;  
    $amount=$amount + $row2['total'];
    $cgst=$cgst+$row2['cgst'];
    $discamount=$discamount+$row2['discamount'];

  	echo"<tr> <td >".$i. "</td>
         <td >" . $row2['goods']. "</td>
         <td >" . $row2['hsnno']. "</td>
         <td >" . $row2['exp']. "</td>
         <td >" . $row2['mrp']. "</td>
         <td >" . $row2['quantity']. "</td>
         <td >" . $row2['rate']. "</td>
         <td >" . $row2['tamount']. "</td>
         <td >" . $row2['gst']. "</td>
         <td >" . $row2['cgst']. "</td>
         <td >" . $row2['sgst']. "</td>
         <td >" . $row2['total']. "</td>
         <td >" . $row2['disc']. "</td>
         <td >" . $row2['discamount']. "</td>        

         <td ><button class='w3-button w3-green' id='removeItem' rid='".$row2['id']."'> Remove Item </td>
         </tr>";     
  } 	

  echo "
   <tr><td>.</td></tr>
   <tr><td>.</td></tr>
  <tr>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td>Total Amount</td>
 <td></td>
 <td>".$cgst."</td>
 <td>".$cgst."</td>
 <td>".$amount."</td>
 <td></td>
 <td>".$discamount."</td>
 <td></td>
 </tr>";

  mysqli_close($con);
 ?>
 
 