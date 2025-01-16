<?php 

namespace Src;
// use PDO;
use Dotenv\Dotenv ,PDO;

require_once dirname(__DIR__) . '../vendor/autoload.php'; 

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

class Database {
    private static $instance = null;
    private $pdo;

public function __construct(){

   $server_name = $_ENV['server_name']; 
    $dataBase_name = $_ENV['dataBase_name'];
    $user_name = $_ENV['user_name']; 
    $password = $_ENV['password'];

$dsn = "mysql:host=$server_name;dbname=$dataBase_name;charset=utf8mb4";

try {

    $this->pdo = new PDO($dsn, $user_name, $password);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {

    die("Connection failed: " . $e->getMessage());
}

}

public static function getInstance(){
    if (self::$instance === null) {
        self::$instance = new self();
    }
    return self::$instance;
}

public function getConnection() {
    return $this->pdo;
}

}



?>