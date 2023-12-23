<?php

include APPPATH.'views/flow/pageinit.php';

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="/css/colors.css" rel="stylesheet">
	<link href="/css/custom.css" rel="stylesheet">

	<title>PNM</title>
</head>

<body>
	<div class="container">
		<div class="row justify-content-center align-items-center" style="height:100vh">
			<div class="<?= $boxColWidth ?> pb-5">
				<div class="card shadow mb-3">
					<div class="card-body">
						<?= $contentOutput ?>
					</div>
				</div>
				<div class="text-center">
					by Munawwirul Jamal
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
	<script src="/js/lib/helper.js"></script>

	<?= $scriptSourceTags ?>

	<!-- page script -->
	<script>
	<?php
	if(isset($scriptInit))
		echo $scriptInit;
	echo "\n";
	echo "\t\tvar notifPermissionReqStatus = ".((isset($_COOKIE['notifPermissionReqStatus']) && $_COOKIE['notifPermissionReqStatus'] === "1") ? 'true' : 'false').";\n";
	?>
	</script>

</body>

</html>
