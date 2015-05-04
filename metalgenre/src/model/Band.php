<?php


	Class Band{

		private $m_name;
		private $m_id;
		private $m_biography;
		private $m_discography;

		//Tilldelar privata variabler konstruktorns invärden.
		public function __construct($name,$id,$biography,$discography){
			$this->m_name = $name;
			$this->m_id = $id;
			$this->m_biography = $biography;
			$this->m_discography = $discography;


		}

		//Returnerar namnet.
		public function getName(){

			return $this->m_name;
		}

		//Returnerar idet.
		public function getID(){

			return $this->m_id;
		}

		public function getBioGraphy(){

			return $this->m_biography;
		}

		public function getDiscoGraphy(){

			return $this->m_discography;
		}
	}