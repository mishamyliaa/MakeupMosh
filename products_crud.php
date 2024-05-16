<?php
include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create
if (isset($_POST['create'])) {

    try {

        $stmt = $conn->prepare("INSERT INTO tbl_products_a186913_pt2(fld_product_num,
        fld_product_name, fld_product_price, fld_product_type, fld_product_brand,
        fld_product_stock, fld_product_exp) VALUES(:pid, :name, :price, :type, :brand, :stock, :expiration)");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
        $stmt->bindParam(':expiration', $expiration, PDO::PARAM_STR); // Assuming exp is a date field

        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $brand = $_POST['brand'];
        $stock = $_POST['stock'];
        $expiration = $_POST['expiration'];

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Update
if (isset($_POST['update'])) {

    try {

        $stmt = $conn->prepare("UPDATE tbl_products_a186913_pt2 SET fld_product_num = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_product_type = :type, fld_product_brand = :brand,
        fld_product_stock = :stock, fld_product_exp = :expiration WHERE fld_product_num = :oldpid");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
        $stmt->bindParam(':expiration', $expiration, PDO::PARAM_STR);
        $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);

        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $brand = $_POST['brand'];
        $stock = $_POST['stock'];
        $expiration = $_POST['expiration'];
        $oldpid = $_POST['oldpid'];

        $stmt->execute();

        header("Location: products.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Delete
if (isset($_GET['delete'])) {

    try {

        $stmt = $conn->prepare("DELETE FROM tbl_products_a186913_pt2 WHERE fld_product_num = :pid");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);

        $pid = $_GET['delete'];

        $stmt->execute();

        header("Location: products.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Edit
if (isset($_GET['edit'])) {

    try {

        $stmt = $conn->prepare("SELECT * FROM tbl_products_a186913_pt2 WHERE fld_product_num = :pid");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);

        $pid = $_GET['edit'];

        $stmt->execute();

        $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>
