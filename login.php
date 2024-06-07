<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // info pour ce connecter 
    $valid_username = "admin";
    $valid_password = "admin";

    if ($username == $valid_username && $password == $valid_password) {
        $_SESSION['loggedin'] = true;
        header("Location: data.php");
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

<h2>Connexion</h2>

<?php
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>

<form action="login.php" method="post">
    <label for="username">Nom d'utilisateur :</label><br>
    <input type="text" id="username" name="username"><br><br>
    
    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password"><br><br>
    
    <input type="submit" value="Se connecter">
</form>

</body>
</html>
