<?php

//THIS FILE IS FOR PART-V:- https://youtu.be/jvDJlVFuJt8

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

//This will contain a JSON array of your data.
$result_array = array();



if(empty($_POST["len"])){
    
echo "Enter something";

} else {
    
    $limit = $_POST["len"];
    
    
    
//Here all the rows and it's data are selected
$sql = "SELECT username, name, email FROM users LIMIT $limit";
    
    /* If there are results from database push to result array */
    $result = $mysql->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }
    }
    
    /*This sends a JSON encded array to client */
    echo json_encode($result_array);
    }
    $mysql->close();
    
    
?>