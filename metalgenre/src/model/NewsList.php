<?php

require_once("News.php");

	class NewsList{


		private $news;

		//Lägger in privata varibeln events värden i en array.
		public function __construct(){

			$this->news = array();
		}

		//Lägger in, in parametern event i arrayen.
		public function add(News $new){

			$this->news[] = $new;

		}

		//Returnerar arrayen.
		public function toArray(){

			return $this->news;

		}

	}