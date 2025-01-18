<?php
namespace App;

use App\Utilisateur;

require_once dirname(__DIR__) . './vendor/autoload.php'; 

class Etudiant extends Utilisateur{

    protected static string $role = "Etudiant";

    public function getRole(){
        return self::$role;
    }

    public static function getCountMembers(){
        $role=self::$role;
        $users =CRUD::select('users','count(*) as count', 'role = ?', [$role]);
        
           return $users[0]['count'];
            
       
    }

    public static function getAllMembers(){
        $role=self::$role;
        $users =CRUD::select('users', '*', 'role = ?', [$role]);
        return $users;
    
    }
 
    public function getMyCoursesStatistiques($id) {
     
        $courses =CRUD::select(' users u
        JOIN cours_etudiant c_e ON u.id = c_e.etudiant_id',
        'count(DISTINCT c_e.cours_id) as count_courses ,sum(c_e.status="non complet") as non_complet_courses
        ,sum(c_e.status="complet") as complet_courses',
        'u.id = ? 
        GROUP BY u.id;', [$id]);
        return $courses;

    }

    public function getMyCourses($id) {
     
        $courses =CRUD::select(' users u
        JOIN cours_etudiant c_e ON u.id = c_e.etudiant_id
         JOIN cours c ON c_e.cours_id = c.id 
         LEFT JOIN cours_tag c_t  ON c.id = c_t.cours_id 
        LEFT JOIN tags t ON t.id = c_t.tag_id',
        'c.*,GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") as tags,c_e.status',
        'u.id = ?
        GROUP BY u.id,c.id ORDER BY c_e.status ASC ;', [$id]);
        return $courses;

    }

    public function getInscription($id) {
     
        $courses =CRUD::select('cours_etudiant','*','etudiant_id = ?', [$id]);
        return $courses;

    }

    public function CompletCours($userId,$coursId){

        $cours=[ 
            'status'=>"complet" 
        ];
        CRUD::update('cours_etudiant', $cours, 'etudiant_id = ? and cours_id=?', [$userId,$coursId]);

    }

    public function inscrire($userId,$coursId){

        $cours=[ 
            'etudiant_id'=>$userId,
             'cours_id'=>$coursId
        ];
        CRUD::insert('cours_etudiant', $cours);

    }
}

$etudiant = new Etudiant;

if(isset($_GET["action"])){
    if($_GET["action"]=="register"){
        $role=$etudiant->getRole();
        $etudiant->register($role);
    
    }else if($_GET["action"]=="completCours"){

        $etudiant->CompletCours($_GET["userId"],$_GET["coursId"]);
        header("Location: http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/singleCours.php?id=".$_GET["coursId"]);

    }else if($_GET["action"]=="inscription"){

        $etudiant->inscrire($_GET["userId"],$_GET["coursId"]);
        header("Location: http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/singleCours.php?id=".$_GET["coursId"]);

    }
}



?>