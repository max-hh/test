<?php
require_once 'config.php';

if(!isLoggedin())
{
        include "login.php";

        if(!isLoggedin())
        {
                exit;
        }
}


?>