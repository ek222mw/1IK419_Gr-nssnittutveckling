<?php

	
	require_once("./src/view/AddRatingView.php");
	require_once("./src/model/DBDetails.php");
	require_once("./src/view/LoginView.php");
	require_once("./src/model/LoginModel.php");
	require_once("./src/view/AddBandEventView.php");

	class AddBandToAlbumController{

		
		private $addratingview;
		private $addbandeventview;
		private $db;
		private $view;
		private $model;

		public function __construct(){
			$this->model = new LoginModel();
			// Skapar nya instanser av modell- & vy-klasser och lägger dessa i privata variabler.
			$this->addratingview = new AddRatingView();
			$this->addbandeventview = new AddBandEventView();
			$this->db = new DBDetails();
			$this->view = new LoginView($this->model);


			$this->doControllBandToAlbum();
		}

		public function doControllBandToAlbum(){

			if($this->view->didUserPressAddBandToAlbum() && $this->model->checkLoginStatus())
			{

				//Variabler som innehåller funktionsanrop istället för hela funktionsanrop i koden. Gör det lättare att läsa koden.
				$albumdropdownvalue = $this->addbandeventview->pickedAlbumDropdownValue();
				$banddropdownvalue = $this->addbandeventview->pickedBandDropdownValue();
				
				
				
				try{

					if($this->addbandeventview->didUserPressAddBandToAlbumButton())
					{
						
						if($this->db->checkIfBandExistsOnAlbum($albumdropdownvalue,$banddropdownvalue))
						{	
							if($this->db->checkIfPickAlbumFromAlbumTableIsManipulated($albumdropdownvalue))
							{	
								if($this->db->checkIfPickBandFromBandTableIsManipulated($banddropdownvalue))
								{	
									$this->db->addBandToAlbum($albumdropdownvalue,$banddropdownvalue);
									$this->addbandeventview->successfulAddBandToAlbum();
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
			
				
				if($this->view->didUserPressAddBandToAlbum())
				{
					$albums = $this->db->fetchAllAlbums();
					$bands = $this->db->fetchAllBands();
					

					$this->addbandeventview->ShowAddBandToAlbumPage($albums,$bands);
				}

				
				
			
			
		}


	}