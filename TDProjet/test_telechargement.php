<?php
require_once('tcpdf/tcpdf.php');
require("script/phpfonction.php");
// Créez une instance de TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// Définissez les informations du document
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Auteur du document');
$pdf->SetTitle('Titre du document');
$pdf->SetSubject('Sujet du document');
$pdf->SetKeywords('Mots-clés du document');

// Définissez les marges
$pdf->SetMargins(10, 10, 10);

// Ajoutez une nouvelle page
$pdf->AddPage();

// Obtenez les informations pour le carnet de compétences
$nom = 'John Doe';
$competences = 'Compétence 1, Compétence 2, Compétence 3';

// Générez le contenu PDF
$html = affichage();

// Convertissez le contenu HTML en PDF
$pdf->writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='');

// Générez le nom du fichier PDF
$filename = 'carnet_de_competences.pdf';

// Téléchargez le fichier PDF
$pdf->Output($filename, 'D');                 


?>