<?php


	Class AlbumGrade{

		private $m_grade;
		private $m_id;
		

		//Tilldelar privata variabler konstruktorns invärden.
		public function __construct($grade,$id){
			$this->m_grade = $grade;
			$this->m_id = $id;
			

		}

		//Returnerar namnet.
		public function getGrade(){

			return $this->m_grade;
		}

		//Returnerar idet.
		public function getID(){

			return $this->m_id;
		}

	}