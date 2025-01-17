<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
use App\Enseignant;

require_once '../vendor/autoload.php';
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enseignant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Page Wrapper -->
    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white fixed h-screen">
            <?php include './components/sidebar.php'; ?>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64 flex flex-col">

            <!-- Topbar -->
            <?php include './components/topbar.php'; ?>

            <!-- Content -->
            <div class="p-6 flex-grow">

                <!-- Table Card -->
                <div class="bg-white shadow-md rounded-lg">
                    <div class="p-4 border-b">
                        <h2 class="text-lg font-bold text-gray-800">All Enseignant</h2>
                    </div>
                    <div class="p-4 overflow-x-auto">
                        <table class="table-auto w-full text-left border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-50 text-gray-700">
                                    <th class="px-4 py-2 border">Id</th>
                                    <th class="px-4 py-2 border">Name</th>
                                    <th class="px-4 py-2 border">Email</th>
                                    <th class="px-4 py-2 border">Bio</th>
                                    <th class="px-4 py-2 border">Validation</th>
                                    <th class="px-4 py-2 border">Statut</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $enseignants = Enseignant::getAllMembers();
                                foreach ($enseignants as $enseignant) {
                                    echo '
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-4 py-2 border">' . $enseignant['id'] . '</td>
                                        <td class="px-4 py-2 border">' . $enseignant['username'] . '</td>
                                        <td class="px-4 py-2 border">' . $enseignant['email'] . '</td>
                                        <td class="px-4 py-2 border">' . $enseignant['bio'] . '</td>
                                        <td class="px-4 py-2 border">' . $enseignant['validCompte'] . '</td>
                                        <td class="px-4 py-2 border">' . $enseignant['statutCompte'] . '</td>
                                        <td class="px-4 py-2 border">
                                            <a href="../model/Admin.php?statut=activate&role=enseignant&id=' . $enseignant['id'] . '"
                                            class="px-4 py-2 border border-green-500 text-white bg-green-500  rounded-lg mx-2">
                                            Activate
                                            </a>
                                            <a href="../model/Admin.php?statut=suspend&role=enseignant&id=' . $enseignant['id'] . '"
                                            class="px-4 py-2 border border-yellow-500 text-white bg-yellow-500  rounded-lg mx-2">
                                            Suspend
                                            </a>
                                            <a href="../model/Admin.php?statut=delete&role=enseignant&id=' . $enseignant['id'] . '"
                                            class="px-4 py-2 border border-red-500 text-white bg-red-500  rounded-lg mx-2">
                                            Delete
                                            </a>
                                        </td>
                                    </tr>';
                                } ?>
                            </tbody>
                        </table>
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
