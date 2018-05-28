<?php
/**
 *   Example for a simple cas 2.0 client
 *
 * PHP Version 5
 *
 * @file     example_simple.php
 * @category Authentication
 * @package  PhpCAS
 * @author   Joachim Fritschi <jfritschi@freenet.de>
 * @author   Adam Franco <afranco@middlebury.edu>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link     https://wiki.jasig.org/display/CASC/phpCAS
 */


require_once 'CAS/CAS.php';

CAS::init();
	
if(isset($_GET['logout'])) CAS::logout();

?>
<html>
  <head>
    <title>phpCAS simple client</title>
  </head>
  <body>
    <h1>Successfull Authentication!</h1>
    <p>the user's login is <b><?php echo phpCAS::getUser(); ?></b>.</p>
    
    
<?php 

	require_once("LDAP/INSA_LDAP.php");

	$infos = INSA_Ldap_Class::INSA_LDAP_parse(INSA_Ldap_Class::INSA_LDAP_info());

	echo $infos['civilite'] ." Nom : " . $infos['nom'] . ", prenom : " . $infos['prenom'] . ", " . $infos['type'] . ", mail : " .$infos['mail'];
	
	echo sizeof($_SESSION);
 
?>
    
    <p><a href="?logout=">Logout</a></p>
  </body>
</html>
