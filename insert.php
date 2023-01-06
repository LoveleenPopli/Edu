<?php
$connect = mysqli_connect("https://bom1plzcpnl493969.prod.bom1.secureserver.net:2083/cpsess6845302466/3rdparty", "root", "", "EduCredentials");
$form_data = json_decode(file_get_contents("php://input"));
$data = array();
$error = array();
 
if(empty($form_data->first_name))
{
    $error["first_name"] = "First Name is required";
}
 
if(empty($form_data->last_name))
{
    $error["last_name"] = "Last Name is required";
}
 
if(!empty($error))
{
    $data["error"] = $error;
}
else
{
    $first_name = mysqli_real_escape_string($connect, $form_data->first_name); 
    $last_name = mysqli_real_escape_string($connect, $form_data->last_name);
    $address = mysqli_real_escape_string($connect, $form_data->address);
    $query = "
      INSERT INTO members(firstname, lastname, address) VALUES ('$first_name', '$last_name', '$address')
    ";
    if(mysqli_query($connect, $query))
    {
      $data["message"] = "Data Inserted...";
    }
}
echo json_encode($data);
?>