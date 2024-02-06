<?php 

ob_start();

include '../partials/header.php'; 
session_start();
ob_end_flush();

?>

<div class="wrapper">
    <h1>Profil de <?= $_SESSION['user']['Nom'] ?></h1>
    <h2>Votre adresse mail : <?= $_SESSION['user']['email'] ?></h2>

    <img id="avatar" class="profile-avatar" src="../uploads/avatar.jpg" alt="">
</div>

<?php include '../partials/footer.php' ?>
