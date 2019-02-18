<?php

include_once ('config.php');

	if(isset($_GET['page']))
		$page = $_GET['page'];
	else 
		$page = 'index.php';
	
	echo '<script>
				//alert(window.location.href);
				//alert(window.location.hash);
				alert("авторизуемся...");
				var regex = "#";
				var str = "'.$main_link.'/'.$page.'"+window.location.hash.replace(regex,"?");
				//alert (str);
				document.location.href = str;
			</script>';

	if(isset($page)){
		var_dump($page);
	}
?>
