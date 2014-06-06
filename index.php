<?php
/*
 * Author: Danielle Closs
 * File: Main index file, frontend routing
 * Date:6/6/2012
 */

    error_reporting(0);
	 $url = $_SERVER['REQUEST_URI']; 
    $url = str_replace('/programming_examples/php_contacts/', '', $_SERVER['REQUEST_URI']);
	?>
<html>
<?php
switch($url){
	case ('search'):
		require_once('library/SearchController.php');
        $searchController = new SearchController();
        $records = $searchController->index();
        echo $records;
	break;
	default:
        require_once('header.html');
		require_once('search_form.html');
	break;
}
?>
</html>
