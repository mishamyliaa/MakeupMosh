<?php 
  include_once 'products_crud.php';
  include_once 'database.php';
  include_once 'session.php';
 

  if (isset($_POST["submit"])){
    if (!empty($_POST["search"])){
        $query = str_replace(" ","+",$_POST["search"]);
        header("location:catalogue.php?search=".$query);
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Products: Catalogue</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    </style>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
   <!--  for modal popup -->
 
</head>
<body>
    <?php include_once 'nav_bar.php'; ?>
   
    <div class="container-fluid">
    <div class="col-md-12">
        <div class="card col-md-offset-1" >
            <div class="page-header text-center"><h1 >Search Our Product</h1></div>
                    <form class="" action="catalogue.php" method="get">
                    <div class="row">
                      <div class="col-sm-10">

                      		<center>
                          <input id="search" class="border-info form-control form-control-lg rounded-0" type="text" name="search" value="<?php if (isset($_GET["search"])) echo $_GET["search"]; ?>" required placeholder="Search Any Keyword (Name/Type/Price)" style="width:100%; height: 50px;">
                          </center>
                          </div>
                          <div>

                        <input type="submit" name="submit" value="Search" class="btn btn-info btn-lg rounded-0" style="width: 13.5%; height: 13.5%">
                       
                    </div>
                </form>
            </div>
           
            <br><br><br><br>




         <div class="row">
            <?php
            $per_page = 9;
            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            }else{
                $page = 1;
            }
            $start_from = ($page-1)*$per_page;

            try{
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM tbl_products_a177409_pt2 LIMIT $start_from,$per_page");
                 

                 if (isset($_GET["search"])) {
                    $sql_query = "SELECT * FROM tbl_products_a177409_pt2 WHERE CONCAT(`fld_product_name`, `fld_product_type`, `fld_product_price` ) LIKE '%".$_GET["search"]."%'";
                    
                    $stmt=$conn->prepare($sql_query);
                 } 
                 $stmt->execute();
                 $result = $stmt->fetchAll();

            }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            foreach($result as $readrow) {
            ?>

            <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="card" style="width: 400px; background-color:#C8DDE9; position: relative;" >
              <br><br><center>
             <img class="card-img-top img-responsive" src="products/<?php echo $readrow['fld_product_image'] ?>" alt="Card image cap" width="60%" height="60%" style="height: 200px;"></center><br><br>
              <div class="card-body" style="height:100px;">
             <h4><center><a style="pointer-events: none;" href="products_details.php?pid=<?php echo $readrow['fld_product_name']; ?>"?> <?php echo $readrow['fld_product_name']; ?></a></center></h4>    
                                        <center>
                          <br><br>                 
                        <a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-primary btn-block"  style="vertical-align: bottom;position: absolute; bottom: 10px; right: 10px; width: 95%; background-color: #04324A; box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.2"> View Product </a></center><br><br>
             </div>
              </div>
              <br>
            </div>
            <?php
                }
                $conn = null;
                ?>
         </div>



         <center>
          <br><br><br>
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination"  style="box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.2);">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a177409_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="catalogue.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"catalogue.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="catalogue.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
    </div>
    <br><br>

</center>

    </html>