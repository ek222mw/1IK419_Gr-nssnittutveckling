<?php

	

	class AddBandEventModel{

			

		public function __construct(){

				
		}


		//Kontrollerar längden på det inmatade livespelningsvärdet. om giltigt returnera sant annars kasta undantag.	
		public function CheckGenreLength($genre){

			if(mb_strlen($genre) < 1 || mb_strlen($genre) > 50 ){

				// Kasta undantag.
				throw new Exception("Genren har för få tecken eller för många tecken. Måste vara mellan 1-50 tecken");
				
			}
			return true;

		}

		public function CheckAlbumLength($album){

			if(mb_strlen($album) < 1 || mb_strlen($album) > 70 ){

				// Kasta undantag.
				throw new Exception("Albumet har för få tecken eller för många tecken. Måste vara mellan 1-70 tecken");
				
			}
			return true;

		}

		public function CheckContentsLength($contents){

			if(mb_strlen($contents) < 1 || mb_strlen($contents) > 500 ){

				// Kasta undantag.
				throw new Exception("Innehållet har för få tecken eller för många tecken. Måste vara mellan 1-500 tecken");
				
			}
			return true;

		}

		public function CheckPersonsLength($persons){

			if(mb_strlen($persons) < 1 || mb_strlen($persons) > 500 ){

				// Kasta undantag.
				throw new Exception("Medverkande har för få tecken eller för många tecken. Måste vara mellan 1-500 tecken");
				
			}
			return true;

		}
		//Kontrollerar längden på det inmatade bandvärdet. Om giltigt returnera sant annars kasta undantag.
		public function CheckBandLength($band){

			if(mb_strlen($band) < 1 || mb_strlen($band) > 50 ){

				// Kasta undantag.
				throw new Exception("Bandet har för få tecken eller för många tecken. Måste vara mellan 1-50 tecken");
				
				
			}
			return true;
			
		}


	}

