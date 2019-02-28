<?php
 
/*
$page = new template;
$page ->template_init("login.html");

$page->template_cicle_start("achat");
[WHILE...]
$page->template_cicle_add("achat","achat_lien","#","achat_label",$media_titre);
[END]
$page->template_cicle_end("achat");

$page->template_del("achats");

$page->add_var("prix",$album_prix);	

$page->go_vars();

echo $page->body;
*/

function read_file($name_file)
{
	$p=fopen(trim($name_file),"r");
	$ret = fread($p,filesize(trim($name_file)));
	fclose($p);
	return $ret;
}

////////////////////////////////////////////////////////
////////////////////////////////////////////////////////
//////// CLASS TEMPLATE
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////
class template{

 // BODY è il testo della pagina da visualizzare
 // Inizialmente è vuoto 
 var $body="";
 
 

 //////////////////////////////////////////
 /// Funzione che associa il file html
 //////////////////////////////////////////

 function template_init($link){
  $this->body = read_file($link);
  $this->n_vars = 0;
  $this->array_vars =array();
 }
 
 // aggiunge una singola variabile, ma non la calcola
 // ha bisogno di per calcolare tutte le variabili
 
 function add_var($nom,$valeur){
 $this->array_vars[$this->n_vars+1] = $nom;
 $this->array_vars[$this->n_vars+2] = $valeur;
 $this->n_vars = $this->n_vars+2;
 }
 
 // aggiunge tante variabili quanto sono i valori dell'array associativo $IN
 
 function add_vars($IN){
 
	 foreach ($IN as $key => $value) {
		 if (!is_array($IN[$key])){	
		 $this->array_vars[$this->n_vars+1] = $key;
		 $this->array_vars[$this->n_vars+2] = $value;
		 $this->n_vars = $this->n_vars+2;
		 } else {
		 $IN2 = array();
		 $IN2[$key] = $IN[$key];
		 $this->template_cicle_from_array($IN2);
		 }
	 }
	 
	
 
 } 

 
//////////////////////////////////////////
 /// Sostituisce alle variabili aggiunte con add_var $ il valore passato 
 /// come parametro (numero indefinito)
 //////////////////////////////////////////
 
 function go_vars(){
   for ($i = 0; $i < $this->n_vars/2; $i++) {
     $var_name = $this->array_vars[2*$i+1];
	 $var_value = $this->array_vars[2*$i+2];	 
	 ${$var_name} = $var_value;	 
   }
	

	$ret = $ret=addslashes($this->body);	
	eval("\$ret2=\" $ret \";");
    $this->body = stripslashes($ret2);
		
 }
 
 
 

 //////////////////////////////////////////
 /// Sostituisce alle variabili $ il valore passato 
 /// come parametro (numero indefinito)
 //////////////////////////////////////////
 
 function template_vars(){
   
   $argc = func_num_args();
   for ($i = 0; $i < $argc/2; $i++) {
     $var_name = func_get_arg(2*$i);
	 $var_value = func_get_arg(2*$i+1);	 
	 ${$var_name} = $var_value;	 
   }
	

	$ret = $ret=addslashes($this->body);	
	eval("\$ret2=\" $ret \";");
    $this->body = stripslashes($ret2);
		
 }

///////////////////////////////////////////////////
//// permette di caricare nella classe i tags presenti fra
//// i due <!--$cicle_name-->
//////////////////////////////////////////////////
 
 function template_cicle_start($cicle_name){
  $tab = explode("<!--$cicle_name-->",$this->body);
  $var_name = "tags_$cicle_name";
  $this->$var_name = $tab[1];
}


/////////////////////////////////////////////////////////////
/// Aggiunge una linea alla variabile $cicle_name_content
/// es. $cicle_name = "menu"
/// this->menu_content è incrementato con la sostituzione delle variabili
//////////////////////////////////////////////////////////////

 function template_cicle_add($cicle_name){


   $argc = func_num_args()-1;
   for ($i = 0; $i < $argc/2; $i++) {
     $var_name = func_get_arg(2*$i+1);
	 $var_value = func_get_arg(2*$i+2);	 
	 ${$var_name} = $var_value;	 
   }

 
 $content_name = $cicle_name.'_content';
 $tags_name =    "tags_$cicle_name";
 
 $ret=addslashes($this->$tags_name);	
 eval("\$ret2=\" $ret \";");
 $this->$content_name = $this->$content_name.stripslashes($ret2);
 
}


function template_cicle_end($cicle_name){
  
  $tab = explode("<!--$cicle_name-->",$this->body);
  $content_name = $cicle_name.'_content';
  $this->body = $tab[0].$this->$content_name.$tab[2];
  
}

//////////////////////////////////////////////////
// funzione che fa un ciclo a partire da un array del tipo : 
/*
Array
(
    [villes] => Array
        (
            [0] => Array
                (
                    [nom] => palerme
                    [cp] => 90100
                    [pays] => Italie
                )

            [1] => Array
                (
                    [nom] => Paris
                    [cp] => 75000
                    [pays] => France
                )

        )

)

corrispondente a 

$datas = array();
$res = mysql_query("select * from villes");
while($data = mysql_fetch_assoc($res)){
$datas["villes"][] = $data;
}

Il nome dell'array è usato per il nome del ciclo
*/

function template_cicle_from_array($IN){

	$tabkey = array_keys($IN);
	$cicle_name = $tabkey[0];
	$this->template_cicle_start($cicle_name);

	for($i=0;$i<count($IN[$cicle_name]);$i++){

		foreach ($IN[$cicle_name][$i] as $key => $value) {
		 $var_name = $key;
		 $var_value = $value;	 
		 ${$var_name} = $var_value;	 
		}
		
	 $content_name = $cicle_name.'_content';
	 $tags_name =    "tags_$cicle_name";
	 
	 $ret=addslashes($this->$tags_name);	
	 eval("\$ret2=\" $ret \";");
	 $this->$content_name = $this->$content_name.stripslashes($ret2);	
		
		
	}

	$this->template_cicle_end($cicle_name);



}


///////////////////////////////////////////////////
//// permette di cancellare una parte del template delimitata fra
//// i due <!--$cicle_name-->
//////////////////////////////////////////////////
 
 function template_del($cicle_name){
 
	  $tab = explode("<!--$cicle_name-->",$this->body);
	  if (count($tab)>1){
	  $this->body = $tab[0].$tab[2];
	  }

 }
 
////////////////////////////////////////////////////
/// controlla se nel template è presente un dato ciclo
////////////////////////////////////////////////////// 
 function template_cicle_verif($cicle_name){
 
	  $tab = explode("<!--$cicle_name-->",$this->body);
	  if (count($tab)>1){
	  return true;
	  } else {
	  return false;
	  }

 } 
 
}



?>
