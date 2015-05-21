<?php

	require_once("common/HTMLView.php");
	require_once("./src/model/DBDetails.php");

	
	
	//Ärver HTMLView.
	class AddRatingView extends HTMLView {

		
		private $message = "";
		private $db;
		

		private $creategradebutton = "creategradebutton";
		private $dropdownpickgrade = "dropdownpickgrade";
		private $chooseeventbutton = "chooseeventbutton";
		private $chooseothereventbutton = "chooseothereventbutton";


		
		public function __construct(){

				$this->db = new DBDetails();
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
		public function ShowAddRatingPage(AlbumBandList $albumbandlist, GradeList $gradelist){

					
	
					$contentString = "
					<form method=post >
					<div class='diveditgenre'>
					<h3 class='centercol'>Lägga till nytt betyg till album</h3>
					$this->message
					<p class='centercol'>Album:</p>
					<select class='hcolcenterallinput' name='dropdownpickalbum'>";

					foreach($albumbandlist->toArray() as $album)
					{
						$contentString.= "<option value='". $album->getName()."'>".$album->getName()."</option>";
					}
							 
					$contentString .= "</select><br>";
					$contentString .= "<p class='centercol' >Betyg:</p>
					<select class='hcolcenterallinput' name='$this->dropdownpickgrade'>";

					foreach($gradelist->toArray() as $grade)
					{
						$contentString.= "<option value='". $grade->getGrade()."'>".$grade->getGrade()."</option>";
					}
							 
					$contentString .= "</select><br>";
					$contentString .= "<input type='submit' class='hcolcenterall' name='$this->creategradebutton'  value='Lägg till Betyg'>";		 
					$contentString .= "</div></form>";

					$HTMLbody = "<div class='divmenu'>
					<h1 class='hcenterxlong'>Lägg till betyg till valt album</h1>
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

			//Visar lägga till betyg formuläret.
		public function ShowContact(){

					
	
					$contentString = "
					<form method=post >
					<div class='diveditgenre'>
					<h3 class='centercol'>Kontaktformulär</h3>
					";


					$contentString .= "

					<form name='contactForm' id='contactForm' method='post'  action='http://www.mycontactform.com/sendform/sendform.php'>
					<table summary='This table contains contact form fields.'' width='100%' cellpadding='0' cellspacing='0'>
					 <tr id='trstyle'>
					  <td id='tdstyle'>
					  <label class='centertext' for='subject'>Ämne: <span style='color: #FF0000'>*</span></label><br>
					  <input class='centertextinput' name='subject' type='text' id='subject' size='20' maxlength='100' style='font-family: Arial; font-size: 14px; color: #000000; background-color: #FFFFFF; border: 1px solid #000000; padding: 2px;' required='required' />
					  </td>
					 </tr>
					 <tr id='trstyle'>
					  <td id='tdstyle'>
					  <label class='centertext' for='email' >E-mail Adress: <span style='color: #FF0000'>*</span></label><br>
					  <input class='centertextinput' name='email' type='email' id='email' size='20' maxlength='100' required='required' style='font-family: Arial; font-size: 14px; color: #000000; background-color: #FFFFFF; border: 1px solid #000000; padding: 2px;' />
					  </td>
					 </tr>
					 <tr id='trstyle'>
					  <td id='tdstyle'>
					  <label class='centertext' for='q1' >Ditt namn: <span style='color: #FF0000'>*</span></label><br>
					   <input class='centertextinput' name='q1' id='q1' type='text' value='Skriv in ditt namn här.' size='20' maxlength='40' style='font-family: Arial; font-size: 14px; color: #000000; background-color: #FFFFFF; border: 1px solid #000000; padding: 2px;' required='required'/>
					  </td>
					 </tr>
					 <tr id='trstyle'>
					  <td id='tdstyle'>
					  <label class='centertext' for='q3' >Din fråga: <span style='color: #FF0000'>*</span></label><br>
					   <textarea class='centertextinput' name='q3' id='q3'  required='required'>Skriv in din fråga här.</textarea>
					  </td>
					 </tr>
					<tr id='trstyle'>
					  <td id='tdstyle'>
					<hr style='color: #D8D8D8; background-color: #D8D8D8; height: 1px;' />
					 </td>
					 </tr>
					<tr id='trstyle'>
					  <td id='tdstyle'>
					   <input name='user' type='hidden' id='user' value='krochen' />
					   <input name='formid' type='hidden' id='formid' value='414464' />
					   <input class='centertext'name='submit' type='submit' value='Skicka'  />
					   <input  name='reset' type='reset' value='Återställ'  />
					   <input  type='button' value='Skriv ut' onClick='window.print()' /><br><br>
					 </td>
					 </tr>
					<tr style='margin: 0; padding: 0;'>
					  <td style='background-color: #bac4cc; padding: 5px; clear: left; margin: 0;'>
					<span style='color: #FF0000'>*</span> <span style='font-family: Arial; color: #000000; font-size: 14px;'>Nödvändiga</span> <span style='float: right; font-family: Arial; color: #000000; font-size: 14px;'><a href='http://www.mycontactform.com' target='_blank' title='Link to myContactForm.com'>Free Contact Form</a></span> </td>
					 </tr>
					</table>
					</form>


					";

					

					$HTMLbody = "
					<h1 class='centercol'>Kontaktformulär</h1>
					<div class='divmenu'>
					
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
									<li><a href='?showcontact'>Visa Kontaktformulär</a></li>
								</ul>
						</ul>
					</nav>
					
					</div>
					$contentString";

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
									<li><a href='?showcontact'>Visa Kontaktformulär</a></li>
								</ul>
						</ul>
					</nav>
					$contentString<br>
					</div>";

					$this->echoHTML($HTMLbody);
			
			}

			//Visar samlingssidan för livespelningar med band, användare och betyg.
			public function ShowAllAlbumsWithGrades(ShowEventList $showeventlist)
			{
				
					$contentString ="<form  method=post >";
	
					foreach($showeventlist->toArray() as $event)
					{
						
						$contentString .= "<div class='divshowspecgrade'>
						<p class='centercol'>Album:</p>";
						$contentString.= "<p class='centercol'>".$event->getAlbum()."</p>";
						$contentString .= "<p class='centercol' >Betyg:</p>";
						$contentString.= "<p class='centercol'>".$event->getGrade()."</p>";
						$contentString .= "<p class='centercol'>Användare:</p>";
						$contentString.= "<p class='centercol'>".$event->getUser()."</p>";
						$contentString .= "</div>";
					}
							 
					$contentString .= "</form>";

					

					$HTMLbody = "<div class='divmenu'>
					<h1 class='hcenterlong'>Visar alla album med betyg</h1>
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
									<li><a href='?showcontact'>Visa Kontaktformulär</a></li>
								</ul>
						</ul>
					</nav>
					</div>
					$contentString";

					$this->echoHTML($HTMLbody);


			}

			public function ShowAllGenres(GenreList $showgenrelist)
			{
					//standard bild från adress http://suptg.thisisnotatrueending.com/archive/5237253/images/1248382528677.png
					$contentString ="<form method=post>";
					$dir = "././Pics/*.png";
					//get the list of all files with .jpg extension in the directory and safe it in an array named $images
					$images = glob( $dir );
					foreach($showgenrelist->toArray() as $genre)
					{
						foreach( $images as $image ):
						if($image === $genre->getImgpath())
						$contentString.= "<div class='Gallery'><a title='".$genre->getName()."' href='?showgenres&genrename=".$genre->getName()."'><img src='" . $image . "' /></a></div>";
						endforeach;
					}
							 
					$contentString .= "</form>";

					

					$HTMLbody = "<div class='divmenu'>
					<h1 class='hcenter'>Visar alla genres</h1>
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
									<li><a href='?showcontact'>Visa Kontaktformulär</a></li>
								</ul>
						</ul>
					</nav>
					

					</div>
					$contentString";

					$this->echoHTML($HTMLbody);


			}

			public function ShowGenre(BandList $showbandlist, $genre)
			{
				$contentString ="<form  method=post>";
					

					foreach($showbandlist->toArray() as $band)
					{
						$contentString .= "<div class='divshowspecgenreout'>";
						//standard bild från adress http://suptg.thisisnotatrueending.com/archive/5237253/images/1248382528677.png
					
						$dir = "././Pics/*.jpg";
						//get the list of all files with .jpg extension in the directory and safe it in an array named $images
						$images = glob( $dir );
							 	
						
						 $contentString .="<div class='divshowspecgenre'>";
							
						foreach( $images as $image )
						{

						
							if($image === $band->getImgpath())
							{
								$contentString.= "<img class='img' src='" . $image . "' />";
							}
						}
						$contentString .= "<h3 class='centercol'>Band</h3>";
						$contentString.= "<p class='centercol'>".$band->getName()."</p>";
						$contentString.= "<h3 class='centercol'>Biografi</h3>";
						$contentString.= "<p class='textcol'>".$band->getBioGraphy()."</p>";
						$contentString.="<h3 class='centercol'>Discografi</h3>";
						$contentString.= "<p class='textcol'>".$band->getDiscoGraphy()."</p>";
						$contentString .= "<div class='Gallery1'><a title='Show Albums' href='?showgenres&albumname=".$band->getName()."'><img src='././Pics/bandlink.jpg' /></a></div> ";
						$contentString .= "</div></div>";

					}
					$contentString .= "</form>";

							 
					

					

					$HTMLbody = "
					<h1 class='centercol'>$genre</h1>
					<div class='divmenu'>
					
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
									<li><a href='?showcontact'>Visa Kontaktformulär</a></li>
								</ul>
						</ul>
					</nav>
					</div>
					$contentString";

					$this->echoHTML($HTMLbody);


			}

			public function ShowAlbum(AlbumList $showalbumlist, $band)
			{
				
					$contentString ="<form method=post >";
					
				
					foreach($showalbumlist->toArray() as $album)
					{	
						$grade = $this->db->fetchShowGrade($album->getName());
						$dir = "././Pics/*.jpg";
						//get the list of all files with .jpg extension in the directory and safe it in an array named $images
						$images = glob( $dir );
							
						$contentString .= "<div class='divshowspecgenre'>";
						foreach( $images as $image )
						{

						
							if($image === $album->getImgpath())
							{
								$contentString.= "<img class='img' src='" . $image . "' />";
							}
						}
						$contentString.= "<h3 class='centercol'>Betyg</h3>";
						foreach ($grade as $value) {

								$contentString.= "<nobr class='nobr'>".$value[0].", <wbr></nobr>";
						
						}
						
						$contentString.= "<h3 class='centercol'>Album</h3>";
						$contentString.= "<p class='centercol'>".$album->getName()."</p>";
						$contentString.= "<h3 class='centercol'>Innehåll</h3>";
						$contentString.= "<p class='textcol'>".$album->getContents()."</p>";
						$contentString.="<h3 class='centercol'>Personer</h3>";
						$contentString.= "<p class='textcol'>".$album->getPersons()."</p>";
						$contentString .= "</div>";
					}
							 
					$contentString .= "</form>";

					

					$HTMLbody = "
					<h1 class='centercol'>$band</h1>
					<div class='divmenu'>
					
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
									<li><a href='?showcontact'>Visa Kontaktformulär</a></li>
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
				$this->message = "<p class='centercol'>" . $message . "</p>";
			}

			//Lägger in lyckat lägga till betyg till livespelning med band meddelande i funktionen showMessage.
			public function successfulAddGradeToEventWithBand()
			{
				$this->showMessage("Betyget har lagts till album med band!");
			}





	}