<?php
namespace App;

use App\CRUD;

require_once dirname(__DIR__) . './vendor/autoload.php'; 


class Category {

    private string $name;
    

    public static function getAllCategories(){
        $categories =CRUD::select('categories');
        return $categories;
    
    }
    public static function getCountCategories(){
        $categories =CRUD::select('categories','count(*) as count');
        
            return $categories[0]['count'];
            
    }

    public static function getCategorie($id){
        $categories =CRUD::select('categories', 'name', 'id = ?', [$id]);;
        return $categories;
    
    }
    public function addCategorie(){
        if (isset($_POST['name'])) {
            $this->name = $_POST['name'];
            $category = [
                'name' => $this->name,
            ];
            CRUD::insert('categories', $category);
        }
    }
    public  function updateCategorie(){
        if (isset($_POST['name'])) {
            $this->name = $_POST['name'];
            $category = [
                'name' => $this->name,
            ];
            CRUD::update('categories', $category,'id=?',[$_POST['id']]);
        }
    }
    public function deleteCategorie(){
        if (isset($_GET['id'])) {

            CRUD::delete('cours','category_id=?',[$_GET['id']]);
            CRUD::delete('categories','id=?',[$_GET['id']]);
           
        }
    }

   
}

$category= new Category();

if(isset($_GET['action']) && $_GET['action']=="add"){
    
     $category->addCategorie();
    header("Location: ../view/allCategories.php");

}else if(isset($_GET['action']) && $_GET['action']=="delete"){

     $category->deleteCategorie();
    header("Location: ../view/allCategories.php");
}else if(isset($_GET['action']) && $_GET['action']=="update"){

    $category->updateCategorie();
   header("Location: ../view/allCategories.php");
}

?>

