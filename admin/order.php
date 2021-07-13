<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    $active_result = mysqli_query($connect,"select A.Purchase_ID, DATE_FORMAT(Purchase_Date, '%d-%m-%Y %T') as 'Purchase_Date', Concert_Name, Price_Area, S_Ticket_Qty, sum(S_Ticket_Qty*Price)as 'Total_Price' from purchase A, s_ticket B, concert C, ticket_price D WHERE B.Purchase_ID = A.Purchase_ID and B.PriceID = D.Price_ID and D.Concert_ID = C.Concert_ID and Concert_Unable = 0 and A.Card_verify = 1 group by A.Purchase_ID order by A.Purchase_Date desc");
?>
<div class="page_position">
        <div class="position_left">
            <label>Order - Ticket</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Order - Ticket</label>
        </div>
</div>

<div class="page_position">
    <table id="example" class="table_container" style="background:white;">
        <thead >
            <tr class="header">
                <td colspan="6">Ticket</td>
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
            while($row=mysqli_fetch_assoc($active_result))
            {
                $id = $row['Purchase_ID'];
                $result = mysqli_query($connect,"select Price_Area, Price, S_Ticket_Qty from purchase A, s_ticket B, ticket_price D WHERE B.Purchase_ID = A.Purchase_ID and B.PriceID = D.Price_ID and Card_verify = 1 and A.Purchase_ID = '$id' group by Price order by Price desc");
                ?>
                <tr>
                    <td><?php echo "OID ".$row['Purchase_ID']?></td>
                    <td><?php echo $row['Purchase_Date']?></td>
                    <td><?php echo $row['Concert_Name']?></td>
                    <td>
                    <?php
                        while($result_run = mysqli_fetch_assoc($result))
                        {
                            echo $result_run['Price_Area']." RM ".$result_run['Price']." * ".$result_run['S_Ticket_Qty']."<br>";
                        }
                    ?>
                    </td>
                    <td><?php echo $row['Total_Price']?></td>
                    <td class="action_button">
                        <a rel="tab" href="vieworderconcert.php?view&id=<?php echo $row['Purchase_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
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
            "pagingType": "full_numbers",
            "order": []
        });
    });

    function deleteconcert(id)
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "concert.php",
                    dataType: 'json',
                    data:{
                        "delbtn":1,
                        "delCID":id,
                    },
                    success:function()
                    {
                        
                    }
                });
                Swal.fire({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        icon: 'success',
                        didClose: () => location.reload()
                });
            }
        })    
    }
</script>
<?php
    if(isset($_POST['delbtn']))
    {
        $id = $_POST["delCID"];
        $imgconcert = "select Concert_Ver_Image, Concert_Hor_Image from concert where Concert_ID='$id'";
        $imgconcert_run = mysqli_query($connect,$imgconcert);
        $row = mysqli_fetch_assoc($imgconcert_run);
        $current_file = array($row['Concert_Ver_Image'],$row['Concert_Hor_Image']);

        for($index= 0; $index<2; $index++)
        {
            if(isset($current_file[$index]))
            {
                if(file_exists($current_file[$index]))
                    unlink($current_file[$index]);
            }
        }

        mysqli_query($connect,"delete from concert where Concert_ID='$id'");
        $returnArr = ['1'];   
        echo json_encode($returnArr);
    }
?>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>