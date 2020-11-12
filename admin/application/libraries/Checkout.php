<?php 

	/**
	 * 
	 */
	class Checkout 
	{
		public function set_checkout_method($checkout_method)
		{
			$_SESSION['checkout_method'] = $checkout_method;
		}

		public function set_billing_info($billing_info = array())
		{
			if(is_array($billing_info)){
				 
			}
		}
	}