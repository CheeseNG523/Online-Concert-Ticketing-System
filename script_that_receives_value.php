<?php 
    include "dataconnection.php";
    session_start();

    $concert_id = $_SESSION['ticket'];

    if(isset($_POST['concert_ticket_btn']))
    {
        $name_count = count($_POST['name']);
        $qty_count = count($_POST['ticket_qty']);
        $selected_area = array();
        $selected_qty = array();
        $s_ticket_array = array();

        for($i=0; $i<$name_count; $i++)
        {
            $selected_area[$i] = $_POST['name'][$i];
            $selected_qty[$i] = $_POST['ticket_qty'][$i];
            
            //get area id to insert into s_ticket table
            $area_id_query = "SELECT * FROM ticket_price WHERE Price_Area = '$selected_area[$i]' AND Concert_ID = $concert_id";
            $area_id_run_query = mysqli_query($connect, $area_id_query);
            $area_id_fetch = mysqli_fetch_assoc($area_id_run_query);
            $area_id = $area_id_fetch['Price_ID'];

            //insert into s_ticket table
            $s_ticket_query = "INSERT INTO s_ticket (S_Ticket_Qty, PriceID) VALUES ($selected_qty[$i], $area_id)";
            $s_ticket_insert = mysqli_query($connect, $s_ticket_query);
            $s_ticket_array[$i] = mysqli_insert_id($connect);
        }

        // $_SESSION['area_name'] = $selected_area;
        // $_SESSION['ticket_qty'] = $selected_qty;
        $_SESSION['s_ticket_id'] = $s_ticket_array;

        echo json_encode($s_ticket_array);
    }
?>