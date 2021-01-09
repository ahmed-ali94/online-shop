<?php 
/*
	Author: Ahmed Ali | 101383139
	Purpose: validate customer login. 
*/

if (isset($_GET["email"]) && isset($_GET["pwd"]))
{
    $email = $_GET["email"];
    $pwd= $_GET["pwd"];
}

$errMsg = "";

if ($email== "")
{
    $errMsg = "Please enter your Email<br />";
}

if ($pwd == "")
{
    $errMsg = "Please enter your password<br />";
}

if ($errMsg != "")
{

    echo $errMsg;

}

else
{
    $xml = '../../data/customers.xml';

    $loggedin = false;

    if (!file_exists($xml))
    {
        echo "Customers xml does not exist";
    }

    else
    {
        $xmlLoad = simplexml_load_file($xml);


        foreach($xmlLoad->children() as $value)
        {
            if ($value->email == $email && $value->password == $pwd)
            {
                session_start(); // create a new session for the customer

                $_SESSION["customer"] = $email;
    
                $loggedin = true;
    
                echo "200"; // ive chosen this number as a check to confirm login and pass it to JS which will perform a redirect once this value has been recieved;
    
                break;
            }
        }


        if (!$loggedin)
        {
            echo "Wrong Email or Password<br/>";
        }
    }
}
?>