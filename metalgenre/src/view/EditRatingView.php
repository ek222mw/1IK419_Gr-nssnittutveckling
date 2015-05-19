<?php

	require_once("common/HTMLView.php");
	

	//Ärver HTMLView
	class EditRatingView extends HTMLView {


		
		private $message = "";

		private $editbutton = "editbutton";
		private $pickededitid = "pickededitid";
		private $pickedid = "pickedid";
		private $dropdownneweditgrade = "dropdownneweditgrade";
		private $editgradebutton = "editgradebutton";


		
		public function __construct(){

				
		}

		//Kollar om användaren tryckt på vald editeringsknapp, returnera sant annars falskt.
		public function didUserPressEditPickedButton()
		{
			if(isset($_POST[$this->editbutton]))
			{
				return true;
			}
			return false;
		}

		//Kollar om användaren valt ett värde i inputen, om så returnera värdet annars falskt.
		public function getEditPickedValue()
		{
			if(isset($_POST[$this->pickededitid]))
			{
				return $_POST[$this->pickededitid];
			}
			return false;
		}

		//Kollar om användaren valt ett värde i inputen, om så returnera värdet annars falskt.
		public function getEditPickedValueSaved()
		{
			if(isset($_POST[$this->pickedid]))
			{
				return $_POST[$this->pickedid];
			}
			return false;
		}


		//Kollar om användaren valt ett värde i editeringsdropdownen, returnera värdet annars falskt.
		public function getDropdownPickedEditGrade()
		{
			if(isset($_POST[$this->dropdownneweditgrade]))
			{
				return $_POST[$this->dropdownneweditgrade];
			}
			return false;
		}

		//Kollar om användaren tryckt på editera betyg knappen, returnera sant annars falskt.
		public function didUserPressEditGradeButton()
		{
			if(isset($_POST[$this->editgradebutton]))
			{
				return true;
			}
			return false;
		}
		
		//Visar editera betyg formuläret.
		public function ShowEditRatingPage(EditGradeList $gradelist)
		{

				
			$contentString = "$this->message";
			foreach($gradelist->toArray() as $grade)
			{
			$contentString .=  "<form class='editgradeform' method=post >";
			$contentString .= "
			<div class='diveditgrade'><h3 class='hcolcenter'>Editera betyg</h3><br>
			<span class='formtexteditgrade' style='white-space: nowrap'>Album:</span>";
			$contentString.= "<p class='formtexteditgrade'>".$grade->getAlbum()."</p>";
			$contentString .= "<span class='formtexteditgrade' style='white-space: nowrap'>Betyg:</span>";
			$contentString.= "<p class='formtexteditgrade'>".$grade->getGrade()."</p>";
			$contentString .= "<span class='formtexteditgrade' style='white-space: nowrap'>Användare:</span>";
			$contentString.= "<p class='formtexteditgrade'>".$grade->getUser()."</p>"; 
			$contentString.= "<input type='hidden' name='$this->pickededitid' value='". $grade->getID() ."'>";
			$contentString.= "<input class='formtexteditgrade' type='submit' name='$this->editbutton' value='Editera'>";
			$contentString .= "</div>";
			$contentString .= "</form>";
			}
							 

			$HTMLbody = "<div class='divmenu'>
			<h1 class='hcenterlonggrade'>Editera betyg på album</h1>
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

		// visa editerings formuläret med valt betyg att ändra.
		public function ShowChosenEditRatingPage(EditGradeList $editgradelist, GradeList $gradelist)
		{
			
			
			

			
				
			$contentString = "
			<form method=post >
			$this->message";
			foreach($editgradelist->toArray() as $editgrade)
			{
							 	
				$contentString .= "
				<div class='diveditgenre'>
				<h3 class='hcolcenterdeletegenre'>Editera betyg</h3>
				<span class='hcolcenterdeletegenre' style='white-space: nowrap'>Album:</span>
				";
				$contentString.= "<p class='hcolcenterdeletegenre'>".$editgrade->getAlbum()."</p>";
				$contentString .= "<span class='hcolcenterdeletegenre' style='white-space: nowrap'>Betyg:</span>";
				$contentString.="<p class='hcolcenterdeletegenre'>".$editgrade->getGrade()."</p>";
				$contentString.= "<input type='hidden' name='$this->pickedid' value='". $editgrade->getID() ."'>";	
			}

			$contentString .= "<span class='hcolcenterdeletegenre' style='white-space: nowrap'>Nytt betyg:</span><br>";
			$contentString.= "<select class='hcolcenterdeletegenre' name='dropdownneweditgrade'>";

			foreach($gradelist->toArray() as $grade)
			{
							 	
				$contentString.="<option value='". $grade->getGrade()."'>".$grade->getGrade()."</option>";
							 	 
			}

			$contentString.="</select>";
			$contentString.= "<input type='submit' class='hcolcenterdeletegenre' name='$this->editgradebutton'  value='Editera Betyg'>";
			$contentString .= "</div>";
			$contentString .= "</form>";

			$HTMLbody = "<div class='divmenu'>
			<h1 class='hcenterlong'>Editera betyg på valt album</h1>
			<p class='pcenter'><a href='?editrating'>Tillbaka</a></p>
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
			$this->message = "<p class='messagecenter'>" . $message . "</p>";
		}

		//Lägger in lyckat editera betyg meddelande i funktionen showMessage.
		public function successfulEditGradeToEventWithBand()
		{
				$this->showMessage("Betyget har editerats!");
		}



	}