<?php 
include('config.php');  

if (isset($_GET['num'])) {
    $idproduit = $_GET['num'];
    $data = "SELECT * FROM `bug_report` WHERE `bug_id` LIKE '".$idproduit."'";
    $dataproduit = $base->query($data)->fetch_array(MYSQLI_ASSOC);
    if (!empty($dataproduit)) {
        $base->query("DELETE FROM bug_report WHERE bug_id=".$idproduit."");
    } 
    header('Location: list_produit.php'); 
}else{
    header('Location: list_produit.php');
} 

?> 