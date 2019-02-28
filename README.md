# Phaj
Phaj is a word obtained from <b>ph</b>p and <b>aj</b>ax.
With this framework you can create projects totally based on ajax technology.The framework uses jQuery client-side and php server-side.

<h2>client-side</h2>

To load a function on the html page we use the addFunct () method as follows :
```js
$("#myTag").addFunct("hello")
```

To send a parameter to the function, use the addParam () method as follows
```js
$("#myTag").addParam("firstname","Emanuele")
```

You can define everything at the same time :

```js
$("#myTag").addFunct("hello").addParam("firstname","Emanuele")
```

or 

```js
$("#myTag").addFunct("hello").addParam("firstname","Emanuele").addParam("lastname","Di Mauro").addParam("age","47")
```

and execute your function 
```js
$("#myTag").goAjax()
```
<h2>server-side</h2>
Function "hello" is a customized method used in getContent class (class.content.php) 

```php
function hello(){
  
	/// IN variables
	$firstname 	= $this->IN["firstname"];
	$lastname 	= $this->IN["lastname"];
	$age 		= $this->IN["age"]; 
	
	
	// traitements
	$name = $firstname." ".$lastname;
	$year = date("Y")-$age;
	
  return "Hello $name ! I know you were born in the year $born" ;
}
```

hello () returns the html text that will be loaded into the tag "#myTag"

<h2>templates</h2>
"hello" can be also the template name that is loaded with the same name of the function, placed in [templates/hello.html]

In this case mehtod hello() must return array of values :

```php
function hello(){
  
	/// IN variables
	$firstname 	= $this->IN["firstname"];
	$lastname 	= $this->IN["lastname"];
	$age 		= $this->IN["age"]; 
	
	
	// traitements
	$name = $firstname." ".$lastname;
	$year = date("Y")-$age;
	
	/// OUT variables
	$OUT = array();
	$OUT["name"] = strtoupper($name);
	$OUT["born"] = $year;
  
  return $OUT;
}
```

In the template we have the OUT variables returned from hello() method, in the form <b>$</b>{variable} :

```html
<p>Hi $name,<BR>
how <b>are</b> you ?</p>
I know you were born in the year $born<BR>
```

<h2>Loop template </h2>
In some cases we have to manage loops in template structure. 
For exemple : 

```html
<p>Hi $name,<BR>
how <b>are</b> you ?</p>
I know you were born in the year $born<BR>

you like the following cities :<BR><BR>
<!--cities-->
name : $city_name<BR>
postal code : $pc<BR>
country : $country<BR><BR>
<!--cities-->

```

In this case method hello() must return arrays of array values :

```php
function hello(){

	/// IN variables
	$firstname 	= $this->IN["firstname"];
	$lastname 	= $this->IN["lastname"];
	$age 		= $this->IN["age"]; 
	
	
	// traitements
	$name = $firstname." ".$lastname;
	$year = date("Y")-$age;
	
	/// OUT simple variables (not array)
	$OUT = array();
	$OUT["name"] = strtoupper($name);
	$OUT["born"] = $year;
	
	// OUT variables array for template loops
	// cities 
	$cities = array();
	$cities[0]["city_name"] = "Palerme";
	$cities[0]["pc"] = "90100";
	$cities[0]["country"] = "Italie";
	  
	$cities[1]["city_name"] = "Paris";
	$cities[1]["pc"] = "75000";
	$cities[1]["country"] = "France";

	$OUT["cities"] = $cities;
	
	
	return $OUT;
}
```
"cities" in $OUT array returned by hello() has the same name as the html comment in the template file :

```html
<!--cities-->
```

The html charged in #myTag will be : 
```
Hi Emanuele Di Mauro,
how <b>are</b> you ?
I know you were born in the year 1972

you like the following cities :

name : Palerme
postal code : 90100
country : Italy 

name : Paris
postal code : 75000
country : France 

```

You can also add a lot of loop in the template file : 
```html
<p>Hi $name,<BR>
how <b>are</b> you ?</p>
I know you were born in the year $born<BR><BR>

You like the following cities :<BR><BR>
<!--cities-->
name : $city_name<BR>
postal code : $pc<BR>
country : $country<BR><BR>
<!--cities-->

<BR>You like the following fuits : <BR>
<ul>
<!--fruits-->
<li> $fruit</li>
<!--fruits-->
</ul>
```

In this case, the method hello() must return an other array $fruits like this :

```php
function hello(){

	/// IN variables
	$firstname 	= $this->IN["firstname"];
	$lastname 	= $this->IN["lastname"];
	$age 		= $this->IN["age"]; 
	
	
	// traitements
	$name = $firstname." ".$lastname;
	$year = date("Y")-$age;
	
	/// OUT simple variables (not array)
	$OUT = array();
	$OUT["name"] = strtoupper($name);
	$OUT["born"] = $year;
	
	// OUT variables array for template loops
	// cities 
	$cities = array();
	$cities[0]["city_name"] = "Palerme";
	$cities[0]["pc"] = "90100";
	$cities[0]["country"] = "Italie";
	  
	$cities[1]["city_name"] = "Paris";
	$cities[1]["pc"] = "75000";
	$cities[1]["country"] = "France";

	$OUT["cities"] = $cities;
	
	// fruits
	$fruits = array();
	$fruits[0]["fruit"] = "Apple"; 
	$fruits[1]["fruit"] = "Orange";
	$fruits[2]["fruit"] = "cherry";

	$OUT["fruits"] = $fruits;	
	
	return $OUT;
}
```

The html charged in #myTag will be : 
```
Hi Emanuele Di Mauro,
how <b>are</b> you ?
I know you were born in the year 1972

you like the following cities :

name : Palerme
postal code : 90100
country : Italy 

name : Paris
postal code : 75000
country : France 

You like the following fuits : 
- Apple
- Orange
- cherry

```
