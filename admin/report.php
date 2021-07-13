<?php
    include 'dataconnection.php';
    include 'header_sidebar.php';

    $total = array();
    $total_gender = array();
    $total_week = array();
    $count = 0;
    for($i = 0; $i < count($_POST["concert_report"]); $i++)
    {
        $array_count = 0;
        if(isset($_POST["concert_report"][$i]))
        {
            $array = array();
            $id = $_POST["concert_report"][$i];
            if($id !== "")
            {
                $name="select A.Concert_Name, A.Concert_StartDate, A.Concert_Status, B.Venue_Name, C.Organizer_Name from concert A, venue B, organizer C WHERE A.Venue_ID = B.Venue_ID and C.Organizer_ID = A.Organizer_ID and A.Concert_ID = '$id'";
                $name_run = mysqli_query($connect,$name);
                $name_row = mysqli_fetch_assoc($name_run);
                $concert_name = $name_row['Concert_Name'];
                $concert_status = $name_row['Concert_Status'];
                $venue_name = $name_row['Venue_Name'];
                $organizer_name = $name_row['Organizer_Name'];
                $concert_date = $name_row['Concert_StartDate'];
                
                $area = "select A.Price_ID, A.Price_Area, A.Price from ticket_price A, concert B where A.Concert_ID = B.Concert_ID and B.Concert_ID = '$id' and ticket_price_unable = 0 order by A.price desc";
                $area_run = mysqli_query($connect,$area);
                while($row = mysqli_fetch_assoc($area_run))
                {
                    $Price_ID = $row['Price_ID'];
                    $price_name = $row['Price_Area'];
                    $price = $row['Price'];
                    $getnum =  "select sum(D.S_Ticket_Qty)as'sold',sum(D.S_Ticket_Qty*B.Price) as 'Total' from concert A, ticket_price B, purchase C, s_ticket D where A.Concert_ID=B.Concert_ID and C.Purchase_ID=D.Purchase_ID and D.PriceID = B.Price_ID and Card_verify = 1 and A.Concert_ID = '$id' and B.Price_ID = '$Price_ID' group by B.Price_ID order by B.Price DESC";
                    $getnum_run = mysqli_query($connect,$getnum);
                    $getnum_row = mysqli_fetch_assoc($getnum_run);

                    if(mysqli_num_rows($getnum_run)==0)
                    {
                        $sold = 0;
                        $soldTotal = 0;
                    }
                    else
                    {
                        $sold = $getnum_row['sold'];
                        $soldTotal = $getnum_row['Total'];
                    }

                    $array[] = ["concert"=>$concert_name, "concert_status"=>$concert_status,"venue"=>$venue_name,"organizer"=>$organizer_name,"concert_data"=>date_format(date_create($concert_date), "d-m-Y, H:i:s"),"area_name"=>$price_name,"price"=>$price,"sold"=>$sold,"total"=>$soldTotal];
                }
                $total[$count] = $array;

                //calculate number of male / female
                $gender = mysqli_query($connect,"select if(Cust_Gender='M','Male','Female') as 'gender', sum(D.S_Ticket_Qty) as 'number' from customer A, purchase B, concert C, s_ticket D, ticket_price E where A.Cust_ID = B.Cust_ID and D.Purchase_ID = B.Purchase_ID and D.PriceID = E.Price_ID and C.Concert_ID = E.Concert_ID and Card_verify = 1 and C.Concert_ID = '$id'");
                $gender_data = array();
                while($gender_row = mysqli_fetch_assoc($gender))
                {
                    $gender_data[] = $gender_row;
                }
                $total_gender[$count] = $gender_data;

                //calculate number of users buying in which day
                $week = mysqli_query($connect,"SELECT DAYOFWEEK(A.Purchase_Date)as'Week', count(C.S_Ticket_Qty)as'total_week' from purchase A, concert B, s_ticket C, ticket_price D where A.Purchase_ID = C.Purchase_ID and C.PriceID = D.Price_ID and B.Concert_ID = D.Concert_ID and A.Card_verify = 1 and B.Concert_ID = '$id' group by DAYOFWEEK(A.Purchase_Date) order by DAYOFWEEK(A.Purchase_Date) ASC");
                $raw_week = array();
                while($week_row = mysqli_fetch_assoc($week))
                {
                    $raw_week[] = $week_row;
                }
                $week_data = array();
                $j=1;
                for($j=1; $j<=7; $j++)
                {
                    $found = 0;
                    for($k=0; $k<count($raw_week); $k++)
                    {
                        if($raw_week[$k]['Week'] == $j)
                        {
                            $week_data[$j] = ["total_week"=>$raw_week[$k]['total_week']];
                            $found = 1;
                        }
                    }
                    
                    if($found == 0)
                        $week_data[$j] = ["total_week"=>"0"];
                }
                $total_week[$count] = $week_data;

                $count++;
            }
        }
    }
    //edit
    $_SESSION['arrayconcert'] = $total;
    $_SESSION['arraygender'] = $total_gender;
    // $_SESSION['arrayweek'] = $total_week;
?>
<script>
    $(document).ready(function (){
        var gender_chart_id = [];
        var weekly_chart_id = [];
        var array = [];
        var i = 0;
        var concert_name = [];
        var concert_data = [];
        var venue_name = [];
        var organizer = [];
        var status = [];
        var price_id = [];
        var price_name = [];
        var price = [];
        var sold = [];
        var total = [];
        array = <?php echo json_encode($total) ?>;
        // console.log(array);
        for(i in array)
        {
            j=0;
            var soldtotal = 0.0;
            var revenuetotal = 0.0;
            //console.log(array[i][0].concert);
            concert_name[i] = array[i][0].concert;
            concert_data[i] = array[i][0].concert_data;
            venue_name[i] = array[i][0].venue;
            organizer[i] = array[i][0].organizer;

            if(array[i][0].concert_status == 0)
                status[i] = "Saved";
            else if(array[i][0].concert_status == 1)
                status[i] = "Upcoming";
            else if(array[i][0].concert_status == 2)
                status[i] = "On sold";
            else if(array[i][0].concert_status == 3)
                status[i] = "Ended";

            var text = '<div class="print_content"><img src="../images/header_footer/logo.png">';
            text += '<h4>Concert: '+concert_name[i]+'</h4>';
            text += '<h4>Date: '+concert_data[i]+'</h4>';
            text += '<h4>Venue: '+venue_name[i]+'</h4>';
            text += '<h4>Organizer: '+organizer[i]+'</h4>';
            text += '<h4>Status: '+status[i]+'</h4>';
            text += '<table class="table_container" style="background:white; padding: 5%; box-shadow: 0 0 5px 5px rgb(245, 245, 245);"><thead><tr class="header-bar">';
            text += '<th width=20%>Area Name</th>';
            text += '<th width=20%>Area Price (RM)</th>';
            text += '<th width=20%>Sold</th>';
            text += '<th width=20%>Total (RM)</th>';
            text += '<th width=20%>Revenue (RM)</th>';
            text += '</tr></thead><tbody class="table_content">';
            for(j in array[i])
            {
                soldtotal += parseFloat(array[i][j].total);
                revenuetotal += parseFloat(array[i][j].total)*1.00;
                text += '<tr>';
                text += '<td>'+array[i][j].area_name+'</td>';
                text += '<td>'+parseFloat(array[i][j].price).toFixed(2)+'</td>';
                text += '<td>'+array[i][j].sold+'</td>';
                text += '<td>'+parseFloat(array[i][j].total).toFixed(2)+'</td>';
                text += '<td>'+parseFloat(array[i][j].total*1.00).toFixed(2)+'</td>';//revenue commission
                text += '</tr>';
            }
            text += '<tr>';
            text += '<td colspan=3 class="total_dis">Total:</td>';
            text += '<td>'+soldtotal.toFixed(2)+'</td>';
            text += '<td class="total_revenue">RM '+revenuetotal.toFixed(2)+'</td>';
            text+= '</tr>';
            text += '</tbody></table>';
            text += '<div class="data-chart">';
            text += '<canvas id="genderChart'+i+'"></canvas>';
            text += '</div>';
            text += '<div class="data-chart">';
            text += '<canvas id="weeklyChart'+i+'"></canvas>';
            text += '</div>';
            text += '<br><br><label>*This is a computer-generated document. No signature is required.</label>';
            text += '</div>';
            gender_chart_id[i] = "genderChart"+i;
            weekly_chart_id[i] = "weeklyChart"+i;
            $('.print').append(text);
        }

        var gender_data = [];
        gender_data = <?php echo json_encode($total_gender); ?>;
        console.log(gender_data);

        var week_data = [];
        week_data = <?php echo json_encode($total_week); ?>;
        var week_name = ["Sunday","Monday","Tuesday","Wednesday","Thurday","Friday","Saturday"];
        //console.log(week_data);

        for(var l in array)
        {
            //get chart name
            var piechart_name = "Audience distribution of "+concert_name[l]+", by gender";

            var gender_type = [];
            var num_gender = [];
            console.log(gender_data);
            for(var k in gender_data[l])
            {
                gender_type.push(gender_data[l][k].gender);
                num_gender.push(gender_data[l][k].number);
            }
            console.log(gender_type);
            console.log(num_gender);

            var week_num = [];
            for(var m in week_data[l])
            {
                week_num.push(week_data[l][m].total_week);
            }
            //console.log(week_name);
            //console.log(week_num);


            var barchartdata = {
                datasets: [
                    {
                        data: week_num,
                        backgroundColor:[
                            "rgba(255, 99, 132, 0.3)",
                            "rgba(255, 159, 64, 0.3)",
                            "rgba(255, 205, 86, 0.3)",
                            "rgba(75, 192, 192, 0.3)",
                            "rgba(54, 162, 235, 0.3)",
                            "rgba(153, 102, 255, 0.3)",
                            "rgba(201, 203, 207, 0.3)"
                        ],
                            
                        borderColor:[
                            "rgb(255, 99, 132)",
                            "rgb(255, 159, 64)",
                            "rgb(255, 205, 86)",
                            "rgb(75, 192, 192)",
                            "rgb(54, 162, 235)",
                            "rgb(153, 102, 255)",
                            "rgb(201, 203, 207)"
                        ],

                        borderWidth:1,
                    }
                ],
                labels: week_name,
            };

            var piechartdata = {
                datasets: [
                    {
                        data: num_gender,
                        backgroundColor: [
                            'rgba(76,187,23,1)',
                            'rgba(137,207,240,1)'
                        ],
                    }
                ],
                labels: gender_type,
            };

            var pie_ctx = document.getElementById(gender_chart_id[l]).getContext('2d');
            var myPieChart = new Chart(pie_ctx, {
                type: 'pie',
                data: piechartdata,
                options:{
                    title:{
                        display:true,
                        align: 'center',
                        text: piechart_name,
                        fontSize: 15,
                    },
                    legend:{
                        display:true,
                        position:'bottom'
                    },
                    responsive:true,
                    maintainAspectRatio: false,
                }
            });

            var bar_ctx = document.getElementById(weekly_chart_id[l]).getContext('2d');
            var myPieChart = new Chart(bar_ctx, {
                type: 'bar',
                data: barchartdata,
                options:{
                    title:{
                        display:true,
                        align: 'center',
                        text:"Tickets sold by day of week",
                        fontSize: 20,
                    },
                    legend:{
                        display:false,
                        position:'bottom'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                precision:0,
                            }
                        }]
                    },
                    responsive:true,
                    maintainAspectRatio: false,
                }
            });
        }
    });
</script>
<div class="page_position">
    <div class="position_left">
        <label>Sales Report</label>
    </div>
    <div class="position_right">
        <a rel="tab" href="#">
            <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
        </a>
        <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
        <a rel="tab" href="salesreport.php">Sales Report</a>
        <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
        <label class="current_direction">Report</label>
    </div>
</div>
<div class="profile_container">
    <div class="container_title" style="text-align:center">Sales Report
        <div class="print_btn"><a href="concert_pdf.php" target="_blank"><span class="material-icons">picture_as_pdf</span>Download</a></div>
    </div>
    
    <div class="print"></div>
</div>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>