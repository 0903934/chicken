<!DOCTYPE html>

<html lang="en">
	<head>
		<link rel="shortcut icon" type="image/png" href="images/favicon3.png"/>
		<link rel="shortcut icon" type="image/png" href="images/favicon3.png"/>
		<meta charset="UTF-8">
		<title>Contact Us</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>

	<body>

		<!-- Header -->
			<header id="header">
				<h1><a href="index.html">Foxy Snap</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="how_it_works.html">How it Works</a></li>
						<li><a href="contact_us.php">Contact Us</a></li>
						<li><a href="login.html" class="button special">Login</a></li>
						<li><a href="register.html" class="button special">Register</a></li>
					</ul>
				</nav>
			</header>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major">
						<h2>Contact Us</h2>
						<p></p>
					</header>

					<section id="three" class="wrapper style3 special">
                    <div class="container">
                        <header class="major">
                            <h2>Have a Question?</h2>
                            <p>Let us know below. Please fill in all fields and we'll respond as soon as we can!</p>
                        </header>
                    </div>


                    <div class="container 50%">
                        <form action="backend/logic/ContactUsFormHandler.php" method="post" name="contact">

                            <div class="row uniform">
                                <div class="6u 12u$(small)">
                                    <input name="Name" id="name" placeholder="Full Name" type="text">
                                </div>
                                <div class="6u$ 12u$(small)">
                                    <input name="Email" id="email" placeholder="Email Address" type="email">
                                </div>
                                <div class="12u$">
                                    <textarea name="Message" id="message" placeholder="The Message"></textarea>
                                </div>
                                <div class="12u$">
                                    <ul class="actions">
                                        <li><input value="Send Message" class="special big" type="submit" name="Submit"></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
			        </section>
				</div>
			</section>
		
		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<section class="links">
						
					<div class="row">
						<div class="8u 12u$(medium)">
							<ul class="copyright">
								
								
								<li><h3>Robert Gordon University: CMM007 Coursework</h3></li>
								<li><h4>&copy; Foxy Snap Predator Detection Software</h4></li>
								
								<li><a href="index.html">Home</a></li>
            					<li><a href="how_it_works.html">How It Works</a></li>
            					<li><a href="contact_us.php">Contact Us</a></li>
            					<li><a href="login.html">Login</a></li>
            					<li><a href="register.html">Register</a></li>
							</ul>
						</div>
						<div class="4u$ 12u$(medium)">
							<ul class="icons">
								<li>
									<a class="icon rounded fa-facebook"><span class="label">Facebook</span></a>
								</li>
								<li>
									<a class="icon rounded fa-twitter"><span class="label">Twitter</span></a>
								</li>
							
							</ul>
						</div>
					</div>
				</div>
			</footer>
	</body>
</html>
