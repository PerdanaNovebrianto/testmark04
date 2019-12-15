<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- CK Editor -->
<script src="<?= base_url() ?>assets/plugins/ckeditor/ckeditor.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
<script src="<?= base_url() ?>assets/dist/js/pages/custom.js"></script>
<?php if($sub_title == 'Data Chat'){?>
<script src="<?= base_url() ?>assets/dist/js/chat.js"></script>
<?php } ?>
<?php if($sub_title == 'Riwayat Chat'){?>
	<script src="<?= base_url() ?>assets/dist/js/history_chat.js"></script>
<?php } ?>
<script>
	$('#data-users').DataTable();
	$('#data-info').DataTable();
	$('#data-tips').DataTable();
	$(function () {
	    ClassicEditor
	      .create(document.querySelector('#editor1'))
	      .then(function (editor) {
	      	console.log('hi');
	        // The editor instance
	      })
	      .catch(function (error) {
	        //console.error(error);
	    })
	})
</script>
</body>
</html>
