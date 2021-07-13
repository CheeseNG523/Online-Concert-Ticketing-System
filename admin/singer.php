<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    $active_result = mysqli_query($connect,"select *, category_name from Singer A, Category B where A.Category_ID = B.Category_ID and Singer_unable = 0");
?>
<div class="page_position">
        <div class="position_left">
            <label>Singer</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">People</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Singer</label>
        </div>
</div>

<div class="page_position">
    <table id="example" class="table_container" style="background:white;">
        <thead >
            <tr class="header">
                <td colspan="2">Singer</td>
                <td class="Addbtn" colspan="1"><a rel="tab" href="addsinger.php" style="width:auto;margin-left:5%"><span class="material-icons">add</span>Add Singer</a><a rel="tab" href="category.php" style="width:auto;"><span class="material-icons">create</span>Category</a></td><!--Add-->
            </tr>
            <td colspan="3">
                <input type="text" id="input_concert_active"  class="search" placeholder="Search for names.." title="Type in a name">
            </td>
            <tr class="header-bar">
                <th width=45%>Name</th>
                <th width=30%>Category</th>
                <th width=25%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_row">
            <?php
            while($row=mysqli_fetch_assoc($active_result))
            {
                ?>
                <tr>
                    <td><?php echo $row['Singer_Name']; ?></td>
                    <td><?php echo $row['Category_Name']; ?></td>
                    <td class="action_button">
                        <a rel="tab" href="viewsinger.php?view&id=<?php echo $row['Singer_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                        <a rel="tab" href="updatesinger.php?edit&id=<?php echo $row['Singer_ID']?>" title="Edit" style="float:left;"><span class="material-icons">edit</span></a>
                        <a href="#" title="Delete" style="float:left;" onclick="deletetable(<?php echo $row['Singer_ID']?>)"><span class="material-icons">delete</span></a>
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
                        "singer_delbtn":1,
                        "delCID":id,
                    },
                    success:function(respone)
                    {
                        if(respone[0])
                        {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The singer has been deleted.',
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