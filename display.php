<?php
use Doctrine\DBAL\Query\QueryBuilder;
require 'connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['displaySend'])){
$queryBuilder = new QueryBuilder($conn);

$table = '<table class="table my-4">
<thead class="thead-dark">
  <tr>
    <th scope="col">SrNo</th>
    <th scope="col">Id</th>
    <th scope="col">Name</th>
    <th scope="col">Email</th>
    <th scope="col">Action</th>
  </tr>
</thead>';

$users = $queryBuilder
    ->select('id', 'name', 'email')
    ->from('Users')
    ->executeQuery()
    ->fetchAllAssociative();

    if(count($users)!=0){
        $num = 1;
        foreach($users as $row){
            $table.= "<tr>
            <td>$num</td>
            <td scope='row'>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>
            <button type='button' class='btn btn-dark' onclick='getDetails({$row['id']})'>Update</button>
            
            <button type='button' class='btn btn-danger' onclick='deleteUser({$row['id']})'>Delete</button>
            </td>
          </tr>";
          $num++;
        }
    }
    $table.='</table>';
    echo $table;
}
?>