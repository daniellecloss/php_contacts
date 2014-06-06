<?php
/*
 * Author: Danielle Closs
 * File: database connection, controls access to database
 * Date:6/6/2012
 */
class DatabaseConnection
{
    private $db_host = "localhost";
    private $db_username = "root";
    private $db_password = "root";
    private $db_name = "yui_example";
    private $connection;
    private $selectDb;

    public function activateDbConnection() {
        $db_host = $this->db_host;
        $db_username = $this->db_username;
        $db_password = $this->db_password;
        $db_name = $this->db_name;

        try{
            $this->connection = mysqli_connect($db_host, $db_username, $db_password);
            $this->selectDb = mysqli_select_db($this->connection, $db_name);
            if ($this->connection === false)
            {
              throw new Exception('Cannot connect to mysql');
            }else{
                return $this->connection;
            }
        }catch(Exception $e){
            echo 'Cannot connect to mysql database. Please contact the website admin.';
        }
    }

    public function buildQueryString(
            $queryType, //insert, delete, update
            $queryData = NULL, //optional for delete, fields from the database to update
            $queryTable, // table to be pulled from
            $contactId = NULL //not required for insert, id of contact for database row to be deleted or updated
        ){
        $queryString = '';
        //build query string
        if ($queryType == 'selectall'){
            $queryString = 'SELECT ' . $queryData .' FROM '.$queryTable;
        }
        elseif ($queryType == 'select'){
            $queryString = 'SELECT * FROM '.$queryTable . ' WHERE ' . $queryData;
        }
        elseif($queryType == 'add'){
            $queryData = trim($queryData,'"');
            $queryString = 'INSERT INTO ' . $queryTable . ' VALUES (' . $queryData . ')';
        }
        elseif($queryType == 'delete'){
            $queryString = 'DELETE FROM '. $queryTable . ' WHERE contact_id=' . $contactId ;
        }
        elseif($queryType == 'update'){
            $queryData = trim($queryData,'"');
            $queryString = 'UPDATE ' . $queryTable . ' SET ' . $queryData . ' WHERE contact_id=' . $contactId;
            var_dump($queryString);
        }
        if($this->connection){
            return mysqli_query($this->connection,$queryString);
        }
    }

    public function closeDbConnection()
    {
        if($this->connection){
            mysqli_close($this->connection);
        }
    }

}