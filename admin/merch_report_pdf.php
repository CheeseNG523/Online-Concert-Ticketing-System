<?php
    require('../fpdf182/fpdf.php');
    session_start();

    $merchandise = array();
    $merch_Listprice = array();
    $merch_qty = array();
    $subtotal_merch = array();
    $sub_merch_revenue = array();
    $merchandise = $_SESSION['arraymerch'];
    $subtotal = 0;
    $subtotal_merch_revenue = 0;
    
    $num = count($merchandise);
    //calculate revenue
    for($i=0; $i < $num; $i++)
    {
        $merch_price[$i] = $merchandise[$i]['Merchandise_Price'];
        $merch_Listprice[$i] = $merchandise[$i]['Merchandise_ListPrice'];
        $merch_qty[$i] = $merchandise[$i]['Purchased'];
        $subtotal_merch[$i] = $merch_Listprice[$i] * $merch_qty[$i];
        $sub_merch_revenue[$i] = $merch_qty[$i] * ($merch_Listprice[$i] - $merch_price[$i]);
    }
    //calculate subtotal revenue
    for($i=0; $i < $num; $i++)
    {
        $subtotal += $subtotal_merch[$i];
        $subtotal_merch_revenue += $sub_merch_revenue[$i];
    }
    //calculate total revenue
    $total_revenue = 0;
    $total_revenue = $subtotal_merch_revenue;
    $total_revenue = number_format($total_revenue, 2);
    
    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            // Logo ('img file', x, y, width, height)
            $this->Image('../images/header_footer/logo.png',14,8,70,25);
            //move bottom
            $this->setY(37);
            // Arial bold 14
            $this->SetFont('Arial','B',14);
            // Title
            //(frame width, frame height,'content', border *0 or 1 / border bottom *'B' , 
            //align *'L' or '': left align (default value) 'C': center 'R': right align)
            $this->Cell(340,10,'Sales Report',0,0,'L');
            // Line break
            $this->Ln(14);
        }

        // Page footer
        function Footer()
        {
            // Position at 15 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','',10);
            $this->SetTextColor(0,0,0);
            $this->Cell(100,10,"*This is a computer-generated document. No signature is required.");
        }

        function HeaderTable_merch()
        {
            $this->SetFont('Arial','B',11);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(30,10, 'Product ID', 1,0,'L');
            $this->Cell(78,10, 'Product Name', 1,0,'L');
            $this->Cell(37,10, 'Price (RM)', 1,0,'L');
            $this->Cell(37,10, 'List Price (RM)', 1,0,'L');
            $this->Cell(20,10, 'Sold', 1,0,'L');
            $this->Cell(29,10, 'Subtotal (RM)', 1,0,'L');
            $this->Cell(29,10, 'Revenue (RM)', 1,0,'L');
            $this->ln();
        }

        function DataTable_merch()
        {
            //assign array data
            $merchandise = array();
            $merch_name = array();
            $merch_price = array();
            $merch_Listprice = array();
            $merch_qty = array();
            $revenue_merch = array();
            $merchandise = $_SESSION['arraymerch'];
            $num = count($merchandise);
            for($i=0; $i < $num; $i++)
            {
                $merch_id[$i] = $merchandise[$i]['Merchandise_ID'];
                $merch_name[$i] = $merchandise[$i]['Merchandise_Name'];
                $merch_price[$i] = $merchandise[$i]['Merchandise_Price'];
                $merch_Listprice[$i] = $merchandise[$i]['Merchandise_ListPrice'];
                $merch_qty[$i] = $merchandise[$i]['Purchased'];
            }
            $subtotal_merch = array();
            $sub_merch_revenue = array();
            $subtotal = 0;
            $subtotal_merch_revenue = 0;
            
            //calculate revenue
            for($i=0; $i < $num; $i++)
            {
                $merch_price[$i] = $merchandise[$i]['Merchandise_Price'];
                $merch_Listprice[$i] = $merchandise[$i]['Merchandise_ListPrice'];
                $merch_qty[$i] = $merchandise[$i]['Purchased'];
                $subtotal_merch[$i] = $merch_Listprice[$i] * $merch_qty[$i];
                $sub_merch_revenue[$i] = $merch_qty[$i] * ($merch_Listprice[$i] - $merch_price[$i]);
            }
            //calculate subtotal revenue
            for($i=0; $i < $num; $i++)
            {
                $subtotal += $subtotal_merch[$i];
                $subtotal_merch_revenue += $sub_merch_revenue[$i];
            }
            //calculate total revenue
            $total_revenue = 0;
            $total_revenue = $subtotal_merch_revenue;
            $total_revenue = number_format($total_revenue, 2);

            $this->SetTitle("Sales Report");
            $this->SetFont('Arial','',11);
            $this->SetTextColor(0, 0, 0);

            //display array data
            for($i=0; $i < $num; $i++)
            {
                $this->Cell(30,10, "Prod ".$merch_id[$i], 1,0,'L');
                $this->Cell(78,10, $merch_name[$i], 1,0,'L');
                $this->Cell(37,10, $merch_price[$i], 1,0,'L');
                $this->Cell(37,10, $merch_Listprice[$i], 1,0,'L');
                $this->Cell(20,10, $merch_qty[$i], 1,0,'L');
                $this->Cell(29,10, number_format($subtotal_merch[$i], 2), 1,0,'L');
                $this->Cell(29,10, number_format($sub_merch_revenue[$i], 2), 1,1,'L');
            }

            $this->SetFont('Arial','B',12);
            $this->Cell(202,10,'Total:',1,0,'R');
            $this->SetFont('Arial','',11);
            $this->Cell(29,10, number_format($subtotal,2),1,0,'L');
            $this->SetFont('Arial','BU',12);
            $this->Cell(29,10, 'RM '.number_format($subtotal_merch_revenue,2),1,0,'L');
        }
    }
    // Instanciation of inherited class
    //array(height, width) --> paper size
    $pdf = new PDF('L', 'mm', 'A4'); //create an object from the PDF class, to get header footer
    $pdf->AddPage();
    
    //merchandise
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(103, 119, 239);
    $pdf->Cell(260,10, 'Merchandise', 1,0,'L');
    $pdf->Ln();
    $pdf->HeaderTable_merch();
    $pdf->DataTable_merch();
    $pdf->Ln(13);
    $pdf->SetFont('Arial','B',13);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(42,10, 'Total Revenue: RM '.$total_revenue, 0,'L');
    $pdf->Output(); //printing output
?>