<?php 
/*
	Author: Ahmed Ali | 101383139
	Purpose: Removes the item from the cart. 
*/
session_start();



 $xml = '../../data/goods.xml';


 $xmlLoad = simplexml_load_file($xml);


 foreach($xmlLoad->children() as $value)
 {
        if($value->onhold > 0)
        {
            
            $value->qty = $value->qty + $value->onhold;
            $value->onhold = 0;   // set the on hold value to 0 for all items in the cart  
        }
 }

 file_put_contents($xml,$xmlLoad->saveXML());

 $xmlLoad = simplexml_load_file($xml);    /// now we show the updated cart


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


    foreach ($xmlLoad->children() as $value) // loop thoruhg the xml to find all the onhold values to show the updated cart
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


    echo "You have cancelled your purchase. See you next time!";

?>