<?php
    session_start();
    include "dataconnection.php";
    $ticket_id = $_SESSION['ticket']; 
    $s_ticket = array();

    if(!isset($_SESSION['email']))
    {
        header("location: login.php");
    }
    else
    {
        $email = $_SESSION['email'];
        if(!isset($_SESSION['s_ticket_id']))
        {
            header("Refresh:0");
            // $area_name = "";
            // $ticket_qty = 0;
            $s_ticket = "";
            echo "Not found";
        }
        else
        {
            // $area_name = $_SESSION['area_name'];
            // $ticket_qty = $_SESSION['ticket_qty'];
            $s_ticket = $_SESSION['s_ticket_id'];
        }

        //get s_ticket details
        $s_ticket_count = count($s_ticket);
        $total_price = 0;
        $area_id = array();
        $area_price = array();
        $area_name = array();
        $ticket_qty = array();

        for($i=0; $i<$s_ticket_count; $i++)
        {
            $s_ticket_query = "SELECT * FROM s_ticket WHERE S_Ticket_ID = $s_ticket[$i]";
            $s_ticket_run = mysqli_query($connect, $s_ticket_query);
            $s_ticket_result = mysqli_fetch_assoc($s_ticket_run);
            $area_id[$i] = $s_ticket_result['PriceID'];
            $ticket_qty[$i] = $s_ticket_result['S_Ticket_Qty'];

            $area_query = "SELECT * FROM ticket_price WHERE Price_ID = $area_id[$i]";
            $area_query_run = mysqli_query($connect, $area_query);
            $area_query_result = mysqli_fetch_assoc($area_query_run);
            $area_name[$i] = $area_query_result['Price_Area'];
            $area_price[$i] = $area_query_result['Price'];
            $total_price += ($area_price[$i] * $ticket_qty[$i]); 
        }
        $_SESSION['total'] = $total_price;

        //get user selected ticket details
        $ticket_query = "SELECT * FROM concert, venue, customer
        WHERE concert.Concert_ID = $ticket_id
        AND venue.Venue_ID = concert.Venue_ID
        AND customer.Cust_Email = '$email'";
        $ticket_search = mysqli_query($connect, $ticket_query);
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
    <link rel="stylesheet" href="checkout3.css">
	<link rel="stylesheet" href="tnc_privacy.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<?php include "header.php"; ?>
	<div class="button">
		<a href="index.php">Home</a>
		<a href="aboutus.php">About Us</a>
		<a href="concert.php">Concert</a>
		<a href="merchandise.php">Merchandise</a>
		<a href="singer.php">Singer</a>
	</div>
  </div>
</div>

<div class="checkout-container">
    <?php 
    while($result=mysqli_fetch_assoc($ticket_search))
    {
        //user selected concert
        echo "<img src='" . str_replace("../", "", $result['Concert_Hor_Image']) . "'>";
        echo "<div class='concert-details' style='overflow: auto;'>";
            echo "<table>";
            echo "<tr>";
                echo "<th colspan='2' style='font-size: 18pt;'>" . $result['Concert_Name'] . "</th>";
            echo "</tr>";

            echo "<tr>";
                echo "<td><i class='material-icons'>event</i>" . date_format(date_create($result['Concert_StartDate']), "d M Y, H:i") . " GMT+8</td>";
                echo "<td><i class='material-icons'>location_on</i>" . $result['Venue_Name'] . "</td>";
            echo "</tr>";

            echo "<tr>";
                echo "<th>Selected Seat Area</th>"; 
                echo "<td>";
                for($j=0; $j<$s_ticket_count; $j++)
                {
                    echo $area_name[$j];
                    if($j != ($s_ticket_count-1))
                    {
                        echo ", ";
                    }
                }
                echo "</td>";
            echo "</tr>";

            echo "<tr>";
                echo "<th>Quantity</th>"; 
                echo "<td>";
                for($j=0; $j<$s_ticket_count; $j++)
                {
                    echo $ticket_qty[$j];
                    if($j != ($s_ticket_count-1))
                    {
                        echo ", ";
                    }
                }
                echo "</td>";
            echo "</tr>";
            
            echo "<tr>";
                echo "<th>Price per ticket</th>"; 
                echo "<td>";
                for($j=0; $j<$s_ticket_count; $j++)
                {
                    echo "RM " . number_format($area_price[$j], 2);
                    if($j != ($s_ticket_count-1))
                    {
                        echo ", ";
                    }
                }
                echo "</td>";
            echo "</tr>";

            echo "<tr>";
                echo "<th>Total</th>"; 
                echo "<td>RM " . number_format($total_price, 2) . "</td>";
            echo "</tr>";
            echo "</table>";
        echo "</div>";

        //payment info
        echo "<form method='post' class='payment_form' action=''>";

            echo "<h1 style='grid-column: 1/7;'><i class='material-icons' style='font-size: 26pt;'>credit_card</i>Payment Information</h1>";
            echo "<div class='half-left'>";
                echo "<label for='cust_name'>Customer Name</label>";
                echo "<input type='text' name='cust_name' placeholder='" . $result['Cust_Lname'] . " " . $result['Cust_Fname'] . "' disabled></input>";
            echo "</div>";

            echo "<div class='half-right'>";
                echo "<label for='cust_email'>Customer Email Address</label>";
                echo "<input type='text' name='cust_email' placeholder=" . $result['Cust_Email'] . " disabled></input>";
            echo "</div>";
        ?>
            <div class='half-left'> 
                <label for='holder_name'><span style='color:red;'>*</span>Card Holder Name</label> 
                <input type='text' name='card_holder_name' id='card_holder_name' class='card_holder_name' placeholder='Full Name'></input> 
            </div> 

            <div class='exp_date'> 
                <label for='exp_date'><span style='color:red;'>*</span>Exp Date</label> 
                <div class="card_exp">
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
            <div style='grid-column: 2/3; margin-top: 20px;'><input type='button' value='GO BACK' onclick='history.back()'></input></div> 

        </form> 
        <?php
    }    
    ?>
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
        var a, b, c, d, e;
        // console.log(current_month + " " + current_year + " " + month + " " + year);
        
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
        else if(year <= current_year)
        {
            if(month <= (current_month+1))
            {
                b = 2;
            }
            else
            {
                b = 0;
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
        if(a==0 && b==0 && c==0 && d==0 && e==0)
        {
            //$('form').submit();
            //console.log(form_data);
            $.ajax({
                type: "POST",
                url: "payment.php",
                dataType: 'json',
                data: {
                    "form_submitbtn": 1,
                    "card_holder_name": holder_name,
                    "exp_month": month,
                    "exp_year": year,
                    "card_num": card_number,
                    "cvv": cvv_number,
                },
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
                    var otp = respone[0];
                    var purchaseid = respone[1];
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
                                        "otp_btn": 1,
                                        "otp_num": value,
                                    },
                                    success:function(respone)
                                    {
                                        console.log(respone);
                                        Swal.fire({
                                            title:'Thank you!', 
                                            text:'Purchase made successfully!', 
                                            icon:'success',
                                            didClose: () => window.open("payment_out.php?id="+purchaseid, "_self")});
                                    },
                                    error:function()
                                    {
                                        console.log(3);
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
                            //will perform ajax to check otp
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
                error: function()
                {
                    Swal.fire({
                    title:'Oops...', 
                    text:'Please try again later', 
                    icon:'error',
                    didClose: () => window.scrollTo(0,0)});
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