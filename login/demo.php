<?php

	require_once("CAS.php");
	
	require_once("INSA_LDAP.php");


?>
<html>
  <head>
    <title>phpCAS simple client</title>
  </head>
  <body>
    <h1>Successfull Authentication!</h1>
    
    
    <p>the user's login is <b><?= CAS_getUser() ?></b>.</p>
    
    
    <?php 

		$data = INSA_LDAP_info();

		$infos = INSA_LDAP_parse($data);

		// affichage
		echo $infos['civilite'] ." Nom : " . $infos['nom'] . ", prenom : " . $infos['prenom'] . ", " . $infos['type'] . ", mail : " .$infos['mail'];
		 
	?>
    
    <p><a href="?logout=">Logout</a></p>
  </body>
</html>
