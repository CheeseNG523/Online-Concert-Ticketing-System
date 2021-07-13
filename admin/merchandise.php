<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    $active_result = mysqli_query($connect,"select * from merchandise where Merchandise_unable = 0 and Merchandise_Status <2");
    $off_result = mysqli_query($connect,"select * from merchandise where Merchandise_unable = 0 and Merchandise_Status =2");
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
            <label class="current_direction">Merchandise</label>
        </div>
</div>

<div class="page_position">
    <table id="tableA" class="table_container" style="background:white;">
        <thead >
            <tr class="header">
                <td colspan="4">On Shelf</td>
                <td class="Addbtn" colspan="2"><a rel="tab" href="addmerchandise.php" style="width:auto;"><span class="material-icons">add</span>Add Merchandise</a></td>
            </tr>
            <tr>
                <td colspan="6">
                    <input type="text" id="input_concert_active"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=16.66%>Merchandise ID</th>
                <th width=16.66%>Name</th>
                <th width=16.66%>Price (RM)</th>
                <th width=16.66%>List Price (RM)</th>
                <th width=16.66%>Stock On Hand</th>
                <th width=16.66%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_row">
            <?php
            while($row=mysqli_fetch_assoc($active_result))
            {
            ?>
                <tr>
                    <td><?php echo "Prod ".$row['Merchandise_ID'];?></td>
                    <td><?php echo $row['Merchandise_Name'];?></td>
                    <td><?php echo $row['Merchandise_Price'];?></td>
                    <td><?php echo $row['Merchandise_ListPrice'];?></td>
                    <td><?php echo $row['Merchandise_Stock'];?></td>
                    <td class="action_button">
                        <a rel="tab" href="viewMerch.php?view&id=<?php echo $row['Merchandise_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                        <a rel="tab" href="updateMerch.php?edit&id=<?php echo $row['Merchandise_ID']?>" title="Edit" style="float:left;"><span class="material-icons">edit</span></a>
                        <a href="#" title="Delete" style="float:left;" onclick="deletetable(<?php echo $row['Merchandise_ID'];?>)"><span class="material-icons">delete</span></a>
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
                <td colspan="5">Off Shelf</td>
            </tr>
            <tr>
                <td colspan="5">
                    <input type="text" id="input_concert_complete"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=20%>Merchandise ID</th>
                <th width=20%>Name</th>
                <th width=20%>Price (RM)</th>
                <th width=20%>List Price (RM)</th>
                <th width=20%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_complete_row">
            <?php
            while($row=mysqli_fetch_assoc($off_result))
            {
            ?>
                <tr>
                    <td><?php echo "Prod ".$row['Merchandise_ID'];?></td>
                    <td><?php echo $row['Merchandise_Name'];?></td>
                    <td><?php echo $row['Merchandise_Price'];?></td>
                    <td><?php echo $row['Merchandise_ListPrice'];?></td>
                    <td class="action_button">
                        <a rel="tab" href="viewMerch.php?view&id=<?php echo $row['Merchandise_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                        <a rel="tab" href="updateMerch.php?edit&id=<?php echo $row['Merchandise_ID']?>" title="Edit" style="float:left;"><span class="material-icons">edit</span></a>
                        <a href="#" title="Delete" style="float:left;" onclick="deletetable(<?php echo $row['Merchandise_ID'];?>)"><span class="material-icons">delete</span></a>
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
                        "merch_delbtn":1,
                        "delCID":id,
                    },
                    success:function(respone)
                    {
                        if(respone)
                        {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The merchandise has been deleted.',
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
                    error:function(respone)
                    {
                        console.log(respone);
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