<?php
    include '../../dataconnection.php';
        // To store uploaded files path
        $files_arr = array();

        if(isset($_POST['CID']))
        {
            $concert_id = $_POST['CID'];
            $imgconcert = "select Concert_Ver_Image, Concert_Hor_Image, Seat_Image from concert where Concert_ID='$concert_id'";
            $imgconcert_run = mysqli_query($connect,$imgconcert);
            $row = mysqli_fetch_assoc($imgconcert_run);
            $current_file = array("../../".$row['Concert_Ver_Image'],"../../".$row['Concert_Hor_Image'],"../../".$row['Seat_Image']);
        }

        for($index= 0; $index<3; $index++)
        {
            if(isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != '')
            {
                //Get file name
                $filename = $_FILES['files']['name'][$index];
    
                $test = explode(".",$_FILES['files']['name'][$index]);
                $extension = end($test);
                $name = rand(100,999).'.'.$extension;
                $savelocation = '../../../images/concert/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;
                $location = '../images/concert/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;
    
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
                       $files_arr[$index] = $location;
                    }
                }
            }
            else
                $files_arr[$index] = "none";
        }

        $returnArr = [$files_arr[0],$files_arr[1],$files_arr[2]];    
        echo json_encode($returnArr);
?>