<?php 
$title = "Dashboard";
require 'header.php'; ?>

<!--code php-->
<?php
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
	}
?>

<?php
	if(!empty($_POST['server_off'])) {
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
	}
?>

<?php
	if(!empty($_POST['server_allume'])) {
	$val = shell_exec('screen -ls | grep -c serv ');
	//echo $val;

		if ( $val < 1 ) {
			echo "Pas de screen d'ouvert";
		} else {
			echo "Il y a $val screen ouverts";
		}    
	}
?>

<?php
	if(!empty($_POST['mastodonte_on']) || !empty($_POST['mastodonte_off']) || !empty($_POST['mastodonte_allume']) || !empty($_POST['chauffage_on']) || !empty($_POST['chauffage_off']) || !empty($_POST['chauffage_temp'])) {
	echo 'Pas encore implemente ;)';    
	}
?>


	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<!-- <span class="avatar"><img src="images/paul.jpg" alt="" /></span> -->
							<h1>Serviel</h1>
							<a href="/mastodonte.php" class"bouton"><h5>Mastodonte</h5></a>
						</header>
						
						<footer>
							<ul class="icons">
								<div class="cadre">
									
									
								</div>
								<div class="cadre">
									<a href="/minecraft.php" ><h5>Serveur Minecraft</h5></a>
									
									
								</div>
								<div class="cadre last">
								<a href="/domotique.php" ><h5>Domotique</h5></a>
									
									
									
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