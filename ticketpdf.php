<?php
    require('fpdf182/fpdf.php');
    session_start();
    include "dataconnection.php";

    if(!isset($_SESSION['email']))
    {
        header("location: login.php");
    }
    
    $purchase_ID = $_SESSION['Purchase_ID'];

    //search for all details
    $purchase_query = "SELECT D.Purchase_ID, C.Concert_Name, C.Concert_StartDate, C.Concert_Hor_Image, E.Price_Area, E.Price, G.Organizer_Name, F.Venue_Name, D.S_Ticket_Qty from purchase A, concert C, s_ticket D, ticket_price E, venue F, organizer G, customer H
    where A.Purchase_ID = '$purchase_ID' 
    and C.Concert_ID = E.Concert_ID
    and C.Venue_ID = F.Venue_ID 
    and C.Organizer_ID = G.Organizer_ID 
    and A.Purchase_ID = D.Purchase_ID
    and D.PriceID = E.Price_ID
    and A.Card_verify = 1
    group by E.Price_Area";
        
    $purchase_search = mysqli_query($connect, $purchase_query);

    $pic_query = "SELECT C.Concert_Hor_Image from purchase A, concert C, s_ticket D, ticket_price E, venue F, organizer G, customer H
    where A.Purchase_ID = '$purchase_ID' 
    and C.Concert_ID = E.Concert_ID
    and C.Venue_ID = F.Venue_ID 
    and C.Organizer_ID = G.Organizer_ID 
    and A.Purchase_ID = D.Purchase_ID
    and D.PriceID = E.Price_ID
    and A.Card_verify = 1
    group by E.Price_Area";
    $pic_run = mysqli_query($connect, $pic_query);
    $pic_result = mysqli_fetch_assoc($pic_run);
    $image_con = str_replace("../", "", $pic_result['Concert_Hor_Image']);
    
    class PDF extends FPDF
    {
        // Page header
        // function Header()
        // {
        //     // Logo ('img file', x, y, width, height)
        //     // $this->Image('images/header_footer/logo.png',75,5,70,24);
        //     //concert
        //     // $this->Image('images/aboutus/test.jpg',0,0,$this->w,$this->h);
        // }
    }
    $pdf = new PDF('L', 'mm', array(135,210) ); //create an object from the PDF class, to get header footer
    while($purchase_result = mysqli_fetch_assoc($purchase_search))
    {
        $concert_name = $purchase_result['Concert_Name'];
        $concert_date = date_format(date_create($purchase_result['Concert_StartDate']), "d M Y, H:i");
        //date_format(date_create($purchase_result['Purchase_Date'], "d M Y, H:i:s");
        $image = str_replace("../", "", $purchase_result['Concert_Hor_Image']);
        $price = $purchase_result['Price'];
        $area = $purchase_result['Price_Area'];
        $qty = $purchase_result['S_Ticket_Qty'];
        $Venue_Name = $purchase_result['Venue_Name'];
        $Organizer_Name = $purchase_result['Organizer_Name'];

    
        // Instanciation of inherited class
        //array(height, width) --> paper size
        
        $pdf->SetTitle("Ticket PDF");
        $i=0;
        do{    
            $pdf->AddPage();
            
            // reference number
            $pdf->SetFont('Arial','I',12);
            $pdf->setY(5);
            $pdf->setX(5);
            $pdf->Cell(0,0,"Reference no: ".$purchase_ID,0,0,'L');

            // Arial bold underline 18
            $pdf->SetFont('Arial','BU',18);
            // Move bottom
            $pdf->setY(15);
            // Title
            $pdf->Cell(190,10,$concert_name,0,0,'C');
            $pdf->Ln(7);
            //date
            $pdf->SetFont('Arial','I',11);
            $pdf->Cell(190,10,$concert_date,0,0,'C');
            
            // Line break
            $pdf->Ln(10);
            
            //subtitle
            $pdf->SetFont('Arial','',12);
            $pdf->SetTextColor(63, 137, 231);
            $pdf->Cell(13);
            $pdf->Cell(130,10,'ORGANIZER',0,0);
            $pdf->Cell(40,10,'SEAT AREA',0,0);
            
            $pdf->Ln();
            
            //content
            $pdf->SetFont('Arial','B',15);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(13);
            $pdf->Cell(130,5,$Organizer_Name,0,0);
            $pdf->Cell(40,5,$area,0,0);
            
            // Line break
            $pdf->Ln(10); 
            
            //subtitle
            $pdf->SetFont('Arial','',12);
            $pdf->SetTextColor(63, 137, 231);
            $pdf->Cell(13);
            $pdf->Cell(130,10,'VENUE',0,0);
            $pdf->Cell(40,10,'PRICE',0,0);
            
            // Line break
            $pdf->Ln(); 

            //content
            $pdf->SetFont('Arial','B',15);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(13);
            $pdf->Cell(130,5,$Venue_Name,0,0);
            $pdf->MultiCell(40,5,"RM ".$price,0,1);

            $pdf->Image($image,49,81,110,50);
            $i++;
        }while($i < $qty);
    }
    $pdf->Output(); //printing output
?>