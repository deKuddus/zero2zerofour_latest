<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    #myImg {
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
    }


    /* Add Animation */
    .modal-content {
      -webkit-animation-name: zoom;
      -webkit-animation-duration: 0.6s;
      animation-name: zoom;
      animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
      from {-webkit-transform:scale(0)}
      to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
      from {transform:scale(0)}
      to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
      position: absolute;
      top: 15px;
      right: 35px;
      color: #f1f1f1;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
    }

    .close:hover,
    .close:focus {
      color: #bbb;
      text-decoration: none;
      cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
      .modal-content {
        width: 100%;
      }
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-md-10">
            <h2>Volunteer Detail</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('/') ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>member</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>profile</strong>
                </li>
            </ol>
        </div>
        <div class="col-md-2"><br>
            <div class="btn-group">
                <a href="<?php echo base_url('members'); ?>" class="btn btn-info">Mnage</a>
            </div>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-content">
           <div class="row">
                <div class="col-md-12 text-center">
                    <img alt="image" src="<?php echo image_url($member->member_photo); ?>" style="width: 220px;height: 150px;border-radius: 5px;cursor: pointer;" onclick="view_image(this)">
                    <h2><?php echo $member->name; ?></h2>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="container">
                        <div class="client-detail">
                            <ul class="list-group clear-list">
                                <li class="list-group-item fist-item">
                                    <span class="float-right"> <?php echo $member->email; ?> </span>
                                    Email :
                                </li>
                                <li class="list-group-item">
                                   <span class="float-right"> <?php echo $member->mobile; ?> </span>
                                   Phone :
                               </li>
                               <li class="list-group-item">
                                <span class="float-right"> <?php echo $member->street_address; ?> </span>
                                Street Address :
                            </li>
                            <li class="list-group-item">
                                <span class="float-right"> <?php echo $member->address_line; ?> </span>
                                Address Line :
                            </li>
                            <li class="list-group-item">
                                <span class="float-right"> <?php echo $member->city; ?> </span>
                                City :
                            </li>
                            <li class="list-group-item">
                                <span class="float-right"> <?php echo $member->post_code; ?> </span>
                                Postal Code :
                            </li>
                            <li class="list-group-item">
                                <span class="float-right"> <?php echo $member->state; ?> </span>
                                State :
                            </li>
                            <li class="list-group-item">
                                <span class="float-right"> <?php echo $member->country; ?> </span>
                                Country :
                            </li>
                            <li class="list-group-item">
                                <span class="float-right"> <img src="<?php echo image_url($member->registration_card); ?>" style="width: 220px;height: 150px;border-radius: 5px;cursor: pointer; " onclick="view_image(this)"> </span>
                                Member Certificate :
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>