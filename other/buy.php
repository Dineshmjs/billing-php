<?php 
  include 'db.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Purches Details</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="w3.css"> 
    <script type="text/javascript" src="min.js"></script>
    <style type="text/css">
    	a{
    		text-decoration: none;
    	}
    	.w3-input{
        width:60%;
      }
      #sno,#sdate,#sname{
        width: 200px;
      }

    </style>
    <script type="text/javascript">
    	$(document).ready(function(){    
      /*   
          $("#click").click(function(){
            $.post("insert.php",{            
            count:$("#count").val()
          },
          function(data){
            //alert(data);
            $("#detailsview").html(data);
          });
         });
         */
 /*
          $("#verify1").click(function(){
           $.ajax({
               url:"insert.php",
               type:"post",
               data:$("#form").serialize(),
               success:function(d){                 
                 alert(d);
               }
           }); 
         });

         */
       $("#sub").click(function(){
          $.post("insert.php",{    
            sname:$("#sname").val(),
            sno:$("#sno").val(),
            sdate:$("#sdate").val(),
            product:$("#product").val(),
            gst:$("#gst").val(),
            qt:$("#quantity").val(),
            mrp:$("#mrp").val(),
            rate:$("#rate").val(),
            amount:$("#amount").val()
          },
          function(data){
            alert(data);
            //$("#detailsview").html(data);
          });
       });

    	});
    </script>

</head>
<body>
  <div class="w3-container w3-blue">
  	<a href="index.php"><h2 class="w3-center">Sri Padmavathi Enterprises </h2></a>
  </div><br>

  <h4 class="w3-center">Product Details</h4>
      <div class="w3-card">         
          <table class="w3-table-all">
           
            <tr id="tdw">
            <td>Name</td>
             <td>
              <select class="w3-select" id="sname">               
                <?php 
                   $query="SELECT * FROM `buyname`";
                   $run=mysqli_query($con,$query);
                   while($row=mysqli_fetch_assoc($run)){
                      echo "<option value='".$row['name']."'>".$row['name']."</option>";
                   }
                 ?>
              </select>
             </td>
            
            <td>InvoiceNumber</td>
             <td>
              <select class="w3-select" id="sno">               
                <?php 
                   $query1="SELECT * FROM `buydetail`";
                   $run1=mysqli_query($con,$query1);
                   while($row1=mysqli_fetch_assoc($run1)){
                      echo "<option value='".$row1['invoicenumber']."'>".$row1['invoicenumber']."</option>";
                   }
                 ?>
              </select>
             </td>
            
              <td>Date</td>
              <td><input type="date" id="sdate"></td>   
              <!--         
              <td>Number of Products</td>
              <td><input type="text" id="count"></td>
              <td><input class="w3-button w3-green" type="submit" value="Click" id="click"></td>
              -->
            </tr> 
          </table>

          <form id="form">
           <table class="w3-table-all" id="detailsview">            
             <tr>
               <td>Product</td>
               <td><input type="text" id="product"></td>
             </tr> 
             <tr>
               <td>GST</td>
               <td><input type="text" id="gst"></td>
             </tr> 
             <tr>
               <td>Quantity</td>
               <td><input type="text" id="quantity"></td>
             </tr> 
             <tr>
               <td>MRP</td>
               <td><input type="text" id="mrp"></td>
             </tr> 
             <tr>
               <td>Rate</td>
               <td><input type="text" id="rate"></td>
             </tr> 
             <tr>
               <td>Amount</td>
               <td><input type="text" id="amount"></td>
             </tr>  
             <tr>
               <td></td>
               <td><input type="submit" value="submit" id="sub"></td>
             </tr>   

           </table><br>
          </form>   
        
      </div>
    </div>
  

  

</body>
</html>