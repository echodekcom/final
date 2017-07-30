<?php 
	if($_SESSION['mem_status'] != 'admin'){ ?>
		<script type="text/javascript">
			window.location.href='home.php';
		</script>
<?php } ?>