<?php
/*
	Author: Ahmed Ali | 101383139
	Purpose: loads all the items and displays them in a table for processing. 
*/
session_start();

if (isset($_SESSION["manager"]))
{

$xmlFile = '../../data/goods.xml';
$xslFile = '../../data/processing.xsl';
   
$doc = new DOMDocument();
   
$doc->load($xmlFile);
   
$xsl = new DOMDocument();
$xsl->load($xslFile);
   
$proc = new XSLTProcessor();
$proc->importStyleSheet($xsl); 
   
 echo $proc->transformToXML($doc);



}
    
else
{

echo false; // if no user is logged in send false to JS to redirect them to log in

}
?>