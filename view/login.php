<?php 
session_start();
session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Log in</title>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
  <!-- Topbar -->
  <nav class="w-full bg-gray-800 text-white px-6 py-4 shadow-md">
    <div class="container mx-auto flex items-center justify-between">
      <!-- Logo -->
      <div class="text-lg font-semibold">
        Udemy
      </div>

      <!-- Navigation Links -->
      <form method="GET" class="hidden sm:inline-block form-inline w-full max-w-md ml-5">
          <div class="flex items-center hidden">
              <input 
                  type="text" 
                  name="search" 
                  class="flex-grow bg-gray-100 border border-gray-300 rounded-l-lg py-2 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent" 
                  placeholder="Search for..." 
                  aria-label="Search" 
                  aria-describedby="basic-addon2">
              <button 
                  type="submit" 
                  class="bg-gray-600 text-white px-4 py-2 rounded-r-lg hover:bg-gray-700 transition duration-300 ">
                  <i class="fas fa-search fa-sm"></i>
              </button>
          </div>
      </form>
      <!-- Sign Up Button -->
      <div class="flex items-center justify-between space-x-4">
        <a href="home.php" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition duration-300 ">
          Home page
        </a>
     
        <a href="login.php" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition duration-300 hidden">
          Sign in
        </a>
      
        <a href="registrer.php" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition duration-300 hidden">
          Sign up
        </a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="flex-grow flex items-center justify-center">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
      <h1 class="text-3xl font-bold text-center text-gray-800 mb-4">Welcome!</h1>
      <p class="text-center text-gray-600 mb-6">
        Welcome to our study platform, where learning meets success.
      </p>

      <form class="space-y-4" action="../model/Utilisateur.php?action=login" method="POST">
        <div>
          <input 
            type="email" 
            placeholder="Email" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent"
            name="email"/>
        </div>
        <div>
          <input 
            type="password" 
            placeholder="Password" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent"
            name="password_hash"/>
        </div>
        <div id="error-message" class="hidden bg-red-500 text-white p-4 rounded" role="alert">
          Password or email is incorrect.
        </div>
        <button 
          type="submit" 
          class="w-full bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition duration-300">
          Sign In
        </button>
      </form>

      <p class="text-center text-gray-600 mt-4">
        You don't have an account? 
        <a href="registrer.php" class="text-blue-600 hover:underline">Sign Up</a>
      </p>
    </div>
  </main>

  <!-- PHP Script -->
  <?php
  if (isset($_GET['action']) && $_GET['action'] == 'erreur') {
      echo "<script>
          document.getElementById('error-message').classList.remove('hidden');
      </script>";
  }
  ?>
</body>
</html>
