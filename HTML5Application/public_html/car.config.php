<?php
include('connect.php');
error_reporting(E_ALL^E_NOTICE);
session_start();
$user = "dbo569329942";
$password = "max1804";

function isLoggedin()
{
        return !empty($_SESSION['user']);
}

function buildHash($password)
{
        return crypt($password, '$2a$10$OurConstantSaltRules12$');
}

function tryLogin($user, $password)
{
        $password = buildHash($password);
        $mysqli = mysqli_connect("db569329942.db.1and1.com","dbo569329942", "max1804", "db569329942");


        $result = $mysqli->query("SELECT user
                                FROM `carrier`
                                WHERE `user` = '".mysqli_real_escape_string($mysqli, $user)."'
                                AND `password` = '".$password."'
                                LIMIT 1;");
        if(mysqli_num_rows($result)  > 0)
        {
                $_SESSION['user'] = $user;
                return true;
        }
        return false;
}

function register($firstname, $lastname, $kkarte, $cvv, $monthdate, $yeardate, $user, $password)

{
$mysqli = mysqli_connect("db569329942.db.1and1.com","dbo569329942", "max1804", "db569329942");

         $sql_select =  $mysqli->query("SELECT user FROM carrier WHERE user='".$_POST["user"]."'");


        if (mysqli_num_rows ($sql_select) > 0)
            {
        }
        else
        {
         $hashedPassword = buildHash($password);

        $sql = "INSERT INTO `carrier`
                                (`firstname`, `lastname`, `kkarte`, `cvv`, `monthdate`, `yeardate`, `user`, `password`)
                                VALUES ('$firstname', '$lastname', '$kkarte', '$cvv', '$monthdate', '$yeardate', '$user', '".$hashedPassword."');";

        if (!mysqli_query($mysqli,$sql)) {
  die('Error: ' . mysqli_error($mysqli));
}

        return tryLogin($user, $password);
        }

}

function logout()
{
        session_destroy();
        session_start();
}