<?php
include "../includes/db.php";
include "../includes/admin-auth.php";
$products = one("SELECT COUNT(*) AS c FROM products")['c'];
$orders = one("SELECT COUNT(*) AS c FROM orders")['c'];
$users = one("SELECT COUNT(*) AS c FROM users")['c'];
$sales = one("SELECT COALESCE(SUM(total),0) AS s FROM orders WHERE status != 'Cancelled'")['s'];
include "../includes/header.php";
?>
<h2>Admin Dashboard</h2>
<ul>
    <li>Products: <?= $products ?></li>
    <li>Orders: <?= $orders ?></li>
    <li>Users: <?= $users ?></li>
    <li>Total sales: ₹<?= number_format($sales, 2) ?></li>
</ul>
<?php include "../includes/footer.php"; ?>
