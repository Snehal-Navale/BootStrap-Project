<?php
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Schema\Schema;

require_once 'vendor/autoload.php';

$connectionParams = [
    'dbname' => 'Bootstrap_Crud',
    'user' => 'root',
    'password' => 'plus91',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

$conn = DriverManager::getConnection($connectionParams);
$queryBuilder = $conn->createQueryBuilder();

$schema = new Schema();

// Define the table name
$tableName = 'Users';

// Create the table
$table = $schema->createTable($tableName);
$table->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
$table->addColumn('name', 'string', ['length' => 255]);
$table->addColumn('email', 'string', ['length' => 255]);
$table->addColumn('password', 'string', ['length' => 255]);
$table->setPrimaryKey(['id']);

$sqls = $schema->toSql($conn->getDatabasePlatform());
if($sqls){
    echo "succcess\n";
}else{
    echo "failure\n";
}
foreach ($sqls as $sql) {
    $conn->executeQuery($sql);
}
?>
