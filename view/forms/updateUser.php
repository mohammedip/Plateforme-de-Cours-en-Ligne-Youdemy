<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!$_SESSION['auth']) {
    header("Location: http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/login.php");
    exit();
}

use App\Utilisateur;

require_once '../../vendor/autoload.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Main Container -->
    <div class="flex flex-grow">
        <!-- Sidebar -->
        <?php
         if ($_SESSION['user']['role'] === 'Admin') {
            echo '<div>';
           include '../components/sidebar.php'; 
             echo '</div>' ;}
         
         ?>
       
        <!-- Main Content Area -->
        <div class="flex flex-col flex-grow">
            <!-- Topbar -->
            <?php include '../components/topbar.php'; ?>

            <!-- Main Content -->
            <div class="flex-grow w-full max-w-2xl bg-white shadow-md rounded-lg p-6 mt-6 mx-auto">
                <h2 class="text-2xl font-bold text-center mb-6">Modifier Utilisateurs</h2>

                <!-- Form -->
                <form action="../../model/Admin.php?action=update" method="POST" class="space-y-4">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
                        <input type="text" id="username" name="username" placeholder="Enter username" required 
                               class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <input type="hidden" id="id" name="id">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter email" required
                               class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone:</label>
                        <input type="text" id="phone" name="phone" placeholder="Enter phone number" required 
                               class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password_hash" class="block text-sm font-medium text-gray-700">Password:</label>
                        <input type="password" id="password_hash" name="password_hash" placeholder="Enter password" required
                               class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Bio -->
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700">Bio:</label>
                        <textarea id="bio" name="bio" placeholder="Enter bio" 
                                  class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <!-- Profile Picture URL -->
                    <div>
                        <label for="profile_picture_url" class="block text-sm font-medium text-gray-700">Profile Picture URL:</label>
                        <input type="text" id="profile_picture_url" name="profile_picture_url" placeholder="Enter profile picture URL"
                               class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-center mt-6">
                        <button type="submit" name="action" value="update"
                                class="px-6 py-2 bg-yellow-500 text-white font-semibold rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <footer class=" text-center">
                <?php include '../components/footer.php'; ?>
            </footer>
        </div>
    </div>

    <?php
    $user = Utilisateur::getMember($_GET['id']);
    foreach ($user as $user) {
        echo '
        <script>
            document.getElementById("username").value = "' . $user['username'] . '";
            document.getElementById("email").value = "' . $user['email'] . '";
            document.getElementById("phone").value = "' . $user['phone'] . '";
            document.getElementById("bio").value = "' . $user['bio'] . '";
            document.getElementById("profile_picture_url").value = "' . $user['profile_picture_url'] . '";
            document.getElementById("id").value = "' . $_GET['id'] . '";
        </script>
        ';
    }
    ?>
</body>
</html>
