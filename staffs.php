<?php
  include_once 'staffs_crud.php';
  include_once 'session.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Makeup Mosh Ordering System : Staffs</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

  <?php include_once 'nav_bar.php'; ?>
  <?php if($level === "admin" || $level === "supervisor"): ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
          <div class="page-header">
            <h2>Create New Staff</h2>
          </div>
          <form action="staffs.php" method="post" class="form-horizontal">
            <!-- Your form fields go here -->
            <div class="form-group">
              <label for="staffid" class="col-sm-3 control-label">ID</label>
              <div class="col-sm-9">
                <input name="sid" type="text" class="form-control" id="staffid" placeholder="Staff ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_num']; ?>" required>
              </div>
            </div>
            <!-- ... Other form fields ... -->
            <div class="form-group">
          <label for="staffname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
          <input name="name" type="text" class="form-control" id="staffname" placeholder="Staff Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_name']; ?>" required>
        </div>
        </div>
        <div class="form-group">
          <label for="staffdepartment" class="col-sm-3 control-label">Department</label>
          <div class="col-sm-9">
          <select name="department" class="form-control" id="staffdepartment" required>
            <option value="">Please select</option>
            <option value="Executive" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_department']=="Executive") echo "selected"; ?>>Executive</option>
            <option value="Logistics" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_department']=="Logistics") echo "selected"; ?>>Logistics</option>
            <option value="Sales" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_department']=="Sales") echo "selected"; ?>>Sales</option>
          </select>
        </div>
        </div>  
        <div class="form-group">
          <label for="staffphone" class="col-sm-3 control-label">Phone Number</label>
          <div class="col-sm-9">
          <input name="phone" type="text" class="form-control" id="staffphone" placeholder="Staff Phone" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phone']; ?>" required>
        </div>
        </div>
      <div class="form-group">
          <label for="staffemail" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-9">
          <input name="email" type="text" class="form-control" id="staffemail" placeholder="Staff Email" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>" required>
        </div>
        </div>
        <div class="form-group">
          <label for="level" class="col-sm-3 control-label">Staff Level</label>
          <div class="col-sm-9">
            <select name="level" class="form-control" id="level" required="">
              <option value="">Please Select</option>
              <option value="admin" <?php if(isset($_GET['edit'])) if($editrow['fld_user_level']=="admin") echo "selected"; ?>>Admin</option>
              <option value="normal staff" <?php if(isset($_GET['edit'])) if($editrow['fld_user_level']=="normal staff") echo "selected"; ?>>Normal Staff</option>
              <option value="supervisor" <?php if(isset($_GET['edit'])) if($editrow['fld_user_level']=="supervisor") echo "selected"; ?>>Supervisor</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-9">
            <input type="password" name="pass" class="form-control" id="password" placeholder="Password" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_password']; ?>" required>
          </div>
        </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                <?php if (isset($_GET['edit'])): ?>
                  <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_num']; ?>">
                  <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
                <?php else: ?>
                  <button class="btn btn-default" type="submit" name="create" <?php echo ($level == "supervisor") ? 'disabled ' : ''; ?>><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
                <?php endif; ?>
                <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          <div class="page-header">
            <h2>Staffs List</h2>
          </div>
          <table class="table table-striped table-bordered">
            <!-- Table headers -->
            <tr>
              <tr style="font-weight:bold; background-color: #FFDAE0;">
              <th>Staff ID</th>
              <th>Name</th>
              <th>Department</th>
              <th>Phone Number</th>
              <th>Email</th>
              <th>Staff Level</th>
              <?php if($level === "admin"): ?>
                <th>Action</th>
              <?php endif; ?>
            </tr>

            <?php
            // Read
            $per_page = 5;
            if (isset($_GET["page"]))
              $page = $_GET["page"];
            else
              $page = 1;
            $start_from = ($page - 1) * $per_page;
            try {
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a186913_pt2 LIMIT $start_from, $per_page");
              $stmt->execute();
              $result = $stmt->fetchAll();
            } catch(PDOException $e) {
              echo "Error: " . $e->getMessage();
            }
            foreach($result as $readrow) {
            ?>
              <!-- Table rows -->
              <tr>
                <td><?php echo $readrow['fld_staff_num']; ?></td>
                <td><?php echo $readrow['fld_staff_name']; ?></td>
                <td><?php echo $readrow['fld_staff_department']; ?></td>
                <td><?php echo $readrow['fld_staff_phone']; ?></td>
                <td><?php echo $readrow['fld_staff_email']; ?></td>
                <td><?php echo $readrow['fld_user_level']; ?></td>
                
                  <td>
                    <a href="staffs.php?edit=<?php echo $readrow['fld_staff_num']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
                    <?php if($level === "admin" ): ?>
                    <a href="staffs.php?delete=<?php echo $readrow['fld_staff_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
                  </td>
                <?php endif; ?>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <?php if($level === "admin"): ?>
      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          <nav>
            <ul class="pagination">
              <?php
              try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a186913_pt2");
                $stmt->execute();
                $result = $stmt->fetchAll();
                $total_records = count($result);
              } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
              }
              $total_pages = ceil($total_records / $per_page);
              ?>
              <?php if ($page == 1) { ?>
                <li class="disabled"><span aria-hidden="true">«</span></li>
              <?php } else { ?>
                <li><a href="staffs.php?page=<?php echo $page - 1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
              <?php } ?>
              <?php
              for ($i = 1; $i <= $total_pages; $i++)
                if ($i == $page)
                  echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
                else
                  echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
              ?>
              <?php if ($page == $total_pages) { ?>
                <li class="disabled"><span aria-hidden="true">»</span></li>
              <?php } else { ?>
                <li><a href="staffs.php?page=<?php echo $page + 1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
              <?php } ?>
            </ul>
          </nav>
        </div>
      </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

</body>
</html>
