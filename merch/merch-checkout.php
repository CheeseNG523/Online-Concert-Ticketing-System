<?php
    session_start();
    include "dataconnection.php";

    if(!isset($_SESSION['email']))
    {
        header("location: login.php");
    }
    else
    {
        $email = $_SESSION['email'];
        $total = array();
        $count = 0;
        for($i=0; $i<count($_POST['item_id']); $i++)
        {
            $array_count = 0;
            if(isset($_POST["item_id"][$i]))
            {
                $array = array();
                $id = $_POST["item_id"][$i];
                $query = mysqli_query($connect,"select * from merchandise A, s_merchandise B, customer C where C.Cust_ID = B.Cust_ID and A.Merchandise_ID = B.Merchandise_ID and S_Merchandise_ID = '$id' and Purchase_ID is null and Cust_Email = '$email'");
                $run = mysqli_fetch_assoc($query);
                if(mysqli_num_rows($query)>0)
                    $count++;
                $array = $run;
            }
            $total[] =  $array;
        }
        if($count==0)
            header("location: index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="head-foot3.css">
    <link rel="stylesheet" href="checkout4.css">
	<link rel="stylesheet" href="tnc_privacy.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
table{
background-color: transparent;
border-collapse: collapse;
border: 1px solid #f2f2f2;
margin-bottom: 50px;
font-family: 'Quicksand', sans-serif;
}


table thead .table-title{
	border: 1px solid #f2f2f2;
	border-top: 0;
}

table thead .table-title th{
	padding: 5px;
}

table thead td{
	font-size: 20px;
	padding: 10px;
    border: 1px solid #f2f2f2;
    text-align: left;
}

table tbody .item-image{
	height: auto;
    vertical-align: middle;
	width: 25%;
	margin: 10px 0;
	margin-right: 15px;
}

table tbody tr td{
	border-bottom: 1px solid #f2f2f2;
	font-weight: 600;
}

table tbody td{
	text-align: center;
}

table tbody .merch-row{
	text-align: left;
}

.address-btn{
    float:right;
}

.address-btn button.active{
    background: transparent;
    color: #ccc;
}

.address-btn button{
    outline: none;
    border: 1px solid #4CAF50;
    background: #4CAF52;
    cursor: pointer;
    vertical-align: super;
    padding: 10px;
    font-weight: 600;
    color: white;
}

.state:read-only,
input:read-only,
input[type='text']:read-only:hover:enabled,
.state:read-only:hover:enabled{
    background: #f3f3fa;
    border: 2px solid rgba(133, 193, 233, 1);
}
    </style>
</head>
<?php include "header.php"; ?>
	<div class="button">
		<a href="index.php">Home</a>
		<a href="aboutus.php">About Us</a>
		<a href="concert.php">Concert</a>
		<a href="merchandise.php" >Merchandise</a>
		<a href="singer.php">Singer</a>
	</div>
  </div>
</div>

<div class="checkout-container">
    <?php
        $total_weight = 0;
        $sub_total=0;
        $pay =0;
        $shipping =0;
        echo "<form method='post' class='payment_form' action='merch_payment_out.php'>";
        echo '<table width=100%>';
        echo '<thead><tr>';
        echo '<td colspan=5>Items Ordered</td></tr>';
        echo '<tr class="table-title">';
        echo '<th width=25%>Product</td>';
        echo '<th width=25%>Price</th>';
        echo '<th width=25%>Quantity</th>';
        echo '<th width=25%>Subtotal</th>';
        echo '</tr>';
        echo '</thead><tbody>';
        for($i=0; $i<count($total);$i++)
        {
            echo '<tr>';
            echo '<td class="merch-row">';
            echo '<input class="merch-value" name="item_id[]" type="text" value="'.$total[$i]['S_Merchandise_ID'].'" hidden>';
            echo '<input class="weight-value" type="number" value='.$total[$i]['Merchandise_Weight'].' hidden>';
            echo '<img class="item-image" src="'.str_replace("../", "",$total[$i]['Merchandise_Image']).'">'.$total[$i]['Merchandise_Name'];
            echo '</td>';
            echo '<td class="price-row"><input class="list_price" type="number" value="'.$total[$i]['Merchandise_ListPrice'].'" hidden>RM '.$total[$i]["Merchandise_ListPrice"].'</span></td>';
            echo '<td>';
            echo $total[$i]["S_Merchandise_Qty"];
            echo '<input class="qty" style="margin: 0 auto; border:none;" type="number" hidden value="'.$total[$i]['S_Merchandise_Qty'].'">';
            echo '</td>';
            echo '<td class="subprice-row">RM <span class="dis_sub">'.number_format($total[$i]['S_Merchandise_Qty']*$total[$i]['Merchandise_ListPrice'],2,'.','').'</span>';
            echo '<input class="sub_total" type="number" value="'.$total[$i]['S_Merchandise_Qty']*$total[$i]['Merchandise_ListPrice'].'" hidden>';
            echo '</td>';
            echo '</tr>';
            $total_weight += $total[$i]['Merchandise_Weight']*$total[$i]['S_Merchandise_Qty'];
            $sub_total += number_format($total[$i]['S_Merchandise_Qty']*$total[$i]['Merchandise_ListPrice'],2,'.','');
        }
        $shipping += 4.00;
        if($total_weight>3)
            $shipping += ($total_weight - 3)*2.00;

        $pay = $sub_total + $shipping;
        echo '<tr>';
        echo '<td colspan=3 style="border:none; text-align:right">Shipping:</td>';
        echo '<td style="border:none;">RM '.number_format($shipping,2,'.','').'</td>';
        echo '</tr><tr>';
        echo '<td colspan=3 style=" text-align:right">Total:</td><input type="text" name="total_price" value="'.$pay.'" hidden>';
        echo '<td style="font-weight:700; text-decoration:underline">RM '.number_format($pay,2,'.','').'</td>';
        echo '</tbody></table>';

        //address info
        echo '<div class="input-form">';
        $query2 = mysqli_query($connect,"select * from customer where Cust_Email = '$email '");
        $result = mysqli_fetch_assoc($query2);
        $cust_info = array();
        $cust_info = $result;
            echo "<h1 style='grid-column: 1/7;'><i class='material-icons' style='font-size: 26pt;'>location_on</i>Delivery Address";
            echo "<div class='address-btn'>";
            if($result['Cust_Address']==null||$result['Cust_Address']=="")
            {
                echo "</div>";
                echo "</h1>";
                echo "<div class='half-left' style='width: 166%'>";
                echo "<label for='full-address'>Full Address</label>";
                echo "<input type='text' name='full-address' placeholder='" . $result['Cust_Address']. "'></input>";
                echo "</div>";
                echo "<div class='half-left' style='grid-column: 1/3;'>";
                    echo "<label for='state'>State</label>";
                    echo "<select name='state' class='state' style='background:white'>";
                    echo '<option value="" hidden selected></option>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Labuan">Labuan</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Penang">Penang</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>';
                    echo "</select>";
                echo "</div>";
                echo "<div class='half-right' style='grid-column: 3/6;'>";
                    echo "<label for='city'>City</label>";
                    echo "<input type='text' name='city' placeholder='" . $result['Cust_City']. "'></input>";
                echo "</div>";
                echo "<div class='half-right' style='grid-column: 1/3;'>";
                    echo "<label for='postcode'>Postcode</label>";
                    echo "<input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength='5' name='postcode' placeholder='" . $result['Cust_Postcode'] . "'></input>";
                echo "</div>";
            }
            else
            {
                echo "<button style='border-right: 0;' class='defaultbtn'>Default</button>";
                echo "<button class='changebtn active'>Change</button>";
                echo "</div>";
                echo "</h1>";
                echo "<div class='half-left' style='width: 166%'>";
                echo "<label for='full-address'>Full Address</label>";
                echo "<input type='text' class='full-address' name='full-address' value='" . $result['Cust_Address']. "' readonly='readonly'></input>";
                echo "</div>";
                echo "<div class='half-left' style='grid-column: 1/3;'>";
                echo "<label for='state'>State</label>";
                    echo "<select name='state' class='state' readonly='readonly'>";
                    $state = $result['Cust_State'];
                    echo '<option value="Johor"';
                    if($state == 'Johor')
                        echo 'selected';
                    echo '>Johor</option>';
                    echo '<option value="Kedah"';
                    if($state == 'Kedah')
                    echo 'selected';
                    echo '>Kedah</option>';
                    echo '<option value="Kelantan"';
                    if($state == 'Kelantan')
                    echo 'selected';
                    echo '>Kelantan</option>';
                    echo '<option value="Kuala Lumpur"';
                    if($state == 'Kuala Lumpur')
                    echo 'selected';
                    echo '>Kuala Lumpur</option>';
                    echo '<option value="Labuan"';
                    if($state == 'Labuan')
                    echo 'selected';
                    echo '>Labuan</option>';
                    echo '<option value="Melaka"';
                    if($state == 'Melaka')
                    echo 'selected';
                    echo '>Melaka</option>';
                    echo '<option value="Negeri Sembilan"';
                    if($state == 'Sembilan')
                    echo 'selected';
                    echo '>Negeri Sembilan</option>';
                    echo '<option value="Pahang"';
                    if($state == 'Pahang')
                    echo 'selected';
                    echo '>Pahang</option>';
                    echo '<option value="Perak"';
                    if($state == 'Perak')
                    echo 'selected';
                    echo '>Perak</option>';
                    echo '<option value="Perlis"';
                    if($state == 'Perlis')
                    echo 'selected';
                    echo '>Perlis</option>';
                    echo '<option value="Penang"';
                    if($state == 'Penang')
                    echo 'selected';
                    echo '>Penang</option>';
                    echo '<option value="Sabah"';
                    if($state == 'Sabah')
                    echo 'selected';
                    echo '>Sabah</option>';
                    echo '<option value="Sarawak"';
                    if($state == 'Sarawak')
                    echo 'selected';
                    echo '>Sarawak</option>';
                    echo '<option value="Selangor"';
                    if($state == 'Selangor')
                    echo 'selected';
                    echo '>Selangor</option>';
                    echo '<option value="Terengganu"';
                    if($state == 'Terengganu')
                    echo 'selected';
                    echo '>Terengganu</option>';
                    echo "</select>";
                echo "</div>";
                echo "<div class='half-right' style='grid-column: 3/6;'>";
                    echo "<label for='City'>City</label>";
                    echo "<input type='text' class='city' name='city' value='" . $result['Cust_City']. "' readonly='readonly'></input>";
                echo "</div>";
                echo "<div class='half-right' style='grid-column: 1/3;'>";
                    echo "<label for='postcode'>Postcode</label>";
                    echo "<input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength='5' class='postcode' name='postcode' value='" . $result['Cust_Postcode'] . "' readonly='readonly'></input>";
                echo "</div>";
            }

            //payment info
            echo "<h1 style='grid-column: 1/7;'><i class='material-icons' style='font-size: 26pt;'>credit_card</i>Payment Information</h1>";
            echo "<div class='half-left'>";
                echo "<label for='cust_name'>Customer Name</label>";
                echo "<input type='text' name='cust_name' placeholder='" . $result['Cust_Lname'] . " " . $result['Cust_Fname'] . "' disabled></input>";
            echo "</div>";

            echo "<div class='half-right'>";
                echo "<label for='cust_email'>Customer Email Address</label>";
                echo "<input type='text' name='cust_email' value='".$result['Cust_Email']."' placeholder=" . $result['Cust_Email'] . " disabled></input>";
            echo "</div>";
        ?>
            <div class='half-left'> 
                <label for='holder_name'><span style='color:red;'>*</span>Card Holder Name</label> 
                <input type='text' name='card_holder_name' id='card_holder_name' class='card_holder_name' placeholder='Full Name'></input> 
            </div> 

            <div class='exp_date'> 
                <label for='exp_date'><span style='color:red;'>*</span>Exp Date</label> 
                <select name='exp_month' class='exp_month' id='exp_month'> 
                    <option value='0' disabled selected='selected'>MM</option> 
                    <option value='1'>01</option> 
                    <option value='2'>02</option> 
                    <option value='3'>03</option> 
                    <option value='4'>04</option> 
                    <option value='5'>05</option> 
                    <option value='6'>06</option> 
                    <option value='7'>07</option> 
                    <option value='8'>08</option> 
                    <option value='9'>09</option> 
                    <option value='10'>10</option> 
                    <option value='11'>11</option> 
                    <option value='12'>12</option> 
                </select> 
                <span> / </span>  
                <select name='exp_year' class='exp_year' id='exp_year'> 
                    <option value='0' disabled selected='selected'>YYYY</option> 
                    <option value='2021'>2021</option> 
                    <option value='2022'>2022</option> 
                    <option value='2023'>2023</option> 
                    <option value='2024'>2024</option> 
                    <option value='2025'>2025</option> 
                    <option value='2026'>2026</option> 
                    <option value='2027'>2027</option> 
                    <option value='2028'>2028</option> 
                    <option value='2029'>2029</option> 
                    <option value='2030'>2030</option> 
                </select> 
            </div> 

            <div class='half-left' style='grid-column: 1/3;'> 
                <label for='card_num'><span style='color:red;'>*</span>Credit Card No.</label> 
                <input type='text' id='card_num' class='card_num' name='card_num' placeholder='0000 0000 0000 0000'></input> 
            </div> 

            <div class="card_type" style='padding: 0;'>
                <img id='mastercard' src='images/header_footer/mastercard.png' style='width: 70px; height: 40px; margin-top: 30px; border-radius: 8px;'>
                <img id='visa' src='images/header_footer/visa.jpg' style='width: 70px; height: 40px; margin-top: 30px; margin-left: 10px; border-radius: 8px;'>
            </div>
            
            <div> 
                <label for='cvv'><span style='color:red;'>*</span>CVC/CVV</label> 
                <input type='text' name='cvv' id='cvv' class='cvv' placeholder='999' maxlength='3'></input> 
            </div> 

            <div style='grid-column: 1/2; margin-top: 20px;'><input type='submit' value='PROCEED' name='submitbtn' class='pay_out'></input></div> 
            <div style='grid-column: 2/3; margin-top: 20px;'><input style='border:none; outline:none' type='button' value='GO BACK' onclick='history.back()'></input></div> 
        </div>
        </form>
</div>

<script>
window.onload = function() 
{
    document.getElementById('card_num').oninput = function() 
    {
        //only allow user to enter number characters for card number
        this.value = this.value.replace(/[^0-9]/g, '');
        this.value = cc_format(this.value);

        //get first integer for card validation
        var first_num = String(this.value).charAt(0);
        if(first_num == 5)
        {
            document.getElementById('mastercard').style.opacity = 1;
            document.getElementById('visa').style.opacity = 0.4;
        }
        else if(first_num == 4)
        {
            document.getElementById('visa').style.opacity = 1;
            document.getElementById('mastercard').style.opacity = 0.4;
        }
        else
        {
            document.getElementById('visa').style.opacity = 0.4;
            document.getElementById('mastercard').style.opacity = 0.4;
        }
    }

    document.getElementById('cvv').oninput = function() 
    {
        //only allow user to enter number characters for card cvv/cvc
        this.value = this.value.replace(/[^0-9]/g, '');
    }
}

function cc_format(value) 
{
    //search for digit string length 4 to 16
    var matches = value.match(/\d{4,16}/g);
    var match = matches && matches[0] || '';
    var parts = [];
    
    for(i=0, len=match.length; i<len; i+=4) 
    {
        parts.push(match.substring(i, i+4));
    }
    
    if(parts.length) 
    {
        return parts.join(' ');
    } 
    else 
    {
        return value;
    }
}

$(document).ready(function(){
    var address = "<?php echo $result['Cust_Address'];?>";
    var custAddressNULL = 0;
    if(address == "" ||address == null)
    {
        custAddressNULL = 1;
        $(".state").css("pointer-events","");
    }
    else
    {
        custAddressNULL = 0;
        $(".state").css("pointer-events","none");
    }
    console.log(custAddressNULL);
    custInfo = <?php echo json_encode($cust_info);?>;
    $('.defaultbtn').on('click',function(e){
        e.preventDefault();
        $('.defaultbtn').removeClass("active");
        $('.changebtn').addClass('active');
        $('.full-address').prop('readonly','readonly');
        $('.state').prop('readonly','readonly');
        $('.city').prop('readonly','readonly');
        $('.postcode').prop('readonly','readonly');
        $('.postcode').val(custInfo.Cust_Postcode);
        $('.city').val(custInfo.Cust_City);
        $('.full-address').val(custInfo.Cust_Address);
        $('.state').val(custInfo.Cust_State);
        $('.state').css('background','#f3f3fa');
        $(".state").css("pointer-events","none");
    });

    $('.changebtn').on('click',function(e){
        e.preventDefault();
        $('.defaultbtn').addClass("active");
        $('.changebtn').removeClass('active');
        $('.full-address').prop('readonly','');
        $('.state').prop('readonly','');
        $('.state').css('background','white');
        $('.city').prop('readonly','');
        $('.postcode').prop('readonly','');
        $(".state").css("pointer-events","");
    });

    //for error message
    /*$("#card_holder_name").keyup(function(){
        var card_validation = $('#card_holder_name').val();
        if(card_validation===''||card_validation===null)
            card_name_error = 1;
        else
            card_name_error = 1;
    });*/

    $('.pay_out').on('click',function(event){
        //disable submit function by default
        event.preventDefault();

        //payment details
        var holder_name = $('#card_holder_name').val();
        var month = $('#exp_month').val();
        var year = $('#exp_year').val();
        var card_number = $('#card_num').val();
        var first_card_num = String(card_number).charAt(0);
        var cvv_number = $('#cvv').val();
        var current_date = new Date();
        var current_month = current_date.getMonth();
        var current_year = current_date.getFullYear();
        var a, b, c, d, e, f;

        //address validation
        if($('.full-address').val()==""||$('.state').val()==""||$('.city').val()==""||$('.postcode').val()=="")
        {
            f = 1;
        }
        else
            f = 0;


        //payment details validation
        if(holder_name === "" || holder_name == null)
        {
            a = 1;
        }
        else
        {
            a = 0;
        }
        
        if(month == 0 || month == null)
        {
            b = 1;
        }
        else if(year == current_year)
        {
            if(month == current_month)
            {
                b = 2;
            }
        }
        else
        {
            b = 0;
        }

        if(year == 0 || year == null)
        {
            c = 1;
        }
        else
        {
            c = 0;
        }

        if(card_number === "" || card_number == null)
        {
            d = 2;
        }
        else if(card_number.length != 19)
        {
            d = 1;
        }
        else if(first_card_num != 4 && first_card_num != 5)
        {
            d = 3;
        }
        else
        {
            d = 0;
        }

        if(cvv_number === "" || cvv_number == null)
        {
            e = 2;
        }
        else if(cvv_number.length != 3)
        {
            e = 1;
        }
        else
        {
            e = 0;
        }
            
        //if everything correct, perform submit
        if(a==0 && b==0 && c==0 && d==0 && e==0 && f==0)
        {
            //$('form').submit();
            
            var formdata = $('.payment_form').serializeArray();
            formdata.push({name:"checkoutbtn",value:1});
            $.ajax({
                url:"ajax_form.php",
                type:'POST',
                data: formdata,
                success: function(respone){
                    // console.log(respone);
                    if(respone!=1)
                    {
                        Swal.fire({
                            icon: 'error',
                            title: 'The stock has been updated',
                            showConfirmButton: false,
                            timer: 2000,
                            didClose: () => window.open('cart.php','_self')
                        });
                    }
                    else
                    {
                        if(custAddressNULL == 1)
                        {
                            Swal.fire({
                            title: 'Save this address?',
                            text: 'Save as default address',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            reverseButtons: true
                            }).then((result) => {
                            if (result.isConfirmed) {
                                var form_data = $('.payment_form').serializeArray();
                                form_data.push({name:'savedefault',value:1});
                                $.ajax({
                                    type: "POST",
                                    url: "otp-check.php",
                                    data: form_data,
                                    success: function(respone)
                                    {
                                        console.log(respone);
                                    },
                                    error: function(respone)
                                    {
                                        console.log(respone);
                                        Swal.fire({
                                        title:'Sorry...', 
                                        text:'Please try again later.', 
                                        icon:'error',
                                        didClose: () => location.reload()});
                                    }
                                });
                            }
                                var subForm = $('.payment_form').serializeArray();
                                subForm.push({name:'merch_form_submitbtn',value:1});
                                $.ajax({
                                    type: "POST",
                                    url: "payment.php",
                                    dataType: 'json',
                                    data: subForm,
                                    beforeSend: function()
                                    {
                                        Swal.fire({
                                            title:'Please wait...', 
                                            text:'Sending an email.', 
                                            allowOutsideClick: false,
                                            didOpen: () => {
                                                Swal.showLoading()
                                            }
                                        });
                                    },
                                    success: function(respone)
                                    {
                                        console.log(respone);
                                        var otp = respone[0];
                                        var payment_id = respone[2];
                                        Swal.fire({
                                            title: 'Please enter your OTP',
                                            input: 'text',
                                            allowOutsideClick: false,
                                            confirmButtonText: 'Proceed',
                                            showCancelButton: true,
                                            inputAttributes: {
                                                maxlength: 6
                                            },
                                            customClass: {
                                                validationMessage: 'my-validation-message'
                                            },
                                            preConfirm: (value) => {
                                                //if no value entered
                                                if(!value) 
                                                {
                                                    Swal.showValidationMessage('Please enter something');
                                                }
                                                else if(value.length<6)
                                                {
                                                    Swal.showValidationMessage('Invalid OTP. E.g.:999999');
                                                }
                                                else if(otp != value)
                                                {
                                                    Swal.showValidationMessage('OTP incorrect');
                                                }
                                                else
                                                {
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "otp-check.php",
                                                        dataType: 'json',
                                                        data:{
                                                            "otp_btn_merch": 1,
                                                            "otp_num": value,
                                                        },
                                                        success:function(respone)
                                                        {
                                                            //console.log(1);
                                                            Swal.fire({
                                                                title:'Thank you!', 
                                                                text:'Purchase made successfully!', 
                                                                icon:'success',
                                                                didClose: () => window.open('merch_payment_out.php?view&id='+payment_id,'_self')});
                                                        },
                                                        error:function(respone)
                                                        {
                                                            console.log(respone);
                                                            Swal.fire({
                                                                title:'Sorry...', 
                                                                text:'Please try again later.', 
                                                                icon:'error',
                                                                didClose: () => location.reload()});
                                                        }
                                                    });
                                                }
                                            }
                                        }).then((result) => {
                                            if(result.isConfirmed) 
                                            {
                                                //will perform ajax to check itp
                                            } 
                                            //if cancel button is clicked
                                            else if(result.dismiss === Swal.DismissReason.cancel) 
                                            {
                                                Swal.fire({
                                                title: 'Purchase cancelled!',
                                                icon: 'warning',
                                                allowOutsideClick: false,
                                                didClose: () => window.open("index.php", "_self")
                                                })
                                            }
                                        });
                                    },
                                    error: function(respone)
                                    {
                                        console.log(respone);
                                        Swal.fire({
                                        title:'Oops...', 
                                        text:'Please try again later', 
                                        icon:'error',
                                        didClose: () => window.scrollTo(0,0)});
                                    }
                                });
                            });
                        }
                        else
                        {
                            var subForm = $('.payment_form').serializeArray();
                            subForm.push({name:'merch_form_submitbtn',value:1});
                            $.ajax({
                                type: "POST",
                                url: "payment.php",
                                dataType: 'json',
                                data: subForm,
                                beforeSend: function()
                                {
                                    Swal.fire({
                                        title:'Please wait...', 
                                        text:'Sending an email.', 
                                        allowOutsideClick: false,
                                        didOpen: () => {
                                            Swal.showLoading()
                                        }
                                    });
                                },
                                success: function(respone)
                                {
                                    console.log(respone);
                                    var otp = respone[0];
                                    var purchase_id = respone[2];
                                    Swal.fire({
                                        title: 'Please enter your OTP',
                                        input: 'text',
                                        allowOutsideClick: false,
                                        confirmButtonText: 'Proceed',
                                        showCancelButton: true,
                                        inputAttributes: {
                                            maxlength: 6
                                        },
                                        customClass: {
                                            validationMessage: 'my-validation-message'
                                        },
                                        preConfirm: (value) => {
                                            //if no value entered
                                            if(!value) 
                                            {
                                                Swal.showValidationMessage('Please enter something');
                                            }
                                            else if(value.length<6)
                                            {
                                                Swal.showValidationMessage('Invalid OTP. E.g.:999999');
                                            }
                                            else if(otp != value)
                                            {
                                                Swal.showValidationMessage('OTP incorrect');
                                            }
                                            else
                                            {
                                                $.ajax({
                                                    type: "POST",
                                                    url: "otp-check.php",
                                                    dataType: 'json',
                                                    data:{
                                                        "otp_btn_merch": 1,
                                                        "otp_num": value,
                                                    },
                                                    success:function(respone)
                                                    {
                                                        //console.log(1);
                                                        Swal.fire({
                                                            title:'Thank you!', 
                                                            text:'Purchase made successfully!', 
                                                            icon:'success',
                                                            didClose: () => window.open('merch_payment_out.php?view&id='+purchase_id,'_self')});
                                                    },
                                                    error:function(respone)
                                                    {
                                                        console.log(respone);
                                                        Swal.fire({
                                                            title:'Sorry...', 
                                                            text:'Please try again later.', 
                                                            icon:'error',
                                                            didClose: () => location.reload()});
                                                    }
                                                });
                                            }
                                        }
                                    }).then((result) => {
                                        if(result.isConfirmed) 
                                        {
                                            //will perform ajax to check itp
                                        } 
                                        //if cancel button is clicked
                                        else if(result.dismiss === Swal.DismissReason.cancel) 
                                        {
                                            Swal.fire({
                                            title: 'Purchase cancelled!',
                                            icon: 'warning',
                                            allowOutsideClick: false,
                                            didClose: () => window.open("index.php", "_self")
                                            })
                                        }
                                    });
                                },
                                error: function(respone)
                                {
                                    console.log(respone);
                                    Swal.fire({
                                    title:'Oops...', 
                                    text:'Please try again later', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                                }
                            });
                        }
                    }
                },
                    error: function(respone){
                        console.log(respone);
                    }
            });
        }

        //if field is not all filled in
        else if(a==1 || b==1 || c==1 || d==2 || e==2)
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all the required field'
            })
        }

        //if card and cvv is not valid (length)
        else if(d==1 || e==1)
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please ensure all the data entered are valid'
            })
        }

        //if card exp month is exceed
        else if(b==2)
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Your card is expired'
            })
        }

        //if card is neither mastercard nor visa
        else if(d==3)
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please ensure your card exist'
            })
        }
    });
});
</script>

<?php include "footer.php"; ?>