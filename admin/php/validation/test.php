<?php
include '../../dataconnection.php';

    //data to be return
    $returndata = array();

    //get 5 month subtotal value
    $total5month_concert = mysqli_query($connect,"select month(B.Purchase_Date)as'month', sum(C.S_Ticket_Qty*D.Price*1.00) as 'total' from concert A, 
    purchase B, s_ticket C, ticket_price D where A.Concert_ID = D.Concert_ID and B.Purchase_ID = C.Purchase_ID and C.PriceID = D.Price_ID and 
    B.Card_verify = 1 and B.Purchase_Date >= DATE_ADD(NOW(), INTERVAL -5 MONTH) group by month(B.Purchase_Date)");

    $total5month_merch = mysqli_query($connect,"select month(B.Purchase_Date)as'month', sum((A.Merchandise_ListPrice-A.Merchandise_Price)*C.S_Merchandise_Qty*1.00) as 'total' 
    from merchandise A, purchase B, s_merchandise C where A.Merchandise_ID = C.Merchandise_ID and B.Purchase_ID = C.Purchase_ID and B.Card_verify = 1 and 
    B.Purchase_Date >= DATE_ADD(NOW(), INTERVAL -5 MONTH) group by month(B.Purchase_Date)");

    //get value before 5 month
    $getTotal_concert = mysqli_query($connect,"select sum(C.S_Ticket_Qty*D.Price*1.00) as 'total' from concert A, purchase B, s_ticket C, ticket_price D where A.Concert_ID = D.Concert_ID 
    and B.Purchase_ID = C.Purchase_ID and C.PriceID = D.Price_ID and B.Card_verify = 1 and B.Purchase_Date < DATE_ADD(NOW(), INTERVAL -5 MONTH)");
    $total_concert = mysqli_fetch_assoc($getTotal_concert);

    $getTotal_merch = mysqli_query($connect,"select sum((A.Merchandise_ListPrice-A.Merchandise_Price)*C.S_Merchandise_Qty*1.00) as 'total' 
    from merchandise A, purchase B, s_merchandise C where A.Merchandise_ID = C.Merchandise_ID and B.Purchase_ID = C.Purchase_ID and 
    B.Card_verify = 1 and B.Purchase_Date < DATE_ADD(NOW(), INTERVAL -5 MONTH)");
    $total_merch = mysqli_fetch_assoc($getTotal_merch);

    $pretotal = $total_concert['total'] + $total_merch['total'];

    //fetch last 5 month subtotal value
    $data = array();
    $datamonth_concert = array();
    while($month_num = mysqli_fetch_assoc($total5month_concert))
    {
        $data_concert[] = $month_num['total'];
        $datamonth_concert[] = $month_num['month'];
    }

    $data_merch = array();
    $datamonth_merch = array();
    $datacombine = array();//to determine whether it has been combined
    while($month_num_merch = mysqli_fetch_assoc($total5month_merch))
    {
        $data_merch[] = $month_num_merch['total'];
        $datamonth_merch[] = $month_num_merch['month'];
        $datacombine[] = 0;//default 0
    }

    //get last 5 months' name
    $name = array();
    $num = array();
    $length_concert = count($datamonth_concert);
    $length_merch = count($datamonth_merch);
    for ($i = 0; $i < 5; $i++)
    {
        $name[] = date('F Y', strtotime('last day of'.-$i.'month'));
        $num[] = date('n', strtotime('last day of'.-$i.'month'));
    }

    //combine two revenue
    $temp = array();
    for($i=0; $i<$length_concert; $i++)
    {
        $j=0;
        $found = 0;
        while($j<$length_merch && $found == 0)
        {
            if($datamonth_concert[$i] == $datamonth_merch[$j])
            {
                $found = 1;
                $datacombine[$j] = 1;
            }
            else
            {
                $found = 0;
                $j++;
            }
        }
        if($found == 1)
        {
            $temp[] = ["month"=>$datamonth_concert[$i],"total"=>$data_merch[$j]+$data_concert[$i]];
        }
        else
        {
            $temp[] = ["month"=>$datamonth_concert[$i],"total"=>$data_concert[$i]];
        }
    }
    for($i=0; $i<$length_merch; $i++)
    {
        if($datacombine[$i] == 0)
            $temp[] = ["month"=>$datamonth_merch[$i],"total"=>$data_merch[$i]];
    }
    // echo json_encode($temp);

    //reverse it to be desc order
    $length = count($temp);
    for($i=4; $i>=0; $i--)
    {
        $j=0;
        $found = 0; 
        while($j<$length && $found==0)
        {
            //if month name match month from query
            if($temp[$j]['month'] == $num[$i])
            {
                //sum up for that particular total amount in that month
                $setnumber = $pretotal + $temp[$j]['total'];

                //insert data
                $returndata[] = ["month"=>$name[$i],"num"=>$setnumber];

                //sum up the subtotal before n month
                $pretotal += $temp[$j]['total'];

                //found to 1 -> stop looping
                $found = 1;
            }
            else
            {
                $found = 0;
            }
            $j++;
        }

        //if month name not match month from query
        if($found == 0)
        {
            //insert value that same as pre month value
            $returndata[]= ["month"=>$name[$i],"num"=>$pretotal];
        }
    }
    echo json_encode($returndata);
?>