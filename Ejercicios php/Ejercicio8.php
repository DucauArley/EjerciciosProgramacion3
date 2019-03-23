<?php

	$num = 59;
	$numString;

	switch ($num) 
	{
		case ($num >= 20 && $num <= 29):
			$numString = "Veinte";
			if($num != 20)
			{
				$num = $num - 20;
				$numString = "Veinti";
				$numString = numero($num, $numString);
			}
			break;
		case ($num >= 30 && $num <= 39):
			$numString = "Treinta";
			if($num != 30)
			{
				$num = $num -30;
				$numString = "Treinti";
				$numString = numero($num, $numString);
			}
			break;
		case ($num >= 40 && $num <= 49):
			$numString = "Cuarenta";
			if($num != 40)
			{
				$num = $num -40;
				$numString = "Cuarenti";
				$numString = numero($num, $numString);
			}
			break;
		case ($num >= 50 && $num <= 59):
			$numString = "Cincuenta";
			if($num != 50)
			{
				$num = $num -50;
				$numString = "Cincuenti";
				$numString = numero($num, $numString);
			}
			break;
		case 60:
			$numString = "Sesenta";
			break;
		
		default:
			$numString = "El numero es incorrecto";
			break;
	}


	echo "$numString";


	function numero($num, $texto)
	{
		switch ($num) 
		{
			case '1':
				$texto = $texto . "uno";
				break;
			case '2':
				$texto = $texto . "dos";
				break;
			case '3':
				$texto = $texto . "tres";
				break;
			case '4':
				$texto = $texto . "cuatro";
				break;
			case '5':
				$texto = $texto . "cinco";
				break;
			case '6':
				$texto = $texto . "seis";
				break;
			case '7':
				$texto = $texto . "siete";
				break;
			case '8':
				$texto = $texto . "ocho";
				break;
			case '9':
				$texto = $texto . "nueve";
				break;
		}

		return $texto;
	}

?>