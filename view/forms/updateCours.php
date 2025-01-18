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
} else if ($_SESSION['user']['role'] === 'Admin') {
    header("Location: http://localhost/Plateforme-de-Cours-en-Ligne-Youdemy/view/adminDashboard.php");
}

use App\Category;
use App\Cours;
use App\Tag;

require_once '../../vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update un Cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Main Content Wrapper -->
    <div class="flex flex-col w-full">

        <!-- Topbar -->
        <?php include '../components/topbar.php'; ?>

        <!-- Main Content -->
        <div class="container mx-auto mt-10">

            <!-- Form Wrapper -->
            <div class="bg-white shadow-md rounded-lg max-w-5xl mx-auto">

                <!-- Header -->
                <div class="bg-yellow-500 text-white text-center py-4 rounded-t-lg">
                    <h1 class="text-2xl font-bold">Update Cours</h1>
                </div>

                <!-- Form -->
                <form action="../../model/Cours.php?action=update" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">

                    <!-- Title Input -->
                    <div>
                        <label for="title" class="block text-gray-700 font-medium mb-2">Titre du Cours :</label>
                        <input type="text" id="title" name="title" placeholder="Entrez le titre du cours"
                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                        <input type="text" id="id" name="id" class ="hidden">
                    </div>

                    <!-- Description and Contenu -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-gray-700 font-medium mb-2">Description :</label>
                            <textarea id="description" name="description" rows="4" placeholder="Entrez la description du cours"
                                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required></textarea>
                        </div>
                        <!-- Contenu -->
                        <div>
                                <label for="contenu_type" class="block text-gray-700 font-medium mb-2">Contenu Type :</label>
                                <select id="contenu_type" name="contenu_type"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" >
                                    <option value="" disabled selected hidden>Sélectionner un type</option>
                                    <option value="Documment">Documment</option>
                                    <option value="Video">Video</option>
                                </select>
                            </div>
                    </div>

                    <div class="hidden" id="contenuInput">
                            <label for="contenu" class="block text-gray-700 font-medium mb-2">Contenu :</label>
                            <textarea id="contenu" name="contenu" rows="4" placeholder="Entrez le contenu"
                                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"></textarea>
                    </div>
                    <!-- Contenu Vidéo Input -->
                    <div class="hidden" id="videoInput">
                        <label for="contenu_video" class="block text-gray-700 font-medium mb-2">Vidéo URL :</label>
                        <input type="text" id="contenu_video" name="contenu_video" placeholder="Entrez un video url"
                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" >
                    </div>
                    <!-- Tags and Selects Container -->
                    <div class="flex flex-wrap justify-between gap-6">
                        <!-- Tags Section -->

                        <div class="w-full md:w-1/3">
                            <div class="mb-6">
                                <label class="block text-gray-700 font-medium mb-2">Tags:</label>
                                <div class="space-y-2">
                                    <?php
                                    $tags = Tag::getAllTags();
                                    $articleTags = Cours::getCoursTagsById($_GET['id']);
                                    $articleTagNames=[];
                                    foreach ($articleTags as $articleTag) {
                                        array_push($articleTagNames,$articleTag['tag_name']);
                                    }
                                    foreach ($tags as $tag): ?>
                                        <div class="flex items-center">
                                            <input class="form-checkbox h-5 w-5 text-blue-500" type="checkbox" id="tag_<?php echo $tag['id']; ?>" name="tag_id[]" value="<?php echo $tag['id']; ?>"
                                                <?php echo in_array($tag['name'], $articleTagNames) ? 'checked' : ''; ?>>
                                            <label class="ml-2 text-gray-700" for="tag_<?php echo $tag['id']; ?>">
                                                <?php echo htmlspecialchars($tag['name']); ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Selects Section -->
                        <div class="w-full md:w-1/2 space-y-6">
                        
                            <!-- Category -->
                            <div>
                                <label for="category_id" class="block text-gray-700 font-medium mb-2">Catégorie :</label>
                                <select id="category_id" name="category_id"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                                    <option value="" disabled selected hidden>Sélectionner une catégorie</option>
                                    <?php
                                    $categories = Category::getAllCategories();
                                    foreach ($categories as $categorie) {
                                        echo '<option value="' . $categorie['id'] . '">' . $categorie['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600">
                            Update
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <!-- Footer -->
         <div class="mt-4">
            <?php include '../components/footer.php'; ?>
        </div>
    </div>

<?php

$cours = Cours::getCoursById($_GET['id']);
foreach ($cours as $cours) {
    echo '
    <script>
    document.getElementById("title").value = "' . $cours['title'] . '";
    document.getElementById("id").value = "' . $_GET['id'] . '";
    document.getElementById("description").value = "' . $cours['description'] . '";
    document.getElementById("contenu").value = "' . $cours['contenu'] . '";
    document.getElementById("contenu_video").value = "' . $cours['contenu_video'] . '";
    document.getElementById("category_id").value = "' . $cours['category_id'] . '";

    if(document.getElementById("contenu").value === ""){

        document.getElementById("videoInput").classList="";
    }else if(document.getElementById("contenu_video").value === ""){
    
        document.getElementById("contenuInput").classList=""
    }
    </script>
    ';
}
?>
<script>
    document.getElementById("contenu_type").addEventListener("change", function () {
if(this.value==="Video"){

    document.getElementById("contenuInput").classList="hidden";
    document.getElementById("contenu").value="";
    document.getElementById("videoInput").classList="";

}else if(this.value==="Documment"){

    document.getElementById("videoInput").classList="hidden";
    document.getElementById("contenu_video").value="";
    document.getElementById("contenuInput").classList="";
}
    });
</script> 
</body>
</html>
