<?php

namespace App;

use App\CRUD;

require_once dirname(__DIR__) . './vendor/autoload.php'; 
abstract class Utilisateur{

    protected string $username;
    protected string $email;
    protected string $phone;
    protected string $password_hash;
    protected string $bio;
    protected string $profile_picture_url;
    protected static string $role;
    protected int $statutCompte;
    protected int $valideCompte;


    abstract public static function getAllMembers();

    abstract public static function getCountMembers();

    public static function getAllUsers(){
        $users =CRUD::select('users', '*');
        return $users;
    
    }
    public static function getMember($id){
        $users =CRUD::select('users', '*', 'id = ?', [$id]);;
        return $users;
     
     }

     public  function register($role) {
        if (isset($_POST['username'], $_POST['email'], $_POST['phone'], $_POST['password_hash'], $_POST['bio'], $_POST['profile_picture_url'])) {
            $this->username = $_POST['username'];
            $this->email = $_POST['email'];
            $this->phone = $_POST['phone'];
            $this->password_hash = password_hash($_POST['password_hash'], PASSWORD_DEFAULT); 
            $this->bio = $_POST['bio'];
            $this->profile_picture_url = $_POST['profile_picture_url'];
     
            $user = [
                'username' => $this->username,
                'email' => $this->email,
                'phone' => $this->phone,
                'password_hash' => $this->password_hash,
                'bio' => $this->bio,
                'profile_picture_url' => $this->profile_picture_url,
                'role' => $role,
            ];
            if($role="Enseignant"){
               $user += [
                  'validCompte' => "non valide"
               ];
            }
            CRUD::insert('users', $user);
            header("Location: ../view/login.php");

     
        }
     }

      public  function updateProfil() {
        if (isset($_POST['username'], $_POST['email'], $_POST['password_hash'], $_POST['bio'], $_POST['profile_picture_url'], $_POST['role'])) {
           $this->username = $_POST['username'];
           $this->email = $_POST['email'];
           $this->phone = $_POST['phone'];
           $this->password_hash = password_hash($_POST['password_hash'], PASSWORD_DEFAULT); 
           $this->bio = $_POST['bio'];
           $this->profile_picture_url = $_POST['profile_picture_url'];
           self::$role = $_POST['role'];
     
           $user = [
               'username' => $this->username,
               'email' => $this->email,
               'phone' => $this->phone,
               'password_hash' => $this->password_hash,
               'bio' => $this->bio,
               'profile_picture_url' => $this->profile_picture_url,
               'role' => self::$role
           ];
            CRUD::update('users', $user,'id=?',[$_POST['id']]);
        }
     }
   



      public static function logIn() {
        if (isset( $_POST['email'] , $_POST['password_hash'])) {
     
            $email = $_POST['email'];
            $password_hash = $_POST['password_hash']; 
           
     
           $users=self::getAllUsers();
           foreach ($users as $user) {
     
              if($user['email']==$email && password_verify($password_hash, $user['password_hash'])){
                 session_start();
                 $_SESSION['auth'] =true;
                 $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role']
                ];
                
                if($user['role']=="Enseignant"){

                  if($user['validCompte']=="non valide"){

                        return false;
                  }else if($user['statutCompte']=="suspend"){

                     return true;
               }
                }
               
                return $user;
              }else if(($user['email']!==$email || !password_verify($password_hash, $user['password_hash'])) ){
                 continue;
              }else{
               return null;
              }
           }
     
     
        }
     }

}

if(isset($_GET["action"]) && $_GET["action"]=="login"){
    $auth= Utilisateur::logIn();
   
    if($auth===null){
        header("Location: ../view/login.php?action=erreur");
     }else  if($auth===false){
      header("Location: ../view/login.php?action=nonValid");
      }else  if($auth===true){
         header("Location: ../view/login.php?action=suspend");
      }else if ($_SESSION['user']['role']=="Admin"){
        header("Location: ../view/adminDashboard.php");
     }else if ($_SESSION['user']['role']=="Enseignant"){
        header("Location: ../view/enseignantDashboard.php");
     }else if ($_SESSION['user']['role']=="Etudiant"){
        header("Location: ../view/etudiantDashboard.php");
     }
}



?>