<?php
	
	class HTMLView
	{
		public function echoHTML($body)
		{
			echo "
				<!DOCTYPE html>
				<html>
				<head>
				<title>
				Metalgenre.se
				</title>
				<meta charset='utf-8'>
				<link rel='stylesheet' type='text/css' href='./css/bootstrap.css' media='screen and (min-width:481px)' />
        		<link rel='stylesheet' type='text/css' href='./css/bootstrapmobil.css' media='screen and (max-width:481px)' />
       			<link rel='stylesheet' type='text/css' href='./css/bootstrap.css' media='print' />
				</head>
				<body>
				<header class='header'>
				<img class='headerbild'  src='././Pics/header_projekt.png' />
				</header>
						$body
					</body>
				</html>";
		}
	}
?>