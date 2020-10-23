

<?php 
 include 'db.php';

// CONFIRMATION FOR PURCHES ENTRY
 if($_POST['itotal']){  
  $iname=$_POST['iname'];
  $ino=$_POST['ino'];
  $itotal=$_POST['itotal'];
  $date1=$_POST['idate'];  
  
  $date2=date_create($date1);
  $date=date_format($date2,"d-m-Y");    

  $itotal1=$itotal+1;
  $err=0;

  echo "<div class='w3-container'><h6 class='w3-center w3-text-pink'>Bill Details</h6>";  
  echo "
  	<table class='w3-table-all'>
		<tr>
			<th>Name</th>
			<th>InvoiceNo</th>
			<th>Date</th>
			<th>Number of Product </th>
		</tr>
		<tr>
			<td>".$iname."</td>
			<td>".$ino."</td>
			<td>".$date."</td>
			<td>".$itotal."</td>
		</tr>
	</table>	
  "	;  

   echo "<h6 class='w3-center w3-text-pink'>Item Details</h6>"; 
  echo "
  	<table class='w3-table-all'>
		<tr>		
			<th>No</th>
			<th>Product</th>
			<th>HsnNo</th>
			<th>GST</th>
			<th>Quantity</th>
			<th>MRP</th>
			<th>Rate</th>
			<th>TaxableAmount</th>
			<th>TotalAmount</th>
		</tr>			
  ";
  
  //loop for Insert Multiple Products
    for ($i=1; $i < $itotal1; $i++) {     
    
      $product=$_POST['product'.$i];
      $hsnno=$_POST['hsn'.$i];
      $gst=$_POST['gst'.$i];
      $mrp=$_POST['mrp'.$i];
      $quantity=$_POST['qt'.$i];
      $rate=$_POST['rate'.$i];
      $amount=$quantity*$rate;
      $tamount=$amount+($amount*$gst)/100;       

      echo "
      	<tr>	
      		<td>$i</td>	
			<td>".$product."</td>
			<td>".$hsnno."</td>
			<td>".$gst."</td>
			<td>".$quantity."</td>
			<td>".$mrp."</td>
			<td>".$rate."</td>
			<td>".$amount."</td>
			<td>".$tamount."</td>
		</tr>";
		$ttotal+=$tamount;
	}
	echo "
      	<tr>	
      		<td></td>	
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>TotalAmount</td>
			<td>".$ttotal."</td>
		</tr>";

	echo "</table></div>";  
	//echo "<span>".$ttotal."</span></div>";

}



// VIEW PURCHES BILL
if($_POST['iv']){
 $iv=$_POST['iv'];
 $query1="SELECT * FROM `buydetail` WHERE `invoicenumber`='$iv'";
 $query2="SELECT * FROM `buy` WHERE `invoicenumber`='$iv'";

 $run1=mysqli_query($con,$query1); 
 $run2=mysqli_query($con,$query2);

 $row1=mysqli_fetch_assoc($run1);
 echo "<h6 class='w3-center w3-text-pink'>Bill Details</h6>";
 echo "
	<table class='w3-table-all'>
	        <tr>
			 	<th>Name</th>
			 	<th>Invoice</th>
			 	<th>Date</th>
			 	<th>Numberofproduct</th>
			 	<th>Action</th>	
			 	<th>Action</th>			 	
			 </tr>
		<tr>
			<td><input type='text' id='bname' value='".$row1['name']."' class='w3-input w3-border'></td>
			<td><input type='text' id='binvoice' value='".$row1['invoicenumber']."' class='w3-input w3-border'></td>
			<td>".$row1['invoicedate']."</td>
			<td>".$row1['numofproduct']."</td>
			<td><button class='w3-button w3-blue' id='changeBill' bid='".$row1['id']."'>Change</button></td>
			<td><button class='w3-button w3-red' id='deleteBill' bid='".$row1['id']."'>Delete</button></td>
		</tr>
 	</table><br>
 ";
echo "<h6 class='w3-center w3-text-pink'>Item Details</h6>"; 
echo "<table class='w3-table-all'>
             <tr>
			 	<th>Product</th>
			 	<th>HSNNO</th>
			 	<th>GST</th>			 	
			 	<th>MRP</th>
			 	<th>QUANTITY</th>
			 	<th>RATE</th>
			 	<th>Action</th>			 	
			 </tr>
";
 while ($row2=mysqli_fetch_assoc($run2)) {
 	echo "
		 	 
	    
		 	<tr>
			    <td><input type='text' value='".$row2['product']."' class='w3-input w3-border ig'/></td>
				<td>".$row2['hsnno']."</td>
				<td>".$row2['gst']."</td>				
				<td>".$row2['mrp']."</td>
				<td>".$row2['quantity']."</td>
				<td>".$row2['rate']."</td>
				<td><button class='w3-button w3-red' id='itemChange' iiv=".$row2['invoicenumber']." ip='".$row2['product']."' id='updateAddress'>Change</button></td>
			</tr>
		
 	";

 }
 echo "</table>";
 
}

if($_POST['add']){
	$add=$_POST['add'];
	$query1="SELECT * FROM `billing` WHERE `id`='$add'";
	$run1=mysqli_query($con,$query1);

    echo "<h6 class='w3-center w3-text-pink'>Address Details</h6>";
	echo "<table class='w3-table-all'>
			<tr>
			 	<th>Name</th>
			 	<th>Address</th>
			 	<th>GSTIN</th>
			 	<th>DLNO</th>
			 	<th>Action</th>			 	
			 </tr>
	";
	$row1=mysqli_fetch_assoc($run1);
		echo "
			<tr>
				<td><input type='text' value='".$row1['name']."' class='w3-input w3-border' id='aname'></td>
				<td><input type='text' value='".$row1['address']."' class='w3-input w3-border' id='aaddress'></td>
				<td><input type='text' value='".$row1['gstin']."' class='w3-input w3-border' id='agst'></td>
				<td><input type='text' value='".$row1['dlno']."' class='w3-input w3-border' id='adlno'></td>
				<td><button class='w3-button w3-teal' id='addressClick' aid='".$row1['id']."' id='updateAddress'>Change</button></td>

			</tr>
		";	
} 

if($_POST['goods']){
	$id=$_POST['goods'];
	$query="SELECT * FROM `goods` WHERE `id`='$id'";
	$run=mysqli_query($con,$query);
	$row=mysqli_fetch_assoc($run);
	echo "<table class='w3-table-all'>
			<tr>
			 	<th>Product</th>
			 	<th>Hsnno</th>
			 	<th>GST</th>
			 	<th>MRP</th>
			 	<th>Available</th>	
			 	<th>Actions</th>			 	
			 </tr>
	";
	echo "
        <tr>
		 	<td>".$row['product']."</td>
		 	<td><input type='text' value='".$row['hsnno']."' class='w3-input w3-border' id='ghsn'></td>
		 	<td><input type='text' value='".$row['gst']."' class='w3-input w3-border' id='ggst'></td>
		 	<td><input type='text' value='".$row['mrp']."' class='w3-input w3-border' id='gmrp'></td>
		 	<td>".$row['available']."</td>
		 	<td><button class='w3-button w3-teal' id='updateGoods' gid='".$row['id']."'>Change</button></td>
		</tr>
	";
	echo "</table>";
}



if($_POST['items']){
	$items=$_POST['items'];
	$len=strlen($items);
	$query="SELECT * FROM `goods` WHERE `product`='".$items."'";
	$run=mysqli_query($con,$query);
	$row=mysqli_fetch_assoc($run);

	$item->hsn=$row['hsnno'];
	$item->mrp=$row['mrp'];
	$item->gst=$row['gst'];
	$item->product=$row['product'];
	
	echo json_encode($item);
	
}

 ?>




