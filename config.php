<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/6/2019
 * Time: 12:13 PM
 */

CONST DB_HOST = 'localhost';
CONST DB_USERNAME = 'root';
CONST DB_PASSWORD = '';
CONST DB_NAME = 'bt1';
CONST DB_PORT = 3306;

$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD,DB_NAME,DB_PORT);
if (!$connection){
    die("Connect failed!!!" . mysqli_connect_error());
}

mysqli_set_charset($connection, "utf8");