<?php
session_start();
include 'database.php';
$conn = new \database\DB();
$conn->connect();
if (!isset($_SESSION['name'])) {
    header("Location: loginpage.php");
}

$user_id = $_SESSION['user'];
$sql = "SELECT * FROM pruducts WHERE user_id = " . $user_id;
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <link href='welcome.css' rel='stylesheet'>
    <style>
        table, th, td {
            border: 1px solid black
        }
    </style>
</head>
<body>
<table class="table data">
    <h1>Welcome to your personal account!</h1>
    <h2>Hello</h2>
    <h2><?php echo $_SESSION['name'] ?></h2>
    <h3>
        <?php if (isset($_SESSION['image'])): ?>
            <img width="auto" height="60px" src="<?= $_SESSION['image'] ?>">
        <?php endif; ?>
    </h3>
    <div><a href="logoutpage.php">Log out</a></div>
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Count</th>
        <th>Image</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($result

    as $y) {

    ?>
    <tr>
        <td class="data"><?php echo $y['name']; ?></td>
        <td class="data"><?php echo $y['description']; ?></td>
        <td class="data"><?php echo $y['price']; ?></td>
        <td class="data"><?php echo $y['count']; ?></td>
        <td class="data"><img height="40px" src=" <?php echo $y['image']; ?>"></td>
        <td>
            <form action="shop.php" method="get">
                <input type="hidden" name="product" value="<?=$y['id']?>">
                <button class="edit" type="submit"> Edit</button>
            </form>
            <form action="delete.php" method="post">
                <input type="hidden" name="product" value="<?= $y['id'] ?>">
                <button class="delete" type="submit"> Delete</button>
            </form>

        </td>
    </tr>
    </tbody>
    <?php
    }
    ?>
</table>
<h5>Add products</h5>
<h6>
    <div><a href="shop.php">If you want to create table</a></div>
</h6>
</body>
</html>
