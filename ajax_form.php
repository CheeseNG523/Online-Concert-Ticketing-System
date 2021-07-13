<?php
    include "dataconnection.php";

    if(isset($_POST['add_cart']))
    {
        $qty = $_POST['qty'];
        $id = $_POST['id'];
        $cust_id = $_POST['cust'];

        $query = mysqli_query($connect,"select * from s_merchandise where Merchandise_ID = '$id' and Purchase_ID is null and Cust_ID = '$cust_id'");
        $result = mysqli_fetch_assoc($query);
        if(mysqli_num_rows($query))
        {
            $current = $result['S_Merchandise_Qty'];
        }
        else
            $current = 0;

        $checking_query = mysqli_query($connect,"select * from merchandise where Merchandise_ID = '$id'");
        $checking_query_run = mysqli_fetch_assoc($checking_query);
        $current_stock = $checking_query_run['Merchandise_Stock'];

        if($current_stock == 0)
        {
            $returnArr = ['0','0'];
            echo json_encode($returnArr); //out of stock
        }
        else if($checking_query_run['Merchandise_Status']!=1)
        {
            $returnArr = ['0','1'];
            echo json_encode($returnArr);//off shelf
        }
        else if(mysqli_num_rows($query))
        {
            $update_qty = $qty + $current;
            if($current_stock <= $current)
            {
                $returnArr = ['0','3'];
                echo json_encode($returnArr);//You have reached the maximum quantity available for this item
            }
            else if($update_qty>10)
            {
                $returnArr = ['0','2'];
                echo json_encode($returnArr);
            }
            else
            {
                $update = "update s_merchandise set S_Merchandise_Qty = '$update_qty' where Merchandise_ID = '$id' and Cust_ID = '$cust_id'";
                $run = mysqli_query($connect,$update);
                echo json_encode($run,'0');
            }
        }
        else
        {
            $update = "INSERT INTO s_merchandise(S_Merchandise_Qty, Merchandise_ID, Cust_ID) VALUES ('$qty','$id','$cust_id')";
            $run = mysqli_query($connect,$update);
            echo json_encode($run,'0');
        }
    }

    if(isset($_POST['modify-qty']))
    {
        $action = $_POST['action'];
        $qty = $_POST['qty'];
        $id = $_POST['merch_id'];
        $cust_email = $_POST['cust_id'];
        
        $cust = mysqli_query($connect,"select Cust_ID from customer where Cust_Email = '$cust_email'");
        $cust_row = mysqli_fetch_assoc($cust);
        $cust_id = $cust_row['Cust_ID'];

        $query = mysqli_query($connect,"select B.S_Merchandise_Qty, A.Merchandise_Stock from merchandise A, s_merchandise B where 
        A.Merchandise_ID = B.Merchandise_ID and s_Merchandise_ID = '$id' and Cust_ID = '$cust_id'");
        $query_run = mysqli_fetch_assoc($query);

        $current_stock = $query_run['Merchandise_Stock'];

        if($action == 0)
        {
            if($qty > $current_stock)
            {
                $new_val = $current_stock;
                $update = "update s_merchandise set S_Merchandise_Qty = '$new_val' where s_Merchandise_ID = '$id' and Cust_ID = '$cust_id'";
                $run = mysqli_query($connect,$update);
                $returnArr = ['0', $new_val,'0'];
                echo json_encode($returnArr);
            }
            else if($qty >1)
            {
                $new_val = $qty - 1;
                $update = "update s_merchandise set S_Merchandise_Qty = '$new_val' where s_Merchandise_ID = '$id' and Cust_ID = '$cust_id'";
                $run = mysqli_query($connect,$update);
                $returnArr = [$run, $new_val];
                echo json_encode($returnArr);
            }
            else
            {
                $returnArr = ['0', $qty];
                echo json_encode($returnArr);
            }
        }
        else if($action == 1)
        {
            if($qty > $current_stock)
            {
                $new_val = $current_stock;
                $update = "update s_merchandise set S_Merchandise_Qty = '$new_val' where s_Merchandise_ID = '$id' and Cust_ID = '$cust_id'";
                $run = mysqli_query($connect,$update);
                $returnArr = ['0', $new_val,'0'];
                echo json_encode($returnArr);
            }
            else if($current_stock>$qty && $qty<10)
            {
                $new_val = $qty + 1;
                $update = "update s_merchandise set S_Merchandise_Qty = '$new_val' where s_Merchandise_ID = '$id' and Cust_ID = '$cust_id'";
                $run = mysqli_query($connect,$update);
                $returnArr = [$run, $new_val];
                echo json_encode($returnArr);
            }
            else
            {
                $returnArr = ['0', $qty];
                echo json_encode($returnArr);
            }

        }
    }

    if(isset($_POST['checkoutbtn']))
    {
        $error = 0;
        for($i=0; $i<count($_POST['item_id']); $i++)
        {
            if(isset($_POST['item_id'][$i]))
            {
                $id = $_POST['item_id'][$i];
                $query = mysqli_query($connect,"select A.Merchandise_Stock, A.Merchandise_Status, B.S_Merchandise_Qty from merchandise A, s_merchandise B where 
                A.Merchandise_ID = B.Merchandise_ID and s_Merchandise_ID = '$id'");
                $run=mysqli_fetch_assoc($query);
                if($run['Merchandise_Stock']>=$run['S_Merchandise_Qty']&&$run['Merchandise_Status']<2)
                {
                    $error = 0;
                }
                else
                {
                    $error = 1;
                    break;
                }
            }
        }
        if($error==0)
        {
            echo json_encode(1);
        }
        else
        {
            echo json_encode(0);
        }
    }

    if(isset($_POST['delbtn']))
    {
        $id = $_POST['delID'];

        $delete = "delete from s_merchandise where s_Merchandise_ID = '$id'";
        $run = mysqli_query($connect,$delete);

        echo json_encode($run);
    }

    if(isset($_POST['rating-merch']))
    {
        $cust_id = $_POST['Cust_ID'];
        // $files_arr = array();
        for($i=0; $i<count($_POST['s_merchandise_id']); $i++)
        {
            $s_merch_id = $_POST['s_merchandise_id'][$i];
            $star = $_POST['star'][$i];
            $comment = $_POST['comment'][$i];
            
            if(isset($_FILES['files']['name'][$i]) && $_FILES['files']['name'][$i] != '')
            {
                //Get file name
                $filename = $_FILES['files']['name'][$i];
    
                $test = explode(".",$_FILES['files']['name'][$i]);
                $extension = end($test);
                $name = rand(100,999).'.'.$extension;
                $savelocation = 'images/rating/merch_rating/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;
                $location = '../images/rating/merch_rating/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;
    
                $img_extensions = strtolower(pathinfo($location,PATHINFO_EXTENSION));
    
                $extensions_arr = array("jpg","jpeg","png","gif");
    
                if(in_array($img_extensions,$extensions_arr))
                {
                    if(move_uploaded_file($_FILES['files']["tmp_name"][$i],$savelocation))
                    {
                        $query = mysqli_query($connect,"insert into rating(Rating_Star, Rating_Comment, Rating_Image, Cust_ID, S_Merchandise_ID) 
                        values ('$star','$comment','$location','$cust_id','$s_merch_id')");
                    }
                }
            }
            else
            {
                // $files_arr[$i] = "NULL";
                $query = mysqli_query($connect,"insert into rating(Rating_Star, Rating_Comment, Cust_ID, S_Merchandise_ID) 
                values ('$star','$comment','$cust_id','$s_merch_id')");
            }
        }
    }

    if(isset($_POST['rating-concert']))
    {
        $cust_id = $_POST['Cust_ID'];
        // $files_arr = array();
        for($i=0; $i<count($_POST['purchase_id']); $i++)
        {
            $ticket_purchase_id = $_POST['purchase_id'][$i];
            $star = $_POST['star'][$i];
            $comment = $_POST['comment'][$i];
            
            if(isset($_FILES['files']['name'][$i]) && $_FILES['files']['name'][$i] != '')
            {
                //Get file name
                $filename = $_FILES['files']['name'][$i];
    
                $test = explode(".",$_FILES['files']['name'][$i]);
                $extension = end($test);
                $name = rand(100,999).'.'.$extension;
                $savelocation = 'images/rating/ticket_rating/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;
                $location = '../images/rating/ticket_rating/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;
    
                $img_extensions = strtolower(pathinfo($location,PATHINFO_EXTENSION));
    
                $extensions_arr = array("jpg","jpeg","png","gif");
    
                if(in_array($img_extensions,$extensions_arr))
                {
                    if(move_uploaded_file($_FILES['files']["tmp_name"][$i],$savelocation))
                    {
                        $query = mysqli_query($connect,"insert into rating(Rating_Star, Rating_Comment, Rating_Image, Cust_ID, Ticket_Purchase_ID) 
                        values ('$star','$comment','$location','$cust_id','$ticket_purchase_id')");
                    }
                }
            }
            else
            {
                // $files_arr[$i] = "NULL";
                $query = mysqli_query($connect,"insert into rating(Rating_Star, Rating_Comment, Cust_ID, Ticket_Purchase_ID) 
                values ('$star','$comment','$cust_id','$ticket_purchase_id')");
            }
        }
    }
?>