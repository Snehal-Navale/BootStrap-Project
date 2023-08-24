<?php
    use Doctrine\DBAL\DriverManager;
    use Doctrine\DBAL\Query\QueryBuilder;
    require_once "vendor/autoload.php";

    $connectionParams = [
        'dbname' => 'Bootstrap_Crud',
        'user' => 'root',
        'password' => 'plus91',
        'host' => 'localhost',
        'driver' => 'pdo_mysql'
    ];
    $conn = DriverManager::getConnection($connectionParams);
    if(!$conn){
        echo "Connection Failed";
        die();

    }

?>