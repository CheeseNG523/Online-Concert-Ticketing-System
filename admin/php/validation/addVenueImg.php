<?php
    include '../../dataconnection.php';
        // To store uploaded files path
        $files_arr = array();

        if(isset($_POST['VID']))
        {
            $venue_id = $_POST['VID'];
            $imgvenue = "select Venue_Image from venue where Venue_ID='$venue_id'";
            $imgvenue_run = mysqli_query($connect,$imgvenue);
            $row = mysqli_fetch_assoc($imgvenue_run);
            $current_file = array("../../".$row['Venue_Image']);
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
                $savelocation = '../../../images/venue/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;
                $location = '../images/venue/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;
    
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
                       $files_arr[] = $location;
                    }
                }
            }
            else
                $files_arr[] = "";
        }

        $returnArr = [$files_arr[0]];    
        echo json_encode($returnArr);
?>