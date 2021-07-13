<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    $active_result = mysqli_query($connect,"select * from venue where venue_unable = 0");
?>
<div class="page_position">
        <div class="position_left">
            <label>Venue</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Product</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Venue</label>
        </div>
</div>

<div class="page_position">
    <table id="example" class="table_container" style="background:white;">
        <thead >
            <tr class="header">
                <td colspan="4">Venue</td>
                <td class="Addbtn" colspan="1"><a rel="tab" href="addvenue.php" style="width:auto;"><span class="material-icons">add</span>Add Venue</a></td>
            </tr>
            <tr>
                <td colspan="5">
                    <input type="text" id="input_concert_active"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=32%>Name</th>
                <th width=14%>State</th>
                <th width=17%>Active Concert</th>
                <th width=17%>Location</th>
                <th width=20%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_row">
            <?php
            while($row=mysqli_fetch_assoc($active_result))
            {
                $id = $row['Venue_ID'];
                ?>
                <tr>
                    <td><?php echo $row['Venue_Name']; ?></td>
                    <td><?php echo $row['Venue_State']; ?></td>
                    <?php 
                        $count = "select count(Concert_ID) as 'total' from concert where Venue_ID='$id'";
                        $count_run = mysqli_query($connect,$count);
                        $count_result = mysqli_fetch_assoc($count_run);
                    ?>
                    <td><?php echo $count_result['total']; ?></td>
                    <td class="action_button"> <a rel="tab" href="<?php echo $row['Venue_Location']; ?>" target="_blank"><span class="material-icons" style="vertical-align: bottom;">map</span><span style="margin-left:5%">View Map</span></a></td>
                    <td class="action_button">
                        <a rel="tab" href="viewvenue.php?view&id=<?php echo $row['Venue_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                        <a rel="tab" href="updatevenue.php?edit&id=<?php echo $row['Venue_ID']?>" title="Edit" style="float:left;"><span class="material-icons">edit</span></a>
                        <a href="#" title="Delete" style="float:left;" onclick="deletetable(<?php echo $row['Venue_ID']?>)"><span class="material-icons">delete</span></a>
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

        $('#example').DataTable({
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
                        "venue_delbtn":1,
                        "delCID":id,
                    },
                    success:function(respone)
                    {
                        if(respone[0])
                        {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Venue has been deleted.',
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
        })    
    }
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>