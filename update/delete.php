<?php include 'db.php'; ?>
<?php  
//Bill Delete
 if($_POST['did']){

 	$did=$_POST['did'];
 	$err=0;
    
    //get Invoice Number 
 	$query="SELECT `invoicenumber` FROM `buydetail` WHERE `id`='$did'";
 	$run=mysqli_query($con,$query);
 	$row=mysqli_fetch_assoc($run);
 	$invoice=$row['invoicenumber'];
 	echo "did : $did \n invoice : $invoice"; 	

 	//Update Goods Available
 	$query2="SELECT `product`, `quantity` FROM `buy` WHERE `invoicenumber`='$invoice'";
 	$run2=mysqli_query($con,$query2);
 	while($row2=mysqli_fetch_assoc($run2)){ 
 		$product=$row2['product'];
 		$quantity=$row2['quantity'];

 		$query3="SELECT `available` FROM `goods` WHERE `product`='$product'";
 		$run3=mysqli_query($con,$query3);
 		$row3=mysqli_fetch_assoc($run3);

 		$available=$row3['available'];

 		if($available >= $quantity){
 			$updateAvailable=$available-$quantity;
			$query4="UPDATE `goods` SET `available`='$updateAvailable' WHERE `product`='$product'";
			$run4=mysqli_query($con,$query4);
			if(!$run4){
				echo "Error Update Goods :".mysqli_error($con);
				$err+=1;
			}
			
 		}
 		else{
 			echo "Available Less Than Deleted Quantity : $product $available $quantity";
 			$err+=1;
 		}
 		     
 	}//end while loop

 	if($err == 0){
	    //Delete buy Items		
	 	$query5="DELETE FROM `buy` WHERE `invoicenumber`='$invoice'";
		$run5=mysqli_query($con,$query5);
			if(!$run5){
				echo "Item not Delete :".mysqli_error($con);				
			}	

		//Delete Buydetails Records
	 	$query1="DELETE FROM `buydetail` WHERE `invoicenumber` = '$invoice'";
	 	$run1=mysqli_query($con,$query1);
		 	if(!$run1){
		       echo "Error Delete Buydetails :".mysqli_error($con);
		 	} 
		 echo "Deleted Success"; 	   	 	 
 	}

 	else{
 		echo "Deleted Unsuccess";
 	}    

 }

 ?>
