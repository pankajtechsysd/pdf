<?php
include('admin/db.php');
$data = stripslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);
$name = $mydata['name'];
$email = $mydata['email'];
$msg = $mydata['msg'];

if(!empty($name) && !empty($email) && !empty($msg)){
    sleep(5);
    $res = mysqli_query($con, "insert into messages (name, email, message) 
    values ('$name', '$email', '$msg')");
    if($res){
        $response = ["msg"=>"Data uploaded", "check" => "success"];
        echo json_encode($response);
    }else{
        $response = ["msg" => "Failed to upload data", "check"=> "Failed"];
        echo json_encode($response);
    }
}
else{
    $response = ["msg"=>"No data found", "check" => "Failed"];
    echo json_encode($response);
}
?>