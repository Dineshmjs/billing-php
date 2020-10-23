<?php
 
 include "db.php";
 header("refresh");
 
?>	


<!DOCTYPE html>
<html>
<head>
	<title>SPE</title>
	<title>Sri Padmavathi Enterprises</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="w3.css">	
    <script type="text/javascript" src="min.js"></script>
    <style type="text/css">
      #upr{
        width: 100%;
        height: 120px;
      }
      #lwr{
        width: 100%;
        height: 120px;
      }
      #tab,#tbl,#tbl1{
        border-collapse: collapse; 
        border:solid 1px #000;
      }
      #tab tr{
        border:none;
      }
      #tab td,th{
        border-left: solid 1px #000;
        border-right:  solid 1px #000;
      }
      #th th{
        border:solid 1px #000;
      }
      #tdpad td{
        height: 100px;
        
      }
      #ti{
        font-size: 22px;
        padding:0px;
      }
      #tbl1 td{
        padding: 0px;
      }
      #spe{
        font-size: 26px;
        font-family: Albertina;
      }
      #lft1{
        height: 66px;        
      }
      #iv td{
        height: 54px;
      }
      #bold{
        font-size:18px;
        font-weight: bold;
      }
      #button td{
        padding-left: 300px;
      }
      #ipad{
        padding-bottom: 46px;
      }
      #tdborder td{
         border:solid 1px #000;
         vertical-align: bottom;
        font-size:17px;
        font-weight: bold;
      }


    </style>

    <script type="text/javascript">
    	$(document).ready(function(){ 

           $("#print").click(function(){           	
           	$("#print").hide();
            $("#cancel").hide();
             	window.print();
           		$.post("master.php",{status:"ok" },function(data){
               //alert(data);
             });             	          	           
           });

           $("#cancel").click(function(){
             $.post("master.php",{status:"no" },function(){
               
             });  
           });
    	});

    </script>
</head>
<body>      
   
       
      
  <div class="w3-container"><br>   	
  	<div class="w3-row w3-light-gray">
      <table class="w3-table" id="tbl">
        <tr>
          <td class="w3-center" id="ti">TAX INVOICE</td>
        </tr>
      </table>

      <table class="w3-table" id="tbl1">
        <tr>
          <td class="w3-center" id="spe">SRI PADMAVATHI ENTERPRICES</td>
        </tr>
        <tr>
          <td class="w3-center"> DEALERS IN QUALITY SURGICAL ITEMS </td>
        </tr>
        <tr>
          <td class="w3-center">23 A, GROUND FLOOR, BALAJI STREET </td>
        </tr>
        <tr>
          <td class="w3-center">VENKATESA PERUMAL KOIL NAGAR, VALASARAVAKKAM,CHENNAI 600087 </td>
        </tr>
        <tr>
          <td class="w3-center">TAMILNADU,CODE:33  </td>
        </tr>
        <tr>
          <td class="w3-center">Mobile No:94443 41930, 89398 99440</td>
        </tr>
        <tr>
          <td class="w3-center">Email : sripadhmavathienterprises17@gmail.com</td>
        </tr>
        <tr>
          <td class="w3-center">GSTIN/UIN : 33EJFPK2755A1ZM</td>
        </tr>
        <tr>
          <td class="w3-center">DLNO TN 05 20B 00274 & TN 05 21B 00274</td>
        </tr>
      </table>

  		<div class="w3-col m5">
  			<table class="w3-table" id="tbl">  	
  				<tr><td></td><td><h5 >Billing Address</h5></td></tr>	
  				<?php 
  				  $bill="SELECT * FROM `bill`";
                  $run=mysqli_query($con,$bill);
                  $row10=mysqli_fetch_assoc($run);
                 // header("refresh:10");
                   echo "
                      <tr>
  				       <td>Name</td>
  				       <td>".$row10['name']."</td>
  			          </tr>
  			          <tr>
  				       <td>Address</td>
  				       <td>".$row10['address']."</td>
  			          </tr>
  			          <tr>
  				       <td>GSTIN</td>
  				       <td>".$row10['gstin']."</td>
  			          </tr>
  			          <tr>
  				       <td>DLNO</td>
  				       <td>".$row10['dlno']."</td>
  			          </tr>
                  ";
                  
                   ?>
  			</table>

  		</div>      
  		<div class="w3-col m4">  			
  			<table class="w3-table" id="tbl">
          <tr><td></td><td><h5 >Shipping Address</h5></td></tr>
  			<?php
  			
  			      $ship="SELECT * FROM `ship`";
                  $run2=mysqli_query($con,$ship);
                  $row2=mysqli_fetch_assoc($run2);
                   echo "
                      <tr>
  				       <td>Name</td>
  				       <td>".$row2['name']."</td>
  			          </tr>
  			          <tr>
  				       <td>Address</td>
  				       <td>".$row2['address']."</td>
  			          </tr>
  			          <tr>
  				       <td>GSTIN</td>
  				       <td>".$row2['gstin']."</td>
  			          </tr>
  			          <tr>
  				       <td>DLNO</td>
  				       <td>".$row2['dlno']."</td>
  			          </tr>
                  ";
                 
                   ?>

            </table>
  		</div>
  		<div class="w3-col m3">
  			<table class="w3-table" id="tbl">
          <tr><td></td><td><h5>InvoiceDetails</h5></td></tr>
  				<?php 
                   $query="SELECT * FROM `invoice`";
                   $exe=mysqli_query($con,$query);
                   $row=mysqli_fetch_assoc($exe);
                   if(!$exe){
                   	echo "Error".mysqli_error($con);
                   }
                   $ino1=$row['number'];

                   if($ino1<10){
                    $ino="SPE/2020-2021/000".$ino1;
                   }
                   else if(9<$ino1 && $ino1<100){
                    $ino="SPE/2020-2021/00".$ino1;
                   }
                   else if(99<$ino1 && $ino1<1000){
                    $ino="SPE/2020-2021/0".$ino1;
                   }
                   else{
                    $ino="SPE/2020-2021/".$ino1;
                   }               
                  
                   echo "
                        <tr>
  				    	   <td>InvoiceNo </td><td>$ino</td>
		  				</tr>
		  				
		  				<tr>
		  					<td>Date</td><td>".$row['date']."</td>
		  				</tr>
		  				<tr id='iv'>
		  					<td id='ipad'>Payment</td><td>".$row['payment']."</td>
		  				</tr>
              
              
                   ";

  				 ?>
  				
  			</table>
  		</div>
  	</div>	

   <div class="w3-row w3-light-gray">
  	<div class="w3-col m12" >
      
  		<table class="w3-table" id="tab">
  			<?php 
				include "db.php";
				 $query2="SELECT * FROM temp";
				  $run3=mysqli_query($con,$query2);
				   
				  
				  echo "<tr id='th'>
				 	<th>S.No</th>
				 	<th>Goods</th>
				 	<th>Hsn No</th>
				 	<th>Expiry</th>
				 	<th>Mrp</th>
				 	<th>Quantity</th>
				 	<th>Rate</th>
				 	<th>Taxable Amount</th>
				 	<th>GST</th>
				 	<th>CGST</th>
				 	<th>SGST</th>
				 	<th>Total</th>
			    <th>Disc</th>
			    <th>Total Amount</th>    
				 </tr>";

				   $amount=0;
				   $cgst=0;
				   $i=0;
           $discamount=0;
				   $count=mysqli_num_rows($query2);
				  while($row3=mysqli_fetch_assoc($run3)){ 
				    $i=$i+1;  
				    $amount=$amount + $row3['total'];
				    $cgst=$cgst+$row3['cgst'];  
            $discamount=$discamount+$row3['discamount']; 
				  	echo"<tr> <td >".$i. "</td>
				         <td >" . $row3['goods']. "</td>
				         <td >" . $row3['hsnno']. "</td>
				         <td >" . $row3['exp']. "</td>
				         <td >" . $row3['mrp']. "</td>
				         <td >" . $row3['quantity']. "</td>
				         <td >" . $row3['rate']. "</td>
				         <td >" . $row3['tamount']. "</td>
				         <td >" . $row3['gst']."%</td>
				         <td >" . $row3['cgst']. "</td>
				         <td >" . $row3['sgst']."</td>
				         <td >" . $row3['total']. "</td> 
                 <td >" . $row3['disc']. "</td>
                 <td >" . $row3['discamount']. "</td>            
				         </tr>";     
				  } 	

				  echo "
          <tr id='tdpad'>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>  
           </tr>
           

					 <tr id='tdborder'>
					 <td></td>
					 <td></td>
					 <td></td>
					 <td></td>
					 <td></td>
					 <td></td>
					 <td></td>
					 <td></td>
					 <td></td>
					 <td>".$cgst."</td>
					 <td>".$cgst."</td>
					 <td>".$amount."</td>
			         <td></td>
			         <td>".$discamount."</td>	 
					 </tr>";

				  //mysqli_close($con);
				 ?>
        
  		  </table>        
  		
      
        <table class="w3-table" id="tbl">
          <tr>
            <td>Amount Chargeable (in word)</td>
          </tr>
        
        <tr>
          <td>
           <?php 
           echo"".convertNumberToWord($discamount)
           ?>
          </td>
        </tr>
        </table>
      </div>
      <div class="w3-col m8">
        <table class="w3-table" id="tbl1">
          <tr>
            <td>Company's VAT TIN : 33396464236</td>
          </tr> 
          <tr>
            <td>Company's CST No : 33EJFPK2755AIZM</td>
          </tr> 
          <tr>
            <td>Company's PAN : EJFPK2755A</td>
          </tr> 
          <tr>
            <td>Declaration</td>
          </tr> 
          <tr>
            <td>We Declared that this invoice Shows the actual price of the</td>
          </tr> 
          <tr>
            <td>goods described and that all particulars are true and correct</td>
          </tr>   
        </table>
      </div>
      <div class="w3-col m4">
        <table class="w3-table" id="tbl1">
          <tr>
            <td id="lft1" class="w3-center">For SRI PADHMAVATHI ENTERPRISES</td>
          </tr>
          <tr>
            <td id="lft1" class="w3-center">Authorised Signature</td>
          </tr>
        </table>
      </div>
      
      
  	  </div>
     


  </div><br>
  <div class="w3-container w3-center">
    <table class="w3-table" id="button">
      <tr>
        <td id="bpad">
          <a href="bill.php"><button class="w3-button w3-green" id="print">Print Bill</button></a>
        </td>
        <td>
          <a href="bill.php"><button class="w3-button w3-green" id="cancel">Cancel Bill</button></a>
        </td>
      </tr>
    </table>
  	
  </div>


</body>
</html>

<?php
error_reporting(0);
function convertNumberToWord($num = false)
{
   
   $number = $num;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  echo $result . "Rupees  " . $points . " Paise Only";
}
?>

