<?php
	
	require_once("./src/view/AddRatingView.php");
	require_once("./src/model/DBDetails.php");
	require_once("./src/view/LoginView.php");
	require_once("./src/model/LoginModel.php");
	require_once("./src/view/DeleteGenreView.php");
	require_once("./src/model/AddBandEventModel.php");

	class DeleteGenreController{

		
		private $addratingview;
		private $addbandeventmodel;
		private $db;
		private $view;
		private $model;
		private $deletegenreview;

		public function __construct(){
			$this->model = new LoginModel();
			$this->deletegenreview = new DeleteGenreView();
			$this->addbandeventmodel = new AddBandEventModel();
			// Skapar nya instanser av modell- & vy-klasser och lägger dessa i privata variabler.
			$this->addratingview = new AddRatingView();
			$this->db = new DBDetails();
			$this->view = new LoginView($this->model);


			$this->doControll();
		}


		public function doControll()
		{

			
				
			
					
				if($this->view->didUserPressDeleteGenre() || $this->deletegenreview->didUserPressChooseGenreButton())
				{
					
				
					
						
						$chosenid = $this->deletegenreview->getGenreID();
						$newdeletegenre = $this->deletegenreview->getDeleteGenre();
						$loggedinUser = $this->model->getLoggedInUser();
						$role = $this->db->getDBUserRole($loggedinUser);
						
						if($this->deletegenreview->didUserPressDeleteGenreButton())
						{
							
							try{
									if($role)
									{
											$this->db->DeleteGenre($chosenid);
											$this->db->DeleteCouplingGenre($chosenid);
											$this->deletegenreview->successfulDeleteGenre();
									}
		
									else if($this->db->checkIfIdManipulatedGenre($chosenid,$loggedinUser))
									{
										
											$this->db->DeleteGenre($chosenid);
											$this->db->DeleteCouplingGenre($chosenid);
											$this->deletegenreview->successfulDeleteGenre();
										
									}

							}


							catch(Exception $e)
							{
									$this->deletegenreview->showMessage($e->getMessage());
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

			if($this->view->didUserPressDeleteGenre() && !$this->deletegenreview->didUserPressChooseGenreButton() && !$role )
			{
			
				
				$loggedinUser = $this->model->getLoggedInUser();
				$fetchgenre = $this->db->fetchGenresWithUser($loggedinUser);
				$this->deletegenreview->ShowDeleteGenrePage($fetchgenre);
			}
			else if($this->view->didUserPressDeleteGenre() && !$this->deletegenreview->didUserPressChooseGenreButton() && $role)
			{
				$showGenres = $this->db->fetchShowAllGenres();
				$this->deletegenreview->ShowAdminDeleteGenrePage($showGenres);
			}
			

			if($this->deletegenreview->didUserPressChooseGenreButton())
			{
				
				$chgenre = $this->deletegenreview->pickedGenreDropdownValue();
				
				$fetchname = $this->db->fetchGenresWithName($chgenre);

				$this->deletegenreview->ShowChosenDeleteGenrePage($fetchname, $chgenre);
			}
			


		}


	}