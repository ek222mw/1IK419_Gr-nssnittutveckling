<?php

	require_once("common/HTMLView.php");
	

	//Ärver HTMLView
	class DeleteRatingView extends HTMLView {

		
		private $message = "";

		private $deletegradebutton = "deletegradebutton";
		private $pickeddeleteid = "pickeddeleteid";

		
		public function __construct(){

				
		}

		//Kollar om användaren tryckt på ta bort betyg knappen, returnera sant annars falskt.
		public function didUserPressDeleteGradeButton()
		{
			if(isset($_POST[$this->deletegradebutton]))
			{
				return true;
			}
			return false;
		}

		//Kollar om användaren valt ett värde i inputen, returnera värdet annars falskt.
		public function getDeletePickedValue()
		{
			if(isset($_POST[$this->pickeddeleteid]))
			{
				return $_POST[$this->pickeddeleteid];
			}
			return false;
		}

		//Visar ta bort betyg forumläret.
		public function ShowDeleteRatingPage(DeleteGradeList $deletegradelist)
		{
			
			

			$contentString = "$this->message";
			foreach($deletegradelist->toArray() as $grade)
			{
				$contentString .=  "<form class='editgradeform' method=post >";
				$contentString .= "<div class='diveditgrade'>
				<h3 class='hcolcenter'>Ta bort betyg</h3><br>
				<span class='formtexteditgrade' style='white-space: nowrap'>Album:</span>";
				$contentString.= "<p class='formtexteditgrade'>".$grade->getAlbum()."</p>";
				$contentString .= "<span class='formtexteditgrade' style='white-space: nowrap'>Betyg:</span>";
				$contentString.= "<p class='formtexteditgrade'>".$grade->getGrade()."</p>";
				$contentString .= "<span class='formtexteditgrade' style='white-space: nowrap'>Användare:</span>";
				$contentString.= "<p class='formtexteditgrade'>".$grade->getUser()."</p>"; 
				$contentString.= "<input type='hidden' name='$this->pickeddeleteid' value='". $grade->getID() ."'>";
				$contentString.= "<input type='submit' class='formsubmitcol' name='$this->deletegradebutton' value='Ta bort betyg'>";
				$contentString .= "</div>";
				$contentString .= "</form>";
			}
	
			$HTMLbody = "<div class='divmenu'>
			<h1 class='hcenterlong'>Ta bort betyg på valt album</h1>
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
			$this->message = "<p class=messagecenter>" . $message . "</p>";
		}

		//Lägger in lyckat ta bort betyg meddelande i funktionen showMessage.
		public function successfulDeleteGradeToEventWithBand()
		{
				$this->showMessage("Betyget har tagits bort!");
		}


	}