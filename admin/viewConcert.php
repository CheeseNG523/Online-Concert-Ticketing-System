<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    if(isset($_GET['view']))
	{
        $concert_id = $_GET['id'];
        $result = "select *,
                  DATE_FORMAT(Concert_StartDate, '%Y-%m-%dT%H:%i') as CSDate,
                  DATE_FORMAT(Session_StartDate, '%Y-%m-%dT%H:%i') as SSDate,
                  DATE_FORMAT(Session_EndDate, '%Y-%m-%dT%H:%i') as SEDate 
                  from concert where Concert_ID = '$concert_id'";
		$result_run = mysqli_query($connect,$result);
        $row = mysqli_fetch_assoc($result_run);

        $venue_id = $row['Venue_ID'];
        $ticket_price_list = mysqli_query($connect,"select * from ticket_price where Concert_ID = '$concert_id' and Venue_ID = '$venue_id' and ticket_price_unable = 0 order by Price desc");


        $shortextension = pathinfo($row['Concert_Ver_Image'],PATHINFO_BASENAME);

        $longextension = pathinfo($row['Concert_Hor_Image'],PATHINFO_BASENAME);

        $locationextension = pathinfo($row['Seat_Image'],PATHINFO_BASENAME);

        $venue_list = mysqli_query($connect,"select * from venue");
        $singer_list = mysqli_query($connect,"select * from singer");
        $organizer_list = mysqli_query($connect,"select * from organizer");

        $rating_info = mysqli_query($connect,"select round(avg(A.Rating_Star),1) as 'star', count(A.Rating_ID) as 'comment' from rating A, purchase B, s_ticket C, 
        ticket_price D, concert E where A.Ticket_Purchase_ID = B.Purchase_ID and B.Purchase_ID = C.Purchase_ID and C.PriceID = D.Price_ID and 
        D.Concert_ID = E.Concert_ID and E.Concert_ID = '$concert_id'");
        $rating = mysqli_fetch_assoc($rating_info);

        //comment detail
        $all_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, 
        E.Cust_Gender from rating A, s_ticket B, ticket_price C, concert D, customer E, purchase F where A.Ticket_Purchase_ID = F.Purchase_ID and 
        B.Purchase_ID = F.Purchase_ID and B.PriceID = C.Price_ID and D.Concert_ID = C.Concert_ID and F.Card_verify=1 and 
        D.Concert_ID = '$concert_id' group by F.Purchase_ID order by A.Rating_ID desc");

        $star1_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, 
        E.Cust_Gender from rating A, s_ticket B, ticket_price C, concert D, customer E, purchase F where A.Ticket_Purchase_ID = F.Purchase_ID and 
        B.Purchase_ID = F.Purchase_ID and B.PriceID = C.Price_ID and D.Concert_ID = C.Concert_ID and F.Card_verify=1 and 
        D.Concert_ID = '$concert_id' and A.Rating_Star = 1 group by F.Purchase_ID order by A.Rating_ID desc");

        $star2_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, 
        E.Cust_Gender from rating A, s_ticket B, ticket_price C, concert D, customer E, purchase F where A.Ticket_Purchase_ID = F.Purchase_ID and 
        B.Purchase_ID = F.Purchase_ID and B.PriceID = C.Price_ID and D.Concert_ID = C.Concert_ID and F.Card_verify=1 and 
        D.Concert_ID = '$concert_id' and A.Rating_Star = 2 group by F.Purchase_ID order by A.Rating_ID desc");

        $star3_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, 
        E.Cust_Gender from rating A, s_ticket B, ticket_price C, concert D, customer E, purchase F where A.Ticket_Purchase_ID = F.Purchase_ID and 
        B.Purchase_ID = F.Purchase_ID and B.PriceID = C.Price_ID and D.Concert_ID = C.Concert_ID and F.Card_verify=1 and 
        D.Concert_ID = '$concert_id' and A.Rating_Star = 3 group by F.Purchase_ID order by A.Rating_ID desc");

        $star4_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, 
        E.Cust_Gender from rating A, s_ticket B, ticket_price C, concert D, customer E, purchase F where A.Ticket_Purchase_ID = F.Purchase_ID and 
        B.Purchase_ID = F.Purchase_ID and B.PriceID = C.Price_ID and D.Concert_ID = C.Concert_ID and F.Card_verify=1 and 
        D.Concert_ID = '$concert_id' and A.Rating_Star = 4 group by F.Purchase_ID order by A.Rating_ID desc");

        $star5_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, 
        E.Cust_Gender from rating A, s_ticket B, ticket_price C, concert D, customer E, purchase F where A.Ticket_Purchase_ID = F.Purchase_ID and 
        B.Purchase_ID = F.Purchase_ID and B.PriceID = C.Price_ID and D.Concert_ID = C.Concert_ID and F.Card_verify=1 and 
        D.Concert_ID = '$concert_id' and A.Rating_Star = 5 group by F.Purchase_ID order by A.Rating_ID desc");

        $n = $rating['star'];
		$whole = floor($n);
		$fraction = $n - $whole; // remainder
	}
?>
<script src="js/profile_form.js"></script>
<script src="js/ckeditor/ckeditor.js"></script>
    <div class="page_position">
        <div class="position_left">
            <label>Concert</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Product</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <a rel="tab" href="concert.php">Concert</a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">View Concert</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">              
	<div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>
        <form class="concert_update_form" action="" method="post" autocomplete="off">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title">View Concert</div>
                <input class="concert_id" name="concert_id" type="text" value="<?php echo $concert_id; ?>" hidden>
                <div style="float:left; width:38%;">
                    <div class="page">
                        <div class="wrapper-short active">
                            <div class="image-short">
                                <img class="preimg-short" src="<?php echo $row['Concert_Ver_Image']; ?>" alt="" style="display: block;">
                            </div>
                            <div class="img-content-short" style="margin: 0 auto;">
                                <div class="icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="text">No file chosen, yet!</div>
                                <label class="error_shortimg" style="color: red; clear:both; font-size: 13px; padding: 0; font-weight:600"></label>
                            </div>
                            <div class="file-name-short">
                                <?php echo $shortextension; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float:left; width:58%; margin-left: 4%; margin-bottom:20px;">
                    <div class="page">
                        <div class="wrapper-long active">
                            <div class="image-long">
                                <img class="preimg-long" src="<?php echo $row['Concert_Hor_Image']; ?>" alt="" style="display: block;">
                            </div>
                            <div class="img-content-long" style="margin: 0 auto;">
                                <div class="icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="text">No file chosen, yet!</div>
                                <label class="error_longimg" style="color: red; clear:both; font-size: 13px; padding: 0; font-weight:600"></label>
                            </div>
                            <div class="file-name-long">
                                <?php echo $longextension; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="clear:both; float:left; width:38%; ">
                    <div style="float:left; width:100%;">
                        <div class="page">
                            <div class="wrapper-location active">
                                <div class="image-location">
                                    <img class="preimg-location" src="<?php echo $row['Seat_Image']; ?>" alt="" style="display: block;">
                                </div>
                                <div class="img-content-location" style="margin: 0 auto;">
                                    <div class="icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <div class="text">No file chosen, yet!</div>
                                    <label class="error_locationimg" style="color: red; clear:both; font-size: 13px; padding: 0; font-weight:600"></label>
                                </div>
                                <div class="file-name-location">
                                    <?php echo $locationextension; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float:left; width:58%; margin-left: 4%;">
                    <div class="txt_field" style="clear:both; margin-bottom:0; margin-top:0;">
                        <textarea readonly type="text" class="checking_concert_name" style="padding:10px; resize: none;" name="concert_name"><?php echo $row['Concert_Name']; ?></textarea>
                        <label>Concert Name</label>
                        <label class="error_concert_name" style="color: red; clear:both; top: 60px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="clear:both;">
                        <div class="view_desc" style="height:246px; padding:10px 10px 0 10px;">
                            <?php echo $row['Concert_Description']?>
                        </div>
                        <label>Concert Description</label>
                    </div>
                </div>
                <div style="clear:both;">
                    <div class="txt_field" style="width:48.5%; float:left; margin-bottom:0;  margin-top:0;">
                        <input readonly id="concert_CSDate" value="<?php echo $row['CSDate']; ?>" onkeydown="return false" type="datetime-local" name="concert_SDate" class="checking_CSDate" onchange="setCdate()">
                        <label>Concert Start Date</label>
                        <label class="error_CSDate" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; float:left; margin-bottom:0; margin-left: 3%; margin-top:0;">
                            <?php
                            while($singer_row=mysqli_fetch_assoc($singer_list))
                            {
                                if($row['Singer_ID']==$singer_row["Singer_ID"])
                                {
                                    ?>
                                    <input readonly type='text' value="<?php echo $singer_row["Singer_Name"]; ?>">
                                    <?php
                                }

                            }
                            ?>
                        <label>Singer</label>
                        <label class="error_CSinger" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; float:left; margin-left: 3%; margin-bottom:0; margin-top:0;">
                            <?php
                            while($organizer_row=mysqli_fetch_assoc($organizer_list))
                            {
                                if($row['Organizer_ID']==$organizer_row["Organizer_ID"])
                                {
                                    ?>
                                        <input type="text" readonly value="<?php echo $organizer_row["Organizer_Name"]; ?>">
                                    <?php
                                }
                                
                            }
                            ?>
                        <label>Organizer</label>
                        <label class="error_COrganizer" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; clear:both; float:left;">
                        <input readonly value="<?php echo $row["SSDate"];?>" onkeydown="return false" id="concert_SSDate" type="datetime-local" name="session_SDate" class="checking_SSDate" onchange="setSdate()">
                        <label>Session Start Date</label>
                        <label class="error_SSDate" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; float:left; margin-left: 3%;">
                        <input readonly value="<?php echo $row["SEDate"];?>" onkeydown="return false" id="concert_SEDate" type="datetime-local" name="session_EDate" class="checking_SEDate">
                        <label>Session End Date</label>
                        <label class="error_SEDate" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="float:left; width:22.75%; margin-left: 3%;">
                            <?php
                            while($venue_row=mysqli_fetch_assoc($venue_list))
                            {
                                if($row['Venue_ID']==$venue_row["Venue_ID"])
                                {
                                    ?>
                                        <input type="text" readonly value="<?php echo $venue_row["Venue_Name"]; ?>">
                                    <?php
                                }
                            }
                            ?>
                        <label>Venue</label>
                        <label class="error_CVenue" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; float:left; margin-left: 3%;">
                        <?php
                            if($row['Concert_Status']==0)
                            {
                                ?>
                                    <input type="text" readonly value="Saved">
                                <?php
                            }
                            else if($row['Concert_Status']==1)
                            {
                                ?>
                                    <input type="text" readonly value="Upcoming">
                                <?php
                            }
                            else if($row['Concert_Status']==2)
                            {
                                ?>
                                    <input type="text" readonly value="Ongoing">
                                <?php
                            }
                            else if($row['Concert_Status']==3)
                            {
                                ?>
                                    <input type="text" readonly value="Ended">
                                <?php
                            }
                        ?>
                        <label>Status</label>
                        <label class="error_CStatus" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;"></label>
                    </div>
                </div>
                <table class="table_container" style="background:white; margin-bottom: 30px;">
                    <thead>
                        <tr class="header-bar">
                            <th width="30%">Area Name</th>
                            <th width="30%">Price(RM)</th>
                            <th width="30%">Number of Seat</th>
                            <th width="10%">Sold</th>
                        </tr>
                    </thead>
                    <tbody class="table_content" id="table_row">
                            <?php
                            while($tp_row=mysqli_fetch_assoc($ticket_price_list))
                            {
                                $price_id = $tp_row['Price_ID'];
                                $sold_query = mysqli_query($connect,"select sum(B.S_Ticket_Qty) as 'Sold' from purchase A, s_ticket B, 
                                ticket_price C, concert D where A.Purchase_ID = B.Purchase_ID and B.PriceID = C.Price_ID and D.Concert_ID = C.Concert_ID 
                                and A.Card_verify=1 and C.Price_ID = '$price_id'");
                                $sold_run = mysqli_fetch_assoc($sold_query);
                                ?>
                                    <tr>
                                    <td hidden><input type="text" class="price-id" name="price_id[]" value="<?php echo $tp_row['Price_ID'];?>"></td>
                                    <td hidden><input type="text" class="id-is-del" name="price_id_del[]"></td>
                                    <td><input readonly value="<?php echo $tp_row['Price_Area']; ?>" class="area_name" type="text" name="area_name[]"></td>
                                    <td><input readonly value="<?php echo $tp_row['Price']; ?>" class="area_price" type="number" name="area_price[]"></td>
                                    <td><input readonly value="<?php echo $tp_row['Seat_No']; ?>" class="numberOfseat" type="text" name="numberOfseat[]" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>
                                    <td><input readonly value="<?php if($sold_run['Sold']==""||$sold_run['Sold']==null) echo '0'; else echo $sold_run['Sold']; ?>" class="numberOfseat" type="text"></td>
                                    </tr>
                                <?php
                            }
                            ?>
                    </tbody>
                </table>
                <?php
        if($row['Concert_Status'] == 3)
        {
                echo "<div class='comment'><span class='comment_title'>Concert Rating</span>";
		if(mysqli_num_rows($all_comment_query)>0)
		{
            ?>
                <div class="status-container">
                    <div class="rating-result">
                        <div class="rating">
                            <?php echo "<span class='rating-text'>".$n."</span>";?> out of 5
                        </div>
                        <div class="star">
                        <?php
                        for($i=0; $i<$whole; $i++)
                        {
                            echo '<span class="material-icons star-icon">star</span>';
                        }
                        if($fraction==0 || $fraction<0.5)
                        {
                            for($i=$whole; $i<5; $i++)
                            {
                                echo '<span class="material-icons star-icon">star_border</span>';
                            }
                        }
                        else
                        {
                            echo '<span class="material-icons star-icon">star_half</span>';
                            for($i=$whole+1; $i<5; $i++)
                            {
                                echo '<span class="material-icons star-icon">star_border</span>';
                            }
                        }
                        ?>
                        </div>
                    </div>
				<div style="margin-top: 3%;overflow-x: auto;width: 82%;">
				<div class="status-conatiner-bar active left merch-all">
					All(<?php echo mysqli_num_rows($all_comment_query)?>)
				</div>
				<div class="status-conatiner-bar left merch-star5">
					5 <span class="material-icons star-icon category_tab">star</span> (<?php echo mysqli_num_rows($star5_comment_query)?>)
				</div>
				<div class="status-conatiner-bar left merch-star4">
					4 <span class="material-icons star-icon category_tab">star</span> (<?php echo mysqli_num_rows($star4_comment_query)?>)
				</div>
				<div class="status-conatiner-bar left merch-star3">
					3 <span class="material-icons star-icon category_tab">star</span> (<?php echo mysqli_num_rows($star3_comment_query)?>)
				</div>
				<div class="status-conatiner-bar left merch-star2">
					2 <span class="material-icons star-icon category_tab">star</span> (<?php echo mysqli_num_rows($star2_comment_query)?>)
				</div>
				<div class="status-conatiner-bar left merch-star1">
					1 <span class="material-icons star-icon category_tab">star</span> (<?php echo mysqli_num_rows($star1_comment_query)?>)
				</div>
			</div>
        </div><?php
			echo "<div class='rating-all display-none' style='display:block'>";
			if(mysqli_num_rows($all_comment_query)>0)
			{
				while($rating_detail = mysqli_fetch_assoc($all_comment_query))
				{
					//to encrypt customer name
					$cust_Name = $rating_detail['Cust_Fname']." ".$rating_detail['Cust_Lname'];

					echo "<div class='rating-container'>";
					echo "<div class='cust-img'>";
					if($rating_detail['Cust_Image'] == "")
					{
						if($rating_detail['Cust_Gender'] == "Female")
							echo "<img src='../images/customer/female_profile.png'>";
						else
							echo "<img src='../images/customer/male_profile.png'>";
					}
						echo "<img src='".$rating_detail['Cust_Image']."'>";
					echo "</div>";
					echo "<div class='cust-name-star'>";
					echo "<div class='cust-name'><a href='viewcustomer.php?view&id=".$rating_detail['Cust_ID']."'>" . $cust_Name . "</a></div>";
					if($rating_detail['Rating_Star']==1)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($rating_detail['Rating_Star']==2)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($rating_detail['Rating_Star']==3)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($rating_detail['Rating_Star']==4)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($rating_detail['Rating_Star']==5)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
					}
					echo "</div>";
					if($rating_detail['Rating_Comment'] != "")
					{
						echo "<div class='cust-comment'>";
						echo $rating_detail['Rating_Comment'];
						echo "</div>";
					}
					if($rating_detail['Rating_Image'] != "")
					{
						echo "<div class='cust-rating-img'>";
						echo '<img class="preimg" src="'.$rating_detail['Rating_Image'].'" alt="">';
						echo "</div>";
					}
					echo "</div>";
				}
			}
			else
			{
				echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
			}
			echo "</div>";

			echo "<div class='rating-star1 display-none'>";
			if(mysqli_num_rows($star1_comment_query)>0)
			{
				while($star1_rating_detail = mysqli_fetch_assoc($star1_comment_query))
				{
					//to encrypt customer name
					$cust_Name = $star1_rating_detail['Cust_Fname']." ".$star1_rating_detail['Cust_Lname'];
					$name_length = strlen($cust_Name); //get name length

					echo "<div class='rating-container'>";
					echo "<div class='cust-img'>";
					if($star1_rating_detail['Cust_Image'] == "")
					{
						if($star1_rating_detail['Cust_Gender'] == "Female")
							echo "<img src='../images/customer/female_profile.png'>";
						else
							echo "<img src='../images/customer/male_profile.png'>";
					}
						echo "<img src='".$star1_rating_detail['Cust_Image']."'>";
					echo "</div>";
					echo "<div class='cust-name-star'>";
					echo "<div class='cust-name'><a href='viewcustomer.php?view&id=".$star1_rating_detail['Cust_ID']."'>" . $cust_Name . "</a></div>";
					if($star1_rating_detail['Rating_Star']==1)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star1_rating_detail['Rating_Star']==2)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star1_rating_detail['Rating_Star']==3)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star1_rating_detail['Rating_Star']==4)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star1_rating_detail['Rating_Star']==5)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
					}
					echo "</div>";
					if($star1_rating_detail['Rating_Comment'] != "")
					{
						echo "<div class='cust-comment'>";
						echo $star1_rating_detail['Rating_Comment'];
						echo "</div>";
					}
					if($star1_rating_detail['Rating_Image'] != "")
					{
						echo "<div class='cust-rating-img'>";
						echo '<img class="preimg" src="'.$star1_rating_detail['Rating_Image'].'" alt="">';
						echo "</div>";
					}
					echo "</div>";
				}
			}
			else
			{
				echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
			}
			echo "</div>";

			echo "<div class='rating-star2 display-none'>";
			if(mysqli_num_rows($star2_comment_query)>0)
			{
				while($star2_rating_detail = mysqli_fetch_assoc($star2_comment_query))
				{
					//to encrypt customer name
					$cust_Name = $star2_rating_detail['Cust_Fname']." ".$star2_rating_detail['Cust_Lname'];
					$name_length = strlen($cust_Name); //get name length

					echo "<div class='rating-container'>";
					echo "<div class='cust-img'>";
					if($star2_rating_detail['Cust_Image'] == "")
					{
						if($star2_rating_detail['Cust_Gender'] == "Female")
							echo "<img src='../images/customer/female_profile.png'>";
						else
							echo "<img src='../images/customer/male_profile.png'>";
					}
						echo "<img src='".$star2_rating_detail['Cust_Image']."'>";
					echo "</div>";
					echo "<div class='cust-name-star'>";
					echo "<div class='cust-name'><a href='viewcustomer.php?view&id=".$star2_rating_detail['Cust_ID']."'>" . $cust_Name . "</a></div>";
					if($star2_rating_detail['Rating_Star']==1)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star2_rating_detail['Rating_Star']==2)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star2_rating_detail['Rating_Star']==3)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star2_rating_detail['Rating_Star']==4)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star2_rating_detail['Rating_Star']==5)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
					}
					echo "</div>";
					if($star2_rating_detail['Rating_Comment'] != "")
					{
						echo "<div class='cust-comment'>";
						echo $star2_rating_detail['Rating_Comment'];
						echo "</div>";
					}
					if($star2_rating_detail['Rating_Image'] != "")
					{
						echo "<div class='cust-rating-img'>";
						echo '<img class="preimg" src="'.$star2_rating_detail['Rating_Image'].'" alt="">';
						echo "</div>";
					}
					echo "</div>";
				}
			}
			else
			{
				echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
			}
			echo "</div>";

			echo "<div class='rating-star3 display-none'>";
			if(mysqli_num_rows($star3_comment_query)>0)
			{
				while($star3_rating_detail = mysqli_fetch_assoc($star3_comment_query))
				{
					//to encrypt customer name
					$cust_Name = $star3_rating_detail['Cust_Fname']." ".$star3_rating_detail['Cust_Lname'];
					$name_length = strlen($cust_Name); //get name length

					echo "<div class='rating-container'>";
					echo "<div class='cust-img'>";
					if($star3_rating_detail['Cust_Image'] == "")
					{
						if($star3_rating_detail['Cust_Gender'] == "Female")
							echo "<img src='../images/customer/female_profile.png'>";
						else
							echo "<img src='../images/customer/male_profile.png'>";
					}
						echo "<img src='".$star3_rating_detail['Cust_Image']."'>";
					echo "</div>";
					echo "<div class='cust-name-star'>";
					echo "<div class='cust-name'><a href='viewcustomer.php?view&id=".$star3_rating_detail['Cust_ID']."'>" . $cust_Name . "</a></div>";
					if($star3_rating_detail['Rating_Star']==1)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star3_rating_detail['Rating_Star']==2)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star3_rating_detail['Rating_Star']==3)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star3_rating_detail['Rating_Star']==4)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star3_rating_detail['Rating_Star']==5)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
					}
					echo "</div>";
					if($star3_rating_detail['Rating_Comment'] != "")
					{
						echo "<div class='cust-comment'>";
						echo $star3_rating_detail['Rating_Comment'];
						echo "</div>";
					}
					if($star3_rating_detail['Rating_Image'] != "")
					{
						echo "<div class='cust-rating-img'>";
						echo '<img class="preimg" src="'.$star3_rating_detail['Rating_Image'].'" alt="">';
						echo "</div>";
					}
					echo "</div>";
				}
			}
			else
			{
				echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
			}
			echo "</div>";

			echo "<div class='rating-star4 display-none'>";
			if(mysqli_num_rows($star4_comment_query)>0)
			{
				while($star4_rating_detail = mysqli_fetch_assoc($star4_comment_query))
				{
					//to encrypt customer name
					$cust_Name = $star4_rating_detail['Cust_Fname']." ".$star4_rating_detail['Cust_Lname'];
					$name_length = strlen($cust_Name); //get name length

					echo "<div class='rating-container'>";
					echo "<div class='cust-img'>";
					if($star4_rating_detail['Cust_Image'] == "")
					{
						if($star4_rating_detail['Cust_Gender'] == "Female")
							echo "<img src='../images/customer/female_profile.png'>";
						else
							echo "<img src='../images/customer/male_profile.png'>";
					}
						echo "<img src='".$star4_rating_detail['Cust_Image']."'>";
					echo "</div>";
					echo "<div class='cust-name-star'>";
					echo "<div class='cust-name'><a href='viewcustomer.php?view&id=".$star4_rating_detail['Cust_ID']."'>" . $cust_Name . "</a></div>";
					if($star4_rating_detail['Rating_Star']==1)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star4_rating_detail['Rating_Star']==2)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star4_rating_detail['Rating_Star']==3)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star4_rating_detail['Rating_Star']==4)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star4_rating_detail['Rating_Star']==5)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
					}
					echo "</div>";
					if($star4_rating_detail['Rating_Comment'] != "")
					{
						echo "<div class='cust-comment'>";
						echo $star4_rating_detail['Rating_Comment'];
						echo "</div>";
					}
					if($star4_rating_detail['Rating_Image'] != "")
					{
						echo "<div class='cust-rating-img'>";
						echo '<img class="preimg" src="'.$star4_rating_detail['Rating_Image'].'" alt="">';
						echo "</div>";
					}
					echo "</div>";
				}
			}
			else
			{
				echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
			}
			echo "</div>";

			echo "<div class='rating-star5 display-none'>";
			if(mysqli_num_rows($star5_comment_query)>0)
			{
				while($star5_rating_detail = mysqli_fetch_assoc($star5_comment_query))
				{
					//to encrypt customer name
					$cust_Name = $star5_rating_detail['Cust_Fname']." ".$star5_rating_detail['Cust_Lname'];
					$name_length = strlen($cust_Name); //get name length

					echo "<div class='rating-container'>";
					echo "<div class='cust-img'>";
					if($star5_rating_detail['Cust_Image'] == "")
					{
						if($star5_rating_detail['Cust_Gender'] == "Female")
							echo "<img src='../images/customer/female_profile.png'>";
						else
							echo "<img src='../images/customer/male_profile.png'>";
					}
						echo "<img src='".$star5_rating_detail['Cust_Image']."'>";
					echo "</div>";
					echo "<div class='cust-name-star'>";
					echo "<div class='cust-name'><a href='viewcustomer.php?view&id=".$star5_rating_detail['Cust_ID']."'>" . $cust_Name . "</a></div>";
					if($star5_rating_detail['Rating_Star']==1)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star5_rating_detail['Rating_Star']==2)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star5_rating_detail['Rating_Star']==3)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star5_rating_detail['Rating_Star']==4)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star_border</span>';
					}
					else if($star5_rating_detail['Rating_Star']==5)
					{
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
						echo '<span class="material-icons star-icon disBtn">star</span>';
					}
					echo "</div>";
					if($star5_rating_detail['Rating_Comment'] != "")
					{
						echo "<div class='cust-comment'>";
						echo $star5_rating_detail['Rating_Comment'];
						echo "</div>";
					}
					if($star5_rating_detail['Rating_Image'] != "")
					{
						echo "<div class='cust-rating-img'>";
						echo '<img class="preimg" src="'.$star5_rating_detail['Rating_Image'].'" alt="">';
						echo "</div>";
					}
					echo "</div>";
				}
			}
			else
			{
				echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
			}
			echo "</div>";
		}
		else
		{
			echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
		}
		echo "</div>";
    }
	?>

                <div class="button_field">
                    <button class="concert_cancelbtn" type="button" onclick="window.history.back()" style="background-color:#f44336">Back</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
    <div class='preimg-admin'>
	<div id="Pic_Modal2" class="pic-modal">
    <!-- Preview Picture -->
    <div class="pic-modal-content">
        <span class="close preview-close-btn" title="Close Modal" style='margin-left: 5px; margin-top: -10px;'>&times;</span>
        <div class="form-container">
            <div class="page">
                <div class="wrapper">
                    <div class="image">
                        <img style="display: block;" class="preimg-preview" src="" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
$('.preimg').on('click', function(){
    $('#Pic_Modal2').css('display','block');
    var presrc = $(this).attr('src');
    $('.preimg-preview').attr('src',presrc);
})

$('.preview-close-btn').on('click',function(){
    $('#Pic_Modal2').css('display','none');
})

$(".merch-all").on('click', function(){
    $(".display-none").css("display","none");
    $('.status-conatiner-bar').removeClass("active");
    $(this).addClass("active");
    $('.rating-all').css("display","block");
})

$(".merch-star5").on('click', function(){
    $(".display-none").css("display","none");
    $('.status-conatiner-bar').removeClass("active");
    $(this).addClass("active");
    $('.rating-star5').css("display","block");
})

$(".merch-star4").on('click', function(){
    $(".display-none").css("display","none");
    $('.status-conatiner-bar').removeClass("active");
    $(this).addClass("active");
    $('.rating-star4').css("display","block");
})

$(".merch-star3").on('click', function(){
    $(".display-none").css("display","none");
    $('.status-conatiner-bar').removeClass("active");
    $(this).addClass("active");
    $('.rating-star3').css("display","block");
})

$(".merch-star2").on('click', function(){
    $(".display-none").css("display","none");
    $('.status-conatiner-bar').removeClass("active");
    $(this).addClass("active");
    $('.rating-star2').css("display","block");
})

$(".merch-star1").on('click', function(){
    $(".display-none").css("display","none");
    $('.status-conatiner-bar').removeClass("active");
    $(this).addClass("active");
    $('.rating-star1').css("display","block");
})
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>