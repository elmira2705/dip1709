<?php

    trait DatabaseTrait
    {
        private $db = NULL;

        public function doRequest($request, $params)
        {
           $this->getDatabase();
           return $this->db->doRequest($request, $params);
        }

        private function getDatabase()
        {
            if ($this->db === NULL) {
                $this->db = new Database();
            }
        }

    }
