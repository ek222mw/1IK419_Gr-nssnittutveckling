<?php

	require_once("./src/model/LoginModel.php");
	require_once("./src/view/LoginView.php");
	require_once("./src/model/AddBandEventModel.php");
	require_once("./src/view/AddBandEventView.php");
	require_once("./src/model/Genre.php");
	require_once("./src/model/GenreList.php");

	class AddBandEventController{

		private $loginview;
		private $loginmodel;
		private $addbandeventmodel;
		private $addbandeventview;

		public function __construct(){
			
			
						
			// Skapar nya instanser av modell- & vy-klassen och lägger dessa i privata variabler.
			$this->db = new DBDetails();
			$this->loginmodel = new LoginModel();
			$this->loginview = new LoginView($this->loginmodel);
			$this->addbandeventmodel = new AddBandEventModel();
			$this->addbandeventview = new AddBandEventView();

			//Kontroller vilken metod som ska anropas beroende på indata.
			if($this->loginview->didUserPressAddBand() && $this->loginmodel->checkLoginStatus())
			{
				$this->doControllBand();
			}
			
			if($this->loginview->didUserPressAddGenre() && $this->loginmodel->checkLoginStatus())
			{
				
				$this->doControllGenre();
			}

			if($this->loginview->didUserPressAddBandToEvent() && $this->loginmodel->checkLoginStatus())
			{
				$this->doControllBandToEvent();
			}

			if($this->loginview->didUserPressAddAlbum() && $this->loginmodel->checkLoginStatus())
			{
				$this->doControllAlbum();
			}



		}

		/*Kontrollerar om valideringen av indata är korrekt, då läggs livespelning till.Annars kastas felmeddelande.Anropar alltid
		doHTMLBody som kontrollerar vilken vy som ska anropas. */
		public function doControllBand(){
			
			//Kontrollerar om användaren är inloggad och har tryckt på lägg till livespelningslänken från menyn.
			if($this->loginview->didUserPressAddBand() && $this->loginmodel->checkLoginStatus())
			{	
				//Variabler som innehåller funktionsanrop istället för hela funktionsanrop i koden. Gör det lättare att läsa koden.
				$band = $this->addbandeventview->getBandName();


				try{

					
					if($this->addbandeventview->didUserPressAddEventButton())
					{
							
							if($this->addbandeventmodel->CheckBandLength($band))
							{
								
								if($this->loginmodel->ValidateInput($band))
								{
									
									if($this->db->checkIfBandExist($band))
									{
											
											$this->db->AddBand($band, $this->addbandeventview->getBandBiography(), $this->addbandeventview->getBandDiscography());
											$this->addbandeventview->successfulAddBand();
										
									}

								}
								
							}
						
					}
				}
				catch(Exception $e)
				{
					$this->addbandeventview->showMessage($e->getMessage());
				}
			}

			$this->doHTMLBody();
		}

		/*Kontrollerar om valideringen av indata är korrekt, då läggs bandet till.Annars kastas felmeddelande.Anropar alltid
		doHTMLBody som kontrollerar vilken vy som ska anropas. */
		public function doControllGenre(){
		
			//Kontrollerar om användaren är inloggad och har tryckt på lägg till band länken från menyn.
			if($this->loginview->didUserPressAddGenre() && $this->loginmodel->checkLoginStatus())
			{
				//Variabler som innehåller funktionsanrop istället för hela funktionsanrop i koden. Gör det lättare att läsa koden.
				$genre = $this->addbandeventview->getGenreName();

				

				try{

					
					if($this->addbandeventview->didUserPressAddGenreButton())
					{
						
						
						if($this->addbandeventmodel->CheckGenreLength($genre))
						{

							
							if($this->loginmodel->ValidateInput($genre))
							{	
								
								if($this->db->checkIfGenreExist($genre))
								{		
										
										$this->db->addGenre($genre);
										$this->addbandeventview->successfulAddGenre();
								}
							}
							
						}
					}

				}
				catch(Exception $e)
				{
					$this->addbandeventview->showMessage($e->getMessage());
				}

			}

			$this->doHTMLBody();

		}

		/*Kontrollerar om valideringen av indata är korrekt, då läggs band till livespelningen. Annars kastas felmeddelande.Anropar alltid
		doHTMLBody som kontrollerar vilken vy som ska anropas. */
		public function doControllBandToEvent(){

			if($this->loginview->didUserPressAddBandToEvent() && $this->loginmodel->checkLoginStatus())
			{

				//Variabler som innehåller funktionsanrop istället för hela funktionsanrop i koden. Gör det lättare att läsa koden.
				$genredropdownvalue = $this->addbandeventview->pickedGenreDropdownValue();
				$banddropdownvalue = $this->addbandeventview->pickedBandDropdownValue();
				
				
				
				try{

					if($this->addbandeventview->didUserPressAddBandToEventButton())
					{

						if($this->db->checkIfBandExistsOnEvent($genredropdownvalue,$banddropdownvalue))
						{
							if($this->db->checkIfPickEventFromEventTableIsManipulated($genredropdownvalue))
							{
								if($this->db->checkIfPickBandFromBandTableIsManipulated($banddropdownvalue))
								{
									$this->db->addBandToGenre($genredropdownvalue,$banddropdownvalue);
									$this->addbandeventview->successfulAddBandToGenre();
								}
								

							}

						}
					}

				}
				catch(Exception $e)
				{
					$this->addbandeventview->showMessage($e->getMessage());
				}




			}

			$this->doHTMLBody();


		}

		public function doControllAlbum(){

			if($this->loginview->didUserPressAddAlbum() && $this->loginmodel->checkLoginStatus())
			{
				try{
					$album = $this->addbandeventview->getAlbumName();
					$contents = $this->addbandeventview->getContents();
					$persons = $this->addbandeventview->getPersons();

					if($this->addbandeventview->didUserPressAddAlbumButton())
					{
						if($this->addbandeventmodel->CheckAlbumLength($album))
						{
							if($this->addbandeventmodel->CheckContentsLength($contents))
							{
								if($this->addbandeventmodel->CheckPersonsLength($persons))
								{
									if($this->loginmodel->ValidateInput($album))
									{
										if($this->loginmodel->ValidateInputText($contents))
										{

											if($this->loginmodel->ValidateInputText($contents))
											{
												if($this->db->checkIfGenreExist($album))
												{
													$this->db->AddAlbum($album, $contents, $persons);
													$this->addbandeventview->successfulAddAlbum();
										
												}
											}


										}


									}

								}

							}

						}


					}
				}
				catch(Exception $e)
				{
					$this->addbandeventview->showMessage($e->getMessage());
				}


			}
			



			$this->doHTMLBody();

		}

		//Kontrollerar vilket formulär som ska skrivas ut av vyn beroende på vilka olika knappar och/eller länkar användaren tryckt på.
		public function doHTMLBody()
		{

			
				if($this->loginview->didUserPressAddBand())
				{
					$this->addbandeventview->ShowAddBandPage();
				}

				if($this->loginview->didUserPressAddGenre())
				{
					$this->addbandeventview->ShowAddGenrePage();
				}

				if($this->loginview->didUserPressAddBandToEvent())
				{
					$genres = $this->db->fetchAllGenres();
					$bands = $this->db->fetchAllBands();
					

					$this->addbandeventview->ShowAddBandToEventPage($genres, $bands);
				}
				if($this->loginview->didUserPressAddAlbum())
				{	
					$this->addbandeventview->ShowAddAlbumPage();
				}

				
				
			
			
		}


	}