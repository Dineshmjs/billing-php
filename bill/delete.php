<?php include 'db.php'; ?>
<?php 

//REMOVE PRODUCT
if($_POST['rid']){	
	$id=$_POST['rid'];
	$query="DELETE FROM `temp` WHERE id='".$sno."';";
	$run=mysqli_query($con,$query);
	if(!$run){	
		echo "error".mysqli_error($con);	
	}	
}



//REMOVE GOODS FROM BILL
if($_POST['rmbill']!=""){
	$iv=$_POST['rmbill'];
 
    $query="SELECT `goods`,`quantity` FROM `purches` WHERE `invoiceno`='$iv'";
    $run=mysqli_query($con,$query);
    while($row=mysqli_fetch_assoc($run)){
    	$check="SELECT `available` FROM `goods` WHERE `product`='".$row['goods']."'";
    	$run4=mysqli_query($con,$check);
    	$row4=mysqli_fetch_assoc($run4);
    	$available=0;
        $available=$row4['available']+$row['quantity']; 
    	$update="UPDATE `goods` SET `available`=$available WHERE `product`='".$row['goods']."' ";
    	$run5=mysqli_query($con,$update);
    	if(!$run5){
    		echo "Error Update Goods Available :".mysqli_error($con);
    	}
    	else{
    		echo "$check\n$update";
    	}
    }
	$query2="UPDATE `purches` SET `status`='Return' WHERE `invoiceno`='$iv'";
	$query3="UPDATE `purchestotal` SET `status`='Return' WHERE `invoicenumber`='$iv'";
	/*
	$query2="DELETE FROM `purches` WHERE `invoiceno`='$iv'";
	$query3="DELETE FROM `purchestotal` WHERE `invoicenumber`='$iv'";	
	*/
	$run2=mysqli_query($con,$query2);
	$run3=mysqli_query($con,$query3);
	

	echo "Bill Returned Successfully ";
}

 ?>




 <?php 
 //INCASE ITS USED...............................

//return particual goods

/* 
if($_POST['rmbill']){
	$iv=$_POST['rmbill'];
	$query="SELECT * FROM `temp1`";
	$run=mysqli_query($con,$query);
	while($row=mysqli_fetch_assoc($run)){

		$query3="SELECT `available` FROM `goods` WHERE `product`='".$row['goods']."'";
		$run3=mysqli_query($con,$query3);
		$row2=mysqli_fetch_assoc($run3);
		$available=0;
		$available=$row2['available']+$row['av'];

		$update="UPDATE `goods` SET `available`='$available' WHERE `product`='".$row['goods']."'";
		$run4=mysqli_query($con,$update);

		$query2="UPDATE `purches` SET `status`='Return' WHERE `goods`='".$row['goods']."' AND `invoiceno`='".$row['invoice']."'";
		$run2=mysqli_query($con,$query2);	

	}
	/*
	$query4="SELECT `id` FROM `purches` WHERE `invoiceno`='$iv'";
	$run5=mysqli_query($con,$query4);	
	$count=mysqli_num_rows($run5);
	
	if($count==0){
		$query7="DELETE FROM `purchestotal` WHERE `invoicenumber`='$iv'";
		$run8=mysqli_query($con,$query7);
	}
	else{
      $query5="UPDATE `purchestotal` SET `numofproduct`='$count' WHERE `invoicenumber`='$iv'";
      $run6=mysqli_query($con,$query5);
	}	
	*/
	/*
	$query6="DELETE FROM `temp1`";
	$run7=mysqli_query($con,$query6);
 
}
*/

  ?>