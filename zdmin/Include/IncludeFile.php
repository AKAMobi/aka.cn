<?

/* Insert your PHP code here */
function IncludeHTML($filename)
{
	$fp=fopen($filename,"r");
	if (!$fp) return FALSE;
	while (!feof ($fp)) {
	    $buffer = fgets($fp, 4096);
	    echo $buffer;
	}
	fclose ($fp);
}

?>
