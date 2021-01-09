<?php
/*
	Author: Ahmed Ali | 101383139
	Purpose: validate listing items and store to goods xml file. 
*/
session_start();
header('Content-Type: text/xml');

if (isset($_GET["name"]) && isset($_GET["price"]) && isset($_GET["qty"]) && isset($_GET["desc"]))
{
    $itemName = $_GET["name"];
    $itemPrice = $_GET["price"];
    $qty = $_GET["qty"];
    $itemDesc = $_GET["desc"];
    $itemNum = rand(1,100);
}


$errMsg = "";

if ($itemName == "")
    {
        $errMsg = "You need to enter an Item Name.<br/>";
       
    }

    if ($itemPrice == "")
    {
        $errMsg = "You need to enter an Item Price.<br/>";
       
    }

    if ($qty == "")
    {
        $errMsg = "You need to enter a Quantity.<br/>";
       
    }


    if ($itemDesc== "")
    {
        $errMsg = "You need to enter a Description.<br/>";
       
    }


    if (!is_numeric($itemPrice))
    {
        $errMsg = "Item Price: Please enter an integer.<br/>";

    }

    if (!is_numeric($qty))
    {
        $errMsg = "QTY: Please enter an integer.<br/>";

    }



    if ($errMsg !="")
    {
        echo $errMsg;
    }

    else
    {
        // load xml

        $doc = new DOMDocument();

        $xml = '../../data/goods.xml';

        if (!file_exists($xml))
        {
            $items = $doc->createElement("items");
            $doc->appendChild($items);
        }

        else
        {
            $doc->preserveWhiteSpace = FALSE; 
            $doc->load($xml);

        }

        
            // item node

            $items = $doc->getElementsByTagName("items")->item(0);
            $item = $doc->createElement("item");
            $items->appendChild($item);

            //item number node

            $item_number = $doc->createElement("number");
            $item->appendChild($item_number);
            $item_number_val = $doc->createTextNode($itemNum);
            $item_number->appendChild($item_number_val);

            //name node

            $name = $doc->createElement("name");
            $item->appendChild($name);
            $name_val = $doc->createTextNode($itemName);
            $name->appendChild($name_val);


            //price node

            $price = $doc->createElement("price");
            $item->appendChild($price);
            $price_val = $doc->createTextNode($itemPrice);
            $price->appendChild($price_val);


             //qty node

             $item_qty = $doc->createElement("qty");
             $item->appendChild($item_qty);
             $item_qty_val = $doc->createTextNode($qty);
             $item_qty->appendChild($item_qty_val);

             
             //on-hold node

            $on_hold = $doc->createElement("onhold");
            $item->appendChild($on_hold);
            $on_hold_val = $doc->createTextNode(0);
            $on_hold->appendChild($on_hold_val);

            //sold node

            $sold = $doc->createElement("sold");
            $item->appendChild($sold);
            $sold_val = $doc->createTextNode(0);
            $sold->appendChild($sold_val);


            //description node

            $desc = $doc->createElement("description");
            $item->appendChild($desc);
            $desc_val = $doc->createTextNode($itemDesc);
            $desc->appendChild($desc_val);

            // save xml

            $doc->formatOutput = true;
            $doc->save($xml);

            echo "Item Successfully Listed! <br />";

            echo "<strong>Item no:</strong> $itemNum | <strong>Item Name:</strong> $itemName |  <strong>Price:</strong>  $itemPrice |  <strong>QTY:</strong>  $qty <br />"; 

    }
?>