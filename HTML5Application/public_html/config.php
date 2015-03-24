<?php
include('connect.php');
session_start();
$user = "dbo569329942";
$password = "max1804";

function isLoggedin()
{
        return !empty($_SESSION['username']);
}

function buildHash($password)
{
        return crypt($password, '$2a$10$OurConstantSaltRules12$');
}

function tryLogin($username, $password)
{
        $password = buildHash($password);
        $mysqli = mysqli_connect("db569329942.db.1and1.com","dbo569329942", "max1804", "db569329942");


        $result = $mysqli->query("SELECT username
                                FROM `user`
                                WHERE `username` = '".mysqli_real_escape_string($mysqli, $username)."'
                                AND `password` = '".$password."'
                                LIMIT 1;");
        if(mysqli_num_rows($result)  > 0)
        {
                $_SESSION['username'] = $username;
                return true;
        }
        return false;
}

function register($firstname, $lastname, $username, $password)

{
$mysqli = mysqli_connect("db569329942.db.1and1.com","dbo569329942", "max1804", "db569329942");

         $sql_select =  $mysqli->query("SELECT username FROM user WHERE username='".$_POST["username"]."'");


        if (mysqli_num_rows ($sql_select) > 0)
            {
        }
        else
        {
         $hashedPassword = buildHash($password);

        $sql = "INSERT INTO `user`
                                (`firstname`, `lastname`, `username`, `password`)
                                VALUES ('$firstname', '$lastname', '$username', '".$hashedPassword."');";

        if (!mysqli_query($mysqli,$sql)) {
  die('Error: ' . mysqli_error($mysqli));
}

        return tryLogin($username, $password);
        }

}

function logout()
{
        session_destroy();
        session_start();
}