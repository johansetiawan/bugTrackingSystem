<?php
if(!isset($_SESSION)) {
    // session isn't started
    session_start();
}
$connect = true;
$fileconf = "app/app.config";
if (file_exists($fileconf)) {
	$env = json_decode(file_get_contents($fileconf)); 
	$base= mysqli_connect($env->host, $env->root, $env->pass, $env->db);
}else{
    $connect = false;
}
 
if (mysqli_connect_errno()) {
	$connect = false;
}
 

if ($connect == false) { 
    header('location:mysql.php');
}
$url_root = 'http://localhost/myweb/';
$url_home = 'index.php';

$design = 'default';


if(isset($_GET['logout']) && ($_GET["logout"]== true)){
	session_unset ();
	session_destroy();
}
?>