<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/6/2019
 * Time: 11:48 AM
 */
session_start();
require_once 'config.php';

$error = '';

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $salary = $_POST['salary'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];

    if (empty($name)) {
        $error = 'Name không được để trống';
    } else {
        $sqlInsert = "INSERT INTO employees(`name`,`description`,`gender`,`salary`,`birthday`) 
                      VALUES ('$name','$description',$gender,$salary,'$birthday')";
        $isInsert = mysqli_query($connection, $sqlInsert);

        if ($isInsert) {
            $_SESSION['success'] = 'Thêm mới nhân viên thành công';
            header('Location: index.php');
            exit();
        } else {
            echo '<script type="text/javascript">';
            echo 'alert(\'Thêm mới thất bại\');';
            echo '</script>';
        }
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
    <title>Create Record</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="js/jquery-3.4.1.min.js">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="form-insert">
        <form action="" method="post">
            <div class="content-form">
                <div class="title-form">
                    <h2 class="title">
                        Create Record
                    </h2>
                    <hr>
                    <p style="color: red;">
                        <?php echo $error; ?>
                    </p>
                </div>
                <div class="main-form">
                    <div class="form-group">
                        <label>Name <span>*</span></label>
                        <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>" id=""
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="" cols="30" rows="5"
                                  class="form-control"><?php echo isset($description) ? $description : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="text" name="salary" value="<?php echo isset($salary) ? $salary : ''; ?>" id=""
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <?php
                        $checkedMale = 'checked';
                        $checkedFemale = '';

                        if (isset($_POST['gender'])) {
                            switch ($_POST['gender']) {
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
                        <input type="radio" name="gender" value="0" id="" <?php echo $checkedMale; ?>> Male &nbsp;
                        <input type="radio" name="gender" value="1" id="" <?php echo $checkedFemale; ?>> Female
                    </div>
                    <div class="form-group">
                        <label>Birthday</label>
                        <input type="text" name="birthday" value="<?php echo isset($birthday) ? $birthday : ''; ?>"
                               id="" class="form-control">
                    </div>
                </div>
                <div class="submit">
                    <div class="form-group text-center">
                        <input type="submit" name="save" value="Save" class="btn btn-primary">
                        <a href="index.php" class="btn btn-outline-secondary">Cancel</a>
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