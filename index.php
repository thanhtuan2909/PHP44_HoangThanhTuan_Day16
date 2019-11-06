<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/6/2019
 * Time: 11:47 AM
 */
session_start();
require_once 'config.php';

$sqlSelect = "SELECT * FROM employees";
$results = mysqli_query($connection, $sqlSelect);
$employees = [];

if (mysqli_num_rows($results) > 0) {
    $employees = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bài 1</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="js/jquery-3.4.1.min.js">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="main-content">
        <div class="header">
            <div class="row">
                <div class="col-md-9 col-12">
                    <h2>Employees List</h2>
                </div>
                <div class="col-md-3 col-12 text-right">
                    <a href="insert.php" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add New Employee
                    </a>
                </div>
            </div>
        </div>
        <h6>
            <?php
            if (isset($_SESSION['success'])) {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['nodelete'])) {
                echo $_SESSION['nodelete'];
                unset($_SESSION['nodelete']);
            }
            ?>
        </h6>
        <div class="main">
            <table border="1" cellspacing="0" cellpadding="5">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Salary</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Created_at</th>
                    <th>Action</th>
                </tr>
                <?php if (empty($employees)): ?>
                    <tr>
                        <td colspan="2">Không có bản ghi nào</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?php echo $employee['id'] ?></td>
                            <td><?php echo $employee['name'] ?></td>
                            <td><?php echo $employee['description'] ?></td>
                            <td><?php echo $employee['salary'] ?></td>
                            <?php
                            $genderText = '';
                            switch ($employee['gender']) {
                                case 0:
                                    $genderText = 'Male';
                                    break;
                                case 1:
                                    $genderText = 'Female';
                                    break;
                            }
                            ?>
                            <td><?php echo $genderText ?></td>
                            <td><?php echo $employee['birthday'] ?></td>
                            <td><?php echo $employee['created_at'] ?></td>
                            <td>
                                <a href="detail.php?id=<?php echo $employee['id'] ?>"><i class="fas fa-eye"></i></a>&nbsp;&nbsp;
                                <a href="update.php?id=<?php echo $employee['id'] ?>"><i class="fas fa-pen"></i></a>&nbsp;&nbsp;
                                <a href="delete.php?id=<?php echo $employee['id'] ?>"
                                   onclick="return confirm('Are you sure delete?');"><i
                                            class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>

<!--    js file-->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
