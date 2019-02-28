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
	
	
	$cities = array();
	$cities[0]["city_name"] = "Palerme";
	$cities[0]["pc"] = "90100";
	$cities[0]["country"] = "Italie";
	  
	$cities[1]["city_name"] = "Paris";
	$cities[1]["pc"] = "75000";
	$cities[1]["country"] = "France";

	$OUT["cities"] = $cities;
	

	$fruits = array();
	$fruits[0]["fruit"] = "Apple"; 
	$fruits[1]["fruit"] = "Orange";
	$fruits[2]["fruit"] = "cherry";

	$OUT["fruits"] = $fruits;	
	
	return $OUT;

}



function insulta(){

	$nome = $this->IN["nome"];
	$cognome = $this->IN["cognome"];
	

	return "$nome $cognome, non sei bello !";

}

 
}


?>