<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 min-h-screen flex">

<!-- Sidebar -->
<div class="w-64 bg-gray-800 text-white h-screen fixed">
    <?php include '../components/sidebar.php'; ?>
</div>

<!-- Main Content -->
<div class="ml-64 flex-1 flex flex-col">

    <!-- Topbar -->
    
        <?php include '../components/topbar.php'; ?>
   

    <!-- Page Content -->
    <div class="flex-1 flex items-center justify-center p-6">
        <div class="container mx-auto w-full max-w-md bg-white shadow-md rounded-lg p-8">
            <h2 class="text-center text-2xl font-bold mb-6">Add Catégories</h2>

            <form action="../../model/Category.php?action=add" method="POST" class="space-y-4">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Category Name:</label>
                    <input type="text" id="name" name="name" 
                           class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 focus:border-blue-500" 
                           placeholder="Enter category name" required>
                </div>

                <!-- Buttons centered -->
                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition" name="action" value="create">Add</button>
                </div>
            </form>
        </div>
    </div>
    <div>
       <?php include('../components/footer.php'); ?> 
    </div>
</div>

</body>
</html>
