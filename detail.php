<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/6/2019
 * Time: 11:48 AM
 */
session_start();
require_once 'config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        $_SESSION['error'] = "Cần phải truyền id là số";
        header('Location: index.php');
        exit();
    }
    $sqlSelect = "SELECT * FROM employees WHERE id = {$id}";
    $result = mysqli_query($connection, $sqlSelect);
    $employee = [];
    if (mysqli_num_rows($result) > 0) {
        $employeeArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $employee = $employeeArr[0];
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Record</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="js/jquery-3.4.1.min.js">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="form-view">
        <form action="" method="post">
            <div class="content-form">
                <div class="title-form">
                    <h2 class="title">
                        View Record
                    </h2>
                    <hr>
                </div>
                <div class="main-form">
                    <div class="form-group">
                        <label>ID <span>*</span></label>
                        <input type="text" name="id" value="<?php echo isset($employee['id']) ? $employee['id'] : ''; ?>" id="" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Name <span>*</span></label>
                        <input type="text" name="name" value="<?php echo isset($employee['name']) ? $employee['name'] : ''; ?>" id="" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="" cols="30" rows="5" class="form-control" disabled><?php echo isset($employee['description']) ? $employee['description'] : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="text" name="salary" value="<?php echo isset($employee['salary']) ? $employee['salary'] : ''; ?>" id="" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <?php
                        $checkedMale = 'checked';
                        $checkedFemale = '';

                        if (isset($employee['gender'])) {
                            switch ($employee['gender']) {
                                case 0:
                                    $checkedMale = 'checked';
                                    break;
                                case 1:
                                    $checkedFemale = 'checked';
                                    break;
                            }
                        }
                        ?>
                        <label>Gender</label> <br>
                        <input type="radio" name="gender" value="0" <?php echo $checkedMale; ?> id="" disabled> Male &nbsp;
                        <input type="radio" name="gender" value="1" <?php echo $checkedFemale; ?> id="" disabled> Female
                    </div>
                    <div class="form-group">
                        <label>Birthday</label>
                        <input type="text" name="birthday" value="<?php echo isset($employee['birthday']) ? $employee['birthday'] : ''; ?>" id="" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Created at</label>
                        <input type="text" name="created_at" value="<?php echo isset($employee['created_at']) ? $employee['created_at'] : ''; ?>" id="" class="form-control" disabled>
                    </div>
                </div>
                <div class="submit">
                    <div class="form-group text-center">
                        <a href="index.php" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!--    js file-->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>