<?php
include "token.php";
include "controller.php";
$response=array();
$tokeni=new token();
$token="null";
if(isset($_POST["token"]))$token=$_POST["token"];
if(isset($_GET["token"]))$token=$_GET["token"];
$op=new controller($token);
if(isset($_POST['user']) and isset($_POST['pass'])){
    if($tokeni->vuser($_POST['user'],$_POST['pass'])){
        $response['status']="authorized";
        $tokeni->db->validateAndAddToken($_POST['user'],$tokeni->vuser($_POST['user'],$_POST['pass']));
        $response['token']=$tokeni->vuser($_POST['user'],$_POST['pass']);
        $response['response']="200";

    }
    else {
        $response['status']="unauthorized";
        $response['response']="401";
    }
}else if($token!="null"){
    if($tokeni->vtoken($token)){
        
        $operation="null";
        if(isset($_POST["operation"]))$operation=$_POST["operation"];
        if(isset($_GET["operation"]))$operation=$_GET["operation"];
        if($operation!="null"){
            $response=$op->do($operation);
        }


    }else {
        $response['status']="unauthorized";
        $response['response']="401";}


    }else {
    $response['status']="401";
    $response['connected']="unauthorized";
}

$j_response=json_encode($response);
echo $j_response;

?>