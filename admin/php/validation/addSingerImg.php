<?php
    include '../../dataconnection.php';
        // To store uploaded files path

        if(isset($_POST['SID']))
        {
            $id = $_POST['SID'];
            $img = "select Singer_Image from singer where Singer_ID='$id'";
            $img_run = mysqli_query($connect,$img);
            $row = mysqli_fetch_assoc($img_run);
            $current_file = array("../../".$row['Singer_Image']);
        }

        for($index= 0; $index<1; $index++)
        {
            if(isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != '')
            {
                //Get file name
                $filename = $_FILES['files']['name'][$index];
    
                $test = explode(".",$_FILES['files']['name'][$index]);
                $extension = end($test);
                $name = rand(100,999).'.'.$extension;
                $savelocation = '../../../images/singer/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;
                $location = '../images/singer/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;
    
                $img_extensions = strtolower(pathinfo($location,PATHINFO_EXTENSION));
    
                $extensions_arr = array("jpg","jpeg","png","gif");
    
                if(in_array($img_extensions,$extensions_arr))
                {
                    if(move_uploaded_file($_FILES['files']["tmp_name"][$index],$savelocation))
                    {
                        if(isset($current_file[$index]))
                        {
                            if(file_exists($current_file[$index]))
                                unlink($current_file[$index]);
                        }
                    }
                }
            }
            else
                $location="";
        }

        $returnArr = [$location];    
        echo json_encode($returnArr);
?>