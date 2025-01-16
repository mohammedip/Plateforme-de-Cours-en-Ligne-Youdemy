<?php
namespace App;

use App\CRUD;

require_once dirname(__DIR__) . './vendor/autoload.php'; 
class Tag {

    private string $name;

public static function getAllTags(){
    $tags =CRUD::select('tags');
    return $tags;

}
public static function getTag($id){
    $tags =CRUD::select('tags', 'name', 'id = ?', [$id]);;
    return $tags;

}
public static function getCountTags(){
    $tags =CRUD::select('tags','count(*) as count');
    return $tags[0]['count'];  
   
}
public static function addTag(){
    if (isset($_POST['name'])) {
        self::$name = $_POST['name'];
        $tag = [
            'name' => self::$name,
        ];
        CRUD::insert('tags', $tag);
    }
}
public static function updateTag(){
    if (isset($_POST['name'])) {
        self::$name = $_POST['name'];
        $tag = [
            'name' => self::$name,
        ];
        CRUD::update('tags', $tag,'id=?',[$_POST['id']]);
    }
}
public static function deleteTag(){
    if (isset($_GET['id'])) {
        
        CRUD::delete('tags','id=?',[$_GET['id']]);
    }
}

}

?>



