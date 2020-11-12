  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  ?>

  <div class="wrapper wrapper-content animated fadeInRight">
  	<div class="row wrapper border-bottom white-bg page-heading">
  		<div class="col-sm-4">
  			<h2>CUSTOMER</h2>
  			<ol class="breadcrumb">
  				<li class="breadcrumb-item">
  					<a href="index.html">customer</a>
  				</li>
  				<li class="breadcrumb-item active">
  					<strong>manage</strong>
  				</li>
  			</ol>
  		</div>
  		<div class="col-sm-8">
  			<div class="title-action">
  				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_customer_modal">Add Customer</button>
  			</div>
  		</div>
  	</div>
  	<style>
  		.dt-buttons{
  			float: right;
  		}
  		.containers label {
  			position: absolute;
  			top: 90%;
  			left: 40%;
  			transform: translate(-50%, -50%);
  			-ms-transform: translate(-50%, -50%);
  			color: #000;
  			font-size: 26px;
  			padding: 12px 24px;
  			border: none;
  			cursor: pointer;
  			border-radius: 5px;
  			text-align: center;
  		}
  	</style>
  	<div class="clearfix"></div>

  	<div class="ibox ">
  		<div class="ibox-title">
  			<h5>Customer List</h5>
  		</div>
  		<div class="ibox-content">

  			<div class="table-responsive">
  				<table id="customer_list" class="table table-striped table-bordered table-hover" >
  					<thead>
  						<tr>
  							<th></th>
  							<th>ID</th>
  							<th>Full Name</th>
  							<th>Username</th>
  							<th>Email</th>
  							<th>Phone</th>
  							<th>Address</th>
  							<th>Picture</th>
  							<th>Action</th>
  						</tr>
  					</thead>
  					<tbody>

  					</tbody>
  					<tfoot>
  						<tr>
  							<th><input type="checkbox" class="customer_select_all" value="1">&nbsp;&nbsp;<button class="btn btn-danger " type="button" onclick="delete_multiple_customer(this)"><i class="fa fa-trash"></i></button></th>
  							<th>ID</th>
  							<th>Full Name</th>
  							<th>Username</th>
  							<th>Email</th>
  							<th>Phone</th>
  							<th>Address</th>
  							<th>Picture</th>
  							<th>Action</th>
  						</tr>
  					</tfoot>
  				</table>
  			</div>

  		</div>
  	</div>
  </div>





  <div class="modal inmodal fade " id="add_customer_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  	<div class="modal-dialog modal-lg">
  		<div class="modal-content animated slideInDown">
  			<div class="modal-header">
  				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  				<h4 class="modal-title">ADD CUSTOMER</h4>
  			</div>

  			<div class="modal-body">
  				<form action="" id="customer_create" method="post" enctype="multipart/form-data">
  					<div class="row">
  						<div class="col-lg-12">
  							<div class="ibox ">
  								<div class="ibox-content">
  									<div class="row">
  										<div class="col-md-6">
  											<div class="form-group">
  												<label>Full Name</label>
  												<?php echo form_input(['name' =>'name','id' =>'name','class'=>'form-control', 'placeholder'=> 'Enter Full Name' ,'type'=>'text','value'=>'']); ?>
  												<div class="form-error text-danger"></div>
  											</div>
  											<div class="form-group">
  												<label>Username</label>
  												<?php echo form_input(['name' =>'username','id' =>'username','class'=>'form-control', 'placeholder'=> 'enter username' ,'type'=>'text','value'=>'']); ?>
  												<div class="form-error text-danger"></div>
  											</div>
  											<div class="form-group">
  												<label>Phone</label>
  												<?php echo form_input(['name' =>'phone','id' =>'phone','class'=>'form-control', 'placeholder'=> 'Enter phone' ,'type'=>'text','value'=>'']); ?>
  												<div class="form-error text-danger"></div>
  											</div>
  											<div class="form-group">
  												<label>Email</label>
  												<?php echo form_input(['name' =>'email','type'=>'email','id' =>'email','class'=>'form-control', 'placeholder'=> 'Enter email' ,'value'=>'']); ?>
  												<div class="form-error text-danger"></div>
  											</div>
  											
  											<div class="form-group">
  												<label>Password</label>
  												<?php echo form_input(['name' =>'password','type'=>'password','id' =>'password','class'=>'form-control', 'placeholder'=> 'enter password' ,'value'=>'']); ?>
  												<div class="form-error text-danger"></div>
  											</div>
  										</div>
  										<div class="col-md-6">
                        <div class="form-group">
                          <label>Address</label>
                          <?php echo form_textarea(['name' =>'address','id' =>'address','class'=>'form-control', 'placeholder'=> 'Enter address' ,'value'=>'']); ?>
                          <div class="form-error text-danger"></div>
                        </div>
                        <div class="form-group">
                          <div class="containers">
                           <img class="customer_image" id="customer_image_view"  src="<?php echo FILE_UPLOAD_PATH ;?>customer/default.png" alt="default image" height="200px" width="250px">
                           <span>
                            <label for="customer_image"><i class="fa fa-camera"></i></label>
                          </span>
                          <input type="file" id="customer_image" name="customer_image" accept="image/gif,image/jpeg,image/jpg,image/png," style="opacity: 0">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            <button type="submit" id="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal inmodal fade " id="customer_edit_modal" tabindex="-1" role="dialog"  aria-hidden="true">
 <div class="modal-dialog modal-lg">
  <div class="modal-content animated slideInDown">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title">EDIT ADMINISTRATOR</h4>
  </div>
  <div class="modal-body">
    <form action="" id="customer_edit" method="post" enctype="multipart/form-data">
     <div class="row">
      <div class="col-lg-12">
       <div class="ibox ">
        <div class="ibox-content">
         <div class="row">
          <div class="col-md-6">
           <input type="hidden" name="customer_id" id="customer_id">
                    <!-- <div class="form-group">
                      <label class="control-label" for="users_role">User Role <span class="required">*</span>
                      </label>
                      <div >
                        <select class="form-control" id="edit_role_id" name="role_id">
                          <option value="1">ADMIN</option>
                          <option value="2">MANAGER</option>
                          <option value="3">SALES</option>
                        </select>
                      </div>
                    </div> -->
                    <div class="form-group">
                     <label>Full Name</label>
                     <?php echo form_input(['name' =>'name','id' =>'edit_customer_name','class'=>'form-control', 'placeholder'=> 'enter name' ,'type'=>'text','value'=>'']); ?>
                     <div class="error text-danger"></div>
                   </div>
                   <div class="form-group">
                     <label>Username</label>
                     <?php echo form_input(['name' =>'username','id' =>'edit_customer_user_name','class'=>'form-control', 'placeholder'=> 'enter username' ,'type'=>'text','value'=>'']); ?>
                     <div class="error text-danger"></div>
                   </div>
                   <div class="form-group">
                     <label>Phone</label>
                     <?php echo form_input(['name' =>'phone','id' =>'edit_customer_phone','class'=>'form-control', 'placeholder'=> 'Enter phone' ,'type'=>'text','value'=>'']); ?>
                     <div class="error text-danger"></div>
                   </div>
                   <div class="form-group">
                     <label>Email</label>
                     <?php echo form_input(['name' =>'email','type'=>'email','id' =>'edit_customer_email','class'=>'form-control', 'placeholder'=> 'Enter email' ,'type'=>'email','value'=>'']); ?>
                     <div class="error text-danger"></div>
                   </div>
                 </div>
                 <div class="col-md-6">
                  <div class="form-group">
                    <label>Address</label>
                    <?php echo form_textarea(['name' =>'address','id' =>'edit_customer_address','class'=>'form-control', 'placeholder'=> 'Enter address' ,'value'=>'']); ?>
                    <div class="form-error text-danger"></div>
                  </div>
                  <div class="form-group">
                    <div class="containers">
                     <img class="customer_image" id="customer_image_view_edit"  src="<?php echo FILE_UPLOAD_PATH ;?>customer/default.png" alt="default image" height="200px" width="250px">
                     <span>
                      <label for="customer_image_edit"><i class="fa fa-camera"></i></label>
                    </span>
                    <input type="file" id="customer_image_edit" name="customer_image_edit" accept="image/gif,image/jpeg,image/jpg,image/png," style="opacity: 0">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
     <button type="submit" id="submitEdit" class="btn btn-primary">Update</button>
   </div>
 </form>
</div>
</div>
</div>
</div>
