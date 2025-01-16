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
         JOIN cours c ON c_e.cours_id = c.id ',
        'c.title,c_e.status',
        'u.id = ?
        GROUP BY u.id,c.id ORDER BY c_e.status ASC ;', [$id]);
        return $courses;

    }
}

if(isset($_GET["action"]) && $_GET["action"]=="register"){
    $etudiant = new Etudiant;
    $role=$etudiant->getRole();
    $etudiant->register($role);
    
}



?>