
<?php
/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 10/23/2019
 * Time: 11:37 AM
 */
include($_SERVER['DOCUMENT_ROOT'].'/web/init.php');
session_start();

$id_request = $_GET['id'];
$sql_student = "SELECT * FROM `organization_requests` WHERE id=".$id_request;

$update = mysqli_query($conn, $sql_student);
$org_request = mysqli_fetch_assoc($update);
$_SESSION['org_request'] = $org_request;
//var_dump($_SESSION['org_request']['id']);

$sql_pr = "SELECT * FROM `organization` where id=".$org_request['organization_id'];
$update2 = mysqli_query($conn, $sql_pr);
$org_pr = mysqli_fetch_assoc($update2);
$_SESSION['org_pr'] = $org_pr;

$sql_dic = "SELECT * FROM `organization_request_abilities` WHERE organization_request_id = ".$id_request;
$update3 = mysqli_query($conn, $sql_dic);
$org_dic = mysqli_fetch_assoc($update3);
$_SESSION['org_dic'] = $org_pr;

//var_dump($sql_dic);die;

header("Location: SCR_1002E.php");
?>
