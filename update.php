<?php

//THIS FILE IS FOR PART-III:- https://youtu.be/nuKaN6A5pkA

//Your server name, it will be same for all 000webhost accounts
$servername = "localhost";

//Your DB username
$username = "8dh3A9nVCE";

//Your DB password
$password = "8iP0UgXG9X";

//Your DB name, required if you have two DB and want to connect to a specific one
$dbname = "8dh3A9nVCE";

//Connect to MySQL
$mysql = mysqli_connect($servername, $username, $password, $dbname);

//Check connection

if($mysql->connect_error){
echo "Connection failed: ". $mysql->connect_error;
} else {
echo "Connected successfully\n";
}



$user_name = "";
$name = "";
$email = "";

//Here you will send the type which you want to do first, like, we should first check that the data we have to update is present in DB or not and then we have to update it
$type = $_POST["type"];

//getData type will check that the data is present or not
if($type == "getData"){
    getData($mysql);
    
    //updateData type will update/change the data with the entered data
} else if($type == "updateData"){
    updateData($mysql);
}

//This will check if the data is present in DB or not
function getData($mysql){

if(empty($_POST["username"]) || empty($_POST["name"]) ||  empty($_POST["email"])){

echo "Your firstname or lastname or email seems to be empty, please fill all the details.\n";


} else {

//This will contain firstname which will be sended by the API with a key forstname
$user_name = $_POST["username"];

//This will contain lastname, received from API with key as lastname
$name = $_POST["name"];

//This will contain email, where key is email
$email = $_POST["email"];

$check1 = $mysql->query("SELECT 1 FROM users WHERE username = '$user_name' LIMIT 1");
$check2 = $mysql->query("SELECT 1 FROM users WHERE name = '$name' LIMIT 1");
$check3 = $mysql->query("SELECT 1 FROM users WHERE email = '$email' LIMIT 1");

if($check1->fetch_row() && $check2->fetch_row() && $check3->fetch_row()){

$data = "SELECT * FROM users WHERE email ='". $email."'";
    $result = $mysql->query($data);

if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc(); 
    
    //Here your data will be checked that if it is present in DB or not.
        if($user_name == $row["username"] && $name == $row["name"] && $email == $row["email"]){
        
        //If it is present the. u will be given access to update it with a id associated with it
            echo "update accessed id=".$row["id"]."\n";
        } else {
            echo "update denied id=null\n";
        }
} else {
    echo "0 results";
}
} else {
echo "data null\n";
}
}
}

//Here your data will be updated/changed with your entered data
function updateData($mysql){
    $id = "";
    $user_name = "";
    $name = "";
    if(empty($_POST["username"]) || empty($_POST["name"])){

echo "Your firstname or lastname seems to be empty, please fill all the details.<br>";

} else {
    $id = $_POST["id"];
    $user_name = $_POST["username"];
    $name = $_POST["name"];
    
    //This command will updated your data
    $update = "UPDATE users SET username='$user_name', name='$name' WHERE id='$id'";

if ($mysql->query($update) === TRUE) {
  echo "Record updated successfully<br>";
} else {
  echo "Error updating record: " . $mysql->error;
}

}
    
}

?>