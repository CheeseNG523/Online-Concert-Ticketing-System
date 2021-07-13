<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    $active_result = mysqli_query($connect,"select * from organizer where Organizer_unable=0");
?>
<div class="page_position">
        <div class="position_left">
            <label>Organizer</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">People</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Organizer</label>
        </div>
</div>

<div class="page_position">
    <table id="TableA" class="table_container" style="background:white;">
        <thead >
            <tr class="header">
                <td colspan="3">Organizer</td>
                <td class="Addbtn" colspan="1"><a rel="tab" class="addbtn" style="width:auto;"><span class="material-icons">add</span>Add Organizer</a></td>
            </tr>
            <tr>
                <td colspan="7">
                    <input type="text" id="tableA"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=25%>Name</th>
                <th width=25%>Link</th>
                <th width=25%>Active Concert</th>
                <th width=25%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_row">
            <?php
            while($row=mysqli_fetch_assoc($active_result))
            {
                ?>
                <tr>
                    <td><?php echo $row['Organizer_Name']?></td>
                    <td class="action_button"> <a rel="tab" href="<?php echo $row['Organizer_Link']; ?>" target="_blank"><span class="material-icons" style="vertical-align: bottom;">public</span><span style="margin-left:5%">View Webpage</span></a></td>
                    <td><?php 
                    $organizer_id = $row['Organizer_ID'];
                    $num = mysqli_query($connect,"select count(Concert_ID) as 'total' from concert where Organizer_ID = '$organizer_id' and Concert_unable = 0");
                    $num_row = mysqli_fetch_assoc($num);
                    echo $num_row['total'];
                    ?>
                    </td>
                    <td class="action_button">
                        <a rel="tab" href="#" onclick="updatebtn(<?php echo $row['Organizer_ID']?>)" title="Edit" style="float:left;"><span class="material-icons">edit</span></a>
                        <a href="#" title="Ban" style="float:left;" onclick="deletetable(<?php echo $row['Organizer_ID']?>)"><span class="material-icons">delete</span></a>
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
        $("#tableA").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table_row tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#TableA').DataTable({
            "pagingType": "full_numbers"
        });
    });

    $(".addbtn").on('click',function(){
        (async () => {	
            const { value: formValues } = await Swal.fire({
            title: 'New Organizer',
            html:
                '<input id="swal-input1" class="swal2-input" placeholder="Organizer Name">' +
                '<input id="swal-input2" class="swal2-input" placeholder="Organizer Link">',
            focusConfirm: false,
            showCancelButton: true,
            customClass: {
                    validationMessage: 'my-validation-message'
            },
            preConfirm: () => {
                var v1 = document.getElementById('swal-input1').value;
                var v2 = document.getElementById('swal-input2').value;
                if(v1==""||v2=="")
                    Swal.showValidationMessage('Please make sure data input is all valid.');
                else
                {
                    $.ajax({
                        type: "POST",
                        url: "php/validation/form_validation.php",
                        dataType: 'json',
                        data:{
                            "add_organizer_btn":1,
                            "name":v1,
                            "link":v2,
                        },
                        success:function(respone)
                        {
                            if(respone[0] == 0)
                            {
                                Swal.fire({
                                    title:'Oops!', 
                                    text:'This organizer name has already been exist.', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                            }
                            else if(respone[0] == 1)
                            {
                                Swal.fire({
                                    title:'Successfully!', 
                                    text:'Organizer has been added.', 
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
            }
            });
        })()
    });

    function updatebtn(id)
    {
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data:{
                "get_organizer":1,
                "id":id,
            },
            success:function(respone)
            {
                if(respone[0])
                {
                    (async () => {	
                        const { value: formValues } = await Swal.fire({
                        title: 'Update Organizer',
                        html:
                            '<input id="swal-input1" class="swal2-input" value="'+respone[1]+'">' +
                            '<input id="swal-input2" class="swal2-input" value="'+respone[2]+'">',
                        showCancelButton: true,
                        focusConfirm: false,
                        customClass: {
                                validationMessage: 'my-validation-message'
                        },
                        preConfirm: () => {
                            var v1 = document.getElementById('swal-input1').value;
                            var v2 = document.getElementById('swal-input2').value;
                            if(v1==""||v2=="")
                                Swal.showValidationMessage('Please make sure data input is all valid.');
                            else
                            {
                                Swal.fire({
                                    icon: "warning",
                                    title: "Update Organizer",
                                    text: 'Are you sure you want to update this organizer?',
                                    showCancelButton: true,
                                    confirmButtonText: `Yes`,
                                    denyButtonText: `No`,
                                }).then((result) => {
                                    if (result.isConfirmed)
                                    {
                                        $.ajax({
                                            type: "POST",
                                            url: "php/validation/form_validation.php",
                                            dataType: 'json',
                                            data:{
                                                "update_organizer_btn":1,
                                                "updateid":id,
                                                "name":v1,
                                                "link":v2,
                                            },
                                            success:function(respone)
                                            {
                                                if(respone[0] == 0)
                                                {
                                                    Swal.fire({
                                                        title:'Oops!', 
                                                        text:'This organizer name has already been exist.', 
                                                        icon:'error',
                                                        didClose: () => window.scrollTo(0,0)});
                                                }
                                                else if(respone[0] == 1)
                                                {
                                                    Swal.fire({
                                                        title:'Successfully!', 
                                                        text:'Organizer has been updated.', 
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
                            }
                            });
                        })()
                }
            },
            error:function(respone)
            {
                console.log(respone);
            }
        });
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
                        "organizer_delbtn":1,
                        "delID":id,
                    },
                    success:function(respone)
                    {
                        if(respone[0])
                        {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'This organizer has been deleted.',
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