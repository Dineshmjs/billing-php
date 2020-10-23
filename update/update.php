<?php include 'db.php'; ?>
<?php 

//MODIFY ADDRESS DETAILS
 if($_POST['aname']){
 	$name=$_POST['aname'];
 	$address=$_POST['aaddress'];
 	$gst=$_POST['agst'];
 	$dlno=$_POST['adlno'];
 	$id=$_POST['aid']; 	

  $query="UPDATE `billing` SET `name`='$name',`address`='$address',`gstin`='$gst',`dlno`='$dlno' WHERE `id`='$id'"; 
  $run=mysqli_query($con,$query);
  if($run){
  	echo "Update Success";
  }
 }

 //UPDATE Bill
if($_POST['cid']){
	$id=$_POST['cid'];
	$bname=$_POST['bname'];
	$binvoice=$_POST['binvoice'];
	$err=0;

	$query="SELECT `invoicenumber`,`name` FROM `buydetail` WHERE `id`='$id'";
	$run=mysqli_query($con,$query);
	$row=mysqli_fetch_assoc($run);
	$invoicenumber=$row['invoicenumber'];
	$name=$row['name'];

	//buyDetails 
	$query1="UPDATE `buydetail` SET `name`='$bname', `invoicenumber`='$binvoice' WHERE `invoicenumber`='$invoicenumber'";
	$run1=mysqli_query($con,$query1);
	if(!$run1){
		echo "Buydetails Not Change : ".mysqli_error($con);
		$err+=1;
	}
	//buy name invoice update
	else{
		$query2="UPDATE `buy` SET `name`='$bname', `invoicenumber`='$binvoice' WHERE `invoicenumber`='$invoicenumber'";
		$run2=mysqli_query($con,$query2);
		if(!$run2){
			echo "Buy deatils Update Error:".mysqli_error($con);
			$err+=1;
		}

		$query3="UPDATE `buyname` SET `name`='$bname' WHERE `name`='$name'";
		$run3=mysqli_query($con,$query3);
		if(!$run3){
			echo "Buyname Update Error :".mysqli_error($con);
			$err+=1;
		}

	}

	if($err==0){
		echo "Change Success";
	}
	else{
		echo "Change Unsuccess";
	}	

}

//UPDATE ITEM
if($_POST['ip']){

	$goods=$_POST['ip'];
	$invoice=$_POST['iiv'];
	$product=$_POST['ig'];
/*
	$query="SELECT `product` FROM `buy` WHERE `product`='$product' and `invoicenumber`='$invoice'";
	$run=mysqli_query($con,$query);
	$row=mysqli_fetch_assoc($run);

	$goods=$row['product'];
*/
	$query1="UPDATE `buy` SET `product`='$product' WHERE `product`='$goods' AND `invoicenumber`='$invoice'";
	$run1=mysqli_query($con,$query1);

	if(!$run1){
		echo "Error update Name :".mysqli_error($con);
	}
	else{
		$query2="UPDATE `goods` SET `product`='$product' WHERE `product`='$goods'";
		$run2=mysqli_query($con,$query2);
		if(!$run2){
			echo "Goods Update Error :".mysqli_error($con);
		}
		else{
			echo "SuccessFully updated";
		}

	}

	echo "product : $product \n goods : $goods";
}

//UPDATE GOODS
if($_POST['gid']){
	$id=$_POST['gid'];
	$hsn=$_POST['ghsn'];
	$gst=$_POST['ggst'];
	$mrp=$_POST['gmrp'];

	$query="UPDATE `goods` SET `hsnno`='$hsn', `mrp`='$mrp', `gst`='$gst' WHERE `id`='$id'";
	$run=mysqli_query($con,$query);
	if(!$run){
		echo "Error Update Goods :".mysqli_error($con);
	}
	else{
		echo "SuccessFully Updated";
	}
}
 
 ?>