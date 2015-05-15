<?php


		require_once("common/HTMLView.php");
	

	//Ärver HTMLView.
	class EditGenreView extends HTMLView{

		
		private $message = "";

		private $dropdownpickeditgenre = "dropdownpickeditgenre";
		private $chooseeditgenrebutton = "chooseeditgenrebutton";
		private $editgenre = "editgenre";
		private $editgenrebutton = "editgenrebutton";
		private $editid = "editid";
		

		
		public function __construct(){

			
				
		}

		//Kontrollerar om användaren tryckt på lägga till band till livespelning, returnera sant annars falskt.
		public function didUserPressChooseGenreButton()
		{
				if(isset($_POST[$this->chooseeditgenrebutton]))
				{
					return true;
				}
			return false;

		}

		public function didUserPressEditGenreButton()
		{
				if(isset($_POST[$this->editgenrebutton]))
				{
					return true;
				}
			return false;

		}

		//Om satt så returnera valt livespelningsdropdown värde, annars falskt.
		public function pickedGenreDropdownValue(){

			if(isset($_POST[$this->dropdownpickeditgenre]))
			{
				return $_POST[$this->dropdownpickeditgenre];
			}
			return false;
		}

		public function getEditGenre(){

			if(isset($_POST[$this->editgenre]))
			{
				return $_POST[$this->editgenre];
			}
			return false;
		}
		public function getGenreID(){

			if(isset($_POST[$this->editid]))
			{
				return $_POST[$this->editid];
			}
			return false;
		}

	

		//Visar lägga till band formuläret.
			public function ShowEditGenrePage(FetchGenreList $fetchgenrelist){

					
				
					$contentString = 
					 "
					<form method=post >
						<div class='diveditgenre'>
							<h3 class='hcolcentereditgenre'>Välj genre att editera </h3>
							$this->message
							<select class='formtexteditgenre' name='dropdownpickeditgenre'>";

								foreach($fetchgenrelist->toArray() as $chooseedit)
								{
									
									$contentString.= "<option value='". $chooseedit->getName()."'>".$chooseedit->getName()."</option>";
								}
										 
								$contentString .= "</select><br>

							<input type='submit' class='formtexteditgenre' name='$this->chooseeditgenrebutton'  value='Välj genre'>
						</div>
					</form>";

					$HTMLbody = "<div class='divmenu'>
					<h1 class='hcenterchedit'>Editera Genre</h1>
					<p class='pcenter'><a href='?login'>Tillbaka</a></p>
					<h2 class='h2menu'>Meny</h2>
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
								</ul>
						</ul>
					</nav>
					
					</div>
					$contentString";

					$this->echoHTML($HTMLbody);

			}

			public function ShowAdminEditGenrePage(GenreList $fetchgenrelist){

					
				
					$contentString = 
					 "
					<form method=post >
						<div class='diveditgenre'>
							<h3 class='hcolcentereditgenre'>Välj genre att editera </h3>
							$this->message
							<select class='formtexteditgenre' name='dropdownpickeditgenre'>";

								foreach($fetchgenrelist->toArray() as $chooseedit)
								{
									
									$contentString.= "<option value='". $chooseedit->getName()."'>".$chooseedit->getName()."</option>";
								}
										 
								$contentString .= "</select><br>

							<input type='submit' class='formtexteditgenre' name='$this->chooseeditgenrebutton'  value='Välj genre'>
						</div>
					</form>";

					$HTMLbody = "<div class='divmenu'>
					<h1 class='hcenterchedit'>Editera Genre</h1>
					<p class='pcenter'><a href='?login'>Tillbaka</a></p>
					<h2 class='h2menu'>Meny</h2>
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
								</ul>
						</ul>
					</nav>
					
					</div>
					$contentString";

					$this->echoHTML($HTMLbody);

			}

			public function ShowChosenEditGenrePage(FetchGenreList $fetchgenrelist, $name){

					
				
					$contentString = 
					 "
					<form method=post >
						<div class='diveditgenre'>
							<h3 class='hcolcentercheditgenre'>Skriv in nytt genre namn</h3>
							$this->message";

								foreach($fetchgenrelist->toArray() as $chooseedit)
								{
									
									$contentString.= "<span class='formtextcheditgenre' style='white-space: nowrap'>Genre:<br></span><input type='text' class='formtextscheditgenre' name='$this->editgenre' value='".$chooseedit->getName() ."'><br>";
								}
								$contentString.= "<span style='white-space: nowrap'></span><input type='hidden' name='$this->editid' value='$name'>";
										 
								
							$contentString .="<input type='submit' class='formtextcheditgenre' name='$this->editgenrebutton'  value='Editera'>
						</div>
					</form>";

					$HTMLbody = "<div class='divmenu'>
					<h1 class='hcenterchedit'>Editera Genre</h1>
					<p class='pcenter'><a href='?login'>Tillbaka</a></p>
					<h2 class='h2menu'>Meny</h2>
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
								</ul>
						</ul>
					</nav>
					
					</div>
					$contentString";

					$this->echoHTML($HTMLbody);

			}

			public function showMessage($message)
			{
				$this->message = "<p>" . $message . "</p>";
			}

			public function successfulEditGenre()
			{
				$this->showMessage("Genren har editerats!");
			}




	}

