<?php

use App\Cours;
use App\Etudiant;

require_once dirname(__DIR__) . './vendor/autoload.php'; 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Course</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
<?php include './components/topbar.php'; ?>
<div class="min-h-screen flex">
 
    <!-- Main Content -->
    <div class="flex-grow p-6">
        <?php
        $course = Cours::getCourse($_GET['id']);
        foreach ($course as $course): ?>
        <div class="bg-white rounded-lg shadow-lg p-8">
            <!-- Course Title -->
            <h1 class="text-3xl font-bold text-gray-900 mb-4"> <?php echo $course['title']; ?></h1>

            <!-- Course Meta -->
            <div class="text-gray-600 text-sm mb-6">
                <span class="mr-4"><strong>Category:</strong> <?php echo $course['name']; ?></span>
                <span><strong>Created At:</strong> <?php echo date('F j, Y', strtotime($course['created_at'])); ?></span>
            </div>

            <!-- Course Description -->
            <div class="prose prose-lg text-gray-800 mb-6">
                <h3 class="text-xl font-semibold">Description</h3>
                <p><?php echo nl2br($course['description']); ?></p>
            </div>

            <div class="flex flex-wrap gap-2 mb-6">
                  <?php
                  $tags = explode(', ', $course['tags']);
                  foreach ($tags as $tag):
                  ?>
                      <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full hover:bg-green-200 transition duration-200">
                          <?php echo $tag; ?>
                      </span>
                  <?php endforeach; ?>
             </div>
            <!-- Course Content -->
            <div class="prose prose-lg text-gray-800 mb-6">
                <h3 class="text-xl font-semibold mb-4">Content : </h3>

                <?php if(empty($course['contenu_video'])):?>
                    <p><?php echo $course['contenu']; ?></p>

                <?php elseif(empty($course['contenu'])): ?>

                    <iframe width="560" height="315" src="<?php echo $course['contenu_video']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <?php endif; ?>
            </div>

            <?php
         if ($_SESSION['user']['role'] === 'Etudiant'):
         ?>
            <div class="flex items-center space-x-4 mb-6">
                <span class="px-4 py-2 rounded-full text-sm text-white <?php echo $course['status'] === 'complet' ? 'bg-green-500' : 'bg-red-500'; ?>">
                    <?php echo $course['status']; ?>
                </span>
            </div>
            <?php endif; ?>
            
            <div>
            <a href="etudiantDashboard.php" class="inline-block mt-8 bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
                Back to the Courses
            </a>
                <?php
                    if ($_SESSION['user']['role'] === 'Etudiant'):
                        $etudiant = new Etudiant;
                        $courses = $etudiant->getInscription($_SESSION["user"]['id']);
                        $isEnrolled = false;
                        foreach ($courses as $cours):
                        if($cours["cours_id"]==$course['id'] && $cours["etudiant_id"]==$_SESSION["user"]['id']):  $isEnrolled = true;  
                ?>
                    <a href="../model/Etudiant.php?action=completCours&userId=<?php echo $_SESSION["user"]['id'] ;?>&coursId=<?php echo $course['id'] ;?>" class="inline-block mt-8 bg-green-600 text-white px-6 py-3 rounded-lg shadow hover:bg-green-700 transition">
                        Complet le Cours
                    </a>
                    <?php break; ?> 
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if(!$isEnrolled): ?>
                     <a href="../model/Etudiant.php?action=inscription&userId=<?php echo $_SESSION["user"]['id'] ;?>&coursId=<?php echo $course['id'] ;?>" class="inline-block mt-8 bg-green-600 text-white px-6 py-3 rounded-lg shadow hover:bg-green-700 transition">
                    Inscrire au Cours
                    </a>
                   
                <?php endif; ?>
                <?php endif; ?>
        </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
