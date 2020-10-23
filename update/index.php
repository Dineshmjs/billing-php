<?php 
  include 'db.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Products</title>
	<title>Sri  Padhmavathi Enterprices</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="w3.css">	
    <script type="text/javascript" src="min.js"></script>
    <style type="text/css">
      .w3-input,#sno{
        width:100%;
      }
      
      a{
        text-decoration: none;
      }
      ul{ 
        list-style-type: none;
        margin: 0;
        padding: 0;
        background-color:#eee;  
        cursor:pointer;  
        
      }  
      li{  
        padding:12px;  
      }
      #searching,#searching1 ul{
        width:60%; 
      }  
      .w3-card{
        height: 150px;
      }
      h4{
        padding-top: 50px;
      }
      #newPurches{
        display: none;
      }
      #newAddress{
        display: none;
      }
      #purchesInsert{
        margin-top:20px; 
        margin-left: 45%;
      }
      #table{
        width: 60%;
        margin-left: 20%; 
      }
      #insert{
        margin-left: 40%; 
      }
      #modify{
        display: none;
      }
      #purchesInsert{
        margin-left: 30%;
        margin-right: 200px; 
        margin-bottom: 20px;
      }
      #purchesVerify{
        margin-left: 45%;
      }


      
      
    </style>



    <script type="text/javascript">
      
      $(document).ready(function(){
        //BILL VERIFY
        $("#purchesVerify").click(function(){                 
        var data1=$("#purchesBill").serialize();
        var data2=$("#purchesData").serialize();
        var data=data1+"&"+data2;       

        $.ajax({  
          url:"read.php",  
          method:"POST",  
          data:data,  
          success:function(data)  
            {                
              $("#viewVerify").html(data); 
              $("#viewModal").show(); 
            }  
        });        
         
      });

        //BILL INSERT
        $("#purchesInsert").click(function(){
          var data1=$("#purchesBill").serialize();
          var data2=$("#purchesData").serialize();
          var data=data1+"&"+data2;         

          $.ajax({  
            url:"insert.php",  
            method:"POST",  
            data:data,  
            success:function(data)  
              {  
                alert(data); 
                location.reload();                
              }  
          });        
           
        });
        //PURCHES CANCEL
        $("#purchesCancel").click(function(){
          $("#viewModal").hide();
        });

        //ADDRESS INSERT
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
      

    //FETCH INFORMATION 
      $("#fetchPurches").click(function(){
        $.post("read.php",{iv:$("#purchesInvoice").val()},function(data){
           $("#viewModify").html(data);
           //alert(data);
        });
      });

      $("#fetchAddress").click(function(){      	
        $.post("read.php",{add:$("#changeAddress").val()},function(data){
           $("#viewModify").html(data);
        });
      });

      $("#fetchGoods").click(function(){
        $.post("read.php",{goods:$("#changeGoods").val()},function(data){
           $("#viewModify").html(data);
        });
      });


  });    



  </script>


  <script type="text/javascript">
    //menu Details show hide
    $(document).ready(function(){
        $("#newPurchesOpen").click(function(){
           $("#newPurches").show();  
           $("#newAddress").hide();
           $("#modify").hide();  
        });
        $("#newAddressOpen").click(function(){
           $("#newAddress").show();
           $("#newPurches").hide();
           $("#modify").hide();    
        });
        $("#modifyOpen").click(function(){
           $("#newAddress").hide();
           $("#newPurches").hide();
           $("#modify").show();  
        });   

        $("#closeModal").click(function(){
          $("#viewModal").hide();
        });  
               
        
    });
  </script>

  <script type="text/javascript">
    // Modify Change 	

  	$(document).on("click","#addressClick",function(){
  		var aid=$(this).attr("aid");  		
       $.post("update.php",{
       	aname:$("#aname").val(),
       	aaddress:$("#aaddress").val(),
       	agst:$("#agst").val(),
       	adlno:$("#adlno").val(),
       	aid:aid
       },function(data){
          alert(data);
          location.reload();
       });

  	});

    $(document).on("click","#deleteBill",function(){
      var did=$(this).attr("bid");

       $.post("delete.php",{did:did},function(data){
          alert(data);
          location.reload();
       });  	
       
    });

    $(document).on("click","#changeBill",function(){
    	var cid=$(this).attr("bid");
    	var bname=$("#bname").val();
    	var binvoice=$("#binvoice").val();    	
    	$.post("update.php",{cid:cid,bname:bname,binvoice:binvoice},function(data){
    		alert(data);
    		location.reload();
    	});
    }); 

    $(document).on("click","#itemRemove",function(){      
      $.post("update.php",{iid:iid,iq:iq,ir:ir},function(data){
          alert(data);
          location.reload();
      });
    });

    $(document).on("click","#itemChange",function(){
    	var cltr=$(this).closest("tr");
    	var ig=cltr.find(".ig").val();   	
    	
    	var ip=$(this).attr("ip");
    	var iiv=$(this).attr("iiv");
    	alert(ig+ip+iiv);
    	$.post("update.php",{ip:ip,iiv:iiv,ig:ig},function(data){
    		alert(data);
        location.reload();
    	});
    });

    $(document).on("click","#updateGoods",function(){
      $.post("update.php",{
        ghsn:$("#ghsn").val(),
        ggst:$("#ggst").val(),
        gmrp:$("#gmrp").val(),
        gid:$(this).attr("gid")
      },function(data){
         alert(data);
         location.reload();
      });     
      
    });

  </script>

  <script type="text/javascript">
   // item generation 
  	$(document).ready(function(){
  	 $("#click").click(function(){
          var count=$("#numofproduct").val();
          count=Number(count);
          count+=1;
          //alert(typeof count)
          var tr;
          for (var i=1; i < count; i++) {
            tr+=
               `<tr>
                  <td>`+i+`</td>
                  <td>
                    <input class="w3-input w3-border product" type="text"  name="product`+i+`" autocomplete="on"placeholder="Product" >
                    <ul></ul>
                  </td>
                  <td>
                  	<input class="w3-input w3-border hsnno" type="text"  name="hsn`+i+`" autocomplete="on" placeholder="HsnNo">
                  </td>
                  <td>
                  	<input class="w3-input w3-border gst" type="text"  name="gst`+i+`" autocomplete="on" placeholder="Gst">
                  </td>
                  <td>  
                    <input class="w3-input w3-border mrp" type="text"  name="mrp`+i+`" placeholder="Mrp">
                  </td>
                  <td>
                  	<input class="w3-input w3-border quantity" type="text"  name="qt`+i+`" placeholder="Quantity">
                  </td>                  
                  <td>
                  	<input class="w3-input w3-border rate" type="text"  name="rate`+i+`" placeholder="Rate">
                  </td>                  
                </tr>`;
          }
          var th="<tr><th>No</th><th>Product</th><th>HsnNo</th><th>GST</th><th>MRP</th><th>Quantity</th><th>Rate</th></tr>"
          $("#newtr").html(th+tr);
        });
  	}); 
  </script>

  <script type="text/javascript">
  // AutoFill
  //company
    $(document).on("keyup","#pname",function(){
      var ival=$(this).val();
      $.post("autofill.php",{ival:ival},function(data){
        $("#viewCompany").fadeIn();
        $("#viewCompany").html(data);
      });         
    });
    $(document).on("click",".clickCompany",function(){      
      var val=$(this).text();          
      $("#pname").val(val);
      $("#viewCompany").fadeOut();        
    });

  //items
    $(document).on("keyup",".product",function(){
      var ival=$(this).val();
      var next=$(this).next(); 


      $.post("autofill.php",{ival1:ival},function(data){ 
        next.fadeIn(); 
        next.html(data);           

      });         
    });

    $(document).on("click",".clickProduct",function(){          
      var val=$(this).text();  

      var tr=$(this).closest("tr");
      var ul=$(this).closest("ul"); 

      $.post("read.php",{items:val},function(data){   

       var obj=JSON.parse(data);
      
       tr.find(".product").val(obj.product);
       tr.find(".hsnno").val(obj.hsn);
       tr.find(".gst").val(obj.gst);
       tr.find(".mrp").val(obj.mrp);
      });       
      
      ul.fadeOut();
      
    });


  </script>
   

</head>
<body> 
 
<!-- Head -->
  <div class="w3-container w3-orange">
  	<a href="../index.php"><h1 class="w3-center w3-text-light-gray">Sri Padhmavathi Enterprises</h1></a>
  </div>
<!-- Head End-->  

<!-- Manu  Start-->
  <div class="w3-container">
    <div class="w3-row-padding">

      <div class="w3-third" id="newPurchesOpen">
        <div class="w3-card">
          <h4 class="w3-center">Add New Purches Entry</h4>
        </div>
      </div>

      <div class="w3-third" id="newAddressOpen">
        <div class="w3-card">
         <h4 class="w3-center">Add New Address</h4>
        </div>
      </div>

      <div class="w3-third" id="modifyOpen">
        <div class="w3-card">
          <h4 class="w3-center">Modify Details</h4>
        </div>
      </div>

    </div>
  </div><br>
<!-- Manu  End-->  

<!-- Purches Entry Start -->
  <div class="w3-container" id="newPurches">
    <div class="w3-card">
      <br><h3 class="w3-center">Enter Purches Entry</h3>
      <div class="w3-container" >                 
        
        <table class="w3-table-all" >
          <form id="purchesBill">
          <tr>
            <td>
              <input class="w3-input w3-border" type="text"  id="pname" name="iname" autocomplete="on" placeholder="CompanyName"><ul id="viewCompany"></ul>
            </td>
            <td>
              <input class="w3-input w3-border" type="text" id="invoicenumber" name="ino" placeholder="InvoiceNumber">
            </td>
            <td>
              <input class="w3-input w3-border" type="date" id="idate" name="idate" >
            </td>
            <td>
              <input class="w3-input w3-border" type="number" id="numofproduct" name="itotal" placeholder="No of Products">
            </td>
          </form>   
            <td>
              <button class="w3-button w3-teal" id="click">Click</button>
            </td>
          </tr> 
        </table>
        
        
        <form id="purchesData">

          <table class="w3-table-all" id="newtr">

            
          </table>
        </form>
        <br><button class="w3-button w3-green" id="purchesVerify">Submit</button>

        <div class="w3-container" id="view"></div>
 
      </div>
    </div>
  </div>
<!-- Purches Entry End -->  

<!-- Address Entry -->  
  <div class="w3-container" id="newAddress">
    <div class="w3-card-4">
      <br><h3 class="w3-center">Add New Address</h3>
       
          <table class="w3-table-all" id="table">           
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
              <td><button class="w3-button w3-green" id="insert" type="submit" >Insert</button></td>
            </tr>        
          </table><br>       

    </div>
  </div>
<!-- Address Entry End -->    

<!-- Modify Entry start -->  
  <div class="w3-container" id="modify">
    <div class="w3-row-padding">

      <!-- Purchas Change start -->
      <div class="w3-third">
        <div class="w3-card-2">
          <h5 class="w3-center">Purches</h5>  
          <table class="w3-table-all">
            <tr>
              <td>
                <select class="w3-input w3-border" id="purchesInvoice">
                  <option value="">Select Details</option>
                  <?php  
                    $sql="SELECT * FROM `buydetail`";
                    $exe=mysqli_query($con,$sql);
                    while ($val=mysqli_fetch_assoc($exe)) {
                      echo "<option value='".$val['invoicenumber']."'>".$val['invoicenumber']."</option>";
                    }
                  ?>
                </select>
              </td>
              <td><input class="w3-button w3-green " type="submit" value="Fetch" id="fetchPurches"></td>
            </tr>
          </table>
        </div>           
      </div>
       <!-- Purchas Change End -->

      <!-- Address Change Start -->
      <div class="w3-third">
        <div class="w3-card-2">
          <h5 class="w3-center">Address</h5>
          <table class="w3-table-all">
            <tr>
              <td>
                <select class="w3-input w3-border" id="changeAddress">
                  <option value="">Select Details</option>
                  <?php  
                    $sql1="SELECT * FROM `billing`";
                    $exe1=mysqli_query($con,$sql1);
                    while ($val1=mysqli_fetch_assoc($exe1)) {
                      echo "<option value='".$val1['id']."'>".$val1['name']."</option>";
                    }
                  ?>
                </select>
              </td>
              <td><input class="w3-button w3-green " type="submit" value="Fetch" id="fetchAddress"></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- Address Change End -->

      <!-- Goods Change Start -->
      <div class="w3-third">
      	<div class="w3-card-2">
      		<h5 class="w3-center">Goods Change</h5>
      		<table class="w3-table-all">
            <tr>
              <td>
                <select class="w3-input w3-border" id="changeGoods">
                  <option value="">Select Details</option>
                  <?php  
                    $sql2="SELECT * FROM `goods`";
                    $exe2=mysqli_query($con,$sql2);
                    while ($val2=mysqli_fetch_assoc($exe2)) {
                      echo "<option value='".$val2['id']."'>".$val2['product']."</option>";
                    }
                  ?>
                </select>
              </td>
              <td><input class="w3-button w3-green " type="submit" value="Fetch" id="fetchGoods"></td>
            </tr>
          </table>      		
      	</div>
      </div> 

    </div><br>
 
    <!-- View Informatio Start -->
    <div class="w3-container" id="viewModify">
      
    </div>
    <!-- View Informatio End -->
  </div>     

<!-- Modify Entry End -->  


<!-- Modal start -->    
  <div class="w3-modal w3-container" id="viewModal">
    <div class="w3-modal-content w3-container">
      <button class="w3-display-topright" id="closeModal">&times;</button>
      <div class="w3-container" id="viewVerify"></div><br> 
      <button class="w3-button w3-green" id='purchesInsert'>Confirm</button>
      <button class="w3-button w3-red" id='purchesCancel'>Cancel</button>       
    </div>
  </div>
<!-- Modal End -->       


  
</body>
</html>