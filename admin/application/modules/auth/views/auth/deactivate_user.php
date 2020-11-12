<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-sm-4">
			<h2>ADMINISTRATION</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('/') ?>">Home</a>
				</li>
				<li class="breadcrumb-item active">
					<strong>Create</strong>
				</li>
			</ol>
		</div>
		<div class="col-sm-8">
			<div class="title-action">

			</div>
		</div>
	</div>
	<style>
	.dt-buttons{
		float: right;
	}
</style>
<div class="clearfix"></div>

<div class="ibox ">
	<div class="ibox-title">
		<h5>Administration List</h5>
	</div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">

				<h3><?php echo lang('deactivate_heading'); ?></h3>
				<p><?php echo sprintf(lang('deactivate_subheading'), $user->username); ?></p>

				<?php echo form_open("auth/deactivate/" . $user->id); ?>

			<div class="form-group">
					<?php echo lang('deactivate_confirm_y_label', 'confirm'); ?>
					<input type="radio" name="confirm" value="yes" checked="checked" />
					<?php echo lang('deactivate_confirm_n_label', 'confirm'); ?>
					<input type="radio" name="confirm" value="no" />
				</div>

				<?php echo form_hidden($csrf); ?>
				<?php echo form_hidden(['id' => $user->id]); ?>

			<div class="form-group"><?php echo form_submit('submit', lang('deactivate_submit_btn'), ['class' => 'btn btn-primary']); ?>
			</div>

				<?php echo form_close(); ?>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</div>
</div>