<?php

	require_once("AlbumBand.php");

	class AlbumBandList{

		
		private $albumbands;

		//Lägger in privata varibeln eventbands värden i en array.
		public function __construct(){

			$this->eventbands = array();
		}

		//Lägger in, in parametern eventband i arrayen.
		public function add(AlbumBand $albumband){

			$this->albumbands[] = $albumband;

		}

		//Returnerar arrayen.
		public function toArray(){

			return $this->albumbands;

		}


	



	}