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

//Check that the table exists or not and create a table if not exists one.
$sql = "CREATE TABLE IF NOT EXISTS users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30) NOT NULL,
name VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($mysql->query($sql) === TRUE) {
  echo "Table users created successfully\n";
} else {
  echo "Error creating table: " . $mysql->error;
}

$user_name = "";
$name = "";
$email = "";

//This function (empty()) will check that if the data inserted are empty or not
if(empty($_POST["username"]) || empty($_POST["name"]) || empty($_POST["email"])){

echo "Fields Can't Be Empty!.\n";

} else {

//This will contain firstname which will be sended by the API with a key forstname
$user_name = $_POST["username"];

//This will contain lastname, received from API with key as lastname
$name = $_POST["name"];

//This will contain email, where key is email
$email = $_POST["email"];

//This will retrieve all the rows where the firstname is matching with the entered data
$check1 = $mysql->query("SELECT 1 FROM users WHERE username = '$user_name' LIMIT 1");

//This will retrieve all the rows where the lastname is matching with the entered data
$check2 = $mysql->query("SELECT 1 FROM users WHERE name = '$name' LIMIT 1");

//This will retrieve all the rows where the email is matching with the entered data
$check3 = $mysql->query("SELECT 1 FROM users WHERE email = '$email' LIMIT 1");

//Here all the rows are checked and if no match is found than data is submitted
if($check1->fetch_row() || $check2->fetch_row() || $check3->fetch_row()){
echo "Sorry, Username is Taken.\n";
} else {
//Insert data into the table, users is the table name
$sql = "INSERT INTO users (username, name, email)
VALUES ('$user_name', '$name', '$email')";

if ($mysql->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $mysql->error;
}

}
}

?>