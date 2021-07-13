<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    $active_result = mysqli_query($connect,"select A.Purchase_ID, A.Purchase_Status, DATE_FORMAT(A.Purchase_Date, '%d-%m-%Y %T') as 'Purchase_Date', A.Total_Price from purchase A, s_merchandise C, merchandise D, 
    purchase_address E where A.Purchase_ID=C.Purchase_ID and A.Purchase_ID = E.Purchase_ID and C.Cust_ID = A.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and 
    D.Merchandise_unable = 0 and A.Card_verify=1 and A.Purchase_Status = 1 group by A.Purchase_ID order by A.Purchase_Date desc");

    $receive_result = mysqli_query($connect,"select A.Purchase_ID, A.Purchase_Status, DATE_FORMAT(A.Purchase_Date, '%d-%m-%Y %T') as 'Purchase_Date', A.Total_Price from purchase A, s_merchandise C, merchandise D, 
    purchase_address E where A.Purchase_ID=C.Purchase_ID and A.Purchase_ID = E.Purchase_ID and C.Cust_ID = A.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and 
    D.Merchandise_unable = 0 and A.Card_verify=1 and A.Purchase_Status = 2 group by A.Purchase_ID order by A.Purchase_Date desc");

    $completed_result = mysqli_query($connect,"select A.Purchase_ID, A.Purchase_Status, DATE_FORMAT(A.Purchase_Date, '%d-%m-%Y %T') as 'Purchase_Date', A.Total_Price from purchase A, s_merchandise C, merchandise D, 
    purchase_address E where A.Purchase_ID=C.Purchase_ID and A.Purchase_ID = E.Purchase_ID and C.Cust_ID = A.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and 
    D.Merchandise_unable = 0 and A.Card_verify=1 and A.Purchase_Status = 3 and A.Purchase_Date >= DATE_ADD(NOW(), INTERVAL -5 MONTH) group by A.Purchase_ID order by A.Purchase_Date desc");
?>
<div class="page_position">
        <div class="position_left">
            <label>Order - Merchandise</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Order - Merchandise</label>
        </div>
</div>

<div class="page_position">
    <table id="example" class="table_container" style="background:white;">
        <thead >
            <tr class="header">
                <td colspan="6">To Ship</td>
            </tr>
            <tr>
                <td colspan="6">
                    <input type="text" id="input_concert_active"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=10%>ID</th>
                <th width=15%>Time</th>
                <th width=25%>Product</th>
                <th width=15%>Subtotal(RM)</th>
                <th width=10%>Total(RM)</th>
                <th width=15%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_row">
            <?php
            while($active_row=mysqli_fetch_assoc($active_result))
            {
                $id = $active_row['Purchase_ID'];
                $result = mysqli_query($connect,"select D.Merchandise_Name, D.Merchandise_ListPrice, C.S_Merchandise_Qty from purchase A, s_merchandise C, merchandise D, purchase_address E where A.Purchase_ID=C.Purchase_ID and A.Purchase_ID = E.Purchase_ID and C.Cust_ID = A.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and A.Purchase_ID = '$id' order by D.Merchandise_ListPrice desc");
                $array = array();
                ?>
                <tr>
                    <td><?php echo "OID ".$active_row['Purchase_ID']?></td>
                    <td><?php echo $active_row['Purchase_Date']?></td>
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
                    <td><?php echo $active_row['Total_Price']?></td>
                    <td class="action_button">
                        <a rel="tab" href="viewordermerch.php?view&id=<?php echo $active_row['Purchase_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                        <a rel="tab" onclick="updateMerch(<?php echo $active_row['Purchase_ID'];?>,1)" title="Update" style="float:left;"><span class="material-icons">edit</span></a>
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
                <td colspan="6">To Receive</td>
            </tr>
            <tr>
                <td colspan="6">
                    <input type="text" id="tableB"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=15%>ID</th>
                <th width=15%>Time</th>
                <th width=20%>Product</th>
                <th width=15%>Subtotal(RM)</th>
                <th width=10%>Total(RM)</th>
                <th width=15%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_row">
            <?php
            while($receive_row=mysqli_fetch_assoc($receive_result))
            {
                $id = $receive_row['Purchase_ID'];
                $result = mysqli_query($connect,"select D.Merchandise_Name, D.Merchandise_ListPrice, C.S_Merchandise_Qty from purchase A, s_merchandise C, merchandise D, purchase_address E where A.Purchase_ID=C.Purchase_ID and A.Purchase_ID = E.Purchase_ID and C.Cust_ID = A.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and A.Purchase_ID = '$id' order by D.Merchandise_ListPrice desc");
                $array = array();
                ?>
                <tr>
                    <td><?php echo "OID ".$receive_row['Purchase_ID']?></td>
                    <td><?php echo $receive_row['Purchase_Date']?></td>
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
                    <td><?php echo $receive_row['Total_Price']?></td>
                    <td class="action_button">
                        <a rel="tab" href="viewordermerch.php?view&id=<?php echo $receive_row['Purchase_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                        <a rel="tab" onclick="updateMerch(<?php echo $receive_row['Purchase_ID'];?>,2)" title="Update" style="float:left;"><span class="material-icons">edit</span></a>
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
                <td colspan="6">Completed</td>
            </tr>
            <tr>
                <td colspan="6">
                    <input type="text" id="tableC"  class="search" placeholder="Search for names.." title="Type in a name">
                </td>
            </tr>
            <tr class="header-bar">
                <th width=15%>ID</th>
                <th width=15%>Time</th>
                <th width=20%>Product</th>
                <th width=15%>Subtotal(RM)</th>
                <th width=10%>Total(RM)</th>
                <th width=15%>Action</th>
            </tr>
        </thead>
        <tbody class="table_content" id="table_row">
            <?php
            while($completed_row=mysqli_fetch_assoc($completed_result))
            {
                $id = $completed_row['Purchase_ID'];
                $result = mysqli_query($connect,"select D.Merchandise_Name, D.Merchandise_ListPrice, C.S_Merchandise_Qty from purchase A, s_merchandise C, merchandise D, purchase_address E where A.Purchase_ID=C.Purchase_ID and A.Purchase_ID = E.Purchase_ID and C.Cust_ID = A.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and A.Purchase_ID = '$id' order by D.Merchandise_ListPrice desc");
                $array = array();
                ?>
                <tr>
                    <td><?php echo "OID ".$completed_row['Purchase_ID']?></td>
                    <td><?php echo $completed_row['Purchase_Date']?></td>
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
                    <td><?php echo $completed_row['Total_Price']?></td>
                    <td class="action_button">
                        <a rel="tab" href="viewordermerch.php?view&id=<?php echo $completed_row['Purchase_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
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
        $('#TableB').DataTable({
            "pagingType": "full_numbers"
        });
        $('#TableC').DataTable({
            "pagingType": "full_numbers"
        });
        $('#example').DataTable({
            "pagingType": "full_numbers",
            "order": []
        });
    });

    function updateMerch(id,choice)
    {
        Swal.fire({
            title: 'Update Order Status',
            input: 'select',
            inputOptions: {
                '1': 'To Ship',
                '2': 'To Receive',
                '3': 'Completed'
            },
            inputPlaceholder: 'Status',
            showCancelButton: true,
            inputValidator: function (value) {
                return new Promise(function (resolve, reject) {
                if (value !== '') {
                    resolve();
                } else {
                    resolve('Please fill in this field');
                }
                });
            }
            }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "php/validation/form_validation.php",
                    type: "POST",
                    data:{
                        "update_merch_status":1,
                        "status":result.value,
                        'id':id
                    },
                    success:function(respone)
                    {
                        if(respone)
                        {
                            Swal.fire({
                                title: 'Updated!',
                                text: 'Order status has been updated.',
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
                            });
                        }
                    },
                    error: function(respone)
                    {
                        console.log(respone)
                    }
                }); 
            }
        });
    }
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>