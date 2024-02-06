    <?php 
    ob_start();
    include '../partials/header.php';
    
    include '../config/pdo.php';

    include '../utils/functions.php';

    // On vérifie si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        
        // On vérifie si les champs sont vides
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm'])){

            $name = htmlspecialchars($_POST['name']);
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];
            
            if ($password === $confirm) {
            
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) { 
                
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    
                    if (checkExists('Nom', $name, $pdo)) {
                        $error = "Le nom existe déjà";
                    } elseif (checkExists('email', $email, $pdo))
                        $error = "L'email existe déjà";


                    //Vérifier si le nom et l'email ne sont pas déjà en BDD
                    $sql = "SELECT * FROM users WHERE Nom = ? OR email = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$name, $email]);

                    if ($stmt->rowCount() > 0) {
                        $error = "Le nom ou l'email existe déjà";
                    }
                } else {
                    // On écrit notre requete préparée
                    $sql = "INSERT INTO users(name, email, password) VALUES(?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $result = $stmt->execute([$name, $email, $hash]);
           
                    // Si notre execute s'est bien déroulé on redirige vers une page de succès
                    if ($result) {
                        header('Location: signup-success.view.php');
                        ob_end_flush();
                    // Sinon on affiche l'erreur en question
                    } else {
                        $error = "Erreur lors de l'ajout : " . print_r($stmt->errorInfo());
                    }
                }
                } else {
                    $error = "L'email n'est pas au bon format";
                }
            } else {
                $error = 'Les mots de passe ne correspondent pas';
            }
        } else {
            $error = 'Veuillez remplir tous les champs';
        }

     // Si notre execute s'est bien déroulé on redirige vers la page de succès
    
    ?>


    <h1>Sign-up</h1>

    <form  method="POST" class="signup-form">
        <input type="text" name="name" placeholder="Votre pseudo...">
        <input type="email" name="email" placeholder="john.doe@email.com">
        <input type="password" name="password" placeholder="Votre mot de passe">
        <input type="password" name="confirm" placeholder=" Confirmez votre mdp">
        <input type="submit" name="submit" value="signup">
    </form>

    <?php if (isset($error)) : ?>
        <p class="error"><?= $error ?></p>
    <?php endif?>
    
    <?php 
    
    include '../partials/footer.php'; 
    
    ?>
   



