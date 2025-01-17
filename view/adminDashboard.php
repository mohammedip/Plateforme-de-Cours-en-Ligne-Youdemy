<?php
use App\Category;
use App\Tag;
use App\Enseignant;
use App\Etudiant;
use App\Cours;

require_once dirname(__DIR__) . './vendor/autoload.php'; 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!$_SESSION['auth']) {
    header("Location: http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/login.php");
    exit();
}
if ($_SESSION['user']['role'] === 'Etudiant') {
    header("Location: http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/etudiantDashboard.php");
} else if ($_SESSION['user']['role'] === 'Enseignant') {
    header("Location: http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/enseignantDashboard.php");
}

$categoriesCount=Category::getCountCategories();
$tagsCount=Tag::getCountTags();
$enseignantCount=Enseignant::getCountMembers();
$etudiantCount=Etudiant::getCountMembers();
$coursCount=Cours::getCountCours();


$top_teachers = Enseignant::getTopEnseignants();

$top_courses =Cours::getTopCourses();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-50 flex h-screen">

    <!-- Include Sidebar -->
     <div>
    <?php include('./components/sidebar.php'); ?>
</div>
    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        
        <!-- Include Topbar -->
        <?php include('./components/topbar.php'); ?>

        <!-- Main Content Area -->
        <div class="container mx-auto px-6 py-8 flex-1">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <!-- Total Students -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                            <i class="fa-solid fa-graduation-cap text-3xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Students</p>
                            <p class="text-2xl font-semibold text-gray-800"><?php echo $etudiantCount; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Active Courses -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-500">
                            <i class="fa-solid fa-book text-3xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Courses</p>
                            <p class="text-2xl font-semibold text-gray-800"><?php echo $coursCount; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Teachers -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                            <i class="fa-solid fa-user-tie text-3xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Teachers</p>
                            <p class="text-2xl font-semibold text-gray-800"><?php echo $enseignantCount; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Category -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gray-100 text-gray-500">
                            <i class="fa-solid fa-list text-3xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Category</p>
                            <p class="text-2xl font-semibold text-gray-800"><?php echo $categoriesCount; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Tags -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                            <i class="fa-solid fa-tag text-3xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Tags</p>
                            <p class="text-2xl font-semibold text-gray-800"><?php echo $tagsCount; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Teachers Table -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold">Top Enseignants</h2>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-gray-500">
                                <th class="pb-4">Enseignant</th>
                                <th class="pb-4">Courses</th>
                                <th class="pb-4">Etudient</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($top_teachers as $teacher): ?>
                            <tr class="border-t">
                                <td class="py-4"><?php echo $teacher['username']; ?></td>
                                <td class="py-4"><?php echo $teacher['count_cours']; ?></td>
                                <td class="py-4"><?php echo $teacher['count_iscription']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top courses Table -->
            <div class="bg-white rounded-lg shadow mt-4">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold">Top Courses</h2>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-gray-500">
                                <th class="pb-4">Courses Titre</th>
                                <th class="pb-4">Enseignant</th>
                                <th class="pb-4">Inscription</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($top_courses as $cours): ?>
                            <tr class="border-t">
                                <td class="py-4"><?php echo $cours['title']; ?></td>
                                <td class="py-4"><?php echo $cours['username']; ?></td>
                                <td class="py-4"><?php echo $cours['count_iscription']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <div>
       <?php include('./components/footer.php'); ?> 
    </div>
    
    </div> <!-- End of Main Content -->
    
<?php

if ($_SESSION['user']['role']=="Enseignant" || $_SESSION['user']['role']=="Etudiant" || $_SESSION['user']['role']=="Admin"){
    echo'<script>
    document.getElementById(\'dashbBtn\').classList.add(\'hidden\');
    </script>';
 }
?>
</body>
</html>
