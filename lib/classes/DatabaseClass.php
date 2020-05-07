<?php

namespace lib\classes;

use \PDO;

class DatabaseClass{
    protected $db;
    protected $PDOAuthArr;
    protected $answer;
    function __construct($connectData){
        $this->setData($connectData);
        $this->connection();
    }
    public function setData($c){
        $this->PDOAuthArr = $c;
    }
    private function connection(){
        try{
            $this->db = new PDO($this->PDOAuthArr['dsn'],$this->PDOAuthArr['user'],$this->PDOAuthArr['pass'],[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }catch (PDOException $e) {
            echo 'connection failed: ' . $e->getMessage();
        }
    }
    //return one position in array
    public function selectOne($tablename,$options,$arr){
        try {
            $result = $this->db->prepare("SELECT * FROM ".$tablename." ".$options);
            $result->execute($arr);
            $this->answer = $result->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
        	echo __LINE__.$e->getMessage();
        }
        return $this->returnAnswer();
    }
    //return array of elements
    public function selectAll($tablename,$options,$arr){
        try {
            $result = $this->db->prepare("SELECT * FROM ".$tablename." ".$options);
            $result->execute($arr);
            $this->answer = $result->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
        	echo __LINE__.$e->getMessage();
        }
        return $this->returnAnswer();
    }
    //update element
    public function update($tablename,$options,$arr){
        try {
            $result = $this->db->prepare("UPDATE ".$tablename." SET ".$options);
            $result->execute($arr);
        } catch(PDOException $e){
        	echo __LINE__.$e->getMessage();
        }
    }
    //any sql query
    public function query($sql,$arr){
        try {
            $result = $this->db->prepare($sql);
            $result->execute($arr);
            $this->a = $result->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
        	echo __LINE__.$e->getMessage();
        }
        return $this->returnAnswer();
    }
    //return answer from bd
    private function returnAnswer(){
        return $this->answer;
    }
}

?>