<?php
include "../includes/db.php";
include "../includes/admin-auth.php";
$products = rows(q("SELECT p.*, c.name AS category FROM products p LEFT JOIN categories c ON p.category_id=c.id ORDER BY p.id DESC"));
include "../includes/header.php";
?>
<h2>Products</h2>
<p><a href="add-product.php">+ Add Product</a></p>
<table border="1" cellpadding="5">
    <tr><th>ID</th><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Actions</th></tr>
    <?php foreach ($products as $p) { ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?php if ($p['image']) { ?><img src="<?= e(imgUrl($p['image'])) ?>" width="60"><?php } ?></td>
        <td><?= e($p['name']) ?></td>
        <td><?= e($p['category']) ?></td>
        <td>₹<?= number_format($p['price'], 2) ?></td>
        <td><?= $p['stock'] ?></td>
        <td>
            <a href="edit-product.php?id=<?= $p['id'] ?>">Edit</a> |
            <a href="delete-product.php?id=<?= $p['id'] ?>" onclick="return confirmAction('Delete this product?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>
<?php include "../includes/footer.php"; ?>
