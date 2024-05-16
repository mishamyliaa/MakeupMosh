<?php
  include_once 'products_crud.php';
  include_once 'session.php';
?>
 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  
  <title>Makeup Mosh Ordering System : Products</title>
  <!-- Bootstrap -->
  
  

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

  
<style>
  #order-table {
    overflow: auto;
  }

</style>
 


</head>
<body>
    <?php include_once 'nav_bar.php'; ?>
      <?php 
      if($level!="normal staff" ){ 
        ?>
      
 
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Product</h2>
      </div>

      <form action="products.php" method="post" class="form-horizontal">

        <div class="form-group">
          <label for="productid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
          <input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>" required>
          </div>
        </div>

        <div class="form-group">
          <label for="productname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
            <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>">
        </div>
        </div>

        <div class="form-group">
          <label for="productprice" class="col-sm-3 control-label">Price</label>
          <div class="col-sm-9">
            <input name="price" type="text" class="form-control" id="productprice" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>"required>
        </div>
        </div>

        <div class="form-group">
          <label for="producttype" class="col-sm-3 control-label">Type</label>
          <div class="col-sm-9">
            <select name="type" class="form-control" id="producttype" required>
              <option value="Face" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Face") echo "selected"; ?>>Face</option>
              <option value="Eyes" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Eyes") echo "selected"; ?>>Eyes</option>
              <option value="Lips" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Lips") echo "selected"; ?>>Lips</option>
      </select>
      </div>
      </div> 

        <div class="form-group">
          <label for="productbrand" class="col-sm-3 control-label">Brand</label>
          <div class="col-sm-9">
            <select name="brand" class="form-control" id="productbrand" required>
              <option value="Rare" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Rare") echo "selected"; ?>>Rare</option>
              <option value="Fenty" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Fenty") echo "selected"; ?>>Fenty</option>
              <option value="MAC" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="MAC") echo "selected"; ?>>MAC</option>
              <option value="Nars" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Nars") echo "selected"; ?>>Nars</option>
              <option value="Tarte" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Tarte") echo "selected"; ?>>Tarte</option>
          </select>
          </div>
        </div> 

         <div class="form-group">
          <label for="productstock" class="col-sm-3 control-label">Stock</label>
          <div class="col-sm-9">
          <input name="stock" type="text" class="form-control" id="productstock" placeholder="Product Stock" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_stock']; ?>"  min="0" required>
        </div>
        </div>

        <div class="form-group">
          <label for="productexpiration" class="col-sm-3 control-label">Expiration</label>
          <div class="col-sm-9">
          <input name="expiration" type="date" class="form-control" id="productexpiration" placeholder="Product Expiration" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_exp']; ?>"  min="0" required>
        </div>
        </div>
        
        <center>
          <?php if (isset($_GET['edit'])) { ?>
          <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
          <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
          <?php } else { ?>
            
          <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
          <?php } ?>
          <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
        </div>
      </div>
    </form>
    </div>
  </div>
    <?php
    }
    ?>

    <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Products List</h2>
      </div>
      <table id= 'example' class="table table-striped table-bordered">
      <thead>
        <tr style="font-weight:bold; background-color: #FFDAE0;">
        <th>Product ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Type</th>
        <th>Brand</th>
        <th>Stock</th>
        <th>Expiration Date</th>
        <th>Action</th>
    </thead>
    <tbody>
      <?php
      // Read
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("select * from tbl_products_a186913_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>   
      <tr>

        <td> <center><?php echo $readrow['fld_product_num']; ?></center></td>
        <td> <center><?php echo $readrow['fld_product_name']; ?></center></td>
        <td><center><?php echo $readrow['fld_product_price']; ?></center></td>
        <td><center><?php echo $readrow['fld_product_type']; ?></center></td>
        <td><center><?php echo $readrow['fld_product_brand']; ?></center></td>
        <td><center><?php echo $readrow['fld_product_stock']; ?></center></td>
        <td><center><?php echo $readrow['fld_product_exp']; ?></center></td>

         <td>
          <button data-href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-warning btn-xs btn-details" role="button" data-target="#myModal">Details</button>
          <?php if($level!="normal staff"){ ?>
          <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
          <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
        </td>
      </tr>
    
      <?php }
      }
      $conn = null;
      ?>
  </tbody>
    </table>
  </div>
  </div>

  <center>
  <button  class="btn btn-warning" style="padding: 10px 28px; background-color : #FFDAE0; color: #000000; font-family: Verdana, sans-serif; margin-top: 25px;" id="btnExport" onclick="ExportToExcel('.xlsx')">Export Data To Excel</button>

  <div class= 'bs-example'>

  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <center>
                <h3 class="modal-title">Product Details</h3>
              </center>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
      
<script>
  $(document).ready(function () {
      $('#example').DataTable({
        // functions for last task 
          "order": [[1, "asc"]], // Sort by the first column (Name) in ascending order
          lengthMenu: [
              [5, 10, 20, 30, -1],
              [5, 10, 20, 30, 'All'],
          ],
          "columnDefs": [{
                      "targets": 2, // Exclude the second column (Price) from the searching function
                      "searchable": false,
                  }],
                   
      });
  });
  </script>

<script>

function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('example');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Makeup Mosh Products' + (type || 'xlsx')));
    }
</script>

<script>
  $(document).on("click", ".btn-details", function() {
    
     var dataURL = $(this).attr( "data-href" );
     $('.modal-body').load(dataURL,function(){
      $('#myModal').modal({

        show:true,
        backdrop: 'static', 
        keyboard: false
      });
      $('#myModal').on('hidden.bs.modal', function () {
      });
    });
   });
</script>




<style>
  .bs-example{
    margin: 20px;
  }
 </style>

</body>
</html>