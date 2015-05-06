<?php

	
	require_once("./src/view/AddRatingView.php");
	require_once("./src/model/DBDetails.php");
	require_once("./src/view/LoginView.php");
	require_once("./src/model/LoginModel.php");

	class ShowGenreController{

		
		private $addratingview;
		private $db;
		private $view;
		private $model;

		public function __construct(){
			$this->model = new LoginModel();
			// Skapar nya instanser av modell- & vy-klasser och lägger dessa i privata variabler.
			$this->addratingview = new AddRatingView();
			$this->db = new DBDetails();
			$this->view = new LoginView($this->model);


			$this->doHTMLBody();
		}

		//anropar vilken vy som ska visas.
		public function doHTMLBody()
		{
			if($this->view->didUserPressShowGenre() && !$this->addratingview->didUserPressGenre() && !$this->addratingview->didUserPressAlbum())
			{
				
				$showGenres = $this->db->fetchShowAllGenres();

				$this->addratingview->ShowAllGenres($showGenres);
			}

			else if($this->addratingview->didUserPressGenre())
			{
				
				$genrename = $this->addratingview->getGenreID();
				$showBand = $this->db->fetchGenre($genrename);
				$this->addratingview->ShowGenre($showBand, $genrename);
			}
			else if($this->addratingview->didUserPressAlbum())
			{
				
				$albumname = $this->addratingview->getAlbumID();
				$showAlbum = $this->db->fetchBand($albumname);
				$this->addratingview->ShowAlbum($showAlbum,$albumname);
			}



		}


	}