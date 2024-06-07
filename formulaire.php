<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <style>
        .button { /* Bouton Retour */
	box-shadow:inset 0px 0px 0px 0px #000000;
	background:linear-gradient(to bottom, #f0f0f0 5%, #dbdbdb 100%);
	background-color:#f0f0f0;
	border-radius:6px;
	border:1px solid #000000;
	display:inline-block;
	cursor:pointer;
	color:#666666;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0px 1px 0px #fffcff;
}
    </style>
</head>
<body>

<h2>Formulaire d'inscription</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["telephone"]) && !empty($_POST["pays"]) && !empty($_POST["email"])) {
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $telephone = htmlspecialchars($_POST["telephone"]);
        $pays = htmlspecialchars($_POST["pays"]);
        $email = htmlspecialchars($_POST["email"]);

        // Enregistre dans le dossier data.txt
        $file = 'data.txt';
        $current = file_get_contents($file);
        $current .= "$nom|$prenom|$telephone|$pays|$email\n";
        file_put_contents($file, $current);

        echo "Vos informations ont été soumises avec succès.";
    } else {
        echo "Tous les champs sont requis.";
    }
}
?>

<form action="formulaire.php" method="post">
    <label for="nom">Nom :</label><br>
    <input type="text" id="nom" name="nom"><br><br>
    
    <label for="prenom">Prénom :</label><br>
    <input type="text" id="prenom" name="prenom"><br><br>
    
    <label for="telephone">Numéro de téléphone :</label><br>
    <input type="text" id="telephone" name="telephone"><br><br>
    
    <label for="pays">Pays :</label><br>
    <input type="text" id="pays" name="pays"><br><br>
    
    <label for="email">Email :</label><br>
    <input type="email" id="email" name="email"><br><br>
    
    <input type="submit" value="Soumettre">
</form>
<br><br>

<a href="page_daccueil.php" class="button">Retour</a>

<a href="data.php" class="button">Voir tous les inscrits</a>


</body>
</html>
