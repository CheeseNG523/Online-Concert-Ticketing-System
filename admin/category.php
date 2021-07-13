<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    $category_result = mysqli_query($connect,"select * from category where Category_unable = 0");
?>
<div class="page_position">
        <div class="position_left">
            <label>Singer Category</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">People</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <a rel="tab" href="singer.php">Singer</a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Category</label>
        </div>
</div>

<div class="page_position">
<table id="tableA" class="table_container" style="background:white;">
        <thead >
            <tr class="header">
                <td colspan="1">Category</td>
                <td class="Addbtn" colspan="1"><a rel="tab" class="addbtn" style="width:auto;"><span class="material-icons">add</span>Add Category</a></td><!--Add-->
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" id="input_concert_active"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=85%>Name<label class="sort_position" onclick="sortTable(1)"></label></th>
                <th width=25%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_row">
            <?php
            while($row=mysqli_fetch_assoc($category_result))
            {
                ?>
                <tr>
                    <td><?php echo $row['Category_Name']; ?></td>
                    <td class="action_button">
                        <a rel="tab" href="#" onclick="updatebtn(<?php echo $row['Category_ID']?>)" title="Edit" style="float:left;"><span class="material-icons">edit</span></a>
                        <a href="#" title="Delete" style="float:left;" onclick="deletetable(<?php echo $row['Category_ID']?>)"><span class="material-icons">delete</span></a>
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
    });

    $('#tableA').DataTable({
        "pagingType": "full_numbers"
    });

    function updatebtn(id)
    {
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data:{
                "get_category":1,
                "id":id,
            },
        success: function(respone)
        {
            if(respone[0])
            {
                Swal.fire({
                    title: 'Update category',
                    html:
                        '<input id="swal-input1" class="swal2-input" value="'+respone[1]+'">',
                    inputLabel: 'New Category Name',
                    showCancelButton: true,
                    customClass: {
                        validationMessage: 'my-validation-message'
                    },
                    preConfirm: (value) => {
                        if (!value) 
                        {
                            Swal.showValidationMessage('Category name is required')
                        }
                        else
                        {
                            $.ajax({
                                type: "POST",
                                url: "php/validation/form_validation.php",
                                dataType: 'json',
                                data:{
                                    "update_category_btn":1,
                                    "id":id,
                                    "name":$('.swal2-input').val(),
                                },
                                success:function(respone)
                                {
                                    if(respone[0] == 0)
                                    {
                                        Swal.fire({
                                            title:'Oops!', 
                                            text:'This category name has already been exist.', 
                                            icon:'error',
                                            didClose: () => window.scrollTo(0,0)});
                                    }
                                    else if(respone[0] == 1)
                                    {
                                        Swal.fire({
                                            title:'Successfully!', 
                                            text:'Category has been updated.', 
                                            icon:'success',
                                            didClose: () => location.reload()
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
                    }
                })
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
        error: function(respone)
        {
            console.log(respone);
            Swal.fire({
                title:'Oops! Something went wrong...', 
                text:'Please try again later', 
                icon:'error',
                didClose: () => window.scrollTo(0,0)});
        }
        })
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
                    dataType: 'json',
                    data:{
                        "category_delbtn":1,
                        "delID":id,
                    },
                    success:function(respone)
                    {
                        if(respone[0])
                        {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Category has been deleted.',
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
        })    
    }

    $(".addbtn").on('click',function(){
        Swal.fire({
            title: 'Add new category',
            input: 'text',
            inputLabel: 'Category Name',
            showCancelButton: true,
            customClass: {
                validationMessage: 'my-validation-message'
            },
            preConfirm: (value) => {
                if (!value) 
                {
                    Swal.showValidationMessage('Category name is required')
                }
                else
                {
                    $.ajax({
                        type: "POST",
                        url: "php/validation/form_validation.php",
                        dataType: 'json',
                        data:{
                            "add_category_btn":1,
                            "name":value,
                        },
                        success:function(respone)
                        {
                            if(respone[0] == 0)
                            {
                                Swal.fire({
                                    title:'Oops!', 
                                    text:'This category name has already been exist.', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                            }
                            else if(respone[0] == 1)
                            {
                                Swal.fire({
                                    title:'Successfully!', 
                                    text:'Category has been added.', 
                                    icon:'success',
                                    didClose: () => location.reload()
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
            }
        })
    });
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>