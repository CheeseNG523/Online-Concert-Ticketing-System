<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    if(isset($_GET['view']))
	{
        $id = $_GET['id'];
        $result =  "select * from customer where Cust_ID='$id'";
		$result_run = mysqli_query($connect,$result);
        $row = mysqli_fetch_assoc($result_run);
    }
?>
<script src="js/profile_form.js"></script>
    <div class="page_position">
        <div class="position_left">
            <label>Order</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">People</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <a rel="tab" href="customer.php">Customer</a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">View Customer</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">        
    <div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>      
        <form action="" class="update_venue_form" method="post" autocomplete="off">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title">View Customer</div>
                    <div class="profile_container">
                        <div class="profile-header" style="float:left; width:38%;">
                            <div class="image" style="float:left">
                                <img style="display: block;margin: auto;" width=50% height=50% class="profile_image"
                                src="<?php 
                                if($row['Cust_Image']=="")
                                {
                                    if($row['Cust_Gender']=='F')
                                        echo "../images/customer/female_profile.png";
                                    else if($row['Cust_Gender']=='M')
                                        echo "../images/customer/male_profile.png";
                                }
                                else
                                    echo $row['Cust_Image'];
                                ?>" style="display: block;" alt="">
                            </div>
                            <div class="nametag" style="float:left;">
                                <label class="user_name" style="color:#2e3849"><?php echo $row['Cust_Fname']." ".$row['Cust_Lname']; ?></label>
                                <label style="font-size:14px; font-weight:500;" class="user_position">Customer</label>     
                            </div>
                        </div>
                        <div class="profile-header" style="float:left; margin-left:4%; width:48%; border:0; padding: 0 10px;">
                            <div class="profile-info" style="margin:0;">
                                <label><span class="material-icons info">mail_outline</span><?php echo $row['Cust_Email']; ?></label>
                                <label><span class="material-icons info">stay_primary_portrait</span><?php echo $row['Cust_Cont_Num']; ?></label>
                                <label><span class="material-icons info">perm_identity</span><?php 
                                if($row['Cust_Gender']=='M')
                                    echo 'Male';
                                else
                                    echo 'Female';?></label>
                                
                                <label style="clear:both; float:left; width:38%;"><span class="material-icons info" style="padding-right:12%">location_on</span>State: <?php
                                if($row['Cust_State']=="")
                                    echo "N/A";
                                else
                                    echo $row['Cust_State'];
                                ?></label>
                                <label style="float:left; width:38%; margin-left:4%;"><span class="material-icons info" style="padding-right:12%">location_city</span>City: <?php
                                if($row['Cust_City']=="")
                                    echo "N/A";
                                else
                                    echo $row['Cust_City'];
                                ?></label>
                            </div>
                        </div>
                    </div>
                <table id="example" class="table_container" style="background:white; border: 1px solid #dadada;">
                    <thead >
                        <tr class="header">
                            <td colspan="6">Order History - Concert</td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <input type="text" id="input_concert_active"  class="search" placeholder="Search for names.." title="Type in a name">
                            </td>
                        </tr>
                        <tr class="header-bar">
                            <th width=15%>ID</th>
                            <th width=15%>Time</th>
                            <th width=25%>Concert</th>
                            <th width=20%>Area</th>
                            <th width=10%>Total(RM)</th>
                            <th width=15%>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table_content" id="table_row">
                        <?php
                        $active_result = mysqli_query($connect,"select A.Purchase_ID, DATE_FORMAT(Purchase_Date, '%d-%m-%Y %T') as 'Purchase_Date', 
                        Concert_Name, Price_Area, S_Ticket_Qty, `Total_Price` from purchase A, s_ticket B, concert C, ticket_price D WHERE 
                        B.Purchase_ID = A.Purchase_ID and B.PriceID = D.Price_ID and D.Concert_ID = C.Concert_ID and Card_verify = 1 and 
                        A.Cust_ID='$id' group by Purchase_Date desc");
                        while($row2=mysqli_fetch_assoc($active_result))
                        {
                            $PID = $row2['Purchase_ID'];
                            $result2 = mysqli_query($connect,"select Price_Area, Price, S_Ticket_Qty from purchase A, s_ticket B, ticket_price D WHERE B.Purchase_ID = A.Purchase_ID and B.PriceID = D.Price_ID and Card_verify = 1 and A.Purchase_ID = '$PID' group by Price order by Price desc");
                            ?>
                            <tr>
                                <td><?php echo "OID ".$row2['Purchase_ID']?></td>
                                <td><?php echo $row2['Purchase_Date']?></td>
                                <td><?php echo $row2['Concert_Name']?></td>
                                <td>
                                <?php
                                    while($result_run2 = mysqli_fetch_assoc($result2))
                                    {
                                        echo $result_run2['Price_Area']." RM ".$result_run2['Price']." * ".$result_run2['S_Ticket_Qty']."<br>";
                                    }
                                ?>
                                </td>
                                <td><?php echo $row2['Total_Price']?></td>
                                <td class="action_button">
                                    <a rel="tab" href="vieworderconcert.php?view&id=<?php echo $row2['Purchase_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <table id="example2" class="table_container" style="background:white; border: 1px solid #dadada; margin-top: 30px">
                    <thead >
                        <tr class="header">
                            <td colspan="7">Order History - Merchandise</td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <input type="text" id="input_concert_active_merch"  class="search" placeholder="Search for names.." title="Type in a name">
                            </td>
                        </tr>
                        <tr class="header-bar">
                            <th width=10%>ID</th>
                            <th width=15%>Time</th>
                            <th width=30%>Product</th>
                            <th width=15%>Subtotal(RM)</th>
                            <th width=10%>Total(RM)</th>
                            <th width=10%>Status</th>
                            <th width=10%>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table_content" id="table_row">
                            <?php
                            $merch_result = mysqli_query($connect,"select A.Purchase_ID, DATE_FORMAT(A.Purchase_Date, '%d-%m-%Y %T') as 'Purchase_Date', A.Total_Price, A.Purchase_Status from purchase A, s_merchandise C, merchandise D, 
                            purchase_address E where A.Purchase_ID=C.Purchase_ID and A.Purchase_ID = E.Purchase_ID and C.Cust_ID = A.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and 
                            D.Merchandise_unable = 0 and C.Cust_ID='$id' and A.Card_verify=1 group by A.Purchase_ID");
                            while($merch=mysqli_fetch_assoc($merch_result))
                            {
                                $id = $merch['Purchase_ID'];
                                $result = mysqli_query($connect,"select D.Merchandise_Name, D.Merchandise_ListPrice, C.S_Merchandise_Qty from purchase A, s_merchandise C, merchandise D, purchase_address E where A.Purchase_ID=C.Purchase_ID and A.Purchase_ID = E.Purchase_ID and C.Cust_ID = A.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and A.Purchase_ID = '$id' order by D.Merchandise_ListPrice desc");
                                $array = array();
                                ?>
                                <tr>
                                    <td><?php echo "OID ".$merch['Purchase_ID']?></td>
                                    <td><?php echo $merch['Purchase_Date']?></td>
                                    <td>
                                    <?php
                                        while($result_run = mysqli_fetch_assoc($result))
                                        {
                                            echo $result_run['Merchandise_Name']."<br>";
                                            $string = "RM ".$result_run['Merchandise_ListPrice']." * ".$result_run['S_Merchandise_Qty'];
                                            $array[] = ["Subtotal"=>$string];
                                        }
                                    ?>
                                    </td>
                                    <td>
                                        <?php
                                            for($i=0; $i<count($array); $i++)
                                            {
                                                echo $array[$i]['Subtotal']."<br>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $merch['Total_Price']?></td>
                                    <td><?php
                                    if($merch['Purchase_Status']==1)
                                    {
                                        echo 'To Ship';
                                    }
                                    else if($merch['Purchase_Status']==2)
                                    {
                                        echo 'To Receive';
                                    }
                                    else if($merch['Purchase_Status']==3)
                                    {
                                        echo 'Completed';
                                    }
                                    else
                                    {
                                        echo 'Unknow';
                                    }
                                    ?></td>
                                    <td class="action_button">
                                        <a rel="tab" href="viewordermerch.php?view&id=<?php echo $merch['Purchase_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                    </tbody>
                </table>
                <div class="button_field" style="margin-top: 30px;">
                    <button type="button" onclick="window.history.back()" style="background-color:#f44336">Back</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
<script>
     $(document).ready(function(){
        $("#input_concert_active").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table_row tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("#input_concert_active_merch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table_row tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('#example').DataTable({
            "pagingType": "full_numbers",
            "order": []
        });

        $('#example2').DataTable({
            "pagingType": "full_numbers",
            "order": []
        });
    });

    // function sortTable(n){
    //     var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        
    //     table = document.getElementById("table_row");
            
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
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>