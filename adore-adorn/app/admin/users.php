<?php
include "../includes/db.php";
include "../includes/admin-auth.php";
$users = rows(q("SELECT * FROM users ORDER BY id DESC"));
include "../includes/header.php";
?>
<h2>Users</h2>
<table border="1" cellpadding="5">
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Registered</th></tr>
    <?php foreach ($users as $u) { ?>
    <tr>
        <td><?= $u['id'] ?></td>
        <td><?= e($u['name']) ?></td>
        <td><?= e($u['email']) ?></td>
        <td><?= e($u['phone']) ?></td>
        <td><?= e($u['address']) ?></td>
        <td><?= $u['created_at'] ?></td>
    </tr>
    <?php } ?>
</table>
<?php include "../includes/footer.php"; ?>
