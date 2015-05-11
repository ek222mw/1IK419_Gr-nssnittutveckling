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
						
						if($this->deletegenreview->didUserPressDeleteGenreButton())
						{
							
						try{

						
							
							
								if($this->db->checkIfIdManipulatedGenre($chosenid,$loggedinUser))
								{
									
										$this->db->DeleteGenre($chosenid);
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
			if($this->view->didUserPressDeleteGenre() && !$this->deletegenreview->didUserPressChooseGenreButton() )
			{
			
				
				$loggedinUser = $this->model->getLoggedInUser();
				$fetchgenre = $this->db->fetchGenresWithUser($loggedinUser);
				$this->deletegenreview->ShowDeleteGenrePage($fetchgenre);
			}
			

			if($this->deletegenreview->didUserPressChooseGenreButton())
			{
				
				$chgenre = $this->deletegenreview->pickedGenreDropdownValue();
				
				$fetchid = $this->db->fetchGenresWithID($chgenre);

				$this->deletegenreview->ShowChosenDeleteGenrePage($fetchid, $chgenre);
			}
			


		}


	}