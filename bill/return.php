<?php  
include 'db.php';
$bill=$_POST['bill'];
$query="SELECT * FROM `purchestotal` WHERE `invoicenumber`=$bill";
$run=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($run);

echo "

 <table class='w3-table-all'>
    <tr>
		<td class='w3-green'>Billing Details</td>
		
	</tr>
	<tr>
		<td>Billing</td>
		<td>".$row['bill']."</td>
	</tr>
	<tr>
		<td>Shipping</td>
		<td>".$row['ship']."</td>
	</tr>
	<tr>
		<td>InvoiceNumber</td>
		<td>".$row['invoicenumber']."</td>
	</tr>
	<tr>
		<td>Invoice Date</td>
		<td>".$row['invoicedate']."</td>
	</tr>
	<tr>
		<td>Number of Products</td>
		<td>".$row['numofproduct']."</td>
	</tr>
		<tr>
		<td>Status</td>
		<td>".$row['status']."</td>
	</tr>
</table><br>
";


$query2="SELECT * FROM `purches` WHERE `invoiceno`=$bill";
$run2=mysqli_query($con,$query2);

echo "
  <table class='w3-table-all'>
    <tr class='w3-green'>
 	<th>S.No</th>
 	<th>Goods</th>
 	<th>Hsn No</th>
 	<th>Expiry</th>
 	<th>Mrp</th>
 	<th>Quantity</th>
 	<th>Rate</th>
 	
 	<th>GST</th>
 	
 	<th>Total</th>
    <th>Disc</th> 
    <th>TotalWithDiscount</th>      
  </tr>
 
 ";

while($row2=mysqli_fetch_assoc($run2)){
	$sno+=1;
     echo"<tr> <td >".$sno. "</td>
         <td >" . $row2['goods']. "</td>
         <td >" . $row2['hsnno']. "</td>
         <td >" . $row2['exp']. "</td>
         <td >" . $row2['mrp']. "</td>
         <td >" . $row2['quantity']. "</td>
         <td >" . $row2['rate']. "</td>         
         <td >" . $row2['gst']. "%</td>        
         <td >" . $row2['total']. "</td>
         <td >" . $row2['disc']. "</td>
         <td >" . $row2['discamount']. "</td> 

        ";
        /* 
         <td ><button class='w3-button w3-green' id='itemRemove' goods='".$row2['goods']."' iv='".$bill."' av='".$row2['quantity']."'> Remove </td>
        </tr>
        */      
        
}
echo "</table><br>";

echo "
  
";

?>



	
	
	
