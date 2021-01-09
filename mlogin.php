<?php 
/*
	Author: Ahmed Ali | 101383139
	Purpose: validate manager login. 
*/

if (isset($_GET["id"]) && isset($_GET["pwd"]))
{
    $id = $_GET["id"];
    $pwd= $_GET["pwd"];
}

$errMsg = "";

if ($id == "")
{
    $errMsg = "Please enter your id number<br />";
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


    $fileLoc= '../../data/manager.txt';

    $file = file_get_contents($fileLoc);

    $line = explode("\n", $file);

    $loggedin = false;


    

    foreach($line as $aLine)// loops through the file to find to separate the string to a variable
    {
    
        
        $idLine = substr($aLine,0,strpos($aLine,","));
        $trimId = trim($idLine);

        $pwdLine = substr($aLine,strpos($aLine,",")+2,strpos($aLine,"\n")-3);
        $trimPwd = trim($pwdLine);
        

        if ($id == $trimId && $pwd == $trimPwd)
        {
            
            session_start(); // create a new session

            $_SESSION["manager"] = $id;

            $loggedin = true;

            echo "200";  // ive chosen this number as a check to confirm login and pass it to JS which will perform a redirect once this value has been recieved;

            break;
        }

            
        }
          

        if ($loggedin != true)
        {
            echo "No match found for the ID & PW!<br />";
        }


    }


?>