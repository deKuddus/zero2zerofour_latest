<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php echo script_tag("public/dist/image-uploader.min.js", true); ?>
<?php echo script_tag("public/js/ajax-form.js", true); ?>
<?php echo script_tag("public/js/plugins/jquery-ui/jquery-ui.min.js", true); ?>
<?php echo script_tag("public/js/popper.min.js", true); ?>
<?php echo script_tag("public/js/bootstrap.js", true); ?>
<?php echo script_tag("public/js/plugins/metisMenu/jquery.metisMenu.js", true); ?>
<?php echo script_tag("public/js/plugins/slimscroll/jquery.slimscroll.min.js", true); ?>
<?php echo script_tag("public/js/plugins/metisMenu/jquery.metisMenu.js", true); ?>
<?php echo script_tag("public/js/inspinia.js", true); ?>
<?php echo script_tag("public/js/plugins/iCheck/icheck.min.js", true); ?>
<?php echo script_tag("public/js/plugins/chosen/chosen.jquery.js", true); ?>
<?php echo script_tag("public/js/plugins/jsKnob/jquery.knob.js", true); ?>
<?php echo script_tag("public/js/plugins/datapicker/bootstrap-datepicker.js", true); ?>
<?php echo script_tag("public/js/plugins/daterangepicker/daterangepicker.js", true); ?>
<?php echo script_tag("public/js/plugins/select2/select2.full.min.js", true); ?>
<?php echo script_tag("public/js/sweet-alert.min.js", true); ?>
<?php echo script_tag("public/js/plugins/dataTables/datatables.min.js", true); ?>
<?php echo script_tag("public/js/plugins/dataTables/dataTables.bootstrap4.min.js", true); ?>
<!-- <script src="<?php //echo script_tag(); ?>public/js/tinymce/tinymce.min.js"></script> -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<?php echo script_tag("public/js/validate.min.js", true); ?>
<?php echo script_tag("public/js/country.js", true); ?>
<?php echo script_tag("public/js/plugins/toastr/toastr.min.js", true); ?>
<?php echo script_tag("public/js/plugins/switchery/switchery.js", true); ?>
<?php echo script_tag("public/js/plugins/slick/slick.min.js", true); ?>
<?php echo script_tag("public/js/plugins/ladda/spin.min.js", true); ?>
<?php echo script_tag("public/js/plugins/ladda/ladda.min.js", true); ?>
<?php echo script_tag("public/js/plugins/ladda/ladda.jquery.min.js", true); ?>
<?php echo script_tag("public/main.js", true); ?>
<script type="text/javascript">
	$(".kuddus").slick({
		dots: true
	});
</script>
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01" src="" height="auto" width="50%">
</div>
</body>

</html>
