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
						<div class='divaddband'>
							<h3 class='hcolcenteradd'>Lägga till nytt band - Skriv in nytt band</h3>
							<p class='formtext'>$this->message</p>
							<span style='white-space: nowrap' class='formtext'>Band:<br></span> <input type='text' class='formtext' name='$this->createband'><br>
							<span style='white-space: nowrap' class='formtext' >Biografi:<br></span> <textarea type='text' class='formtextarea' name='$this->createbiography'></textarea><br>
							<span style='white-space: nowrap' class='formtext'>Discografi:<br></span> <textarea type='text' class='formtextarea' name='$this->creatediscography'></textarea><br>
							<input type='submit' class='formtext' name='$this->createbandbutton'  value='Skapa'>
						</div>
					</form>";

					$HTMLbody = "<div class='divmenu'>
					<h1 class='hcenter'>Skapa nytt band</h1>
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

			//Visar lägga till livespelnings forumläret.
		public function ShowAddAlbumPage(){

					
				
					$contentString = 
					 "
					<form method=post >
						<div class='divaddband'>
							<h3 class='hcolcenteraddalbum'>Lägga till nytt album - Skriv in nytt album</h3>
							<p class='formtextalbum'>$this->message</p>
							<span style='white-space: nowrap' class='formtextalbum'>Album:<br></span> <input type='text' class='formtextalbum' name='$this->createalbum'><br>
							<span style='white-space: nowrap' class='formtextalbum'>Innehåll:<br></span> <textarea type='text' class='formtextareaalbum' name='$this->contents'></textarea><br>
							<span style='white-space: nowrap' class='formtext'>Medverkande:<br></span> <textarea type='text' class='formtextareaalbum' name='$this->persons'></textarea><br>
							<input class='formtextalbum' type='submit' name='$this->createalbumbutton'  value='Skapa'>
						</div>
					</form>";

					$HTMLbody = "<div class='divmenu'>
					<h1 class='hcenter'>Skapa nytt album</h1>
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

			//Visar lägga till band formuläret.
			public function ShowAddGenrePage(){

					
				
					$contentString = 
					 "
					<form method=post >
						<div class='divaddgenre'>
							<h3 class='hcolcenteraddgenre'>Lägga till ny genre - Skriv in genre</h3>
							<p class='formtextgenre'>$this->message</p>
							<span style='white-space: nowrap' class='formtextgenre'>Genre:<br></span><input type='text' class='formtextsgenre' name='$this->creategenre'><br>
							<input type='submit' class='formtextgenre' name='$this->creategenrebutton'  value='Skapa'>
						</div>
					</form>";

					$HTMLbody = "<div class='divmenu'>
					<h1 class='hcenter'>Skapa ny Genre</h1>
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



			//Visar lägga till band till livespelning formuläret.
			public function ShowAddBandToEventPage(GenreList $genrelist, BandList $bandlist){

			
					
				
					$contentString = 
					 "
					<form method=post >
						<div class='divaddband'>
							<h3 class='hcolcenterbandtogenre'>Lägga till band till genre</h3>
							<p class='formtextbandtogenre'>$this->message</p>
							<span style='white-space: nowrap' class='formtextbandtogenre'>Genre:</span><br>
							 <select class='formtextbandtogenre' name='$this->dropdownpickgenre'>";
							 foreach($genrelist->toArray() as $genre)
							 {
							 	$contentString.= "<option value='". $genre->getName()."'>".$genre->getName()."</option>";
							 }
							 
							 $contentString .= "</select>
							 <br>
							<span class='formtextbandtogenre' style='white-space: nowrap'>Band:</span><br>
							<select class='formtextbandtogenre' name='$this->dropdownpickband'>";
							 foreach($bandlist->toArray() as $band)
							 {
							 	$contentString.= "<option value='". $band->getName()."'>".$band->getName()."</option>";

							 	
							 }
							 
							 $contentString .= "</select><br>";
							$contentString .="<input type='submit' class='formtextbandtogenre' name='$this->createbandeventbutton'  value='Lägg till'>

						</div>
					</form>";

					$HTMLbody = "<div class='divmenu'>
					<h1 class='hcenterlong'>Lägg till band till vald genre</h1>
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


			//Visar lägga till band till livespelning formuläret.
			public function ShowAddBandToAlbumPage(AlbumList $albumlist, BandList $bandlist){

			
					
				
					$contentString = 
					 "
					<form method=post >
						<div class='divaddband'>
							<h3 class='hcolcenterbandtoalbum'>Lägga till band till album</h3>
							<p class='formtextbandtoalbum'>$this->message</p>
							<span style='white-space: nowrap' class='formtextbandtoalbum'>Album:</span><br>
							 <select class='formtextbandtoalbum' name='$this->dropdownpickalbum'>";
							 foreach($albumlist->toArray() as $album)
							 {
							 	$contentString.= "<option value='". $album->getName()."'>".$album->getName()."</option>";
							 }
							 
							 $contentString .= "</select>
							 <br>
							<span class='formtextbandtoalbum' style='white-space: nowrap'>Band:</span><br>
							<select class='formtextbandtoalbum' name='$this->dropdownpickband'>";
							 foreach($bandlist->toArray() as $band)
							 {
							 	$contentString.= "<option value='". $band->getName()."'>".$band->getName()."</option>";

							 	
							 }
							 
							 $contentString .= "</select><br>";
							$contentString .=" <input type='submit' class='formtextbandtoalbum' name='$this->createbandalbumbutton'  value='Lägg till'>

						</div>
					</form>";

					$HTMLbody = "<div class='divmenu'>
					<h1 class='hcenterlong'>Lägg till band till valt album</h1>
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

			//Lägger in, inparameterns sträng i privata variabeln message som sedan skickas till formulären.
			public function showMessage($message)
			{
				$this->message = $message;
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

