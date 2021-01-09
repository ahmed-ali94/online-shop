<?php
/*
	Author: Ahmed Ali | 101383139
	Purpose: log customer out. 
*/
session_start();

if (isset($_SESSION["customer"]))
{
    $id = $_SESSION["customer"];

$xml = '../../data/goods.xml';


 $xmlLoad = simplexml_load_file($xml);


 foreach($xmlLoad->children() as $value) /// clears the customers cart
 {
        if($value->onhold > 0)
        {
            
            $value->qty = $value->qty + $value->onhold;
            $value->onhold = 0;   // set the on hold value to 0 for all items in the cart  
        }
 }

 file_put_contents($xml,$xmlLoad->saveXML());


    echo "Thank you " ,$id, " for using our service. See you next time!";

    session_destroy();



    echo " You are now logged out!<br />";


}

else
{
    echo false;   // if no user is logged in send false to JS to redirect them to log in
}
?>