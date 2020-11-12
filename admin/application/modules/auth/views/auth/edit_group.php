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


				<div id="infoMessage"><?php echo $message; ?></div>

				<?php echo form_open(current_url(), ['class' => 'm-t', 'role' => 'form']); ?>

				<div class="form-group">
					<?php echo lang('edit_group_name_label', 'group_name'); ?> <br />
					<?php echo form_input($group_name); ?>
					<?php echo form_error('group_name', '<div class="text-danger">', '</div>'); ?>
				</div>

				<div class="form-group">
					<?php echo lang('edit_group_desc_label', 'description'); ?> <br />
					<?php echo form_input($group_description); ?>
					<?php echo form_error('group_description', '<div class="text-danger">', '</div>'); ?>
				</div>

				<div class="form-group"><?php echo form_submit('submit', lang('edit_group_submit_btn'), ['class' => 'btn btn-primary pull-right']); ?></div>

				<?php echo form_close(); ?>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</div>
</div>