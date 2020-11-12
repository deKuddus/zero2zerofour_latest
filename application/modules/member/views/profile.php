<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
.laden table tbody tr td {
    border: 1px solid #29af8a;
    padding: 5px !important;
    font-size: 17px;
}
.danger-text{color: red;}
.badge{
      border-color: gold !important;
    background: gold;
    color: #fff;
}
</style>
<section class="row page-header" style="background-image: url('<?php echo image_url($this->config->item('account_page')) ?>')">
    <div class="container">
        <h4> My Account </h4>
    </div>
</section>

<section class="row content_faqs page-content" style="background-color: #ffffff;">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="row m0 sideNav">
                    <h4>Profile Menu</h4>
                    <ul class="nav">
                        <li><a href="#my_profile">Profile</a></li>
                        <li><a href="#my_order">Orders</a></li>
                        <li><a href="#reset_password">Reset Password</a></li>
                        <li><a href="#membership">Become Premium Member</a></li>
                        <li><a href="#requisition">REQUISITION FOR Privilege Card</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row m0 questions" id="my_profile">
                    <h3 class="question_type">My Profile Information</h3>
                    <div class="table-responsive checkout-table laden">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td align="center" class="text-center">
                                            <img src="<?php echo image_url($member->member_photo); ?>" alt="" height="100px" width="100px" style="border-radius: 50%">
                                    </td><td>
                                         <a href="<?php echo base_url('member/edit/' . $member->id); ?>"><button class="btn btn-primary">EDIT</button></a>

                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name </td>
                                    <td>
                                        <?php

echo $member->name;
if ($member->premium_member == 1) { ?>
                                            <span class="badge btn-sm">Premium Member</span>
                                        <?php }if ($member->life_member == 1) {?>
                                            <span class="badge btn-sm">Lifetime Member</span>
                                        <?php }?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email </td>
                                    <td><?php echo $member->email; ?></td>
                                </tr>
                                <tr>
                                    <td>Mobile </td>
                                    <td><?php echo $member->mobile; ?></td>
                                </tr>
                                <tr>
                                    <td>City </td>
                                    <td><?php echo $member->state; ?></td>
                                </tr>
                                <tr>
                                    <td>Street Address</td>
                                    <td><?php echo $member->street_address; ?></td>
                                </tr>
                                <tr>
                                    <td>Address Line </td>
                                    <td><?php echo $member->police_station; ?></td>
                                </tr>
                                <tr>
                                    <td>Post Code </td>
                                    <td><?php echo $member->post_code; ?></td>
                                </tr>
                                <tr>
                                    <td>Country </td>
                                    <td><?php echo $member->country; ?></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="row m0 questions" id="membership">
                    <h3 class="question_type">Member Ship Upgradation</h3>
                      <div class="table-responsive checkout-table laden">
                        <table class="table">
                            <tbody>
                                    <td class="text-center">
                                        <h3>
                                            <?php echo $premium->member_ship_type ?>
                                        </h3>
                                       <h3>
                                        <strong class="text-info">Features:</strong> <br>
                                           <?php echo $premium->features ?>
                                       </h3>
                                        <h3>
                                            <?php echo $premium->price ?>
                                        </h3>
                                        <h3>
                                            <?php if ($member->premium_member == 0) {?>
                                             <button class="btn btn-primary" onclick="add_to_cart(<?php echo $premium->id; ?>,'membership')">Get Member Ship</button>
                                         <?php }?>
                                        </h3>
                                    </td>
                                     <td class="text-center">
                                        <h3>
                                            <?php echo $lifetime->member_ship_type ?>
                                        </h3>
                                       <h3>
                                        <strong class="text-info">Features:</strong> <br>
                                           <?php echo $lifetime->features ?>
                                       </h3>
                                        <h3>
                                            <?php echo $lifetime->price ?>
                                        </h3>
                                        <h3>
                                            <?php if ($member->life_member == 0) {?>
                                             <button class="btn btn-primary" onclick="add_to_cart(<?php echo $lifetime->id; ?>,'membership')">Get Member Ship</button>
                                         <?php }?>
                                        </h3>
                                    </td>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row m0 questions" id="requisition">
                      <div class="table-responsive checkout-table laden">
                        <h3 class="question_type">Request For My Privilege Card</h3>
                        <button class="btn btn-primary" onclick="add_to_cart(<?php echo $previlize->id ?>,'previlege')">Get Privilege Card</button>
                    </div>
                </div>

                <div class="row m0 questions" id="my_order">
                    <h3 class="question_type">My Order</h3>
                    <div class="table-responsive checkout-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($orders) > 0): ?>
                                    <?php foreach ($orders as $key => $order) {?>
                                        <tr>
                                            <td><?php echo $order->order_id; ?> </td>
                                            <td><?php echo date_format(date_create($order->order_at), 'd-M-Y'); ?></td>
                                            <td><?php echo $order->quantity; ?></td>
                                            <td><?php echo $order->price; ?></td>
                                            <td><a href="<?php echo base_url('member/invoice?order_id=' . $order->order_id); ?>">View Order</a></td>
                                        </tr>
                                    <?php }?>
                                <?php endif?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row m0 questions" id="reset_password">
                    <form id="reset_password" method="post" class="become_volunteer row m0">
                        <style type="text/css">.danger-text{color: red;}</style>
                        <h4 class="hhh h2">The <code class="danger-text">*</code> Mark info is REQUIRED</h4>
                        <h5 id="messages" class="alert alert-danger" style="display: none;"></h5>
                        <div class="form-group">
                            <label for="email">Email <code class="danger-text"></code> </label>
                            <input type="email" id="email" name="email" readonly="readonly" value="<?php echo $member->email; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">New Password <code class="danger-text">*</code> </label>
                            <input type="password" id="password" name="password" class="form-control">
                            <div class="form-error danger-text"></div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password <code class="danger-text">*</code> </label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                            <div class="form-error danger-text"></div>
                        </div>
                        <div class="row m0 text-right">

                            <input type="submit" value="Submit" class="btn-primary">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
