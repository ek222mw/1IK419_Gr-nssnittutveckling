<?php 

	class News{

		private $m_news;
		private $m_newsid;
		

		//Tilldelar privata variabler konstruktorns invärden.
		public function __construct($news,$newsid){
			$this->m_news = $news;
			$this->m_newsid = $newsid;
			

		}

		//Returnerar namnet.
		public function getNews(){

			return $this->m_news;
		}

		//Returnerar idet.
		public function getID(){

			return $this->m_newsid;
		}

		

	}