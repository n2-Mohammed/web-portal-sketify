<?php

header("Access-Control-Allow-Origin: *");

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


$user_name = "";
$name = "";
$email = "";

//Here you will send the type which you want to do first, like, we should first check that the data we have to delete is present in DB or not and then we have to delete it

$type = $_POST["type"];

//getData type will check that the data is present or not
if($type == "getData"){
    getData($mysql);
    
    //deleteData type will delete the data
} else if($type == "deleteData"){
    deleteData($mysql);
}

//This will check if the data is present in DB or not
function getData($mysql){

if(empty($_POST["username"]) || empty($_POST["name"]) ||  empty($_POST["email"])){

echo "Fields can't Be Empty.\n";


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
            echo "delete accessed id=".$row["id"]."\n";
        } else {
            echo "delete denied id=null\n";
        }
} else {
    echo "0 results";
}
} else {
echo "data null\n";
}
}
}


//On calling this function, it will delete the data associated with the particular ID in DB
function deleteData($mysql){
    $id = $_POST["id"];
   
   //This command will delete your data
    $delete = "DELETE FROM users WHERE id='$id'";
    
    if ($mysql->query($delete) === TRUE) {
    echo "Record deleted successfully";
    } else {
    echo "Error deleting record: " . $delete->error;
    }
    

}



?>