<body=id="pageBody">

	<div id="divBoxed" class="container">

		<div class="transparent-bg" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;
		<?php 

if($_SERVER["HTTP_HOST"]!=="localhost"){
	echo "background-color: green;";
	}
else{
echo "background-color: blue;";
}

?>"></div>

		<div class="divPanel notop nobottom">
			<div class="row-fluid">
				<div class="span12">
					<div id="divLogo">
						<a href="index.html" id="divSiteTitle">Domaća zadaća</a>
						<br />
						<a href="index.html" id="divTagLine">wp15..</a>
					</div>

				</div>
			</div>
