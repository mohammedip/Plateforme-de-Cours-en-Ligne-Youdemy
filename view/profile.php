<?php


use App\Utilisateur; 

require_once '../vendor/autoload.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth']) {
    header("Location: http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/login.php");
    exit();
}

if (isset($_GET['id'])) {
$id =$_GET['id'];
}else{
$id =$_SESSION['user']['id'] ;
}
 $user = Utilisateur::getMember($id); 
 foreach ($user as $user) ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Profile</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100">

    <!-- Page Wrapper -->
    <div class="min-h-screen flex flex-col">

        <!-- Content Wrapper -->
        <div class="flex flex-col flex-1">

            <!-- Topbar -->
            <?php include './components/topbar.php'; ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container mx-auto p-6">
                        <!-- Page Heading -->
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-3xl font-extrabold text-gray-800">Profile</h1>
                        </div>

                        <!-- Profile Info Card -->
                        <div class="bg-white shadow-lg rounded-lg p-8">
                            <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                                <!-- Profile Picture -->
                                <div class="flex-shrink-0">
                                    <img src="<?php echo $user['profile_picture_url']; ?>" alt="User Profile Picture"
                                        class="w-36 h-36 rounded-full border-4  object-cover shadow-lg">
                                </div>

                                <!-- Profile Info -->
                                <div class="text-center md:text-left">
                                    <h3 class="text-2xl font-bold text-gray-900"><?php echo $user['username']; ?></h3>
                                    <p class="mt-2 text-gray-600 font-bold text-sm">Email: 
                                        <span class="text-gray-800 font-medium"><?php echo $user['email']; ?></span>
                                    </p>
                                    <p class="mt-2 text-gray-600 font-bold text-sm">Bio: 
                                        <span class="text-gray-800 font-medium"><?php echo $user['bio']; ?></span>
                                    </p>
                                    <p class="mt-2 text-gray-600 font-bold text-sm">Role: 
                                        <span class="text-gray-800 font-medium"><?php echo $user['role']; ?></span>
                                    </p>

                                    <!-- Edit Profile Button -->
                                    <a href="./forms/updateUser.php?id=<?php echo $user['id']; ?>"
                                        class="mt-6 inline-block bg-yellow-500 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:bg-yellow-600 transition duration-300">
                                        Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

            <!-- /.container-fluid -->

        </div>
        <!-- End of Content Wrapper -->

        <!-- Footer -->
        <?php include './components/footer.php'; ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Page Wrapper -->

</body>

</html>
