<html>

<head>
    <title>Tableau_HTML</title>
    <link href="Bordure.css" rel="stylesheet">
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
#openButton {
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
    &lt;title&gt;Tableau_HTML&lt;/title&gt;
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
#openButton {
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
            &lt;pre&gt;

            &lt;/pre&gt;
                
            

            var newWindow = window.open();
            newWindow.document.write(codeContent);
            newWindow.document.close();
        });
    &lt;/script&gt;
&lt;/body&gt;

&lt;table&gt;
    &lt;caption&gt;Information client&lt;/caption&gt;
    &lt;tr&gt;
        &lt;th&gt;Prenom&lt;/th&gt;
        &lt;th&gt;Nom&lt;/th&gt;
        &lt;th&gt;Age&lt;/th&gt;
        &lt;th&gt;Pays&lt;/th&gt;
    &lt;/tr&gt;
    &lt;tr&gt;
        &lt;td&gt;Jean&lt;/td&gt;
        &lt;td&gt;Kevin&lt;/td&gt;
        &lt;td&gt;28 ans&lt;/td&gt;
        &lt;td&gt;France&lt;/td&gt;
    &lt;/tr&gt;
    &lt;tr&gt;
        &lt;td&gt;Benjamin&lt;/td&gt;
        &lt;td&gt;Doussaud&lt;/td&gt;
        &lt;td&gt;19 ans&lt;/td&gt;
        &lt;td&gt;France&lt;/td&gt;
    &lt;/tr&gt;
    &lt;tr&gt;
        &lt;td&gt;Bertrand&lt;/td&gt;
        &lt;td&gt;Germain&lt;/td&gt;
        &lt;td&gt;52 ans&lt;/td&gt;
        &lt;td&gt;Espagne&lt;/td&gt;
    &lt;/tr&gt;
&lt;/table&gt;

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

<table>
    <caption>Information client</caption>
<tr>
        <th>Prenom</th>
        <th>Nom</th>
        <th>Age</th>
        <th>Pays</th>
    </tr>
    <tr>
        <td>Jean</td>
        <td>Kevin</td>
        <td>28 ans</td>
        <td>France</td>
    </tr>
    <tr>
        <td>Benjamin</td>
        <td>Doussaud</td>
        <td>19 ans</td>
        <td>France</td>
    </tr>
    <tr>
        <td>Bertrand</td>
        <td>Germain</td>
        <td>52 ans</td>
        <td>Espagne</td>
    </tr>
</table>

<a href="page_daccueil.php" class="button">Retour</a>

<html>