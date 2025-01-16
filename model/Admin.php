<?php

namespace App;

use App\Utilisateur;

require_once dirname(__DIR__) . './vendor/autoload.php'; 

class Enseignant extends Utilisateur{

    private string $role = "Admin";

 

}
?>