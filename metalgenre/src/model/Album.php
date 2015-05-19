<?php


	Class Album{

		private $m_name;
		private $m_id;
		private $m_contents;
		private $m_persons;
		private $m_imgpath;

		//Tilldelar privata variabler konstruktorns invärden.
		public function __construct($name,$id,$contents,$persons,$imgpath){
			$this->m_name = $name;
			$this->m_id = $id;
			$this->m_contents = $contents;
			$this->m_persons = $persons;
			$this->m_imgpath = $imgpath;


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

		public function getImgpath(){

			return $this->m_imgpath;
		}
	}