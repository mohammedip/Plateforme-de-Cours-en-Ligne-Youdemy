<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
use App\Cours;

require_once '../vendor/autoload.php';



$courses =Cours::getAllCourses();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags Table</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Page Wrapper -->
    <div class="flex h-screen">

        <!-- Sidebar -->
         <?php
         if ($_SESSION['user']['role'] === 'Admin') {
            echo '<div class="w-64 bg-gray-800 text-white fixed h-screen">';
           include './components/sidebar.php'; 
             echo '</div>
             <div class="flex-1 ml-64 flex flex-col">
             ';
         }else{
            echo '<div class="flex-1 flex flex-col">';
         }
         
         ?>
        


            <!-- Topbar -->
            <?php include './components/topbar.php'; ?>


           <div class="p-6 flex-grow">
                    <!-- Card Section -->
                    <div class="bg-white shadow-md rounded-lg">
                        <div class="p-4 border-b">
                            <h2 class="text-lg font-bold text-gray-800">All Courses</h2>
                        </div>

                        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php foreach ($courses as $cours): ?>
                                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl">
                                    <div class="p-6">
                                        <!-- Course Title -->
                                        <h3 class="text-xl font-semibold text-gray-900 mb-4">
                                            <?php echo $cours['title']; ?>
                                        </h3>

                                        <!-- Course Description -->
                                        <p class="text-gray-600 mb-4 text-sm font-medium line-clamp-3">
                                            <span class="font-semibold text-gray-700">Description:</span>
                                            <?php echo $cours['description']; ?>
                                        </p>

                                        <!-- Instructor Info -->
                                        <p class="text-gray-600 mb-4 text-sm font-medium">
                                            <span class="font-semibold text-gray-700">Instructor:</span> 
                                            <?php echo $cours['username']; ?>
                                        </p>

                                        <!-- Course Enrollment Status -->
                                        <p class="text-gray-600 text-sm font-medium mb-6">
                                            <span class="font-semibold text-gray-700">Enrollments:</span> 
                                            <?php echo $cours['count_iscription']; ?>
                                        </p>

                                        <!-- Button and Status in the Same Row -->
                                        <div class="flex items-center justify-between mt-6">
                                            <!-- View Details Button -->
                                            <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/singleCours.php?id=<?php echo $cours['id']; ?>" 
                                            class="w-full sm:w-auto bg-blue-600 text-white text-sm font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 transform hover:scale-105">
                                                View Details
                                            </a>
                                            <!-- Valid Course Status -->
                                            <span class="ml-4 px-4 py-2 text-xs font-semibold rounded-full text-white <?php echo $cours['validCours'] === 'valide' ? 'bg-green-500' : 'bg-red-500'; ?>">
                                                <?php echo ucfirst($cours['validCours']); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            <!-- Footer -->
            <footer class="">
                <?php include './components/footer.php'; ?>
            </footer>
        </div>
    </div>

</body>

</html>
