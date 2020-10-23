<?php 
include 'db.php';

//INSERT BILLER NAME
if($_POST['name1']!=""){
  $name=$_POST['name1'];
  $address=$_POST['address1'];
  $gstin=$_POST['gstin1'];
  $dlno=$_POST['dlno1'];

  $query="INSERT INTO `billing` (`name`, `address`, `gstin`, `dlno`) VALUES ('".$name."', '".$address."', '".$gstin."', '".$dlno."');";
  $run=mysqli_query($con,$query);
  if($run){
   echo "Insert Successfully";
  }
  else{
    echo "Error".mysqli_error($con);
  }
 
}




//INSERT BUY DETAILS
if($_POST['itotal']){  
  $iname=$_POST['iname'];
  $ino=$_POST['ino'];
  $itotal=$_POST['itotal'];
  $date1=$_POST['idate'];

  //date conversion
  
  $date2=date_create($date1);
  $date=date_format($date2,"d-m-Y");    

  $itotal1=$itotal+1;
  $err=0;

  // insert buy 

  $q1="INSERT INTO `buydetail` (`name`, `invoicenumber`, `invoicedate`, `numofproduct`) VALUES ('".$iname."', '".$ino."', '".$date."', '".$itotal."')";
  $r=mysqli_query($con,$q1);
  if(!$r){ 
    echo "Error :".mysqli_error($con);
    $err+=1;
  }
  else{    
  //INSERT PRODUCTS LIST 
    $q2="SELECT * FROM `buyname` WHERE `name`='$iname'";
    $r2=mysqli_query($con,$q2);
    $rr=mysqli_num_rows($r2);
    if($rr==0){
      $q3="INSERT INTO `buyname` (`name`) VALUES ('".$iname."');";
      $r3=mysqli_query($con,$q3);
      if(!$r3){echo "Error Buyer Name".mysqli_error($con); $err+=1;}
    }

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
      $date1=date_create($date);
      $sdate=date_format($date1,"d-m-Y");

      //INSERT PRODUCTS
      $query="INSERT INTO `buy` (`name`, `invoicenumber`, `date`, `product`,`hsnno`, `gst`, `quantity`, `mrp`, `rate`, `amount`,`tamount`) VALUES ('".$iname."', '".$ino."', '".$date."', '".$product."','".$hsnno."', '".$gst."', '".$quantity."', '".$mrp."', '".$rate."', '".$amount."','".$tamount."')";
      $run=mysqli_query($con,$query);

      if($run){   
        $query1="SELECT * FROM `goods` WHERE `product`='".$product."'";
        $run1=mysqli_query($con,$query1);
        if($run1){
            //INSERT GOODS 
          $count=mysqli_num_rows($run1);
          if($count==0){    
            $query2="INSERT INTO `goods` (`product`, `hsnno`, `mrp`, `available`, `gst`) VALUES ('".$product."', '".$hsnno."', '".$mrp."', '".$quantity."', '".$gst."')";
            $run3=mysqli_query($con,$query2);
            if(!$run3){ echo "Error Insert Goods :".mysqli_error($con); $err+=1; }        
          }
           //UPDATE GOODS AVAILABLE
          else{
            $row=mysqli_fetch_assoc($run1);
            $qt=$quantity+$row['available'];
            $query3="UPDATE `goods` SET `available`='$qt' WHERE product='$product'";
            $run2=mysqli_query($con,$query3);
            if(!$run2){   echo "Error Update Goods :".mysqli_error($con); $err+=1;  }
          }
        } 
      }
 
    }   //forloop end

 }//else end(insert product list) 

 if($err==0){
   echo "Purches Entery Success ";
 }

} //ifend


?>

