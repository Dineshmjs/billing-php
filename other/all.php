<?php 
 include "db.php";
//add.php

 
 if($_POST['product']!=""){ 	
 $product=$_POST['product'];
 $disc=$_POST['disc'];
 $query2="SELECT * FROM `goods` WHERE product='$product'";
 $run2=mysqli_query($con,$query2);
 $row2=mysqli_fetch_assoc($run2);
 $mrp=$_POST['mrp'];
 $qt=$_POST['qt']; 
 $tamount=$qt*$mrp;

 $gst=($tamount*$row2['gst'])/100;
 $gst1=$row2['gst']; 
 
 $cgst1=$gst/2;
 $cgst=round($cgst1,2); 

 $total=$tamount+$gst;
 $disc1=($total*$disc)/100;
 $discamount=$total-$disc1;
 $sno=0; 
 $check="SELECT * FROM `temp`";
 $check1=mysqli_query($con,$check);
 if($check1){
 	while($row=mysqli_fetch_assoc($check1)){
 		$sno=$row['id'];
 		echo "Sno".$sno."\n";
 	}
 	$sno=$sno+1;
 }

 $query="INSERT INTO `temp` (`id`, `goods`, `hsnno`, `mrp`, `quantity`, `rate`, `tamount`, `gst`, `cgst`, `sgst`, `total`, `exp`, `disc`, `discamount`) VALUES ('".$sno."','".$product."', '".$row2['hsnno']."', '".$row2['mrp']."', '".$qt."', '".$mrp."', '".round($tamount,2)."', '".$gst1."', '".$cgst."', '".$cgst."', '".round($total,2)."', '-','".$disc."%','".round($discamount,2)."')";
 //echo "".$query;
 $run=mysqli_query($con,$query);
 if($run){
 // echo "Add Item"; 	
 }
 else{
 	echo "".mysqli_error($con);
 	 }
 	 

}

//addressview.php
if($_POST['data']!=""){
	
$post=$_POST['data'];
 echo "Name".$post;
 $query1="SELECT * FROM billing WHERE name ='$post'";
 
 $run1=mysqli_query($con,$query1);
 $row=mysqli_fetch_assoc($run1);


 echo "    
 	  <tr>
 	<td>Name</td><td>".$row['name']."</td>
 </tr>
 <tr>
 	<td>Address</td><td>".$row['address']."</td>
 </tr>
 <tr>
 	<td>Gstin</td><td>".$row['gstin']."</td>
 </tr>
 <tr>
 	<td>dlno</td><td>".$row['dlno']."</td>
 </tr>
 ";
}

//addressinsert1.php
if($_POST['bill']!=""){
	
 $add1=$_POST['bill']; 
  $get1="SELECT * FROM `billing` WHERE name='$add1'";
  
  $run1=mysqli_query($con,$get1);
  
  $row1=mysqli_fetch_assoc($run1);
 
  $insert1="INSERT INTO `bill` (`name`, `address`, `gstin`, `dlno`) VALUES ('".$row1['name']."', '".$row1['address']."', '".$row1['gstin']."', '".$row1['dlno']."')";
  
  $run3=mysqli_query($con,$insert1);  
}


//addressinsert2.php
if($_POST['ship']!=""){	
	$add2=$_POST['ship'];
  $get2="SELECT * FROM `billing` WHERE name='$add2'";
  $run2=mysqli_query($con,$get2);
   $row2=mysqli_fetch_assoc($run2);

   $insert2="INSERT INTO `ship` (`name`, `address`, `gstin`, `dlno`) VALUES ('".$row2['name']."', '".$row2['address']."', '".$row2['gstin']."', '".$row2['dlno']."')";   

   $run4=mysqli_query($con,$insert2);
   
}

//remove.php
if($_POST['sno']!=""){
	
	$sno=$_POST['sno'];
$query="DELETE FROM `temp` WHERE id='".$sno."';";
$run=mysqli_query($con,$query);
if($run){	
	
}
else{
	echo "error".mysqli_error($con);
 }
}

// invoice details
if($_POST['invoice']!=""){
	
	$invoice=$_POST['invoice'];    
    $sql="SELECT * FROM `purchestotal`";
    $exe=mysqli_query($con,$sql);
    //$row=mysqli_fetch_assoc($exe);
    $count=mysqli_num_rows($exe);
    

	$number=$count+1;

	
	$date1=$_POST['date'];
    $date2=date_create($date1);
    $date=date_format($date2,"d-m-Y");
	
	
	$payment=$_POST['pay'];

	echo $invoice."\n".$number."\n".$date."\n".$payment;
	
	$query="INSERT INTO `invoice` (`number`, `date`, `address`, `payment`) VALUES ('".$number."', '".$date."', '".$invoice."', '".$payment."')";	

	$run=mysqli_query($con,$query);
	
	if($run){
		echo "Success";
	}
	
}

if($_POST['goods']!=""){
	$goods=$_POST['goods'];
	$query="SELECT * FROM `goods` WHERE product='".$goods."'";
	//echo "Query".$query;
	$run=mysqli_query($con,$query);
	$row=mysqli_fetch_assoc($run);
	if(!$run){
		echo "Error".mysqli_error($con);
	}
	else{
	echo "<input type='text' id='ip1' value='".$row['mrp']."'>
          <input type='text' id='ip2' qt='".$row['available']."'> ";
          }
}
if($_POST['goods1']!=""){
	$goods=$_POST['goods1'];
	//echo "Goods".$goods;
	$query="SELECT * FROM `temp` WHERE goods='".$goods."'";
	$run=mysqli_query($con,$query);
	$row=mysqli_num_rows($run);
	if(!$run){
		echo "Error".mysqli_error($con);
	}
	else{
		echo $row;
	}
	
}
if($_POST['pr']!=""){
	$pr=$_POST['pr'];
	$iv=$_POST['iv'];
	$av=$_POST['av'];
	$query="INSERT INTO `temp1` (`goods`, `invoice`,`av`) VALUES ('$pr', '$iv','$av')";
	$run=mysqli_query($con,$query);
}
if($_POST['rm']!=""){
	$iv=$_POST['rm'];
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

		$query2="UPDATE `purches` SET `status`='return' WHERE `goods`='".$row['goods']."' AND `invoiceno`='".$row['invoice']."'";
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
	$query6="DELETE FROM `temp1`";
	$run7=mysqli_query($con,$query6);
 
}
if($_POST['rmgoods']!=""){
	$iv=$_POST['rmgoods'];
 
    $query="SELECT `goods`,`quantity` FROM `purches` WHERE `invoiceno`='$iv'";
    $run=mysqli_query($con,$query);
    while($row=mysqli_fetch_assoc($run)){
    	$check="SELECT `available` FROM `goods` WHERE `product`='".$row['goods']."'";
    	$run4=mysqli_query($con,$check);
    	$row4=mysqli_fetch_assoc($run4);
    	$available=0;
        $available=$row4['available']+$row['quantity']; 
    	$update="UPDATE `goods` SET `available`='$available' WHERE `product`='".$row['goods']."' ";
    	$run5=mysqli_query($con,$update);
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

 
mysqli_close($con);


 ?>
