<html>
	<head>
		<title> <?php _('page_title') ?> </title>
	</head>

	<body>
		Hi this my proposed layout for new modular Swift Tide
		<p>
			In this new approach I have divided the code in three part, to seperate presentaion from logic
			<ol>
			<li>Presentation - html files with some php code to display, all these files are in +front_layer folder </li>
			<li>Logic and controller files - Files which control everything, apply logic, validate inputs, and handle database and presentation files</li>
			<li>Database layer - Files that interact to database and return the result to controller, this layer ensures that controller is purely independent of database</li>
			</ol>
			view readme file <a href='readme.txt'>readme.txt</a>
			
			<br /> Page title of this page comes from language files.
		</p>
	</body>
</html>