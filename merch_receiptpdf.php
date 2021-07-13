<?php
    require('fpdf182/fpdf.php');
    session_start();
    include "dataconnection.php";

    if(!isset($_SESSION['email']))
    {
        header("location: login.php");
    }
    
    //purchase details
    $purchase = array();
    $purchase = $_SESSION['purchase_info'];
    $purchase_id = $purchase['Purchase_ID'];
    $purchase_date = $purchase['Purchase_Date'];
    $date = date_format(date_create($purchase_date), "d M Y, H:i:s");
    $purchase_address = $purchase['Purch_Address']."\n".$purchase['Purch_Postcode'].", ".$purchase['Purch_City']."\n".$purchase['Purch_State'].".";
    $cust_name = $purchase['Cust_Name'];
    $hidden_card_no = '**** **** ****'.substr($purchase['Card_Number'], 14);
    
    //merchandise
    $merchandise = array();
    $merch_image = array();
    $merch_name = array();
    $merch_listprice = array();
    $merch_qty = array();
    $merch_weight = array();
    $merchandise = $_SESSION['merchandise_info'];
    $merch_count = count($merchandise);
    for($i=0; $i < $merch_count; $i++)
    {
        $merch_listprice[$i] = $merchandise[$i]['Merchandise_ListPrice']; 
        $merch_qty[$i] = $merchandise[$i]['S_Merchandise_Qty']; 
        $merch_weight[$i] = $merchandise[$i]['Merchandise_Weight'];   
    }   
    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            // Logo ('img file', x, y, width, height)
            $this->Image('images/header_footer/logo.png',20,10,70,25);
            $this->ln(20);
        }

        function HeaderTable()
        {
            $this->SetFont('Arial','B',12);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(112,10,'Product',1,0,'L');
            $this->Cell(50,10, 'Price', 1,0,'L');
            $this->Cell(50,10, 'Quantity', 1,0,'L');
            $this->Cell(50,10, 'Subtotal', 1,0,'L');
            $this->Ln();
        }

        function DataTable($i, $j, $k)
        {
            $merchandise = array();
            $merch_image = array();
            $merch_name = array();
            $merch_listprice = array();
            $merch_qty = array();
            $merch_weight = array();
            $merchandise = $_SESSION['merchandise_info'];

            $this->SetFont('Arial','',12);
            $x = 22;
            $next = 30;
            if($i < 4)
            {
                $y = 123 + ($next * $i); 
            }
            else if($i >= 4 && $i < 11) //page 2
            {
                $y = 43 + ($next * $j);
                if($j == 0)
                {
                    $this->AddPage();
                    $y = 43;
                }
            }
            else if($i >= 11 && $i < 18) //page 3
            {
                $y = 43 + ($next * $k);
                if($k == 0)
                {
                    $this->AddPage();
                    $y = 43;
                }
            }
            $this->Image(str_replace("../", "", $merchandise[$i]['Merchandise_Image']),$x,$y,25,25);
            $this->Cell(28,30, "", 'TLB',0);
            $this->Cell(84,30, $merchandise[$i]['Merchandise_Name'], 'TRB',0,'L');
            $this->Cell(50,30,"RM ".number_format($merchandise[$i]['Merchandise_ListPrice'], 2), 1,0,'L');
            $this->Cell(50,30,$merchandise[$i]['S_Merchandise_Qty'], 1,0,'L');
            //calculate
            $subtotal = array();
            $total_weight = 0;

            $subtotal[$i] = $merchandise[$i]['Merchandise_ListPrice'] * $merchandise[$i]['S_Merchandise_Qty'];
            $this->Cell(50,30, number_format($subtotal[$i],2), 1,0,'L');
            $this->Ln();
        }
    }      
    $pdf = new PDF('L', 'mm', array(295, 280)); 
    $pdf->SetMargins(20,20,20);
    $pdf->SetTitle("Order Receipt");
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',24);
    $pdf->Cell(76,10,"Payment Receipt # ".$purchase_id,0,'L');
    $pdf->SetFont('Arial','I',12);
    $pdf->SetTextColor(115, 115, 115);
    $pdf->Cell(20,10,"Placed on ".$date,0,'L');
    $pdf->Ln();
    $pdf->Multicell(200,10,"Delivery To:\n".$purchase_address,0,'L');           

    $pdf->HeaderTable();
    
    $total = 0;
    $total_weight = 0;
    $j = -4;
    $k = -11;
    for($i=0; $i < $merch_count; $i++)
    {
        $pdf->DataTable($i, $j, $k);
        //calculate
        $total += $merch_listprice[$i] * $merch_qty[$i];
        // $total = number_format($total,2);
        $total_weight += $merch_qty[$i] * $merch_weight[$i];
        // $total_weight = number_format($total_weight,2);
        $j++; $k++;
    }
    $shipping = 0;
    $pay = 0;
    $shipping += 4.66;
    if($total_weight>3)
    {
        $i=0;
        while(($total_weight-3) > $i)
        {
            $i++;
            $shipping += 0.85;
        }
    }
    $pay = $shipping + $total;
    $total = number_format($total,2);
    $total_weight = number_format($total_weight,2);

    // Line break
    $pdf->SetFillColor(255,255,255);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(212,10,"Shipping", 'LR',0,'R');
    $pdf->Cell(50,10,"RM ".number_format($shipping, 2), 'R',0,'L');
    $pdf->Ln();
    $pdf->Cell(212,10,"Total:", 'LRB',0,'R');
    $pdf->SetFont('Arial','BU',12);
    $pdf->Cell(50,10,"RM ".number_format($pay, 2), 'RB',0,'L');
    $pdf->Ln(15); 
    $pdf->SetFont('Arial','I',12);
    $pdf->SetTextColor(115, 115, 115);
    $pdf->Cell(37,10, 'Payment made by: '.$cust_name,0,'L');
    $pdf->Cell(46,10, 'Payment made through: '.$hidden_card_no,0,'L');
    $pdf->SetFont('Arial','',9);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(50,10,"**All receipt can be viewed at profile page as well.",0,'L');
    $pdf->Output(); //printing output
?>