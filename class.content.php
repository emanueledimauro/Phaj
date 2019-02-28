<?php

class getContent{

var $template="";
var $IN = array();
var $f = "";
var $t = "";


 //////////////////////////////////////////
 /// Funzione che associa il file html
 //////////////////////////////////////////
 
function __construct($f,$t,$IN){

$this->f = $f;
$this->t = $t;

$this->IN = $IN;

} 

function go(){

	$f = $this->f;
	$t = $this->t;
	$IN =$this->IN; 
	$OUT = $this->$f();
	
	
	
	if (file_exists("templates/$t.html")){
	
		$page = new template;
		$page ->template_init("templates/$t.html");
		$page->add_vars($OUT);	
		$page->go_vars();

		return $page->body;

	} else {
	return $this->$f();
	}

}

function hello(){

	$firstname 	= $this->IN["firstname"];
	$lastname 	= $this->IN["lastname"];
	$age 		= $this->IN["age"]; 
	
	$OUT = array();
	
	$OUT["name"] = strtoupper($firstname." ".$lastname);
	
	$year = date("Y")-$age;
	$OUT["born"] = $year;
	
	
	$datas = array();
	$datas[0]["nom"] = "Palerme";
	$datas[0]["cp"] = "90100";
	$datas[0]["pays"] = "Italie";
	
	
	$datas[1]["nom"] = "Paris";
	$datas[1]["cp"] = "75000";
	$datas[1]["pays"] = "France";


	$OUT["citta"] = $datas;
	$OUT["villes"] = $datas;
	
	
	
	return $OUT;

}



function insulta(){

	$nome = $this->IN["nome"];
	$cognome = $this->IN["cognome"];
	

	return "$nome $cognome, non sei bello !";

}

 
}


?>