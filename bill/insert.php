<?php 
include 'db.php';


if($_POST['name1']!=""){
    $name=$_POST['name1'];
    $address=$_POST['address1'];
    $gstin=$_POST['gstin1'];
    $dlno=$_POST['dlno1'];
  //echo "Name".$name.$address.$gstin.$dlno;

  $query="INSERT INTO `billing` (`name`, `address`, `gstin`, `dlno`) VALUES ('".$name."', '".$address."', '".$gstin."', '".$dlno."');";
  $run=mysqli_query($con,$query);
  if($run){
     echo "Insert Successfully";
    }
    else{
      echo "Error".mysqli_error($con);
    }
 
}


//ADD PRODUCT
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

// INSERT BILLIND ADDRESS
if($_POST['bill']){  
 $add1=$_POST['bill']; 
  $get1="SELECT * FROM `billing` WHERE name='$add1'";
  
  $run1=mysqli_query($con,$get1);
  
  $row1=mysqli_fetch_assoc($run1);
 
  $insert1="INSERT INTO `bill` (`name`, `address`, `gstin`, `dlno`) VALUES ('".$row1['name']."', '".$row1['address']."', '".$row1['gstin']."', '".$row1['dlno']."')";
  
  $run3=mysqli_query($con,$insert1);  
}

//INSERT SHIPPING ADDRESS
if($_POST['ship']){ 
  $add2=$_POST['ship'];
  $get2="SELECT * FROM `billing` WHERE name='$add2'";
  $run2=mysqli_query($con,$get2);
   $row2=mysqli_fetch_assoc($run2);

   $insert2="INSERT INTO `ship` (`name`, `address`, `gstin`, `dlno`) VALUES ('".$row2['name']."', '".$row2['address']."', '".$row2['gstin']."', '".$row2['dlno']."')";   

   $run4=mysqli_query($con,$insert2);
   
}

//INSERT INVOICE DETAILS
if($_POST['invoice']){
  
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

//INSERT REMOVE ITEMS INTO TEMP1
if($_POST['pr']!=""){
  $pr=$_POST['pr'];
  $iv=$_POST['iv'];
  $av=$_POST['av'];
  $query="INSERT INTO `temp1` (`goods`, `invoice`,`av`) VALUES ('$pr', '$iv','$av')";
  $run=mysqli_query($con,$query);
}


 
?>
