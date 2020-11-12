<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
	.error{
		color: red;
		font-size: 16px;
	}
</style>
    <section class="floating-button ">
        <div class="btn-cart ">
            <a href="<?php echo base_url('cart') ?>">
                <div class="count-wrapper">
                   <i style="font-size: 18px;" class="fa fa-shopping-cart"></i>
                    <div class="js--cart-quantity count one-digit" style="visibility: inherit; opacity: 1;" id="cart_quantity_sidebar">0</div>
                </div>
                <p class="text">Cart</p>
            </a>
        </div>
        <div class="btn-wishlist">
            <a href="<?php //echo base_url('wishlist'); ?>">
                <div class="count-wrapper">
                   <i style="font-size: 18px;" class="fa fa-heart"></i>
                    <div class="count one-digit">0</div>
                </div>
                <p class="text">Wishlist</p>
            </a>
        </div>
    </section>
<section class="row page-header" style="background: url('<?php echo image_url($this->config->item('checkout_page')); ?>');">
	<div class="container">
		<h4>our foundation</h4>
	</div>
</section>
<div class="page-wrapper ">
	<section class="row gallery-content">
		<div class="container">
			<form action="<?php echo base_url('checkout/proced_to_checkout/'); ?>" class="row m0 contact-form" id="checkout_form" method="post">
				<div class="row">
					<div class="col-md-6">
						<h3>BILLING DETAILS</h3><br>
						<div class="form-group">
							<label class="form_label" for="name">FULL NAME <code class="text-danger">*</code></label>
							<input type="text" class="form-control" id="name" name="name" value="<?php echo $form_data->name; ?>">
							<span class="form-error"></span>
						</div>
						<div class="form-group">
							<label class="form_label" for="email">YOUR EMAIL <code class="text-danger">*</code></label>
							<input type="email" class="form-control" id="email" name="email" value="<?php echo $form_data->email; ?>">
							<div class="form-error text-danger"></div>
						</div>

						<div class="form-group">
							<label class="form_label" for="company_name">COMPANY NAME (OPTIONAL)</label>
							<input type="text" class="form-control" id="company_name" name="company_name">
							<div class="form-error text-danger"></div>
						</div>

						<div class="form-group">
							<label class="form_label" for="street_address1">STREET ADDRESS <code class="text-danger">*</code></label>
							<input type="text" class="form-control" id="street_address1" name="street_address1" placeholder="House number and street name" value="<?php echo $form_data->street_address; ?>">
							<div class="form-error text-danger"></div>
						</div>

							<div class="form-group">
								<input type="text" class="form-control" id="street_address2" name="street_address2" placeholder="Apartment, suite, unit etc. (optional)" value="<?php echo $form_data->address_line; ?>">
						</div>

						<div class="form-group">
							<label class="form_label" for="town_city">TOWN / CITY <code class="text-danger">*</code></label>
							<input type="text" class="form-control" id="town_city" name="town_city" value="<?php echo $form_data->city; ?>">
							<div class="form-error text-danger"></div>
						</div>

						<div class="form-group">
							<label class="form_label" for="c_country">COUNRTY <code class="text-danger">*</code></label>
							<select class="form-control" name="country" id="c_country" >
								<option value="<?php echo $form_data->country; ?>"><?php echo $form_data->country; ?></option>
							</select>
							<div class="form-error text-danger"></div>
						</div>

						<div class="form-group">
							<label class="form_label" for="c_state">STATE <code class="text-danger">*</code></label>
							<select class="form-control" name="state" id="c_state">
								<option value="<?php echo $form_data->state; ?>"><?php echo $form_data->state; ?></option>
							</select>
							<div class="form-error text-danger"></div>
						</div>

						<div class="form-group">
							<label class="form_label" for="zip_code">POSTCODE / ZIP <code class="text-danger">*</code></label>
							<input type="text" class="form-control" id="zip_code" name="zip_code" value="<?php echo $form_data->post_code; ?>">
							<div class="form-error text-danger"></div>
						</div>

						<div class="form-group">
							<label class="form_label" for="phone">PHONE <code class="text-danger">*</code></label>
							<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $form_data->mobile; ?>">
							<div class="form-error text-danger"></div>
						</div>
						<!-- <div class="form-group">
							<label class="form_label" for="currency">Payment Currency <code class="text-danger">*</code></label>
							<select class="form-control" name="currency" id="currency">
								<option value="BDT">BDT</option>
								<option value="USD">USD</option>
							</select>
							<div class="form-error text-danger"></div>
						</div> -->
					</div>
					<div class="col-md-6">
						<h3>ADDITIONAL INFORMATION</h3><br>
						<label class="form_label" for="message">ORDER NOTES (OPTIONAL)</label>
						<textarea name="message" id="message" placeholder="Message" rows="10" class="form-control" style="background-color: #f1f4f8"></textarea>
					</div>
					<div class="col-md-6" style="">
						<table class="table subtotal" style="border: 2px solid #cbd0db">
							<thead>
								<tr><th colspan="2" style="text-align: center;background-color: #29af8a">
									<h3 class="cart_hading" style="font-weight:bold;color: white;">Cart Totals</h3>
								</th></tr>
							</thead>
							<tbody>
								<tr style="border-bottom: 5px solid #cbd0db;margin-bottom: 10px;">
									<th>Subtoal </th>
									<td>$ <?php echo $cartdata['subtotal']; ?></td>
								</tr>
								<tr style="border-bottom: 5px solid #cbd0db;margin-bottom: 10px;">
									<th>Tax</th>
									<td>$ <?php echo $cartdata['tax']; ?></td>
								</tr>
								<tr>
									<th style="color: #000 !important;">TOTAL </th>
									<td style="color: #29af8a;font-weight: 700;">$ <?php echo $cartdata['total'] ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="container">
						<input  value="submit" id = "checkout_submit_button" class="btn-primary pull-left" <?php if ($cartdata['subtotal'] <= 0) {?> type="button"  onclick="empty_message()" <?php } else {?> type="submit" <?php }?>>
					</div>
				</div>
			</form>
			<!-- <div class="row">

			</div> -->
		</div>
	</section>
