<?php 
/*
	Author: Ahmed Ali | 101383139
	Purpose: confirms purchase. Adds onhold values to the sold value. 
*/
session_start();



 $xmlFile = '../../data/goods.xml';
 $xslFile = '../../data/confirm.xsl';

 $doc = new DOMDocument();

 $doc->load($xmlFile);

 $xsl = new DOMDocument();
 $xsl->load($xslFile);

$proc = new XSLTProcessor();
$proc->importStyleSheet($xsl); 

echo $proc->transformToXML($doc);




 $xmlLoad = simplexml_load_file($xmlFile);


 foreach($xmlLoad->children() as $value)
 {
        if($value->onhold > 0)
        {

            $value->sold = $value->sold + $value->onhold; //Adds onhold values to the sold value. Sold = alreadysold + current onhold items. 
            
            $value->onhold = 0;   // set the on hold value to 0 for all items in the cart  
        }
 }

 file_put_contents($xmlFile,$xmlLoad->saveXML());
?>