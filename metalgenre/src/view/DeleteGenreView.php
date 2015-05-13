<?php


		require_once("common/HTMLView.php");
	

	//Ärver HTMLView.
	class DeleteGenreView extends HTMLView{

		
		private $message = "";

		private $dropdownpickdeletegenre = "dropdownpickdeletegenre";
		private $choosedeletegenrebutton = "choosedeletegenrebutton";
		private $deletegenre = "deletegenre";
		private $deletegenrebutton = "deletegenrebutton";
		private $deleteid = "deleteid";
		

		
		public function __construct(){

			
				
		}

		//Kontrollerar om användaren tryckt på lägga till band till livespelning, returnera sant annars falskt.
		public function didUserPressChooseGenreButton()
		{
				if(isset($_POST[$this->choosedeletegenrebutton]))
				{
					return true;
				}
			return false;

		}

		public function didUserPressDeleteGenreButton()
		{
				if(isset($_POST[$this->deletegenrebutton]))
				{
					return true;
				}
			return false;

		}

		//Om satt så returnera valt livespelningsdropdown värde, annars falskt.
		public function pickedGenreDropdownValue(){

			if(isset($_POST[$this->dropdownpickdeletegenre]))
			{
				return $_POST[$this->dropdownpickdeletegenre];
			}
			return false;
		}

		public function getDeleteGenre(){

			if(isset($_POST[$this->deletegenre]))
			{
				return $_POST[$this->deletegenre];
			}
			return false;
		}
		public function getGenreID(){

			if(isset($_POST[$this->deleteid]))
			{
				return $_POST[$this->deleteid];
			}
			return false;
		}

	

		//Visar lägga till band formuläret.
			public function ShowDeleteGenrePage(FetchGenreList $fetchgenrelist){

					
				
					$contentString = 
					 "
					<form method=post >
						<fieldset class='fieldaddband'>
							<legend>Välj genre att ta bort</legend>
							$this->message
							<select name='dropdownpickdeletegenre'>";

								foreach($fetchgenrelist->toArray() as $choosedelete)
								{
									
									$contentString.= "<option value='". $choosedelete->getName()."'>".$choosedelete->getName()."</option>";
								}
										 
								$contentString .= "</select>

							<span style='white-space: nowrap'></span> <input type='submit' name='$this->choosedeletegenrebutton'  value='Välj genre'>
						</fieldset>
					</form>";

					$HTMLbody = "<div class='divaddband'>
					<h1>Ta bort Genre</h1>
					<p><a href='?login'>Tillbaka</a></p>
					<h2>Meny</h2>
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
					$contentString<br>
					</div>";

					$this->echoHTML($HTMLbody);

			}

				public function ShowAdminDeleteGenrePage(GenreList $fetchgenrelist){

					
				
					$contentString = 
					 "
					<form method=post >
						<fieldset class='fieldaddband'>
							<legend>Välj genre att ta bort</legend>
							$this->message
							<select name='dropdownpickdeletegenre'>";

								foreach($fetchgenrelist->toArray() as $choosedelete)
								{
									
									$contentString.= "<option value='". $choosedelete->getName()."'>".$choosedelete->getName()."</option>";
								}
										 
								$contentString .= "</select>

							<span style='white-space: nowrap'></span> <input type='submit' name='$this->choosedeletegenrebutton'  value='Välj genre'>
						</fieldset>
					</form>";

					$HTMLbody = "<div class='divaddband'>
					<h1>Ta bort Genre</h1>
					<p><a href='?login'>Tillbaka</a></p>
					<h2>Meny</h2>
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
					$contentString<br>
					</div>";

					$this->echoHTML($HTMLbody);

			}

			public function ShowChosenDeleteGenrePage(FetchGenreList $fetchgenrelist, $name){

					
				
					$contentString = 
					 "
					<form method=post >
						<fieldset class='fieldaddband'>
							<legend>Ta bort genre</legend>
							$this->message";

								foreach($fetchgenrelist->toArray() as $choosedelete)
								{
									
									$contentString.= "<span style='white-space: nowrap'>Genre:</span><p name='$this->deletegenre' >".$choosedelete->getName() ."</p>";
								}
								$contentString.= "<span style='white-space: nowrap'></span><input type='hidden' name='$this->deleteid' value='$name'><br>";
										 
								
							$contentString .="<span style='white-space: nowrap'></span> <input type='submit' name='$this->deletegenrebutton'  value='Ta bort'>
						</fieldset>
					</form>";

					$HTMLbody = "<div class='divaddband'>
					<h1>Ta bort genre</h1>
					<p><a href='?login'>Tillbaka</a></p>
					<h2>Meny</h2>
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
					$contentString<br>
					</div>";

					$this->echoHTML($HTMLbody);

			}

			public function showMessage($message)
			{
				$this->message = "<p>" . $message . "</p>";
			}

			public function successfulDeleteGenre()
			{
				$this->showMessage("Genren har tagits bort!");
			}




	}

