<?php 
/*
	Author: Ahmed Ali | 101383139
	Purpose: Removes all the sold items and removes an item if there is no stock.
*/
session_start();



 $xmlFile = '../../data/goods.xml';


 $xmlLoad = simplexml_load_file($xmlFile);


 foreach($xmlLoad->children() as $value)
 {
        if($value->sold > 0)
        {
            $value->sold = 0;

            echo "Item Number: ",$value->number," |", " Name: ", $value->name," has been processed! <br/>";
        }

            if ($value->qty == 0 && $value->onhold == 0 )
            {
                echo "Item Number: ",$value->number," |", " Name: ", $value->name," has been deleted! <br/>";
                $dom = dom_import_simplexml($value);
                $dom->parentNode->removeChild($dom);
            }
             
 }

 


 file_put_contents($xmlFile,$xmlLoad->saveXML());

?>