<?php  
/*
 * @description Utiliza el cliente del API de Nequi
 * @author michel.lugo@pragma.com.co, jomgarci@bancolombia.com.co
 */
	include 'clientAPI.php';

	// echo "Test consumo API Nequi"."<br>"."<br>";

	$validateClientResponse = validateClient("12345", "1053780555", "10000");

	echo json_encode($validateClientResponse);

?>