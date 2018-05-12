

<?php
    class perguntas{
        public $id;
        public $titulo;
        public $tipo;
        public $ativa;

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getTitulo()
        {
            return $this->titulo;
        }

        /**
         * @param mixed $titulo
         */
        public function setTitulo($titulo)
        {
            $this->titulo = $titulo;
        }

        /**
         * @return mixed
         */
        public function getTipo()
        {
            return $this->tipo;
        }

        /**
         * @param mixed $tipo
         */
        public function setTipo($tipo)
        {
            $this->tipo = $tipo;
        }

        /**
         * @return mixed
         */
        public function getAtiva()
        {
            return $this->ativa;
        }

        /**
         * @param mixed $ativa
         */
        public function setAtiva($ativa)
        {
            $this->ativa = $ativa;
        }
    }
?>