<?php
require('sector.php');

class PDF_Diag extends PDF_Sector {
    var $legends;
    var $wLegend;
    var $sum;
    var $NbVal;

    function PieChart($w, $h, $data, $format, $colors=null)
    {
        $this->SetFont('Courier', '', 10);
        $this->SetLegends($data,$format);

        $XPage = $this->GetX();
        $YPage = $this->GetY();
        $margin = 2;
        $hLegend = 3;
        $radius = min($w - $margin * 4 - $hLegend - $this->wLegend, $h - $margin * 2);
        $radius = floor($radius / 2);
        $XDiag = $XPage + $margin + $radius;
        $YDiag = $YPage + $margin + $radius;
        if($colors == null) {
            for($i = 0; $i < $this->NbVal; $i++) {
                $gray = $i * intval(255 / $this->NbVal);
                $colors[$i] = array($gray,$gray,$gray);
            }
        }

        //Sectors
        $this->SetLineWidth(0.2);
        $angleStart = 0;
        $angleEnd = 0;
        $i = 0;
        foreach($data as $val) {
            $angle = ($val * 360) / doubleval($this->sum);
            if ($angle != 0) {
                $angleEnd = $angleStart + $angle;
                $this->SetFillColor($colors[$i][0],$colors[$i][1],$colors[$i][2]);
                $this->Sector($XDiag, $YDiag, $radius, $angleStart, $angleEnd);
                $angleStart += $angle;
            }
            $i++;
        }

        //Legends
        $this->SetFont('Courier', '', 10);
        $x1 = $XPage + 2 * $radius + 4 * $margin;
        $x2 = $x1 + $hLegend + $margin;
        $y1 = $YDiag - $radius + (2 * $radius - $this->NbVal*($hLegend + $margin)) / 2;
        for($i=0; $i<$this->NbVal; $i++) {
            $this->SetFillColor($colors[$i][0],$colors[$i][1],$colors[$i][2]);
            $this->Rect($x1, $y1, $hLegend, $hLegend, 'DF');
            $this->SetXY($x2,$y1);
            $this->Cell(0,$hLegend,$this->legends[$i]);
            $y1+=$hLegend + $margin + 2;
        }
    }

    /*function BarDiagram($w, $h, $data, $color=null)
    {
        $nbDiv=4;
        $this->SetFont('Courier', '', 10);
        // $this->SetLegends($data,$format);

        //position
        $chartX = $this->GetX() + 20;
        $chartY = $this->GetY() + 25;
        
        //dimension
        $chartWidth = $w;
        $chartHeight = $h;
        
        //padding
        $chartTopPadding = 10;
        $chartLeftPadding = 20;
        $chartRightPadding = 20;
        $chartBottomPadding = 5;
        
        //chart Box
        $chartBoxX = $chartX +  $chartLeftPadding;
        $chartBoxY = $chartY + $chartTopPadding;
        $chartBoxWidth = $chartWidth - $chartLeftPadding - $chartRightPadding;
        $chartBoxHeight = $chartHeight - $chartTopPadding - $chartBottomPadding;

        //bar width
        $barWidth = 20;

        //assign data value convert to integer
        $day = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
        $a = 0;
        
        // echo json_encode($data);
        // if($data ["frequency"=>"0"])
        
        //convert string value to integer
        // for($i=0; $i < count($day); $i++)
        // {
        //     $data[$day[$i]]['frequency'] = array_map('intval', $data[$day[$i]]['frequency']);
        // }

        // echo json_encode(is_numeric($data[$day[3]]['frequency']));
        
        
        // if (($data[$day[0]]['frequency'] = "0") != null)
        // {
        //     echo json_encode('success');
        // }
        // if (($data[$day[0]]['frequency'] = "0") != null)
        // {
        //     if($data[$day[2]]['frequency'] = "0")
        //     {
        //         $a = 0;
        //         echo json_encode($a);
        //     }
        //     else if($data[$day[2]]['frequency'] = "1")
        //     {
        //         $a = 1;   
        //     }
        // }
        // else //assign zero
        // {
        //     $data[$day[0]]['frequency'] = 0;
        // }
        // //0
        // if($data[$day[0]]['frequency'] = "[0]")
        // {
        //     $a = 0;
        // }
        // else if($data[$day[0]]['frequency'] = "[1]")
        // {
        //     $a = 1;   
            
        // }
        //0
        // if($data[$day[1]]['frequency'] = "[0]")
        // {
        //     $a = 0;
        // }
        // else if($data[$day[1]]['frequency'] = "[1]")
        // {
        //     $a = 1;   
        // }
        //1
        // $day1=0;
        // $day2=0;
        // $day3=0;
        // $day4=0;
        // $day6=0;
        // $day7=0;
        // $day1 = $data[$day[0]]['frequency'];
        // // echo json_encode($day1);
            
        // if($day1 = "0")
        // {
        //     $a = 0;
        //     echo json_encode($a);
        // }
        // else if($dday1 = "1")
        // {
        //     $a = 1;   
        //     echo json_encode($a);
        // }
        // else if($day1 = "2")
        // {
        //     $a = 2;   
        //     echo json_encode($a);
        // }
        // echo json_encode($data[$day[3]]['frequency']);

        // if($data[$day[3]]['frequency'] = "0")
        // {
        //     $a = 0;
        //     echo json_encode($a);
        // }
        // else if($data[$day[3]]['frequency'] = "1")
        // {
        //     $a = 1;   
        //     echo json_encode($a);
        // }
        // else if($data[$day[3]]['frequency'] = "2")
        // {
        //     $a = 2;   
        //     echo json_encode($a);
        // }
        // else if($data[$day[3]]['frequency'] = "3")
        // {
        //     $a = 3;   
        //     echo json_encode($a);
        // }
        
        
        // $daycount = count($data);
        // for($i=0; $i < $daycount; $i++)
        // {
            // if($data[$day[$i]]['frequency'] = "[0]")
            //     // $data[$day[$i]]['frequency'] = 0;
            //     echo json_encode(0);
            // if($data[$day[$i]]['frequency'] = "1")
            //     echo json_encode(1);
            //     // $data[$day[$i]]['frequency'] = 1;
            // else if($data[$day[$i]]['frequency'] = "2")
            //     echo json_encode(2);
            // // $data[$day[$i]]['frequency'] = 2;
            // else if($data[$day[$i]]['frequency'] = "3")
            //     echo json_encode(3);
            //     // $data[$day[$i]]['frequency'] = 3;
            // else if($data[$day[$i]]['frequency'] = "4")
            //     echo json_encode(4);
            //     // $data[$day[$i]]['frequency'] = 4;
            // else if($data[$day[$i]]['frequency'] = "5")
            //     echo json_encode(5);
            //     // $data[$day[$i]]['frequency'] = 5;
            // else if($data[$day[$i]]['frequency'] = "6")
            //     echo json_encode(6);
            //     // $data[$day[$i]]['frequency'] = 6;
            // else if($data[$day[$i]]['frequency'] = "7")
            //     echo json_encode(7);
            //     // $data[$day[$i]]['frequency'] = 7;
                
                // echo json_encode($i);
                // echo json_encode($a);
        // }
        // echo json_encode($data[$day[2]]['frequency']);
        // echo json_encode($a);

        // $i=0;
        // foreach($data as $item){
        //     if($item['frequency'] = "0")
        //         $item['frequency'] = 0;
        //     else if($item['frequency'] = "1")
        //         $item['frequency'] = 1;
        //     else if($item['frequency'] = "2")
        //         $item['frequency'] = 2;
        //     else if($item['frequency'] = "3")
        //         $item['frequency'] = 3;
        //     else if($item['frequency'] = "4")
        //         $item['frequency'] = 4;
        //     else if($item['frequency'] = "5")
        //         $item['frequency'] = 5;
        //     else if($item['frequency'] = "6")
        //         $item['frequency'] = 6;
        // }
            
        //data max
        $maxVal=0;
        foreach($data as $item){
            if($item['frequency'] > $maxVal)
                $maxVal = $item['frequency'];
        }  
        // echo json_encode($maxVal);  
        //need help!!!!!! *convert to integer
        // if($maxVal = "3")
            // $maxVal = 3;
       
       
        //data step
        $dataStep = 1;
        $this->SetLineWidth(0.2);
        $this->SetDrawColor(0);

        //chart boundary
        $this->Rect($chartX, $chartY, $chartWidth, $chartHeight);

        //vertical axis line
        $this->Line(
            $chartBoxX,
            $chartBoxY, 
            $chartBoxX,
            $chartBoxY + $chartBoxHeight
        );
        //horizontal axis line
        $this->Line(
            $chartBoxX - 2,
            $chartBoxY + $chartBoxHeight, 
            $chartBoxX + $chartBoxWidth,
            $chartBoxY + $chartBoxHeight
        );
       
        //y axis scale unit
        $yAxisUnits = $chartBoxHeight / $maxVal;
        //draw vertical label
        for($i=0; $i < $maxVal; $i +=$dataStep){
            //Y postion
            $yAxisPos = $chartBoxY + ($yAxisUnits * $i);

            //draw y axis lines
            $this->Line(
                $chartBoxX - 2,
                $yAxisPos,
                $chartBoxX,
                $yAxisPos
            );

            //set cell position for y axis labels
            $this->SetXY($chartBoxX - $chartLeftPadding, $yAxisPos - 2);

            //write labels
            $this->Cell($chartLeftPadding - 4, 5, $maxVal-$i, 0 ,0 ,'R');
        }

        //horizontal axis
        //set cell position
        $this->SetXY($chartBoxX,$chartBoxY + $chartBoxHeight);

        //cell width
        $xLabelWidth = $chartBoxWidth / count($data);

        $barXPos =0;
        foreach($data as $itemname=>$item)
        {
            //print labels
            $this->Cell($xLabelWidth, 5, $itemname,0,0,'C');

            //bar color
            $this->SetFillColor($color[0],$color[1],$color[2],$color[3],$color[4],$color[5],$color[6],$color[7]);
            //bar height
            //need help *convert to integer
            $barHeight = $yAxisUnits * (int)$item['frequency'];
            //bar x position
            $barX = ($xLabelWidth / 2) + ($xLabelWidth * $barXPos);
            $barX = $barX - ($barWidth / 2);
            $barX = $barX + $chartBoxX;
            //bar y position
            $barY = $chartBoxHeight - $barHeight;
            $barY = $barY - $chartBoxY;
            //draw bar
            $this->Rect($barX, $barY, $barWidth, $barHeight, 'DF');

            $barXPos++;
        }

        //axis labels
        $this->SetFont('Arial', 'B', 12);
        $this->SetXY($chartX, $chartY);
        $this->Cell(100, 10, 'Frequency');
        $this->SetXY(($chartWidth / 2) + $chartX, $chartY + $chartHeight - ($chartBottomPadding / 2));
        $this->Cell(100, 10, 'Days');       
        
        
        //Source code
        // $XPage = $this->GetX();
        // $YPage = $this->GetY();
        // $margin = 2;
        // $YDiag = $YPage + $margin;
        // $hDiag = floor($h - $margin * 2);
        // $XDiag = $XPage + $margin * 2 + $this->wLegend;
        // $lDiag = floor($w - $margin * 3 - $this->wLegend);
        // if($color == null)
        //     $color=array(155,155,155);
        // if ($maxVal == 0) {
        //     $maxVal = max($data);
        // }
        // $valIndRepere = ceil($maxVal / $nbDiv);
        // $maxVal = $valIndRepere * $nbDiv;
        // $lRepere = floor($lDiag / $nbDiv);
        // $lDiag = $lRepere * $nbDiv;
        // $unit = $lDiag / $maxVal;
        // $hBar = floor($hDiag / ($this->NbVal + 1));
        // $hDiag = $hBar * ($this->NbVal + 1);
        // $eBaton = floor($hBar * 80 / 100);

        // $this->SetLineWidth(0.2);
        // $this->Rect($XDiag, $YDiag, $lDiag, $hDiag);

        // $this->SetFont('Courier', '', 10);
        // $this->SetFillColor($color[0],$color[1],$color[2]);
        // $i=0;
        // foreach($data as $val) {
        //     //Bar
        //     $xval = $XDiag + ($i + 1) * $hBar - $eBaton / 2;
        //     // $lval = (int)($val * $unit);
        //     $lval = $eBaton;
        //     $hval = (int)($val * $unit);
        //     $yval = $YDiag;
        //     // $hval = $eBaton;
        //     $this->Rect($xval, $yval, $lval, $hval, 'DF');
        //     //Legend
        //     $this->SetXY(0, $yval);
        //     $this->Cell($xval - $margin, $hval, $this->legends[$i],0,0,'R');
        //     $i++;
        //     // echo json_encode($yval);
        // }

        // //Scales
        // for ($i = 0; $i <= $nbDiv; $i++) {
        //     $xpos = $XDiag + $lRepere * $i;
        //     $this->Line($xpos, $YDiag, $xpos, $YDiag + $hDiag);
        //     $val = $i * $valIndRepere;
        //     $xpos = $XDiag + $lRepere * $i - $this->GetStringWidth($val) / 2;
        //     $ypos = $YDiag + $hDiag - $margin;
        //     $this->Text($xpos, $ypos, $val);
        // }
    }*/

    function SetLegends($data, $format)
    {
        $this->legends=array();
        $this->wLegend=0;
        $this->sum=array_sum($data);
        $this->NbVal=count($data);
        foreach($data as $l=>$val)
        {
            $p=sprintf('%.2f',$val/$this->sum*100).'%';
            $legend=str_replace(array('%l','%v','%p'),array($l,$val,$p),$format);
            $this->legends[]=$legend;
            $this->wLegend=max($this->GetStringWidth($legend),$this->wLegend);
        }
    }
}
?>