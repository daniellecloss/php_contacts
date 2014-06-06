<?php
/*
 * Author: Danielle Closs
 * File: Main index file, frontend routing
 * Date:6/6/2012
 */
require_once("../library/Contact.php" ); ?>
<html>
<head>
    <title>YUI Example > Contact App > Contacts Admin</title>
    <script src="http://yui.yahooapis.com/3.5.1/build/yui/yui-min.js"></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
    <script type="text/javascript" src='../scripts.js'></script>
    <link rel="stylesheet" type="text/css" href="../styles/styles.css" />
</head>
<body>
<h1>YUI Example - Contacts Admin</h1>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $contact = new Contact();
        $contact->processRequest();
    }
?>
<div id='nav'><a href='/programming_examples/php_contacts/'>Go to Search</a></div>
<form id='adminForm' class='form' method="post">
    <div class='radio_group'>
        <input type='radio' name='editType' id='radio_add' value='add' checked="checked" />
        <label for='radio_add'>Add</label>
        <input type='radio' name='editType' id='radio_update' value='update'/>
        <label for='radio_update'>Update</label>
        <input type='radio' name='editType' id='radio_delete' value='delete'/>
        <label for='radio_delete'>Delete</label>
    </div>
    <div class='text_inputs'>
        <label for='contact_id'>Id:</label>
        <input type="text" id='contact_id' name='contact_id' disabled="disabled" />
        <label for='contact_firstname'>First Name:</label>
        <input type="text" id='contact_firstname' name='contact_firstname' />
        <label for='contact_lastname'>Last Name:</label>
        <input type="text" id='contact_lastname' name='contact_lastname' />
        <label for='address'>Address:</label>
        <input type="text" id='address' name='address' />
        <label for='city'>City:</label>
        <input type="text" id='city' name='city' />
        <label for='state'>State:</label>
        <input type="text" id='state' name='state' />
        <label for='zip'>Zip:</label>
        <input type="text" id='zip' name='zip' />
    </div>
    <input id='submitButton' type='submit' value='Submit'/>
</form>
</body>
</html>