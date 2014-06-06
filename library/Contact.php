<?php
/*
 * Author: Danielle Closs
 * File: contact model, has methods to get, edit, and search contacts
 * Date:6/6/2012
 */
require_once("DatabaseConnection.php" );
class Contact
{
    public function searchContacts($query = NULL){
        $recordSet = '';
        $db = new DatabaseConnection();
        $db->activateDbConnection();
        if($query == NULL){
            $records = $db->buildQueryString('selectall','*','contacts');
        }else{
            $queryString = $query;
            $records = $db->buildQueryString('select', $queryString ,'contacts');
        }

        if($records && $records->num_rows > 0){
            while($row = mysqli_fetch_assoc($records)){
              $recordSet[] = $row;
            }
        }
        $db->closeDbConnection();
        $recordSet = json_encode($recordSet);
        return $recordSet;
    }

    public function queryContacts($queryType, $recordData, $tableName, $contactId = NULL){
        $db = new DatabaseConnection();
        $db->activateDbConnection();
        $recordSuccess = $db->buildQueryString($queryType, $recordData , $tableName,$contactId);
        $db->closeDbConnection();
        if($recordSuccess == true){
            return true;
        }else{
            return false;
        }
    }

    public function processRequest(){
        $submitType = $_POST['editType'];
        $contact = new Contact();
        if($submitType == 'add'){
            $variableString = '"\'\',';
            $i=0;
            foreach($_POST as $value){
                if($i > 0){
                    $variableString .="'". $value . "',";
                }
                $i++;
            }
            $variableString = trim($variableString,',');
            $variableString .= '"';
            $success = $contact->queryContacts($submitType,$variableString, 'contacts');
            if($success){
                echo "<p class='message'>Your contact has been " . trim($submitType, 'e') . "ed.</p>";
            }else{
                echo '<p class="error_message">There was an error with your submission</p>';
            }
            
        }
        elseif($submitType == 'delete'){
            $id = $_POST['contact_id'];
            $success = $contact->queryContacts('delete','' ,'contacts' , $id);
            if($success){
                echo "<p class='message'>Your contact has been " . trim($submitType, 'e') . "ed.</p>";
            }else{
                echo '<p class="error_message">There was an error with your submission</p>';
            }
        }
        elseif($submitType == 'update'){
            $variableString = "";
            $id = $_POST['contact_id'];
            $i=0;
            foreach($_POST as $key=>$value){
                if($i > 1){
                    $variableString .= $key ."='". $value . "',";
                }
                $i++;
            }
            $variableString = trim($variableString,',');
            $success = $contact->queryContacts('update', $variableString, 'contacts', $id);
            if($success){
                echo "<p class='message'>Your contact has been " . trim($submitType, 'e') . "ed.</p>";
            }else{
                echo '<p class="error_message">There was an error with your submission</p>';
            }
        }
    }
}