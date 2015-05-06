<?php

require_once("AlbumGrade.php");

	class AlbumGradeList{


		private $albums;

		//Lägger in privata varibeln bands värden i en array.
		public function __construct(){

			$this->albums = array();
		}

		//Lägger in, in parametern band i arrayen.
		public function add(AlbumGrade $album){

			$this->albums[] = $album;

		}

		//Returnerar arrayen.
		public function toArray(){

			return $this->albums;

		}


	}