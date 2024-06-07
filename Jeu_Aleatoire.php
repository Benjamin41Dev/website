<?php
session_start();

// Générer une séquence aléatoire de 4 boutons (1 à 9)
if (!isset($_SESSION['sequence'])) {
    $sequence = array();
    for ($i = 0; $i < 4; $i++) {
        $sequence[] = rand(1, 9);
    }
    $_SESSION['sequence'] = $sequence;
    $_SESSION['current_step'] = 0;
} else {
    $sequence = $_SESSION['sequence'];
    $current_step = $_SESSION['current_step'];
}

// Vérifier si la séquence est complétée
$message = '';
if (isset($_POST['button'])) {
    $user_input = intval($_POST['button']);
    $expected_input = $sequence[$_SESSION['current_step']];
    if ($user_input == $expected_input) {
        $_SESSION['current_step']++;
        if ($_SESSION['current_step'] == count($sequence)) {
            $message = "Gagné !";
            session_destroy(); // Réinitialiser le jeu
        }
    } else {
        $message = "Perdu !";
        session_destroy(); // Réinitialiser le jeu
    }
}

// Réinitialiser le jeu
if (isset($_POST['restart'])) {
    session_destroy();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu de séquence</title>
    <style>
        .button {
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
        }
        .highlight {
            background-color: yellow;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            max-width: 200px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1>Jeu de séquence</h1>
    <?php if ($message) { echo "<h2>$message</h2>"; } ?>

    <?php if (!$message) { ?>
        <button class="button" onclick="startGame()">Commencer</button>

        <form method="POST" id="gameForm">
            <div class="grid-container">
                <?php for ($i = 1; $i <= 9; $i++) { ?>
                    <button type="submit" name="button" value="<?php echo $i; ?>" class="button" id="button_<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </button>
                <?php } ?>
            </div>
        </form>
    <?php } else { ?>
        <form method="POST">
            <button type="submit" name="restart" class="button">Recommencer</button>
        </form>
    <?php } ?>

    <script>
        var sequence = <?php echo json_encode($sequence); ?>;
        var currentStep = 0;

        function startGame() {
            playSequence();
        }

        function playSequence() {
            if (currentStep < sequence.length) {
                var buttonId = sequence[currentStep];
                var button = document.getElementById('button_' + buttonId);
                button.classList.add('highlight');
                setTimeout(function() {
                    button.classList.remove('highlight');
                    currentStep++;
                    setTimeout(playSequence, 500); // Intervalle de 500ms entre chaque bouton
                }, 1000); // Temps d'affichage de chaque bouton : 1000ms
            }
        }
    </script>
</body>
</html>
