<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    $active_result = mysqli_query($connect,"select *, DATE_FORMAT(Concert_StartDate, '%d-%m-%Y %T') as 'Concert_StartDate', 
    DATE_FORMAT(Session_StartDate, '%d-%m-%Y %T') as 'Session_StartDate', DATE_FORMAT(Session_EndDate, '%d-%m-%Y %T') as 'Session_EndDate' 
    from concert where Concert_Status < 3 and Concert_Unable != 1");
    $complete_result = mysqli_query($connect,"select *, DATE_FORMAT(Concert_StartDate, '%d-%m-%Y %T') as 'Concert_StartDate', 
    DATE_FORMAT(Session_StartDate, '%d-%m-%Y %T') as 'Session_StartDate', DATE_FORMAT(Session_EndDate, '%d-%m-%Y %T') as 'Session_EndDate' 
    from concert where Concert_Status = 3 and Concert_Unable != 1");
?>
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
            <label class="current_direction">Concert</label>
        </div>
</div>

<div class="page_position">
    <table id="tableA" class="table_container" style="background:white;">
        <thead >
            <tr class="header">
                <td colspan="5">Current Active</td>
                <td class="Addbtn" colspan="2"><a rel="tab" href="addconcert.php" style="width:auto;"><span class="material-icons">add</span>Add Concert</a></td>
            </tr>
            <tr>
                <td colspan="7">
                    <input type="text" id="input_concert_active"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=28%>Name</th>
                <th width=13%>Event Date</th>
                <th width=20%>Venue</th>
                <th width=13%>Session Date</th>
                <th width="6%">Sold</th>
                <th width=8%>Status</th>
                <th width=17%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_row">
            <?php
            while($row=mysqli_fetch_assoc($active_result))
            {
                $venue_id = $row['Venue_ID'];
                $venue_result = mysqli_query($connect,"select * from venue where Venue_ID = '$venue_id'");
                $venue_row=mysqli_fetch_assoc($venue_result)
                ?>


                <tr>
                    <td><?php echo $row['Concert_Name'];?></td>
                    <td><?php echo $row['Concert_StartDate'];?></td>
                    <td><?php echo $venue_row['Venue_Name'];?></td>
                    <td><?php echo $row['Session_StartDate']."<br><label style='text-align:center;'>-</label><br>".$row['Session_EndDate'];?></td>
                    <td><?php
                        $concert_id = $row['Concert_ID'];
                        $totalseat = mysqli_query($connect,"select sum(Seat_No) as 'total_seat' from ticket_price where Concert_ID = '$concert_id' and ticket_price_unable = 0");
                        $sold_query = mysqli_query($connect,"select sum(A.S_Ticket_Qty)as'total' from s_ticket A, ticket_price B, concert C, purchase D where A.Purchase_ID = D.Purchase_ID and A.PriceID = B.Price_ID and B.Concert_ID = C.Concert_ID and D.Card_verify = 1 and C.Concert_ID = '$concert_id';");
                        $sold_row = mysqli_fetch_assoc($sold_query);
                        $sold = $sold_row['total'];
                        $totalseat_row = mysqli_fetch_assoc($totalseat);
                        $total = $totalseat_row['total_seat'];

                        if($total >= 1000)
                            $disTotal = ($total/1000)."K";
                        else
                            $disTotal = $total;
                        
                        if($sold == '' || $sold == null)
                        {
                            $disSold = 0;
                        }
                        else if($sold >= 1000)
                            $disSold = ($sold/1000)."K";
                        else
                            $disSold = $sold;

                        if($row['Concert_Status']==0||$row['Concert_Status']==1)
                            echo "N/A";
                        else if($total == 0)
                            echo "N/A";
                        else
                            echo $disSold."/".$disTotal;
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
                    <td class="action_button">
                        <a rel="tab" href="viewconcert.php?view&id=<?php echo $row['Concert_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                        <a rel="tab" href="updateconcert.php?edit&id=<?php echo $row['Concert_ID']?>" title="Edit" style="float:left;"><span class="material-icons">edit</span></a>
                        <a href="#" title="Delete" style="float:left;" onclick="deletetable(<?php echo $row['Concert_ID']?>)"><span class="material-icons">delete</span></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <table id="tableB" class="table_container" style="background:white; margin-top:30px;">
        <thead >
            <tr class="header">
                <td colspan="7">Completed</td>
            </tr>
            <tr>
                <td colspan="7">
                    <input type="text" id="input_concert_complete"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=28%>Name</th>
                <th width=13%>Event Date</th>
                <th width=20%>Venue</th>
                <th width=13%>Session Date</th>
                <th width="6%">Sold</th>
                <th width=8%>Status</th>
                <th width=17%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_complete_row">
            <?php
            while($complete_row=mysqli_fetch_assoc($complete_result))
            {
                $venue = $complete_row['Venue_ID'];
                $result = mysqli_query($connect,"select * from venue where Venue_ID = '$venue_id'");
                $vrow=mysqli_fetch_assoc($result)
                ?>


                <tr>
                    <td><?php echo $complete_row['Concert_Name'];?></td>
                    <td><?php echo $complete_row['Concert_StartDate'];?></td>
                    <td><?php echo $vrow['Venue_Name'];?></td>
                    <td><?php echo $complete_row['Session_StartDate']."<br><label style='text-align:center;'>-</label><br>".$complete_row['Session_EndDate'];?></td>
                    <td><?php
                        $concert_id = $complete_row['Concert_ID'];
                        $sold_query = mysqli_query($connect,"select sum(A.S_Ticket_Qty)as'total' from s_ticket A, ticket_price B, concert C, purchase D where A.Purchase_ID = D.Purchase_ID and A.PriceID = B.Price_ID and B.Concert_ID = C.Concert_ID and D.Card_verify = 1 and C.Concert_ID = '$concert_id';");
                        $sold_row = mysqli_fetch_assoc($sold_query);
                        $sold = $sold_row['total'];

                        $totalseat = mysqli_query($connect,"select sum(Seat_No) as 'total_seat' from ticket_price where Concert_ID = '$concert_id'");
                        $totalseat_row = mysqli_fetch_assoc($totalseat);
                        $total = $totalseat_row['total_seat'];
                        if($total >= 1000)
                            $disTotal = ($total/1000)."K";
                        else
                            $disTotal = $total;
                        
                        if($sold >= 1000)
                            $disSold = ($sold/1000)."K";
                        else
                            $disSold = $sold;

                        if($total == 0)
                            echo "N/A";
                        else
                            echo $disSold."/".$disTotal;
                    ?></td>
                    <td>
                    <?php
                        if($complete_row['Concert_Status']==0)
                        {
                            ?>
                                Saved
                            <?php
                        }
                        else if($complete_row['Concert_Status']==1)
                        {
                            ?>
                                Upcoming
                            <?php
                        }
                        else if($complete_row['Concert_Status']==2)
                        {
                            ?>
                                Ongoing
                            <?php
                        }
                        else if($complete_row['Concert_Status']==3)
                        {
                            ?>
                                Ended
                            <?php
                        }
                    ?>
                    </td>
                    <td class="action_button">
                        <a rel="tab" href="viewconcert.php?view&id=<?php echo $complete_row['Concert_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function(){
        $("#input_concert_active").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table_row tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#input_concert_complete").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table_complete_row tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('#tableA').DataTable({
            "pagingType": "full_numbers"
        });

        $('#tableB').DataTable({
            "pagingType": "full_numbers"
        });
    });

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
                    dataType: 'json',
                    data:{
                        "delbtn":1,
                        "delCID":id,
                    },
                    success:function(respone)
                    {
                        if(respone[0])
                        {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The concert has been deleted.',
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
                    }
                });
            }
        });  
    }
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>