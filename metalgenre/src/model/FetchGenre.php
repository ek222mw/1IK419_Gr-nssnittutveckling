<?php 

	class FetchGenre{

		private $m_name;
		private $m_id;
		
		private $m_username;

		//Tilldelar privata variabler konstruktorns invärden.
		public function __construct($name,$id, $username){
			$this->m_name = $name;
			$this->m_id = $id;
			
			$this->m_username = $username;

		}

		//Returnerar namnet.
		public function getName(){

			return $this->m_name;
		}

		//Returnerar idet.
		public function getID(){

			return $this->m_id;
		}


		public function getUsername(){

			return $this->m_username;
		}

	}