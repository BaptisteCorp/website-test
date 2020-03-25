<?php 
$title = "Serv-Minecraft";
require 'header.php'; ?>

	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<!-- <span class="avatar"><img src="images/paul.jpg" alt="" /></span> -->
							<h1>Minecraft</h1>
							
						</header>
						
						<footer>
							<ul class="icons">
							
								<div class="cadre">
									<h5>Serveur Minecraft</h5>
									<div class="form-row">
										<div class="col-6">
											<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
												<input type="submit" class="icon brands" id="server_on" name="server_on" value="on">
											</form>
										</div>
										<div class="col-6">
											<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
												<input type="submit" class="icon brands" id="serveur_off" name="server_off" value="off">
											</form>
										</div>
										<div class="col-6">
											<form id="thirdbutton" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
												<input type="submit" class="icon brands" id="server_allume" name="server_allume" value="Allume ?">
											</form>
										</div>
									</div>
									
<?php
/*A MODIFIER
	* TESTER SI LA VARIABLE EST INITIE AVEC ISSET
	* MODIFIER LES METHODES DES FORMULAIRES
	* MODIFIER L'APPELATION DE VARIABLE EN CONSEQUENCE ($_GET)
	* A FAIRE POUR L'AUTRE PAGE DOMOTIQUE ^^
	* BON COURAGE
*/
	if(!empty($_POST['server_on'])) {
	$val = shell_exec('screen -ls | grep -c serv ');
	//echo $val;

		if ( $val < 1 ) {
			shell_exec("screen -dmS serv sh");
			shell_exec("screen -S serv -X stuff 'echo hey\n'");
			echo "Screen ouvert";
		} else {
			echo "Un screen serv est deja ouvert";
		}    
	} elseif(!empty($_POST['server_off'])) {
	$val = shell_exec('screen -ls | grep -c serv ');
	//echo $val;

		if ( $val < 1 ) {
			shell_exec("screen -dmS serv sh");
			shell_exec("screen -S serv -X stuff 'echo hey\n'");
			echo "Pas de screen d'ouvert";
		} else {
			shell_exec("screen -S serv -X stuff 'exit\n'");
			echo "screen ferme";
		}    
	} elseif (!empty($_POST['server_allume'])) {
	$val = shell_exec('screen -ls | grep -c serv ');
	//echo $val;

		if ( $val < 1 ) {
			echo "Pas de screen d'ouvert";
		} else {
			echo "Il y a $val screen ouverts";
		}    
	}
?>
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