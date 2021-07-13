<?php 
    include 'dataconnection.php';
    include 'header_sidebar.php';
    
        $email = $_SESSION['admin_email'];
        $pri = mysqli_query($connect,"select Admin_PRI from admin where Admin_Email = '$email'");
        $admin_pri = mysqli_fetch_assoc($pri);
        if($admin_pri['Admin_PRI']!=1)
        {
            ?>
            <script>
            window.open("php/unauthorized.php","_self");
            </script>
            <?php
        }
        else
        {
            $active_result = mysqli_query($connect,"select * from admin where Admin_unable != 1 and Admin_Verify = 1 and Admin_PRI = 1");
            $complete_result = mysqli_query($connect,"select * from admin where Admin_unable != 1 and Admin_Verify = 1 and Admin_PRI = 2");
            $ban_result = mysqli_query($connect,"select * from admin where Cust_Ban_Status = 1");
        }
?>
<script src="js/profile_form.js"></script>
<div class="page_position">
        <div class="position_left">
            <label>Admin</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">People</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Admin</label>
        </div>
</div>

<div class="page_position">
    <table class="table_container" style="background:white;">
        <thead >
            <tr class="header">
                <td colspan="3">Super Admin <?php echo mysqli_num_rows($active_result);?>/3</td>
                <td class="Addbtn" colspan="2"><button style="width:auto;" type="button" onclick="document.getElementById('id04').style.display='block'"
                <?php
                if(mysqli_num_rows($active_result)>=3)
                {
                    echo "disabled='disabled'";
                }
                ?>><span class="material-icons">add</span>Add Super Admin</button></td>
            </tr>
            <tr class="header-bar">
                <th width=22%>First Name</th>
                <th width=22%>Last Name</th>
                <th width=14%>Gender</th>
                <th width=22%>Contact Number</th>
                <th width=20%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_row">
            <?php
            while($row=mysqli_fetch_assoc($active_result))
            {
                ?>
                <tr>
                    <td><?php echo $row['Admin_Fname'];?></td>
                    <td><?php echo $row['Admin_Lname'];?></td>
                    <td><?php 
                        if($row['Admin_Gender']=='M')
                            echo 'Male';
                        else
                            echo 'Female';
                    ?></td>
                    <td><?php echo $row['Admin_Contact'];?></td>
                    <td class="action_button">
                        <a rel="tab" href="viewadmin.php?view&id=<?php echo $row['Admin_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <table id="TableB" class="table_container" style="background:white; margin-top:30px;">
        <thead >
            <tr class="header">
                <td colspan="3">Admin</td>
                <td class="Addbtn" colspan="2"><button style="width:auto;" type="button" onclick="document.getElementById('id05').style.display='block'"><span class="material-icons">add</span>Add Admin</button></td>
            </tr>
            <tr>
                <td colspan="7">
                    <input type="text" id="tableB"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=22%>First Name</th>
                <th width=22%>Last Name</th>
                <th width=14%>Gender</th>
                <th width=22%>Contact Number</th>
                <th width=20%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_complete_row">
            <?php
            while($row2=mysqli_fetch_assoc($complete_result))
            {
                ?>
                <tr>
                    <td><?php echo $row2['Admin_Fname'];?></td>
                    <td><?php echo $row2['Admin_Lname'];?></td>
                    <td><?php 
                        if($row2['Admin_Gender']=='M')
                            echo 'Male';
                        else
                            echo 'Female';
                    ?></td>
                    <td><?php echo $row2['Admin_Contact'];?></td>
                    <td class="action_button">
                        <a rel="tab" href="viewadmin.php?view&id=<?php echo $row2['Admin_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                        <a href="#" title="Ban" style="float:left;" onclick="deletetable(<?php echo $row2['Admin_ID']?>)"><span class="material-icons">delete</span></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <div id="id04" class="modal">       
    <form class="modal-content animate add_super_admin" action="" method="post" autocomplete="off">
        <!--close button-->
        <div class="imgcontainer" style="margin-bottom:10px">
            <span onclick="clearsuper()" class="close" title="Close">&times;</span>
        </div>

        <div class="container">
            <div class="page">
                <div class="title">Add Super Admin</div>
                    <div class="txt_field" style="clear:both; float:left; margin-top: 0px; width:48%">
                        <input type="text" name="admin_fname" class="checking_sadmin_fname">
                        <label>First Name</label>
                        <label class="error_sadmin_fname" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;"></label>
                    </div>
                    <div class="txt_field" style="float:left; margin-top: 0px; width:48%; margin-left:4%">
                        <input type="text" name="admin_lname" class="checking_sadmin_lname">
                        <label>Last Name</label>
                        <label class="error_sadmin_lname" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;"></label>
                    </div>
                    <div class="txt_field" style="clear:both; margin-top: 50px;">
                        <input type="email" name="admin_email" class="checking_sadmin_email">
                        <label>Email</label>
                        <label class="error_sadmin_email" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;"></label>
                    </div>
                    <div class="txt_field" style="clear:both; float:left; margin-top: 0px; width:48%">
                        <select readonly disabled style="width:20%; float:left; border-radius: 5px 0 0 5px; border-right: transparent;">
                            <option value="MY" disabled hidden selected>MY</option>
                        </select>
                        <input type="text" id="user_phone" name="admin_phone" style="width:80%; float:left; border-radius:0px 5px 5px 0;" class="checking_sphone" maxlength="13">
                        <label>Phone Number</label>
                        <label class="error_sadmin_phone" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;"></label>
                    </div>
                    <div class="txt_field" style="float:left; margin-top: 0px; width:48%; margin-left:4%">
                        <select name="admin_gender" id="user_gender" style="clear:both;" class="checking_sadmin_gender">
                            <option value="" disabled hidden selected></option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        <label>Gender</label>
                        <label class="error_sadmin_gender" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="clear:both;">
                        <input id="new_cpw" type="password" name="admin_pass" class="checking_sadmin_new_password" maxlength="20">
                        <div class="password_visible">
                            <input type="checkbox" onclick="shownewpw()" tabindex="-1">
                            <div class="icon-box1">
                                <span class="material-icons">visibility</span>
                            </div>
                            <div class="icon-box2">
                                <span class="material-icons">visibility_off</span>
                            </div>
                        </div>
                        <label>New Password</label>
                        <label class="error_sadmin_new_password" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                    </div>
                    <div class="button_field">
                        <button class="superadmin_submit_btn" type="button">Add Super Admin</button>
                        <button type="button" onclick="clearsuper()" class="cancelbtn" style="background-color:#f44336">Cancel</button>
                    </div>
                    <div id="message" class="tooltiptext" style="top: 44%;">
                        <label style="color:white">Password must contain the following:</label>
                        <label style="color:rgba(255, 0, 0, 0.8)" class="letter"><span class="material-icons cancel_icon4">cancel</span><span class="material-icons checked_icon4" style="display:none">check_circle</span>A lowercase letter</label>
                        <label style="color:rgba(255, 0, 0, 0.8)" class="capital"><span class="material-icons cancel_icon3">cancel</span><span class="material-icons checked_icon3" style="display:none">check_circle</span>A capital (uppercase) letter</label>
                        <label style="color:rgba(255, 0, 0, 0.8)" class="number"><span class="material-icons cancel_icon2" >cancel</span><span class="material-icons checked_icon2" style="display:none">check_circle</span>A number</label>
                        <label style="color:rgba(255, 0, 0, 0.8)" class="special"><span class="material-icons cancel_icon5">cancel</span><span class="material-icons checked_icon5" style="display:none">check_circle</span>A special characters</label>
                        <label style="color:rgba(255, 0, 0, 0.8)" class="length"><span class="material-icons cancel_icon1">cancel</span><span class="material-icons checked_icon1" style="display:none">check_circle</span>12-20 characters</label>
                    </div>
            </div>
        </div>
    </form>
</div>
<div id="id05" class="modal">       
    <form class="modal-content animate add_admin" action="" method="post" autocomplete="off">
        <!--close button-->
        <div class="imgcontainer">
            <span onclick="clearadmin()" class="close" title="Close">&times;</span>
        </div>

        <div class="container">
            <div class="page">
                <div class="title">Add Admin</div>
                    <div class="txt_field" style="clear:both; float:left; margin-top: 0px; width:48%">
                        <input type="text" name="admin_fname" class="checking_admin_fname">
                        <label>First Name</label>
                        <label class="error_admin_fname" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;"></label>
                    </div>
                    <div class="txt_field" style="float:left; margin-top: 0px; width:48%; margin-left:4%">
                        <input type="text" name="admin_lname" class="checking_admin_lname">
                        <label>Last Name</label>
                        <label class="error_admin_lname" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;"></label>
                    </div>
                    <div class="txt_field" style="clear:both; margin-top: 50px;">
                        <input type="email" name="admin_email" class="checking_admin_email">
                        <label>Email</label>
                        <label class="error_admin_email" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;"></label>
                    </div>
                    <div class="txt_field" style="clear:both; float:left; margin-top: 0px; width:48%">
                        <select id="select-country" readonly disabled style="width:20%; float:left; border-radius: 5px 0 0 5px; border-right: transparent;">
                            <option value="MY" disabled hidden selected>MY</option>
                        </select>
                        <input type="text" name="admin_phone" id="user_phone2" style="width:80%; float:left; border-radius:0px 5px 5px 0;" class="checking_admin_phone" maxlength="13">
                        <label>Phone Number</label>
                        <label class="error_admin_phone" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;"></label>
                    </div>
                    <div class="txt_field" style="float:left; margin-top: 0px; width:48%; margin-left:4%">
                        <select name="admin_gender" style="clear:both;" class="checking_admin_gender">
                            <option value="" disabled hidden selected></option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        <label>Gender</label>
                        <label class="error_admin_gender" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="clear:both;">
                        <input id="new_pw" type="password" name="admin_pass" class="checking_admin_new_password" maxlength="20">
                        <div class="password_visible">
                            <input type="checkbox" onclick="showpw()" tabindex="-1">
                            <div class="icon-box1">
                                <span class="material-icons">visibility</span>
                            </div>
                            <div class="icon-box2">
                                <span class="material-icons">visibility_off</span>
                            </div>
                        </div>
                        <label>New Password</label>
                        <label class="error_admin_new_password" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                    </div>
                    <div class="button_field">
                        <button class="admin_submit_btn" type="button">Add Admin</button>
                        <button type="button" onclick="clearadmin()" class="cancelbtn" style="background-color:#f44336">Cancel</button>
                    </div>
                    <div id="message1" class="tooltiptext" style="top: 44%;">
                        <label style="color:white">Password must contain the following:</label>
                        <label style="color:rgba(255, 0, 0, 0.8)" class="letter"><span class="material-icons cancel_icon4">cancel</span><span class="material-icons checked_icon4" style="display:none">check_circle</span>A lowercase letter</label>
                        <label style="color:rgba(255, 0, 0, 0.8)" class="capital"><span class="material-icons cancel_icon3">cancel</span><span class="material-icons checked_icon3" style="display:none">check_circle</span>A capital (uppercase) letter</label>
                        <label style="color:rgba(255, 0, 0, 0.8)" class="number"><span class="material-icons cancel_icon2" >cancel</span><span class="material-icons checked_icon2" style="display:none">check_circle</span>A number</label>
                        <label style="color:rgba(255, 0, 0, 0.8)" class="special"><span class="material-icons cancel_icon5">cancel</span><span class="material-icons checked_icon5" style="display:none">check_circle</span>A special characters</label>
                        <label style="color:rgba(255, 0, 0, 0.8)" class="length"><span class="material-icons cancel_icon1">cancel</span><span class="material-icons checked_icon1" style="display:none">check_circle</span>12-20 characters</label>
                    </div>
            </div>
        </div>
    </form>
</div>
</div>
<script>
    function clearsuper()
    {
        document.getElementById('id04').style.display='none';
        var a = document.getElementById("new_cpw");
        a.type = "password";
        document.querySelector('.add_super_admin').reset();
        $('.error_sadmin_email').text("");
        $('.error_sadmin_phone').text("");
        $('.error_sadmin_fname').text("");
        $('.error_sadmin_lname').text("");
        $('.error_sadmin_new_password').text("");
        $('.error_sadmin_gender').text("");
        $('#message .length').css("color","rgba(255, 0, 0, 0.8)");
        $('#message .number').css("color","rgba(255, 0, 0, 0.8)");
        $('#message .capital').css("color","rgba(255, 0, 0, 0.8)");
        $('#message .letter').css("color","rgba(255, 0, 0, 0.8)");
        $('#message .special').css("color","rgba(255, 0, 0, 0.8)");
        $('#message .checked_icon1').css("display","inline-block");
        $('#message .cancel_icon1').css("display","none");
        $('#message .checked_icon1').css("display","none");
        $('#message .cancel_icon1').css("display","inline-block");
        $('#message .checked_icon2').css("display","inline-block");
        $('#message .cancel_icon2').css("display","none");
        $('#message .checked_icon2').css("display","none");
        $('#message .cancel_icon2').css("display","inline-block");
        $('#message .checked_icon3').css("display","none");
        $('#message .cancel_icon3').css("display","inline-block");
        $('#message .checked_icon4').css("display","none");
        $('#message .cancel_icon4').css("display","inline-block");
        $('#message .checked_icon5').css("display","none");
        $('#message .cancel_icon5').css("display","inline-block");
    }

    function clearadmin()
    {
        document.getElementById('id05').style.display='none';
        var a = document.getElementById("new_pw");
        a.type = "password";
        document.querySelector('.add_admin').reset();
        $('.error_admin_email').text("");
        $('.error_admin_phone').text("");
        $('.error_admin_fname').text("");
        $('.error_admin_lname').text("");
        $('.error_admin_new_password').text("");
        $('.error_admin_gender').text("");
        $('#message1 .length').css("color","rgba(255, 0, 0, 0.8)");
        $('#message1 .number').css("color","rgba(255, 0, 0, 0.8)");
        $('#message1 .capital').css("color","rgba(255, 0, 0, 0.8)");
        $('#message1 .letter').css("color","rgba(255, 0, 0, 0.8)");
        $('#message1 .special').css("color","rgba(255, 0, 0, 0.8)");
        $('#message1 .checked_icon1').css("display","inline-block");
        $('#message1 .cancel_icon1').css("display","none");
        $('#message1 .checked_icon1').css("display","none");
        $('#message1 .cancel_icon1').css("display","inline-block");
        $('#message1 .checked_icon2').css("display","inline-block");
        $('#message1 .cancel_icon2').css("display","none");
        $('#message1 .checked_icon2').css("display","none");
        $('#message1 .cancel_icon2').css("display","inline-block");
        $('#message1 .checked_icon3').css("display","none");
        $('#message1 .cancel_icon3').css("display","inline-block");
        $('#message1 .checked_icon4').css("display","none");
        $('#message1 .cancel_icon4').css("display","inline-block");
        $('#message1 .checked_icon5').css("display","none");
        $('#message1 .cancel_icon5').css("display","inline-block");
    }

    $(document).ready(function(){
        $("#tableB").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table_complete_row tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#tableC").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table_complete_row tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('#TableB').DataTable({
            "pagingType": "full_numbers"
        });
        $('#TableC').DataTable({
            "pagingType": "full_numbers"
        });
    });

    function shownewpw(){
        var x = document.getElementById("new_cpw");
        if(x.type === "password")
            x.type = "text";
        else
            x.type = "password";
    }

    function showpw(){
        var x = document.getElementById("new_pw");
        if(x.type === "password")
            x.type = "text";
        else
            x.type = "password";
    }

    var cleave = new Cleave('#user_phone',{
        phone:true,
        phoneRegionCode: 'MY'
    });
    
    var cleave1 = new Cleave('#user_phone2',{
        phone:true,
        phoneRegionCode: 'MY'
    });

    var myInput = document.getElementById("new_cpw");
    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
        document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
        document.getElementById("message").style.display = "none";
    }

    var myInput1 = document.getElementById("new_pw");
    // When the user clicks on the password field, show the message box
    myInput1.onfocus = function() {
        document.getElementById("message1").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput1.onblur = function() {
        document.getElementById("message1").style.display = "none";
    }
    

    function deletetable(id)
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "php/validation/form_validation.php",
                    data:{
                        "admin_delbtn":1,
                        "delID":id,
                    },
                    success:function(respone)
                    {
                        if(respone)
                        {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'This admin has been banned.',
                                icon: 'success',
                                didClose: () => location.reload(),
                            });
                        }
                        else
                        {
                            Swal.fire({
                                title:'Oops! Something went wrong...', 
                                text:'Please try again later', 
                                icon:'error',
                                didClose: () => window.scrollTo(0,0)});
                        }
                    },
                    error:function()
                    {
                        Swal.fire({
                                title:'Oops! Something went wrong...', 
                                text:'Please try again later', 
                                icon:'error',
                                didClose: () => window.scrollTo(0,0)});
                    }
                });
            }
        });  
    }
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>