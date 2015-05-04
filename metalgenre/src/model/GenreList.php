<?php

require_once("Genre.php");

	class GenreList{


		private $genres;

		//Lägger in privata varibeln events värden i en array.
		public function __construct(){

			$this->genres = array();
		}

		//Lägger in, in parametern event i arrayen.
		public function add(Genre $genre){

			$this->genres[] = $genre;

		}

		//Returnerar arrayen.
		public function toArray(){

			return $this->genres;

		}

	}