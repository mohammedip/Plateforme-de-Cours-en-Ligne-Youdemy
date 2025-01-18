<?php
namespace App;

use App\Utilisateur;

require_once dirname(__DIR__) . './vendor/autoload.php'; 

class Enseignant extends Utilisateur{

    protected static string $role = "Enseignant";


    public function getRole(){
        return self::$role;
    }


    public static function getCountMembers(){
        $role=self::$role;
        $users =CRUD::select('users','count(*) as count', 'role = ?', [$role]);
        
           return $users[0]['count'];
            
    }

    public static function getPendingAccounts(){
        $role=self::$role;
        $users =CRUD::select('users', '*', 'role = ? and validCompte="non valide" ', [$role]);
        return $users;
    
    }

    public static function getAllMembers(){
        $role=self::$role;
        $users =CRUD::select('users', '*', 'role = ?', [$role]);
        return $users;
    
    }

    public static function getTopEnseignants() {
        $role=self::$role;
        $courses =CRUD::select('cours c 
        LEFT JOIN users u ON c.enseignant_id = u.id 
        LEFT JOIN cours_etudiant c_e ON c.id = c_e.cours_id ',
        'count(DISTINCT c.id) as count_cours,u.username,count(DISTINCT c_e.etudiant_id) as count_iscription',
        'u.role = ?
        GROUP BY u.id
        ORDER BY count_iscription DESC 
        LIMIT 3;', [$role]);
        return $courses;

            $users =CRUD::select('users u', '*', 'u.role = ?', [$role]);
            return $users;
    }
    public function getMyCoursesStatistiques($id) {
     
        $courses =CRUD::select(' users u
        LEFT JOIN cours c ON c.enseignant_id = u.id 
        LEFT JOIN cours_etudiant c_e ON c.id = c_e.cours_id ',
        'count(DISTINCT c.id) as count_cours,count(DISTINCT c_e.etudiant_id) as count_iscription',
        'u.id = ?
        GROUP BY u.id
        ORDER BY count_iscription DESC ;', [$id]);
        return $courses;

    }

    public function getMyCourses($id) {
     
        $courses =CRUD::select(' users u
        LEFT JOIN cours c ON c.enseignant_id = u.id 
        LEFT JOIN cours_etudiant c_e ON c.id = c_e.cours_id ',
        'c.title,c.id,c.validCours,c.description,count(DISTINCT c_e.etudiant_id) as count_iscription',
        'u.id = ?
        GROUP BY u.id,c.id
        ORDER BY count_iscription DESC ;', [$id]);
        return $courses;

    }

}

$enseignant = new Enseignant;

if(isset($_GET["action"]) && $_GET["action"]=="register"){
    
    $role=$enseignant->getRole();
    $enseignant->register($role);
}


?>