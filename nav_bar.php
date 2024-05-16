<?php
include_once 'session.php';
?>

<nav class="navbar navbar-default" style = "background-color : #FFDAE0; font-family: Verdana, sans-serif;" >
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Makeup Mosh</a>
    </div>
 
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
    
      <li><a href="products.php">Products</a></li>
        
      <li><a href="customers.php">Customers</a></li>
      <?php if ($level != "normal staff") { ?>
        <li><a href="staffs.php">Staffs</a></li>
    <?php } else { ?>
        <li class = "disabled"><a href="#" onclick="alert('Error : Access Denied');">Staffs</a></li>
    <?php } ?>
    <li><a href="orders.php">Orders</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
      
      <li>
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>  <?php echo $name; ?> (<?php echo $level; ?>)</a>
        <ul class="dropdown-menu">
           <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>   Logout</a></li>
        </ul>
      </li>
      
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>