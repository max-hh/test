<?php
include('connect.php');
require('fpdf.php');
Session_start();
$_SESSION['car.user'];
$user = $_SESSION['car.user'];



//Select the Products you want to show in your PDF file
$result=$con->query("SELECT userkennungA, gegenstand, price, city, placed FROM finale WHERE userkennungT = $user");
$number_of_products = mysqli_num_rows($result);


$column_code = "";
$column_name = "";
$column_city = "";
$column_price = "";
$column_placed = "";

//For each row, add the field to the corresponding column
while($row = mysqli_fetch_array($result))
{
    $code = $row["userkennungA"];
    $name = $row["gegenstand"];
    $price = $row["price"];
    $city = $row["city"];
    $placed = $row["placed"];

    $column_code = $column_code.$code."\n";
    $column_name = $column_name.$name."\n";
    $column_city = $column_city.$city."\n";
    $column_placed = $column_placed.$placed."\n";
    $column_price = $column_price.$price."\n";
}
mysqli_close($con);

//Create a new PDF file
$pdf=new FPDF();
$pdf->AddPage();

//Fields Name position
$Y_Fields_Name_position = 15;
//Table position, under Fields Name
$Y_Table_Position = 26;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(25);
$pdf->Cell(20,6,'User',1,0,'L',1);
$pdf->SetX(45);
$pdf->Cell(50,6,'Thing',1,0,'L',1);
$pdf->SetX(95);
$pdf->Cell(30,6,'City',1,0,'L',1);
$pdf->SetX(125);
$pdf->Cell(18,6,'Price $',1,0,'L',1);
$pdf->SetX(143);
$pdf->Cell(50,6,'Accepted',1,0,'R',1);
$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(25);
$pdf->MultiCell(20,6,$column_code,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(45);
$pdf->MultiCell(50,6,$column_name,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(95);
$pdf->MultiCell(30,6,$column_city,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(125);
$pdf->MultiCell(18,6,$column_price,1,'R');
$pdf->SetY($Y_Table_Position);
$pdf->SetX(143);
$pdf->MultiCell(50,6,$column_placed,1,'R');
//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $number_of_products)
{
    $pdf->SetX(25);
    $pdf->MultiCell(168,6,'',1);
    $i = $i +1;
}

$pdf->Output();
?>