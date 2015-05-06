<?php

	require_once("common/HTMLView.php");
	
	
	//Ärver HTMLView.
	class AddRatingView extends HTMLView {

		
		private $message = "";
		

		private $creategradebutton = "creategradebutton";
		private $dropdownpickgrade = "dropdownpickgrade";
		private $chooseeventbutton = "chooseeventbutton";
		private $chooseothereventbutton = "chooseothereventbutton";

		
		public function __construct(){

				
		}

		//kontrollerar om användaren tryckt på lägga till betyg knappen, returnera true annars falskt.
		public function didUserPressAddGradeButton(){

			if(isset($_POST[$this->creategradebutton]))
			{
				return true;
			}
			return false;
		}

		public function didUserPressGenre(){
			if(isset($_GET['genrename'])){
				return true;
			}
			return false;
		}

		public function didUserPressAlbum(){
			if(isset($_GET['albumname'])){
				return true;
			}
			return false;
		}

		//Om satt så returnera valt betyg i dropdownen annars returnera falskt.
		public function pickedGradeDropdownValue(){

			if(isset($_POST[$this->dropdownpickgrade]))
			{
				return $_POST[$this->dropdownpickgrade];
			}
			return false;

		}

		public function getGenreID(){
			return $_GET['genrename'];
		}

		public function getAlbumID(){
			return $_GET['albumname'];
		}


		//Om användaren tryckt på livespelningsknappen i betygsformuläret så returnera true annars falskt.
		public function didUserPressChooseGradeEvent()
		{
			if(isset($_POST[$this->chooseeventbutton]))
			{
				return true;
			}
			return false;
			
		}

		//Om användaren tryckt på välja annan livespelning knappen i betygsformuläret så returnera true annars falskt.
		public function didUserPressChooseOtherGradeEvent()
		{
			if(isset($_POST[$this->chooseothereventbutton]))
			{
				return true;
			}
			return false;
		}

		//Visar lägga till betyg formuläret.
		public function ShowAddRatingPage(AlbumBandList $albumbandlist){

					
	
					$contentString = "
					<form method=post ><fieldset class='fieldaddrating'>
					<legend>Lägga till nytt betyg till album med följande band</legend>
					$this->message
					<span style='white-space: nowrap'>Album:</span>
					<select name='dropdownpickalbum'>";

					foreach($albumbandlist->toArray() as $album)
					{
						$contentString.= "<option value='". $album->getName()."'>".$album->getName()."</option>";
					}
							 
					$contentString .= "</select>";
					$contentString .= "<input type='submit' name='$this->chooseeventbutton'  value='Välj album'>";		 
					$contentString .= "</fieldset></form>";

					$HTMLbody = "<div class='divaddrating'>
					<h1>Lägg till betyg till valt album med band</h1>
					<p><a href='?login'>Tillbaka</a></p>
					$contentString<br>
					</div>";

					$this->echoHTML($HTMLbody);
			
			}

			//Visar vald livespelning för att lägga till betyg till livespelningar med band formulär.
			public function ShowChosenEventRatingPage(AlbumBandList $albumbandlist, AlbumBandList $bandeventlist, GradeList $gradelist){

			
			
					

					$contentString = "<form method=post><fieldset class='fieldaddchosenrating'>
					<legend>Lägga till nytt betyg till spelning med följande band</legend>
					$this->message
					<span style='white-space: nowrap'>Livespelning:</span><br>
					<select name='dropdownpickevent'>";

					foreach($albumbandlist->toArray() as $album)
					{
						$contentString.= "<option value='". $album->getName()."'>".$album->getName()."</option>";
					}
							 
					$contentString .= "</select>
					<input type='submit' name='$this->chooseothereventbutton'  value='Välj en annan livespelning'><br>
					<span style='white-space: nowrap'>Band:</span><br>
					<select name='dropdownpickband'>";

					foreach($bandeventlist->toArray() as $band)
					{
						$contentString.= "<option value='". $band->getName()."'>".$band->getName()."</option>";
					}
							 
					$contentString .= "</select><br>
					<span style='white-space: nowrap'>Betyg:</span><br>
					<select name='$this->dropdownpickgrade'>";

					foreach($gradelist->toArray() as $grade)
					{
						$contentString.= "<option value='". $grade->getGrade()."'>".$grade->getGrade()."</option>";
					}
							 
					$contentString .= "</select><br>
					Skicka: <input type='submit' name='$this->creategradebutton'  value='Lägg till Betyg'>
					</fieldset></form>";

					$HTMLbody = "<div class='divaddchosenrating'>
					<h1>Lägg till betyg till vald spelning med band</h1>
					<p><a href='?login'>Tillbaka</a></p>
					$contentString<br>
					</div>";

					$this->echoHTML($HTMLbody);
			
			}

			//Visar samlingssidan för livespelningar med band, användare och betyg.
			public function ShowAllEventsWithBandGrades(ShowEventList $showeventlist)
			{
				
					$contentString ="<form method=post ><h3>Visar Alla event</h3>";
	
					foreach($showeventlist->toArray() as $event)
					{
							 	
						$contentString .= "<fieldset class='fieldshowall'><span class='spangradient'  style='white-space: nowrap'>Livespelning:</span>";
						$contentString.= "<p class='pgradient'>".$event->getEvent()."</p>";
						$contentString .= "<span class='spangradient' style='white-space: nowrap'>Band:<span>";
						$contentString.= "<p class='pgradient'>".$event->getBand()."</p>";
						$contentString .= "<span class='spangradient' style='white-space: nowrap'>Betyg:</span>";
						$contentString.= "<p class='pgradient'>".$event->getGrade()."</p>";
						$contentString .= "<span class='spangradient' style='white-space: nowrap'>Användare:</span>";
						$contentString.= "<p class='pgradient'>".$event->getUser()."</p>";
						$contentString .= "</fieldset>";
					}
							 
					$contentString .= "</form>";

					

					$HTMLbody = "<div class='divshowall'>
					<h1>Visar alla events med band och betyg</h1>
					<p><a href='?login'>Tillbaka</a></p>
					$contentString</div>";

					$this->echoHTML($HTMLbody);


			}

			public function ShowAllGenres(GenreList $showgenrelist)
			{
				
					$contentString ="<form method=post>";
	
					foreach($showgenrelist->toArray() as $genre)
					{
							 	
						$contentString .= "<fieldset class='fieldshowall'><span class='spangradient'  style='white-space: nowrap'>Genre</span><br>";
						$contentString.= "<p class='pgradient'>".$genre->getName()."</p>";
						$contentString .= "<a href='?showgenres&genrename=".$genre->getName()."'>Show Bands</a> ";
						$contentString .= "</fieldset>";
					}
							 
					$contentString .= "</form>";

					

					$HTMLbody = "<div class='divshowall'>
					<h1>Visar alla genres</h1>
					<p><a href='?login'>Tillbaka</a></p>
					$contentString</div>";

					$this->echoHTML($HTMLbody);


			}

			public function ShowGenre(BandList $showbandlist, $genre)
			{
				
					$contentString ="<form method=post >";
	
					foreach($showbandlist->toArray() as $band)
					{
							 	
						$contentString .= "<fieldset class='fieldshowall'><h3>Band</h3>";
							
						$contentString.= "<p class='pgradient'>".$band->getName()."</p>";
						$contentString.= "<h3>Biografi</h3>";
						$contentString.= "<p class='pgradient'>".$band->getBioGraphy()."</p>";
						$contentString.="<h3>Discografi</h3>";
						$contentString.= "<p class='pgradient'>".$band->getDiscoGraphy()."</p><br>";
						$contentString .= "<a href='?showgenres&albumname=".$band->getName()."'>Show Albums</a> ";
						$contentString .= "</fieldset>";
					}
							 
					$contentString .= "</form>";

					

					$HTMLbody = "<div class='divshowall'>
					<h1>$genre</h1>
					<p><a href='?login'>Tillbaka</a></p>
					$contentString</div>";

					$this->echoHTML($HTMLbody);


			}

			public function ShowAlbum(AlbumList $showalbumlist, $band)
			{
				
					$contentString ="<form method=post >";
	
					foreach($showalbumlist->toArray() as $album)
					{
							 	
						$contentString .= "<fieldset class='fieldshowall'><h3>Album</h3>";
							
						$contentString.= "<p class='pgradient'>".$album->getName()."</p>";
						$contentString.= "<h3>Innehåll</h3>";
						$contentString.= "<p class='pgradient'>".$album->getContents()."</p>";
						$contentString.="<h3>Personer</h3>";
						$contentString.= "<p class='pgradient'>".$album->getPersons()."</p>";
						$contentString .= "</fieldset>";
					}
							 
					$contentString .= "</form>";

					

					$HTMLbody = "<div class='divshowall'>
					<h1>$band</h1>
					<p><a href='?login'>Tillbaka</a></p>
					$contentString</div>";

					$this->echoHTML($HTMLbody);


			}


			//Lägger in, inparameterns sträng i privata variabeln message som sedan skickas till formulären.
			public function showMessage($message)
			{
				$this->message = "<p>" . $message . "</p>";
			}

			//Lägger in lyckat lägga till betyg till livespelning med band meddelande i funktionen showMessage.
			public function successfulAddGradeToEventWithBand()
			{
				$this->showMessage("Betyget har lagts till livespelning med band!");
			}





	}