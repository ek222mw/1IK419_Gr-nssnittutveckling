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
						$loggedinUser = $this->model->getLoggedInUser();
						$role = $this->db->getDBUserRole($loggedinUser);
						
						if($this->editgenreview->didUserPressEditGenreButton())
						{
							
						try{

						if($this->addbandeventmodel->CheckGenreLength($neweditgenre))
						{
							
							if($this->model->ValidateInput($neweditgenre))
							{
								if($role)
								{
										$this->db->EditGenre($neweditgenre,$chosenid);
										$this->db->EditCouplingGenre($neweditgenre,$chosenid);
										$this->editgenreview->successfulEditGenre();
								}
								else if($this->db->checkIfIdManipulatedGenre($chosenid,$loggedinUser))
								{
									
										$this->db->EditGenre($neweditgenre,$chosenid);
										$this->db->EditCouplingGenre($neweditgenre,$chosenid);
										$this->editgenreview->successfulEditGenre();
									
								}

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
			$loggedinUser = $this->model->getLoggedInUser();
			$role = $this->db->getDBUserRole($loggedinUser);
			

			if($this->view->didUserPressEditGenre() && !$this->editgenreview->didUserPressChooseGenreButton() && !$role)
			{
			
				
				$loggedinUser = $this->model->getLoggedInUser();
				$fetchgenre = $this->db->fetchGenresWithUser($loggedinUser);
				$this->editgenreview->ShowEditGenrePage($fetchgenre);
			}
			else if($this->view->didUserPressEditGenre() && !$this->editgenreview->didUserPressChooseGenreButton() && $role)
			{
				$showGenres = $this->db->fetchShowAllGenres();
				$this->editgenreview->ShowAdminEditGenrePage($showGenres);
			}
			

			if($this->editgenreview->didUserPressChooseGenreButton())
			{
				
				$chgenre = $this->editgenreview->pickedGenreDropdownValue();
				
				$fetchname = $this->db->fetchGenresWithName($chgenre);

				$this->editgenreview->ShowChosenEditGenrePage($fetchname, $chgenre);
			}
			


		}


	}