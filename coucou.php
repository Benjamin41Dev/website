<html>

<head>
    <title>Page coucou</title>
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
#openButton { /* Bouton Afficher le Code*/
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
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
    &lt;title&gt;Page coucou&lt;/title&gt;
    &lt;link href="Bordure.css" rel="stylesheet"&gt;
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
#openButton { /* Bouton Afficher le Code*/
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
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

&lt;?php
echo 'coucou &lt;br&gt;';

?&gt;

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

<?php
echo 'coucou <br>';

?>

<a href="page_daccueil.php" class="button">Retour</a> 

<html>