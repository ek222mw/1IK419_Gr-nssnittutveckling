<?php

	require_once("./common/HTMLView.php");
	require_once("LoginController.php");
	require_once("AddBandEventController.php");
	require_once("./src/model/LoginModel.php");
	require_once("./src/view/LoginView.php");
	require_once("AddRatingController.php");
	require_once("ShowEventController.php");
	require_once("EditRatingController.php");
	require_once("DeleteRatingController.php");
	require_once("ShowGenreController.php");
	require_once("AddBandToAlbumController.php");
	require_once("EditGenreController.php");
	require_once("DeleteGenreController.php");
	require_once("ShowContactController.php");
	
	
	
	class NavigationController{

		private $model;
		private $view;
			
		public function __construct(){
			
						
			// Skapar nya instanser av modell- & vy-klassen och lägger dessa i privata variabler.
			$this->model = new LoginModel();
			$this->view = new LoginView($this->model);

			//Väljer vilken controller som ska användas beroende på indata, t.ex. knappar och länkar.
			if(!$this->view->didUserPressAddBand() && !$this->view->didUserPressAddRating() && !$this->view->didUserPressAddBandToEvent() && !$this->view->didUserPressAddGenre() && 
				!$this->view->didUserPressShowAllEvents() && !$this->view->didUserPressEditGrades() && !$this->view->didUserPressDeleteGrade() && !$this->view->didUserPressShowGenre()
				&& !$this->view->didUserPressAddBandToAlbum() && !$this->view->didUserPressAddAlbum() && !$this->view->didUserPressEditGenre() && !$this->view->didUserPressDeleteGenre()
				&& !$this->view->didUserPressContact())
			{
				$loginC = new LoginController();
				$htmlBodyLogin = $loginC->doHTMLBody();
			}
			
			else if(($this->view->didUserPressAddBand() || $this->view->didUserPressAddBandToEvent() || $this->view->didUserPressAddGenre() || $this->view->didUserPressAddAlbum()) && $this->model->checkLoginStatus())
			{
				$AddEventBandC = new AddBandEventController();
				
			}

			else if($this->view->didUserPressAddRating() && $this->model->checkLoginStatus())
			{
				$AddRatingC = new AddRatingController();
			}

			else if($this->view->didUserPressShowAllEvents() && $this->model->checkLoginStatus())
			{
				$ShowEventsC = new ShowEventController();
			}

			else if($this->view->didUserPressEditGrades() && $this->model->checkLoginStatus())
			{	
				$EditRatingC = new EditRatingController();
			}

			else if($this->view->didUserPressDeleteGrade() && $this->model->checkLoginStatus())
			{
				$DeleteRatingC = new DeleteRatingController();
			}
			else if($this->view->didUserPressShowGenre() && $this->model->checkLoginStatus())
			{
				$ShowGenreC = new ShowGenreController();
			}
			else if($this->view->didUserPressAddBandToAlbum() &&  $this->model->checkLoginStatus())
			{
				$addbandtoalbumC = new AddBandToAlbumController();
			}
			else if($this->view->didUserPressEditGenre() && $this->model->checkLoginStatus())
			{
				$editgenreC = new EditGenreController();
			}
			else if($this->view->didUserPressDeleteGenre() && $this->model->checkLoginStatus())
			{
				$deletegenreC = new DeleteGenreController();
			}
			else if($this->view->didUserPressContact() && $this->model->checkLoginStatus())
			{
				$showcontactC = new ShowContactController();
			}

			else{

				$loginControl = new LoginController();
				$htmlBodyLogin = $loginControl->doHTMLBody();
			}
			

			

			
		}


	}