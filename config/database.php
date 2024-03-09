<?php

    class Database{
        private $hostname= "localhost"; //Si se tiene en otra máquina se coloca la ip
        private $database = "cite";
        private $username = "root";
        private $password = "";
        private $charset = "utf8";

        public function conectar(){
            try {
                //code...
                $conexion = "mysql:host=".$this->hostname . "; dbname=" .$this->database . "; charset=".$this->charset;
                $conexion = "mysql:host=".$this->hostname . "; dbname=" .$this->database . "; charset=".$this->charset;
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false
                ];

                $pdo = new PDO($conexion,$this->username,$this->password,$options);

                return $pdo;
            } catch (PDOException $e ) {
                //throw $th;
                echo "Error conexion".$e->getMessage();
                exit;
            }
            
        }

    }