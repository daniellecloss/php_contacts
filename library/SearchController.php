<?php
/*
 * Author: Danielle Closs
 * File: search controller
 * Date:6/6/2012
 */
require_once("Contact.php");

class SearchController {
public $contact;

    public function __construct()
    {
         $this->contact = new Contact();
    }

    public function index()
    {
         if (!isset($_POST))
         {
            // show all results
            $results = $this->contact->searchContacts();
            return $results;
         }
         else
         {
             // show subset of results using search
//             echo 'in search controller';
             $queryString = '';
             $i = 0;
             foreach($_POST as $key=>$data){
                 $key = strip_tags($key);
                 $data = strip_tags($data);
                 if($data!='' && $i > 0){
                     $queryString .= $key." LIKE '%".$data."%' AND ";
                 }elseif($data!=''){
                     $queryString .= $key."='".$data."' AND ";
                 }
                 $i++;
             }
             $queryString = trim($queryString,' AND ');
             $results = $this->contact->searchContacts($queryString);
//             echo $results;
             if($results != '""'){
                 return $results;
             }else{
                 return false;
             }

         }
    }
}
