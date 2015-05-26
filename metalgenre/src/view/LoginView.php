<?php

	require_once("common/HTMLView.php");
	

	//Ärver HTMLView
	class LoginView extends HTMLView
	{
		private $model;
		private $loginStatus = "";
		private $username = "username";
		private $password = "password";
		private $checkbox = "checkbox";
		private $message = "";
		private $welcomemessage = "";

		private $logout = "logout";
		private $register = "register";
		private $addgenre = "addgenre";
		private $showevents = "showevents";
		private $editgenre = "editgenre";
		private $deletegenre = "deletegenre";
		private $editrating = "editrating";
		private $showContact = "showcontact";
		private $login = "login";
		private $createuserbutton = "createuserbutton";
		private $createusername = "createusername";
		private $createpassword = "createpassword";
		private $repeatpassword = "repeatpassword";
		private $addrating = "addrating";
		private $addbandtoevent = "addbandtoevent";
		private $addbandtoalbum = "addbandtoalbum";
		private $addband = "addband";
		private $addalbum ="addalbum";
		private $showgenres = "showgenres";
		private $deleterating = "deleterating";
		
		//Gör nya instanser av klasser.
		public function __construct(LoginModel $model)
		{
			$this->model = $model;
			
		}
		
		// Kontrollerar ifall användarnamnet är lagrat i POST-arrayen.Tilldelad kod.
		public function didUserPressLogin()
		{
			return isset($_POST[$this->username]);
		}
		
		// Kontrollerar ifall URL:en innehåller logout.Tilldelad kod.
		public function didUserPressLogout()
		{
			return isset($_GET[$this->logout]);
		}

		public function didUserPressAddBandToAlbum()
		{
			return isset($_GET[$this->addbandtoalbum]);
		}

		//Kollar om användaren tryckt på register länken, returnerar sant annars falskt.
		public function didUserPressRegister()
		{
			 
			return isset($_GET[$this->register]);
			
		}

		//Kollar om användaren tryckt på lägga till livespelning länken i menyn, returnerar sant annars falskt.
		public function didUserPressAddBand()
		{

			return isset($_GET[$this->addband]);
		}

		public function didUserPressEditGenre()
		{

			return isset($_GET[$this->editgenre]);
		}

		public function didUserPressDeleteGenre()
		{

			return isset($_GET[$this->deletegenre]);
		}

		public function didUserPressShowGenre()
		{

			return isset($_GET[$this->showgenres]);
		}


		//Kollar om användaren tryckt på visar livespelningar med band samt betyg länken i menyn, returnerar sant annars falskt.
		public function didUserPressShowAllEvents()
		{
			return isset($_GET[$this->showevents]);
		}

		//Kollar om användaren tryckt på editera betyg till livespelning med angivet band länken i menyn, returnerar sant annars falskt.
		public function didUserPressEditGrades()
		{
			return isset($_GET[$this->editrating]);
		}

		public function didUserPressAddAlbum()
		{
			return isset($_GET[$this->addalbum]);
		}

		public function didUserPressContact()
		{
			return isset($_GET[$this->showContact]);
		}


		//Kontrollerar om användaren tryckt på skapa användare knappen, returnera true annars falskt.
		public function didUserPressCreateUser(){

			if(isset($_POST[$this->createuserbutton]))
			{
				return true;
			}
			return false;
		}

		//Kollar om användaren matat in något i registrera användare inputen, returnera värdet annars falskt.
		public function getRegisterUsername(){

			if(isset($_POST[$this->createusername]))
			{
				return $_POST[$this->createusername];
			}
			return false;
		}

		//Kollar om användaren matat in något i registrera lösenord inputen, returnera värdet annars falskt.
		public function getRegisterPassword(){

			if(isset($_POST[$this->createpassword]))
			{
				return $_POST[$this->createpassword];
			}
			return false;
		}

		//Kollar om användaren matat in något i repitera registrera lösenord inputen, returnera värdet annars falskt.
		public function getRepeatRegisterPassword(){

			if(isset($_POST[$this->repeatpassword]))
			{
				return $_POST[$this->repeatpassword];
			}
			return false;
		}

		//Kollar om användaren matat in något i lösenord inputen, returnera värdet annars falskt.
		public function getInputPassword()
		{
			if(isset($_POST[$this->password]))
			{
				return $_POST[$this->password];
			}
			return false;
		}

		//Kollar om användaren tryckt på lägga till betyg till livespelning med angivet band länken i menyn, returnerar sant annars falskt.
		public function didUserPressAddRating()
		{
			return isset($_GET[$this->addrating]);
		}

		//Kollar om användaren tryckt på lägga till band till livespelning länken i menyn, returnerar sant annars falskt.
		public function didUserPressAddBandToEvent()
		{
			return isset($_GET[$this->addbandtoevent]);
		}

		//Kollar om användaren tryckt på lägga till band länken i menyn, returnerar sant annars falskt.
		public function didUserPressAddGenre()
		{
			return isset($_GET[$this->addgenre]);
		}

		//Kollar om användaren tryckt på ta bort betyg till livespelning med angivet band länken i menyn, returnerar sant annars falskt.
		public function didUserPressDeleteGrade()
		{
			return isset($_GET[$this->deleterating]);
		}

		
		
		// Visar logga in sidan.
		public function showLoginPage()
		{
			
			

			// Kontrollerar inloggningsstatus. Är användaren inloggad...Tilldelad kod.	
			if($this->model->checkLoginStatus())
			{				
				// ...visa användarsidan...Tilldelad kod.
				$contentString = "<p class='centercol'>$this->message</p><p class='centercol'><a href='?logout'>Logga ut</a></p>";
				$this->loginStatus = $this->model->getLoggedInUser() . " är inloggad";
			}
			else 
			{
				
				
					
				$this->welcomemessage = "<h1 class='h1welcome'>Välkommen till MetalGenre.se</h1>
				<h2 class='h2welcome'>Logga in för att se menyn. Utan konto? Registrera dig och logga in.</h2>
				<div class='divwelcome'>MetalGenre handlar om att lägga till, editera och ta bort betyg på album. Samt lägga till, editera och ta bort genrer som man själv har skapat. Går även att lägga till band och album m.m.
				När du loggat in kan du se meny med de olika alternativen.</div>";
				$this->loginStatus = "Ej inloggad";

				$contentString = 
					"<form id='loginForm' method=post action='?login'>
						<div>
							<h3 class='centercol'>Login - Skriv in användarnamn och lösenord</h3>
							<p class='centercol'>$this->message</p>
							<span class='loginbox' style='white-space: nowrap'>Namn:</span> <input type='text' class='loginbox' name='$this->username' value='" . $this->getInputUsername() . "'>
							<span class='loginbox' style='white-space: nowrap'>Lösenord:</span> <input type='password' class='loginbox' name='$this->password'><br> 
							<span class='loginbox' style='white-space: nowrap'>Håll mig inloggad:</span><input type='checkbox' class='loginbox' name='$this->checkbox' value='checked'><br>
							<button type='submit' class='loginboxbutton' name='button' form='loginForm' value='Submit'>Logga in</button>
						</div>
					</form>";
				
			}
			
			
			$HTMLbody = "
			<div class='divlogin'>
			$this->welcomemessage
			<div class='form'>
			<h3 class='centercol'>$this->loginStatus</h3>
			<p class='centercol'><a href='?register'>Registrera ny användare</a></p>
			$contentString
			</div></div>";

			if($this->model->checkLoginStatus())
			{
				$HTMLbody = "
				
				
				<h2 class='centercol'>Meny</h2>
				<div class='divmenu'>
				

				
				<nav>
						<ul>
							<li><a href='#'>Lägg till</a>
								<ul>
										<li><a href='?addband'>Lägg till band</a></li>
										<li><a href='?addgenre'>Lägg till genre</a></li>
										<li><a href='?addalbum'>Lägg till album</a></li>
										<li><a href='?addbandtoevent'>Lägg till band till genre</a></li>
										<li><a href='?addbandtoalbum'>Lägg till band till album</a></li>
										<li><a href='?addrating'>Lägg till betyg på album</a></li>
								</ul>
							</li>		
							<li><a href='#'>Editera</a>
								<ul>
									<li><a href='?editrating'>Editera betyg på album</a></li>
									<li><a href='?editgenre'>Editera genre</a></li>

								
								</ul>
							</li>
							<li><a href='#'>Ta bort</a>
								<ul>
									<li><a href='?deleterating'>Ta bort betyg på album</a></li>
									<li><a href='?deletegenre'>Ta bort genre</a></li>
								</ul>
							</li>
							<li><a href='#'>Visa</a>
								<ul>
									<li><a href='?showgenres'>Visa genres</a></li>
									<li><a href='?showevents'>Visa Album med betyg</a></li>
									<li><a href='?showcontact'>Visa Kontaktformulär</a></li>
								</ul>
						</ul>
					</nav>
					
				
				
				</div>
				<h2 class='centercol'>$this->loginStatus</h2>
				$contentString";
			}

			$this->echoHTML($HTMLbody);
		}

		// Visar login formulär med just registrerad användares uppgifter i användarnamn inputen.
		public function showLoginPageWithRegname()
		{
			
		
			
			// Kontrollerar inloggningsstatus. Är användaren inloggad...Tilldelad kod.	
			if($this->model->checkLoginStatus())
			{				
				// ...visa användarsidan...Tilldelad kod.
				$contentString = "
					$this->message
					<p><a href='?logout'>Logga ut</a></p>";
				$this->loginStatus = $this->model->getLoggedInUser() . " är inloggad";
			}
			else 
			{
					$this->welcomemessage = "<h1 class='h1welcome'>Välkommen till MetalGenre.se</h1>
					<h2 class='h2welcome'>Logga in för att se menyn. Utan konto? Registrera dig och logga in.</h2>
					<div class='divwelcome'>MetalGenre handlar om att lägga till, editera och ta bort betyg på album med band. Samt lägga till, editera och ta bort genrer som man själv har skapat. Går att lägga till band och album.
					När du loggat in kan du se meny med de olika alternativen.</div>";
					$this->loginStatus = "Ej inloggad";

					$contentString = 
					"<form id='loginForm' method=post action='?login'>
						<div>
							<h3 class='centercol'>Login - Skriv in användarnamn och lösenord</h3>
							<p class='centercol'>$this->message</p>
							<span class='loginbox' style='white-space: nowrap'>Namn:</span> <input type='text' class='loginbox' name='$this->username' value='" . $this->getCreateInputUsername() . "'>
							<span class='loginbox' style='white-space: nowrap'>Lösenord:</span> <input type='password' class='loginbox' name='$this->password'><br> 
							<span class='loginbox' style='white-space: nowrap'>Håll mig inloggad:</span><input type='checkbox' class='loginbox' name='$this->checkbox' value='checked'><br>
							<button type='submit' class='loginboxbutton' name='button' form='loginForm' value='Submit'>Logga in</button>
						</div>
					</form>";
				
			}
			
			$HTMLbody = "<div class='divlogin'>
			$this->welcomemessage
			<div class='form'>
			<h3 class='centercol'>$this->loginStatus</h3>
			<p class='centercol'><a href='?register'>Registrera ny användare</a></p>
			$contentString
			</div></div>";
			
			$this->echoHTML($HTMLbody);
		}

		public function showRegisterPage(){

			
			
			// Kontrollerar inloggningsstatus. Är användaren inloggad...Tilldelad kod.	
			if($this->model->checkLoginStatus())
			{			
				
				// ...visa användarsidan...Tilldelad kod.
				$contentString = "
				$this->message
				<p><a href='?logout'>Logga ut</a></p>";
				$this->loginStatus = $this->model->getLoggedInUser() . " är inloggad";

			}else{

					// visa registreringssidan.
					$this->loginStatus = "Ej inloggad - Registrerar användare";
					$contentString = 
					 "
					<form method=post >
						<div class='divreg'>
							<h3 class='centercol'>Registrera ny användare - Skriv in användarnamn och lösenord</h3>
							<p class='centercol'>$this->message</p>
							<span class='regbox' style='white-space: nowrap'>Namn:</span><br> <input class='regbox' type='text' name='$this->createusername' value='". strip_tags($_POST[$this->createusername]) ."'><br>
							<span class='regbox' style='white-space: nowrap'>Lösenord:</span><br> <input class='regbox' type='password' name='$this->createpassword'><br>
							<span class='regbox' style='white-space: nowrap'>Repetera Lösenord:</span><br> <input class='regboxbutton'  type='password' name='$this->repeatpassword'><br>
							<input type='submit' class='regboxbutton1' name='$this->createuserbutton'  value='Registrera'>
						</div>
					</form>";

					$HTMLbody = "<div class='divregister'>
					<h2 class='centercol'>$this->loginStatus</h2>
					<p class='centercol'><a href='?login'>Tillbaka</a></p>
					$contentString<br>
					</div>";

					$this->echoHTML($HTMLbody);
			}

				
		}
		
		// Skapar cookies innehållande de medskickande värdena.Tilldelad kod.
		public function createCookies($usernameToSave, $passwordToSave)
		{
			// Bestämmer cookies livslängd.
			$cookieExpirationTime = time()+ 60;
			
			// Skapar cookies.Tilldelad kod.
			setcookie("Username", $usernameToSave, $cookieExpirationTime);
			setcookie("Password", $passwordToSave, $cookieExpirationTime);
			
			//Skapar en fil innehållande information om kakornas livslängd.Tilldelad kod.
			$this->model->createReferenceFile($cookieExpirationTime, "cookieExpirationTime");
		}
		
		//Söker efter kakor.
		public function searchForCookies()
		{
			if(isset($_COOKIE["Username"]) === true && isset($_COOKIE["Password"]) === true)
			{
				return true;
			}
			
			return false;
		}
		
		// Logga in med kakor.Tilldelad kod.
		public function loginWithCookies()
		{
			// Validera cookies mot textfilen.
			$this->model->validateExpirationTime();
			
			// Validera kakornas innehåll.
			$this->model->verifyUserInput($_COOKIE["Username"],$_COOKIE["Password"], true);
			
			// Visa rättmeddelande.
			$this->showMessage("Inloggningen lyckades via cookies");
		}
		
		// Tar bort alla cookies.Tilldelad kod.
		public function removeCookies()
		{
			foreach ($_COOKIE as $c_key => $c_value)
			{
				setcookie($c_key, NULL, 1);
			}
		}
		
		// Sparar angivet användarnamn i textfältet.Tilldelad kod.
		public function getInputUsername()
		{
			if(isset($_POST[$this->username]))
			{
				return $_POST[$this->username];
			}
			
			// Är inte användarnamnet satt skickas en tomsträng med.Tilldelad kod.
			return "";
		}

		public function getCreateInputUsername()
		{
			if(isset($_POST[$this->createusername]))
			{
				return $_POST[$this->createusername];
			}
			
			// Är inte användarnamnet satt skickas en tomsträng med.Tilldelad kod.
			return "";
		}
		
		// Visar eventuella meddelanden.Tilldelad kod.
		public function showMessage($message)
		{
			$this->message = $message;
		}
		
		// Visar login-meddelande.Tilldelad kod.
		public function successfulLogin()
		{
			$this->showMessage("Inloggningen lyckades!");
		}
		
		// Visar login-meddelande för "Håll mig inloggad"-funktionen.Tilldelad kod.
		public function successfulLoginAndCookieCreation()
		{
			$this->showMessage("Inloggningen lyckades och vi kommer ihåg dig nästa gång");
		}
		
		// Visar logout-meddelande.Tilldelad kod.
		public function successfulLogout()
		{
			$this->showMessage("Du har nu loggat ut");
		}

		//Lägger in lyckat lägga till användare meddelande i funktionen showMessage.
		public function successfulRegistration()
		{
			$this->showMessage("Registrering av ny användare lyckades");
		}


		
	}
?>