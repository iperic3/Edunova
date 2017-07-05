<div class="row" style="max-width: 75rem; text-align: center;">
	<hr />
	&copy; Ivan Perić <?php echo $date = date('Y');
	?>

	<?php

	if ($_SERVER["HTTP_HOST"] === "localhost") {
		echo ", <span style=\"color: red\">Lokalno</span>";
	}
	?>
</div>
