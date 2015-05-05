<?php


	Class Album{

		private $m_name;
		private $m_id;
		private $m_contents;
		private $m_persons;

		//Tilldelar privata variabler konstruktorns invärden.
		public function __construct($name,$id,$contents,$persons){
			$this->m_name = $name;
			$this->m_id = $id;
			$this->m_contents = $contents;
			$this->m_persons = $persons;


		}

		//Returnerar namnet.
		public function getName(){

			return $this->m_name;
		}

		//Returnerar idet.
		public function getID(){

			return $this->m_id;
		}

		public function getContents(){

			return $this->m_contents;
		}

		public function getPersons(){

			return $this->m_persons;
		}
	}