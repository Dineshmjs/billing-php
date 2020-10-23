<?php 
include 'db.php';
 
/*
 $q2="SELECT `goods` FROM `purches`";
 $r2=mysqli_query($con,$q2);
 while($row=mysqli_fetch_assoc($r2)){
 	$product=$row['goods'];

 	$q3="SELECT `mrp` FROM `goods` WHERE `product`='$product'";
 	$r3=mysqli_query($con,$q3);
 	$row1=mysqli_fetch_assoc($r3);
 	$mrp=$row1['mrp'];

 	$q1="UPDATE `purches` SET `mrp`='$mrp' WHERE `goods`='$product'";
    $r1=mysqli_query($con,$q1);
 }
*/
 
 $q2="SELECT `goods` FROM `purches`";
 $r2=mysqli_query($con,$q2);
 while($row=mysqli_fetch_assoc($r2)){
 	$product=$row['goods'];

 	$q3="SELECT `gst` FROM `goods` WHERE `product`='$product'";
 	$r3=mysqli_query($con,$q3);
 	$row1=mysqli_fetch_assoc($r3);
 	$gst=$row1['gst'];

 	$q1="UPDATE `purches` SET `gst`='$gst' WHERE `goods`='$product'";
    $r1=mysqli_query($con,$q1);
 }
 
 

 $q2="SELECT `invoicenumber` FROM `purchestotal`";
 $r2=mysqli_query($con,$q2);
 while($row2=mysqli_fetch_assoc($r2)){
 	 $iv=$row2['invoicenumber'];
 	 $q1="SELECT `discamount` FROM `purches` WHERE `invoiceno`='$iv'";
	 $r1=mysqli_query($con,$q1);
	 while($row=mysqli_fetch_assoc($r1)){
	 	 $discamount+=$row['discamount'];
	 }	

 	$q3="UPDATE `purchestotal` SET `total`='$discamount' WHERE `invoicenumber`='$iv'";
 	$r3=$r1=mysqli_query($con,$q3);

 	$discamount=0;
 }

 ?>