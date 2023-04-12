<?php

require('../../fpdf.php');
include("../../connection.php");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(40,10,'Recent Services');
$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'Date',1);
$pdf->Cell(30,10,'Invoice',1);
$pdf->Cell(50,10,'Customer',1);
$pdf->Cell(30,10,'Amount',1);
$pdf->Cell(30,10,'Status',1);
$pdf->Ln();

$query = "SELECT r.Appointment_Date, r.Service_Description, p.Amount, p.Payment_Status, u.First_Name, u.Last_Name
                FROM tbl_service_request r
                    JOIN tbl_payment p ON r.Request_ID = p.Request_ID
                    JOIN tbl_service_provider s ON r.Provider_ID = s.Provider_ID
                    JOIN tbl_user u ON r.User_ID = u.User_ID
                        WHERE r.Status = 'completed' AND Payment_Status = 'paid'";
$result = mysqli_query($con, $query);
$total = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(30,10,$row['Appointment_Date'],1);
    $pdf->Cell(30,10,'INV-' . rand(1000, 9999),1);
    $pdf->Cell(50,10,$row['First_Name'] . ' ' . $row['Last_Name'],1);
    $pdf->Cell(30,10,'Rs.' . $row['Amount'],1);
    $pdf->Cell(30,10,$row['Payment_Status'],1);
    $pdf->Ln();
    $total += $row['Amount'];
}
$pdf->SetFont('Arial','B',12);
$pdf->Cell(140,10,'Total',1);
$pdf->Cell(30,10,'Rs.' . $total.'/-',1);
$pdf->Ln(20);

$pdf->Output();
?>