<!-- Topbar -->
<nav class="bg-white shadow-md flex justify-between items-center p-4">

    <!-- Topbar Search -->
    <form class="sm:flex w-full max-w-xs">
        <div class="flex items-center w-full">
            <input type="text" class="form-control bg-light border-0 rounded-l-lg p-2 w-full" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <button class="bg-blue-500 text-white p-2 rounded-r-lg" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <div class="flex items-center" id="topbarBtn">
        <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/forms/addCours.php" class="block bg-blue-500 rounded-lg p-2 ml-1 text-white  hidden" id="addBtn">
                    Add Courses
        </a>
        <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/enseignantDashboard.php" class="block bg-blue-500 rounded-lg p-2 ml-1 text-white  hidden" id="dashbBtn">
                    My Courses
        </a>
        <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/home.php" class="block bg-blue-500 rounded-lg p-2 ml-1 text-white  " id="homeBtn">
                    Home Page
        </a>
    </div>
    <!-- Topbar Navbar -->
    <div class="flex items-center space-x-4">

        <!-- Divider -->
        <div class="w-px bg-gray-200 h-6 mx-4"></div>

        <!-- User Information -->
        <div class="relative">
            <!-- User Dropdown Trigger -->
            <button class="text-gray-600 flex items-center focus:outline-none" id="userDropdownButton">
                <span class="mr-2 text-sm"><?php echo $_SESSION['user']['username']; ?></span>
                <img class="w-8 h-8 rounded-full" src="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/img/undraw_profile.svg" alt="User Avatar">
            </button>

            <!-- User Dropdown Menu -->
            <div id="userDropdownMenu" class="hidden absolute right-0 bg-white shadow-lg p-4 rounded-lg mt-2 w-64 z-50">
                <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/profile.php?id=<?php echo $_SESSION['user']['id']; ?>" class="block py-2 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="border-t border-gray-200 my-2"></div>
                <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/login.php" class="block py-2 text-gray-600 hover:bg-gray-100" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>

</nav>
<!-- End of Topbar -->

<script>
    // User Dropdown Toggle
    const userDropdownButton = document.getElementById('userDropdownButton');
    const userDropdownMenu = document.getElementById('userDropdownMenu');

    userDropdownButton.addEventListener('click', () => {
        userDropdownMenu.classList.toggle('hidden');
    });

    // Close the dropdown if clicking outside
    document.addEventListener('click', (event) => {
        const isClickInside = userDropdownButton.contains(event.target) || userDropdownMenu.contains(event.target);
        if (!isClickInside) {
            userDropdownMenu.classList.add('hidden');
        }
    });
</script>

<?php

if ($_SESSION['user']['role']=="Enseignant"){
    echo'<script>
    document.getElementById(\'addBtn\').classList.remove(\'hidden\');
    document.getElementById(\'dashbBtn\').classList.remove(\'hidden\');
    </script>';
 }else if ($_SESSION['user']['role']=="Etudiant"){
    echo'<script>
    document.getElementById(\'dashbBtn\').classList.remove(\'hidden\');
    document.getElementById(\'dashbBtn\').href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/etudiantDashboard.php";
    </script>';
 }else if ($_SESSION['user']['role']=="Admin"){
    echo'<script>
    document.getElementById(\'homeBtn\').text="Dashboard";
    document.getElementById(\'homeBtn\').href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/adminDashboard.php";
    </script>';
 }
?>
