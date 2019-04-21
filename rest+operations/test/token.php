<?php

class token{



public function vtoken($token){
	//daca token ul se afla in baza de date e ok.
	
	if($token=="f4e99e7d0e6c0c5e5d4e136ef6e4c4ac")
		return true;
	else return false;

}
public function vuser($a,$b){
	$secret="1e4ff3a2990c87ff9db143ed52f60383";
	$conn=$a.$b.$secret;

	if(md5($conn)=="f4e99e7d0e6c0c5e5d4e136ef6e4c4ac")
	return md5($conn);
}

}


?>