<?php
if( ! $this->session->userdata('id') )
{
	echo "
	<script>
		alert('Anda Harus Login Dahulu');
		window.location.href='".base_url()."auth';
	</script>";
}
require_once 'head.php';
require_once 'header.php';
require_once 'nav.php';
require_once 'konten.php';
require_once 'footer.php';
require_once 'script.php';