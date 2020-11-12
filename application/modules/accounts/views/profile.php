<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
    .laden table tbody tr td {
    border: 1px solid #29af8a;
     padding: 5px !important;
    vertical-align: middle;
    font-size: 17px;
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
                        <h4>categories</h4>
                        <ul class="nav">
                            <li><a href="#my_profile">Profile</a></li>
                            <li><a href="#my_order">Orders</a></li>
                            <li><a href="#donations">donations question</a></li>
                            <li><a href="#partner">partner question</a></li>
                            <li><a href="#others">OTHERS</a></li>
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
                                    <td align="center" colspan="2">
                                        <img src="<?php echo base_url('public/assets/images/team/1.jpg'); ?>" alt="" height="100px" width="100px" style="border-radius: 50%">
                                        <button class="btn btn-primary">asdfdf</button>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name </td>
                                    <td>Jon Simon</td>
                                </tr>
                                <tr>
                                    <td>Email </td>
                                    <td>email@email.com</td>
                                </tr>
                                <tr>
                                    <td>Mobile </td>
                                    <td>01780410319</td>
                                </tr>
                                <tr>
                                    <td>City </td>
                                    <td>Test city</td>
                                </tr>
                                <tr>
                                    <td>Street Address</td>
                                    <td>Jon Simon</td>
                                </tr>
                                <tr>
                                    <td>Address Line </td>
                                    <td>Jon Simon</td>
                                </tr>
                                 <tr>
                                    <td>Post Code </td>
                                    <td>4521</td>
                                </tr>
                                 <tr>
                                    <td>State</td>
                                    <td>test state</td>
                                </tr>
                                 <tr>
                                    <td>Country </td>
                                    <td>Bangladesh</td>
                                </tr>
                            </tbody>

                        </table>
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name </td>
                                    <td>Jon Simon</td>
                                    <td>Jon Simon</td>
                                    <td>Jon Simon</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
