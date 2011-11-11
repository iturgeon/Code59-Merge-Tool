<?php

$uploadedBin = "uploaded-bins/15psicheapgasmat.bin";
$code59Bin = "source-bins/V23ALDL.BIN";
$outputBin = 'merged-bins/newbin.bin';

// ============ check the uploaded file size ===============
if(filesize($uploadedBin) == 32768)
{
	// ============ get calibration data from the uploaded bin ============
	$handle = fopen($uploadedBin, "rb");
	$upload = fread($handle, 3256); 
	fclose($handle);

	// ============ get the data from the code59 bin to append ===========
	$handle = fopen($code59Bin, "rb");
	fseek($handle, 3256); // jump forward 3256 bytes
	$code59 = fread($handle, 32768); // read to the end of the bin
	fclose($handle);

	// ============ write the merged bin =================
	file_put_contents($outputBin, $upload . $code59);
}

?>