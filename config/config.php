<?php
// Set database info
$config = array(
    "dbhost" => 'localhost',
    "dbusername"=>'testuser',
    "dbuserpass"=>'testpass',
    "dbname"=>'dbtest',
    "genrowcount"=>200,#15;
    "gentablename"=>"product",
    "colnames" => array(
        "itemid", "name","producer", "type",
        "color", "price", "discount", "regdate"),
    "rowsperpage"=>10
);

// to hide notice from date functions
date_default_timezone_set("Europe/Moscow");
?>
