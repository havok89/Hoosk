<?php 

	 function wordlimit($string, $length = 40, $ellipsis = "...")
	{
		$string = strip_tags($string, '<div>');
		$string = strip_tags($string, '<p>');
		$words = explode(' ', $string);
		if (count($words) > $length)
			return implode(' ', array_slice($words, 0, $length)) . $ellipsis;
		else
			return $string.$ellipsis;
	}
	
?>