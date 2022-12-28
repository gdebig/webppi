<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('nilai_huruf')) {
  function nilai_huruf($nilai){
	if ($nilai < 40){
		$result = "E";
	}elseif ($nilai < 49){
		$result = "D";
	}elseif ($nilai < 54){
		$result = "C-";
	}elseif ($nilai < 59){
		$result = "C";
	}elseif ($nilai < 64){
		$result = "C+";
	}elseif ($nilai < 69){
		$result = "B-";
	}elseif ($nilai < 74){
		$result = "B";
	}elseif ($nilai < 79){
		$result = "B+";
	}elseif ($nilai < 84){
		$result = "A-";
	}elseif ($nilai < 100){
		$result = "A";
	}

    return $result;
  }
  
  function nilai_huruf_rpl($nilai){
	  if ($nilai <= 2.75){
		  $result = "C";
	  } elseif ($nilai <= 4.5){
		  $result = "C+";
	  } elseif ($nilai <= 6.25){
		  $result = "B-";
	  } elseif ($nilai <= 8){
		  $result = "B";
	  } elseif ($nilai <= 9.75){
		  $result = "B+";
	  } elseif ($nilai <= 11.5){
		  $result = "A-";
	  } elseif ($nilai <= 16){
		  $result = "A";
	  }
	  
	  return $result;
  }
}