<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="w3.css"> 
</head>
<body>
	<?php 
$product=$_GET['product'];

$con = mysqli_connect('localhost','root','dineshmjs','spe');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"spe");
$sql="SELECT * FROM goods WHERE product = '".$product."'";
$result = mysqli_query($con,$sql);
//echo "".$sql;


$row = mysqli_fetch_array($result);


$hsnno="2373";
$mrp=750;
//$product=$row['product'];
$exp="03-2020";
$quantity=$_GET['quantity'];
$rate=$_GET['rate'];
$per="Nos";
$disk="-";
$tamount=$rate*$quantity;
$gst=($tamount*5)/100;
$cgst=$gst/2;
$sgst=$cgst;
$total=$tamount+$gst;

$query1="INSERT INTO `temp` (`sno`, `goods`, `hsnno`, `mrp`, `quantity`, `rate`, `tamount`, `gst`, `cgst`, `sgst`, `total`, `exp`) VALUES ('$sno', '$product', '$hsnno', '$mrp', '$quantity', '$rate', '$tamount', '$gst', '$cgst', '$sgst', '$total', '$exp');";



$run1=mysqli_query($con,$query1);
if(mysqli_error($con)){
	echo "Error : ".mysqli_error($con);
}
else{
	//header("location:index.php");
}

/*
    echo "<tr>";
    echo "
         <td>1.</td>
         <td >" . $product. "</td>
         <td>" . $hsnno. "</td>
         <td>" . $mrp. "</td>
         <td>" . $exp. "</td>
         <td>" . $quantity. "</td>
         <td>" . $rate. "</td>
         <td>" . $per. "</td>
         <td>" . $disk. "</td>
         <td>" . $tamount. "</td>
         <td>" . $gst. "</td>
         <td>" . $cgst. "</td>
         <td>" . $sgst. "</td>
         <td>" . $total. "</td>  
         <td><button class='w3-button w3-green' onclick='additem()''>AddItem</button></td>       
         ";   
    

mysqli_close($con);
*/
?>
</body>

</html>