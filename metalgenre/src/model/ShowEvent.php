<?php 


	class ShowEvent{


		private $m_album;
		private $m_id;
		private $m_grade;
		private $m_user;

		//Tilldelar privata variabler konstruktorns invärden.
		public function __construct($album,$id,$grade,$user){
			$this->m_album = $album;
			$this->m_id = $id;
			$this->m_grade = $grade;
			$this->m_user = $user;

		}

		//Returnerar bandet.
		public function getAlbum(){

			return $this->m_album;
		}

		//Returnerar idet.
		public function getID(){

			return $this->m_id;
		}

		//Returnerar betyget.
		public function getGrade()
		{
			return $this->m_grade;
		}

		//Returnerar användaren.
		public function getUser()
		{
			return $this->m_user;
		}


	}