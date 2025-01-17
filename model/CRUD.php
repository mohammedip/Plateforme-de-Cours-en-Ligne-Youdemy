<?php 

namespace App;
use Src\Database;

require_once dirname(__DIR__) . './vendor/autoload.php'; 

class CRUD {
    private static $pdo;

    public static function setConnection($pdo) {
        self::$pdo = $pdo;
    }

    public static function insert($table, $data) {
        try{
            $columns = implode(',', array_keys($data));
            $placeholders = implode(',', array_fill(0, count($data), '?'));

            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $stmt = self::$pdo->prepare($sql);

            return $stmt->execute(array_values($data));

        } catch (\PDOException $e) {

            error_log("Insert Error: " . $e->getMessage());
            return [];
        }
}

    public static function update($table, $data, $where, $params = []) {
        try{
            $setClause = implode(',', array_map(fn($key) => "$key = ?", array_keys($data)));

            $sql = "UPDATE $table SET $setClause WHERE $where";
            $stmt = self::$pdo->prepare($sql);

            return $stmt->execute(array_merge(array_values($data), $params));
        } catch (\PDOException $e) {

            error_log("Update Error: " . $e->getMessage());
            return [];
        }
    }

    public static function delete($table, $where, $params = []) {
        try{
            $sql = "DELETE FROM $table WHERE $where";
            $stmt = self::$pdo->prepare($sql);

            return $stmt->execute($params);
        } catch (\PDOException $e) {

            error_log("Update Error: " . $e->getMessage());
            return [];
        }
    }

    public static function select($table, $columns = "*", $where = null, $params = []) {
         try{

            $sql = "SELECT $columns FROM $table";
            if ($where) {
                $sql .= " WHERE $where";
            }

            $stmt = self::$pdo->prepare($sql);
            $stmt->execute($params);

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
         } catch (\PDOException $e) {

            error_log("Update Error: " . $e->getMessage());
            return [];
         }
    }

}

$conx = Database::getInstance();
$pdo = $conx->getConnection();
CRUD::setConnection($pdo);





?>