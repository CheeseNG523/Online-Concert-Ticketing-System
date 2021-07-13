<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    $active_result = mysqli_query($connect,"select * from customer where Cust_Ban_Status != 1 and verified = 1");
    $complete_result = mysqli_query($connect,"select * from customer where Cust_Ban_Status != 1 and verified = 0");
    $ban_result = mysqli_query($connect,"select * from customer where Cust_Ban_Status = 1");
?>
<div class="page_position">
        <div class="position_left">
            <label>Customer</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">People</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Customer</label>
        </div>
</div>

<div class="page_position">
    <table id="TableA" class="table_container" style="background:white;">
        <thead >
            <tr class="header">
                <td colspan="5">Verified Customer</td>
            </tr>
            <tr>
                <td colspan="5">
                    <input type="text" id="tableA"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=24%>First Name</th>
                <th width=24%>Last Name</th>
                <th width=12%>Gender</th>
                <th width=20%>Contact Number</th>
                <th width=20%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_row">
            <?php
            while($row=mysqli_fetch_assoc($active_result))
            {
                ?>
                <tr>
                    <td class="search"><?php echo $row['Cust_Fname'];?></td>
                    <td class="search"><?php echo $row['Cust_Lname'];?></td>
                    <td class="search"><?php 
                        if($row['Cust_Gender']=='M')
                            echo 'Male';
                        else
                            echo 'Female';
                    ?></td>
                    <td class="search"><?php echo $row['Cust_Cont_Num'];?></td>
                    <td class="action_button">
                        <a rel="tab" href="viewcustomer.php?view&id=<?php echo $row['Cust_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                        <a href="#" title="Ban" style="float:left;" onclick="deletetable(<?php echo $row['Cust_ID']?>)"><span class="material-icons">delete</span></a>
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
                <td colspan="5">Unverified Customer</td>
            </tr>
            <tr>
                <td colspan="5">
                    <input type="text" id="tableB"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=24%>First Name</th>
                <th width=24%>Last Name</th>
                <th width=12%>Gender</th>
                <th width=20%>Contact Number</th>
                <th width=20%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_complete_row">
            <?php
            while($row2=mysqli_fetch_assoc($complete_result))
            {
                ?>
                <tr>
                    <td><?php echo $row2['Cust_Fname'];?></td>
                    <td><?php echo $row2['Cust_Lname'];?></td>
                    <td><?php 
                        if($row2['Cust_Gender']=='M')
                            echo 'Male';
                        else
                            echo 'Female';
                    ?></td>
                    <td><?php echo $row2['Cust_Cont_Num'];?></td>
                    <td class="action_button">
                        <a href="#" title="Ban" style="float:left;" onclick="deletetable(<?php echo $row2['Cust_ID']?>)"><span class="material-icons">delete</span></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <table id="TableC" class="table_container" style="background:white; margin-top:30px;">
        <thead >
            <tr class="header">
                <td colspan="4">Banned Customer</td>
            </tr>
            <tr>
                <td colspan="4">
                    <input type="text" id="tableC"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=29%>First Name</th>
                <th width=29%>Last Name</th>
                <th width=17%>Gender</th>
                <th width=25%>Contact Number</th>
            </tr>
        </thead>
        <tbody class="table_content" id="tablec">
            <?php
            while($row3=mysqli_fetch_assoc($ban_result))
            {
                ?>
                <tr>
                    <td><?php echo $row3['Cust_Fname'];?></td>
                    <td><?php echo $row3['Cust_Lname'];?></td>
                    <td><?php 
                        if($row3['Cust_Gender']=='M')
                            echo 'Male';
                        else
                            echo 'Female';
                    ?></td>
                    <td><?php echo $row3['Cust_Cont_Num'];?></td>
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
        $("#tableB").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table_complete_row tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#tableC").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tablec tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#TableA').DataTable({
            "pagingType": "full_numbers"
        });
        $('#TableB').DataTable({
            "pagingType": "full_numbers"
        });
        $('#TableC').DataTable({
            "pagingType": "full_numbers"
        });
    });

    // function sortTable(n,a) {
    //     var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            
    //     if(a==1)
    //         table = document.getElementById("table_row");
    //     else if(a==2)
    //         table = document.getElementById("table_complete_row");
            
    //     switching = true;
    //     //Set the sorting direction to ascending:
    //     dir = "asc"; 
    //     /*Make a loop that will continue until
    //     no switching has been done:*/
    //     while (switching) {
    //         //start by saying: no switching is done:
    //         switching = false;
    //         rows = table.rows;
    //         /*Loop through all table rows (except the
    //         first, which contains table headers):*/
    //         for (i = 0; i < (rows.length-1); i++) {
    //             //start by saying there should be no switching:
    //             shouldSwitch = false;
    //             /*Get the two elements you want to compare,
    //             one from current row and one from the next:*/
    //             x = rows[i].getElementsByTagName("td")[n];
    //             y = rows[i + 1].getElementsByTagName("td")[n];
    //             /*check if the two rows should switch place,
    //             based on the direction, asc or desc:*/
    //             if (dir == "asc") {
    //                 if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
    //                 //if so, mark as a switch and break the loop:
    //                 shouldSwitch= true;
    //                 break;
    //                 }
    //             } else if (dir == "desc") {
    //                 if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
    //                 //if so, mark as a switch and break the loop:
    //                 shouldSwitch = true;
    //                 break;
    //                 }
    //             }
    //         }
    //         if(n==0)
    //         {
    //             if(dir == "desc")
    //             {
    //                 $('.buttondown0').css({color:"#3498DB"});
    //                 $('.buttonup0').css({color: "#7B7B7B"});
    //             }
    //             else if (dir == "asc")
    //             {
    //                 $('.buttonup0').css({color:"#3498DB"});
    //                 $('.buttondown0').css({color: "#7B7B7B"});
    //             }
    //             $('.buttonup1').css({color: "#7B7B7B"});
    //             $('.buttonup2').css({color: "#7B7B7B"});
    //             $('.buttonup3').css({color: "#7B7B7B"});
    //             $('.buttonup4').css({color: "#7B7B7B"});
    //             $('.buttondown1').css({color: "#7B7B7B"});
    //             $('.buttondown2').css({color: "#7B7B7B"});
    //             $('.buttondown3').css({color: "#7B7B7B"});
    //             $('.buttondown4').css({color: "#7B7B7B"});
    //             $('.buttondown5').css({color: "#7B7B7B"});
    //             $('.buttonup5').css({color: "#7B7B7B"});
    //         }
    //         else if(n==1)
    //         {
    //             if(dir == "desc")
    //             {
    //                 $('.buttondown1').css({color:"#3498DB"});
    //                 $('.buttonup1').css({color: "#7B7B7B"});
    //             }
    //             else if (dir == "asc")
    //             {
    //                 $('.buttonup1').css({color:"#3498DB"});
    //                 $('.buttondown1').css({color: "#7B7B7B"});
    //             }
    //             $('.buttonup0').css({color: "#7B7B7B"});
    //             $('.buttonup2').css({color: "#7B7B7B"});
    //             $('.buttonup3').css({color: "#7B7B7B"});
    //             $('.buttonup4').css({color: "#7B7B7B"});
    //             $('.buttondown0').css({color: "#7B7B7B"});
    //             $('.buttondown2').css({color: "#7B7B7B"});
    //             $('.buttondown3').css({color: "#7B7B7B"});
    //             $('.buttondown4').css({color: "#7B7B7B"});
    //             $('.buttondown5').css({color: "#7B7B7B"});
    //             $('.buttonup5').css({color: "#7B7B7B"});
    //         }
    //         else if(n==2)
    //         {
    //             if(dir == "desc")
    //             {
    //                 $('.buttondown2').css({color:"#3498DB"});
    //                 $('.buttonup2').css({color: "#7B7B7B"});
    //             }
    //             else if (dir == "asc")
    //             {
    //                 $('.buttonup2').css({color:"#3498DB"});
    //                 $('.buttondown2').css({color: "#7B7B7B"});
    //             }
    //             $('.buttonup1').css({color: "#7B7B7B"});
    //             $('.buttonup0').css({color: "#7B7B7B"});
    //             $('.buttonup3').css({color: "#7B7B7B"});
    //             $('.buttonup4').css({color: "#7B7B7B"});
    //             $('.buttondown1').css({color: "#7B7B7B"});
    //             $('.buttondown0').css({color: "#7B7B7B"});
    //             $('.buttondown3').css({color: "#7B7B7B"});
    //             $('.buttondown4').css({color: "#7B7B7B"});
    //             $('.buttondown5').css({color: "#7B7B7B"});
    //             $('.buttonup5').css({color: "#7B7B7B"});
    //         }
    //         else if(n==3)
    //         {
    //             if(dir == "desc")
    //             {
    //                 $('.buttondown3').css({color:"#3498DB"});
    //                 $('.buttonup3').css({color: "#7B7B7B"});
    //             }
    //             else if (dir == "asc")
    //             {
    //                 $('.buttonup3').css({color:"#3498DB"});
    //                 $('.buttondown3').css({color: "#7B7B7B"});
    //             }
    //             $('.buttonup1').css({color: "#7B7B7B"});
    //             $('.buttonup2').css({color: "#7B7B7B"});
    //             $('.buttonup0').css({color: "#7B7B7B"});
    //             $('.buttonup4').css({color: "#7B7B7B"});
    //             $('.buttondown1').css({color: "#7B7B7B"});
    //             $('.buttondown2').css({color: "#7B7B7B"});
    //             $('.buttondown0').css({color: "#7B7B7B"});
    //             $('.buttondown4').css({color: "#7B7B7B"});
    //             $('.buttondown5').css({color: "#7B7B7B"});
    //             $('.buttonup5').css({color: "#7B7B7B"});
    //         }
    //         else if(n==4)
    //         {
    //             if(dir == "desc")
    //             {
    //                 $('.buttondown4').css({color:"#3498DB"});
    //                 $('.buttonup4').css({color: "#7B7B7B"});
    //             }
    //             else if (dir == "asc")
    //             {
    //                 $('.buttonup4').css({color:"#3498DB"});
    //                 $('.buttondown4').css({color: "#7B7B7B"});
    //             }
    //             $('.buttonup1').css({color: "#7B7B7B"});
    //             $('.buttonup2').css({color: "#7B7B7B"});
    //             $('.buttonup3').css({color: "#7B7B7B"});
    //             $('.buttonup0').css({color: "#7B7B7B"});
    //             $('.buttondown1').css({color: "#7B7B7B"});
    //             $('.buttondown2').css({color: "#7B7B7B"});
    //             $('.buttondown3').css({color: "#7B7B7B"});
    //             $('.buttondown0').css({color: "#7B7B7B"});
    //             $('.buttondown5').css({color: "#7B7B7B"});
    //             $('.buttonup5').css({color: "#7B7B7B"});
    //         }
    //         else if(n==5)
    //         {
    //             if(dir == "desc")
    //             {
    //                 $('.buttondown5').css({color:"#3498DB"});
    //                 $('.buttonup5').css({color: "#7B7B7B"});
    //             }
    //             else if (dir == "asc")
    //             {
    //                 $('.buttonup5').css({color:"#3498DB"});
    //                 $('.buttondown5').css({color: "#7B7B7B"});
    //             }
    //             $('.buttonup1').css({color: "#7B7B7B"});
    //             $('.buttonup2').css({color: "#7B7B7B"});
    //             $('.buttonup3').css({color: "#7B7B7B"});
    //             $('.buttonup0').css({color: "#7B7B7B"});
    //             $('.buttondown1').css({color: "#7B7B7B"});
    //             $('.buttondown2').css({color: "#7B7B7B"});
    //             $('.buttondown3').css({color: "#7B7B7B"});
    //             $('.buttondown0').css({color: "#7B7B7B"});
    //             $('.buttondown4').css({color: "#7B7B7B"});
    //             $('.buttonup4').css({color: "#7B7B7B"});
    //         }

    //         if (shouldSwitch) {
    //             /*If a switch has been marked, make the switch
    //             and mark that a switch has been done:*/
    //             rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
    //             switching = true;
    //             //Each time a switch is done, increase this count by 1:
    //             switchcount ++;
    //         }
    //         else
    //         {
    //             /*If no switching has been done AND the direction is "asc",
    //             set the direction to "desc" and run the while loop again.*/
    //             if (switchcount == 0 && dir == "asc")
    //             {
    //                 dir = "desc";
    //                 switching = true;
    //             }
    //         }
    //     }
    // }

    function deletetable(id)
    {
        Swal.fire({
            title: 'Are you sure you want to ban this customer?',
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
                        "customer_delbtn":1,
                        "delID":id,
                    },
                    success:function(respone)
                    {
                        if(respone[0])
                        {
                            Swal.fire({
                                title: 'Banned!',
                                text: 'This customer has been banned.',
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