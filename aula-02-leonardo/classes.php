<?php
class Film {
        public $title;
        public $episode; 
        public $date;
        public $characters;
        public $planets;
        public $species;
        public $vehicles;
        public $startships;

        function __construct($item) {
            // var_dump($item);
            $this->title = $item->title;
            $this->episode = $item->episode_id;
            $this->date = $item->release_date;
        }

    }

    // criada a classe que receberá todos os personagem pertencentes ao filme
    class People {
        public $urlPeople;

        function __construct($item) {
            $this->urlPeople = $item;
        }
    }

    class Planets {
        public $urlPlanets;

        function __construct($item) {
            $this->urlPlanets = $item;
        }
    }

    class Species {
        public $urlSpecies;

        function __construct($item) {
            $this->urlSpecies = $item;
        }
    }

    class Vehicles {
        public $urlVehicles;

        function __construct($item) {
            $this->urlVehicles = $item;
        }
    }

    class Startships {
        public $urlStartships;

        function __construct($item) {
            $this->urlStartships = $item;
        }
    }