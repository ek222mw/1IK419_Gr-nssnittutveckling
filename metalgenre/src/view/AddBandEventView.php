<?php

	require_once("common/HTMLView.php");
	

	//Ärver HTMLView.
	class AddBandEventView extends HTMLView{

		
		private $message = "";

		private $createband = "createband";
		private $creatediscography = "discography";
		private $createbiography = "biography";
		private $creategenre = "creategenre";
		private $createeventbutton = "createeventbutton";
		private $createbandeventbutton = "createbandeventbutton";
		private $createbandbutton = "createbandbutton";
		private $dropdownpickgenre = "dropdownpickgenre";
		private $dropdownpickband = "dropdownpickband";

		
		public function __construct(){

			
				
		}

		//Om satt så returnera livespelningsnamnet annars returnera falskt.
		public function getBandName(){

			if(isset($_POST[$this->createband]))
			{
				return $_POST[$this->createband];
			}
			return false;
		}

		public function getBandDiscography(){

			if(isset($_POST[$this->creatediscography]))
			{
				return $_POST[$this->creatediscography];
			}
			return false;
		}

		public function getBandBiography(){

			if(isset($_POST[$this->createbiography]))
			{
				return $_POST[$this->createbiography];
			}
			return false;
		}

		//Om satt så returnera bandnamnet annars returnera falskt.
		public function getGenreName(){

			if(isset($_POST[$this->creategenre]))
			{
				return $_POST[$this->creategenre];
			}
			return false;
		}

		//Kontrollerar om användaren tryckt på lägga till livespelning knappen, returnera sant annars falskt.
		public function didUserPressAddEventButton(){

			if(isset($_POST[$this->createeventbutton]))
			{
				return true;
			}
			return false;

		}

		//Kontrollerar om användaren tryckt på lägga till band till livespelning, returnera sant annars falskt.
		public function didUserPressAddBandToEventButton()
		{
				if(isset($_POST[$this->createbandeventbutton]))
				{
					return true;
				}
			return false;

		}

		//Kontrollerar om användaren tryckt på lägga till band knappen,returnera sant annars falskt. 
		public function didUserPressAddBandButton()
		{

			if(isset($_POST[$this->createbandbutton]))
			{
				return true;
			}
			return false;

		}

		//Om satt så returnera valt livespelningsdropdown värde, annars falskt.
		public function pickedGenreDropdownValue(){

			if(isset($_POST[$this->dropdownpickgenre]))
			{
				return $_POST[$this->dropdownpickgenre];
			}
			return false;
		}

		//Om satt så returnera valt banddropdown värde, annars falskt.
		public function pickedBandDropdownValue(){

			if(isset($_POST[$this->dropdownpickband]))
			{
				return $_POST[$this->dropdownpickband];
			}
			return false;

		}

		//Visar lägga till livespelnings forumläret.
		public function ShowAddBandPage(){

					
				
					$contentString = 
					 "
					<form method=post >
						<fieldset class='fieldaddevent'>
							<legend>Lägga till nytt band - Skriv in nytt band</legend>
							$this->message
							<span style='white-space: nowrap'>Band:<br></span> <input type='text' name='$this->createband'><br>
							<span style='white-space: nowrap'>Biografi:<br></span> <textarea type='text' name='$this->createbiography'></textarea><br>
							<span style='white-space: nowrap'>Discografi:<br></span> <textarea type='text' name='$this->creatediscography'></textarea><br>
							<span style='white-space: nowrap'>Skicka:</span> <input type='submit' name='$this->createeventbutton'  value='Skapa'>
						</fieldset>
					</form>";

					$HTMLbody = "<div class='divaddevent'>
					<h1>Skapa nytt band</h1>
					<p><a href='?login'>Tillbaka</a></p>
					$contentString<br>
					</div>";

					$this->echoHTML($HTMLbody);
			}

			//Visar lägga till band formuläret.
			public function ShowAddGenrePage(){

					
				
					$contentString = 
					 "
					<form method=post >
						<fieldset class='fieldaddband'>
							<legend>Lägga till ny genre - Skriv in genre</legend>
							$this->message
							<span style='white-space: nowrap'>Genre:</span><input type='text' name='$this->creategenre'><br>
							<span style='white-space: nowrap'>Skicka:</span> <input type='submit' name='$this->createbandbutton'  value='Skapa'>
						</fieldset>
					</form>";

					$HTMLbody = "<div class='divaddband'>
					<h1>Skapa ny Genre</h1>
					<p><a href='?login'>Tillbaka</a></p>
					$contentString<br>
					</div>";

					$this->echoHTML($HTMLbody);

			}



			//Visar lägga till band till livespelning formuläret.
			public function ShowAddBandToEventPage(GenreList $genrelist, BandList $bandlist){

			
					
				
					$contentString = 
					 "
					<form method=post >
						<fieldset class='fieldaddbandevent'>
							<legend>Lägga till nytt band till genre</legend>
							$this->message
							<span style='white-space: nowrap'>Genre:</span><br>
							 <select name='$this->dropdownpickgenre'>";
							 foreach($genrelist->toArray() as $genre)
							 {
							 	$contentString.= "<option value='". $genre->getName()."'>".$genre->getName()."</option>";
							 }
							 
							 $contentString .= "</select>
							 <br>
							<span style='white-space: nowrap'>Band:</span><br>
							<select name='$this->dropdownpickband'>";
							 foreach($bandlist->toArray() as $band)
							 {
							 	$contentString.= "<option value='". $band->getName()."'>".$band->getName()."</option>";
							 }
							 
							 $contentString .= "</select><br><br>
							<span style='white-space: nowrap'>Skicka:</span> <input type='submit' name='$this->createbandeventbutton'  value='Lägg till'>
						</fieldset>
					</form>";

					$HTMLbody = "<div class='divaddbandevent'>
					<h1>Lägg till band till vald genre</h1>
					<p><a href='?login'>Tillbaka</a></p>
					$contentString<br>
					</div>";

					$this->echoHTML($HTMLbody);
			}

			//Lägger in, inparameterns sträng i privata variabeln message som sedan skickas till formulären.
			public function showMessage($message)
			{
				$this->message = "<p>" . $message . "</p>";
			}

			//Lägger in lyckat lägga till livespelningsmeddelande i funktionen showMessage.
			public function successfulAddBand()
			{
				$this->showMessage("Bandet lades till!");
			}

			//Lägger in lyckat lägga till bandmeddelande i funktionen showMessage.
			public function successfulAddGenre()
			{
				$this->showMessage("Genren lades till!");
			}

			//Lägger in lyckat lägga till band till livespelning meddelande i funktionen showMessage.
			public function successfulAddBandToGenre()
			{
				$this->showMessage("Bandet har lagt tills i genren");
			}

		


}

