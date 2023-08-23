<?php
use Doctrine\DBAL\Query\QueryBuilder;
require 'connection.php';

if(isset($_POST['userId'])){
    $var=$_POST['userId'];

    $queryBuilder= new QueryBuilder($conn);
    $user= $queryBuilder
        ->select('id','name', 'email', 'password')
        ->from('Users')
        ->where('id=:id')
        ->setParameter('id', $var)
        ->executeQuery()
        ->fetchAllAssociative();
    
        if($user){
            foreach($user as $row){
                $response = $row;
            }
            echo json_encode($response);
        }else{
            $response['status']=200;
            $response['message']="Invalid User";
        }
}
// if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['uid'])){
    $id=$_POST['uid'];
    $name=$_POST['nameIn'];
    $email=$_POST['emailIn'];
    $pass=$_POST['pass'];

    $queryBuilder= new QueryBuilder($conn);
    $updateQuery= $queryBuilder
        ->update('Users')
        ->set('name','?')
        ->set('email','?')
        ->set('password','?')
        ->where('id=?')
        ->setParameter('id',$id);

        $user=  $conn->executeQuery($updateQuery, [$name, $email, $pass, $id]);
}
?>