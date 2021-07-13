<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    if(isset($_GET['view']))
	{
        $id = $_GET['id'];
        $result = "select * from merchandise where Merchandise_ID = '$id'";
		$result_run = mysqli_query($connect,$result);
        $row = mysqli_fetch_assoc($result_run);
        
        $concert = $row['Concert_ID'];
        $locationextension = pathinfo($row['Merchandise_Image'],PATHINFO_BASENAME);

        $concert_result = mysqli_query($connect,"select Concert_Name from concert where Concert_ID = '$concert'");
        $row_concert = mysqli_fetch_assoc($concert_result);

        $rating_info = mysqli_query($connect,"select round(avg(A.Rating_Star),1) as 'star', count(A.Rating_ID) as 'comment', sum(B.S_Merchandise_Qty) as 'sold' 
        from rating A, s_merchandise B, merchandise C, purchase D where D.Purchase_ID = B.Purchase_ID and A.S_Merchandise_ID = B.S_Merchandise_ID 
        and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 and C.Merchandise_ID = '$id'");
        $rating = mysqli_fetch_assoc($rating_info);

        //comment detail
        $all_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, E.Cust_Gender 
        from rating A, s_merchandise B, merchandise C, purchase D, customer E where E.Cust_ID and A.Cust_ID and D.Purchase_ID = B.Purchase_ID and D.Cust_ID = E.Cust_ID 
        and A.Cust_ID = E.Cust_ID and A.S_Merchandise_ID = B.S_Merchandise_ID and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 
        and C.Merchandise_ID = '$id' order by A.Rating_ID desc");

        $star1_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, E.Cust_Gender 
        from rating A, s_merchandise B, merchandise C, purchase D, customer E where E.Cust_ID and A.Cust_ID and D.Purchase_ID = B.Purchase_ID and D.Cust_ID = E.Cust_ID 
        and A.Cust_ID = E.Cust_ID and A.S_Merchandise_ID = B.S_Merchandise_ID and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 
        and C.Merchandise_ID = '$id' and A.Rating_Star = 1 order by A.Rating_ID desc");

        $star2_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, E.Cust_Gender 
        from rating A, s_merchandise B, merchandise C, purchase D, customer E where E.Cust_ID and A.Cust_ID and D.Purchase_ID = B.Purchase_ID and D.Cust_ID = E.Cust_ID 
        and A.Cust_ID = E.Cust_ID and A.S_Merchandise_ID = B.S_Merchandise_ID and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 
        and C.Merchandise_ID = '$id' and A.Rating_Star = 2 order by A.Rating_ID desc");

        $star3_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, E.Cust_Gender 
        from rating A, s_merchandise B, merchandise C, purchase D, customer E where E.Cust_ID and A.Cust_ID and D.Purchase_ID = B.Purchase_ID and D.Cust_ID = E.Cust_ID 
        and A.Cust_ID = E.Cust_ID and A.S_Merchandise_ID = B.S_Merchandise_ID and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 
        and C.Merchandise_ID = '$id' and A.Rating_Star = 3 order by A.Rating_ID desc");

        $star4_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, E.Cust_Gender 
        from rating A, s_merchandise B, merchandise C, purchase D, customer E where E.Cust_ID and A.Cust_ID and D.Purchase_ID = B.Purchase_ID and D.Cust_ID = E.Cust_ID 
        and A.Cust_ID = E.Cust_ID and A.S_Merchandise_ID = B.S_Merchandise_ID and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 
        and C.Merchandise_ID = '$id' and A.Rating_Star = 4 order by A.Rating_ID desc");

        $star5_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, E.Cust_Gender 
        from rating A, s_merchandise B, merchandise C, purchase D, customer E where E.Cust_ID and A.Cust_ID and D.Purchase_ID = B.Purchase_ID and D.Cust_ID = E.Cust_ID 
        and A.Cust_ID = E.Cust_ID and A.S_Merchandise_ID = B.S_Merchandise_ID and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 
        and C.Merchandise_ID = '$id' and A.Rating_Star = 5 order by A.Rating_ID desc");

        $n = $rating['star'];
		$whole = floor($n);
		$fraction = $n - $whole; // remainder
	}
?>
    <div class="page_position">
        <div class="position_left">
            <label>Merchandise</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Product</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <a rel="tab" href="merchandise.php">Merchandise</a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">View Merchandise</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">
	<div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>
        <form action="" class="add_merch_form" method="post" autocomplete="off">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title" style="margin-bottom:30px">View Merchandise</div>
                <div style="clear:both; float:left; width:38%; ">
                    <div style="float:left; width:100%;">
                        <div class="page">
                            <div class="wrapper-location active">
                                <div class="image-location">
                                    <img class="preimg-location" src="<?php echo $row['Merchandise_Image']; ?>" alt="" style="display: block;">
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
                        <textarea type="text" class="checking_merch_name" style="padding:10px; resize: none;" name="merch_name" readonly><?php echo $row['Merchandise_Name']; ?></textarea>
                        <label>Merchandise Name</label>
                    </div>
                    <div class="txt_field" style="clear:both;">
                        <div class="view_desc" style="height:246px; padding:10px 10px 0 10px;">
                            <?php echo $row['Merchandise_Description']?>
                        </div>
                        <label>Merchandise Description</label>
                    </div>
                </div>
                <div style="clear:both;">
                    <div class="txt_field" style="width:30%; float:left; margin-bottom:0; margin-top:0;">
                        <input type="number" name="merch_price" class="checking_merch_price" value="<?php echo $row['Merchandise_Price']?>" readonly>
                        <label>Merchandise Price</label>
                    </div>
                    <div class="txt_field" style="width:30%; float:left; margin-bottom:0; margin-left: 5%; margin-top:0;">
                        <input type="number" name="merch_lprice" class="checking_merch_lprice" value="<?php echo $row['Merchandise_ListPrice']?>" readonly>
                        <label>Merchandise List Price</label>
                    </div>
                    <div class="txt_field" style="width:30%; float:left; margin-bottom:0; margin-left: 5%; margin-top:0;">
                        <input type="number" name="merch_stock" class="checking_merch_stock" value="<?php echo $row['Merchandise_Stock']?>" readonly>
                        <label>Stock On Hand</label>
                    </div>
                    <div class="txt_field" style="width:30%; clear:both; float:left; margin-bottom:0;">
                        <input type="number" name="merch_stock" class="checking_merch_stock" value="<?php echo $row['Merchandise_Weight']?>" readonly>
                        <label>Merchandise Weight</label>
                    </div>
                    <div class="txt_field" style="margin-left: 5%; width:30%; float:left; margin-bottom:0;">
                        <textarea type="text" style="resize: none;height: 13px;overflow: hidden;padding: 8px;" name="merch_name" readonly><?php echo $row_concert['Concert_Name']; ?></textarea>
                        <label>Concert</label>
                    </div>
                    <div class="txt_field" style="width:30%; float:left; margin-bottom:30px; margin-left:5%">
                        <input type="text" value="<?php 
                        if($row['Merchandise_Status']==0)
                            echo "Save";
                        else if($row['Merchandise_Status']==1)
                            echo "On Self";
                        else if ($row['Merchandise_Status']==2)
                            echo "Off Self";
                        ?>" readonly>
                        <label>Status</label>
                    </div>
					<?php
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
							echo "<img src='images/customer/female_profile.png'>";
						else
							echo "<img src='images/customer/male_profile.png'>";
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
							echo "<img src='images/customer/female_profile.png'>";
						else
							echo "<img src='images/customer/male_profile.png'>";
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
							echo "<img src='images/customer/female_profile.png'>";
						else
							echo "<img src='images/customer/male_profile.png'>";
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
							echo "<img src='images/customer/female_profile.png'>";
						else
							echo "<img src='images/customer/male_profile.png'>";
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
							echo "<img src='images/customer/female_profile.png'>";
						else
							echo "<img src='images/customer/male_profile.png'>";
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
	?>
                <div class="button_field">
                    <button class="merch_cancelbtn" type="button" onclick="window.history.back()" style="background-color:#f44336">Back</button>
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