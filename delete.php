<?php
use Doctrine\DBAL\Query\QueryBuilder;
    require 'connection.php';

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['deleteId'])){
        $userId = $_POST['deleteId'];

        $queryBuilder = new QueryBuilder($conn);

        $query = $queryBuilder
            ->delete('Users')
            ->where('id=:id')
            ->setParameter('id', $userId)
            ->executeStatement();
    }

?>