<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require('fpdf/fpdf.php');
include_once 'config.php';

class PDF extends FPDF {
    function Header() {
        // Logo
        $this->Image('images/logo.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reçu de Vote', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Fait à Marrakech le ' . date('d/m/Y'), 0, 0, 'C');
    }

    function Title() {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'École Nationale des Sciences Appliquées de Marrakech', 0, 1, 'C');
        $this->Ln(10);
    }

    function CandidateTable($header, $candidates) {
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        $w = array(90, 90);
        for($i=0; $i<count($header); $i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        $fill = false;
        foreach($candidates as $row) {
            $this->Cell($w[0],6,$row['name'],'LR',0,'C',$fill);
            $this->Cell($w[1],6,$row['description'],'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w),0,'','T');
    }

    function Voter($username) {
        $this->Ln(10);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, 'Vote réalisé par : ' . $username, 0, 1, 'C');
        $this->Ln(10);
    }
}

$database = new Database();
$db = $database->getConnection();

$id = $_SESSION['id'];
$username = $_SESSION['username'];

$query = "SELECT c.name, c.description FROM votes v LEFT JOIN candidates c ON v.candidate_id = c.id WHERE v.user_id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(":id", $id);
$stmt->execute();

$candidates = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $candidates[] = $row;
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->Title();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Candidats votés', 0, 1, 'C');
$pdf->Ln(10);
$header = array('Nom', 'Description');
$pdf->CandidateTable($header, $candidates);

$pdf->Voter($username);

$pdf->Output('D', 'recu_vote.pdf');
?>

