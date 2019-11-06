<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/6/2019
 * Time: 11:49 AM
 */
session_start();
require_once 'config.php';
if (isset($_GET['id'])){
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        $_SESSION['error'] = "Cần phải truyền id là số";
        header('Location: index.php');
        exit();
    }
    $sqlDelete = "DELETE FROM employees WHERE id = {$id}";
    $isDelete = mysqli_query($connection, $sqlDelete);
    if ($isDelete){
        $_SESSION['success'] = 'Xóa nhân viên thành công';
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['nodelete'] = "Xóa không thành công";
        header('Location: index.php');
        exit();
    }
}

?>