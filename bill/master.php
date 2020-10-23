
<?php 
include 'db.php';

if($_POST['status']=="ok"){  

    $query1="SELECT * FROM `temp`";
    $run1=mysqli_query($con,$query1);    

    $query2="SELECT * FROM `bill`";
    $run2=mysqli_query($con,$query2);
    $row2=mysqli_fetch_assoc($run2);

    $query3="SELECT * FROM `ship`";
    $run3=mysqli_query($con,$query3);
    $row3=mysqli_fetch_assoc($run3);

    $query4="SELECT * FROM `invoice`";
    $run4=mysqli_query($con,$query4);
    $row4=mysqli_fetch_assoc($run4);   
    $total=0;
    $gst=0;
    $count=mysqli_num_rows($run1);
    $err=0;

    while($row1=mysqli_fetch_assoc($run1)){

    	$insert1="INSERT INTO `purches` (`goods`, `hsnno`, `mrp`, `quantity`, `rate`, `gst`, `total`,`disc`,`discamount`, `bill`, `ship`, `invoiceno`, `invoicedate`, `payment`,`status`) VALUES ('".$row1['goods']."', '".$row1['hsnno']."', '".$row1['mrp']."', '".$row1['quantity']."', '".$row1['rate']."', '".$row1['gst']."', '".$row1['total']."','".$row1['disc']."','".$row1['discamount']."', '".$row2['name']."', '".$row3['name']."', '".$row4['number']."', '".$row4['date']."', '".$row4['payment']."','Success')";

      $run5=mysqli_query($con,$insert1);
       if(!$run5){
        echo "Error Insert Purches :".mysqli_error($con);

       }
       else{
        $product=$row1['goods'];
        $query="SELECT * FROM `goods` WHERE product='".$product."'";
        $run=mysqli_query($con,$query);
        $row=mysqli_fetch_assoc($run);

        $qt=$row['available']-$row1['quantity'];

        $update="UPDATE `goods` SET `available` = '".$qt."' WHERE `product` ='".$product."'";
        echo "Query :".$update."\n";
        $run10=mysqli_query($con,$update);
        if(!$run10){
          echo "Error".mysqli_error($con);
        }     
       }


      $total=$total+$row1['discamount'];
      $gst1=$row1['total']-($row1['quantity']*$row1['rate']);
      $gst+=$gst1;    	
    	 
    	 
   }  

  
  $query11="INSERT INTO `purchestotal` (`bill`, `ship`, `total`, `gst`, `invoicenumber`, `invoicedate`, `payment`, `numofproduct`,`status`) VALUES ('".$row2['name']."', '".$row3['name']."', '".$total."', '".$gst."', '".$row4['number']."', '".$row4['date']."', '".$row4['payment']."', '".$count."','Success')";
   $run11=mysqli_query($con,$query11);

   if($run11){
      $query5="DELETE FROM `bill`";
      $query6="DELETE FROM `ship`";
      $query7="DELETE FROM `temp`";
      $query8="DELETE FROM `invoice`";
      $run6=mysqli_query($con,$query5);
      $run7=mysqli_query($con,$query6);
      $run8=mysqli_query($con,$query7);
      $run9=mysqli_query($con,$query8);  
   }
   else{
    echo "Error Insert purchestotal :".mysqli_error($con);
   }                        
              

}

if($_POST['status']=="no"){
              $query5="DELETE FROM `bill`";
              $query6="DELETE FROM `ship`";
              $query7="DELETE FROM `temp`";
              $query8="DELETE FROM `invoice`";
              $run6=mysqli_query($con,$query5);
              $run7=mysqli_query($con,$query6);
              $run8=mysqli_query($con,$query7);
              $run9=mysqli_query($con,$query8); 
}  
              
mysqli_close($con);
?>