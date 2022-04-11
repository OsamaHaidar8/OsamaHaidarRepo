<?php

//mysql
//mysqli
//pdo

$dns="mysql:host=localhost;dbname=learnwebsite;";
$user="root";
$pass="";
$options=array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try
{
   $con= new PDO($dns,$user,$pass,$options);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}






?>