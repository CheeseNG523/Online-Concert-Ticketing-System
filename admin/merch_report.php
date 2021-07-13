<?php
    include 'dataconnection.php';
    include 'header_sidebar.php';
    
    $revenue = mysqli_query($connect,"select A.Merchandise_ID, A.Merchandise_Name, A.Merchandise_Price, A.Merchandise_ListPrice, sum(C.S_Merchandise_Qty)as'Purchased' 
    from merchandise A, purchase B, s_merchandise C where 
    A.Merchandise_ID = C.Merchandise_ID and C.Purchase_ID = B.Purchase_ID and B.Card_verify = 1 group by A.Merchandise_ID");
    $revenue_array = array();
    while($revenue_row = mysqli_fetch_assoc($revenue))
    {
        $revenue_array[] = $revenue_row;
    }
    $_SESSION['arraymerch'] = $revenue_array;
?>

<script>
$(document).ready(function (){
    var revenue = [];
    var revenue = <?php echo json_encode($revenue_array); ?>;
    // console.log(revenue);

    var merch_name;
    var merch_id;
    var merch_sub_revenue;
    var merch_total_revenue=0;
    var merch_price;
    var merch_listprice;
    var merch_subtotal;
    var sold;
    var total=0;
    var summary = 0;
    var text = '<div class="print_content"><img src="../images/header_footer/logo.png">';
    text += '<h3>Sales Report</h3>';
    text += '<table class="table_container" style="background:white; padding: 5%; box-shadow: 0 0 5px 5px rgb(245, 245, 245);"><thead>';
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
    for(var i in revenue)
    {
        merch_id = "Prod "+revenue[i].Merchandise_ID;
        merch_name = revenue[i].Merchandise_Name;
        merch_price = revenue[i].Merchandise_Price;
        merch_listprice = revenue[i].Merchandise_ListPrice;
        sold = revenue[i].Purchased;
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
        <div class="print_btn"><a href="merch_report_pdf.php" target="_blank"><span class="material-icons">picture_as_pdf</span>Download</a></div>
    </div>
    
    <div class="print"></div>
</div>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>