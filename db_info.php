<?php
// Set database info
$dbhost='localhost:3311';
$dbusername='root';
$dbuserpass='root';
$dbname='dbtest';
$genrowcount=1000;//15;
$gentablename="product";
$colnames = array("itemid", "name", "producer", "type", "color", "price", "discount", "regdate");
$rowsperpage = 10;

// to hide notice from date functions
date_default_timezone_set("Europe/Moscow");
?>