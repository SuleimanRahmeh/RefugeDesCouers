<?php
$dns="mysql:dbname=projetx;host=localhost";
try{
    $connexion=new PDO($dns,"root","");
}
catch(PDOExeption $e){
    printf("echec de connexion, veuillez reessayer" , $e->getMessage());
    exit();
}
?>