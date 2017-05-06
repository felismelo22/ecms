<script src="<?php echo base_url().'templates/admin/'; ?>js/jquery.js"></script>
<script src="<?php echo base_url().'templates/admin/'; ?>js/bootstrap.min.js"></script>
<!-- <script src="<?php echo base_url().'templates/admin/'; ?>js/plugins/ckeditor/ckeditor.js"></script> -->
<script type="text/javascript">
	var _url = '<?php echo base_url() ?>';
</script>
<script src="<?php echo base_url().'templates/admin/'; ?>js/script.js"></script>
<?php
$link_js = @$this->session->userdata('link_js');
if(!empty($link_js))
{
	echo '<script src="'.$link_js.'"></script>';
}
?>

<!-- Morris Charts JavaScript -->
<script src="<?php echo base_url().'templates/admin/'; ?>js/plugins/morris/raphael.min.js"></script>
<script src="<?php echo base_url().'templates/admin/'; ?>js/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url().'templates/admin/'; ?>js/plugins/morris/morris-data.js"></script>
<script type="text/javascript">
	// CKEDITOR.replace('textckeditor');
</script>