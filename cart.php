<?php 
/*
	Author: Ahmed Ali | 101383139
	Purpose: Adds items to the cart. 
*/

session_start();


if (isset($_GET["id"]))
{
    $itemID = $_GET["id"];
}

$xml = '../../data/goods.xml';




$xmlLoad = simplexml_load_file($xml);

foreach ($xmlLoad->children() as $val)
{
    if ($val->number == $itemID)
    {
        if ($val->qty > 0)
        {

        
        $val->qty = $val->qty - 1; // remove 1 from qty
        $val->onhold = $val->onhold + 1; // add 1 to on hold

        }

    }
}

file_put_contents($xml,$xmlLoad->saveXML()); // save the edited xml;



$xmlLoad = simplexml_load_file($xml);

$cartTotal = 0;


echo  "<table>\n"
    ."<thead>\n"
    . "<tr>\n"
    ."<th scope=\"col\">Item Number</th>\n"
    ."<th scope=\"col\">Price</th>\n"
    ."<th scope=\"col\">QTY</th>\n"
    ."<th scope=\"col\">Remove</th>\n"
    ."</tr>\n"
    ."</thead>";


    foreach ($xmlLoad->children() as $value) // loop thoruhg the xml to find all the onhold values
    {
        if ($value->onhold > 0)
        {
            echo "<tr>\n"
        ."<td>", $value->number, "</td>\n"
        ."<td>", "$",$value->price, "</td>\n"
        ."<td>", $value->onhold, "</td>\n"
        ."<td>", "<input type='button' value='Remove' onclick='removeItem($value->number)'>", "</td>\n"
        ."</tr>";

        $cartTotal = $cartTotal  + ($value->price * $value->onhold );
        }
    }

    echo "<tr>\n"
        ."<td>","<strong>Total:</strong> ","$", $cartTotal, "</td>\n"
        ."<td>","<input type='button' value='Confirm Purchase' onclick='confirmPurchase()'>","<input type='button' value='Cancel Purchase' onclick='cancel()'>" ,"</td>\n"
        ."</tr>\n"
        ."</table>";

?>