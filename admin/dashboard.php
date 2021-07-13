<?php include 'header_sidebar.php'; 
           
    $admin_email = $row['Admin_Email'];

    $active_order = mysqli_query($connect,"select * from purchase A, s_merchandise B, merchandise C where A.Purchase_ID = B.Purchase_ID and B.Merchandise_ID = C.Merchandise_ID and A.Purchase_Status is not null and A.Purchase_Status != 3 group by A.Purchase_ID");

    $customer = mysqli_query($connect,"select count(Cust_ID) as 'Customer' from customer where verified = 1 and Cust_Ban_Status = 0");
    $cust_row = mysqli_fetch_assoc($customer);

    $concert = mysqli_query($connect,"select count(Concert_ID) as 'concert' from concert where Concert_Status > 0 and Concert_Status < 3 and Concert_unable = 0");
    $concert_row = mysqli_fetch_assoc($concert);

    $merchandise = mysqli_query($connect,"select count(Merchandise_ID) as 'merchandise' from merchandise where Merchandise_Status <2 and Merchandise_unable = 0");
    $stock_check = mysqli_query($connect,"select count(Merchandise_ID) as 'merchandise' from merchandise where Merchandise_Status <2 and Merchandise_unable = 0 and Merchandise_Stock <= 10");
    $merch_row = mysqli_fetch_assoc($merchandise);
    $stock = mysqli_fetch_assoc($stock_check);
?>
    <div class="page_position">
        <div class="position_left">
            <label>Dashboard</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
				<span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
			</a>
        </div>
    </div>
    <div class="profile_container" style="padding:5%">
        <div class="buttondashboard">
            <a href="merch_order.php" class="order" style="margin-right: 3%; background-color:#8787fa;"><div><div class="number" style="padding-bottom: 5px;"><?php echo mysqli_num_rows($active_order);?></div><div class="title">Active <br>Merchandise Order</div></div><div class="view_animate" style="top: -13px;"><span>More info</span></div></a>
            <a href="concert.php" class="concert" style="margin-right: 3%; background-color:#00c0ef;"><div><div class="number"><?php echo $concert_row['concert']; ?></div><div class="title">Concert</div></div><div class="view_animate"><span>More info</span></div></a>
            <a href="merchandise.php" class="merchandise" style="margin-right: 3%; background-color:#00a65a;"><div><div class="number"><?php echo $merch_row['merchandise']; ?></div><div class="title">Merchandise
            <?php if($stock['merchandise']>0)
                    echo '<span class="material-icons" title="Low Stock" style="font-size:20px; vertical-align:bottom;">error</span>';
            ?></div></div><div class="view_animate"><span>More info</span></div></a>
            <a href="customer.php" class="customer" style="background-color:#f39c12;"><div><div class="number"><?php echo $cust_row['Customer']; ?></div><div class="title">Customer</div></div><div class="view_animate"><span>More info</span></div></a>
        </div>
        <div class="data-chart" style="clear:both; float:left; width: 50%;">
            <canvas id="concertChart"></canvas>
        </div>
        <div class="data-chart" style="float:left; width: 50%">
            <canvas id="revenueChart"></canvas>
        </div>
        <div class="data-chart" style="clear:both; float:left; width: 50%">
            <canvas id="registerChart"></canvas>
        </div>
        <div class="data-chart" style="float:left; width: 50%">
            <canvas id="genderChart"></canvas>
        </div>
    </div>
</div>
<script>
    var gender_type = [];
    var num_gender = [];
    var month = [];
    var num_cust = [];
    var concert_month = [];
    var num_concert = [];
    var revenue_month = [];
    var num_revenue = [];
    $(document).ready(function(){
        $.ajax({
            type: "POST",
            url: "php/validation/chart.php",
            data: {"gender_chart":1},
            dataType: "json",
            success: function(respone)
            {
                for(var i in respone)
                {
                    gender_type.push(respone[i].gender);
                    num_gender.push(respone[i].number);
                }
                
                var chartdata = {
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

                var ctx = document.getElementById('genderChart').getContext('2d');
                var myPieChart = new Chart(ctx, {
                    responsive:true,
                    maintainAspectRatio: false,
                    type: 'pie',
                    data: chartdata,
                    options:{
                        title:{
                            display:true,
                            align: 'center',
                            text:"Users distribution registered in Concerta, by gender",
                            fontSize: 15,
                        },
                        legend:{
                            display:true,
                            position:'bottom'
                        }
                    }
                });
            },
            error: function(respone)
            {
                console.log(respone);
            }
        });

        $.ajax({
            type: "POST",
            url: "php/validation/chart.php",
            data: {"resgister_chart":1},
            dataType: "json",
            success: function(respone)
            {
                var max_value  = respone[0].num;
                for(var i in respone)
                {
                    month.push(respone[i].month);
                    num_cust.push(respone[i].num);
                    if(respone[i].num >= max_value)
                        max_value = respone[i].num;
                }
                
                var custNumchartdata = {
                    datasets: [
                        {
                            data: num_cust,
                            backgroundColor: [
                                'rgba(81,194,213,0.3)',
                            ],
                            pointBackgroundColor:[
                                'rgba(236,70,70,1)',
                                'rgba(236,70,70,1)',
                                'rgba(236,70,70,1)',
                                'rgba(236,70,70,1)',
                                'rgba(236,70,70,1)',
                            ],
                        }
                    ],
                    labels: month,
                };

                var line_ctx = document.getElementById('registerChart').getContext('2d');
                var myPieChart = new Chart(line_ctx, {
                    responsive:true,
                    maintainAspectRatio: false,
                    type: 'line',
                    data: custNumchartdata,
                    options:{
                        title:{
                            display:true,
                            align: 'center',
                            text:"Number of users registered in Concerta, by month",
                            fontSize: 15,
                        },
                        legend:{
                            display:false,
                            position:'bottom'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    precision:0,
                                    suggestedMax: max_value+1,
                                }
                            }]
                        }
                    }
                });
            },
            error: function(respone)
            {
                console.log(respone);
            }
        });

        $.ajax({
            type: "POST",
            url: "php/validation/chart.php",
            data: {"concert_chart":1},
            dataType: "json",
            success: function(respone)
            {
                var max_value  = respone[0].num;
                
                for(var i in respone)
                {
                    concert_month.push(respone[i].month);
                    num_concert.push(respone[i].num);

                    if(respone[i].num >= max_value)
                        max_value = parseInt(respone[i].num);
                }
                max_value += 4;
                
                var barchartdata = {
                    datasets: [
                        {
                            data: num_concert,
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
                    labels: concert_month,
                };

                var bar_ctx = document.getElementById('concertChart').getContext('2d');
                var myPieChart = new Chart(bar_ctx, {
                    type: 'bar',
                    data: barchartdata,
                    options:{
                        title:{
                            display:true,
                            align: 'center',
                            text:"Past concerts in Concerta, by month",
                            fontSize: 20,
                        },
                        legend:{
                            display:false,
                            position:'bottom'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    precision:0,
                                    suggestedMax: max_value,
                                }
                            }]
                        },
                        responsive:true,
                        maintainAspectRatio: false,
                    }
                });
            },
            error: function(respone)
            {
                console.log(respone);
            }
        });

        $.ajax({
            type: "POST",
            url: "php/validation/chart.php",
            data: {"revenue_chart":1},
            dataType: "json",
            success: function(respone)
            {
                var max_value  = respone[0].num;
                for(var i in respone)
                {
                    revenue_month.push(respone[i].month);
                    num_revenue.push(respone[i].num);
                    if(respone[i].num >= max_value)
                        max_value = respone[i].num;
                }
                
                var custNumchartdata = {
                    datasets: [
                        {
                            data: num_revenue,
                            backgroundColor: [
                                'rgba(81,194,213,0.3)',
                            ],
                            pointBackgroundColor:[
                                'rgba(236,70,70,1)',
                                'rgba(236,70,70,1)',
                                'rgba(236,70,70,1)',
                                'rgba(236,70,70,1)',
                                'rgba(236,70,70,1)',
                            ],
                        }
                    ],
                    labels: revenue_month,
                };

                var line_ctx = document.getElementById('revenueChart').getContext('2d');
                var myPieChart = new Chart(line_ctx, {
                    responsive:true,
                    maintainAspectRatio: false,
                    type: 'line',
                    data: custNumchartdata,
                    options:{
                        title:{
                            display:true,
                            align: 'center',
                            text:"Revenue in Concerta, by month",
                            fontSize: 15,
                        },
                        legend:{
                            display:false,
                            position:'bottom'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    precision:0,
                                    suggestedMax: max_value+1,
                                }
                            }]
                        }
                    }
                });
            },
            error: function(respone)
            {
                console.log(respone);
            }
        });
    });
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>