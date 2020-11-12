<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
.dt-buttons{
  float: right;
}
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
        <div class="col-sm-4">
            <h2>events</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('/') ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>manage</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
              <?php echo go_back(); ?>
                <a href="<?php echo base_url('events/create') ?>" class="btn btn-primary">ADD
                    Event
                </a>
            </div>
        </div>
    </div>
    <style>
        .dt-buttons {
            float: right;
        }
    </style>
    <div class="clearfix"></div>

    <div class="ibox ">
        <div class="ibox-title">
            <h5>Event List</h5>
        </div>
        <div class="ibox-content">

            <div class="table-responsive">
                <table id="event_list" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Objective</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Ticket Pric</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th><input type="checkbox" class="events_select_all" value="1">&nbsp;&nbsp;<button class="btn btn-danger " type="button" onclick="delete_multiple_events(this)"><i class="fa fa-trash"></i></button>
                        </th>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Objective</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Ticket Pric</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>
