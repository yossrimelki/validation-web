<?php

class Database
{
private $host = "localhost";
private $username = "root";
private $password = "";
private $db = "mercury";


function connect()
{

    $connection = mysqli_connect($this->host,$this->username,$this->password,$this->db);
    return $connection;

}


function read($query)
{
    $conn = $this->connect();
    $result = mysqli_query($conn,$query);
    if (!$result){
        return false;
    }
    else 
    {
        $data = false ;
        while ($row = mysqli_fetch_assoc($result))
        {
            $data[] = $row;
        }
        return $data;
    }

}

function save ($query)
{
    $con = $this->connect();
    $result = mysqli_query($con,$query);
    if ($result == false ){
        return false;
    }
    else {
        return true;
    }

}
function check ($query)
{
    $con = $this->connect();
    $result = mysqli_query($con,$query);
    if (mysqli_num_rows($result) > 0) {
        return 0;
    }
    else{
        return 1;
    } 	

}
}
?>