
<?php
session_start();
$numnum = 1;
if($_SESSION['AdminLog'] != $numnum){
header("Location: index.php");
}

include 'db.php';

 //$_SESSION['totals2'] = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BingKicks Sales</title>
	<link rel="stylesheet"  href="assets/css/bootstrap.min.css">
	<link rel="stylesheet"  href="assets/css/custom.css">
  <link rel="stylesheet"  href="assets/css/custom2.css">
</head>
<body>


  <nav class="navbar my-color"><!-- navbar-fixed-top  -->

    <div class="container">

      <div class="navbar-header">
        <a class="navbar-brand" href="pos.php"> <font size=6>BingKicks</font>Point of Sale </a>
      </div>
      <ul class="nav navbar-nav">

        <li class="active">
          <a href="pos.php"><span class="glyphicon glyphicon-home"></span></a>
        </li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-th-list"></span>
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="Product.php">Product</a></li>
              <li><a href="Supplier.php">Supplier</a></li>
              <li><a href="Admin.php">Admin</a></li>
            </ul>

          </li>
          <li><a href="sales.php">SALES</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">

          <li><a href="Log-OUT.php">
            <?php 
            echo "".$_SESSION['Name']."  ";
            ?>
            <span class="glyphicon glyphicon-log-out"></span> Log-out</a></li>
          </ul>
        </div>
      </nav>



      <div class="container" style="min-height: 580px;">
       <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#Sales" aria-controls="Sales" role="tab" data-toggle="tab">Sales</a></li>
        <li role="presentation"><a href="#ProductSales" aria-controls="Product Sales" role="tab" data-toggle="tab">Product Sales</a></li>
      </ul>
      
      <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="Sales">
              



<div class="row" >

       <form method="post" action="" > 
        
        <div class="col-sm-10 col-sm-offset-1" > 
          <h1>Sales </h1>
          <div class="col-xs-3">  
           From: <input type="text" name="from_date"  class="form-control " placeholder="From Date" />  
         </div>  
         <div class="col-xs-3">  
           To: <input type="text" name="to_date"  class="form-control" placeholder="To Date" />  
         </div> 
         <div class="col-md-5">
         <br>  
           <input type="submit" name="submit1" value="submit" class="btn btn-info" />  
         </div> 
       </div>


     </form>
    
    <div class="row">
     <div class="col-md-12" style="background-color:">
     
     <table class="table table-hover" style="border-style: solid; border-width: medium; border-color:deepskyblue;">

       <thead>
        <tr>
          <th></th>
          <th>Sales Number</th>
          <th>Total Sales</th>
          <th>Date</th>
          <th>Cashier</th>
        </tr>
      </thead>
      <tbody>

       <?php 
       

       $_SESSION['totals2'] = 0;
             //$query="SELECT * from salesview ORDER BY sales_number";
       if(isset($_POST['submit1'])){
         $from = $_POST['from_date'];
         $to = $_POST['to_date'];
         $query = "SELECT * FROM salesview WHERE Date BETWEEN '$from' AND '$to' ORDER BY sales_number"; 
       }else{
        $query="SELECT * from salesview ORDER BY sales_number";
       }

      $result=mysqli_query($db,$query);

      while($row = mysqli_fetch_array($result))
       { ?>

     <tr>
      <td>




       <a class="btn btn-danger btn-sm"  data-toggle="modal"  data-target="#myModal<?php echo $row['sales_number']; ?>" >view details</a>
       <div class="modal fade" id="myModal<?php echo $row['sales_number']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Details</h4>
            </div>
            <div class="modal-body">
             <table class="table table-hover" style="border-style: solid; border-width: medium; border-color:deepskyblue;">
               <thead>
                <tr>
                  <th>Product Id</th>
                  <th>Product Name</th>th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php            
                $query2="SELECT Product_ID, Name, Quantity, total from detailsview WHERE sales_number = ".$row['sales_number'];
                $result2=mysqli_query($db,$query2);
                while($row2 = mysqli_fetch_array($result2))
                 { ?>
               <tr>
                 <td class="filterable-cell"> <?php echo "  ".$row2['Product_ID'] ?></td>
                 <td class="filterable-cell"> <?php echo "  ".$row2['Name'] ?></td>
                 <td class="filterable-cell"> <?php echo "  ".$row2['Quantity'] ?></td>
                 <td class="filterable-cell"> <?php echo "  ".$row2['total'] ?></td>
               </tr>        
               <?php } ?>
             </tbody>
           </table> <!-- END of inner table -->
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>







</td>
<td >
  <?php echo " ".$row['sales_number'] ?>
</td>

<td > <?php echo $row['total'] ?>
 <?php $_SESSION['totals2'] = $_SESSION['totals2'] + $row['total'];  ?>

</td>

<td class="filterable-cell"> <?php echo "  ".$row['Date'] ?></td>
<td class="filterable-cell"> <?php echo "  ".$row['Cashier'] ?></td>      
</tr> 

<?php } ?>
</tbody>

</table> <!-- enf of outside table -->
</div>
</div>
<center> <h2>Total: &#8369; <?php echo $_SESSION['totals2']; ?> </h2>
</center>

</div> <!-- end of row -->







        </div>

        <div role="tabpanel" class="tab-pane " id="ProductSales">
    
<form method="post" action="" > 
        
        <div class="col-sm-10 col-sm-offset-1" style="background-color:;"> 
          <h1>Prodcut Sales </h1>
          <div class="col-md-3">  
           
<!--     From: <input type="date" name="from_date"  class="form-control " placeholder="From Date" />  --> 
         </div>  
         <div class="col-md-3">  
      <!--       To: <input type="date" name="to_date"  class="form-control" placeholder="To Date" /> -->  
         </div> 
         <div class="col-md-5">
         <br>  
           <input type="submit" name="submit3" value="submit" class="btn btn-info" />  
         </div> 
              <div class="col-md-4">
              Product: <select name="product" class="form-control">
                <option value=""></option>
                <?php


                $query="SELECT * FROM product";
                $result=mysqli_query($db,$query);

                while($row = mysqli_fetch_array($result)){
                  echo "<option value='".$row['name']."'>".$row['name']."</option>";
                }
                ?>
              </select>
         </div>
         <div class="col-md-4">
              Category: <select name="category" class="form-control">
                <option value=""></option>
                <?php


                $query="SELECT * FROM category";
                $result=mysqli_query($db,$query);

                while($row = mysqli_fetch_array($result)){
                  echo "<option value='".$row['name']."'>".$row['name']."</option>";
                }
                ?>

              </select>

         </div>

         <div class="col-md-4">
             Supplier: <select name="supplier" class="form-control">
                 <option value=""></option>
                <?php
                $query="SELECT * FROM supplier";
                $result=mysqli_query($db,$query);

                while($row = mysqli_fetch_array($result)){
                  echo "<option value='".$row['name']."'>".$row['name']."</option>";
                }
                ?>
              </select>
         </div>


     

       </div>
     </form>


    <table class="table table-hover" style="border-style: solid; border-width: medium; border-color:deepskyblue;">
       <thead>
        <tr>
             
          <th style="width: 12.5%;float: left;" >Product ID</th>
          <th style="width: 12.5%;float: left;" >Product Name</th>
          <th style="width: 12.5%;float: left;">Category</th>
          <th style="width: 12.5%;float: left;">Supplier</th>
          <th style="width: 12.5%;float: left;">Sales No.</th>
          <th style="width: 12.5%;float: left;">Price</th>
          <th style="width: 12.5%;float: left;">Quantity</th>
          <th style="width: 12.5%;float: left;">Total</th>
        </tr>
      </thead>
      <tbody>
  <?php 
       
  //$_SESSION['totals3'] = 0;
       
             //$query="SELECT * from salesview ORDER BY sales_number";
       if(isset($_POST['submit3'])){
         //$from = $_POST['from_date'];
         //$to = $_POST['to_date'];
         $product = $_POST['product'];
         $supplier = $_POST['supplier'];
         $category = $_POST['category'];
         
         $_SESSION['totals3'] = 0;



        $query = "
        SELECT * 
FROM productsoldview
WHERE name LIKE  '$product%'
AND supplier LIKE '$supplier%'
AND category LIKE '$category%'
        "; 
//Date BETWEEN '$from' AND '$to'
       }else{
        $_SESSION['totals3'] = 0;
        $query="SELECT * from productsoldview ORDER BY sales_number DESC";
       }

      $result3=mysqli_query($db,$query);

      while($row3 = mysqli_fetch_array($result3))
       { ?>


        <tr>
         <td style="width: 12.5%;float: left; class="filterable-cell"> <?php echo "  ".$row3['product_id'] ?></td>
          <td style="width: 12.5%;float: left; class="filterable-cell"> <?php echo "  ".$row3['name'] ?></td>
           <td style="width: 12.5%;float: left; class="filterable-cell"> <?php echo "  ".$row3['category'] ?></td>
            <td style="width: 12.5%;float: left; class="filterable-cell"> <?php echo "  ".$row3['supplier'] ?></td>
             <td style="width: 12.5%;float: left; class="filterable-cell"> <?php echo "  ".$row3['sales_number'] ?></td>
              <td style="width: 12.5%;float: left; class="filterable-cell"> <?php echo "  ".$row3['price'] ?></td>
               <td style="width: 12.5%;float: left; class="filterable-cell"> <?php echo "  ".$row3['quantity'] ?></td>
                <td style="width: 12.5%;float: left; class="filterable-cell"> <?php echo "  ".$row3['total'] ?>
                  
                   <?php $_SESSION['totals3'] = $_SESSION['totals3'] + $row3['total'];  ?>

                </td>
          
        </tr>
        <?php } ?>
      </tbody>
    </table>


<center> <h2>Total: &#8369; <?php echo $_SESSION['totals3']; ?> </h2>
</center>




        </div>  
      </div>

















      

</div> <!-- end of container -->

<footer class="container-fluid my-color">
 
<center><p>
<br>
<br>
&copy;2017 BingKicks POS </p></center>

</footer>   
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>