<?php

use App\Etudiant;

require_once dirname(__DIR__) . './vendor/autoload.php'; 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$etudiant=new Etudiant();
$statistique=$etudiant->getMyCoursesStatistiques($_SESSION['user']['id']);
$allCourses=$statistique[0]["count_courses"];
$coursesNotComplet=$statistique[0]["non_complet_courses"];
$coursesComplet=$statistique[0]["complet_courses"];

$courses =$etudiant->getMyCourses($_SESSION['user']['id']);
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
</div>
    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        
        <!-- Include Topbar -->
        <?php include('./components/topbar.php'); ?>

        <!-- Main Content Area -->
        <div class="container mx-auto px-6 py-8 flex-1">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Students -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                            <i class="fa-solid fa-book text-3xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Courses</p>
                            <p class="text-2xl font-semibold text-gray-800"><?php echo $allCourses; ?></p>
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
                            <p class="text-sm text-gray-500">Courses Not Complet</p>
                            <p class="text-2xl font-semibold text-gray-800"><?php echo $coursesNotComplet; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Teachers -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                            <i class="fa-solid fa-book text-3xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Courses Complet</p>
                            <p class="text-2xl font-semibold text-gray-800"><?php echo $coursesComplet; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow mt-4">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold">Courses</h2>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-gray-500">
                                <th class="pb-4">Cours</th>
                                <th class="pb-4">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($courses as $cours): ?>
                            <tr class="border-t">
                                <td class="py-4"><?php echo htmlspecialchars($cours['title']); ?></td>
                                <td class="py-4"><?php echo htmlspecialchars($cours['status']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div> <!-- End of Main Content -->
</body>
</html>
