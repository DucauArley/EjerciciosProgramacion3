<?php

	$operador = "a";
	$op1 = 23;
	$op2 = 42;
	$total;
	$ok = true;

	switch ($operador) 
	{
		case '+':
			$total = $op1 + $op2;
			break;
		case '-':
			$total = $op1 - $op2;
			break;
		case '/':
			$total = $op1 / $op2;
			break;
		case '*':
			$total = $op1 * $op2;
			break;

		default:
			echo  "El operador no es correcto";
			$ok = false;
			break;
	}

	if($ok == true)
	{
		echo "El resultado es: $total";
	}

?>