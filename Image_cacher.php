<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher/Cacher Image</title>
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
        #toggleButton { /* Bouton Afficher/cacher le code */
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        #toggleImage { 
            display: none; 
            max-width: 100%;
            height: auto;
        }
        #openButton {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <button id="toggleButton">Afficher/Cacher l'image</button>
    <img id="toggleImage" src="images/image_coucou.png" alt="Image">

    <script>
        document.getElementById('toggleButton').addEventListener('click', function() {
            var image = document.getElementById('toggleImage');
            if (image.style.display === 'none') {
                image.style.display = 'block';
            } else {
                image.style.display = 'none';
            }
        });
    </script>
        <button id="openButton">Afficher le Code</button>

<script>
    document.getElementById('openButton').addEventListener('click', function() {
        var codeContent = `
        <pre>

        &lt;!DOCTYPE html&gt;
&lt;html lang="fr"&gt;
&lt;head&gt;
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
    &lt;title&gt;Afficher/Cacher Image&lt;/title&gt;
    &lt;style&gt;
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
        #toggleButton { /* Bouton Afficher/cacher le code */
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        #toggleImage { 
            display: none; /* L'image est cachée par défaut */
            max-width: 100%;
            height: auto;
        }
        #openButton {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;button id="toggleButton"&gt;Afficher/Cacher l'image&lt;/button&gt;
    &lt;img id="toggleImage" src="images/image_coucou.png" alt="Image"&gt;

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
        &lt;button id="openButton"&gt;Afficher le Code&lt;/button&gt;

&lt;script&gt;
    document.getElementById('openButton').addEventListener('click', function() {
        var codeContent = 

        
        

var newWindow = window.open();
newWindow.document.write(codeContent);
newWindow.document.close();
});
&lt;/script&gt;
&lt;/body&gt;

&lt;a href="page_daccueil.php" class="button"&gt;Retour&lt;/a&gt;



&lt;/html&gt;


        <pre>
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
