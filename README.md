# Phaj
Phaj is a word obtained from <b>ph</b>p and <b>aj</b>ax.
With this framework you can create projects totally based on ajax technology.The framework uses jQuery client-side and server-side php.

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

Function "hello" is a mehtod used in getContent class (class.content.php) 

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

"hello" is also the template that is loaded with the same name of the function and that is in [templates/hello.html]</pre>

In the template we have the variables that have been sent to the "hello" method, in the form <b>$</b>variable :

```html
<p>Hi $firstname $lastname, <BR>
how <b>are</b> you ?</p>
```

