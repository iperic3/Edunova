<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/default.js" type="text/javascript"></script>

<script src="js/camera.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="js/jquery.mobile.customized.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function startCamera() {
		$('#camera_wrap').camera({
			fx : 'scrollLeft',
			time : 2000,
			loader : 'none',
			playPause : false,
			height : '65%',
			pagination : true
		});
	}$(function() {
		startCamera()
	}); 
</script>