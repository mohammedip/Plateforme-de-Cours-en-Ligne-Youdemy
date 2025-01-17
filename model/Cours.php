<?php

namespace App;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
use App\CRUD;
require_once dirname(__DIR__) . './vendor/autoload.php'; 

class Cours{
    
    private static int $id;
    private static string $title;
    private static string $slug;
    private static string $content;
    private static int $category_id;
    private static string $featured_image;
    private static string $status;
    private static string $scheduled_date;
    private static int $author_id;
    private static string $created_at;
    private static string $updated_at;
    private static int $views;



    public static function getTopCourses(){

        $courses =CRUD::select('cours c 
        LEFT JOIN users u ON c.enseignant_id = u.id 
        LEFT JOIN cours_etudiant c_e ON c.id = c_e.cours_id 
        GROUP BY c.id
        ORDER BY count_iscription DESC 
        LIMIT 3;',
         'c.*,u.username,count(DISTINCT c_e.etudiant_id) as count_iscription');
        return $courses;
    }

    public static function getAllCourses(){

        $courses =CRUD::select('cours c 
        LEFT JOIN users u ON c.enseignant_id = u.id 
        LEFT JOIN cours_etudiant c_e ON c.id = c_e.cours_id 
        GROUP BY c.id
        ORDER BY c.validCours DESC ;',
         'c.*,u.username,count(DISTINCT c_e.etudiant_id) as count_iscription');
        return $courses;
    }

    public static function getCourse($id){

        $courses =CRUD::select('cours c 
        LEFT JOIN users u ON c.enseignant_id = u.id 
        LEFT JOIN cours_etudiant c_e ON c.id = c_e.cours_id 
        LEFT JOIN categories ON categories.id = c.category_id ',
         'DISTINCT c.*,u.username,categories.name,c_e.status',
         'c.id=?;',[$id]);

        return $courses;
    }

    public static function getPendingCourses(){
        $validCompte="non valide";
        $cours =CRUD::select('cours', '*',' validCours=? ', [$validCompte]);
        return $cours;
    
    }
    
    public function validationCours($id ,$validation) {
      
        $cours = [
           'validCours' => $validation
        ];
       
         CRUD::update('cours', $cours,'id=?',[$id]);
     }

    public static function getCountCours(){
        $articles =CRUD::select('cours','count(*) as count');
        
           return $articles[0]['count'];
            
    }
    

} 

$cours = new Cours();

if(isset($_GET["validation"]) ){
    $cours->validationCours($_GET["id"] ,$_GET["validation"]);
    header("Location: ../view/pendingCourses.php");
}


?>

