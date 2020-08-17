<?php

require('fpdf/fpdf.php');
$fpdf = new FPDF();
$fpdf -> Addpage('PORTRAIT','A4');

$movies = file_get_contents('https://api.themoviedb.org/3/movie/upcoming?api_key=5b812339ff5a7fd950dc41d20c6754c8&language=es-ES&page=1');
$movies = json_decode($movies,true)["results"];
    


class pdf extends FPDF
{
    public function header()
    {
        $this->SetFont('TIMES','B','10');
        //$this -> setX(160);
        $this -> Image('img/banner_valoradas.png',5,5,200,50);
    }

    public function footer()
    {
        $this ->SetFont('TIMES','B','10');
        $this ->setY(-15);
        $this ->Write(5,'Informe Peliculas, Ranked Movies');
        //$this -> Image('img/logo.png',185,275,20,20,'png',"");
        $this->Setx(-30);
        $this->AliasNbPages('tpaginas');
        $this->Write(5,$this->PageNo().'/tpaginas');
        
    }
}

$fpdf = new pdf();


$fpdf->AddPage();
$fpdf->SetFont('Arial','B',16);
$fpdf->SetY(25);
//$fpdf->Cell(0,25,"Reporte Peliculas mas valoradas ",0,0,"C");
$fpdf->Ln(30);

//$fpdf->SetTextColor(45,47,250);
$fpdf->SetFont('Arial','B',14);

$fpdf->SetFillColor(255, 255, 255);

//Asiganar color a el bolder
$fpdf->SetDrawColor(0,4,253);


//Asignar Color
//$fpdf->SetTextColor(143, 139, 129);



//Asignar borde  a la linea
$fpdf->SetLineWidth(1);

//Asiganar una linea
//$fpdf->Line(15,65,190,65);
$fpdf->Ln(15);
$fpdf->SetFont('Arial','',12);
$fpdf->SetLineWidth(0);
$fpdf->SetFillColor(230, 230, 230);
$fpdf->SetDrawColor(256,256,256);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$fpdf->setFillColor(232, 232, 232);
$fpdf->setFont('Arial', 'B', 10);
$fpdf->Cell(30, 6, 'Ranking', 1, 0, 'C', 1);
$fpdf->Cell(70, 6, 'Titulo', 1, 0, 'C', 1);
$fpdf->Cell(20, 6, 'Lenguaje', 1, 0, 'C', 1);
$fpdf->Cell(25, 6, 'Puntuacion', 1, 0, 'C', 1);
$fpdf->Cell(40, 6, 'Fecha de Salida', 1, 0, 'C', 1);

$fpdf->Ln();
$fpdf->setFont('Arial', '', 10);

$i = 0;


while($i<15) {
    $fpdf->Ln(12);
    $fpdf->Cell(30, 6, $i+1, 1, 0, 'C');
    $fpdf->Cell(70, 6,utf8_decode($movies[$i]['original_title']), 1, 0, 'J');
    $fpdf->Cell(20, 6,utf8_decode($movies[$i]['original_language']), 1, 0, 'C');
    $fpdf->Cell(25, 6,utf8_decode($movies[$i]['vote_average']), 1, 0, 'C');
    $fpdf->Cell(40, 6,utf8_decode($movies[$i]['release_date']), 1, 0, 'C');
    
    $i++;
	
}






$fpdf->Output();

?>