<?php

use App\Etudiant;

require_once dirname(__DIR__) . './vendor/autoload.php'; 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth']) {
    header("Location: http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/login.php");
    exit();
}
if ($_SESSION['user']['role'] === 'Enseignant') {
    header("Location: http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/home.php");
} else if ($_SESSION['user']['role'] === 'Admin') {
    header("Location: http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/home.php");
}
$etudiant=new Etudiant();
$statistique=$etudiant->getMyCoursesStatistiques($_SESSION['user']['id']);
$allCourses=$statistique[0]["count_courses"];
$coursesNotComplet=$statistique[0]["non_complet_courses"];
$coursesComplet=$statistique[0]["complet_courses"];

$courses =$etudiant->getMyCourses($_SESSION['user']['id']);

$coursesPerPage = 2;
$totalCourses = count($courses);
$totalPages = ceil($totalCourses / $coursesPerPage);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($page - 1) * $coursesPerPage;
$currentPageCourses = array_slice($courses, $startIndex, $coursesPerPage);

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
                        <!-- start card--->

                        <div class="bg-white rounded-lg shadow mt-4">
                        <div class="px-6 py-4 border-b">
                            <h2 class="text-2xl font-bold text-gray-900">Courses</h2>
                        </div>
                        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                            <?php if (count($currentPageCourses) > 0): ?>
                            <?php foreach ($currentPageCourses as $cours): ?>
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition hover:scale-105 hover:shadow-2xl">
                                <div class="p-6">
                                    <h2 class="text-3xl font-semibold text-gray-800 mb-6">
                                        <?php echo $cours['title']; ?>
                                    </h2>
                                    <p class="text-gray-600 mb-3 line-clamp-2">
                                        <span class="font-bold text-gray-700">Description:</span> <?php echo $cours['description']; ?>
                                    </p>
                                    
                                    <div class="flex flex-wrap gap-2 mb-6">
                                            <?php
                                            $tags = explode(', ', $cours['tags']);
                                            foreach ($tags as $tag):
                                            ?>
                                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full hover:bg-green-200 transition duration-200">
                                                    <?php echo $tag; ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                        
                                    <div class="flex items-center justify-between text-gray-600 text-sm mb-3">
                                        <span class="my-4">
                                            <span class=" px-4 py-2 rounded-full text-sm text-white <?php echo $cours['status'] === 'complet' ? 'bg-green-500' : 'bg-red-500'; ?>">
                                                <?php echo ucfirst($cours['status']); ?>
                                            </span>
                                        </span>
                                        <span><span class="font-medium text-gray-700">Created:</span> <?php echo date('F j, Y', strtotime($cours['created_at'])); ?></span>
                                    </div>
                                    <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/singleCours.php?id=<?php echo $cours['id'] ?>" 
                                    class="w-full bg-blue-600 text-white text-lg font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700">
                                        View Details
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                             
                            <?php else: ?>
                            <p class="text-gray-500 text-center">No courses available.</p>
                            <?php endif; ?>
                        </div>
                        <!-- end cards--->
                         
                            <!--pagination-->

                        <div class="flex justify-end p-6">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <button onclick="showPage(<?php echo $i; ?>)" 
                                        class="w-10 h-10 flex items-center justify-center rounded-full border-2 transition-transform transform hover:scale-105 <?php echo ($i === $page) ? 'bg-indigo-600 text-white border-indigo-600' : 'text-indigo-600 border-indigo-600 hover:bg-indigo-50'; ?>">
                                    <?php echo $i; ?>
                                </button>
                            <?php endfor; ?>
                        </div>

                        <!--pagination-->
                    </div>

                             
              </div>
        <div>
       
    </div>
    </div> <!-- End of Main Content -->
    <div>
        <?php include('./components/footer.php'); ?> 
    </div>
    <?php

if ($_SESSION['user']['role']=="Enseignant" || $_SESSION['user']['role']=="Etudiant" || $_SESSION['user']['role']=="Admin"){
    echo'<script>
    document.getElementById(\'dashbBtn\').classList.add(\'hidden\');
    </script>';
 }
?>
<script>
        function showPage(page) {
            const url = new URL(window.location.href);
            url.searchParams.set('page', page);
            window.location.href = url;
        }
    </script>
</body>
</html>
