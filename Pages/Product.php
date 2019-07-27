<?php
session_start();
$numnum = 1;
if($_SESSION['AdminLog'] != $numnum){
header("Location: index.php");
}

include 'db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BF.POS</title>
	<link rel="stylesheet"  href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet"  href="../assets/css/custom.css">





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




    <div class="container-fluid"  style="min-height: 580px;">



      <div class="row" >

        <div class="col-xs-5" style="background-color:;">



          <div class="col-xs-12  col-xs-offset-1" style="background-color:;">
            <h2>
              Shoes Management
            </h2>
          </div>


          <div class="col-xs-12 col-xs-offset-2" style="background-color:;">
            <h4>Add your new shoes product:</h4>  

            <div class="col-xs-10" style="background-color:;">
             <form action="ProductAdd.php" method="post" enctype="multipart/form-data">
               Shoes Name:
               <br> 
               <input type="text" name="name" class="form-control">
               <br>
               Shoes Price: 
               <br>
               <input type="number" name="price" class="form-control">
               <br>
               Category:
               <br>
               <select name="category" class="form-control">
                <?php


                $query="SELECT * FROM category";
                $result=mysqli_query($db,$query);

                while($row = mysqli_fetch_array($result)){
                  echo "<option value='".$row['id']."'>".$row['name']."</option>";
                }
                ?>

              </select>
              <br>
              Supplier
              <br>
              <select name="supplier" class="form-control">
                <?php

                $query="SELECT * FROM supplier";
                $result=mysqli_query($db,$query);

                while($row = mysqli_fetch_array($result)){
                  echo "<option value='".$row['id']."'>".$row['name']."</option>";
                }
                ?>
              </select>
              <br>
              Image: &nbsp; <input type="file" name="file" class="form-control">
              <br>
              <input type="submit" name="submit">
            </form>
          </div>


        </div>




      </div>

      <div class="col-xs-7"  style="background-color:;">


       <!-- Nav tabs -->
       <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#AllProduct" aria-controls="home" role="tab" data-toggle="tab">All Product</a></li>
        <li role="presentation"><a href="#Masculine" aria-controls="profile" role="tab" data-toggle="tab">Masculine</a></li>
        <li role="presentation"><a href="#Feminine" aria-controls="messages" role="tab" data-toggle="tab">Feminine</a></li>

      </ul>


      <!-- Tab panes -->

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
                 <img style='width: 150px; height: 100px' src='../assets/img/<?php echo $row['img_name'];?>' alt='Cinque Terre' width='300' height='236'>
                 <div class='caption'>
                   <p><b><?php echo $row['name'];     ?> </b>
                    <br><?php echo $row['price'];      ?> </p>
                    <input type="button" name="edit" value="Edit" id="<?php echo $row['id']; ?>" class="btn btn-info btn-xs edit_data" />
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
             <img style='width: 150px; height: 100px' src='../assets/img/<?php echo $row['img_name'];?>' alt='Cinque Terre' width='300' height='236'>
             <div class='caption'>
               <p><b><?php echo $row['name'];     ?> </b>
                <br><?php echo $row['price'];      ?> </p>
                <input type="button" name="edit" value="Edit" id="<?php echo $row['id']; ?>" class="btn btn-info btn-xs edit_data" />
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
       <img style='width: 150px; height: 100px' src='../assets/img/<?php echo $row['img_name'];?>' alt='Cinque Terre' width='300' height='236'>
       <div class='caption'>
         <p><b><?php echo $row['name'];     ?> </b>
          <br><?php echo $row['price'];      ?> </p>
          <input type="button" name="edit" value="Edit" id="<?php echo $row['id']; ?>" class="btn btn-info btn-xs edit_data" />
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
</div>
</div><!-- container end col-sm-7 -->
</div><!-- container end row -->
</div> <!-- container end -->



<!-- <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <div class="panel-body">
            <form action"" class = "form-horizontal">
              <div class="form-group">
              </div>
          </form>
      </div>  
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary">Save changes</button>
    </div>
  </div>
</div>
</div> -->


<div id="add_data_Modal" class="modal fade">  
  <div class="modal-dialog">  
   <div class="modal-content">  
    <div class="modal-header">  
     <button type="button" class="close" data-dismiss="modal">&times;</button>  
     <h4 class="modal-title">Update Product</h4>  
   </div>  

   <div class="modal-body">  


    <form action="ProductUpdateDetailsAndImage.php" method="post"  enctype="multipart/form-data">  
      <input type="hidden" name="product_id" id="product_id" >  


      <label>Product Name</label>  
      <input type="text" name="name" id="name" class="form-control" >  
      <br >  
      <label>Product Price</label>  
      <input type="text" name="price" id="price" class="form-control">
      <br >  
      <label>Select New Category</label>

      <br>
      <select name="category" id="category" class="form-control">
        <?php


        $query="SELECT * FROM category";
        $result=mysqli_query($db,$query);

        while($row = mysqli_fetch_array($result)){
          echo "<option value='".$row['id']."'>".$row['name']."</option>";
        }
        ?>

      </select>
      <br>
      <label>Update Supplier</label><br>
      <select name="supplier" id="supplier" class="form-control">
        <?php

        $query="SELECT * FROM supplier";
        $result=mysqli_query($db,$query);

        while($row = mysqli_fetch_array($result)){
          echo "<option value='".$row['id']."'>".$row['name']."</option>";
        }
        ?>
      </select>
      <br>
      <input type="submit" name="UpdateDetails" value="Update Datails" class="btn btn-success" />
      <br>
      <br>
      <br>


      Image: &nbsp; <input type="file" name="file" id="file">
      <input type="submit" name="ChangeImage" value="Change Image" class="btn btn-success" />  
    </form>
  </div>  
  <div class="modal-footer">  
   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
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

<script src="../assets/js/jquery-3.2.1.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>


<script>  
 $(document).ready(function(){  

/*  $('#add').click(function(){  
   $('#insert').val("Insert");  
   $('#insert_form')[0].reset();  
 });  
*/

  $(document).on('click', '.edit_data', function(){  
   var product_id = $(this).attr("id");  
   $.ajax({  
    url:"fetch.php",  
    method:"POST",  
    data:{product_id:product_id},  
    dataType:"json",  
    success:function(data){  
     $('#name').val(data.name);  
     $('#price').val(data.price);  
     $('#category').val(data.category);  
     $('#supplier').val(data.supplier);  


     $('#product_id').val(data.id);  
     $('#insert').val("Update");  
     $('#add_data_Modal').modal('show');  
   }  
 });  
 });  






});  
</script>

