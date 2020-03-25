<?php 
$title = "Domotique";
require 'header.php'; 
?>

	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<!-- <span class="avatar"><img src="images/paul.jpg" alt="" /></span> -->
							<h1>Domotique</h1>
<!--code php-->

<?php
	if(!empty($_POST['chauffage_on']) || !empty($_POST['chauffage_off']) || !empty($_POST['chauffage_temp']) || !empty($_POST['lumiere_on']) || !empty($_POST['lumiere_off']) || !empty($_POST['lumiere_allume'])) {
		echo 'Pas encore implemente ;)';    
	} 
	elseif(!empty($_POST['3d_allume'])){
		$val= shell_exec('ping -c 5 192.168.1.5 | grep -c Unreachable');
		if($val==5){
			echo("Octoprint Eteint\n");
		}  else{echo('Octoprint Allume');}
		echo('Esp printer non mis en place');
	} 
	elseif(!empty($_POST['3d_on'])){
		//$affiche=shell_exec('/etc/init.d/octoprint start');
		//echo($affiche);
		//shell_exec('270114');
		echo 'Pas encore implemente ;)'; 
	}
?>
						</header>
						
						<footer>
							<ul class="icons">
								<div class="cadre">
									<h5>Octoprint</h5>
									<div class="form-row">
										<div class="col-6">
											<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
												<input type="submit" class="icon brands" id="3d_on" name="3d_on" value="Start">
											</form>
										</div>
										<div class="col-6">
											<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
												<input type="submit" class="icon brands" id="3d_off" name="3d_off" value="Stop">
											</form>
										</div>
										<div class="col-6">
											<form id="thirdbutton" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
												<input type="submit" class="icon brands" id="3d_allume" name="3d_allume" value="Restart">
											</form>
										</div>

									</div>
								</div>
                                <div class="cadre">
									<h5>Lumières</h5>
									<div class="form-row">
										<div class="col-6">
											<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
												<input type="submit" class="icon brands" id="lumiere_on" name="lumiere_on" value="On">
											</form>
										</div>
										<div class="col-6">
											<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
												<input type="submit" class="icon brands" id="lumiere_off" name="lumiere_off" value="Off">
											</form>
										</div>
										<div class="col-6">
											<form id="thirdbutton" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
												<input type="submit" class="icon brands" id="lumiere_allume" name="lumiere_allume" value="Allume ?">
											</form>
										</div>

									</div>
								</div>
								<div class="cadre last">
									<h5>Chauffage</h5>
									<div class="form-row">
										<div class="col-6">
											<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
												<input type="submit" class="icon brands" id="chauffage_on" name="chauffage_on" value="on">
											</form>
										</div>
										<div class="col-6">
											<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
												<input type="submit" class="icon brands" id="chauffage_off" name="chauffage_off" value="off">
											</form>
										</div>
										<div class="col-6">
											<form id="thirdbutton" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
												<input type="submit" class="icon brands" id="chauffage_temp" name="chauffage_temp" value="Temp ?">
											</form>
										</div>

									</div>
								</div>
								
							</ul>
						</footer>
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
						<li>&copy; CHABOT FAMILY - 2020</li>
						</ul>
					</footer>
			</div>

<?php 
require 'footer.php'; ?>