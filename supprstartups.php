<?php

use function PHPSTORM_META\elementType;
use function PHPSTORM_META\type;

require 'conx.php';
if(isset($_GET['editor']) AND !empty($_GET['editor'])){
    $mode = $_GET['editor'];
    echo $mode."<br/>";
    $edit_mode = false;
    if ($mode == 1) {
        $edit_mode = true;
        echo $edit_mode."<br/>";
    } else if($mode == 2) {
        $edit_mode = false;
        echo $edit_mode;
        $quest = 'DELETE FROM listestartups WHERE id = ?';
        $res = $bdd->prepare($quest);
        $id = $_GET['id'];
        $res->bind_param("i", $id);
        if($res->execute()){
            echo 'startup deleted successfully !';
            header("Location: index.php?page=listestartup");
        } else {
            echo 'error'.$res->error_get_last();
        }
    } else {
        ;
    }
}
else{
    echo 'invalid mode';
}
