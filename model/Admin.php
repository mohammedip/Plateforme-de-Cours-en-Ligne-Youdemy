<?php

namespace App;

use App\Utilisateur;

require_once dirname(__DIR__) . './vendor/autoload.php'; 

class Admin extends Utilisateur{

    protected static string $role = "Admin";

    public function suspendMember($id ,$statut) {
      
        $user = [
           'statutCompte' => $statut
        ];
         CRUD::update('users', $user,'id=?',[$id]);
    }

    public function validationMember($id ,$validation) {
      
        $user = [
           'validCompte' => $validation
        ];
        if($validation == "non valide"){

            $user = [
                'validCompte' => "valide",
                'role' => "Etudiant"
             ];            

        }
         CRUD::update('users', $user,'id=?',[$id]);
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

    public static function deleteMember($id){
        if (isset($_GET['id'])) {
        $id =$_GET['id'];

           CRUD::delete('cours','enseignant_id=?',[$id]);
            CRUD::delete('users','id=?',[$id]);
        }
    }

}

$admin = new Admin();
if(isset($_GET["statut"])){

    if($_GET["statut"]=="activate" || $_GET["statut"]=="suspend"){

    $admin->suspendMember($_GET["id"] ,$_GET["statut"]);

    }else if($_GET["statut"]=="delete"){
        $admin->deleteMember($_GET['id']);
    }

    if($_GET["role"] == "etudiant"){

        header("Location: ../view/allStudents.php");
    }else if($_GET["role"] == "enseignant"){

        header("Location: ../view/allTeachers.php");
    }
}
if(isset($_GET["validation"]) ){
    $admin->validationMember($_GET["id"] ,$_GET["validation"]);
    header("Location: ../view/pendingAccounts.php");
}
if(isset($_GET["action"]) && $_GET["action"]=="update" ){
    $admin->updateProfil();
    header("Location: ../view/profile.php");
}
?>