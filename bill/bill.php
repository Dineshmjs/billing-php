
<?php  
 include 'db.php';
 header("refresh");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sri Padmavathi Enterprises</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="w3.css"> 
    <script type="text/javascript" src="min.js"></script>
    <style type="text/css">
      #hdr{
        padding-top: 10px;
      }
      #selectProduct{
        width: 200px;
        height: 30px;
      }
      #mrp,#qts,#disc{
        width: 200px;
        height: 30px;
      }
      #tbl{
      	width: 30%;
      }
      a{
        text-decoration: none;
      }
      #bar button{
         margin-left: 300px;
         padding: 12px;
      }
      #return,#reprint{
      	display: none;
      }
      #newAdd{
      	display: none;

      }
      .w3-modal-content{
      	width: 50%;
      }
      #removeBill{
        margin-left:45%; 
      }
    </style>

    <script type="text/javascript">

    //Add Products	
      $(document).ready(function(){
          $("#productAdd").click(function(){                    
            $.ajax({
              url:"insert.php",
              type:"post",
              data:$("#form").serialize(),
              success:function(){                 
                // alert(d);
              }
            }); 
          });
        });

           $(document).ready(function(){
            $("#viewProduct").load("view.php");
           });

           $(document).ready(function(){            
            $("#billAddress").change(function(){
                $.post("read.php",{
                 baddress:$("#billAddress").val()
                },
                 function(data){     
                  $("#viewBillAddress").html(data);
                 });
            });

            $("#shipAddress").change(function(){
                $.post("read.php",{
                 baddress:$("#shipAddress").val()
                },
                 function(data){     
                  $("#viewShipAddress").html(data); 
                 });
            });            
        });

           $(document).ready(function(){
             $(document).on("click","#removeItem",function(){
                 var remove=$(this);
                 var id=$(this).attr("rid");
                 $.post("delete.php",{
                 rid:id
                },
                 function(data){     
                 remove.closest("tr").hide();
                 $("#viewProduct").load("view.php");
                 });
             });
           });

            $(document).ready(function(){
              $("#finish").click(function(){
                 var add1=$("#billAddress").val();
                 var add2=$("#shipAddress").val();     
                 var payment=$("#payment").val(); 
                 var date=$("#date").val();

                 $.post("insert.php",{
                  bill:add1,
                  ship:add2                 
                 },
                 function(){
                  //alert(data);                   
                 });
                 
                 $.post("insert.php",{                  
                  invoice:add1,
                  pay:payment,
                  date:date
                 },
                 function(){
                  //alert(data);                   
                 });                  
              });
            });

            $(document).ready(function(){
              //$("#hide").hide();
              $("#selectProduct").change(function(){
               var goods=$("#selectProduct").val();               
                $.post("read.php",{                  
                  goods:goods                  
                 },
                 function(data){                  
                  var obj= JSON.parse(data);                    
                  var mrp=obj.mrp;
                  var qt=obj.qt;
                  /*    
                  var mrp=$("#mrp").attr("mrp");
                  var qt=$("#qt").attr("qt");
                  */

                  $("#mrp").attr("placeholder","Actual MRP "+mrp);
                  $("#qts").attr("placeholder","Available Quantity "+qt);
                  });

                 $.post("read.php",{                  
                  cgoods:goods                  
                 },
                 function(data){                  
                  if(data==0){
                  } 
                  else{
                    alert("you already choose this product if you want to modify this product remove the already added list"+data);
                  }                               
                 });    
                         
              });

            });

            $(document).ready(function(){
              $("#returnBill").click(function(){
                $.post("return.php",{bill:$("#returnBillInvoice").val()},function(data){              
                $("#viewReturnBill").html(data);  
              }); 
             }); 

              $(document).on("click","#itemRemove",function(){
                 var tr=$(this).closest("tr");

                 var pr=$(this).attr("goods");
                 var iv=$(this).attr("iv"); 
                 var av=$(this).attr("av");            
         
                 $.post("insert.php",{
                 pr:pr,
                 iv:iv,
                 av:av 
                },
                 function(data){
                 tr.hide();                 
                 });
             });
              
               $("#removeBill").click(function(){                           
               $.post("delete.php",{rmbill:$("#returnBillInvoice").val()},function(data){
                 alert("rm"+data);
               });
               location.reload();
              });

               //Address Adding
              $("#newAddOpen").click(function(){
              	$("#newAdd").show();
              }); 
              $("#newAddClose").click(function(){
                $("#newAdd").hide(); 
              });

              $("#insert").click(function(){          
		          $.post("insert.php",{            
		            name1:$("#name").val(),
		            address1:$("#address").val(),
		            gstin1:$("#gstin").val(),
		            dlno1:$("#dlno").val() 
		          },
		          function(data){
		            alert(data);
		            $("#newAdd").hide();
		            location.reload();
		          });
	        });
              
             //End Address Add
                         
            });

         // Cancel Bill  
          
         

    </script>
    <script>
		function bill(id) {
		  var i;
		  var x = document.getElementsByClassName("bill");
		  for (i = 0; i < x.length; i++) {
		    x[i].style.display = "none";  
		  }
		  document.getElementById(id).style.display = "block";  
		}
    </script>


</head>
<body>
 <!--        Header  Details              --> 
   <div class="w3-container w3-purple">
     <a href="../index.php"><h2 class="w3-center">Sri Padmavathi Enterprises </h2></a>
   </div>

   <div class="w3-bar w3-teal" id="bar">
	  <button class="w3-bar-item w3-button" onclick="bill('new')">New Bill</button>
	  <button class="w3-bar-item w3-button" onclick="bill('return')">Return Bill</button>
	  <button class="w3-bar-item w3-button" onclick="bill('reprint')">Reprint Bill</button>
   </div>






<!--        New Bill           -->
<!--        Product  Details              -->
<div class="bill" id="new">
   <div class="w3-container">
    <div class="w3-card">
      <h4 class="w3-center w3-text-blue" id="hdr">Product Menu</h4>
      <div class="w3-container">
        <table class="w3-table">
          <tr>
            <td>
              <form method="post" id="form">
              <select id="selectProduct" name="product" >
                 <option value="">Select Product</option>
                <?php 
                              
                                $query="SELECT * FROM goods";
                                $run=mysqli_query($con,$query);
                                while($row=mysqli_fetch_assoc($run)){
                                  echo "<option value='".$row['product']."'>".$row['product']."</option>";
                                }
                              
                 ?>
              </select>
            </td>           

            <td>
              <input class="w3-input" type="text" name="qt" placeholder="Enter Quantity" id="qts">
            </td>

            <td>
              <input class="w3-input" type="text" name="mrp" placeholder="Enter Rate" id="mrp">
            </td>
            <td>
              <input class="w3-input" type="text" name="disc" placeholder="Enter Discount" id="disc">
            </td>

            <td>
              <input class="w3-button w3-teal" type="submit" name=""  id="productAdd">
            </td>
            </form>
          </tr>
        </table>
      </div>

      <div class="w3-container" >
        <table class="w3-table-all" id="viewProduct">
          
        </table>
      </div><br>      
    </div><br>
   </div>

<!-- 
 <div class="w3-container">
 	<table class="w3-table" id="tbl">
 		<tr>
 			<td class="w3-text-yellow">Selectdate</td>
 			<td><input type="date" class="w3-input"  id="date"></td>
 		</tr>
 	</table>
 </div>
   -->

 <!--        Address  Details              -->
  <div class="w3-container">

    <div class="w3-card">
    	                     <!--      New  Address  Modal              -->
      
       <div class="w3-container w3-modal" id="newAdd">
       	<div class="w3-card w3-modal-content w3-light-gray">
       	 <button id="newAddClose" class="w3-button w3-display-topright">&times;</button><br><br>
       	 <h4 class="w3-center w3-text-green">Add New Address</h4>
       		<table class="w3-table">
           
            <tr>
              <td class="w3-text-indigo">Name</td>
              <td><input class="w3-input w3-border" type="text" id="name" autocomplete="on"></td>
            </tr>
            <tr>
              <td class="w3-text-indigo" >Address</td>
              <td><input class="w3-input w3-border" type="text" size="100" id="address" autocomplete="on"></td>
            </tr>
            <tr>
              <td class="w3-text-indigo">GSTIN</td>
              <td><input class="w3-input w3-border" type="text" id="gstin"></td>
            </tr>
            <tr>
              <td class="w3-text-indigo">DLNO</td>
              <td><input class="w3-input w3-border" type="text" id="dlno"></td>
            </tr>  
            
            <tr>
              <td></td>
              <td><input class="w3-button w3-green" id="insert" type="submit" ></td>
            </tr>        
          </table><br>
       	</div>
       </div>	
      
      <h3 class="w3-center w3-text-green" id="hdr">Address Menu</h3>
      <div class="w3-row-padding">
        <div class="w3-container w3-half">
          <h4 class="w3-center w3-text-teal">Billing</h4>
          <div class="w3-container">                                   
              <form method="post" id="form2">
                <select id="billAddress" name="product" class="w3-select">
                  <option value="">Select Address</option>
                  <?php 
                    
                    $query1="SELECT * FROM billing";
                    $run1=mysqli_query($con,$query1);
                    while($row1=mysqli_fetch_assoc($run1)){
                      echo"<option value='".$row1['name']."''>".$row1['name']."</option>";
                     }
                    
                  ?>
                </select>
              </form>                    
            </div><br>   
            <div class="w3-container">  
              <table class="w3-table-all" id="viewBillAddress">                
              </table>
            </div><br>             
        </div>

        <div class="w3-container w3-half">
          <h4 class="w3-center w3-text-teal">Shippng</h4>
           <div class="w3-container">                                   
              <form method="post" id="form3">
                <select id="shipAddress" name="product" class="w3-select">
                  <option value="">Select Address</option>
                  <?php 
                    
                    $query2="SELECT * FROM billing";
                    $run2=mysqli_query($con,$query2);
                    while($row2=mysqli_fetch_assoc($run2)){
                      echo"<option value='".$row2['name']."'>".$row2['name']."</option>";
                    }
                    
                  ?>
                </select>
              </form>                    
            </div><br>   

            <div class="w3-container">  
              <table class="w3-table-all" id="viewShipAddress">                
              </table>
            </div><br>

        </div>

      </div>
      <button  class="w3-button w3-circle w3-teal" id="newAddOpen"><i class="material-icons">add</i></button> 
    </div>

  </div><br>

<!--     Invoice  Details    -->
      <div class="w3-container">
        <div class="w3-card">
          <div class="w3-container">
          <select class="w3-select" id="payment">
            <option value="">Select Payment Mode</option>
            <option value="CASH">Cash</option>
            <option value="CREDIT">CREDIT</option>
          </select>
          </div>
        </div>
      </div><br>
 
<!--     Finish Button    -->
  
    <div class="w3-container w3-center">
        <a href="purches.php"><button class='w3-button w3-center w3-teal' id="finish">Finish</button></a>
    </div><br>

    <div id="hide">
      
    </div>


</div><!--        End New Bill              -->    


<!--         Return Bill              -->   
<div class="bill" id="return">
	<div class="w3-container">
    <table class="w3-table"> 
      <tr>
        <td>
          <select class="w3-select" id="returnBillInvoice">
            <option value="">Select Invoice Number</option>
            <?php 
                         $query3="SELECT * FROM purchestotal";
                         $run3=mysqli_query($con,$query3);
                         while($row3=mysqli_fetch_assoc($run3)){
                          if($row3['status']!="Return"){
                          echo "<option value='".$row3['invoicenumber']."'>".$row3['invoicenumber'].'  '.$row3['bill'].'  '.$row3['invoicedate']."</option>";
                          }
                         }

                         
             ?>
          </select>
        </td>
        <td>
          <button class="w3-button w3-blue" id="returnBill">Select Bill</button>
        </td>
      </tr>
    </table>

    <div class="w3-container" id="viewReturnBill">

    </div>  

    <button class='w3-button w3-red' id='removeBill'>Remove Bill</button> 

	</div>
</div><!--        End Return Bill              -->   



<!--         Reprint Bill              -->   
<br><div class="bill" id="reprint">
	<div class="w3-container">
		<table class="w3-table-all">
			<form method="post" action="reprint.php">
			<tr>
				<td>
					<select class="w3-select" name="iv">
						<option value="">Select Invoice Number</option>
						<?php 
                         $query4="SELECT `bill`,`invoicenumber`,`invoicedate` FROM purchestotal";
                         $run4=mysqli_query($con,$query3);
                         while($row4=mysqli_fetch_assoc($run4)){
                         	echo "<option value='".$row4['invoicenumber']."'>".$row4['invoicenumber'].'  '.$row4['bill'].'  '.$row4['invoicedate']."</option>";
                         }
                         
						 ?>
					</select>
				</td>
				<td>
					<button class="w3-button w3-blue" id="reprintbill">Print Bill</button>
				</td>
			</tr>
		</form> 
		</table>
	</div>
</div><!--        End Return Bill              -->   

 
  
</body>
</html>




<!--      -->