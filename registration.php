<?php 
/*
	Author: Ahmed Ali | 101383139
	Purpose: validate registration and store to xml file. 
*/
header('Content-Type: text/xml');

if (isset($_GET["fname"]) && isset($_GET["lname"]) && isset($_GET["pwd"]) && isset($_GET["db_pwd"]) && isset($_GET["email"]) && isset($_GET["phone"]))
{
    $fname = $_GET["fname"];
    $lname = $_GET["lname"];
    $pwd = $_GET["pwd"];
    $db_pwd = $_GET["db_pwd"];
    $email = $_GET["email"];
    $phone = $_GET["phone"];

    $errMsg = "";

    if ($fname == "")
    {
        $errMsg = "You need to enter a name.<br/>";
       
    }

    if ($lname == "")
    {
        $errMsg = "You need to enter a last name.<br/>";
        
    }

    if ($pwd == "")
    {
        $errMsg = "Please enter a password.<br/>";

    }

    if ($db_pwd == "")
    {
        $errMsg = "Please re-type password.<br/>";
        
    }

    if ($email == "")
    {
        $errMsg = "Please enter an email.<br/>";
        
    }

    if (!empty($phone))
    {
        if(!preg_match("/^[0][1-9][ ][0-9]{8}$/", $phone) || !preg_match("/^[(][0][1-9][)][0-9]{8}$/", $phone))
        {
        
            $errMsg = "Invalid format for phone number. Use this example (00)12345678 or 00 12345678.<br/>";
        }

    }


    if (strcmp($pwd,$db_pwd) != 0 )
    {
        $errMsg = "Passwords dont match.<br/>";
  
    }

    if ($errMsg != "")
    {
        echo $errMsg;
    }

    else
    {
        // load xml

        $doc = new DOMDocument();

        $xml = '../../data/customers.xml';

        if (!file_exists($xml))
        {
            $customers = $doc->createElement("customers");
            $doc->appendChild($customers);
        }

        else
        {
            $doc->preserveWhiteSpace = FALSE; 
            $doc->load($xml);
              
        }

        $emailFound = null; // initalise

        $xmlFile = simplexml_load_file($xml);

        // for each loop to test if email is unique 

        foreach ($xmlFile->children() as $value)
        {
            if ($value->email== "$email")
            {
                $emailFound = true;

                break;
            }
        }


        if ($emailFound == true)
        {
        
        echo "Email is already registred.<br/>";
        
        }

        else
        {

        
            // customer node

        $customers = $doc->getElementsByTagName("customers")->item(0);
        $customer = $doc->createElement("customer");
        $customers->appendChild($customer);

        //id node

        $id = $doc->createElement("id");
        $customer->appendChild($id);
        $id_val = $doc->createTextNode(uniqid());
        $id->appendChild($id_val);


        //fname node

        $firstname = $doc->createElement("firstname");
        $customer->appendChild($firstname);
        $firstname_val = $doc->createTextNode($fname);
        $firstname->appendChild($firstname_val);

        //lname node

        $lastname = $doc->createElement("lastname");
        $customer->appendChild($lastname);
        $lastname_val = $doc->createTextNode($lname);
        $lastname->appendChild($lastname_val);

        //pw node

        $password = $doc->createElement("password");
        $customer->appendChild($password);
        $password_val = $doc->createTextNode($pwd);
        $password->appendChild($password_val);

        //email node

        $emailNode = $doc->createElement("email");
        $customer->appendChild($emailNode);
        $email_val = $doc->createTextNode($email);
        $emailNode->appendChild($email_val);

        //phone node

        $phoneNode = $doc->createElement("phone");
        $customer->appendChild($phoneNode);
        $phone_val = $doc->createTextNode($phone);
        $phoneNode->appendChild($phone_val);


        // save xml

        $doc->formatOutput = true;
        $doc->save($xml);

        echo "You are now registered <br />";

        echo "<strong>Name:</strong> $fname  $lname | <strong>Email:</strong> $email |  <strong>Phone:</strong>  $phone <br />"; 

        echo "<a href='login.html'>Back to Login</a><br />";

        }
    }
}
?>