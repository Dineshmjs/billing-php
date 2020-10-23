<?php include 'db.php'; ?>
<?php 

//VIEW BILLING ADDRESS
if($_POST['baddress']){	
 $post=$_POST['baddress'];
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

//AUTOFILL PRODUCT ADD
if($_POST['goods']){
	$goods=$_POST['goods'];
	$query="SELECT * FROM `goods` WHERE product='".$goods."'";
	//echo "Query".$query;
	$run=mysqli_query($con,$query);
	$row=mysqli_fetch_assoc($run);
	if(!$run){
		echo "Error".mysqli_error($con);
	}
	else{
		$obj->mrp=$row['mrp'];
		$obj->qt=$row['available'];
		echo json_encode($obj);
	/*	
	echo "<input type='text' id='mrp' mrp='".$row['mrp']."'>
          <input type='text' id='qt' qt='".$row['available']."'> ";
    */  
    }
}

//CHECK PRODUCT EXITS
if($_POST['cgoods']!=""){
	$goods=$_POST['cgoods'];	
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

 ?>