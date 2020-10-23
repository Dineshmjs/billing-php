<?php include 'db.php'; ?>
<?php 
  if($_POST['ival']){
  	$val=$_POST['ival'];
  	$query="SELECT * FROM `buyname` WHERE `name` LIKE '%".$val."%'";
  	$run=mysqli_query($con,$query);	
  	

	while ($row=mysqli_fetch_assoc($run)) {
  		echo "<li class='clickCompany'>".$row['name']."</li>";
  	}
    
  }

  if($_POST['ival1']){
  	$val=$_POST['ival1'];
  	$query="SELECT * FROM `goods` WHERE `product` LIKE '%".$val."%'";
  	$run=mysqli_query($con,$query);
  	
  	while ($row=mysqli_fetch_assoc($run)) {
  		echo "<li class='clickProduct'>".$row['product']."</li>";
  	}
    
  	
  }
 ?>
