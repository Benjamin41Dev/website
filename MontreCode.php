<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ouvrir une Nouvelle Fenêtre</title>
    <style>
        #openButton {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
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
    <button id="openButton">Afficher le Code</button>

    <script>
        document.getElementById('openButton').addEventListener('click', function() {
            var codeContent = `
            <pre>
            &lt;html&gt;
            &lt;head&gt;
            &lt;title&gt;Code Complet&lt;/title&gt;
            &lt;style&gt;
                    #openButton {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
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
    &lt;/style&gt;
&lt;body&gt;
    &lt;button id="toggleButton"&gt;Afficher/Cacher Image&lt;/button&gt;
    &lt;img id="toggleImage" src="votre-image.jpg" alt="Image"&gt;

    &lt;script&gt;
        document.getElementById('toggleButton').addEventListener('click', function() {
            var image = document.getElementById('toggleImage');
            if (image.style.display === 'none') {
                image.style.display = 'block';
            } else {
                image.style.display = 'none';
            }
        });
    &lt;/script&gt;
&lt;/body&gt;
&lt;a href="page_daccueil.php" class="button"&gt;Retour&lt;/a&gt;
&lt;/html&gt;
                    </pre>
                
            `;

            var newWindow = window.open();
            newWindow.document.write(codeContent);
            newWindow.document.close();
        });
    </script>
</body>
<br>

<a href="page_daccueil.php" class="button">Retour</a> 

</html>
