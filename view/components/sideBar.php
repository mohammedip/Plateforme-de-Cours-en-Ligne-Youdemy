<!-- Sidebar -->
<aside id="sidebar" class="lg:block h-full bg-gray-800 text-white transition-all duration-300 ease-in-out z-40  
lg:w-64 md:w-48 "> <!-- Set different widths for different breakpoints -->
    <!-- Logo Section -->
    <div class="flex items-center justify-center h-16 border-b border-gray-700 bg-gray-900">
        <i class="fa-solid fa-book text-3xl mr-2 text-blue-400"></i>
        <span class="text-xl font-bold">Youdemy</span>
    </div>

    <!-- Navigation -->
    <nav class="mt-6">
        <!-- Dashboard -->
        <div class="mb-2">
            <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/adminDashboard.php" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-200">
                <i class="fas fa-home w-6 text-lg"></i>
                <span class="ml-2">Dashboard</span>
            </a>
        </div>

        <!-- Courses -->
        <div class="mb-2">
            <button class="w-full flex items-center justify-between px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-200">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap w-6 text-lg"></i>
                    <span class="ml-2">Courses</span>
                </div>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="hidden pl-4 mt-2">
                <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/home.php" class="block px-6 py-2 text-gray-400 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-list w-6 text-sm"></i>
                    All Courses
                </a>
                <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/pendingCourses.php" class="block px-6 py-2 text-gray-400 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-hourglass-half w-6 text-sm"></i>
                    Pending Courses
                </a>
            </div>
        </div>

        <!-- Users -->
        <div class="mb-2">
            <button class="w-full flex items-center justify-between px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-200">
                <div class="flex items-center">
                    <i class="fas fa-users w-6 text-lg"></i>
                    <span class="ml-2">Users</span>
                </div>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="hidden pl-4 mt-2">
                <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/allStudents.php" class="block px-6 py-2 text-gray-400 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-user-graduate w-6 text-sm"></i>
                    Students
                </a>
                <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/allTeachers.php" class="block px-6 py-2 text-gray-400 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-chalkboard-teacher w-6 text-sm"></i>
                    Teachers
                </a>
                <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/pendingAccounts.php" class="block px-6 py-2 text-gray-400 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-user-clock w-6 text-sm"></i>
                    Pending Accounts
                </a>
            </div>
        </div>

         <!-- Tags and Categories -->
         <div class="mb-2">
         <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/allCategories.php" class="block px-6 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-folder w-6 text-sm"></i>
                    All Categories
                </a>
                <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/forms/addCategory.php" class="block px-6 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-plus w-6 text-sm"></i>
                    Add Category
                </a>
                <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/allTags.php" class="block px-6 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-tags w-6 text-sm"></i>
                    All Tags
                </a>
                <a href="http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/forms/addTag.php" class="block px-6 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-plus w-6 text-sm"></i>
                    Add Tag
                </a>
        </div>
    </nav>

</aside>

<script>
    // Dropdown menu functionality
    document.querySelectorAll('aside button').forEach(button => {
        button.addEventListener('click', () => {
            const dropdown = button.nextElementSibling;
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        });
    });

    // Profile dropdown functionality
    const profileDropdownBtn = document.getElementById('profileDropdownBtn');
    const profileDropdown = document.getElementById('profileDropdown');

    profileDropdownBtn.addEventListener('click', () => {
        const icon = profileDropdownBtn.querySelector('i');
        icon.style.transform = profileDropdown.classList.contains('hidden') ? 'rotate(180deg)' : 'rotate(0)';
        profileDropdown.classList.toggle('hidden');
    });
</script>
