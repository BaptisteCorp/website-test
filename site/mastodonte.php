<?php 
$title = "Mastodonte";
require 'header.php'; ?>

	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
				<section id="main">
					<header><h1>Mastodonte</h1></header>
					
					<footer>
						<ul class="icons">
							<div class="cadre">
								<h5>Mastodonte</h5>
								<div class="form-row">
									<div class="col-6">
										<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
											<input type="submit" class="icon brands" id="mastodonte_on" name="mastodonte_on" value="On">
										</form>
									</div>
									<div class="col-6">
										<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
											<input type="submit" class="icon brands" id="mastodonte_off" name="mastodonte_off" value="Off">
										</form>
									</div>
									<div class="col-6" >
										<form id="thirdbutton" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
											<input type="submit" class="button icon brands" id="mastodonte_allume" name="mastodonte_allume" value="Allume ?">
										</form>
									</div>
								</div>
								<?php
									if( isset($_GET['mastodonte_allume']) ) {
										$val= shell_exec('ping -c 5 192.168.1.63 | grep -c Unreachable');
										if($val==5){
											echo('Eteint');
										} else {
											echo('Allume');
										}
									} elseif ( isset($_GET['mastodonte_on']) ) {
										//shell_exec("wakeonlan 30:9C:23:E8:DA:BE");
										echo "Magic Packet sent successfully!";
									} elseif( isset($_GET['mastodonte_off']) ) {
										//shell_exec("net rpc shutdown -I 192.168.1.63 -U paul%270114");    
										echo $_GET['mastodonte_off'];
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
require 'footer.php'; 
?>