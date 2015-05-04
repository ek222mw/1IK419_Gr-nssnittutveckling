<?php 
	//funktion connection() inspirerad från kursmaterialet.

	require_once("BandList.php");
	require_once("GenreList.php");
	require_once("GradeList.php");
	require_once("EventBandList.php");
	require_once("ShowEventList.php");
	require_once("EditGradeList.php");
	require_once("DeleteGradeList.php");

	class DBDetails{

		//Databasuppgifter för databasen.
		protected $dbUsername = "root";
		protected $dbPassword = "";
		protected $dbConnstring = 'mysql:host=127.0.0.1;dbname=metalgenre';
		protected $dbConnection;
		protected $dbTable = "";

		//privata statiska variabler som används för att undvika strängberoenden i metoderna.
		
		private static $genrename = "genrename";
		private static $id = "id";
		private static $bandid = "bandid";
		private static $genreid = "genreid";
		private static $grade = "grade";
		private static $genre = "genre";
		private static $band = "band";
		private static $bandName = "name";
		private static $biography = "biography";
		private static $discography = "discography";
		private static $eventband = "eventband";
		private static $username = "username";
		private static $password = "password";
		private static $rating = "rating";
		private static $tblUser = "user";
		private static $tblband = "bands";
		private static $tblGenre = "genres";
		private static $tblEventBand = "eventband";
		private static $tblSummaryGrade = "summarygrade";
		private static $tblRating = "rating";
		private static $colId = "id";
		private static $colusername = "username";
		private static $colevent = "event";
		private static $colband = "band";
		private static $colgrade = "grade";
		private static $colpassword = "password";
		private static $colrating = "rating";
		private static $ID = "ID";

		//returnerar anslutningssträngen.
		protected function connection() 
		{

			if ($this->dbConnection == NULL)
					$this->dbConnection = new \PDO($this->dbConnstring, $this->dbUsername, $this->dbPassword);
			
			$this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				
			return $this->dbConnection;
		}

		
		//Kontrollerar om användarnamnet är upptaget, returnerar true om det inte är upptaget. Annars kastas undantag.
		public function ReadSpecifik($inputuser)
		{

			
			$db = $this -> connection();
			$this->dbTable = self::$tblUser;

			$sql = "SELECT ". self::$username ." FROM `$this->dbTable` WHERE ". self::$username ." = ?";
			$params = array($inputuser);

			$query = $db -> prepare($sql);
			$query -> execute($params);

			$result = $query -> fetch();
			
			
			if ($result[self::$colusername] !== null) {
				
				throw new Exception("Användarnamnet är redan upptaget");

			}else{
				return true;
			}
			
		
		}	

		//Hämtar och returnerar användarnamnet från databasen.
		public function getDBUserInput($inputUser)
		{
			$db = $this -> connection();
			$this->dbTable = self::$tblUser;

			$sql = "SELECT ". self::$username ." FROM `$this->dbTable` WHERE ". self::$username ." = ?";
			$params = array($inputUser);

			$query = $db -> prepare($sql);
			$query -> execute($params);

			$result = $query -> fetch();
			
			
			if ($result) {
				
				return $result[self::$colusername];
				
			}

		}

		//Hämtar och returnerar lösenordet från databasen.
		public function getDBPassInput($inputPassword)
		{

			$db = $this -> connection();
			$this->dbTable = self::$tblUser;

			$sql = "SELECT ". self::$password ." FROM `$this->dbTable` WHERE ". self::$password ." = ?";
			$params = array($inputPassword);

			$query = $db -> prepare($sql);
			$query -> execute($params);

			$result = $query -> fetch();
			
			
			if ($result) {
				
				return $result[self::$colpassword];
				
			}

		}

		//Kontrollerar om bandet redan finns.Om inte så returneras true annars kastas undantag.
		public function checkIfBandExist($inputband)
		{

			
				$db = $this -> connection();
				$this->dbTable = self::$tblband;
				$sql = "SELECT ". self::$bandName ." FROM `$this->dbTable` WHERE ". self::$bandName ." = ?";
				$params = array($inputband);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
				
				

				
				if ($result[self::$colevent] !== null) {

					throw new Exception("Bandet med det namnet är redan upptaget");

				}else{

					return true;
				}
			
		
		}

		//Kontrollerar om bandet redan finns.Om inte så returneras true annars kastas undantag.
		public function checkIfGenreExist($inputgenre)
		{

				$db = $this -> connection();
				$this->dbTable = self::$tblGenre;
				$sql = "SELECT ". self::$genrename ." FROM `$this->dbTable` WHERE ". self::$genrename ." = ?";
				$params = array($inputgenre);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
				
				

				
				if ($result[self::$genrename] !== null) {

					throw new Exception("Genren med det namnet är redan upptaget");

				}else{

					return true;
				}



		}

		//Kontrollerar om livespelningen redan innehåller inmatade bandet. Om inte så returneras true annars kastas undantag.
		public function checkIfBandExistsOnEvent($genredropdown, $banddropdown)
		{

				$db = $this -> connection();
				$this->dbTable = self::$tblEventBand;
				$sql = "SELECT ". self::$genre .",". self::$band ." FROM `".$this->dbTable."` WHERE ". self::$genre ." = ? AND ". self::$band ." = ?";
				$params = array($genredropdown,$banddropdown);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
				
				

				
				if ($result[self::$genre] !== null && $result[self::$colband] !== null ) {

					throw new Exception("Genren innehåller redan det bandet du försöker lägga till");

				}else{

					return true;
				}

		}

		//Kontrollerar om användaren redan satt betyg på den livespelningen med det bandet. Om inte så returneras true annars kastas undantag.
		public function checkIfGradeExistOnEventBandUser($eventdropdown,$banddropdown,$username)
		{

				$db = $this -> connection();
				$this->dbTable = self::$tblSummaryGrade;
				$sql = "SELECT ". self::$event .",". self::$band .",". self::$username ." FROM `".$this->dbTable."` WHERE ". self::$event ." = ? AND ". self::$band ." = ? AND ". self::$username ." = ?";
				$params = array($eventdropdown,$banddropdown,$username);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
								

				
				if ($result[self::$event] !== null && $result[self::$colband] !== null && $result[self::$colusername] !== null ) {

					throw new Exception("Spelningen med det bandet och användarnamn har redan ett betyg");

				}else{

					return true;
				}

		}

		//Kontrollerar om id värde har manipulerats till något annat. Om inte så returneras true annars kastas undantag.
		public function checkIfIdManipulated($pickedid, $loggedinUser)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblSummaryGrade;
				$sql = "SELECT ". self::$id .",". self::$username ." FROM `".$this->dbTable."` WHERE ". self::$id ." = ? AND ". self::$username ." = ? ";
				$params = array($pickedid,$loggedinUser);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
								

				
				if ($result[self::$colId] == null && $result[self::$colusername] == null ) {

					throw new Exception("Id till det betyget har inte rätt användarnamn");

				}else{

					return true;
				}
		}

		//Kontrollerar om livespelningen och/eller bandet har fått sina värden manipulerade. Om inte så returneras true annars kastas undantag.
		public function checkIfBandAndEventManipulated($pickedevent,$pickedband)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblEventBand;
				$sql = "SELECT ". self::$event .",". self::$band ." FROM `".$this->dbTable."` WHERE ". self::$event ." = ? AND ". self::$band ." = ? ";
				$params = array($pickedevent,$pickedband);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
								

				
				if ($result[self::$colevent] == null && $result[self::$colband] == null ) {

					throw new Exception("Livespelning och/eller bandet existerar ej i kolumnen livespelning respektive band");

				}else{

					return true;
				}

		}

		//Kontrollerar om vald livespelnings värde har blivit manipulerad.Om inte så returneras true annars kastas undantag.
		public function checkIfPickEventManipulated($pickedevent)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblEventBand;
				$sql = "SELECT ". self::$event ." FROM `".$this->dbTable."` WHERE ". self::$event ." = ?";
				$params = array($pickedevent);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
								

				
				if ($result[self::$colevent] == null) {

					throw new Exception("Livespelningen existerar ej i kolumnen");

				}else{

					return true;
				}

		}

		//Kontrollerar om betyget har fått sitt värde manipulerat. Om inte så returneras true annars kastas undantag.
		public function checkIfPickRatingManipulated($pickedrating)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblRating;
				$sql = "SELECT ". self::$rating ." FROM `".$this->dbTable."` WHERE ". self::$rating ." = ?";
				$params = array($pickedrating);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
								

				
				if ($result[self::$colrating] == null) {

					throw new Exception("Betyg existerar ej i kolumnen");

				}else{

					return true;
				}
		}

		//Kontrollerar om livespelningen har fått sitt värde manipulerat i livespelningstabellen. Om inte så returneras true annars kastas undantag.
		public function checkIfPickEventFromEventTableIsManipulated($pickedgenre)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblGenre;
				$sql = "SELECT ". self::$genrename ." FROM `".$this->dbTable."` WHERE ". self::$genrename ." = ?";
				$params = array($pickedgenre);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
								

				
				if ($result[self::$genrename] == null) {

					throw new Exception("Genren existerar ej i kolumnen");

				}else{

					return true;
				}
		}

		//Kontrollerar om bandet har fått sitt värde manipulerat i bandtabellen. Om inte så returneras true annars kastas undantag.
		public function checkIfPickBandFromBandTableIsManipulated($pickedband)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblband;
				$sql = "SELECT ". self::$bandName ." FROM `".$this->dbTable."` WHERE ". self::$bandName ." = ?";
				$params = array($pickedband);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
								

				
				if ($result[self::$bandName] == null) {

					throw new Exception("Bandet existerar ej i kolumnen");

				}else{

					return true;
				}
		}

		
		//Hämtar alla livespelningar från databasen och returnerar dessa.
		public function fetchAllGenres()
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblGenre;
				$sql = "SELECT * FROM `$this->dbTable`";
				

				$query = $db -> prepare($sql);
				$query -> execute();

				$result = $query -> fetchall();
				$genres = new GenreList();
				foreach ($result as $genredb) {
					$genre = new Genre($genredb[self::$genrename], $genredb[self::$genreid]);
					$genres->add($genre);

				}
				return $genres;
				
				
		}

		//Hämtar alla band från databasen och returnerar dessa.
		public function fetchAllBands()
		{

				$db = $this -> connection();
				$this->dbTable = self::$tblband;
				$sql = "SELECT * FROM `$this->dbTable`";
				

				$query = $db -> prepare($sql);
				$query -> execute();

				$result = $query -> fetchall();
				$bands = new BandList();
				foreach ($result as $banddb) {
					$band = new Band($banddb[self::$bandName], $banddb[self::$bandid], $banddb[self::$biography], $banddb[self::$discography]);
					$bands->add($band);

				}
				return $bands;

		}

		//Hämtar alla livespelningar med band från databasen och returner dessa.
		public function fetchAllEventWithBands()
		{


				$db = $this -> connection();
				$this->dbTable = self::$tblEventBand;
				$sql = "SELECT * FROM `$this->dbTable` GROUP BY ". self::$event ."";
				

				$query = $db -> prepare($sql);
				$query -> execute();

				$result = $query -> fetchall();
				$eventbands = new EventBandList();
				foreach ($result as $eventbanddb) {
					$eventband = new EventBand($eventbanddb[self::$event], $eventbanddb[self::$id]);
					$eventbands->add($eventband);

				}
				return $eventbands;




		}

		//Hämtar alla band innehållandes livespelningar och returnerar dessa.
		public function fetchAllBandsWithEvent(){

				$db = $this -> connection();
				$this->dbTable = self::$tblEventBand;
				$sql = "SELECT * FROM `$this->dbTable`";
				

				$query = $db -> prepare($sql);
				$query -> execute();

				$result = $query -> fetchall();
				$eventbands = new EventBandList();
				foreach ($result as $eventbanddb) {
					$eventband = new EventBand($eventbanddb[self::$band], $eventbanddb[self::$id]);
					$eventbands->add($eventband);

				}
				return $eventbands;


		}

		//Hämtar alla band tillhörandes vald livespelning och returnerar dessa.
		public function fetchChosenBandsInEventDropdown($eventdropdown)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblEventBand;
				$sql = "SELECT * FROM `$this->dbTable` WHERE ". self::$event ." = ? ";
				$params = array($eventdropdown);
				

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetchall();
				$eventbands = new EventBandList();
				foreach ($result as $eventbanddb) {
					$eventband = new EventBand($eventbanddb[self::$band], $eventbanddb[self::$id]);
					$eventbands->add($eventband);

				}
				return $eventbands;

		}

		//Hämtar endast vald livespelning från livespelningskolumnen i databasen och returnerar dessa.
		public function fetchChosenEventInEventDropDown($eventdropdown)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblEventBand;
				$sql = "SELECT * FROM `$this->dbTable` WHERE ". self::$event ." = ? GROUP BY ". self::$event ." ";
				$params = array($eventdropdown);
				

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetchall();
				$eventbands = new EventBandList();
				foreach ($result as $eventbanddb) {
					$eventband = new EventBand($eventbanddb[self::$event], $eventbanddb[self::$id]);
					$eventbands->add($eventband);

				}
				return $eventbands;

		}

		//Hämtar alla betyg och returnerar dessa.
		public function fetchAllGrades()
		{

				$db = $this -> connection();
				$this->dbTable = self::$tblRating;
				$sql = "SELECT * FROM `$this->dbTable`";
				

				$query = $db -> prepare($sql);
				$query -> execute();

				$result = $query -> fetchall();
				$grades = new GradeList();
				foreach ($result as $gradedb) {
					$grade = new Grade($gradedb[self::$rating], $gradedb[self::$ID]);
					$grades->add($grade);

				}
				return $grades;


		}

		//Hämtar alla band,id,livespelningar,betyg och användarnamn och returnerar dessa.
		public function fetchShowAllEvents()
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblSummaryGrade;
				$sql = "SELECT * FROM `$this->dbTable`";
				

				$query = $db -> prepare($sql);
				$query -> execute();

				$result = $query -> fetchall();
				
				
				$showevents = new ShowEventList();
				foreach ($result as $showeventdb) {
					$showevent = new ShowEvent($showeventdb[self::$band], $showeventdb[self::$id], $showeventdb[self::$event], $showeventdb[self::$grade],$showeventdb[self::$username]);
					$showevents->add($showevent);

				}
				return $showevents;
		}

		//Hämtar alla betyg satta av inloggade användaren och returnerar dessa.
		public function fetchEditGrades($loggedinUser)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblSummaryGrade;
				$sql = "SELECT * FROM `$this->dbTable` WHERE ". self::$username ." = ? ";
				$params = array($loggedinUser);
				

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetchall();
				
				
				$editgrades = new EditGradeList();
				foreach ($result as $editgradedb) {
					$editgrade = new EditGrade($editgradedb[self::$grade], $editgradedb[self::$id], $editgradedb[self::$event], $editgradedb[self::$band],$editgradedb[self::$username]);
					$editgrades->add($editgrade);

				}
				return $editgrades;
		}

		//Hämtar id till det betyg som inloggade användaren har valt att editera.Hämtar även livespelning,band och användarnamn. returnerar sedan samtliga poster.
		public function fetchIdPickedEditGrades($pickedid)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblSummaryGrade;
				$sql = "SELECT * FROM `$this->dbTable` WHERE ". self::$id ." = ? ";
				$params = array($pickedid);
				

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetchall();
				
				
				$editgrades = new EditGradeList();
				foreach ($result as $editgradedb) {
					$editgrade = new EditGrade($editgradedb[self::$grade], $editgradedb[self::$id], $editgradedb[self::$event], $editgradedb[self::$band],$editgradedb[self::$username]);
					$editgrades->add($editgrade);

				}
				return $editgrades;
		}

		//Hämtar alla betyg satta av inloggade användaren och returnerar dessa.
		public function fetchDeleteGradesWithSpecUser($loggedinUser)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblSummaryGrade;
				$sql = "SELECT * FROM `$this->dbTable` WHERE ". self::$username ." = ? ";
				$params = array($loggedinUser);
				

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetchall();
				
				
				$deletegrades = new DeleteGradeList();
				foreach ($result as $deletegradedb) {
					$deletegrade = new DeleteGrade($deletegradedb[self::$grade], $deletegradedb[self::$id], $deletegradedb[self::$event], $deletegradedb[self::$band],$deletegradedb[self::$username]);
					$deletegrades->add($deletegrade);

				}
				return $deletegrades;
		}

		//Lägger till användaren med användarnamn och lösenord och returnerar true för att sätta en variabel i LoginModel klassen.
		public function addUser($inputuser,$inputpassword) {
			try {

				$db = $this -> connection();
				$this->dbTable = self::$tblUser;

				$sql = "INSERT INTO $this->dbTable (". self::$username .",". self::$password  .") VALUES (?, ?)";
				$params = array($inputuser, $inputpassword);

				$query = $db -> prepare($sql);
				$query -> execute($params);
				
				return true;

			} catch (\PDOException $e) {
				die('An unknown error have occured.');
			}
		}

		//Lägger till bandet.
		public function addGenre($inputgenre)
		{
			try {
					$db = $this -> connection();
					$this->dbTable = self::$tblGenre;

					$sql = "INSERT INTO $this->dbTable (".self::$genrename.") VALUES (?)";
					$params = array($inputgenre);

					$query = $db -> prepare($sql);
					$query -> execute($params);
					

				} catch (\PDOException $e) {
					die('An unknown error have occured.');
				}


		}

		//Lägger till bandet till genren.
		public function addBandToGenre($genredropdown,$banddropdown)
		{

				try {
					$db = $this -> connection();
					$this->dbTable = self::$tblEventBand;

					$sql = "INSERT INTO $this->dbTable (".self::$genre.",". self::$band .") VALUES (?,?)";
					$params = array($genredropdown,$banddropdown);

					$query = $db -> prepare($sql);
					$query -> execute($params);
					

				} catch (\PDOException $e) {
					die('An unknown error have occured.');
				}






		}

		//Lägger till betyg till livespelning med angivet band till den inloggade användaren.
		public function addGradeToEventBandWithUser($eventdropdown,$banddropdown,$gradedropdown,$username){

			try {
					$db = $this -> connection();
					$this->dbTable = self::$tblSummaryGrade;

					$sql = "INSERT INTO $this->dbTable (".self::$event.",". self::$band .",". self::$grade .", ". self::$username .") VALUES (?,?,?,?)";
					$params = array($eventdropdown,$banddropdown,$gradedropdown,$username);

					$query = $db -> prepare($sql);
					$query -> execute($params);
					

				} catch (\PDOException $e) {
					die('An unknown error have occured.');
				}

		}

		//lägger till band.
		public function addBand($inputband, $inputbiography, $inputdiscography) {
				try {
					$db = $this -> connection();
					$this->dbTable = self::$tblband;

					$sql = "INSERT INTO $this->dbTable (".self::$bandName.",".self::$biography .",".self::$discography .") VALUES (?,?,?)";
					$params = array($inputband, $inputbiography,$inputdiscography);

					$query = $db -> prepare($sql);
					$query -> execute($params);
					

				} catch (\PDOException $e) {
					die('An unknown error have occured.');
				}
		}

		//Editerar betyget.
		public function EditGrades($inputgrade,$inputid)
		{
			try{
				
			$db = $this -> connection();
			$this->dbTable = self::$tblSummaryGrade;
			$sql = "UPDATE $this->dbTable SET ". self::$grade ."=? WHERE ". self::$id ."=?";
			$params = array($inputgrade,$inputid);

			$query = $db -> prepare($sql);
			$query -> execute($params);
					

			} catch (\PDOException $e) {
					die('An unknown error have occured.');
			}
        
		}

		//Tar bort betyget.
		public function DeleteGrades($inputid)
		{

			$db = $this -> connection();
			$this->dbTable = self::$tblSummaryGrade;

			$sql = "DELETE FROM $this->dbTable WHERE ". self::$id ." = ?";
			$params = array($inputid);

			$query = $db -> prepare($sql);
			$query -> execute($params);


		}


		

	}