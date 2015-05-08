<?php
	
	require_once("./src/view/AddRatingView.php");
	require_once("./src/model/DBDetails.php");
	require_once("./src/view/LoginView.php");
	require_once("./src/model/LoginModel.php");
	require_once("./src/view/EditGenreView.php");
	require_once("./src/model/AddBandEventModel.php");

	class EditGenreController{

		
		private $addratingview;
		private $addbandeventmodel;
		private $db;
		private $view;
		private $model;
		private $editgenreview;

		public function __construct(){
			$this->model = new LoginModel();
			$this->editgenreview = new EditGenreView();
			$this->addbandeventmodel = new AddBandEventModel();
			// Skapar nya instanser av modell- & vy-klasser och lägger dessa i privata variabler.
			$this->addratingview = new AddRatingView();
			$this->db = new DBDetails();
			$this->view = new LoginView($this->model);


			$this->doControll();
		}


		public function doControll()
		{

			
				
			
					
				if($this->view->didUserPressEditGenre() || $this->editgenreview->didUserPressChooseGenreButton())
				{
					
				
					
						
						$chosenid = $this->editgenreview->getGenreID();
						$neweditgenre = $this->editgenreview->getEditGenre();
						
						if($this->editgenreview->didUserPressEditGenreButton())
						{
							
						try{

						if($this->addbandeventmodel->CheckGenreLength($neweditgenre))
						{
							
							if($this->model->ValidateInput($neweditgenre))
							{
								$this->db->EditGenre($neweditgenre,$chosenid);
								$this->editgenreview->successfulEditGenre();

							}

						}


					}


					catch(Exception $e)
					{
							$this->editgenreview->showMessage($e->getMessage());
					}
				
				}
			}
				
			
			$this->doHTMLBody();
		}

		//anropar vilken vy som ska visas.
		public function doHTMLBody()
		{
			if($this->view->didUserPressEditGenre() && !$this->editgenreview->didUserPressChooseGenreButton() )
			{
			
				
				$loggedinUser = $this->model->getLoggedInUser();
				$fetchgenre = $this->db->fetchGenresWithUser($loggedinUser);
				$this->editgenreview->ShowEditGenrePage($fetchgenre);
			}
			

			if($this->editgenreview->didUserPressChooseGenreButton())
			{
				
				$chgenre = $this->editgenreview->pickedGenreDropdownValue();
				
				$fetchid = $this->db->fetchGenresWithID($chgenre);

				$this->editgenreview->ShowChosenEditGenrePage($fetchid, $chgenre);
			}
			


		}


	}