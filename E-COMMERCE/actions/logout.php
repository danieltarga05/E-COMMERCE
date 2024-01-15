<?php

require_once '../models/User.php';
require_once '../models/Session.php';


session_start();

$user = $_SESSION['current_user'];


if ($user)
{
    $session_obj= $_SESSION['object_session'];
    $session_obj->Delete();
    $_SESSION['current_user'] = null;
    $_SESSION['obj_session'] = null;
    header('location:localhost/E-COMMERCE/views/login.php');
    exit;
}