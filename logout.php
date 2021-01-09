<?php
/*
	Author: Ahmed Ali | 101383139
	Purpose: log admin out. 
*/
session_start();

if (isset($_SESSION["manager"]))
{
    $id = $_SESSION["manager"];


    echo "Thank you ".$id;

    session_destroy(); 

    echo " You are now logged out!<br />";


}
?>