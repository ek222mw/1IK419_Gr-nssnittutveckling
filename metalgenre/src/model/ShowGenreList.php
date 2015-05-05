<?php

	require_once("ShowGenre.php");
	
	class ShowGenreList{

		private $showgenres;

		//Lägger in privata varibeln showevents värden i en array.
		public function __construct(){

			$this->showgenres = array();
		}

		//Lägger in, in parametern showevent i arrayen.
		public function add(ShowGenre $showgenre){

			$this->showgenres[] = $showgenre;

		}

		//Returnerar arrayen.
		public function toArray(){

			return $this->showgenres;

		}

	}