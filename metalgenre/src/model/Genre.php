<?php 

	class Genre{

		private $m_name;
		private $m_id;
		private $m_imgpath;

		//Tilldelar privata variabler konstruktorns invärden.
		public function __construct($name,$id,$imgpath){
			$this->m_name = $name;
			$this->m_id = $id;
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

		public function getImgpath(){

			return $this->m_imgpath;
		}

	}