<?php
    require('fpdf182/fpdf.php');
    session_start();
    include "dataconnection.php";

    if(!isset($_SESSION['email']))
    {
        header("location: login.php");
    }
    
    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            // Logo ('img file', x, y, width, height)
            $this->Image('images/header_footer/logo.png',20,10,70,25);
            $this->ln(25);
        }
        // Page footer
        function Footer()
        {
            $this->SetFont('Arial','',9);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(50,10,"**All receipt can be viewed at profile page as well.",0,'L');
        }

        function HeaderTable()
        {
            $this->SetFillColor(63, 137, 231);
            $this->SetDrawColor(204, 204, 204);
            $this->SetFont('Arial','B',12);
            $this->SetTextColor(255, 255, 255);
            $this->Cell(150,10,'Concert Name',1,0,'C','true');
            $this->Cell(15,10, 'Area', 1,0,'C','true');
            $this->Cell(21,10, 'Quantity', 1,0,'C','true');
            $this->Cell(42,10, 'Price per ticket(RM)', 1,0,'C','true');
            $this->Cell(36,10, 'Amount(RM)', 1,0,'C','true');
            
            $this->Ln(); 
        }
    }
    $purchase_ID = $_SESSION['Purchase_ID'];
    $date = $_SESSION['time'];
    $concert_name = $_SESSION['concert'];
    $area = array();
    $price = array();
    $qty = array();
    $area = $_SESSION['areaname'];
    $price = $_SESSION['areaprice'];
    $qty = $_SESSION['qty'];
    $area_count = count($area);

    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $cust_name = $lname." ".$fname;

    $card_no = $_SESSION['cardno'];
    $hidden_card_no = '**** **** ****'.substr($card_no, 14);
        
    $pdf = new PDF('L', 'mm', 'A4' ); //create an object from the PDF class, to get header footer
    //title of pdf
    $pdf->SetTitle("Order Receipt");
    $pdf->SetMargins(20,20,20);
    $pdf->AddPage();
    // Arial bold 24
    $pdf->SetFont('Arial','B',24);
    //(frame width, frame height,'content', border *0 or 1 / border bottom *'B' , 
    //align *'L' or '': left align (default value) 'C': center 'R': right align)
    $pdf->Cell(76,10,"Payment Receipt # ".$purchase_ID,0,'L');
    $pdf->SetFont('Arial','I',12);
    $pdf->SetTextColor(115, 115, 115);
    $date = date_format(date_create($date), "d M Y, H:i:s");
    $pdf->Cell(20,10,"Placed on ".$date,0,'L');
        
    // Line break
    $pdf->Ln(20);

    $pdf->HeaderTable();
        
    //content
    $pdf->SetFont('Arial','',12);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFillColor(230, 247, 255);
    
    $size = $area_count * 10;
    $pdf->Cell(150,$size,$concert_name, 1,0,'L','true');  
    
    $i=0;
    $total = 0;
    $subtotal = array();
    do{
        //calculate
        $subtotal[$i] = $price[$i] * $qty[$i];
        $total += $subtotal[$i];

        $pdf->setX(170);
        $pdf->Cell(15,10,$area[$i], 1,0,'C','true');
        $pdf->Cell(21,10,$qty[$i], 1,0,'C','true');
        $pdf->Cell(42,10,number_format($price[$i],2), 1,0,'C','true');
        $pdf->Cell(36,10,number_format($subtotal[$i],2), 1,0,'C','true');
        $pdf->Ln();
        $i++;
    }while($i < $area_count);
    // Line break
    $pdf->SetFillColor(63, 137, 231);
    $pdf->Cell(186,10,'', 1,0,'C','false');
    $pdf->SetFillColor(63, 137, 231);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(42,10,'Total', 1,0,'C','true');
    $pdf->SetFillColor(230, 247, 255);
    $pdf->SetFont('Arial','',12);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(36,10,number_format($total,2), 1,0,'C','true');
    $pdf->Ln(15); 
    $pdf->SetFont('Arial','I',12);
    $pdf->SetTextColor(115, 115, 115);
    $pdf->Cell(37,10, 'Payment made by: '.$cust_name,0,'L');
    $pdf->Cell(46,10, 'Payment made through: '.$hidden_card_no,0,'L');
    $pdf->Output(); //printing output
?>