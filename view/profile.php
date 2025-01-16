<?php


use App\Utilisateur; 

require_once '../vendor/autoload.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
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
                    <h1 class="text-2xl font-bold text-gray-800">Profile</h1>
                </div>

                <!-- Profile Info Card -->
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-6">
                        <!-- Profile Picture -->
                        <div class="flex-shrink-0 text-center">
                            <img src="<?php echo $user['profile_picture_url']; ?>" alt="User Profile Picture"
                                class="w-32 h-32 rounded-full object-cover">
                        </div>

                        <!-- Profile Info -->
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900"><?php echo $user['username']; ?></h3>
                            <p class="text-gray-700">Email: <?php echo $user['email']; ?></p>
                            <p class="text-gray-700">Bio: <?php echo $user['bio']; ?></p>
                            <p class="text-gray-700">Role: <?php echo $user['role']; ?></p>

                            <!-- Edit Profile Button -->
                            <a href="../Forms/UserUpdate.php?id=<?php echo $user['id']; ?>"
                                class="mt-4 inline-block bg-yellow-400 text-white font-medium py-2 px-4 rounded hover:bg-yellow-500">Edit Profile</a>
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
