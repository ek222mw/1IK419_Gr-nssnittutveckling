<?php

	require_once("common/HTMLView.php");
	

	//Ärver HTMLView.
	class AddBandEventView extends HTMLView{

		
		private $message = "";

		private $createband = "createband";
		private $creatediscography = "discography";
		private $createbiography = "biography";
		private $creategenre = "creategenre";
		private $createalbum = "createalbum";
		private $contents = "contents";
		private $persons = "persons";
		private $createbandbutton = "createbandbutton";
		private $createalbumbutton = "createalbumbutton";
		private $createbandeventbutton = "createbandeventbutton";
		private $createbandalbumbutton = "createbandalbumbutton";
		private $creategenrebutton = "creategenrebutton";
		private $dropdownpickalbum = "dropdownpickalbum";
		private $dropdownpickgenre = "dropdownpickgenre";
		private $dropdownpickband = "dropdownpickband";
		private $biography = "biography";
		private $discography ="discography";

		
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

		public function getAlbumName(){

			if(isset($_POST[$this->createalbum]))
			{
				return $_POST[$this->createalbum];
			}
			return false;
		}


		public function getContents(){

			if(isset($_POST[$this->contents]))
			{
				return $_POST[$this->contents];
			}
			return false;
		}

		public function getPersons(){

			if(isset($_POST[$this->persons]))
			{
				return $_POST[$this->persons];
			}
			return false;
		}

		//Kontrollerar om användaren tryckt på lägga till livespelning knappen, returnera sant annars falskt.
		public function didUserPressAddGenreButton(){

			if(isset($_POST[$this->creategenrebutton]))
			{
				return true;
			}
			return false;

		}

		public function didUserPressAddAlbumButton(){

			if(isset($_POST[$this->createalbumbutton]))
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

		public function didUserPressAddBandToAlbumButton()
		{
				if(isset($_POST[$this->createbandalbumbutton]))
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

		public function pickedAlbumDropdownValue(){

			if(isset($_POST[$this->dropdownpickalbum]))
			{
				return $_POST[$this->dropdownpickalbum];
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
							<span style='white-space: nowrap'>Skicka:</span> <input type='submit' name='$this->createbandbutton'  value='Skapa'>
						</fieldset>
					</form>";

					$HTMLbody = "<div class='divaddevent'>
					<h1>Skapa nytt band</h1>
					<p><a href='?login'>Tillbaka</a></p>
					$contentString<br>
					</div>";

					$this->echoHTML($HTMLbody);
			}

			//Visar lägga till livespelnings forumläret.
		public function ShowAddAlbumPage(){

					
				
					$contentString = 
					 "
					<form method=post >
						<fieldset class='fieldaddevent'>
							<legend>Lägga till nytt album - Skriv in nytt album</legend>
							$this->message
							<span style='white-space: nowrap'>Album:<br></span> <input type='text' name='$this->createalbum'><br>
							<span style='white-space: nowrap'>Innehåll:<br></span> <textarea type='text' name='$this->contents'></textarea><br>
							<span style='white-space: nowrap'>Medverkande:<br></span> <textarea type='text' name='$this->persons'></textarea><br>
							<span style='white-space: nowrap'>Skicka:</span> <input type='submit' name='$this->createalbumbutton'  value='Skapa'>
						</fieldset>
					</form>";

					$HTMLbody = "<div class='divaddevent'>
					<h1>Skapa nytt album</h1>
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
							<span style='white-space: nowrap'>Skicka:</span> <input type='submit' name='$this->creategenrebutton'  value='Skapa'>
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
							 
							 $contentString .= "</select><br><br>";
							$contentString .="<span style='white-space: nowrap'>Skicka:</span> <input type='submit' name='$this->createbandeventbutton'  value='Lägg till'>

						</fieldset>
					</form>";

					$HTMLbody = "<div class='divaddbandevent'>
					<h1>Lägg till band till vald genre</h1>
					<p><a href='?login'>Tillbaka</a></p>
					$contentString<br>
					</div>";

					$this->echoHTML($HTMLbody);
			}


			//Visar lägga till band till livespelning formuläret.
			public function ShowAddBandToAlbumPage(AlbumList $albumlist, BandList $bandlist){

			
					
				
					$contentString = 
					 "
					<form method=post >
						<fieldset class='fieldaddbandevent'>
							<legend>Lägga till nytt band till album</legend>
							$this->message
							<span style='white-space: nowrap'>Album:</span><br>
							 <select name='$this->dropdownpickalbum'>";
							 foreach($albumlist->toArray() as $album)
							 {
							 	$contentString.= "<option value='". $album->getName()."'>".$album->getName()."</option>";
							 }
							 
							 $contentString .= "</select>
							 <br>
							<span style='white-space: nowrap'>Band:</span><br>
							<select name='$this->dropdownpickband'>";
							 foreach($bandlist->toArray() as $band)
							 {
							 	$contentString.= "<option value='". $band->getName()."'>".$band->getName()."</option>";

							 	
							 }
							 
							 $contentString .= "</select><br><br>";
							$contentString .="<span style='white-space: nowrap'>Skicka:</span> <input type='submit' name='$this->createbandalbumbutton'  value='Lägg till'>

						</fieldset>
					</form>";

					$HTMLbody = "<div class='divaddbandevent'>
					<h1>Lägg till band till valt album</h1>
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

			public function successfulAddAlbum()
			{
				$this->showMessage("Albumet lades till!");
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

			public function successfulAddBandToAlbum()
			{
				$this->showMessage("Albumet har kopplats till bandet");
			}

		


}

