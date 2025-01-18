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
        LEFT JOIN cours_tag c_t  ON c.id = c_t.cours_id 
        LEFT JOIN tags t ON t.id = c_t.tag_id ',
         'c.*,u.username, GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") as tags,count(DISTINCT c_e.etudiant_id) as count_iscription',
         'c.validCours=? GROUP BY c.id, u.username;',['valide']);
        return $courses;
    }

    public static function getCoursById($id){

        $courses =CRUD::select('cours','*','id=?',[$id]);

        return $courses;
    }

    public static function getCoursTagsById($id){

        $tags =CRUD::select('cours_tag as c_t join tags on c_t.tag_id=tags.id ','c_t.*, tags.name as tag_name ','c_t.cours_id=?',[$id]);

        return $tags;
    }

    public static function getCourse($courseId){

        $courses =CRUD::select('cours c 
        LEFT JOIN users u ON c.enseignant_id = u.id 
        LEFT JOIN cours_etudiant c_e ON c.id = c_e.cours_id 
        LEFT JOIN categories ON categories.id = c.category_id
        LEFT JOIN cours_tag c_t  ON c.id = c_t.cours_id 
        LEFT JOIN tags t ON t.id = c_t.tag_id  ',
         'DISTINCT c.*, GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") as tags,u.username,categories.name,MAX(c_e.status) as status',
         'c.id=? GROUP BY c.id LIMIT 1;',[$courseId]);

        return $courses;
    }

    public static function getLastCours() {
        $cours = CRUD::select(
            'cours ORDER BY created_at DESC LIMIT 1','id'
        );
        
        return $cours;
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

    public function deleteCours($id){
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            CRUD::delete('cours', 'id=?', [$id]);
            
        }
    }
   
    public function addCours(){

        if (isset($_POST['title'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];  
            $contenu = $_POST['contenu'];  
            $contenu_video = $_POST['contenu_video'];  
            $category_id = $_POST['category_id'];  
            $enseignant_id = $_SESSION['user']['id'];  


            $cours = [
                'title' => $title,
                'description' => $description,
                'contenu' => $contenu,
                'contenu_video' => $contenu_video,
                'category_id' => $category_id,
                'enseignant_id' => $enseignant_id,
            ];

            CRUD::insert('Cours', $cours);

            $lastCours = self::getLastCours();
            $coursId = $lastCours[0]['id'];

            if (isset($_POST['tag_id']) && !empty($_POST['tag_id'])) {
                foreach ($_POST['tag_id'] as $tagId) {
                    $tagCours = [
                        'cours_id' => $coursId,
                        'tag_id' => $tagId
                    ];
                    CRUD::insert('cours_tag', $tagCours);
                }
            }
        }
    }

    public function updateCours(){

        if (isset($_POST['title'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];  
            $contenu = $_POST['contenu'];  
            $contenu_video = $_POST['contenu_video'];  
            $category_id = $_POST['category_id'];  


            $cours = [
                'title' => $title,
                'description' => $description,
                'contenu' => $contenu,
                'contenu_video' => $contenu_video,
                'category_id' => $category_id,
            ];

            CRUD::update('Cours', $cours, 'id=?', [$_POST['id']]);

            if (isset($_POST['tag_id']) && !empty($_POST['tag_id'])) {
                CRUD::delete('cours_tag', 'cours_id=?', [$_POST['id']]);

                foreach ($_POST['tag_id'] as $tagId) {
                    $tagCours = [
                        'cours_id' => $_POST['id'],
                        'tag_id' => $tagId
                    ];
                    CRUD::insert('cours_tag', $tagCours);
                }
            }
        }
    }

} 

$cours = new Cours();

if(isset($_GET["validation"]) ){
    $cours->validationCours($_GET["id"] ,$_GET["validation"]);
    header("Location: ../view/pendingCourses.php");
}

if(isset($_GET["action"]) ){
    if($_GET["action"]== "delete" ){

    $cours->deleteCours($_GET["id"]);
    header("Location: ../view/enseignantDashboard.php");
}else if($_GET["action"]== "add" ){

    $cours->addCours();
    header("Location: ../view/enseignantDashboard.php");
}else if($_GET["action"]== "update" ){

    $cours->updateCours();
    header("Location: ../view/enseignantDashboard.php");
}
}


?>

