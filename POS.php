<?php
session_start();

$numnum = 1;
if($_SESSION['AdminLog'] != $numnum){
header("Location: Log-IN.php");
}

include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BF.POS</title>
	<link rel="stylesheet"  href="assets/css/bootstrap.min.css">
  <link rel="stylesheet"  href="assets/css/custom2.css">
  <link rel="stylesheet"  href="assets/css/custom.css">






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
              <li><a href="Admin.php">Admin Settings</a></li>
            </ul>

          </li>
          <li><a href="sales.php">SALES</a></li>
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




      <div class="container-fluid" style="min-height: 580px;">
        <div class="row content">
          
          <div class="col-sm-7 sidenav">
           
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#AllProduct" aria-controls="home" role="tab" data-toggle="tab">All Product</a></li>
              <li role="presentation"><a href="#Masculine" aria-controls="profile" role="tab" data-toggle="tab">Masculine</a></li>
              <li role="presentation"><a href="#Feminine" aria-controls="messages" role="tab" data-toggle="tab">Feminine</a></li>
            </ul>

            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="AllProduct">
                <div class="row " >
                  <div class="col-sm-12">
                    <h2>All Products</h2>
                    <p></p>
                    <div class="scrollable">

                      <?php 

                      $query="SELECT * from product";
                      $result=mysqli_query($db,$query);
                      while($row = mysqli_fetch_array($result))
                       {?>
                     <div class='col-sm-3 '>
                      <div class='thumbnail'>
                       <img style='width: 150px; height: 100px' src='assets/img/<?php echo $row['img_name'];?>' alt='Cinque Terre' width='300' height='236'>
                       <div class='caption'>
                         <p><b><?php echo $row['name'];     ?> </b>
                          <br><?php echo $row['price'];      ?> </p>
                          <form method="post" action="POSaddtokart.php">
                          <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >
                          <input type="submit" name="submit" value="add" class="btn btn-info btn-xs">
                          </form>
                          <br> 
                        </div>
                      </div>
                    </div>               
                    <?php
                  } 
                  ?>
                </div>
              </div>
            </div>
          </div>


          <div role="tabpanel" class="tab-pane" id="Masculine">
            <div class="row " >
              <div class="col-sm-12">
                <h2>Masculine</h2>
                <p></p>
                <div class="scrollable">
                  <?php 
                  $query="SELECT * from product WHERE Category='1' OR Category='3' ";
                  $result=mysqli_query($db,$query);
                  while($row = mysqli_fetch_array($result))
                   {?>
                 <div class='col-sm-3 '>
                  <div class='thumbnail'>
                   <img style='width: 150px; height: 100px' src='assets/img/<?php echo $row['img_name'];?>' alt='Cinque Terre' width='300' height='236'>
                   <div class='caption'>
                     <p><b><?php echo $row['name'];     ?> </b>
                      <br><?php echo $row['price'];      ?> </p>
                        <form method="post" action="POSaddtokart.php">
                          <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >
                          <input type="submit" name="submit" value="add" class="btn btn-info btn-xs">
                          </form>
                      <br> 
                    </div>
                  </div>
                </div>               
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="Feminine">
            <div class="row " >
              <div class="col-sm-12">
                <h2>Masculine</h2>
                <p></p>
                <div class="scrollable">
                  <?php 
                  $query="SELECT * from product WHERE Category='2' OR Category='4' ";
                  $result=mysqli_query($db,$query);
                  while($row = mysqli_fetch_array($result))
                   {?>
                 <div class='col-sm-3 '>
                  <div class='thumbnail'>
                   <img style='width: 150px; height: 100px' src='assets/img/<?php echo $row['img_name'];?>' alt='Cinque Terre' width='300' height='236'>
                   <div class='caption'>
                     <p><b><?php echo $row['name'];     ?> </b>
                      <br><?php echo $row['price'];      ?> </p>
                        <form method="post" action="POSaddtokart.php">
                          <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >
                          <input type="submit" name="submit" value="add" class="btn btn-info btn-xs">
                          </form>
                      <br> 
                    </div>
                  </div>
                </div>               
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        


      </div> <!-- END OF TAB CONTENT-->




    </div>
    <div class="col-sm-5" style="background-color:azure; height:575px ">




     
      <table class="table table-hover" style="border-style: solid; border-width: medium; border-color:deepskyblue;">

       <thead>
        <tr>
          <th>ID</th>
          <th>name</th>
          <th>price</th>
          <th>quantity</th>
           <th>Total</th>
        </tr>
      </thead>

      <tbody>
 <?php            $_SESSION['totals'] = 0;
                  $query="SELECT id, name, price, quantity, total from orderkartview";
                  $result=mysqli_query($db,$query);
                  while($row = mysqli_fetch_array($result))
                   { ?>
        <tr>
          <td >
          <center>
            <?php echo " ".$row['id'] ?>
          <br>
           <form method="post" action="POSremove.php">
           <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >
          <input type="submit" name="remove" value="remove" class="btn btn-info btn-xs">
         
          </form>
          </center>
          </td>
          <td > <?php echo $row['name'] ?></td>
          <td class="filterable-cell"> <?php echo "  ".$row['price'] ?></td>
          <td class="filterable-cell">
            <center> 
           <?php echo $row['quantity'] ?> 
          <a class="btn btn-danger btn-xs"  data-toggle="modal"  data-target="#myModal<?php echo $row['id']; ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
            </center>
<div class="modal fade" id="myModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Quantity</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="POSupdate.php"><center>
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >
      <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" >  
      <input type="submit" name="update" value="save changes" class="btn btn-info btn-xs"></center>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
       </td>
          <td class="filterable-cell"> <center><?php echo $row['total']; ?> </center></td>
            <?php $_SESSION['totals'] = $_SESSION['totals'] + $row['total'];  ?>
              
          </td>
        </tr>   
         <?php } ?>
      </tbody>
  
    </table>

     <h2>Total: &#8369; <?php echo $_SESSION['totals'];  
           if(isset($_GET['msg3'])){
                          $Message = "  Customer CASH is not enough.";
                           echo "<font size='3' class='bg-danger' > $Message </font>";
            }
     ?></h2>
  <form method="post" action="POSpaymentAndcancel.php">
    <input type="number" name="cash" class="input-md form-control" placeholder="Customer Cash" required>
    <input type="submit" name="submitcash" value="PAY" class="btn btn-lg btn-primary btn-block">
    
  </form>
  <form method="post" action="POSpaymentAndcancel.php">
      <input type="submit" name="submitcancel" value="CANCEL" class="btn btn-sm btn-danger btn-block">
   </form>

</div>
  </div>
</div>
</div>

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
