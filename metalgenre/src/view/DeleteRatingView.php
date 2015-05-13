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
				$contentString .=  "<form method=post >";
				$contentString .= "<fieldset class='fielddeleterating'><legend>Ta bort betyg</legend><br><span class='spangradient' style='white-space: nowrap'>Album:</span>";
				$contentString.= "<p class='pgradient'>".$grade->getAlbum()."</p>";
				$contentString .= "<span class='spangradient' style='white-space: nowrap'>Betyg:</span>";
				$contentString.= "<p class='pgradient'>".$grade->getGrade()."</p>";
				$contentString .= "<span class='spangradient' style='white-space: nowrap'>Användare:</span>";
				$contentString.= "<p class='pgradient'>".$grade->getUser()."</p>"; 
				$contentString.= "<input type='hidden' name='$this->pickeddeleteid' value='". $grade->getID() ."'>";
				$contentString.= "<input type='submit' name='$this->deletegradebutton' value='Ta bort betyg'>";
				$contentString .= "</fieldset>";
				$contentString .= "</form>";
			}
	
			$HTMLbody = "<div class='divdeletegrade'>
			<h1>Ta bort betyg till valt album</h1>
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
			$contentString
			</div>";

			$this->echoHTML($HTMLbody);
		}

		//Lägger in, inparameterns sträng i privata variabeln message som sedan skickas till formulären.
		public function showMessage($message)
		{
			$this->message = "<p>" . $message . "</p>";
		}

		//Lägger in lyckat ta bort betyg meddelande i funktionen showMessage.
		public function successfulDeleteGradeToEventWithBand()
		{
				$this->showMessage("Betyget har tagits bort!");
		}


	}