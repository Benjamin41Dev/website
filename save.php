
<?php



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure FPDF
require('fpdf.php');



class PDF extends FPDF
{

    function Header()
    {
        $this->Image('images/logomgs.png', 10, 6, 30); 
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(80);
        $this->Cell(30, 10, 'Fiche de Ventes', 0, 0, 'C');
        $this->Ln(40);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Récupérer les données du formulaire
$data = $_POST;
date_default_timezone_set('Europe/Paris');
$date1 = new DateTime();
$date1 = $date1->format("d/m/y");
$date2 = new DateTime();
$date2 = $date2->format("H:i:s");

$nom = $data['nom'];
$rate = $data['rate'];
$discount = $data['discount'];
$discountedRate = $data['discountedRate'];
$tasks = json_decode($data['tasks'], true);

// Enlever les lignes vides
$tasks = array_filter($tasks, function($task) {
    return !empty($task['task']);
    return!empty($task['time']);
});

// Calculer les prix totaux
$totalWithoutDiscount = 0;
$totalWithDiscount = 0;
foreach ($tasks as $task) {
    $totalWithoutDiscount += $task['costWithoutDiscount'];
    $totalWithDiscount += $task['costWithDiscount'];
}

// Fonction pour convertir les chaînes en ISO-8859-1
function convertToIso($str) {
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $str);
}

// Créer le fichier PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);




// Informations générales
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, convertToIso("Nom client/Nom entreprise : $nom"), 0, 1);
$pdf->Cell(0, 10, convertToIso("Date : $date1 à $date2"), 0, 1);
$pdf->Cell(0, 10, convertToIso("Taux par jour (€) : $rate"), 0, 1);
$pdf->Cell(0, 10, convertToIso("Remise (%) : $discount"), 0, 1);
$pdf->Cell(0, 10, convertToIso("Taux après remise (€) : $discountedRate"), 0, 1);
$pdf->Ln(10);

// Tableau des tâches
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, convertToIso('Catégorie'), 1);
$pdf->Cell(45, 10, convertToIso('Tâche'), 1);
$pdf->Cell(30, 10, convertToIso('Temps (jours)'), 1);
$pdf->Cell(40, 10, convertToIso('Coût sans remise '), 1);
$pdf->Cell(40, 10, convertToIso('Coût avec remise '), 1);
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
foreach ($tasks as $task) {
    $pdf->Cell(40, 10, convertToIso($task['category']), 1);
    $pdf->Cell(45, 10, convertToIso($task['task']), 1);
    $pdf->Cell(30, 10, convertToIso($task['time']), 1);
    $pdf->Cell(40, 10, convertToIso($task['costWithoutDiscount']), 1);
    $pdf->Cell(40, 10, convertToIso($task['costWithDiscount']), 1);
    $pdf->Ln(10);
}

// Totaux
$pdf->Ln(10);
$pdf->Cell(0, 10, convertToIso("Prix total sans remise (€): $totalWithoutDiscount"), 0, 1);
$pdf->Cell(0, 10, convertToIso("Prix total avec remise (€): $totalWithDiscount"), 0, 1);

// Générer un nom de fichier unique
$directory = 'C:/sites benjamin/demo.local/vente';
$filename = $directory . '/ventes_' . uniqid() . '.pdf';

// Enregistrer le fichier PDF
$pdf->Output('F', $filename);

if (file_exists($filename)) {
    echo "Les données ont été enregistrées avec succès dans le fichier $filename";
} else {
    echo "Une erreur s'est produite lors de l'enregistrement des données.";
}


?>
