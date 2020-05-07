<?php

namespace lib\classes;

use \PDO;

/**
 * Work with the database
 * @property $db Object of database
 * @property $PDOAuthArr Contains data for connection
 * @property $answer Response to queries from the database
 */

class DatabaseClass{
    protected $db;
    protected $PDOAuthArr;
    protected $answer;
    function __construct($connectData){
        $this->setData($connectData);
        $this->connection();
    }
    /**
     * Set auth data
     */
    public function setData($c){
        $this->PDOAuthArr = $c;
    }
    /**
     * Create connection to mysql
     */
    private function connection(){
        try{
            $this->db = new PDO($this->PDOAuthArr['dsn'],$this->PDOAuthArr['user'],$this->PDOAuthArr['pass'],[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }catch (PDOException $e) {
            echo 'connection failed: ' . $e->getMessage();
        }
    }

    /**
     * Selection on one element in the table
     * 
     * @param string $tablename Table name
     * 
     * @param string $options Terms sql of request
     * 
     * @param string[] $arr Array of keys for $options
     * 
     * @return array one element in array
     */
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

    /**
     * Selection multiple array of elements
     * 
     * @param string $tablename Table name
     * 
     * @param string $options Terms sql of request
     * 
     * @param string[] $arr Array of keys for $options
     * 
     * @return array some elements in array
     */
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
    /**
     * Update base element
     * 
     * @param string $tablename Table name
     * 
     * @param string $options Terms sql of request
     * 
     * @param string[] $arr Array of keys for $options
     * 
     */
    public function update($tablename,$options,$arr){
        try {
            $result = $this->db->prepare("UPDATE ".$tablename." SET ".$options);
            $result->execute($arr);
        } catch(PDOException $e){
        	echo __LINE__.$e->getMessage();
        }
    }
    /**
     * Any sql query
     * 
     * @param string $sql SQL string
     * 
     * @param string $arr Array of keys for $sql
     * 
     * @return any Array data
     * 
     */
    public function query($sql,$arr){
        try {
            $result = $this->db->prepare($sql);
            $result->execute($arr);
            $this->answer = $result->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
        	echo __LINE__.$e->getMessage();
        }
        return $this->returnAnswer();
    }

    /**
     * Return answer from bd
     */
    private function returnAnswer(){
        return $this->answer;
    }
}

?>