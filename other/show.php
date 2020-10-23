<?php 
  include 'db.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>View Details</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="w3.css">	
    <script type="text/javascript" src="min.js"></script>
    <style type="text/css">
    	#sub3,#sub1,#sub2{
    		margin-left: 40%;
    	}
    	a{
    		text-decoration: none;
    	}
    	#date{
    		width: 100%;
    		height: 40px;
    	}
    	#purchesdate{
    		width: 90%;
    		height: 40px;
    	}
     
    </style>
    <script type="text/javascript">
    	$(document).ready(function(){
          $("#sub3").click(function(){

            $.post("search.php",{
              db:$("#db").val()
            },
            function(data){
            	//alert(data);
            	 $("#view").html(data);
            });
          }); 

          $("#sub1").click(function(){
            //alert($("#selectproduct").val()); 
            $.post("search.php",{
              address:$("#selectaddress").val(),
              date:$("#date").val(),
              goods:$("#selectproduct").val(),
              gst:$("#gst").val()
            },
            function(data){
            	//alert(data);
            	 $("#view").html(data);
            });
          }); 
          $("#sub2").click(function(){
            //alert($("#selectproduct").val()); 
            $.post("search.php",{
              pname:$("#purchesname").val(),
              pdate:$("#purchesdate1").val(),
              pproduct:$("#purchesproduct").val(),
              pmonth:$("#month").val()
              //invoice:$("#invoice").val()
            },
            function(data){
              //alert(data);
               $("#view").html(data);
            });
          }); 

          $("#reset").click(function(){
              location.reload();
          });
          $("#reset1").click(function(){
              location.reload();
          });


    	});
    </script>
</head>
<body>
   <div class="w3-container w3-pink">
   	<a href="index.php"><h1 class="w3-center">Sri Padhmavathi Enterprises</h1></a>
   </div>

   <div class="w3-container">
   	<div class="w3-row-padding">
   		
   		<div class="w3-third">
   			<h5 class="w3-center">Sales Details</h5>
   		<div class="w3-card">
	   	 <table class="w3-table" >
	   	 	<tr>
	   	 		<td>
	   	 			<select class="w3-select" id="selectaddress">
	   	 				<option value="">Address</option>
	   	 				<?php 
                          $query1="SELECT * FROM `billing`";
                          $run1=mysqli_query($con,$query1);
                          while($row1=mysqli_fetch_assoc($run1)){
                          	echo "<option value='".$row1['name']."'>".$row1['name']."</option>";
                          }

	   	 				 ?>	   	 				
	   	 			</select>
	   	 		</td>
          
          <td>
            <select class="w3-select" id="selectproduct">
              <option value="">Product</option>
              <?php 
                          $query2="SELECT * FROM `goods`";
                          $run2=mysqli_query($con,$query2);
                          while($row2=mysqli_fetch_assoc($run2)){
                            echo "<option value='".$row2['product']."'>".$row2['product']."</option>";
                          }

               ?> 
            </select>
          </td>

	   	 	</tr>
	   	 	<tr>
	   	 		
          <td>
            <select class="w3-select" id="gst">
              <option value="">Select Month</option>
              <option value="01-2020">Jan</option>
              <option value="02-2020">Feb</option>
              <option value="03-2020">Mar</option>
              <option value="04-2020">Apr</option>
              <option value="05-2020">May</option>
              <option value="06-2020">Jun</option>
              <option value="07-2020">July</option>
              <option value="08-2020">Agu</option>
              <option value="09-2020">Sep</option>
              <option value="10-2020">Oct</option>
              <option value="11-2020">Nov</option>
              <option value="12-2020">Dec</option>
            </select>
          </td> 

          <td>
            <input type="date" id="date" >
          </td> 
	   	 	</tr>
	   	 	<tr>
         <td><button class="w3-button w3-green" id="sub1">Search</button></td>  
         <td><button class="w3-button w3-green" id="reset">Reset</button></td> 
        </tr>
	   	 </table>
	   	 
    	</div>
    	</div>

    	<div class="w3-third">
    		<h5 class="w3-center">Purches Details</h5>
   		<div class="w3-card">
	   	 <table class="w3-table" >
	   	 	<tr>
	   	 		<td>
	   	 			<select class="w3-select" id="purchesname">
	   	 				<option value="">Select Name</option>
              <?php 
                 $query3="SELECT * FROM `buyname`";
                 $run3=mysqli_query($con,$query3);
                 while($row3=mysqli_fetch_assoc($run3)){
                  echo "
                   <option value='".$row3['name']."'>".$row3['name']."</option>
                  ";
                 }
               ?>
	   	 			</select>
	   	 		</td>
          <td>
            <select class="w3-select" id="purchesproduct">
              <option value="">Product</option>
              <?php 
                          $query4="SELECT * FROM `goods`";
                          $run4=mysqli_query($con,$query4);
                          while($row4=mysqli_fetch_assoc($run4)){
                            echo "<option value='".$row4['product']."'>".$row4['product']."</option>";
                          }

               ?>      

            </select>   
          </td>
	   	 	</tr>
	   	 	<tr>	   	 	    
            <td>
            <select class="w3-select" id="month">
              <option value="">Select Month</option>
              <option value="01-2020">Jan</option>
              <option value="02-2020">Feb</option>
              <option value="03-2020">Mar</option>
              <option value="04-2020">Apr</option>
              <option value="05-2020">May</option>
              <option value="06-2020">Jun</option>
              <option value="07-2020">July</option>
              <option value="08-2020">Agu</option>
              <option value="09-2020">Sep</option>
              <option value="10-2020">Oct</option>
              <option value="11-2020">Nov</option>
              <option value="12-2020">Dec</option>
            </select>
          </td>	   
          <td><input class="w3-input w3-border" type="date" id="purchesdate1" ></td>
	   	 	</tr>
        <tr>
          <td><button class="w3-button w3-green" id="sub2">Search</button></td>
          <td><button class="w3-button w3-green" id="reset1">Reset</button></td>
        </tr>
       </table>

       
    	</div>
    	</div>

    	<div class="w3-third">
    		<h5 class="w3-center">Available Details</h5>
   		<div class="w3-card">
	   	 <table class="w3-table">
	   	 	<tr>
	   	 		<td>
	   	 			<select class="w3-select" id="db">
	   	 				<option >Select Fields</option>
	   	 				<option value="goods"> Product Informations</option>
	   	 				<option value="billing">Address Informations</option>        
	   	 			</select>
	   	 		</td>
	   	 	</tr> 	  
	   	 </table>	
	   	 	<button class="w3-button w3-green" id="sub3">Search</button>
    	</div>
    	</div>
   	</div>   	
   </div>

   <br>
   <div class="w3-container" id="show">
   	<table class="w3-table-all" id="view">   		
   	</table>
   </div>
</body>
</html>