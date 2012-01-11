<?php

// class.crud version Cooler_
class crud
{
    public $db;

    public function conn($x) {
//---------------------------------- CONFIGURE AQUI SEU SGBD, E O BANCO ETC...
    
     $sgbd="pgsql";
     if($x) 
      return $sgbd;
     $host="localhost"; 
     $user="user";
     $pass="passwd"; 
     $database="cactoo"; 
     $port="3009";

//---------------------------------------------------------------------------
//CASO USE PostGreSQL $conn = new PDO("pgsql:host=$host dbname=$database", $user, $pass);
//CASO USE SQLite "sqlite:/opt/database/localblabla/seu_banco.sq3"
     if (!$this->db instanceof PDO) {
      $this->db = new PDO("$sgbd:host=$host;port=$port;dbname=$database", $user, $pass);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     }
     
    } 

        public function dbSelect($table, $fieldname=null, $id=null)
        {
            $sgdb=$this->conn(1);
           // portabilidade xD
            if($sgdb=="pgsql")
             $sql = "SELECT * FROM $table WHERE $fieldname = :id";
            if($sgdb=="mysql")
             $sql = "SELECT * FROM `$table` WHERE `$fieldname` =:id"; 

            $this->conn();
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function dbSelect2($table, $fieldname=null, $id=null, $field2 , $value)
        {
            $this->conn();
            $sql = "SELECT * FROM $table WHERE $fieldname = :id and  $field2  = :value";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
             $stmt->bindParam(':value', $value);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function dbAll($table)
        {

            $sgdb=$this->conn(1);
//   portabilidade porca xD
            if($sgdb=="pgsql")
             $sql = " SELECT * FROM $table ";

            if($sgdb=="mysql")
             $sql = " SELECT * FROM `$table` ";
            
            $this->conn(); 
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         *
         * @execute a raw query
         *
         * @access public
         *
         * @param string $sql
         *
         * @return array
         *
         */
        public function rawSelect($sql)
        {
            $this->conn();
            return $this->db->query($sql);
        }

        /**
         *
         * @run a raw query
         *
         * @param string The query to run
         *
         */
        public function rawQuery($sql)
        {
            $this->conn();
            $this->db->query($sql);
        }


        /**
         *
         * @Insert a value into a table
         *
         * @acces public
         *
         * @param string $table
         *
         * @param array $values
         *
         * @return int The last Insert Id on success or throw PDOexeption on failure
         *
         */
        public function dbInsert($table, $values)
        {
/*

INSERT INTO servico( nomeprojeto ,endereco ,maoobra ,memorial ,valor ,condicao ,situacao ,datainicio ,datasaida ,cliente ,equipamento ,servicoexe ) VALUES (:nomeprojeto, :endereco, :maoobra, :memorial, :valor, :condicao, :situacao, :datainicio, :datasaida, :cliente, :equipamento, :servicoexe )
*/


            $this->conn();
            $fieldnames = array_keys($values[0]);
            $size = sizeof($fieldnames);
            $i = 1;
            $sql = "INSERT INTO $table";
            $fields = '( ' . implode(' ,', $fieldnames) . ' )';
            $bound = '(:' . implode(', :', $fieldnames) . ' )';
            $sql .= $fields.' VALUES '.$bound;
            $stmt = $this->db->prepare($sql);
            foreach($values as $vals)
            {
                $stmt->execute($vals);
            }

        }

        public function Update($table, $values, $pk, $id)
        {
            $this->conn();
 
            foreach($values as $key => $value)
            {

// $sql = "UPDATE `$table` SET "." `$key`".' = \''.$value."' WHERE `$pk` = :id";
                $sql = "UPDATE $table SET "." $key".' = :valor'." WHERE $pk = :id";
                $this->conn();
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':valor', $value, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                $stmt->execute();
            }

        }

        public function dbUpdate($table, $fieldname, $value, $pk, $id)
        {
         $this->conn();
             $sql = "UPDATE $table SET $fieldname='{$value}' WHERE $pk = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
        }


        /**
         *
         * @Delete a record from a table
         *
         * @access public
         *
         * @param string $table
         *
         * @param string $fieldname
         *
         * @param string $id
         *
         * @throws PDOexception on failure
         *
         */
        public function dbDelete($table, $fieldname, $id)
        {
            $sgdb=$this->conn(1);
           // portabilidade xD
            if($sgdb=="pgsql")
             $sql = "DELETE FROM '$table' WHERE '$fieldname' = :id";

            if($sgdb=="mysql")
             $sql = "DELETE FROM `$table` WHERE `$fieldname` = :id";
            
            $this->conn();

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
        }
    } /*** end of class ***/

?>
