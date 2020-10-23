<?php

include 'db.php';
if($_POST['query']){
      $output = '';  
      $name=$_POST["query"];
      //echo "Input".$name;
      $query = "SELECT * FROM buyname WHERE name LIKE '%".$name."%'";  
      $result = mysqli_query($con, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output.= '<li id="auto">'.$row["name"].'</li>';  
           }  
      }  
      else  
      {  
           $output= '<li>Country Not Found</li>';  
      }  
      $output .= '<ul class="list-unstyled">';
      echo $output; 
  }
  
 if($_POST['query2']){
 	  //$output = '';  
      $name=$_POST["query2"];
      //echo "Input".$name;
      $query = "SELECT * FROM `goods` WHERE `product` LIKE '%".$name."%'";  
      $result = mysqli_query($con, $query);  
      $output = '<ul  class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output.= '<li id="auto2">'.$row["product"].'</li>';  
           }  
      }  
      else  
      {  
           //$output= '<li>Country Not Found</li>';  
      }  
      $output .= '<ul class="list-unstyled">';
      echo $output; 
 }     


 // This is For Show.php
 //codind for Search


 //database search

 if($_POST['db']!=""){
  $db=$_POST['db'];
  $query="SELECT * FROM $db";
  //echo "Query".$query;
  $run=mysqli_query($con,$query);
  if($db=="goods"){
    echo "
       <tr class='w3-green'>
       <th>Product</th>
       <th>HSNO</th>
       <th>MRP</th>
       <th>Available</th>
     </tr>
    ";
    while($row=mysqli_fetch_assoc($run)){
      
    echo "
     
     <tr>
       <td>".$row['product']."</td>
       <td>".$row['hsnno']."</td>
       <td>".$row['mrp']."</td>
       <td>".$row['available']."</td>
     </tr>

    ";
    
   }
  }
  
  if($db=='billing'){
    echo "
     <tr class='w3-green'>
       <th>Name</th>
       <th>Address</th>
       <th>GSTIN</th>
       <th>DLNO</th>
     </tr>
    ";
    while($row=mysqli_fetch_assoc($run)){
    echo "
     <tr>
       <td>".$row['name']."</td>
       <td>".$row['address']."</td>
       <td>".$row['gstin']."</td>
       <td>".$row['dlno']."</td>
     </tr>
     
    ";

   }  
  }

}

//Sales  Search 


if($_POST['address']!=""){
  $address=$_POST['address'];
 if($_POST['date']!=""){
  $date1=$_POST['date'];
  $date2=date_create($date1);
  $date=date_format($date2,"d-m-Y");  
  //echo "Date".$date;
  $query="SELECT * FROM `purches` WHERE `bill`='$address' AND invoicedate='$date'" ;
  //echo $query;
  $run=mysqli_query($con,$query);
  echo "<tr class='w3-green'>          
          <th>Goods</th>
          <th>Hsn No</th>
          <th>Quantity</th>          
          <th>Rate</th>
          <th>Taxable Amount</th>
          <th>GST</th>       
          <th>Total Amount</th>   
          <th>Billing Address</th>
          <th>Shipping Address</th>
          <th>Invoice No</th>
          <th>Invoice Date</th>   
          <th>Payment</th>
          <th>Status</th>
        </tr>";
      while($row=mysqli_fetch_assoc($run)){
        $amount=$row['total']-$row['gst'];
        echo "
            <tr>
             <td>".$row['goods']."</td>
             <td>".$row['hsnno']."</td>
             <td>".$row['quantity']."</td>
              <td>".$row['rate']."</td>
             <td>".$amount."</td>             
             <td>".$row['gst']."</td>
             <td>".$row['tota']."</td>
             <td>".$row['bill']."</td>
             <td>".$row['ship']."</td>
             <td>".$row['invoiceno']."</td>
             <td>".$row['invoicedate']."</td>
             <td>".$row['payment']."</td>
             <td>".$row['status']."</td>  
            </tr>
        ";
      }

 }

 if($_POST['gst']!=''){  
 $month=$_POST['gst'];
 $query="SELECT * FROM `purchestotal` WHERE `bill`='$address' AND invoicedate LIKE '%$month%'";
 $run=mysqli_query($con,$query);
 echo "
  <tr class='w3-green'>
   <th>Name</th>
   <th>InvoiceNumber</th>
   <th>Date</th>   
   <th>Number of Product</th>  
   <th>Total Amount</th>
   <th>Status</th>
  </tr>
  ";
 while($row=mysqli_fetch_assoc($run)){  
  $total+=$row['total'];
  $query2="SELECT * FROM `purches` WHERE `invoiceno`='".$row['invoicenumber']."'";
  $run2=mysqli_query($con,$query2);
  $row2=mysqli_fetch_assoc($run2);
   echo "
      <tr>
       <td>".$row2['bill']."</td>
       <td>".$row['invoicenumber']."</td>
       <td>".$row['invoicedate']."</td>      
       <td>".$row['numofproduct']."</td>         
       <td>".$row['total']."</td>
       <td>".$row['status']."</td>         
      </tr>
    ";
 } 
 echo "
      <tr>
       <td></td>
       <td></td>
       <td></td>      
       <td class=' w3-green'>Total</td>
        
       <td class=' w3-green'>".$total."</td>       
      </tr>
    ";

}

}
                // Product 
else if($_POST['goods']!=""){
  $product=$_POST['goods'];
 if($_POST['date']!=""){ 
  $date1=$_POST['date'];
  $date2=date_create($date1);
  $date=date_format($date2,"d-m-Y");
  
  $query="SELECT * FROM `purches` WHERE goods='$product' AND `invoicedate`='$date'";
  $run=mysqli_query($con,$query);
  echo "<tr class='w3-green'>          
          <th>Goods</th>
          <th>Hsn No</th>
          <th>Quantity</th>          
          <th>Rate</th>
          <th>Taxable Amount</th>
          <th>GST</th>     
          <th>Total Amount</th>     
          <th>Billing Address</th>
          <th>Shipping Address</th>
          <th>Invoice No</th>
          <th>Invoice Date</th>   
          <th>Payment</th>
          <th>Status</th>
         </tr>";
      while($row=mysqli_fetch_assoc($run)){
        $amount=$row['total']-$row['gst'];
        echo "
            <tr>
             <td>".$row['goods']."</td>
             <td>".$row['hsnno']."</td>
             <td>".$row['quantity']."</td>
             <td>".$row['rate']."</td>
             <td>".$amount."</td>             
             <td>".$row['gst']."</td>
             <td>".$row['total']."</td>
             <td>".$row['bill']."</td>
             <td>".$row['ship']."</td>
             <td>".$row['invoiceno']."</td>
             <td>".$row['invoicedate']."</td>
             <td>".$row['payment']."</td>
             <td>".$row['status']."</td>
            </tr>
        ";
      }
    }  
    if($_POST['gst']!=''){
      $month=$_POST['month'];
  $query="SELECT * FROM `purches` WHERE goods='$product' AND `invoicedate` LIKE '%$month%'";
  $run=mysqli_query($con,$query);
  echo "<tr class='w3-green'>
          
          <th>Goods</th>
          <th>Hsn No</th>
          <th>Quantity</th>          
          <th>Rate</th>
          <th>Taxable Amount</th>
          <th>GST</th>     
          <th>Total Amount</th>     
          <th>Billing Address</th>
          <th>Shipping Address</th>
          <th>Invoice No</th>
          <th>Invoice Date</th>   
          <th>Payment</th>
          <th>Status</th>
         </tr>";
      while($row=mysqli_fetch_assoc($run)){
        $amount=$row['total']-$row['gst'];
        echo "
            <tr>
             <td>".$row['goods']."</td>
             <td>".$row['hsnno']."</td>
             <td>".$row['quantity']."</td>
             <td>".$row['rate']."</td>
             <td>".$amount."</td>             
             <td>".$row['gst']."</td>
             <td>".$row['total']."</td>
             <td>".$row['bill']."</td>
             <td>".$row['ship']."</td>
             <td>".$row['invoiceno']."</td>
             <td>".$row['invoicedate']."</td>
             <td>".$row['payment']."</td>
             <td>".$row['status']."</td>
            </tr>
        ";
      }
    }
 } 

else{
  if($_POST['gst']!=''){

  echo "
  <tr class='w3-green'>
   <th>Name</th>
   <th>InvoiceNumber</th>
   <th>Date</th>   
   <th>Number of Product</th>
   <th>GST</th>
   <th>Total Amount</th>
   <th>Status</th>
  </tr>
  ";
  $month=$_POST['gst'];
 $query="SELECT * FROM `purchestotal` WHERE `invoicedate` LIKE '%$month%'";
 $run=mysqli_query($con,$query);
 while($row=mysqli_fetch_assoc($run)){
  $gst+=$row['gst'];
  $total+=$row['total'];
  $query2="SELECT * FROM `purches` WHERE `invoiceno`='".$row['invoicenumber']."'";
  $run2=mysqli_query($con,$query2);
  $row2=mysqli_fetch_assoc($run2);
  echo "
      <tr>
       <td>".$row2['bill']."</td>
       <td>".$row['invoicenumber']."</td>
       <td>".$row['invoicedate']."</td>      
       <td>".$row['numofproduct']."</td>
       <td>".$row['gst']."</td>     
       <td>".$row['total']."</td>
       <td>".$row['status']."</td>        
      </tr>
    ";
 }
 echo "
      <tr>
       <td></td>
       <td></td>
       <td></td>      
       <td class=' w3-green'>Total</td>
       <td class=' w3-green'>".$gst."</td>     
       <td class=' w3-green'>".$total."</td>       
      </tr>
    ";

 }
}



//  purches Search

if($_POST['pname']!=""){
  $name=$_POST['pname'];
  
 if($_POST['pmonth']!=""){
  echo "
  <tr class='w3-green'>
   <th>Name</th>
   <th>InvoiceNumber</th>
   <th>Date</th>   
   <th>Number of Product</th>
   <th>Total Amount</th>
  </tr>
  ";


   $month=$_POST['pmonth'];
   $query="SELECT * FROM `buydetail` WHERE `name`='$name' AND `invoicedate` LIKE '%$month%'";
   $run=mysqli_query($con,$query);
    

   while($row=mysqli_fetch_assoc($run)){
    $iv=$row['invoicenumber'];
     $sql="SELECT `tamount` FROM `buy` WHERE `invoicenumber`='$iv'";
     $run2=mysqli_query($con,$sql);
     $tamount=0;
     while($row2=mysqli_fetch_assoc($run2)){
      $tamount+=$row2['tamount'];
     }
      echo "
      <tr>
       <td>".$row['name']."</td>
       <td>".$row['invoicenumber']."</td>
       <td>".$row['invoicedate']."</td>      
       <td>".$row['numofproduct']."</td>
       <td>".$tamount."</td>       
      </tr>
    ";
    $ttamount+=$tamount;


   }
   echo "
      <tr>
       <td></td>
       <td></td>
       <td></td>      
       <td class=' w3-green' >Grand Total</td>
       <td class='w3-green '>".$ttamount."</td>       
      </tr>
    ";
   
  
   
 } 

 else if($_POST['pdate']!=""){
  $date1=$_POST['pdate'];
  echo "";
  $date2=date_create($date1);
  $date=date_format($date2,"d-m-Y");
 
  $query="SELECT * FROM `buy` WHERE `name`='$name' AND `date`='$date'";
   $run=mysqli_query($con,$query);
   echo "
   <tr class='w3-green'>
   <th>Name</th>
   <th>InvoiceNumber</th>
   <th>Date</th>
   <th>Product</th>
   <th>GST</th>
   <th>Quantity</th>
   <th>MRP</th>   
   <th>Rate</th>
   <th>TaxableAmount</th>
   <th>Total Amount</th>
 </tr>
  ";
  while($row=mysqli_fetch_assoc($run)){
    echo "
      <tr>
       <td>".$row['name']."</td>
       <td>".$row['invoicenumber']."</td>
       <td>".$row['date']."</td>
       <td>".$row['product']."</td>
       <td>".$row['gst']."</td>
       <td>".$row['quantity']."</td>
       <td>".$row['mrp']."</td>
       <td>".$row['rate']."</td>
       <td>".$row['amount']."</td>
       <td>".$row['tamount']."</td>

      </tr>
    ";
 }
 }
 else{
  echo "
      <tr>
      
       <td>Please Choose Month or Date</td>

      </tr>
    "; 
 }

}

else if($_POST['pproduct']!=""){
  $name=$_POST['pproduct'];
  
 if($_POST['pmonth']!=""){
   $month=$_POST['pmonth'];
   $query="SELECT * FROM `buy` WHERE `product`='$name' AND `date` LIKE '%$month%'";
   $run=mysqli_query($con,$query);
   echo "
   <tr class='w3-green'>
   <th>Name</th>
   <th>InvoiceNumber</th>
   <th>Date</th>
   <th>Product</th>
   <th>GST</th>
   <th>Quantity</th>
   <th>MRP</th>   
   <th>Rate</th>
   <th>TaxableAmount</th>
   <th>Total Amount</th>
 </tr>
  ";
  while($row=mysqli_fetch_assoc($run)){
    echo "
      <tr>
       <td>".$row['name']."</td>
       <td>".$row['invoicenumber']."</td>
       <td>".$row['date']."</td>
       <td>".$row['product']."</td>
       <td>".$row['gst']."</td>
       <td>".$row['quantity']."</td>
       <td>".$row['mrp']."</td>
       <td>".$row['rate']."</td>
       <td>".$row['amount']."</td>
       <td>".$row['tamount']."</td>

      </tr>
    ";
 }
}
 else if($_POST['pdate']!=""){
  $date1=$_POST['pdate'];
  echo "";
  $date2=date_create($date1);
  $date=date_format($date2,"d-m-Y");
 
  $query="SELECT * FROM `buy` WHERE `product`='$name' AND `date`='$date'";
   $run=mysqli_query($con,$query);
   echo "
   <tr class='w3-green'>
   <th>Name</th>
   <th>InvoiceNumber</th>
   <th>Date</th>
   <th>Product</th>
   <th>GST</th>
   <th>Quantity</th>
   <th>MRP</th>   
   <th>Rate</th>
   <th>TaxableAmount</th>
   <th>Total Amount</th>
 </tr>
  ";
  while($row=mysqli_fetch_assoc($run)){
    echo "
      <tr>
       <td>".$row['name']."</td>
       <td>".$row['invoicenumber']."</td>
       <td>".$row['date']."</td>
       <td>".$row['product']."</td>
       <td>".$row['gst']."</td>
       <td>".$row['quantity']."</td>
       <td>".$row['mrp']."</td>
       <td>".$row['rate']."</td>
       <td>".$row['amount']."</td>
       <td>".$row['tamount']."</td>

      </tr>
    ";
 }
 }
 else{
  echo "
      <tr>
      
       <td>Please Choose Any One</td>

      </tr>
    "; 
 }

}
else{
  if($_POST['pmonth']!=''){
    $month=$_POST['pmonth'];
   $query="SELECT * FROM `buydetail` WHERE `invoicedate` LIKE '%$month%'";
   $run=mysqli_query($con,$query);
   echo "
  <tr class='w3-green'>
   <th>Name</th>
   <th>InvoiceNumber</th>
   <th>Date</th>   
   <th>Number of Product</th>
   <th>Total Amount</th>
  </tr>
  ";
  while($row=mysqli_fetch_assoc($run)){
    $iv=$row['invoicenumber'];
    $query1="SELECT tamount FROM `buy` WHERE `invoicenumber`='$iv'";
    $run1=mysqli_query($con,$query1);
    $tamount=0;
     while($row1=mysqli_fetch_assoc($run1)){      
       $tamount+=$row1['tamount'];
     }
    echo "
      <tr>
       <td>".$row['name']."</td>
       <td>".$row['invoicenumber']."</td>
       <td>".$row['invoicedate']."</td>      
       <td>".$row['numofproduct']."</td>
       <td>".$tamount."</td>       
      </tr>
    ";
    $ttamount+=$tamount;
  }
  echo "
      <tr>
       <td></td>
       <td></td>
       <td></td>      
       <td class=' w3-green'>Grant Total</td>
       <td class=' w3-green'>".$ttamount."</td>       
      </tr>
    ";
 }
 
}



/*

if($_POST['pname']!=""){
  $pname=$_POST['pname'];
  $query="SELECT * FROM `buy` WHERE `name`='".$pname."'";
  $run=mysqli_query($con,$query);
  echo "
   <tr class='w3-green'>
   <th>Name</th>
   <th>InvoiceNumber</th>
   <th>Date</th>
   <th>Product</th>
   <th>GST</th>
   <th>Quantity</th>
   <th>MRP</th>   
   <th>Rate</th>
   <th>TaxableAmount</th>
   <th>Total Amount</th>
 </tr>
  ";
  while($row=mysqli_fetch_assoc($run)){
    echo "
      <tr>
       <td>".$row['name']."</td>
       <td>".$row['invoicenumber']."</td>
       <td>".$row['date']."</td>
       <td>".$row['product']."</td>
       <td>".$row['gst']."</td>
       <td>".$row['quantity']."</td>
       <td>".$row['mrp']."</td>
       <td>".$row['rate']."</td>
       <td>".$row['amount']."</td>
       <td>".$row['tamount']."</td>

      </tr>
    ";
  }
}
if($_POST['pdate']!=""){
  $date1=$_POST['pdate'];
  $date2=date_create($date1);
  $date=date_format($date2,"d-m-Y");

  $pdate=$date;
  $query="SELECT * FROM `buy` WHERE `date`='".$pdate."'";
  $run=mysqli_query($con,$query);
  echo "
   <tr class='w3-green'>
   <th>Name</th>
   <th>InvoiceNumber</th>
   <th>Date</th>
   <th>Product</th>
   <th>GST</th>
   <th>Quantity</th>
   <th>MRP</th>   
   <th>Rate</th>
   <th>TaxableAmount</th>
   <th>Total Amount</th>
 </tr>
  ";
  while($row=mysqli_fetch_assoc($run)){
    echo "
      <tr>
       <td>".$row['name']."</td>
       <td>".$row['invoicenumber']."</td>
       <td>".$row['date']."</td>
       <td>".$row['product']."</td>
       <td>".$row['gst']."</td>
       <td>".$row['quantity']."</td>
       <td>".$row['mrp']."</td>
       <td>".$row['rate']."</td>
       <td>".$row['amount']."</td>
       <td>".$row['tamount']."</td>
      </tr>
    ";
  }
}

if($_POST['month']!=""){
  $month=$_POST['month'];
  $query="SELECT * FROM `buy` WHERE `date` LIKE '%$month%'";
  $run=mysqli_query($con,$query);
  echo "Query";
  echo "
   <tr class='w3-green'>
   <th>Name</th>
   <th>InvoiceNumber</th>
   <th>Date</th>
   <th>Product</th>
   <th>GST</th>
   <th>Quantity</th>
   <th>MRP</th>   
   <th>Rate</th>
   <th>TaxableAmount</th>
   <th>Total Amount</th>
  
 </tr>
  ";
  while($row=mysqli_fetch_assoc($run)){
    $total+=$row['tamount'];
    echo "
      <tr>
       <td>".$row['name']."</td>
       <td>".$row['invoicenumber']."</td>
       <td>".$row['date']."</td>
       <td>".$row['product']."</td>
       <td>".$row['gst']."</td>
       <td>".$row['quantity']."</td>
       <td>".$row['mrp']."</td>
       <td>".$row['rate']."</td>
       <td>".$row['amount']."</td>
       <td>".$row['tamount']."</td>
      </tr>
    ";
  }
   echo "
      <tr>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td>Total</td>
       <td>$total</td>
      </tr>
    ";
}

if($_POST['month']!="" && $_POST['pname']!=""){
  $month=$_POST['month'];
  $product=$_POST['pname'];
  $query="SELECT * FROM `buy` WHERE `date` LIKE '%$month%' AND `name`='$product'";
  $run=mysqli_query($con,$query);
  echo "Query";
  echo "
   <tr class='w3-green'>
   <th>Name</th>
   <th>InvoiceNumber</th>
   <th>Date</th>
   <th>Product</th>
   <th>GST</th>
   <th>Quantity</th>
   <th>MRP</th>   
   <th>Rate</th>
   <th>TaxableAmount</th>
   <th>Total Amount</th>
  
 </tr>
  ";
  while($row=mysqli_fetch_assoc($run)){
    $total+=$row['tamount'];
    echo "
      <tr>
       <td>".$row['name']."</td>
       <td>".$row['invoicenumber']."</td>
       <td>".$row['date']."</td>
       <td>".$row['product']."</td>
       <td>".$row['gst']."</td>
       <td>".$row['quantity']."</td>
       <td>".$row['mrp']."</td>
       <td>".$row['rate']."</td>
       <td>".$row['amount']."</td>
       <td>".$row['tamount']."</td>
      </tr>
    ";
  }
   echo "
      <tr>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td>Total</td>
       <td>$total</td>
      </tr>
    ";
}
*/

?>
	
