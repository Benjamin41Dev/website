<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}


session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des inscrits</title>
</head>
<body>

<h2>Liste des inscrits</h2>

<?php
$file = 'data.txt';
if (file_exists($file)) {
    $data = file($file);

    echo "<table border='1'>";
    echo "<tr><th>Nom</th><th>Prénom</th><th>Téléphone</th><th>Pays</th><th>Email</th></tr>";

    foreach ($data as $line) {
        list($nom, $prenom, $telephone, $pays, $email) = explode('|', trim($line));
        echo "<tr><td>$nom</td><td>$prenom</td><td>$telephone</td><td>$pays</td><td>$email</td></tr>";
    }

    echo "</table>";
} else {
    echo "Aucune donnée disponible.";
}
?>
<br><br>


</body>
</html>
