<?php
    session_start();
    include '../../dataconnection.php';
    if(isset($_FILES['file']['name']))
    {
        //Get file name
        $filename = $_FILES['file']['name'];

        $test = explode(".",$_FILES['file']['name']);
        $extension = end($test);
        $name = rand(100,999).'.'.$extension;
        $savelocation = '../../../images/profile/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;
        $location = '../images/profile/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;

        $img_extensions = strtolower(pathinfo($savelocation,PATHINFO_EXTENSION));

        $extensions_arr = array("jpg","jpeg","png","gif");

        $admin_email = $_SESSION['admin_email'];

        $current_img_path = mysqli_query($connect,"select * from admin where admin_email = '$admin_email' and Admin_imgDir is not null");
        $row=mysqli_fetch_assoc($current_img_path);
        if(mysqli_num_rows($current_img_path)>0)
        {
            $current_img = "../../".$row['Admin_imgDir'];
        }
        

        if(in_array($img_extensions,$extensions_arr))
        {
            if(move_uploaded_file($_FILES['file']["tmp_name"],$savelocation))
            {
                if(mysqli_num_rows($current_img_path)>0)
                {
                    if(file_exists($current_img))
                        unlink($current_img);
                }
                $run = mysqli_query($connect,"update admin set Admin_imgDir = '$location' where admin_email = '$admin_email'"); 
                echo json_encode($run);
            }
            else
            { 
                echo json_encode(false);
            }
        }
        else
        {
            echo json_encode(false);
        }
    }
    else
    { 
        echo json_encode(false);
    }
?>