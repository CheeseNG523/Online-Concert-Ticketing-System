<?php
    require('pdf/diagram.php');
    session_start();

    //include "dataconnection.php";
    //$db = new PDO('mysql:host=localhost;dbname=concerta','root','');
    
    class PDF extends PDF_Diag
    {
        // Page header
        function Header()
        {
            //specific the first page
            //if($this->PageNo()==1){}
            // Logo ('img file', x, y, width, height)
            $this->Image('../images/header_footer/logo.png',14,8,70,25);
            // Line break
            $this->Ln(28);
        }

        // Page footer
        function Footer()
        {
            // Position at 15 cm from bottom
            $this->SetY(-25);
            // Arial italic 8
            $this->SetFont('Arial','',10);
            $this->SetTextColor(0,0,0);
            $this->Cell(100,10,"*This is a computer-generated document. No signature is required.");
            $this->SetY(-15);
            // Select Arial italic 8
            $this->SetFont('Arial','I',8);
            // Print current and total page numbers
            $this->Cell(0,10,'Page '.$this->PageNo().' | {nb}',0,0,'C');
        }

        //HeaderTable()
        function HeaderTable()
        {
            $this->SetFont('Arial','B',11);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(52,10, 'Area Name', 1,0,'L');
            $this->Cell(52,10, 'Area Price (RM)', 1,0,'L');
            $this->Cell(52,10, 'Sold', 1,0,'L');
            $this->Cell(52,10, 'Total (RM)', 1,0,'L');
            $this->Cell(52,10, 'Revenue (RM)', 1,0,'L');
            $this->ln();
        }

        function DataTable($i, $j)
        {
            $arraydata = array();
            $arraydata = $_SESSION['arrayconcert'];

            $this->Cell(52,10, $arraydata[$i][$j]['area_name'], 1,0,'L');
            $this->Cell(52,10, $arraydata[$i][$j]['price'], 1,0,'L');
            $this->Cell(52,10, $arraydata[$i][$j]['sold'], 1,0,'L');
            
            $sub_total[$j] = $arraydata[$i][$j]['price'] * $arraydata[$i][$j]['sold'];
            $sub_revenue[$j] = $sub_total[$j];
            $this->Cell(52,10, number_format($sub_total[$j],2), 1,0,'L');
            $this->Cell(52,10, number_format($sub_revenue[$j],2), 1,0,'L');
            $this->Ln();
        }
    }
    $pdf = new PDF('P', 'mm', array(290,280));
    $pdf->AliasNbPages();
    $arraydata = array();
    $arraygender = array();
    $arrayweek = array();
    $arraydata = $_SESSION['arrayconcert'];
    $arraygender = $_SESSION['arraygender'];
    // $arrayweek = $_SESSION['arrayweek'];
    $concert_count = count($arraydata);
    // $week_count = count($arrayweek);

    //retrieve concert details
    $concert = array();
    $date = array();
    $venue = array();
    $organizer = array();
    $concert_status = array();
    $gender = array();
    $num = array();
    for($i=0; $i<$concert_count; $i++)
    {
        $example2 = array();
        $example2 = $arraydata[$i];
        $area_count = count($example2);
        for($j=0; $j<$area_count; $j++)
        {
            $concert[$i] = $arraydata[$i][$j]['concert'];
            $date[$i] = $arraydata[$i][$j]['concert_data'];
            $venue[$i] = $arraydata[$i][$j]['venue'];
            $organizer[$i] = $arraydata[$i][$j]['organizer'];
            $concert_status[$i] = $arraydata[$i][$j]['concert_status'];
            if($concert_status[$i] == 0)
                $status[$i] = "Saved";
            else if($concert_status[$i] == 1)
                $status[$i] = "Upcoming";
            else if($concert_status[$i] == 2)
                $status[$i] = "Ongoing";
            else if($concert_status[$i] == 3)
                $status[$i] = "Ended";
        }
    }
   
    //retrieve gender details
    for($i=0; $i < $concert_count; $i++)
    {
        if($arraygender[$i][0]['gender'] == 'Male' || $arraygender[$i][0]['gender'] == 'Female') //female = null
        {
            $gender_num = 1;
        }
        else if($arraygender[$i][1]['gender'] == null) //male = null
        {
            $gender_num = 1;
        }
        else
        { 
            $gender_num = 2;
        }
        for($j=0; $j < $gender_num; $j++) //male and female = 2
        {
            $gender[$i][$j] = $arraygender[$i][$j]['gender'];
            $num[$i][$j] = $arraygender[$i][$j]['number'];
        }
    }
    //retrieve week details
    // for($i=0; $i < $week_count; $i++)
    // {
    //     for($j=0; $j < 7; $j++) //one week = 7
    //     {
    //        $week[$i][$j] = $arrayweek[$i][$j+1]['total_week'];
    //     }
    // }
    //get total revenue
    $total_revenue = array();
    for($i=0; $i < $concert_count; $i++)
    {
        $concert_total = 0; //total of each concert
        $example2 = array();
        $example2 = $arraydata[$i];
        $area_count = count($example2);
        for($j=0; $j<$area_count; $j++)
        {
            $areatotal = $arraydata[$i][$j]['total'];
            $concert_total += $areatotal;
        }
        $total_revenue[$i] = ['total'=>number_format($concert_total,2)];
    }

    $i = 0;
    do{
        $pdf->SetTitle("Sales Report");
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',13);
        $pdf->Cell(208,10,"Concert: ".$concert[$i],0,0,'L');
        $pdf->Ln();
        $date[$i] = date_format(date_create($date[$i]), "d M Y, H:i");
        $pdf->Cell(208,10,"Date: ".$date[$i],0,0,'L');
        $pdf->Ln();
        $pdf->Cell(208,10,"Venue: ".$venue[$i],0,0,'L');
        $pdf->Ln();
        $pdf->Cell(208,10,"Organizer: ".$organizer[$i],0,0,'L');
        $pdf->Ln();
        $pdf->Cell(208,10,"Status: ".$status[$i],0,0,'L');
        $pdf->Ln(15);
        $pdf->HeaderTable();
        for($j=0; $j<$area_count; $j++)
        {
            $pdf->SetFont('Arial','',11);
            $pdf->DataTable($i,$j);
        }
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(156,10, 'Total:', 1,0,'R');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(52,10, $total_revenue[$i]['total'], 1,0,'L');
        $pdf->SetFont('Arial','BU',12);
        $pdf->Cell(52,10, "RM ".$total_revenue[$i]['total'], 1,0,'L');
        $pdf->Ln();

        //pie chart
        if($gender[$i][0] == 'Male' || $gender[$i][0] == 'Female') //Female = 0
        {
            $gender[$i][0] = 'Female';
            $gender[$i][1] = 'Male';
            $num[$i][1] = $num[$i][0];//move number to second position
            $num[$i][0] = 0; //assign female = 0
        }
        else if($gender[$i][1] == null) //Male = 0
        {
            $gender[$i][1] = 'Male';
            $num[$i][1] = 0; //assign Male = 0
        }

        $genderdata = array($gender[$i][0]=> $num[$i][0], $gender[$i][1] => $num[$i][1]);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 5, 'Audience distribution of '.$concert[$i].', by gender', 0, 1,'C');
        $pdf->Ln(8);

        $valX = $pdf->GetX();
        $valY = $pdf->GetY();
        $pdf->Ln(8);

        $pdf->SetXY(105, $valY);
        $col1=array(76,187,23);
        $col2=array(137,207,240);
        //PieChart(float w, float h, array data, string format [, array colors])
        $pdf->PieChart(130, 65, $genderdata, '%l: %v', array($col1,$col2));
        $pdf->SetXY($valX, $valY + 40);

        //bar chart
        // $pdf->SetY(-120);
        // $pdf->SetFont('Arial', '', 12);
        // $pdf->Cell(0, 5, 'Tickets sold by day of week', 0, 1,'C');
        // $pdf->Ln(8);
        // $valX = $pdf->GetX();
        // $valY = $pdf->GetY();
        // $pdf->BarDiagram(190, 70, $data, '%l : %v (%v)', array(255,175,100));
        // $pdf->SetXY($valX, $valY + 80);
        //BarDiag(float w, float h, array data, string format [, array couleur [, int maxVal [, int nbDiv]]])
        
        
        //test
        //Bar diagram
        
        // $weekdata = array('Sunday' => ['frequency' => [$week[$i][0]] ], 'Monday' => ['frequency' => [$week[$i][1]] ], 'Tuesday' => ['frequency' => [$week[$i][2]] ], 'Wednesday' => ['frequency' => [$week[$i][3]] ], 'Thursday' => ['frequency' => [$week[$i][4]] ], 'Friday' => ['frequency' => [$week[$i][5]] ], 'Saturday' => ['frequency' => [$week[$i][6]] ]);
        // // echo json_encode($week);
        // $pdf->SetFont('Arial', 'BIU', 12);
        // $pdf->Ln(8);
        // $valX = $pdf->GetX();
        // $valY = $pdf->GetY();
        // $col1=array(255, 99, 132);
        // $col2=array(255, 159, 64);
        // $col3=array(255, 205, 86);
        // $col4=array(75, 192, 192);
        // $col5=array(54, 162, 235);
        // $col6=array(153, 102, 255);
        // $col7=array(201, 203, 207);
        // $pdf->BarDiagram(220, 120, $weekdata);
        // $pdf->SetXY($valX, $valY + 80);
        //error
        // array($col1,$col2,$col3,$col4,$col5,$col6,$col7)
        $i++;
    }
    while($i < $concert_count);
    $pdf->Output(); //printing output
?>