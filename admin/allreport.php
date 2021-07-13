<?php
    include 'dataconnection.php';
    include 'header_sidebar.php';
    $SDate = $_POST['start-date'];
    $EDate = $_POST['end-date'];
    
    if($SDate === $EDate)
        $revenue = mysqli_query($connect,"select B.Concert_Name, sum(C.S_Ticket_Qty*D.Price) as 'Total', F.Organizer_Name from purchase A, concert B, s_ticket C, ticket_price D, organizer F where F.Organizer_ID = B.Organizer_ID and A.Purchase_ID = C.Purchase_ID and C.PriceID = D.Price_ID and B.Concert_ID = D.Concert_ID and A.Card_verify = 1 and DATE(A.Purchase_Date) = '$SDate' group by B.Concert_ID");
    else
        $revenue = mysqli_query($connect,"select B.Concert_Name, sum(C.S_Ticket_Qty*D.Price) as 'Total', F.Organizer_Name from purchase A, concert B, s_ticket C, ticket_price D, organizer F where F.Organizer_ID = B.Organizer_ID and A.Purchase_ID = C.Purchase_ID and C.PriceID = D.Price_ID and B.Concert_ID = D.Concert_ID and A.Card_verify = 1 and DATE(A.Purchase_Date) >= '$SDate' and DATE(A.Purchase_Date) <= '$EDate' group by B.Concert_ID");
    $revenue_array = array();
    while($revenue_row = mysqli_fetch_assoc($revenue))
    {
        $revenue_array[] = $revenue_row;
    }

    $revenue_merch = mysqli_query($connect,"select A.Merchandise_ID, A.Merchandise_Name, A.Merchandise_Price, A.Merchandise_ListPrice, sum(C.S_Merchandise_Qty)as'Purchased' 
    from merchandise A, purchase B, s_merchandise C where A.Merchandise_ID = C.Merchandise_ID and C.Purchase_ID = B.Purchase_ID 
    and B.Card_verify = 1 and B.Purchase_Date >= '$SDate' and B.Purchase_Date <= '$EDate' group by A.Merchandise_ID");
    $revenue_merch_array = array();
    while($revenue_merch_row = mysqli_fetch_assoc($revenue_merch))
    {
        $revenue_merch_array[] = $revenue_merch_row;
    }
    //edit
    $_SESSION['SDate'] = $SDate;
    $_SESSION['EDate'] = $EDate;
    $_SESSION['arraysales'] = $revenue_array;
    $_SESSION['arraymerch'] = $revenue_merch_array;
?>

<script>
$(document).ready(function (){
    var revenue = [];
    var revenue = <?php echo json_encode($revenue_array); ?>;

    var revenue_merch = [];
    var revenue_merch = <?php echo json_encode($revenue_merch_array); ?>;
    // console.log(revenue);

    var name;
    var sub_total;
    var sub_revenue;
    var total_revenue=0;
    var organizer;
    var total=0;
    var summary = 0;
    var text = '<div class="print_content"><img src="../images/header_footer/logo.png">';
    text += '<h3>Sales Report</h3>';
    text += '<h4>Time: '+<?php echo json_encode(date_format(date_create($SDate),"d-m-Y"));?>+' - '+<?php echo json_encode(date_format(date_create($EDate),"d-m-Y"));?>+'</h4>';
    text += '<table class="table_container" style="background:white; padding: 5%; box-shadow: 0 0 5px 5px rgb(245, 245, 245);"><thead>';
    text += '<tr class="header"><td colspan="8">Concert</td></tr>';
    text += '<tr class="header-bar">';
    text += '<th width=45%>Concert Name</th>';
    text += '<th width=25%>Organizer</th>';
    text += '<th width=15%>Total (RM)</th>';
    text += '<th width=15%>Revenue (RM)</th>';
    text += '</tr></thead><tbody class="table_content">';
    for(var i in revenue)
    {
        name = revenue[i].Concert_Name;
        sub_total = parseFloat(revenue[i].Total);
        organizer = revenue[i].Organizer_Name;
        sub_revenue = sub_total*1.00 //revenue;
        total_revenue += sub_revenue;
        total += sub_revenue;
        text += '<tr>';
        text += '<td>'+name+'</td>';
        text += '<td>'+organizer+'</td>';
        text += '<td>'+sub_total.toFixed(2)+'</td>';
        text += '<td>'+sub_revenue.toFixed(2)+'</td>';
        text += '</tr>';
    }
    text += '<tr>';
    text += '<td colspan=2 class="total_dis">Total:</td>';
    text += '<td>'+total.toFixed(2)+'</td>';
    text += '<td class="total_revenue">RM '+total_revenue.toFixed(2)+'</td>';
    text+= '</tr>';
    text += '</tbody></table>';
    summary += total_revenue;

    var merch_name;
    var merch_id;
    var merch_sub_revenue;
    var merch_total_revenue=0;
    var merch_price;
    var merch_listprice;
    var merch_subtotal;
    var sold;
    total=0;
    text += '<table class="table_container" style="background:white; padding: 5%; box-shadow: 0 0 5px 5px rgb(245, 245, 245); margin-top: 30px"><thead>';
    text += '<tr class="header"><td colspan="8">Merchandise</td></tr>';
    text += '<tr class="header-bar">';
    text += '<th width=14%>Product ID</th>';
    text += '<th width=20%>Product Name</th>';
    text += '<th width=14%>Price</th>';
    text += '<th width=14%>List Price</th>';
    text += '<th width=10%>Sold</th>';
    text += '<th width=14%>Total</th>';
    text += '<th width=14%>Revenue (RM)</th>';
    text += '</tr></thead><tbody class="table_content">';
    for(var i in revenue_merch)
    {
        merch_id = "Prod "+revenue_merch[i].Merchandise_ID;
        merch_name = revenue_merch[i].Merchandise_Name;
        merch_price = revenue_merch[i].Merchandise_Price;
        merch_listprice = revenue_merch[i].Merchandise_ListPrice;
        sold = revenue_merch[i].Purchased;
        merch_subtotal = parseFloat(sold*merch_listprice);
        merch_sub_revenue = parseFloat(sold*(merch_listprice-merch_price)); //revenue;
        merch_total_revenue += merch_sub_revenue;
        total += merch_subtotal;
        text += '<tr>';
        text += '<td>'+merch_id+'</td>';
        text += '<td>'+merch_name+'</td>';
        text += '<td>'+merch_price+'</td>';
        text += '<td>'+merch_listprice+'</td>';
        text += '<td>'+sold+'</td>';
        text += '<td>'+merch_subtotal.toFixed(2)+'</td>';
        text += '<td>'+merch_sub_revenue.toFixed(2)+'</td>';
        text += '</tr>';
    }
    text += '<tr>';
    text += '<td colspan=5 class="total_dis">Total:</td>';
    text += '<td>'+total.toFixed(2)+'</td>';
    text += '<td class="total_revenue">RM '+merch_total_revenue.toFixed(2)+'</td>';
    text+= '</tr>';
    text += '</tbody></table>';
    summary += merch_total_revenue;
    text += '<h4>Total Revenue: RM '+summary.toFixed(2)+'</h4>';
    text += '<label>*This is a computer-generated document. No signature is required.</label>';
    text += '</div>';
    
    $('.print').append(text);
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
        <div class="print_btn"><a href="salesreport_pdf.php" target="_blank"><span class="material-icons">picture_as_pdf</span>Download</a></div>
    </div>
    
    <div class="print"></div>
</div>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>