<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vente de Tâches</title>
  
    <script type="module">
        import * as pdfjsLib from './mjs/pdfjs-4.3.136-dist/build/pdf.mjs';
        pdfjsLib.GlobalWorkerOptions.workerSrc = './mjs/pdfjs-4.3.136-dist/build/pdf.worker.mjs';


        async function loadPDFData() {
            const fileInput = document.getElementById('pdfInput').files[0];
            if (!fileInput) {
                alert('Veuillez sélectionner un fichier PDF.');
                return;
            }

            const fileReader = new FileReader();
            fileReader.onload = async function () {
                const typedArray = new Uint8Array(this.result);
                const pdf = await pdfjsLib.getDocument({ data: typedArray }).promise;
                let textContent = [];

                for (let i = 1; i <= pdf.numPages; i++) {
                    const page = await pdf.getPage(i);
                    const pageTextContent = await page.getTextContent();
                    textContent.push(...pageTextContent.items);
                }

                console.log(textContent);

                const data = extractDataFromPDF({ items: textContent });
                displayDataInTable(data);
            };
            fileReader.readAsArrayBuffer(fileInput);
        }

        function extractDataFromPDF(textContent) {
    const data = {
        nom: '',
        rate: 0,
        discount: 0,
        discountedRate: 0,
        tasks: [],
        totalWithoutDiscount: 0,
        totalWithDiscount: 0
    };

    let currentTask = {};

    console.log(textContent.items);

    textContent.items.forEach((item) => {
        const text = item.str.trim();
        console.log(`Processing text: ${text}`);

        if (text.startsWith('Nom client/Nom entreprise :')) {
            data.nom = text.split(':')[1].trim();
        } else if (text.startsWith('Taux par jour (EUR) :')) {
            data.rate = parseFloat(text.split(':')[1].trim());
        } else if (text.startsWith('Remise (%) :')) {
            data.discount = parseFloat(text.split(':')[1].trim());
        } else if (text.startsWith('Taux après remise (EUR) :')) {
            data.discountedRate = parseFloat(text.split(':')[1].trim());
        } else if (text.startsWith('Prix total sans remise (EUR):')) {
            data.totalWithoutDiscount = parseFloat(text.split(':')[1].trim().replace('EUR', ''));
        } else if (text.startsWith('Prix total avec remise (EUR):')) {
            data.totalWithDiscount = parseFloat(text.split(':')[1].trim().replace('EUR', ''));
        } else if (text && (text.includes('gestion_de_projet') || text.includes('tests') || text.includes('developpement'))) {
            // Vérification avant d'ajouter une tâche
            if (currentTask.category) {
                console.log('Adding task:', currentTask); // Vérification
                data.tasks.push(currentTask);
            }
            // Initialisation de currentTask avec la nouvelle catégorie
            currentTask = { category: text, task: '', time: 0, costWithoutDiscount: 0, costWithDiscount: 0 };
        } else if (currentTask.category && !currentTask.task && text) {
            currentTask.task = text;
        } else if (currentTask.category && currentTask.task && !currentTask.time && text) {
            currentTask.time = parseFloat(text);
        } else if (currentTask.category && currentTask.task && currentTask.time && !currentTask.costWithoutDiscount && text) {
            currentTask.costWithoutDiscount = parseFloat(text);
        } else if (currentTask.category && currentTask.task && currentTask.time && currentTask.costWithoutDiscount && !currentTask.costWithDiscount && text) {
            currentTask.costWithDiscount = parseFloat(text);
            // Vérification avant d'ajouter une tâche
            console.log('Adding task:', currentTask); // Vérification
            data.tasks.push(currentTask); // Ajout de la tâche
            currentTask = {}; // Réinitialisation
        }
    });

    // Vérification finale si la dernière tâche n'a pas été ajoutée
    if (currentTask.category && currentTask.task && currentTask.time && currentTask.costWithoutDiscount && currentTask.costWithDiscount) {
        console.log('Adding last task:', currentTask);
        data.tasks.push(currentTask);
    }

    console.log('Final tasks:', data.tasks);
    return data;
}



        function displayDataInTable(data) {
    console.log("Displaying data:", data); 

    
    document.getElementById('nom').value = data.nom;
    document.getElementById('rate').value = data.rate;
    document.getElementById('discount').value = data.discount;
    document.getElementById('discountedRate').value = data.discountedRate;

    
    let tableBody = document.getElementById('tasksTable').querySelector('tbody');
    tableBody.innerHTML = ''; 

    if (data.tasks.length === 0) {
        console.log("No tasks to display.");
    }

    data.tasks.forEach(task => {
        console.log("Adding task to table:", task);

        let newRow = tableBody.insertRow();
        let cell1 = newRow.insertCell(0);
        let cell2 = newRow.insertCell(1);
        let cell3 = newRow.insertCell(2);
        let cell4 = newRow.insertCell(3);
        let cell5 = newRow.insertCell(4);

        cell1.innerHTML = `<select onchange="calculateCosts()">
                            <option value="gestion_de_projet" ${task.category === 'gestion_de_projet' ? 'selected' : ''}>Gestion de Projet</option>
                            <option value="tests" ${task.category === 'tests' ? 'selected' : ''}>Tests</option>
                            <option value="developpement" ${task.category === 'developpement' ? 'selected' : ''}>Developpement</option>
                        </select>`;
        cell2.innerHTML = `<input type="text" value="${task.task}" oninput="calculateCosts()">`;
        cell3.innerHTML = `<input type="number" value="${task.time}" oninput="calculateCosts()">`;
        cell4.innerHTML = `${task.costWithoutDiscount}`;
        cell5.innerHTML = `${task.costWithDiscount}`;
    });

    
    document.getElementById('totalWithoutDiscount').innerText = data.totalWithoutDiscount.toFixed(2);
    document.getElementById('totalWithDiscount').innerText = data.totalWithDiscount.toFixed(2);

    console.log("Finished displaying data.");
}


        function calculateCosts() {
            let rate = parseFloat(document.getElementById('rate').value);
            let discount = parseFloat(document.getElementById('discount').value);
            let discountedRate = rate * (1 - discount / 100);
            document.getElementById('discountedRate').value = discountedRate.toFixed(2);

            let rows = document.getElementById('tasksTable').rows;
            let totalWithoutDiscount = 0;
            let totalWithDiscount = 0;

            for (let i = 1; i < rows.length; i++) {
                let hours = parseFloat(rows[i].cells[2].children[0].value);
                if (isNaN(hours)) hours = 0;
                let costWithoutDiscount = rate * hours;
                let costWithDiscount = discountedRate * hours;

                rows[i].cells[3].innerText = costWithoutDiscount.toFixed(2);
                rows[i].cells[4].innerText = costWithDiscount.toFixed(2);

                totalWithoutDiscount += costWithoutDiscount;
                totalWithDiscount += costWithDiscount;
            }

            document.getElementById('totalWithoutDiscount').innerText = totalWithoutDiscount.toFixed(2);
            document.getElementById('totalWithDiscount').innerText = totalWithDiscount.toFixed(2);
        }

        function saveData() {
            let nom = document.getElementById('nom').value;
            let rate = document.getElementById('rate').value;
            let discount = document.getElementById('discount').value;
            let discountedRate = document.getElementById('discountedRate').value;

            let tasks = [];
            let rows = document.getElementById('tasksTable').rows;
            for (let i = 1; i < rows.length; i++) {
                let category = rows[i].cells[0].children[0].value;
                let task = rows[i].cells[1].children[0].value;
                let time = rows[i].cells[2].children[0].value;
                let costWithoutDiscount = parseFloat(rows[i].cells[3].innerText);
                let costWithDiscount = parseFloat(rows[i].cells[4].innerText);
                tasks.push({ category, task, time, costWithoutDiscount, costWithDiscount });
            }

            let formData = new FormData();
            formData.append('nom', nom);
            formData.append('rate', rate);
            formData.append('discount', discount);
            formData.append('discountedRate', discountedRate);
            formData.append('tasks', JSON.stringify(tasks));

            fetch('save.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        }

        function addRow() {
            let table = document.getElementById('tasksTable').getElementsByTagName('tbody')[0];
            let newRow = table.insertRow();

            let cell1 = newRow.insertCell(0);
            let cell2 = newRow.insertCell(1);
            let cell3 = newRow.insertCell(2);
            let cell4 = newRow.insertCell(3);
            let cell5 = newRow.insertCell(4);

            cell1.innerHTML = `<select onchange="calculateCosts()">
                                <option value="gestion_de_projet">Gestion de Projet</option>
                                <option value="tests">Tests</option>
                                <option value="developpement">Developpement</option>
                            </select>`;
            cell2.innerHTML = '<input type="text" oninput="calculateCosts()">';
            cell3.innerHTML = '<input type="number" oninput="calculateCosts()">';
            cell4.innerHTML = '0.00';
            cell5.innerHTML = '0.00';
        }

        function removeRow() {
            let table = document.getElementById('tasksTable').getElementsByTagName('tbody')[0];
            if (table.rows.length > 1) {
                table.deleteRow(-1);
                calculateCosts();
            }
        }

        // Rendre les fonctions globales
        window.loadPDFData = loadPDFData;
        window.calculateCosts = calculateCosts;
        window.saveData = saveData;
        window.addRow = addRow;
        window.removeRow = removeRow;
    </script>
</head>
<body onload="calculateCosts()">
    <h1>Vente de Tâches</h1>
    <form>
        <label for="nom">Nom client/Nom entreprise :</label>
        <input type="text" id="nom" oninput="calculateCosts()">

        <label for="rate">Taux par jour (EUR):</label>
        <input type="number" id="rate" value="100" oninput="calculateCosts()">
        
        <label for="discount">Remise (%):</label>
        <input type="number" id="discount" value="10" oninput="calculateCosts()">
        
        <label for="discountedRate">Taux après remise (EUR):</label>
        <input type="number" id="discountedRate" value="90" readonly>

        <button type="button" onclick="addRow()">Ajouter une ligne</button>
        <button type="button" onclick="removeRow()">Supprimer une ligne</button>
    </form>

    <table id="tasksTable" border="1">
        <thead>
            <tr>
                <th>Catégorie</th>
                <th>Tâche</th>
                <th>Temps (jours)</th>
                <th>Coût sans remise (EUR)</th>
                <th>Coût avec remise (EUR)</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < 5; $i++): ?>  
            <tr>        
                <td>
                    <select onchange="calculateCosts()">                               
                        <option value="gestion_de_projet">Gestion de Projet</option>
                        <option value="tests">Tests</option>
                        <option value="developpement">Developpement</option>
                    </select>
                </td>
                <td><input type="text" oninput="calculateCosts()"></td>
                <td><input type="number" oninput="calculateCosts()"></td>
                <td>0.00</td>
                <td>0.00</td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <h2>Total</h2>
    <p>Prix total sans remise (EUR): <span id="totalWithoutDiscount">0.00</span></p>
    <p>Prix total avec remise (EUR): <span id="totalWithDiscount">0.00</span></p>

    <button onclick="saveData()">Enregistrer</button>

    <h2>Charger un fichier PDF</h2>
    <input type="file" id="pdfInput" accept=".pdf">
    <button type="button" onclick="loadPDFData()">Charger PDF</button>
    <button type="button" onclick="calculateCosts()">Calculer</button>
</body>
</html>
