<?php 
    include 'dataconnection.php';
    include 'header_sidebar.php';
    $active_result = mysqli_query($connect,"select * from concert A, ticket_price B, s_ticket C, purchase D where D.Purchase_ID = C.Purchase_ID and
     C.PriceID = B.Price_ID and B.Concert_ID = A.Concert_ID and A.Concert_Status > 1 and A.Concert_Unable != 1 and D.Card_verify > 0 group by A.Concert_ID");
?>
<script src="js/profile_form.js"></script>
<div class="page_position">
        <div class="position_left">
            <label>Sales Report</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Sales Report</label>
        </div>
</div>

<div class="profile_container">
    <div class="container_title">Generate sales report:</div>
    <div class="selection_container">
        <div class="selection">
            <input type="radio" id="month" name="selection" onclick="selection(1)">
            <label for="month">All</label>
        </div>
        <div class="selection" style="margin-left:5%;">
            <input type="radio" id="concert" name="selection" onclick="selection(2)">
            <label for="concert">Concert</label>
        </div>
        <div class="selection" style="margin-left:5%;">
            <input type="radio" id="mechandise" name="selection" onclick="selection(3)">
            <label for="mechandise">Merchandise</label>
        </div>
    </div>
    <div class="selection-detail typeA">
        <form class="all-report" action="allreport.php" method="POST">
            <div class="txt_field" style="float:left; width:45%;">
                <input type="date" name="start-date" class="checking_staringdate" id="datePickerIdStart" onchange="setSdate()" onkeydown="return false">
                <label>From</label>
            </div>
            <div class="txt_field" style="float:left; width:45%; margin-left:10%">
                <input type="date" name="end-date" class="checking_endingdate" id="datePickerIdEnd" onkeydown="return false" disabled="disabled" onchange="setbtn()">
                <label>To</label>
            </div>
            <div class="button_field" style="float:right;">
                <button disabled="disabled" type="submit" style="background-color:#4caf50" class="generate_btn">Generate</button>
            </div>
        </form>
    </div>
    <div class="selection-detail typeB">
        <form class="all-report" action="report.php" method="POST">
            <table id="tableA" class="table_container" style="background:white;">
            <thead >
                <tr class="header">
                    <td colspan="4">Choose Concert</td>
                    <td colspan="2" style="text-align:right; color:rgb(214, 62, 62);" class="selected_number">0 selected</td>
                </tr>
                <tr>
                    <td colspan="6">
                        <input type="text" id="input_concert_active"  class="search" placeholder="Search for names.." title="Type in a name">
                    </td>
                </tr>
                <tr class="header-bar">
                    <th>Name</th>
                    <th>Event Date</th>
                    <th>Venue</th>
                    <th>Organizer</th>
                    <th>Status</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody class="concert_table_content" id="table_row">
                <?php
                while($row=mysqli_fetch_assoc($active_result))
                {
                    $concert_id = $row['Concert_ID'];
                    $organizer_id = $row['Organizer_ID'];
                    $venue_id = $row['Venue_ID'];
                    $venue_result = mysqli_query($connect,"select * from venue where Venue_ID = '$venue_id'");
                    $venue_row=mysqli_fetch_assoc($venue_result);
                    ?>
                    <tr>
                        <td><?php echo $row['Concert_Name'];?></td>
                        <td><?php echo $row['Concert_StartDate'];?></td>
                        <td><?php echo $venue_row['Venue_Name'];?></td>
                        <td><?php
                            $organizer = mysqli_query($connect,"select * from organizer where Organizer_ID = '$organizer_id'");
                            $organizer_row = mysqli_fetch_assoc($organizer);
                            echo $organizer_row['Organizer_Name'];
                        ?></td>
                        <td>
                        <?php
                            if($row['Concert_Status']==0)
                            {
                                ?>
                                    Saved
                                <?php
                            }
                            else if($row['Concert_Status']==1)
                            {
                                ?>
                                    Upcoming
                                <?php
                            }
                            else if($row['Concert_Status']==2)
                            {
                                ?>
                                    Ongoing
                                <?php
                            }
                            else if($row['Concert_Status']==3)
                            {
                                ?>
                                    Ended
                                <?php
                            }
                        ?>
                        </td>
                        <td class="action_button" style="text-align:center;">
                            <input type="checkbox" name="concert_report[]" class="sales_concert_id" value="<?php echo $row['Concert_ID'];?>" style="width:35%;">
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
            <div class="button_field" style="float:right;">
                <button disabled="disabled" type="submit" style="background-color:#4caf50" class="concert_sales_btn">Generate</button>
            </div>
        </form>
    </div>
    <div class="selection-detail typeC">
        <div class="button_field" style="float:right;">
            <button type="submit" style="background-color:#4caf50" class="merch_sales_btn">Generate</button>
        </div>
    </div>
</div>
<script>
    
    var d = new Date();
    d.setDate(d.getDate()-1);

    datePickerIdStart.max = d.toISOString().split("T")[0];
    function setSdate()
    {
        var checking_staringdate = $('.checking_staringdate').val();
        //document.getElementsByClassName("checking_staringdate").value;
        
        datePickerIdEnd.min = checking_staringdate;

        //find today
        datePickerIdEnd.max = d.toISOString().split("T")[0];
        $('.checking_endingdate').prop("disabled","");

        if(checking_staringdate !== "" && datePickerIdEnd.value !== "")
        {
            $('.generate_btn').prop("disabled","");
        }
    }

    function setbtn()
    {
        var checking_staringdate = $('.checking_staringdate').val();
        if(checking_staringdate !== "" && datePickerIdEnd.value !== "")
        {
            $('.generate_btn').prop("disabled","");
        }
    }

    function selection(a)
    {
        $('.typeA').css("display","none");
        $('.typeB').css("display","none");
        $('.typeC').css("display","none");
        if(a == 1)
            $('.typeA').css("display","block");
        else if(a == 2)
            $('.typeB').css("display","block");
        else
            $('.typeC').css('display','block');
    }

    $(document).ready(function(){
        $('.checking_staringdate').max = new Date().toISOString().split("T")[0];

        $('#tableA').DataTable({
            "pagingType": "full_numbers"
        });

        $('.merch_sales_btn').on('click',function(){
            window.open('merch_report.php','_self');
        });
    });
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>