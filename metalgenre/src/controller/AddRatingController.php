<?php


	require_once("./src/model/LoginModel.php");
	require_once("./src/view/LoginView.php");
	require_once("./src/view/AddBandEventView.php");
	require_once("./src/view/AddRatingView.php");
	require_once("./src/model/DBDetails.php");

	class AddRatingController{


		private $loginview;
		private $loginmodel;
		private $addbandeventview;
		private $addratingview;
		private $db;

		public function __construct(){

						
			// Skapar nya instanser av modell- & vy-klasser och lägger dessa i privata variabler.
			$this->loginmodel = new LoginModel();
			$this->loginview = new LoginView($this->loginmodel);
			$this->addbandeventview = new AddBandEventView();
			$this->addratingview = new AddRatingView();
			$this->db = new DBDetails();


			$this->doControll();
		}


		/*Kontrollerar indata, om alla valideringar är uppfyllda så skapas ett betyg, annars kastas ett felmeddelande.
		Anropar alltid doHTMLBody som har hand om kontroll av vilka vyer som ska visas. */
		public function doControll(){

			if($this->loginview->didUserPressAddRating() && $this->loginmodel->checkLoginStatus())
			{
				//Variabler som innehåller funktionsanrop istället för hela funktionsanrop i koden. Gör det lättare att läsa koden.
				$albumdropdownvalue = $this->addbandeventview->pickedAlbumDropdownValue();
				$gradedropdownvalue = $this->addratingview->pickedGradeDropdownValue();
				$loggedinUser = $this->loginmodel->getLoggedInUser();


				try{

					
					if($this->addratingview->didUserPressAddGradeButton())
					{	
						 
						if($this->db->checkIfGradeExistOnAlbumUser($albumdropdownvalue, $loggedinUser))
						{	
							
							if($this->db->checkIfAlbumManipulated($albumdropdownvalue))
							{	
								
								
								if($this->db->checkIfPickRatingManipulated($gradedropdownvalue))
								{	
									
									$this->db->addGradeToAlbumWithUser($albumdropdownvalue,$gradedropdownvalue,$loggedinUser);
									$this->addratingview->successfulAddGradeToEventWithBand();
								}
							}
						}

					}
				

				}
				catch(Exception $e)
				{	
					$this->addratingview->showMessage($e->getMessage());
				}

				
			}

			$this->doHTMLBody();

		}


		/*Kontrollerar vilket formulär som ska skrivas ut av vyn beroende på vilka olika knappar och/eller länkar användaren tryckt på.
		Kastar felmeddelande om manipulering av event gjorts och fångar och kontrollerar vilken vy som ska visa detta meddelande. */
		public function doHTMLBody()
		{
				
				//Variabler som innehåller funktionsanrop istället för hela funktionsanrop i koden. Gör det lättare att läsa koden
				$albums = $this->db->fetchAllAlbumsWithBands();
				$grades = $this->db->fetchAllGrades();
				
				

				try
				{
					
						
						$this->addratingview->ShowAddRatingPage($albums, $grades);
						
					

					
				}
				catch(Exception $e)
				{
					$this->addratingview->showMessage($e->getMessage());
					$this->addratingview->ShowAddRatingPage($albums, $grades);
				}


		
			}



	}