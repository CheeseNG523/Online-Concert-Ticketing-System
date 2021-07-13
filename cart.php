<?php
    session_start();
	include "dataconnection.php";

    if(!isset($_SESSION['email']))
    {
        header("location: login.php");
    }
    else
    {
		if(isset($_GET['merchid']))
			$selected_id = $_GET['merchid'];

        $email = $_SESSION['email'];

		$cart_query = "select A.S_Merchandise_ID, C.Merchandise_ID, C.Merchandise_Image, C.Merchandise_Name, C.Merchandise_ListPrice, C.Merchandise_Description, C.Merchandise_Stock, 
		C.Merchandise_Weight, C.Merchandise_Status, A.S_Merchandise_Qty, A.Purchase_ID from s_merchandise A, customer B, merchandise C where A.Cust_ID = B.Cust_ID and 
		C.Merchandise_ID = A.Merchandise_ID and B.Cust_Email = '$email' and A.Purchase_ID is NULL order by S_Merchandise_ID asc";
		$cart_search = mysqli_query($connect, $cart_query);

		while($row_update = mysqli_fetch_assoc($cart_search))
		{
			if($row_update['Merchandise_Stock']>0)
			{
				if($row_update['S_Merchandise_Qty']>$row_update['Merchandise_Stock'])
				{
					$cart_id = $row_update['S_Merchandise_ID'];
					$max_stock = $row_update['Merchandise_Stock'];
					$update = mysqli_query($connect,"update s_merchandise set S_Merchandise_Qty='$max_stock' where S_Merchandise_ID = '$cart_id'");
				}
				else if($row_update['S_Merchandise_Qty']>10)
				{
					$cart_id = $row_update['S_Merchandise_ID'];
					$update = mysqli_query($connect,"update s_merchandise set S_Merchandise_Qty=10 where S_Merchandise_ID = '$cart_id'");
				}
			}
		}

		$cart_query_upd = "select A.S_Merchandise_ID, C.Merchandise_ID, C.Merchandise_Image, C.Merchandise_Name, C.Merchandise_ListPrice, C.Merchandise_Description, C.Merchandise_Stock, 
		C.Merchandise_Weight, C.Merchandise_Status, A.S_Merchandise_Qty, A.Purchase_ID from s_merchandise A, customer B, merchandise C where A.Cust_ID = B.Cust_ID and 
		C.Merchandise_ID = A.Merchandise_ID and B.Cust_Email = '$email' and A.Purchase_ID is NULL and C.Merchandise_Stock > 0 and C.Merchandise_Status = 1 and C.Merchandise_unable = 0 order by S_Merchandise_ID asc";
		$cart_search_upd = mysqli_query($connect, $cart_query_upd);

		$cart_query_dis = "select A.S_Merchandise_ID, C.Merchandise_ID, C.Merchandise_Image, C.Merchandise_Name, C.Merchandise_ListPrice, C.Merchandise_Description, 
		C.Merchandise_Stock, C.Merchandise_Weight, C.Merchandise_Status, C.Merchandise_unable, A.S_Merchandise_Qty, A.Purchase_ID from s_merchandise A, customer B, 
		merchandise C where A.Cust_ID = B.Cust_ID and C.Merchandise_ID = A.Merchandise_ID and B.Cust_Email = '$email' and A.Purchase_ID is NULL 
		and (C.Merchandise_Stock = 0 or C.Merchandise_Status != 1 or C.Merchandise_unable = 1) order by S_Merchandise_ID asc";
		$cart_search_dis = mysqli_query($connect, $cart_query_dis);
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>My Cart</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<link rel="stylesheet" href="head-foot3.css">
	<link rel="stylesheet" href="tnc_privacy.css">
	<link rel="stylesheet" href="search/search1.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
.singer-info_container {
    display: block;
    margin: 20px 160px;
	padding: 20px 30px;
	border: 1px solid lightgrey;
	border-radius: 8px;
	min-height: 375px;
}

.cart-container form .item-container table{
	background-color: transparent;
	border-collapse: collapse;
	border: 1px solid #f2f2f2;
	margin-bottom: 50px;
	font-family: 'Quicksand', sans-serif;
}


.cart-container form .item-container table thead .table-title{
	border: 1px solid #f2f2f2;
	border-top: 0;
}

.cart-container form .item-container table thead .table-title th{
	padding: 5px;
}

.cart-container form .item-container .disabled-table thead .table-title{
	border: 0;
}

.cart-container form .item-container table thead td,
.cart-container form .item-container .disabled-table thead td{
	font-size: 20px;
	padding: 10px;
	border: 1px solid #f2f2f2;
}

.cart-container form .item-container .disabled-table thead .table-title th{
	background: transparent;
}

.cart-container form .item-container table tbody .item-image{
	height: auto;
    vertical-align: middle;
	width: 25%;
	margin: 10px 0;
	margin-right: 15px;
}

.cart-container form .item-container table tbody tr td{
	border-bottom: 1px solid #f2f2f2;
	font-weight: 600;
}

.cart-container form .item-container .disabled-table tbody tr td{
	border-bottom: 1px solid #f2f2f2;
	background: transparent;
	opacity: 0.5;
	font-weight: 600;
}

.cart-container form .item-container table tbody td{
	text-align: center;
}

.cart-container form .item-container table tbody .merch-row{
	text-align: left;
}

.cart-container form .item-container table tbody .merch-row a{
	text-decoration: none;
	color: black;
}

.cart-container form .item-container table tbody tr .delete-row{
	opacity: 1 !important;
}

.cart-container form .item-container table tbody tr .delete-row span{
	cursor: pointer;
}

.cart-container form .item-container table tbody tr .delete-row span:hover{
	color: rgb(238,67,67);
	transition: 0.5s;
}

.cart-container form .item-container table tbody .merch-row input[type='checkbox']{
	width: 50px;
    height: 15px;
    color: #f2f2f2;
}

.cart-container form .item-container .qty-btn{
	float: left;
	font-size: 0px;
	cursor: pointer;
	user-select:none;
	border: 1px solid #ccc;
}

.cart-container form .item-container .qty-btn label{
	padding: 5px;
	color: #464646;
	cursor: pointer;
	user-select:none;
}

.cart-container form .item-container input[type="number"]{
	border:0;
	border-bottom: 1px solid #ccc;
	border-top: 1px solid #ccc;
	outline: none;
    float: left;
	height: 32px;
	width: 40px;
	margin:0;
	text-align: center;
	font-size: 12pt;
	color: #464646;
	cursor: default;
}

.cart-container form .item-container input::-webkit-outer-spin-button,
.cart-container form .item-container input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.cart-container form .item-container table tbody .subprice-row{
	color: #3f89e7;
}

.cart-container form .item-container .checkout-container{
	border: 1px solid #f2f2f2;
	padding: 20px;
	height: 90px;
}

.cart-container form .item-container .checkout-container .checkout-left{
	float: left;
}

.cart-container form .item-container .checkout-container .checkout-left .checkout-sub,
.cart-container form .item-container .checkout-container .checkout-left .checkout-s,
.cart-container form .item-container .checkout-container .checkout-right .checkout-btn,
.cart-container form .item-container .checkout-container .checkout-right .checkout-total{
	margin: 10px 0;
	font-size: 16px;
}

.cart-container form .item-container .checkout-container .checkout-left .checkout-sub{
	margin-top: 20px;
	margin-bottom: 30px;
}

.cart-container form .item-container .checkout-container .checkout-left{
	float: left;
}

.cart-container form .item-container .checkout-container .checkout-right{
	float: right;
}

.cart-container form .item-container .checkout-container .checkout-right .checkout-total,
.cart-container form .item-container .checkout-container .checkout-right .checkout-selected{
	float: right;
    font-size: 20px;
    font-weight: 600;
	color: #3f89e7;
}

.cart-container form .item-container .checkout-container .checkout-right .checkout-btn button:disabled,
.cart-container form .item-container .checkout-container .checkout-right .checkout-btn button:disabled:hover{
	cursor: not-allowed;
	background: #3f89e7;
}

.cart-container form .item-container .checkout-container .checkout-right .checkout-btn button{
	padding: 10px 25px;
    outline: none;
    border: none;
    background: #3f89e7;
    font-size: 20px;
    color: #fff;
	font-weight: 500;
	cursor: pointer;
	border-radius: 5px;
	float: right;
}

.cart-container form .item-container .checkout-container .checkout-right .checkout-btn button:hover{
	background-color: rgba(190,190,255,1);
	color: white;
	transition-duration: 0.4s;
}

.empty-row .empty-cart-img{
	width: 450px;
    height: auto;
}

.empty-row{
	font-family: 'Quicksand', sans-serif;
	padding-bottom: 60px !important;
}

.empty-row span{
	text-align: center;
}

.empty-row .title{
	font-weight: 800;
	color: #9a1818;
	font-size: 35px;
}

.empty-row .descA{
	font-size: 20px;
}

.empty-row .descB{
	font-size: 15px;
	color: #bfbfbf;
}
</style>
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

<div class="singer-info_container">
<div class="cart-container">
	<form class="cart_form" method="POST" action="merch-checkout.php">
		<div class="item-container">
			<table width=100%>
				<thead>
					<tr>
						<td colspan=6>Active List</td>
					</tr>
					<tr class="table-title">
						<th width=40% colspan=2>Product</td>
						<th width=15%>Price</th>
						<th width=15%>Quantity</th>
						<th width=15%>Total Price</th>
						<th width=15%>Remove</th>
					</tr>
				</thead>
				<tbody class="table_content">
				<?php
				if(mysqli_num_rows($cart_search_upd)==0)
				{
				?>
					<tr>
						<td colspan=6 style="padding: 50px 0" class="empty-row"><img class="empty-cart-img" src="images\cart\emptycart.png"><br><span class="title">oops!</span><br><br><span class="descA">Your cart is empty...</span><br><br><span class="descB">You have no items in your shopping cart. Maybe the product was moved or deleted.</span></td>
					</tr>
				<?php
				}
				else
				{
				while($row = mysqli_fetch_assoc($cart_search_upd))
				{
					?>
					<tr class="item-tr">
						<td class="merch-row">
							<input class="merch-value" type="checkbox" name="item_id[]" class="item-id" value="<?php echo $row['S_Merchandise_ID'];?>" 
							<?php
								if(isset($selected_id))
								{
									if($selected_id == $row['Merchandise_ID']) 
									{
										echo 'checked';
									}
								} 
							?>>
							<input class='weight-value' type='number' value='<?php echo $row['Merchandise_Weight'];?>' hidden>
						</td>
						<td class="merch-row">
							<a href='result_merch.php?q=<?php echo $row['Merchandise_Name'];?>'>
							<img class="item-image" style="float:left" src="<?php echo str_replace("../", "", $row['Merchandise_Image']);?>">
							<br>
							<p><?php echo $row['Merchandise_Name'];?></p>
							</a>
						</td>
						<td class="price-row"><input class="list_price" type="number" value="<?php echo $row['Merchandise_ListPrice'];?>" hidden>RM <?php echo $row['Merchandise_ListPrice'];?></span></td>
						<td class="qty-row">
							<div class="qty-parent-div" style="display: flex; align-items: center; align-content: center;">
								<div class='qty-btn remove-qty' style='border-radius: 2px 0 0 2px; clear:both; margin: 0 auto; margin-right:0;'><label class='material-icons'>remove</label></div>
								<input class='qty' type='number' value='<?php echo $row['S_Merchandise_Qty'];?>' readonly>
								<div class='qty-btn add-qty' style='border-radius: 0 2px 2px 0; margin: 0 auto; margin-left:0;'><label class='material-icons'>add</label></div>
							</div>
							<?php 
							if($row['Merchandise_Stock']<=10)
							{
								?>
									<label style="clear:both; color:red; font-size: 13px; font-weight: 600;"><?php echo $row['Merchandise_Stock'];?> stock left</label>
								<?php
							}
							?>
						</td>
						<td class="subprice-row">RM <span class="dis_sub"><?php echo number_format($row['S_Merchandise_Qty']*$row['Merchandise_ListPrice'],2,'.','');?></span>
							<input class="sub_total" type="number[]" value="<?php echo $row['S_Merchandise_Qty']*$row['Merchandise_ListPrice'];?>" hidden>
						</td>
						<td class="delete-row"><span class='material-icons' onclick="deletecart(1,<?php echo $row['S_Merchandise_ID'];?>)">delete</span></td>
					</tr>
				<?php
				}
				}
				?>
				</tbody>
			</table>

			<?php
			if(mysqli_num_rows($cart_search_dis))
			{
			?>
			<table class="disabled-table" width=100%>
				<thead>
					<tr>
						<td colspan=5>Inactive List</td>
					</tr>
					<tr class="table-title">
						<th width=40%></td>
						<th width=15%></th>
						<th width=15%></th>
						<th width=15%></th>
						<th width=15%></th>
					</tr>
				</thead>
				<tbody class="table_content">
				<?php
				while($row_dis = mysqli_fetch_assoc($cart_search_dis))
				{
					?>
					<tr>
						<td class="merch-row">
							<a href="result_merch.php?q=<?php echo $row_dis['Merchandise_Name'];?>">
							<img class="item-image" style="float:left;" src="<?php echo str_replace("../", "", $row_dis['Merchandise_Image']);?>">
							<br>
							<p><?php echo $row_dis['Merchandise_Name'];?></p>
							</a>
						</td>
						</a>
						<td class="price-row"><input class="list_price" type="number" value="<?php echo $row_dis['Merchandise_ListPrice'];?>" hidden>RM <?php echo $row_dis['Merchandise_ListPrice'];?></span></td>
						<td>
							<div class="qty-parent-div" style="display: flex; align-items: center; align-content: center;">
								<input class='qty' style="margin: 0 auto; border:none;" type='number' readonly value='<?php echo $row_dis['S_Merchandise_Qty'];?>'>
							</div>
							<?php
							if($row_dis['Merchandise_Status']!=1 || $row_dis['Merchandise_unable']==1)
							{
								?>
									<label style="clear:both; color:red; font-size: 13px; font-weight: 600;">Item not available</label>
								<?php

							} 
							else if($row_dis['Merchandise_Stock']<=10)
							{
								?>
									<label style="clear:both; color:red; font-size: 13px; font-weight: 600;"><?php echo $row_dis['Merchandise_Stock'];?> stock left</label>
								<?php
							}
							?>
						</td>
						<td class="subprice-row">RM <span class="dis_sub"><?php echo number_format($row_dis['S_Merchandise_Qty']*$row_dis['Merchandise_ListPrice'],2,'.','');?></span>
							<input class="sub_total" type="number" value="<?php echo $row_dis['S_Merchandise_Qty']*$row_dis['Merchandise_ListPrice'];?>" hidden>
						</td>
						<td class="delete-row"><span class='material-icons' onclick="deletecart(2,<?php echo $row_dis['S_Merchandise_ID'];?>)">delete</span></td>
					</tr>
					<?php
				}?>
				</tbody>
			</table>
				<?php
				}
				?>
		<div class="checkout-container">
			<div class="checkout-left">
				<div class="checkout-sub">Subtotal: RM <span class="subtotal">0.00</span></div>
				<div class="checkout-s">Shipping: RM <span class="shipping">0.00</span></div>
			</div>
			<div class="checkout-right">
				<div class="checkout-total" style="margin-bottom:0;">Total: RM <span class="item_total">0.00</span></div>
				<div class="checkout-selected" style="clear:both; margin-top:0; font-size: 15px;">(<span class="selected">0</span> selected)</div>
				<div class="checkout-btn"><button class="checkout-button" disabled="disabled">Checkout</button></div>
			</div>
		</div>
	</div>
</form>
</div>
</div>
<script>
	function deletecart(action, id)
	{
		if(action==1)
		{
			Swal.fire({
            title: 'Are you sure?',
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
                    url: "ajax_form.php",
                    dataType: 'json',
                    data:{
                        "delbtn":1,
                        "delID":id,
                    },
                    success:function(respone)
                    {
                        if(respone)
                        {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'This item has been deleted.',
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
                    }
                });
            }
			});  
		}
		else
		{
			$.ajax({
				type: "POST",
				url: "ajax_form.php",
				dataType: 'json',
				data:{
					"delbtn":1,
					"delID":id,
				},
				success:function(respone)
				{
					setTimeout(function(){location.reload()},500);
				}
			});
		}
	}
	var email = "<?php echo $email;?>";
	$(document).ready(function(){
		checkCartTotal();

		$('.checkout-btn').on('click',function(e){
			e.preventDefault();
			var form_data = $('.cart_form').serializeArray();
			form_data.push({name:"checkoutbtn",value:1});
			$.ajax({
				url:"ajax_form.php",
				type:'POST',
				data: form_data,
				success: function(respone){
					// console.log(respone);
					if(respone==1)
					{
						$('.cart_form').submit();
					}
					else
					{
						Swal.fire({
							icon: 'error',
							title: 'The stock has been updated',
							showConfirmButton: false,
							timer: 2000,
							didClose: () => location.reload()
						});
					}
				},
				error: function(respone){
					console.log(respone);
				}
			});
		});
		$('.table_content').on('click',function(){
			$('.remove-qty').each(function(){
				var find = $(this).closest(".qty-parent-div");
				var find_input = find.contents().filter("input");

				var find_listprice = $(this).closest("td").closest("tr");

				var price_row = find_listprice.contents().filter(".price-row");
				var list_price = price_row.contents().filter(".list_price");
				
				var subprice_row = find_listprice.contents().filter(".subprice-row");
				var subprice = subprice_row.contents().filter(".sub_total");
				var dis = subprice_row.contents().filter(".dis_sub");

				var merch_row = find_listprice.contents().filter(".merch-row");
				var merch_id = merch_row.contents().filter(".merch-value");
				$(this).on('click',function(){
					var current = find_input.val();
					var price = list_price.val();
					var sub = subprice.val();
					var id = merch_id.val();
					// alert(id);
					// alert(price);
					$.ajax({
						type: "POST",
						url: "ajax_form.php",
						dataType: 'json',
						data: {
								"modify-qty": 1,
								"action":0,
								"qty": current,
								"merch_id": id,
								"cust_id": email,
						},
						success: function(respone){
							if(respone[2]==0)
							{
								Swal.fire({
									icon: 'error',
									title: 'The stock has been updated',
									showConfirmButton: false,
									timer: 2000,
									didClose: () => location.reload()
								});
							}
							else
							{
								dis.text((respone[1]*price).toFixed(2));
								find_input.val(respone[1]);
								checkCartTotal();
							}
						},
						error: function(respone){
							console.log(respone);
						}
					});
				});
			});

			$('.add-qty').each(function(){
				var find = $(this).closest(".qty-parent-div");
				var find_input = find.contents().filter("input");

				var find_listprice = $(this).closest("td").closest("tr");

				var price_row = find_listprice.contents().filter(".price-row");
				var list_price = price_row.contents().filter(".list_price");
				
				var subprice_row = find_listprice.contents().filter(".subprice-row");
				var subprice = subprice_row.contents().filter(".sub_total");
				var dis = subprice_row.contents().filter(".dis_sub");

				var merch_row = find_listprice.contents().filter(".merch-row");
				var merch_id = merch_row.contents().filter(".merch-value");
				$(this).on('click',function(){
					var current = find_input.val();
					var price = list_price.val();
					var sub = subprice.val();
					var id = merch_id.val();
					$.ajax({
						type: "POST",
						url: "ajax_form.php",
						dataType: 'json',
						data: {
								"modify-qty": 1,
								"action":1,
								"qty": current,
								"merch_id": id,
								"cust_id": email,
						},
						success: function(respone){
							if(respone[0])
							{
								if(respone[2]==0)
								{
									Swal.fire({
										icon: 'error',
										title: 'The stock has been updated',
										showConfirmButton: false,
										timer: 2000,
										didClose: () => location.reload()
									});
								}
								else
								{
									dis.text((respone[1]*price).toFixed(2));
									find_input.val(respone[1]);
									checkCartTotal();
								}
							}
							else
							{
								$(".swal2-modal").css('background-color', 'yellow');//Optional changes the color of the sweetalert 
								$(".swal2-container.in").css('background-color', 'rgba(43, 165, 137, 0.45)');//changes the color of the overlay
								Swal.fire({
									icon: 'error',
									title: 'The stock has been updated',
									showConfirmButton: false,
									timer: 5000,
									didClose: () => location.reload()
								});
							}
						},
						error: function(respone){
							console.log(respone);
						}
					});
				});
			});

			checkCartTotal();
		});

		function checkCartTotal()
		{
			var selected = 0;
			var subtotal=0, shipping=0, total=0, weight=0;
			$('.item-tr').each(function(){
				var find = $(this).contents().filter(".qty-row")
				var find_div = find.contents().filter(".qty-parent-div");
				var find_input = find_div.contents().filter("input"); //merchandise qty

				var price_row = $(this).contents().filter(".price-row");
				var list_price = price_row.contents().filter(".list_price"); //merchandise list price
				
				var subprice_row = $(this).contents().filter(".subprice-row");
				var subprice = subprice_row.contents().filter(".sub_total"); //merchandise subtotal

				var merch_row = $(this).contents().filter(".merch-row");
				var merch_id = merch_row.contents().filter(".merch-value"); //merchandise id
				var merch_weight = merch_row.contents().filter(".weight-value"); //merchandise weight

				if(merch_id.is(':checked'))
				{
					var mqty = parseInt(find_input.val());
					var mprice = parseFloat(list_price.val());
					var mweight = parseFloat(merch_weight.val());
					subtotal += mqty*mprice;
					weight += mweight*mqty;
					selected++;
				}
			});
			if(selected>0)
			{
				console.log(weight);
				shipping += 4.66;
				if(weight>3)
				{
					var i=0;
					while((weight-3) > i)
					{
						i++;
						shipping += 0.85;
					}
				}

				total = subtotal + shipping;
				$('.subtotal').text(subtotal.toFixed(2));
				$('.shipping').text(shipping.toFixed(2));
				$('.item_total').text(total.toFixed(2));
				$('.selected').text(selected);
				$('.checkout-button').prop("disabled","");
			}
			else
			{
				$('.subtotal').text("0.00");
				$('.shipping').text("0.00");
				$('.item_total').text("0.00");
				$('.selected').text('0');
				$('.checkout-button').prop("disabled","disabled");
			}
		}
	});
</script>
<?php include "footer.php"; ?>