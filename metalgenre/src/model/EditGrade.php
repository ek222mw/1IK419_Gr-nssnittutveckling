<?php


	class EditGrade
	{
		private $m_grade;
		private $m_id;
		private $m_album;
		private $m_user;

		//tilldelar privata variabler konstruktorns invärden.
		public function __construct($grade,$id,$album,$user){
			$this->m_grade = $grade;
			$this->m_id = $id;
			$this->m_album = $album;
			$this->m_user = $user;

		}

		//Returnerar betyget.
		public function getGrade(){

			return $this->m_grade;
		}

		//Returnerar idet.
		public function getID(){

			return $this->m_id;
		}

		//Returnerar livespelningen.
		public function getAlbum(){

			return $this->m_album;
		}


		//Returnerar användaren.
		public function getUser(){

			return $this->m_user;
		}

	
	}