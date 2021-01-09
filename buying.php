<?php
/*
	Author: Ahmed Ali | 101383139
	Purpose: loads all the tems and displays them in a table. 
*/
session_start();

if (isset($_SESSION["customer"]))
{

$xml = '../../data/goods.xml';

$xmlLoad = simplexml_load_file($xml);

echo  "<table>\n"
    ."<thead>\n"
    . "<tr>\n"
    ."<th scope=\"col\">Item Number</th>\n"
    ."<th scope=\"col\">Name</th>\n"
    ."<th scope=\"col\">Description</th>\n"
    ."<th scope=\"col\">Price</th>\n"
    ."<th scope=\"col\">QTY</th>\n"
    ."<th scope=\"col\">Add</th>\n"
    ."</tr>\n"
    ."</thead>";

    foreach ($xmlLoad->children() as $value)
    {
        echo "<tr>\n"
        ."<td>", $value->number, "</td>\n"
        ."<td>", $value->name, "</td>\n"
        ."<td>", $value->description, "</td>\n"
        ."<td>", "$", $value->price, "</td>\n"
        ."<td>", $value->qty, "</td>\n"
        ."<td>", "<input type='button' value='Add' onclick='addCart($value->number,$value->qty)'> ", "</td>\n"
        ."</tr>";
    }

    echo "</table>";

}
    
else
{

echo false; // if no user is logged in send false to JS to redirect them to log in

}
?>