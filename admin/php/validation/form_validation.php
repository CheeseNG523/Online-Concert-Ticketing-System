<?php
include '../../dataconnection.php';
session_start();

/*Template for standard form validation*/
//TEXT input type
if(isset($_POST['text_submit_btn']))
{
    $text_valid = $_POST["text_valid"];
    if($text_valid == null || $text_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        $message = "";
        $error_code = 0;
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
}

//DATE input type
if(isset($_POST['date_submit_btn']))
{
    $date_valid = $_POST["date_valid"];
    if($date_valid == null || $date_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //disable some input before this field is filled
        $disable_field = "disabled";
        //create an object to store all value
        $returnArr = [$message,$error_code,$disable_field];    
        echo json_encode($returnArr);
    }
    else
    {
        $message = "";
        $error_code = 0;
        $disable_field = "";
        $returnArr = [$message,$error_code,$disable_field];    
        echo json_encode($returnArr);
    }
}

//SELECT input type
if(isset($_POST['select_submit_btn']))
{
    $select_valid = $_POST["select_valid"];
    if($select_valid == null || $select_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        $message = "";
        $error_code = 0;
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
}
/*End of Template*/

/*Modify Purchase Status*/
if(isset($_POST['update_merch_status']))
{
    $status = $_POST['status'];
    $id = $_POST['id'];

    $run = mysqli_query($connect,"update purchase set Purchase_Status = '$status' where Purchase_ID = '$id'");
    echo json_encode($run);
}

/*Modify Merchandise*/
if(isset($_POST['merch_delbtn']))
{
    $id = $_POST['delCID'];
    $result = mysqli_query($connect,"update merchandise set Merchandise_unable = 1 where Merchandise_ID = '$id'");

    //get merchandise name
    $merchandise_search = mysqli_query($connect, "SELECT * FROM merchandise WHERE Merchandise_ID='$id'");
    $merchandise = mysqli_fetch_assoc($merchandise_search);
    $Sname = $merchandise['Merchandise_Name'];

    //xml delete
    $xmldoc = new DomDocument( '1.0' );
    $xmldoc->preserveWhiteSpace = false;
    $xmldoc->formatOutput = true;

    $xmldoc->load('../../../search/merchandise.xml');
    $xpath = new DOMXPath($xmldoc);

    $nodes = $xpath->query("//pages/merchandise[merchandise_name[text() = '$Sname' ]]");
    $nodes->item(0)->parentNode->removeChild($nodes->item(0));

    $xmldoc->save('../../../search/merchandise.xml');

    echo json_encode($result);
}

if(isset($_POST['add_merch_submitBtn']))
{
    $Merch_Name = $_POST['merch_name'];
    $price = $_POST['merch_price'];
    $lprice = $_POST['merch_lprice'];
    $stock = $_POST['merch_stock'];
    $concert = $_POST['merch_concert'];
    $status = $_POST['merch_status'];
    $weight = $_POST['merch_weight'];
    $Descrip = $_POST['desc_data'];
    $shortimg = $_POST['locationimg'];

    //xml add (for search function at user side)
    $xmldoc = new DomDocument( '1.0' );
    $xmldoc->preserveWhiteSpace = false;
    $xmldoc->formatOutput = true;

    if( $xml = file_get_contents('../../../search/merchandise.xml') ) {
        $xmldoc->loadXML( $xml, LIBXML_NOBLANKS );

        // find the headercontent tag
        $root = $xmldoc->getElementsByTagName('pages')->item(0);

        // create the <merchandise> tag
        $merchandise = $xmldoc->createElement('merchandise');

        // add the merchandise tag before the first element in the <headercontent> tag
        $root->insertBefore( $merchandise, $root->firstChild );

        // create other elements and add it to the <merchandise> tag.
        $nameElement = $xmldoc->createElement('merchandise_name');
        $merchandise->appendChild($nameElement);
        $nameText = $xmldoc->createTextNode($Merch_Name);
        $nameElement->appendChild($nameText);

        $xmldoc->save('../../../search/merchandise.xml');
    }
            
    $insert = "INSERT INTO `merchandise`(`Merchandise_Name`, `Merchandise_Weight`, `Merchandise_Price`, `Merchandise_ListPrice`, `Merchandise_Description`, `Merchandise_Stock`, 
    `Merchandise_Image`, `Merchandise_Status`, `Concert_ID`) VALUES ('$Merch_Name', '$weight', '$price','$lprice','$Descrip','$stock','$shortimg','$status','$concert');";
    $run = mysqli_query($connect,$insert);
    $returnArr = [$run];
    echo json_encode($returnArr);
}

if(isset($_POST['update_merch_submitBtn']))
{
    $id = $_POST['merch_id'];
    $Merch_Name = $_POST['merch_name'];
    $price = $_POST['merch_price'];
    $lprice = $_POST['merch_lprice'];
    $stock = $_POST['merch_stock'];
    $update_stock = $_POST['merch_update_stock'];
    $concert = $_POST['merch_concert'];
    $status = $_POST['merch_status'];
    $weight = $_POST['merch_weight'];
    $Descrip = $_POST['desc_data'];
    $shortimg = $_POST['locationimg'];

    $check = mysqli_query($connect,"select Merchandise_Stock from merchandise where Merchandise_ID = '$id'");
    $check_row = mysqli_fetch_assoc($check);
    $current_stock = $check_row['Merchandise_Stock'];

    $modify = $update_stock - $stock;

    $new_stock = $current_stock + $modify;
    
    if($new_stock >= 0)
    {
        //get current merch name
        $merch_query = mysqli_query($connect, "SELECT * FROM merchandise WHERE Merchandise_ID = $id");
        $merch_result = mysqli_fetch_assoc($merch_query);
        $OLDNAME = $merch_result['Merchandise_Name'];

        if($OLDNAME != $Merch_Name)
        {
            //xml update
            $xmldoc = new DomDocument( '1.0' );
            $xmldoc->preserveWhiteSpace = false;
            $xmldoc->formatOutput = true;

            if($xml = file_get_contents('../../../search/merchandise.xml'))
            {
                $xmldoc->loadXML( $xml, LIBXML_NOBLANKS );
                $xpath = new DOMXPath($xmldoc);

                if($Merch_Name != "")
                {
                    $nodes = $xpath->query("//pages/merchandise[merchandise_name[text() = '$OLDNAME' ]]");
                    $nodes->item(0)->parentNode->removeChild($nodes->item(0));

                    //find the headercontent tag
                    $root = $xmldoc->getElementsByTagName('pages')->item(0);

                    // create the <merchandise> tag
                    $merchandise = $xmldoc->createElement('merchandise');

                    // add the merchandise tag before the first element in the <headercontent> tag
                    $root->insertBefore( $merchandise, $root->firstChild );

                    // create other elements and add it to the <merchandise> tag.
                    $nameElement = $xmldoc->createElement('merchandise_name');
                    $merchandise->appendChild($nameElement);
                    $nameText = $xmldoc->createTextNode($Merch_Name);
                    $nameElement->appendChild($nameText);

                    $xmldoc->save('../../../search/merchandise.xml');
                }
            }
        }
        if($shortimg === "")
        {
            $update = "UPDATE `merchandise` SET `Merchandise_Name`='$Merch_Name',`Merchandise_Price`='$price',`Merchandise_ListPrice`='$lprice',
            `Merchandise_Description`='$Descrip',`Merchandise_Stock`='$new_stock',`Merchandise_Weight`='$weight',
            `Merchandise_Status`='$status', `Concert_ID`='$concert' WHERE Merchandise_ID = '$id'";
        }
        else
        {
            $update = "UPDATE `merchandise` SET `Merchandise_Name`='$Merch_Name',`Merchandise_Price`='$price',`Merchandise_ListPrice`='$lprice',
            `Merchandise_Description`='$Descrip',`Merchandise_Stock`='$new_stock',`Merchandise_Weight`='$weight',`Merchandise_Image`='$shortimg',
            `Merchandise_Status`='$status', `Concert_ID`='$concert' WHERE Merchandise_ID = '$id'";
        }
        
        $run = mysqli_query($connect,$update);

        if($run)
            echo json_encode(1);
        else
            echo json_encode(0);
    }
    else
        echo json_encode(2);
}

/*Modify organizer*/
if(isset($_POST['add_organizer_btn']))
{
    $organizer = $_POST['name'];
    $link = $_POST['link'];
    $query = mysqli_query($connect,"select * from organizer where Organizer_Name = '$organizer'");
    if(mysqli_num_rows($query))
    {
        $returnArr = ['0'];
        echo json_encode($returnArr);
    }
    else
    {
        $result = "insert into organizer(Organizer_Name, Organizer_Link) values ('$organizer','$link')";
        $run = mysqli_query($connect,$result);
        if($run)
        $returnArr = ['1'];
        else
        $returnArr = ['3'];
        echo json_encode($returnArr);
    }
}

if(isset($_POST['organizer_delbtn']))
{
    $id = $_POST['delID'];
    $result = "update organizer set Organizer_unable=1 where Organizer_ID = '$id'";
    $run = mysqli_query($connect,$result);
    $returnArr = [$run];
    echo json_encode($returnArr);
}

if(isset($_POST['get_organizer']))
{
    $id = $_POST['id'];
    $result = "select * from organizer where Organizer_ID = '$id'";
    $run = mysqli_query($connect,$result);
    $row = mysqli_fetch_assoc($run);
    $returnArr = [$run,$row['Organizer_Name'],$row['Organizer_Link']];
    echo json_encode($returnArr);
}

if(isset($_POST['get_category']))
{
    $id = $_POST['id'];
    $result = "select * from category where Category_ID = '$id'";
    $run = mysqli_query($connect,$result);
    $row = mysqli_fetch_assoc($run);
    $returnArr = [$run,$row['Category_Name']];
    echo json_encode($returnArr);
}

if(isset($_POST['update_organizer_btn']))
{
    $id = $_POST['updateid'];
    $organizer = $_POST['name'];
    $link = $_POST['link'];
    $query = mysqli_query($connect,"select * from organizer where Organizer_Name = '$organizer' and Organizer_ID != '$id'");
    if(mysqli_num_rows($query))
    {
        $returnArr = ['0'];
        echo json_encode($returnArr);
    }
    else
    {
        $result = "update organizer set Organizer_Name = '$organizer', Organizer_Link='$link' where Organizer_ID = '$id'";
        $run = mysqli_query($connect,$result);
        if($run)
        $returnArr = ['1'];
        else
        $returnArr = ['3'];
        echo json_encode($returnArr);
    }
    
}

/*Modify Admin*/
if(isset($_POST['add_super_admin_submitBtn']))
{
    $fname = $_POST['admin_fname'];
    $lname = $_POST['admin_lname'];
    $eamil = $_POST['admin_email'];
    $gender = $_POST['admin_gender'];
    $phone = $_POST['admin_phone'];
    $pass = $_POST['admin_pass'];
    $pw = md5($pass);
    $result = "insert into admin(Admin_Fname, Admin_Lname, Admin_Password, Admin_Email, Admin_Contact, Admin_Gender, Admin_PRI) values ('$fname','$lname','$pw','$eamil','$phone','$gender',1)";
    $run = mysqli_query($connect,$result);
    echo json_encode($run);
}

if(isset($_POST['add_admin_submitBtn']))
{
    $fname = $_POST['admin_fname'];
    $lname = $_POST['admin_lname'];
    $eamil = $_POST['admin_email'];
    $gender = $_POST['admin_gender'];
    $phone = $_POST['admin_phone'];
    $pass = $_POST['admin_pass'];
    $pw = md5($pass);
    $result = "insert into admin(Admin_Fname, Admin_Lname, Admin_Password, Admin_Email, Admin_Contact, Admin_Gender, Admin_PRI) values ('$fname','$lname','$pw','$eamil','$phone','$gender',2)";
    $run = mysqli_query($connect,$result);
    echo json_encode($run);
}

if(isset($_POST['admin_delbtn']))
{
    $id = $_POST['delID'];
    $result = "update admin set Admin_unable=1 where Admin_ID = '$id'";
    $run = mysqli_query($connect,$result);
    $returnArr = [$run];
    echo json_encode($run);
}

/*Modify customer*/
if(isset($_POST['customer_delbtn']))
{
    $id = $_POST['delID'];
    $result = "update customer set Cust_Ban_Status=1 where Cust_ID = '$id'";
    $run = mysqli_query($connect,$result);
    $returnArr = [$run];
    echo json_encode($returnArr);
}

/*Modify category*/
if(isset($_POST['add_category_btn']))
{
    $category = $_POST['name'];

    $query = mysqli_query($connect,"select * from category where Category_Name = '$category'");
    if(mysqli_num_rows($query))
    {
        $returnArr = ['0'];
        echo json_encode($returnArr);
    }
    else
    {
        $result = "insert into category(Category_Name) values ('$category')";
        $run = mysqli_query($connect,$result);
        if($run)
        $returnArr = ['1'];
        else
        $returnArr = ['3'];
        echo json_encode($returnArr);
    }
}

if(isset($_POST['category_delbtn']))
{
    $id = $_POST['delID'];
    $result = "update category set Category_unable=1 where Category_ID = '$id'";
    $run = mysqli_query($connect,$result);
    $returnArr = [$run];
    echo json_encode($returnArr);
}

if(isset($_POST['update_category_btn']))
{
    $id = $_POST['id'];
    $category = $_POST['name'];

    $query = mysqli_query($connect,"select * from category where Category_Name = '$category' and Category_ID != '$id'");
    if(mysqli_num_rows($query))
    {
        $returnArr = ['0'];
        echo json_encode($returnArr);
    }
    else
    {
        $result = "update category set Category_Name='$category' where Category_ID = '$id'";
        $run = mysqli_query($connect,$result);
        if($run)
        $returnArr = ['1'];
        else
        $returnArr = ['3'];
        echo json_encode($returnArr);
    }
}

/*Modify Singer*/
if(isset($_POST['checking_singer_name']))
{
    $text_valid = $_POST["text_valid"];
    if($text_valid == null || $text_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        $singer = mysqli_query($connect,"select * from singer where Singer_Name = '$text_valid'");
        if(mysqli_num_rows($singer)>0)
        {
            $message = "*This singer has been stored in database";
            $error_code = 1;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
    }
}

if(isset($_POST['checking_update_singer_name']))
{
    $text_valid = $_POST["text_valid"];
    $id = $_POST["id"];
    if($text_valid == null || $text_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        $singer = mysqli_query($connect,"select * from singer where Singer_Name = '$text_valid' and Singer_ID != '$id'");
        if(mysqli_num_rows($singer)>0)
        {
            $message = "*This singer has been stored in database";
            $error_code = 1;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
    }
}

if(isset($_POST['add_singer_submitBtn']))
{
    $SName = $_POST['singer_name'];
    $SCate = $_POST['singer_cate'];
    $SDescrip = $_POST['desc_data'];
    $shortimg = $_POST['shortimg'];

    //xml add (for search function at user side)
    $xmldoc = new DomDocument( '1.0' );
    $xmldoc->preserveWhiteSpace = false;
    $xmldoc->formatOutput = true;

    if( $xml = file_get_contents('../../../search/singer.xml') ) {
        $xmldoc->loadXML( $xml, LIBXML_NOBLANKS );

        // find the headercontent tag
        $root = $xmldoc->getElementsByTagName('pages')->item(0);

        // create the <singer> tag
        $singer = $xmldoc->createElement('singer');

        // add the singer tag before the first element in the <headercontent> tag
        $root->insertBefore( $singer, $root->firstChild );

        // create other elements and add it to the <concert> tag.
        $nameElement = $xmldoc->createElement('singer_name');
        $singer->appendChild($nameElement);
        $nameText = $xmldoc->createTextNode($SName);
        $nameElement->appendChild($nameText);

        $xmldoc->save('../../../search/singer.xml');
    }
            
    $insert_concert = "insert into singer(Singer_Name, Singer_Desc, Singer_Image, Category_ID) values ('$SName','$SDescrip','$shortimg','$SCate')";
    $run = mysqli_query($connect,$insert_concert);
    $returnArr = [$run];
    echo json_encode($returnArr);
}

if(isset($_POST['singer_delbtn']))
{
    $id = $_POST["delCID"];
    $result = mysqli_query($connect,"update singer set singer_unable = 1 where Singer_ID='$id'");
    //get singer name
    $singer_search = mysqli_query($connect, "SELECT * FROM singer WHERE Singer_ID='$id'");
    $singer = mysqli_fetch_assoc($singer_search);
    $Sname = $singer['Singer_Name'];

    //xml delete
    $xmldoc = new DomDocument( '1.0' );
    $xmldoc->preserveWhiteSpace = false;
    $xmldoc->formatOutput = true;

    $xmldoc->load('../../../search/singer.xml');
    $xpath = new DOMXPath($xmldoc);

    $nodes = $xpath->query("//pages/singer[singer_name[text() = '$Sname' ]]");
    $nodes->item(0)->parentNode->removeChild($nodes->item(0));

    $xmldoc->save('../../../search/singer.xml');

    $returnArr = [$result];   
    echo json_encode($returnArr);
}

if(isset($_POST['update_singer_submitBtn']))
{
    $ID = $_POST['id'];
    $SName = $_POST['singer_name'];
    $SCate = $_POST['singer_cate'];
    $SDescrip = $_POST['desc_data'];
    $shortimg = $_POST['shortimg'];

    //get current singer name
    $singer_query = mysqli_query($connect, "SELECT * FROM singer WHERE Singer_ID = $ID");
    $singer_result = mysqli_fetch_assoc($singer_query);
    $OLDNAME = $singer_result['Singer_Name'];
    if($OLDNAME != $SName)
    {
        //xml update
        $xmldoc = new DomDocument( '1.0' );
        $xmldoc->preserveWhiteSpace = false;
        $xmldoc->formatOutput = true;

        if($xml = file_get_contents('../../../search/singer.xml'))
        {
            $xmldoc->loadXML( $xml, LIBXML_NOBLANKS );
            $xpath = new DOMXPath($xmldoc);

            if($SName != "")
            {
                $nodes = $xpath->query("//pages/singer[singer_name[text() = '$OLDNAME' ]]");
                $nodes->item(0)->parentNode->removeChild($nodes->item(0));

                //find the headercontent tag
                $root = $xmldoc->getElementsByTagName('pages')->item(0);

                // create the <singer> tag
                $singer = $xmldoc->createElement('singer');

                // add the singer tag before the first element in the <headercontent> tag
                $root->insertBefore( $singer, $root->firstChild );

                // create other elements and add it to the <singer> tag.
                $nameElement = $xmldoc->createElement('singer_name');
                $singer->appendChild($nameElement);
                $nameText = $xmldoc->createTextNode($SName);
                $nameElement->appendChild($nameText);

                $xmldoc->save('../../../search/singer.xml');
            }
        }
    }
    
    if($shortimg === "")
        $update = "update singer set Singer_Name = '$SName', Singer_Desc='$SDescrip', Category_ID='$SCate' where Singer_ID = '$ID'";
    else
        $update = "update singer set Singer_Name = '$SName', Singer_Desc='$SDescrip', Category_ID='$SCate', Singer_Image='$shortimg' where Singer_ID = '$ID'";
    $run = mysqli_query($connect,$update);

    $returnArr = [$run];
    echo json_encode($returnArr);
}

/*Modify Venue*/
if(isset($_POST['venue_delbtn']))
{
    $id = $_POST["delCID"];
    $result = mysqli_query($connect,"update venue set venue_unable = 1 where Venue_ID='$id'");
    $returnArr = [$result];   
    echo json_encode($returnArr);
}

if(isset($_POST['add_venue_submitBtn']))
{
    $VName = $_POST['venue_name'];
    $VState = $_POST['venue_state'];
    $VLocation = $_POST['venue_location'];
    $VDescrip = $_POST['desc_data'];
    $Viframe = $_POST['venue_iframe'];
    $locationimg = $_POST['locationimg'];
            
    $insert_concert = "insert into venue(Venue_Name, Venue_State, Venue_Image, Venue_Location, Venue_iframe, Venue_Description) values ('$VName','$VState','$locationimg','$VLocation','$Viframe','$VDescrip')";
    mysqli_query($connect,$insert_concert);
    $returnArr = [$insert_concert];
    echo json_encode($returnArr);
}

if(isset($_POST['update_venue_submitBtn']))
{
    $VID = $_POST['venue_ID'];
    $VName = $_POST['venue_name'];
    $VState = $_POST['venue_state'];
    $VLocation = $_POST['venue_location'];
    $VDescrip = $_POST['desc_data'];
    $Viframe = $_POST['venue_iframe'];
    $locationimg = $_POST['locationimg'];
    if($locationimg === "")
        $update = "update venue set Venue_Name = '$VName', Venue_State='$VState', Venue_Location='$VLocation', Venue_iframe='$Viframe', Venue_Description='$VDescrip' where Venue_ID='$VID'";
    else     
        $update = "update venue set Venue_Name = '$VName', Venue_State='$VState', Venue_Image='$locationimg', Venue_Location='$VLocation', Venue_iframe='$Viframe', Venue_Description='$VDescrip' where Venue_ID='$VID'";
    mysqli_query($connect,$update);
    $returnArr = [$update];
    echo json_encode($returnArr);
}

/*Modify Concert*/
if(isset($_POST['delbtn']))
{
    $id = $_POST["delCID"];
    $isunable = mysqli_query($connect,"update concert set Concert_Unable = 1 where Concert_ID='$id'");

    //get concert name
    $concert_search = mysqli_query($connect, "SELECT * FROM concert WHERE Concert_ID='$id'");
    $concert = mysqli_fetch_assoc($concert_search);
    $Cname = $concert['Concert_Name'];

    //xml delete
    $xmldoc = new DomDocument( '1.0' );
    $xmldoc->preserveWhiteSpace = false;
    $xmldoc->formatOutput = true;

    $xmldoc->load('../../../search/concert.xml');
    $xpath = new DOMXPath($xmldoc);

    $nodes = $xpath->query("//pages/concert[concert_name[text() = '$Cname' ]]");
    $nodes->item(0)->parentNode->removeChild($nodes->item(0));

    $xmldoc->save('../../../search/concert.xml');

    $returnArr = [$isunable];
    echo json_encode($returnArr);
}

if(isset($_POST['add_concert_submitBtn']))
{
    $CName = $_POST['concert_name'];
    $CSDate = $_POST['concert_SDate'];
    $SSDate = $_POST['session_SDate'];
    $SEDate = $_POST['session_EDate'];
    $CSinger = $_POST['concert_singer'];
    $COrganizer = $_POST['concert_organizer'];
    $CVenue = $_POST['concert_venue'];
    $CStatus = $_POST['concert_status'];
    $CDescrip = $_POST['desc_data'];
    $shortimg = $_POST['shortimg'];
    $longimg = $_POST['longimg'];
    $locationimg = $_POST['locationimg'];
    
    $insert_concert = "insert into concert(Concert_ID, Concert_Name, Concert_StartDate, Concert_Description, Session_StartDate, Session_EndDate, Concert_Ver_Image, Concert_Hor_Image, Seat_Image, Concert_Status, Singer_ID, Venue_ID, Organizer_ID) values (NULL,'$CName','$CSDate','$CDescrip','$SSDate','$SEDate','$shortimg','$longimg','$locationimg','$CStatus','$CSinger','$CVenue','$COrganizer')";
    $run = mysqli_query($connect,$insert_concert);
    $lastid = mysqli_insert_id($connect);

    //xml add (for search function at user side)
    $xmldoc = new DomDocument( '1.0' );
    $xmldoc->preserveWhiteSpace = false;
    $xmldoc->formatOutput = true;

    if( $xml = file_get_contents('../../../search/concert.xml') ) {
        $xmldoc->loadXML( $xml, LIBXML_NOBLANKS );

        // find the headercontent tag
        $root = $xmldoc->getElementsByTagName('pages')->item(0);

        // create the <concert> tag
        $concert = $xmldoc->createElement('concert');

        // add the concert tag before the first element in the <headercontent> tag
        $root->insertBefore( $concert, $root->firstChild );

        // create other elements and add it to the <concert> tag.
        $nameElement = $xmldoc->createElement('concert_name');
        $concert->appendChild($nameElement);
        $nameText = $xmldoc->createTextNode($CName);
        $nameElement->appendChild($nameText);

        $xmldoc->save('../../../search/concert.xml');
    }
    if($run)
    {
        if(isset($_POST["area_name"]))
        {
            for($i = 0; $i < count($_POST["area_name"]); $i++)
            {
                $areaname = $_POST["area_name"][$i];
                $areaprice = $_POST["area_price"][$i];
                $numberOfseat = $_POST['numberOfseat'][$i];
                $insertvenue = "insert into ticket_price (Price_Area, Price, Seat_No, Venue_ID, Concert_ID) values ('$areaname','$areaprice','$numberOfseat','$CVenue','$lastid')";
                $run = mysqli_query($connect,$insertvenue);
                if($run == false)
                    break;
                else
                    continue;
            }
        }
    }
    echo json_encode($run);
}

if(isset($_POST['update_concert_submitBtn']))
{
    $id = $_POST['concert_id'];
    $CName = $_POST['concert_name'];
    $CSDate = $_POST['concert_SDate'];
    $SSDate = $_POST['session_SDate'];
    $SEDate = $_POST['session_EDate'];
    $CSinger = $_POST['concert_singer'];
    $COrganizer = $_POST['concert_organizer'];
    $CVenue = $_POST['concert_venue'];
    $CStatus = $_POST['concert_status'];
    $CDescrip = $_POST['desc_data'];
    $shortimg = $_POST['shortimg'];
    $longimg = $_POST['longimg'];
    $locationimg = $_POST['locationimg'];

    //get current concert name
    $concert_query = mysqli_query($connect, "SELECT * FROM concert WHERE Concert_ID = $id");
    $concert_result = mysqli_fetch_assoc($concert_query);
    $OLDNAME = $concert_result['Concert_Name'];
    
    if($OLDNAME != $CName)
    {
        //xml update
        $xmldoc = new DomDocument( '1.0' );
        $xmldoc->preserveWhiteSpace = false;
        $xmldoc->formatOutput = true;

        if($xml = file_get_contents('../../../search/concert.xml'))
        {
            $xmldoc->loadXML( $xml, LIBXML_NOBLANKS );
            $xpath = new DOMXPath($xmldoc);

            if($CName != "")
            {
                $nodes = $xpath->query("//pages/concert[concert_name[text() = '$OLDNAME' ]]");
                $nodes->item(0)->parentNode->removeChild($nodes->item(0));

                //find the headercontent tag
                $root = $xmldoc->getElementsByTagName('pages')->item(0);

                // create the <concert> tag
                $concert = $xmldoc->createElement('concert');

                // add the concert tag before the first element in the <headercontent> tag
                $root->insertBefore( $concert, $root->firstChild );

                // create other elements and add it to the <concert> tag.
                $nameElement = $xmldoc->createElement('concert_name');
                $concert->appendChild($nameElement);
                $nameText = $xmldoc->createTextNode($CName);
                $nameElement->appendChild($nameText);

                $xmldoc->save('../../../search/concert.xml');
            }
        }
    }

    if($shortimg === "none" && $longimg === "none" && $locationimg === "none")
        $update_concert = "update concert set Concert_Name='$CName', Concert_StartDate='$CSDate',
                            Concert_Description='$CDescrip',Session_StartDate='$SSDate',
                            Session_EndDate='$SEDate',Concert_Status='$CStatus',Singer_ID='$CSinger',Venue_ID='$CVenue',
                            Organizer_ID='$COrganizer' where Concert_ID = '$id'";
    else if($shortimg === "none" && $longimg !== "none" && $locationimg === "none")
        $update_concert = "update concert set Concert_Name='$CName', Concert_StartDate='$CSDate',
                            Concert_Description='$CDescrip',Session_StartDate='$SSDate',
                            Session_EndDate='$SEDate',Concert_Status='$CStatus',Singer_ID='$CSinger',Venue_ID='$CVenue',
                            Organizer_ID='$COrganizer',Concert_Hor_Image='$longimg' where Concert_ID = '$id'";
    else if($shortimg !== "none" && $longimg === "none" && $locationimg === "none")
        $update_concert = "update concert set Concert_Name='$CName', Concert_StartDate='$CSDate',
                            Concert_Description='$CDescrip',Session_StartDate='$SSDate',
                            Session_EndDate='$SEDate',Concert_Status='$CStatus',Singer_ID='$CSinger',Venue_ID='$CVenue',
                            Organizer_ID='$COrganizer',Concert_Ver_Image='$shortimg' where Concert_ID = '$id'";
    else if($shortimg === "none" && $longimg === "none" && $locationimg !== "none")
        $update_concert = "update concert set Concert_Name='$CName', Concert_StartDate='$CSDate',
                            Concert_Description='$CDescrip',Session_StartDate='$SSDate',
                            Session_EndDate='$SEDate',Concert_Status='$CStatus',Singer_ID='$CSinger',Venue_ID='$CVenue',
                            Organizer_ID='$COrganizer',Seat_Image='$locationimg' where Concert_ID = '$id'";
    else if($shortimg !== "none" && $longimg !== "none" && $locationimg !== "none")
        $update_concert = "update concert set Concert_Name='$CName', Concert_StartDate='$CSDate',
                            Concert_Description='$CDescrip',Session_StartDate='$SSDate',
                            Session_EndDate='$SEDate',Concert_Status='$CStatus',Singer_ID='$CSinger',Venue_ID='$CVenue',
                            Organizer_ID='$COrganizer',Concert_Ver_Image='$shortimg',Concert_Hor_Image='$longimg',Seat_Image='$locationimg' where Concert_ID = '$id'";

    $run = mysqli_query($connect,$update_concert);
    if($run)
    {
        if(isset($_POST["area_name"]))
        {
            for($i = 0; $i < count($_POST["area_name"]); $i++)
            {
                $areaID = $_POST["price_id"][$i];
                $areaname = $_POST["area_name"][$i];
                $areaprice = $_POST["area_price"][$i];
                $numberOfseat = $_POST['numberOfseat'][$i];
                $areaDEL = $_POST["price_id_del"][$i];

                if($areaDEL == "1")
                {
                    $modify = "update ticket_price set ticket_price_unable = 1 where Price_ID='$areaID'";
                }
                else if($areaID === "")
                {
                    $modify = "insert into ticket_price (Price_Area, Price, Seat_No, Venue_ID, Concert_ID) values ('$areaname','$areaprice','$numberOfseat','$CVenue','$id')";
                }
                else
                {
                    $modify = "update ticket_price set Price_Area='$areaname', Price='$areaprice', Seat_No='$numberOfseat' where Price_ID='$areaID' and Venue_ID='$CVenue' and Concert_ID='$id'";
                }
                $run = mysqli_query($connect,$modify);
                if($run == false)
                    break;
                else
                    continue;
            }
        }
    }
    echo json_encode($run);
}
/*End*/

if(isset($_POST['email_submit_btn']))
{
    $email = $_POST['emaill_id'];
        if($email == null || $email === "")
        {
            $message = "*Please fill in this field";
            $error_code = 1;
            //create an object to store all value
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            if(strcmp($_SESSION['admin_email'],$email)==0)
            {
                $message = "";
                $error_code = 0;
                $returnArr = [$message,$error_code];    
                echo json_encode($returnArr);
            }
            else
            {
                $message = "";
                $error_code = 3;
                $returnArr = [$message,$error_code];    
                echo json_encode($returnArr);
            }
        }
}

if(isset($_POST['email_new_key_submit_btn']))
{
    $email = $_POST['emaill_id'];
        if($email == null || $email === "")
        {
            $message = "*Please fill in this field";
            $error_code = 1;
            //create an object to store all value
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
}

if(isset($_POST['email_new_submit_btn']))
{
    $email = $_POST['emaill_id'];
    $email_query = "select * from admin where Admin_Email = '$email'";
    $email_query_run = mysqli_query($connect,$email_query);
        if($email == null || $email === "")
        {
            $message = "*Please fill in this field";
            $error_code = 1;
            //create an object to store all value
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $message ="*Invalid email address";
                $error_code = 1;
                $returnArr = [$message,$error_code];    
                echo json_encode($returnArr);
            }
            else
            {
                if(mysqli_num_rows($email_query_run))
                {
                    $message = "";
                    $error_code = 3;
                    $returnArr = [$message,$error_code];    
                    echo json_encode($returnArr);
                }
                else
                {
                    $message = "";
                    $error_code = 0;
                    $returnArr = [$message,$error_code];    
                    echo json_encode($returnArr);
                }
            }
        }
}

if(isset($_POST['new_password_submit_btn_blur']))
{
    $password_valid = $_POST["password_valid"];
    if($password_valid === "" || $password_valid == null)
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        $message = "";
        $error_code = 0;
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
}

if(isset($_POST['new_password_submit_btn_keyup']))
{
    $keypassword_valid = $_POST["keypassword_valid"];
    $validation = 3;
    $a = $b = $c = $d = $e = $f = 3;
   
    if(preg_match('#[0-9]#', $keypassword_valid) === 1)
    {
        $number_valid = "rgb(0, 204, 0)";
        $a = 1;
        $number_icon = 1;
    }
    else
    {
        $number_valid = "rgba(255, 0, 0, 0.8)";
        $a = 0;
        $number_icon = 0;
    }

    if(preg_match("/[A-Z]/", $keypassword_valid) === 1)
    {
          $capital_valid = "rgb(0, 204, 0)";
          $b = 1;
          $capital_icon = 1;
    }
    else
    {
        $capital_valid = "rgba(255, 0, 0, 0.8)";
        $b = 0;
        $capital_icon = 0;
    }

    if(preg_match("/[a-z]/", $keypassword_valid) === 1)
    {
        $letter_valid = "rgb(0, 204, 0)";
        $c = 1;
        $letter_icon = 1;
    }
    else
    {
        $letter_valid = "rgba(255, 0, 0, 0.8)";
        $c = 0;
        $letter_icon = 0;
    }

    if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $keypassword_valid) === 1)
    {
        $special_valid = "rgb(0, 204, 0)";
        $d = 1;
        $special_icon = 1;
    }
    else
    {
        $special_valid = "rgba(255, 0, 0, 0.8)";
        $d = 0;
        $special_icon = 0;
    }

    if(strlen($keypassword_valid) >= 12 && strlen($keypassword_valid) <= 20)
    {
        $length_valid = "rgb(0, 204, 0)";
        $e = 1;
        $length_icon = 1;
    }   
    else
    {
        $length_valid = "rgba(255, 0, 0, 0.8)";
        $e = 0;
        $length_icon = 0;
    }

    if($keypassword_valid === "" || $keypassword_valid == null)
    {
        $isnull = 1;
    }
    else
    {
        $isnull = 0;
    }

    if($a == 0 || $b == 0 || $c == 0 || $d == 0 || $e == 0)
        $validation = 0;
    else
        $validation = 1;
    
    //create an object to store all value
    $returnArr = [$length_valid,$number_valid,$capital_valid,$letter_valid,$special_valid,$validation,$length_icon,$number_icon,$capital_icon,$letter_icon,$special_icon,$isnull];    
    echo json_encode($returnArr);
}

if(isset($_POST['cpassword_submit_btn']))
{
    $cpassword_valid = $_POST["cpassword_valid"];
    $pw = md5($cpassword_valid);
    $admin_email = $_SESSION['admin_email'];
    $match_query = "select * from admin where Admin_Email = '$admin_email' and Admin_Password = '$pw'";
    $match_query_run = mysqli_query($connect,$match_query);
    if($cpassword_valid === "" || $cpassword_valid == null)
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        if(mysqli_num_rows($match_query_run))
        {
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "";
            $error_code = 3;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        
    }
}

if(isset($_POST['change_email_submitBtn']))
{
    $current_email = $_POST['admin_current_email'];
    $new_email = $_POST['admin_new_email'];
    $password = $_POST['admin_password'];
    $pw = md5($cpassword);

    $vkey = md5(time().$new_email);
    $email_update = "update Admin set Admin_Email = '$new_email', Admin_Vkey = '$vkey', Admin_Verify = 0 where Admin_Email = '$current_email'";
    $run = mysqli_query($connect,$email_update);

    $to = $new_email;
    $subject = "Concerta Admin:: Email Verification";
    $message = "<p style='font-size: 20px;'>Click the button below to verify your account at Concerta Admin.</p>
    <a href='http://localhost/concerta/Admin/php/validation/admin_verify.php?vkey=$vkey'' style='display: block; text-decoration: none; color: white; background-color: #3f89e7; border-radius: 8px; font-weight: 500; font-size: 17px; margin-top: 40px; width: 110px; padding: 10px 20px;'>Verify Account</a>";
    $headers = "From: concerta.my@gmail.com \r\n";
    $headers .= "MIME-Version: 1.0"."\r\n";
    $headers .= "Content-type:text/html;charset=UTP-8"."\r\n";

    mail($to,$subject,$message,$headers);
  
    echo json_encode($run);
}

if(isset($_POST['new_cpassword_submit_btn']))
{
    $password_valid = $_POST["password_valid"];
    $cpassword_valid = $_POST["cpassword_valid"];
    if($cpassword_valid === "" || $cpassword_valid == null)
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        if($cpassword_valid === $password_valid)
        {
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "*Password does not match";
            $error_code = 1;
            //create an object to store all value
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
    }
}

if(isset($_POST['old_password_submit_btn']))
{
    $old_password_valid = $_POST["old_password_valid"];
    $pw = md5($old_password_valid);
    $admin_email = $_SESSION['admin_email'];
    $match_query = "select * from admin where Admin_Email = '$admin_email' and Admin_Password = '$pw'";
    $match_query_run = mysqli_query($connect,$match_query);
    if($old_password_valid === "" || $old_password_valid == null)
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        if(mysqli_num_rows($match_query_run))
        {
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "";
            $error_code = 3;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        
    }
}

if(isset($_POST['change_password_submit_btn']))
{
    $old_password = $_POST['old_admin_pass'];
    $new_cpassword = $_POST['admin_new_cpass'];
    $old_pw = md5($old_password);
    $new_pw = md5($new_cpassword);
    $email = $_SESSION['admin_email'];

    $change_pass = "update admin set Admin_Password = '$new_pw' where Admin_Email = '$email' and Admin_Password = '$old_pw'";
    $run = mysqli_query($connect,$change_pass);

    echo json_encode($run);
}

if(isset($_POST['phone_submit_btn']))
{
    $phone_valid = $_POST["phone_valid"];
    if($phone_valid === "" || $phone_valid == null)
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];
        echo json_encode($returnArr);
    }
    else
    {
        if(strncasecmp($phone_valid, "+60",1)==0 || $phone_valid > 13)
        {
            $message = "*Invalid format. E.g.:012 345 6789";
            $error_code = 1;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "";
            $error_code = 0;
            //create an object to store all value
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
    }
}

if(isset($_POST['check_merchandise_name']))
{
    $text_valid = $_POST["text_valid"];
    if($text_valid == null || $text_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        $query = mysqli_query($connect,"select * from merchandise where Merchandise_Name = '$text_valid'");
        if(mysqli_num_rows($query))
        {
            $message = "*This merchandise has been stored in database";
            $error_code = 1;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
    }
}

if(isset($_POST['check_update_merchandise_name']))
{
    $text_valid = $_POST["text_valid"];
    $id = $_POST['id'];
    if($text_valid == null || $text_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        $query = mysqli_query($connect,"select * from merchandise where Merchandise_Name = '$text_valid' and Merchandise_ID != '$id'");
        if(mysqli_num_rows($query))
        {
            $message = "*This merchandise has been stored in database";
            $error_code = 1;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
    }
}

if(isset($_POST['check_venue_name']))
{
    $text_valid = $_POST["text_valid"];
    if($text_valid == null || $text_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        $query = mysqli_query($connect,"select * from venue where Venue_Name = '$text_valid'");
        if(mysqli_num_rows($query))
        {
            $message = "*This venue has been stored in database";
            $error_code = 1;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
    }
}

if(isset($_POST['check_update_venue_name']))
{
    $text_valid = $_POST["text_valid"];
    $id = $_POST['id'];
    if($text_valid == null || $text_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        $query = mysqli_query($connect,"select * from venue where Venue_Name = '$text_valid' and Venue_ID != '$id'");
        if(mysqli_num_rows($query))
        {
            $message = "*This venue has been stored in database";
            $error_code = 1;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
    }
}

if(isset($_POST['check_concert_name']))
{
    $text_valid = $_POST["text_valid"];
    if($text_valid == null || $text_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        $query = mysqli_query($connect,"select * from concert where Concert_Name = '$text_valid'");
        $run = mysqli_fetch_assoc($query);
        if(mysqli_num_rows($query))
        {
            $message = "*This concert has been stored in database";
            $error_code = 1;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
    }
}

if(isset($_POST['check_update_concert_name']))
{
    $text_valid = $_POST["text_valid"];
    $id = $_POST["id"];
    if($text_valid == null || $text_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        $query = mysqli_query($connect,"select * from concert where Concert_Name = '$text_valid' and Concert_ID != '$id'");
        $run = mysqli_fetch_assoc($query);
        if(mysqli_num_rows($query))
        {
            $message = "*This concert has been stored in database";
            $error_code = 1;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
    }
}
?>