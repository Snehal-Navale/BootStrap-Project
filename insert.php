<?php
require 'connection.php';
use Doctrine\DBAL\Types\Type;
error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['newName'];
    $email = $_POST['newEmail'];
    $password = $_POST['newPassword'];
    // $queryBuilder = new $QueryBuilder($conn);
    $queryBuilder = $conn->createQueryBuilder();

    $query = $queryBuilder
    ->insert('Users')
    ->setValue('name','?')
    ->setValue('email', '?')
    ->setValue('password','?');
    $user = $conn->executeQuery($query,[$name, $email, $password]);
    if($user){
        echo "success";
    }else{
        echo "failure";
    }
   

}
?>