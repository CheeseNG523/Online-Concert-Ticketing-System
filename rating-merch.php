<?php
    session_start();
	include "dataconnection.php";
    
    if(!isset($_SESSION['email']))
    {
        header("location: login.php");
    }
    else
    {
        $email = $_SESSION['email'];
        $email_query = "SELECT * FROM customer WHERE Cust_Email = '$email'";
        $email_search = mysqli_query($connect, $email_query);
        $cust_details = mysqli_fetch_assoc($email_search);
        $Cust_ID = $cust_details['Cust_ID'];

        if(isset($_GET['id']))
        {
            $purchase_ID = $_GET['id'];
            $type = 1; //submit
        }
        else if(isset($_GET['view']))
        {
            $purchase_ID = $_GET['view'];
            $type = 2; //view
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>My profile</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://kit.fontawesome.com/14a3a3f38a.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="profile_validation.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="head-foot3.css">
    <link rel="stylesheet" href="cust_profile3.css">
    <link rel="stylesheet" href="profile-sidebar1.css">
    <link rel="stylesheet" href="tnc_privacy.css">
<style>
.history-container{
    padding: 30px;
}

.history-container .back-to-prev{
    color: #b6b6b6;
    cursor: pointer;
}

.history-container .back-to-prev:hover{
    transition: 0.5s;
    color: black;
}

.history-container .back-to-prev span{
    vertical-align: middle;
    font-size: 14px;
}

.product-tab {
    color: rgb(119, 119, 255); 
    background-color: white; 
    padding: 10px 20px; 
    border-radius: 8px; 
    box-shadow: 0px 0px 32px 4px rgb(0,0,0,0.1); 
    margin-bottom: 20px;
    overflow-x: auto;
}

#toTopBtn {
	background-color: rgb(174, 106, 219);
	border: none;
	border-radius: 4px;
	color: white;
	cursor: pointer;
	height: 48px;
	width: 48px;
	right: 0;
	bottom: 50px;
	position: fixed;
	display: none;
	margin-right: 40px;
	z-index: 1200;
	opacity: 70%;
	text-align: center;
}

#toTopBtn:hover {
	background-color: rgb(109, 61, 141);
	opacity: 100%;
	transition-duration: 0.3s;
}

.sub-menu-bar{
    padding-left: 35px;
}

.history-item-container .status-container{
    width: 100%;
    height: 100%;
    overflow-x: auto;
    white-space: nowrap;
    margin: 20px 0;
    background-color: white;
    box-shadow: 0px 0px 32px 4px rgb(0 0 0 / 10%);
}

.history-item-container .status-container .status-conatiner-bar{
    width: 22%;
    font-size: 15px;
    padding: 10px;
    padding-bottom: 7px;
    text-align: center;
    border-bottom: 3px solid transparent;
    font-weight: 600;
}

.history-item-container .status-container .left{
    float: left;
}

.history-item-container .status-container .right{
    float: right;
}

.history-item-container .status-container .status-conatiner-bar:hover{
    color: rgb(119, 119, 255);
    cursor: pointer;
}

.history-item-container .status-container .active{
    color: rgb(119, 119, 255);
    border-bottom: 3px solid rgb(119, 119, 255);
    cursor: default;
}

.product-tab .merch-item-detail{
    width: 100%;
    padding: 10px 0;
    padding-bottom: 20px;
    border-bottom: 1px solid #f2f2f2;
    overflow-x: auto;
    margin-bottom: 15px;
}

.product-tab .hidden-item{
    display: none !important;
}

.product-tab .merch-item-detail .item-image-info{
    overflow-x: auto;
}

.product-tab .merch-item-detail .item-image-info img{
    width: 10%;
    vertical-align: text-top;
    float: left;
    margin-right: 10px;
}

.product-tab .merch-item-detail .item-image-info .star-icon{
    color: #faca51;
    /* fed40c */
    cursor: pointer;
    margin-left: 5px;
}

.product-tab .merch-item-detail .item-image-info .disBtn{
    cursor: default !important;
}

.product-tab .merch-item-detail .item-image-info .star-text{
    color: black;
    font-size: 12px;
    vertical-align: super;
    margin-left: 10px;
}

.product-tab .item-total{
    float: right;
    font-size: 20px;
    font-weight: 600;
}

.product-tab .item-total label{
    font-size: 15px;
    font-weight: 500;
}

.product-tab .item-status{
    float: right;
    border-left: 1px solid #d0cfcf;
    padding-left: 10px;
}

.product-tab .merch-item-viewmore{
    width: 100%;
    text-align: center;
    font-size: 14px;
    border: 1px solid #f2f2f2;
    border-top: 0;
    cursor: pointer;
}

.product-tab .merch-item-viewmore:hover{
    text-decoration: underline;
}

.product-tab .item-detail-footer{
    margin: 10px 0;
    height: auto;
    overflow-x: auto;
}

.product-tab .item-detail-footer .item-purchase-time{
    clear: both;
    color: #767676;
    font-size: 12px;
    padding-top: 15px;
    float: left;
}

.product-tab .item-detail-footer .item-detail-button{
    float: right;
    margin: 10px 0;
}

.product-tab .item-detail-footer .item-detail-button a{
    padding: 10px;
    text-decoration: none;
    margin: 0 5px;
    border: 1px solid rgb(119, 119, 255);
    font-weight: 100;
    font-size: 13px;
    color: #414141;
}

.product-tab .item-detail-footer .item-detail-button a:hover{
    color: rgb(119, 119, 255);
}

.product-tab .merch-rating-text{
    width: 100%;
    margin: 0;
}

.product-tab .merch-rating-input{
    width: 97%;
    resize: none;
    outline: none;
    /* border-radius: 5px; */
    padding: 10px;
    border-color: #ccc;
}

.product-tab .merch-rating-text label{
    font-size: 13px;
    color: #848484;
}

.product-tab .files-btn{
    border: 2px dotted #848484;
    padding: 13px 5px;
    cursor: pointer;
    width: 70px;
    height: 50px;
    display: inline-block;
    text-align: center;
}

.product-tab .files-btn .material-icons{
    vertical-align: bottom;
    color: #999999;
}

.product-tab .files-btn .text{
    font-size: 10px;
    display: block;
    color: #999999;
}

.product-tab .img-container{
    float: left;
}

.product-tab .img-container span{
    font-size: 18px;
    color: white;
    vertical-align: top;
    font-weight: 900;
    background: rgb(0,0,0,0.6);
    border-radius: 12px;
    cursor: pointer;
    position: relative;
    left: 70px;
    top: 5px;
    display: none;
    float: left;
}

.product-tab .img-container .preimg{
    width: 15%;
    height: auto;
    vertical-align: bottom;
    display: none;
}

.rating-submit-btn{
    padding: 8px 12px;
    display: block;
    margin-top: 20px;
    text-decoration: none;
    background-color: #3f89e7;
    border-radius: 4px;
    font-size: 14pt;
    color: white;
    font-weight: 600;
    float: right;
    border: none;
    outline: none;
}

.rating-submit-btn:enabled:hover {
    background-color: rgba(190,190,255,1);
    color: white;
    cursor: pointer;
	transition-duration: 0.4s;
}

</style>
</head>
<?php include "header.php"; ?>
	<div class="button">
		<a href="index.php">Home</a>
		<a href="aboutus.php">About Us</a>
		<a href="concert.php">Concert</a>
		<a href="merchandise.php">Merchandise</a>
		<a href="singer.php">Singer</a>
	</div>
  </div>
</div>

<!--Go to top button-->
<a id="toTopBtn"><i class="material-icons" style="font-size: 45px;">keyboard_arrow_up</i></a>

<script>
	//Scroll to top button
	$(window).scroll(function() 
	{
		var height = $(window).scrollTop();

		//if page height is over 500px, show button
		if(height > 500)
		{
			$('#toTopBtn').fadeIn();
		}
		else
		{
			$('#toTopBtn').fadeOut();
		}
	});

	$(document).ready(function() 
	{
		$("#toTopBtn").click(function(event)
		{
			event.preventDefault();
			$('html, body').animate({scrollTop: 0}, 'slow');
			return false;
		});
	});
</script>

<div class="profile-container">
    <div class="profile-sidebar">
    <div class='tooltip'>
        <?php 
            if($cust_details['Cust_Image']==NULL)
            {
                if($cust_details['Cust_Gender']=='M')
                {
                    echo "<img class='prof_pic' src='images/customer/male_profile.png'>";
                }
                else
                {
                    echo "<img class='prof_pic' src='images/customer/female_profile.png'>";
                }
            }
            else
            {
                echo "<img class='prof_pic' style='margin:auto;' src='" . str_replace("../", "", $cust_details['Cust_Image']) . "'>";
            }
            echo "<span class='tooltiptext'>Change profile picture</span></div>";
            echo "<p>" . $cust_details['Cust_Lname'] . " " . $cust_details['Cust_Fname'] . "</p>"; 
        ?>
        <!-- Change Profile Picture Modal -->
		<div id="Pic_Modal" class="pic-modal">
            <!-- Form to upload picture -->
            <div class="pic-modal-content">
                <form name='change_pic' class='change_img' action='' method='post' autocomplete='off'>
                <span onclick="clearImg()" class="close" title="Close Modal" style='margin-left: 5px; margin-top: -10px;'>&times;</span>
                <div class="form-container">
                    <div class="page">
                        <div class="wrapper">
                            <div class="image">
                                <img class="preimg" src="" alt="">
                            </div>
                            <div class="img-content" style="margin: 0 auto;">
                            <div class="icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="text">No file chosen, yet!</div>
                            <label class="error_locationimg" style="color: red; clear:both; font-size: 13px; padding: 0; font-weight:600"></label>
                            </div>
                            <div id="cancel-btn">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="file-name">
                                File name here
                            </div>
                        </div>
                        <label id="custom-btn" style="margin: 10px 0" for="default-btn">Choose your profile picture</label>
                        <input id="default-btn" name="file" type="file" hidden>
                        <div class="button_field">
                            <button class="img_submit" name="img_submit_btn" type="button" style="margin-left: 0;">Upload</button>
                            <button type="button" onclick="clearImg()" class="cancelbtn" style="margin-right: 0;">Cancel</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <a href='profile.php'><i class='material-icons'>portrait</i>My profile</a><br>
        <a href='edit_profile.php'><i class='material-icons'>edit</i>Edit profile</a><br>
        <a href='change_password.php'><i class='material-icons'>lock</i>Change password</a><br>
        <a href='#' class='active'><i class='material-icons'>history</i>History</a><br>
        <a href='history-ticket.php' class='sub-menu-bar concert_ticket'><i class='material-icons'>confirmation_number</i>Ticket</a><br>
        <a href='#' class='sub-menu-bar merchandise_tab active'><i class='material-icons'>local_mall</i>Merchandise</a>
    </div>

    <div class="history-container">
        <div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>
        <div class='main-title' style='padding: 0;'>
            <h1>Order #<?php echo $purchase_ID?></h1>
        </div>

        <!-- <div class='product-tab concert_ticket'>
            <span>Concert Ticket</span>
            <i class="material-icons" style='float:right; margin-top: 5px;'>arrow_forward</i>
        </div>
        <div class="product-tab merchandise_tab">
            <span>Merchandise</span>
            <i class="material-icons" style='float:right; margin-top: 5px;'>arrow_forward</i>
        </div> -->

        <!-- all history of merchandise -->
        <div class="merchandise-container history-item-container">
        <?php
            if($type==1)
                echo '<h3>Rating</h3>';
            else if($type==2)
                echo '<h3>View Rating</h3>';
        ?>
        <form id='rating' method='POST' action='history-merch.php'>
        <div class="all-merch-list">
        <?php
            if($type == 1)
            {
                $all_merch_item = mysqli_query($connect,"select C.S_Merchandise_ID, D.Merchandise_Image, D.Merchandise_Name, D.Merchandise_ListPrice, C.S_Merchandise_Qty, 
                A.Purchase_ID from purchase A, customer B, s_merchandise C, merchandise D where A.Purchase_ID = C.Purchase_ID and A.Cust_ID = B.Cust_ID and 
                C.Cust_ID = B.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and A.Purchase_ID = '$purchase_ID'");
            }
            else if($type == 2)
            {
                $all_merch_item = mysqli_query($connect,"select E.Rating_Star, E.Rating_Comment, E.Rating_Image, C.S_Merchandise_ID, D.Merchandise_Image, 
                D.Merchandise_Name, D.Merchandise_ListPrice, C.S_Merchandise_Qty, A.Purchase_ID from purchase A, customer B, s_merchandise C, merchandise D, rating E 
                where A.Purchase_ID = C.Purchase_ID and A.Cust_ID = B.Cust_ID and C.Cust_ID = B.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and 
                E.S_Merchandise_ID = C.S_Merchandise_ID and A.Purchase_ID = '$purchase_ID'");
            }

            echo "<div class='product-tab'>";
            $count = 0;
            while($all_merch_item_run = mysqli_fetch_assoc($all_merch_item))
            {
                echo '<input type="text" name="s_merchandise_id[]" value="'.$all_merch_item_run['S_Merchandise_ID'].'"hidden readonly>';
                echo "<div class='merch-item-detail'>";
                echo '<div class="item-image-info"><img src="'.str_replace("../", "", $all_merch_item_run['Merchandise_Image']).'">';
                echo '<div style="float: left;">'.$all_merch_item_run['Merchandise_Name'].'<br>x '.$all_merch_item_run['S_Merchandise_Qty'];
                echo '<input class="rating-star-value" type="text" name="star[]" readonly hidden><br>';
                if($type == 1)
                {
                    echo '<span class="material-icons star-icon star1">star_border</span>';
                    echo '<span class="material-icons star-icon star2">star_border</span>';
                    echo '<span class="material-icons star-icon star3">star_border</span>';
                    echo '<span class="material-icons star-icon star4">star_border</span>';
                    echo '<span class="material-icons star-icon star5">star_border</span>';
                    echo '<span class="star-text"></span>';
                }
                else if($type == 2)
                {
                    if($all_merch_item_run['Rating_Star']==1)
                    {
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="star-text">Extremely Bad</span>';
                    }
                    else if($all_merch_item_run['Rating_Star']==2)
                    {
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="star-text">Dissatisfied</span>';
                    }
                    else if($all_merch_item_run['Rating_Star']==3)
                    {
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="star-text">Fair</span>';
                    }
                    else if($all_merch_item_run['Rating_Star']==4)
                    {
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="star-text">Satisfied</span>';
                    }
                    else if($all_merch_item_run['Rating_Star']==5)
                    {
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="star-text">Delighted</span>';
                    }
                }
                echo '</div>';
                echo '</div>';
                if($type == 1)
                {
                    echo '<div class="merch-rating-text"><label>Comment</label><textarea name="comment[]" class="merch-rating-input" rows="5" placeholder="What do you think of this product?"></textarea>';
                }
                else if($type == 2)
                {
                    echo '<div class="merch-rating-text"><label>Comment</label><textarea name="comment[]" class="merch-rating-input" rows="5" disabled>'.$all_merch_item_run['Rating_Comment'].'</textarea>';
                }
                echo '</div>';
                echo '<div class="img-container">';
                if($type == 1)
                {
                    echo '<span class="material-icons close-btn">close</span>';
                    echo '<img class="preimg" src="" alt="">';
                    echo '</div>';
                    echo '<label class="files-btn" for="files0'.$count.'"><span class="material-icons">photo_camera</span><span class="text">Upload Photo</span></label>';
                    echo '<input type="file" class="files-input" id="files0'.$count.'" name="files[]" hidden>';
                    echo '</div>';
                    $count++;
                }
                else if($type == 2)
                {
                    echo '<img class="preimg" src="'.str_replace("../", "", $all_merch_item_run['Rating_Image']).'" alt="" style="display:block">';
                    echo '</div>';
                    echo '</div>';
                    $count++;
                }
                
            }
            if($type == 1)
            {
                echo '<button type="submit" class="rating-submit-btn">Submit</button>';
            }
            else if($type == 2)
            {
                echo '<button type="button" class="rating-submit-btn" onclick="history.back()">Back</button>';
            }
            echo '</div>';
        ?>
        </div>
        </form>
        </div>
    </div>    
</div>
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

<script>
    $('.star1').on('click',function(){
        $(this).siblings("input").val("1");
        $(this).siblings('.star-icon').text('star_border');
        $(this).text('star');
        $(this).siblings('.star-text').text('Extremely Bad');
    })
    $('.star2').on('click',function(){
        $(this).siblings("input").val("2");
        $(this).siblings('.star-icon').text('star_border');
        $(this).siblings('.star1').text('star');
        $(this).text('star');
        $(this).siblings('.star-text').text('Dissatisfied');
    })
    $('.star3').on('click',function(){
        $(this).siblings("input").val("3");
        $(this).siblings('.star-icon').text('star_border');
        $(this).siblings('.star1').text('star');
        $(this).siblings('.star2').text('star');
        $(this).text('star');
        $(this).siblings('.star-text').text('Fair');
    })
    $('.star4').on('click',function(){
        $(this).siblings("input").val("4");
        $(this).siblings('.star-icon').text('star_border');
        $(this).siblings('.star1').text('star');
        $(this).siblings('.star2').text('star');
        $(this).siblings('.star3').text('star');
        $(this).text('star');
        $(this).siblings('.star-text').text('Satisfied');
    })
    $('.star5').on('click',function(){
        $(this).siblings("input").val("5");
        $(this).siblings('.star-icon').text('star');
        $(this).text('star');
        $(this).siblings('.star-text').text('Delighted');
    })

    $('.files-input').on("change", function(){
        let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
        var img = $(this).siblings('.img-container').children('.preimg');
        var preimg = $(this).siblings('.img-container').children('.preimg');
        var closeBtn = $(this).siblings('.img-container').children('.close-btn');
        var uploadBtn = $(this).siblings('label');
        const file = this.files[0];
            
        var filePath = $(this).val(); 
        // Allowing file type 
        var allowedExtensions =  /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
            
        if (!allowedExtensions.exec(filePath))
        { 
            img.attr('src','');
            closeBtn.css('display','none');
            preimg.css('display','none');
            $(this).val("");
            return false; 
        }
        else if(file)
        {
            const reader = new FileReader();
            reader.onload = function(){
                const result = reader.result;
                img.attr('src',result);
                closeBtn.css('display','inline-block');
                preimg.css('display','block');
                uploadBtn.css('display','none');
            }
            reader.readAsDataURL(file);
        }
        if(this.value){
            let valueStore = this.value.match(regExp);
        }
    })

    $('.close-btn').on('click',function(){
        $(this).css('display','none');
        $(this).siblings('.preimg').css('display','none');
        $(this).closest('div').siblings('.files-btn').css('display','inline-block');
        $(this).closest('.img-container').siblings('.files-input').val("");;
    })

    $('.preimg').on('click', function(){
        $('#Pic_Modal2').css('display','block');
        var presrc = $(this).attr('src');
        $('.preimg-preview').attr('src',presrc);
    })
    
    $('.preview-close-btn').on('click',function(){
        $('#Pic_Modal2').css('display','none');
    })

    $('#rating').on('submit',function(e){
        e.preventDefault();
        var missing=0;
        $('.rating-star-value').each(function(){
            if($(this).val()=='')
            {
                missing = 1;
                return false;
            }  
        })
        if(missing == 1)
        {
            // console.log('error'); 
            //swal error message
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: 'Please make sure all items are being rated.',
                showConfirmButton: false,
                timer: 2000,
            });
        }
        else
        {
            <?php echo 'var cust_id ='. $Cust_ID.';'; ?>
            var form_data = new FormData(this);
            form_data.append("rating-merch",1);
            form_data.append("Cust_ID",cust_id);
            <?php 
                for($i=0; $i<$count; $i++)
                {
                    echo 'const shortimg'.$i.' = document.querySelector("#files0'.$i.'");';
                    echo 'var property'.$i.' = shortimg'.$i.'.files[0];';
                    echo 'form_data.append("files[]",property'.$i.');';
                }
            ?>
            console.log(form_data);
            // var ins = document.getElementsByClassName('files-input').files.length;
            // for (var x = 0; x < ins; x++) {
            //     form_data.append("files[]", file = $(this).prop('files')[0];);
            // }
            // form_data.push({name: "rating-merch", value: 1});
            $.ajax({
                url: "ajax_form.php",
                type: "POST",
                data: form_data,
                cache: false,
                processData: false,
                contentType: false,
                success: function(respone)
                {
                    Swal.fire({
                    title:'Successfully!', 
                    text:'Thank you for your feedback.', 
                    icon:'success',
                    didClose: () => 
                    window.open("history-merch.php", "_self")});
                    console.log(respone);
                },
                error: function(respone)
                {
                    console.log(respone);
                }
            });
        }
    })
</script>

<?php include "footer.php"; ?>