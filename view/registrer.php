<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Registre</title>
</head>
<body class="bg-gray-100">
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
              class="bg-gray-600 text-white px-4 py-2 rounded-r-lg hover:bg-gray-700 transition duration-300">
              <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </form>

      <!-- Navigation Buttons -->
      <div class="flex items-center justify-between space-x-4">
        <a href="#" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition duration-300">
          Home page
        </a>

        <a href="#" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition duration-300 hidden">
          Sign in
        </a>

        <a href="#" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition duration-300 hidden">
          Sign up
        </a>
      </div>
    </div>
  </nav>

  <!-- Registration Form -->
  <div class="flex items-center justify-center mt-4">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
      <h1 class="text-3xl font-bold text-center text-gray-800">Welcome!</h1>
      <p class="text-center text-gray-600 mb-6">
        Welcome to our study platform, where learning meets success.
      </p>
      <form class="space-y-4" action="" method="POST" id="form">
        <!-- Name and Email -->
        <div class="grid grid-cols-2 gap-4">
          <input 
            type="text" 
            placeholder="Name" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent"
            name="username"
          />
          <input 
            type="email" 
            placeholder="Email" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent" 
            name="email"
          />
        </div>

        <!-- Password and Profile URL -->
        <div class="grid grid-cols-2 gap-4">
          <input 
            type="password" 
            placeholder="Password" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent" 
            name="password_hash"
          />
          <input 
            type="url" 
            placeholder="Profile URL" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent" 
            name="profile_picture_url"
          />
        </div>

        <!-- Phone -->
        <div>
          <input type="text" id="phone-input" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"  
            placeholder="123-456-7890" name="phone" required />
        </div>

        <!-- Role -->
        <div class="flex space-x-6">
          <div class="flex items-center space-x-2 group ml-10 mr-10">
            <input id="role-teacher" type="radio" value="../model/Enseignant.php" 
              class="hidden peer" name="role">
            <label for="role-teacher" 
              class="flex items-center px-3 py-2 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-lg cursor-pointer group-hover:bg-gray-200 peer-checked:bg-gray-600 peer-checked:text-white transition-all duration-300">
              Enseignant
            </label>
          </div>
          <div class="flex items-center space-x-2 group">
            <input id="role-student" type="radio" value="../model/Etudiant.php" 
              class="hidden peer" name="role">
            <label for="role-student" 
              class="flex items-center px-3 py-2 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-lg cursor-pointer group-hover:bg-gray-200 peer-checked:bg-gray-600 peer-checked:text-white transition-all duration-300">
              Etudient
            </label>
          </div>
        </div>

        <!-- Bio -->
        <div>
          <textarea id="bio" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500" 
            placeholder="Write about yourself ..." name="bio"></textarea>
        </div>

        <!-- Terms -->
        <div class="flex items-center">
          <input id="terms" type="checkbox" class="h-4 w-4 text-gray-600 focus:ring-2 focus:ring-gray-500 border-gray-300 rounded" />
          <label for="terms" class="ml-2 block text-gray-700">
            I agree to the <a href="#" class="text-blue-600">Terms and Conditions</a>
          </label>
        </div>

        <!-- Submit -->
        <button 
          type="submit" 
          class="w-full bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition duration-300">
          Sign Up
        </button>
      </form>

      <p class="text-center text-gray-600 mt-4">
        Already have an account? 
        <a href="login.php" class="text-blue-600 hover:underline">Sign in</a>
      </p>
    </div>
  </div>
  
  <!-- Script -->
  <?php 
    echo '
    <script>
      window.addEventListener(\'submit\', (event) => {
        let role = document.querySelector("input[name=\'role\']:checked").value;
        document.getElementById("form").action = role + "?action=register";
      })
    </script>';
  ?>
</body>
</html>
