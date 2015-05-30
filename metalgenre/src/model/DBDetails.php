<?php 
	//funktion connection() inspirerad från kursmaterialet.

	require_once("BandList.php");
	require_once("GenreList.php");
	require_once("GradeList.php");
	require_once("AlbumList.php");
	require_once("EventBandList.php");
	require_once("ShowEventList.php");
	require_once("EditGradeList.php");
	require_once("DeleteGradeList.php");
	require_once("AlbumBandList.php");
	require_once("AlbumGradeList.php");
	require_once("FetchGenreList.php");
	require_once("NewsList.php");
	


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
		private static $role = "role";
		private static $album = "album";
		private static $albums = "albums";
		private static $tblalbums = "m_albums";
		private static $albumid = "albumid";
		private static $albumname = "name";
		private static $imgpath = "imgpath";
		private static $albumcontents = "contents";
		private static $albumpersons = "persons";
		private static $tblalbumband ="m_albumband";
		private static $bandName = "name";
		private static $biography = "biography";
		private static $discography = "discography";
		private static $eventband = "eventband";
		private static $username = "username";
		private static $password = "password";
		private static $rating = "rating";
		private static $tblUser = "m_user";
		private static $tblband = "m_bands";
		private static $tblGenre = "m_genres";
		private static $tblEventBand = "m_eventband";
		private static $tblSummaryGrade = "m_summarygrade";
		private static $tblRating = "m_rating";
		private static $tblNews = "m_news";
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
		/*public function getDBUserInput($inputUser)
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

		}*/

		public function getDBUserRole($inputUser)
		{
			$db = $this -> connection();
			$this->dbTable = self::$tblUser;

			$sql = "SELECT ". self::$role ." FROM `$this->dbTable` WHERE ". self::$username ." = ?";
			$params = array($inputUser);

			$query = $db -> prepare($sql);
			$query -> execute($params);

			$result = $query -> fetch();
			
			
			if ($result) {
				
				return $result[self::$role];
				
			}

		}

		public function verifyInput($inputUsername, $inputPassword)
		{

						$db = $this -> connection();
						$this->dbTable = self::$tblUser;
						$sql = "SELECT * FROM `$this->dbTable` WHERE username= ? AND password= ?";
						$params = array($inputUsername, $inputPassword);
						$query = $db -> prepare($sql);
						$query -> execute($params);
						$rows = $query -> fetchColumn();

						return $rows;



		}

		//Hämtar och returnerar lösenordet från databasen.
		/*public function getDBPassInput($inputPassword)
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

		}*/

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
				
				

				
				if ($result[self::$bandName] !== null) {

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
		
		public function checkIfAlbumExist($inputalbum)
		{

				$db = $this -> connection();
				$this->dbTable = self::$tblalbums;
				$sql = "SELECT ". self::$albumname ." FROM `$this->dbTable` WHERE ". self::$albumname ." = ?";
				$params = array($inputalbum);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
				
				

				
				if ($result[self::$albumname] !== null) {

					throw new Exception("Albumet med det namnet finns redan");

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

		//Kontrollerar om livespelningen redan innehåller inmatade bandet. Om inte så returneras true annars kastas undantag.
		public function checkIfBandExistsOnAlbum($albumdropdown, $banddropdown)
		{

				$db = $this -> connection();
				$this->dbTable = self::$tblalbumband;
				$sql = "SELECT ". self::$album .",". self::$band ." FROM `".$this->dbTable."` WHERE ". self::$album ." = ? AND ". self::$band ." = ?";
				$params = array($albumdropdown,$banddropdown);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
				
				

				
				if ($result[self::$album] !== null && $result[self::$colband] !== null ) {

					throw new Exception("Albumet innehåller redan det bandet du försöker lägga till");

				}else{

					return true;
				}

		}

		public function checkIfAlbumExistsAlready($albumdropdown)
		{

						$db = $this -> connection();
						$this->dbTable = self::$tblalbumband;
						$sql = "SELECT * FROM `$this->dbTable` WHERE ".self::$album."= ?";
						$params = array($albumdropdown);
						$query = $db -> prepare($sql);
						$query -> execute($params);
						$rows = $query -> fetchColumn();

						


				
				if ($rows > 0) {

					throw new Exception("Albumet är redan kopplat till ett band och kan bara tillhöra ett band");

				}else{

					return true;
				}

		}

		//Kontrollerar om användaren redan satt betyg på den livespelningen med det bandet. Om inte så returneras true annars kastas undantag.
		public function checkIfGradeExistOnAlbumUser($albumdropdown,$username)
		{

				$db = $this -> connection();
				$this->dbTable = self::$tblSummaryGrade;
				$sql = "SELECT ". self::$album .",". self::$username ." FROM `".$this->dbTable."` WHERE ". self::$album ." = ? AND ". self::$username ." = ?";
				$params = array($albumdropdown,$username);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
								

				
				if ($result[self::$album] !== null && $result[self::$colusername] !== null ) {

					throw new Exception("Albumet med det användarnamnet har redan ett betyg");

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

		public function checkIfIdManipulatedGenre($pickedname, $loggedinUser)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblGenre;
				$sql = "SELECT ". self::$genrename .",". self::$username ." FROM `".$this->dbTable."` WHERE ". self::$genrename ." = ? AND ". self::$username ." = ? ";
				$params = array($pickedname,$loggedinUser);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
								

				
				if ($result[self::$genrename] == null && $result[self::$username] == null ) {

					throw new Exception("Id till den genren har inte rätt användarnamn");

				}else{

					return true;
				}
		}

		//Kontrollerar om livespelningen och/eller bandet har fått sina värden manipulerade. Om inte så returneras true annars kastas undantag.
		public function checkIfAlbumManipulated($pickedalbum)
		{
				
				
				$db = $this -> connection();
				$this->dbTable = self::$tblalbumband;
				$sql = "SELECT ". self::$album ." FROM `".$this->dbTable."` WHERE ". self::$album ." = ?";
				$params = array($pickedalbum);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
								

				
				if ($result[self::$album] == null) {

					throw new Exception("Album kolumnen med respektive band manipulerad");

				}else{

					return true;
				}

		}

		//Kontrollerar om vald livespelnings värde har blivit manipulerad.Om inte så returneras true annars kastas undantag.
		public function checkIfPickAlbumManipulated($pickedalbum)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblalbumband;
				$sql = "SELECT ". self::$album ." FROM `".$this->dbTable."` WHERE ". self::$album ." = ?";
				$params = array($pickedalbum);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
								

				
				if ($result[self::$album] == null) {

					throw new Exception("Albumet existerar ej i kolumnen");

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

		//Kontrollerar om livespelningen har fått sitt värde manipulerat i livespelningstabellen. Om inte så returneras true annars kastas undantag.
		public function checkIfPickAlbumFromAlbumTableIsManipulated($pickedalbum)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblalbums;
				$sql = "SELECT ". self::$albumname ." FROM `".$this->dbTable."` WHERE ". self::$albumname ." = ?";
				$params = array($pickedalbum);

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetch();
								

				
				if ($result[self::$albumname] == null) {

					throw new Exception("Albumet existerar ej i kolumnen");

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
					$genre = new Genre($genredb[self::$genrename], $genredb[self::$genreid], $genredb['imgpath']);
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
					$band = new Band($banddb[self::$bandName], $banddb[self::$bandid], $banddb[self::$biography], $banddb[self::$discography], $banddb[self::$imgpath]);
					$bands->add($band);

				}
				return $bands;

		}

		public function fetchAllAlbums()
		{

				$db = $this -> connection();
				$this->dbTable = self::$tblalbums;
				$sql = "SELECT * FROM `$this->dbTable`";
				

				$query = $db -> prepare($sql);
				$query -> execute();

				$result = $query -> fetchall();
				$albums = new AlbumList();
				foreach ($result as $albumdb) {
					$album = new Album($albumdb[self::$albumname],$albumdb[self::$albumid], $albumdb[self::$albumcontents], $albumdb[self::$albumpersons], $albumdb[self::$imgpath]);
					$albums->add($album);

				}
				return $albums;

		}

		//Hämtar alla livespelningar med band från databasen och returner dessa.
		public function fetchAllAlbumsWithBands()
		{


				$db = $this -> connection();
				$this->dbTable = self::$tblalbumband;
				$sql = "SELECT * FROM `$this->dbTable` GROUP BY ". self::$album ."";
				

				$query = $db -> prepare($sql);
				$query -> execute();

				$result = $query -> fetchall();
				$albumbands = new AlbumBandList();
				foreach ($result as $albumbanddb) {
					$albumband = new AlbumBand($albumbanddb[self::$album], $albumbanddb[self::$id]);
					$albumbands->add($albumband);

				}
				return $albumbands;




		}

		public function fetchGenresWithUser($user)
		{


				$db = $this -> connection();
				$this->dbTable = self::$tblGenre;
				$sql = "SELECT * FROM `$this->dbTable` where ". self::$colusername ." = ?";
				$params = array($user);
				$query = $db -> prepare($sql);
				$query -> execute($params);
				$result = $query -> fetchall();

				$fetchgenres = new FetchGenreList();
				foreach ($result as $fetchgenredb) {
					$fetchgenre = new FetchGenre($fetchgenredb[self::$genrename], $fetchgenredb[self::$genreid], $fetchgenredb[self::$colusername]);
					$fetchgenres->add($fetchgenre);

				}
				return $fetchgenres;

		}




		public function fetchGenresWithName($name)
		{


				$db = $this -> connection();
				$this->dbTable = self::$tblGenre;
				$sql = "SELECT * FROM `$this->dbTable` where ". self::$genrename ." = ?";
				$params = array($name);
				$query = $db -> prepare($sql);
				$query -> execute($params);
				$result = $query -> fetchall();

				$fetchgenres = new FetchGenreList();
				foreach ($result as $fetchgenredb) {
					$fetchgenre = new FetchGenre($fetchgenredb[self::$genrename], $fetchgenredb[self::$genreid], $fetchgenredb[self::$colusername]);
					$fetchgenres->add($fetchgenre);

				}
				return $fetchgenres;

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
		public function fetchChosenBandsInAlbumDropdown($albumdropdown)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblalbumband;
				$sql = "SELECT * FROM `$this->dbTable` WHERE ". self::$album ." = ? ";
				$params = array($albumdropdown);
				

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetchall();
				$albumbands = new AlbumBandList();
				foreach ($result as $albumbanddb) {
					$albumband = new AlbumBand($albumbanddb[self::$band], $albumbanddb[self::$id]);
					$albumbands->add($albumband);

				}
				return $albumbands;

		}

		//Hämtar endast vald livespelning från livespelningskolumnen i databasen och returnerar dessa.
		public function fetchChosenAlbumInAlbumDropDown($albumdropdown)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblalbumband;
				$sql = "SELECT * FROM `$this->dbTable` WHERE ". self::$album ." = ? GROUP BY ". self::$album ." ";
				$params = array($albumdropdown);
				

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetchall();
				$albumbands = new AlbumBandList();
				foreach ($result as $albumbanddb) {
					$albumband = new AlbumBand($albumbanddb[self::$album], $albumbanddb[self::$id]);
					$albumbands->add($albumband);

				}
				return $albumbands;

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
					$showevent = new ShowEvent($showeventdb[self::$album], $showeventdb[self::$id], $showeventdb[self::$grade],$showeventdb[self::$username]);
					$showevents->add($showevent);

				}
				return $showevents;
		}

		//Hämtar alla band,id,livespelningar,betyg och användarnamn och returnerar dessa.
		public function fetchShowAllGenres()
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblGenre;
				$sql = "SELECT * FROM `$this->dbTable`";
				

				$query = $db -> prepare($sql);
				$query -> execute();

				$result = $query -> fetchall();
				
				
				$showgenres = new GenreList();
				foreach ($result as $showgenredb) {
					$showgenre = new Genre($showgenredb[self::$genrename], $showgenredb[self::$genreid], $showgenredb['imgpath']);
					$showgenres->add($showgenre);

				}
				return $showgenres;
		}

		public function fetchAllNews()
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblNews;
				$sql = "SELECT * FROM `$this->dbTable`";
				

				$query = $db -> prepare($sql);
				$query -> execute();

				$result = $query -> fetchall();
				
				
				$news = new NewsList();
				foreach ($result as $newsdb) {
					$new = new News($newsdb['news'], $newsdb['newsid']);
					$news->add($new);

				}
				return $news;
		}

		public function fetchGenre($genrename)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblband;
				$sql = "SELECT * FROM  `$this->dbTable` as bands INNER JOIN `m_eventband` as `ev` ON `ev`.`band` = `bands`.`name` where `ev`.`genre` = ?  ";
				$params = array($genrename);
				$query = $db -> prepare($sql);
				$query -> execute($params);
				$result = $query -> fetchall();
				
				
				$bands = new BandList();
				foreach ($result as $banddb) {
					$band = new Band($banddb[self::$bandName], $banddb[self::$bandid], $banddb[self::$biography], $banddb[self::$discography], $banddb[self::$imgpath]);
					$bands->add($band);

				}
				return $bands;
		}

		public function fetchBand($bandname)
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblalbums;
				$sql = "SELECT * FROM  `$this->dbTable` as album INNER JOIN `m_albumband` as `ab` ON `ab`.`album` = `album`.`name` where `ab`.`band` = ?  ";
				$params = array($bandname);
				$query = $db -> prepare($sql);
				$query -> execute($params);
				$result = $query -> fetchall();
				
				
				$albums = new AlbumList();
				foreach ($result as $albumdb) {
					$album = new Album($albumdb[self::$albumname], $albumdb[self::$albumid], $albumdb[self::$albumcontents], $albumdb[self::$albumpersons], $albumdb[self::$imgpath] );
					$albums->add($album);

				}
				return $albums;
		}

		public function fetchShowGrade($albumname)
		{
				
				$db = $this -> connection();
				$this->dbTable = self::$tblSummaryGrade;
				$sql = "SELECT grade FROM  `$this->dbTable` where `album` = ?  ";
				$params = array($albumname);
				$query = $db -> prepare($sql);
				$query -> execute($params);
				$result = $query -> fetchAll();
				
				return $result;
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
					$editgrade = new EditGrade($editgradedb[self::$grade], $editgradedb[self::$id], $editgradedb[self::$album],$editgradedb[self::$username]);
					$editgrades->add($editgrade);

				}
				return $editgrades;
		}

		public function fetchAdminEditGrades()
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblSummaryGrade;
				$sql = "SELECT * FROM `$this->dbTable`";
				$params = array();
				

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetchall();
				
				
				$editgrades = new EditGradeList();
				foreach ($result as $editgradedb) {
					$editgrade = new EditGrade($editgradedb[self::$grade], $editgradedb[self::$id], $editgradedb[self::$album],$editgradedb[self::$username]);
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
					$editgrade = new EditGrade($editgradedb[self::$grade], $editgradedb[self::$id], $editgradedb[self::$album],$editgradedb[self::$username]);
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
					$deletegrade = new DeleteGrade($deletegradedb[self::$grade], $deletegradedb[self::$id], $deletegradedb[self::$album],$deletegradedb[self::$username]);
					$deletegrades->add($deletegrade);

				}
				return $deletegrades;
		}

		public function fetchDeleteAdminGrades()
		{
				$db = $this -> connection();
				$this->dbTable = self::$tblSummaryGrade;
				$sql = "SELECT * FROM `$this->dbTable` ";
				$params = array();
				

				$query = $db -> prepare($sql);
				$query -> execute($params);

				$result = $query -> fetchall();
				
				
				$deletegrades = new DeleteGradeList();
				foreach ($result as $deletegradedb) {
					$deletegrade = new DeleteGrade($deletegradedb[self::$grade], $deletegradedb[self::$id], $deletegradedb[self::$album],$deletegradedb[self::$username]);
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
		public function addGenre($inputgenre,$user)
		{
			try {
					$db = $this -> connection();
					$this->dbTable = self::$tblGenre;

					$sql = "INSERT INTO $this->dbTable (".self::$genrename.",".self::$username .") VALUES (?,?)";
					$params = array($inputgenre,$user);

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

		//Lägger till bandet till genren.
		public function addBandToAlbum($albumdropdown,$banddropdown)
		{

				try {
					$db = $this -> connection();
					$this->dbTable = self::$tblalbumband;

					$sql = "INSERT INTO $this->dbTable (".self::$album.",". self::$band .") VALUES (?,?)";
					$params = array($albumdropdown,$banddropdown);

					$query = $db -> prepare($sql);
					$query -> execute($params);
					

				} catch (\PDOException $e) {
					die('An unknown error have occured.');
				}


		}

		//Lägger till betyg till livespelning med angivet band till den inloggade användaren.
		public function addGradeToAlbumWithUser($albumdropdown,$gradedropdown,$username){

			try {
					$db = $this -> connection();
					$this->dbTable = self::$tblSummaryGrade;

					$sql = "INSERT INTO $this->dbTable (".self::$album.",". self::$grade .", ". self::$username .") VALUES (?,?,?)";
					$params = array($albumdropdown,$gradedropdown,$username);

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

		public function addAlbum($inputalbum, $inputcontents, $inputpersons) {
				try {
					$db = $this -> connection();
					$this->dbTable = self::$tblalbums;

					$sql = "INSERT INTO $this->dbTable (".self::$albumname.",".self::$albumcontents .",".self::$albumpersons .") VALUES (?,?,?)";
					$params = array($inputalbum, $inputcontents,$inputpersons);

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

		//Editerar betyget.
		public function EditGenre($inputgenre,$inputoldname)
		{
			try{
				

			$db = $this -> connection();
			$this->dbTable = self::$tblGenre;
			$sql = "UPDATE $this->dbTable SET ". self::$genrename ."=? WHERE ". self::$genrename ."=?";
			$params = array($inputgenre,$inputoldname);

			$query = $db -> prepare($sql);
			$query -> execute($params);
					

			} catch (\PDOException $e) {
					die('An unknown error have occured.');
			}
        
		}

				//Editerar betyget.
		public function EditCouplingGenre($inputgenre,$inputoldname)
		{
			try{
				

			$db = $this -> connection();
			$this->dbTable = self::$tblEventBand;
			$sql = "UPDATE $this->dbTable SET ". self::$genre ."=? WHERE ". self::$genre ."=?";
			$params = array($inputgenre,$inputoldname);

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

		public function DeleteGenre($inputname)
		{

			$db = $this -> connection();
			$this->dbTable = self::$tblGenre;

			$sql = "DELETE FROM $this->dbTable WHERE ". self::$genrename ." = ?";
			$params = array($inputname);

			$query = $db -> prepare($sql);
			$query -> execute($params);


		}

		public function DeleteCouplingGenre($inputname)
		{

			$db = $this -> connection();
			$this->dbTable = self::$tblEventBand;

			$sql = "DELETE FROM $this->dbTable WHERE ". self::$genre ." = ?";
			$params = array($inputname);

			$query = $db -> prepare($sql);
			$query -> execute($params);


		}


		

	}