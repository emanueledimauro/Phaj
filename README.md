# Phaj
Phaj is a word obtained from <b>ph</b>p and <b>aj</b>ax.
With this framework you can create projects totally based on ajax technology.The framework uses jQuery client-side and server-side php.

<h2>client-side</h2>

To load a function on the html page we use the addFunct () method as follows :
```js
$("#myTag").addFunct("saluta")
```

To send a parameter to the function, use the addParam () method as follows
```js
$("#myTag").addParam("name","Emanuele")</code>
```

You can define everything at the same time :

```js
$("#myTag").addFunct("saluta").addParam("name","Emanuele")
```

or 

```js
$("#myTag").addFunct("saluta").addParam("firstname","Emanuele").addParam("lastname","Di Mauro")
```

and execute your function 
```js
$("#myTag").goAjax()
```

Function "saluta" is a mehtod used in getContent class (class.content.php) 

```php
function saluta(){
  
    $nome = $this-> IN["firstname"];
    $cognome = $this->IN["lastname"];

    $OUT = array();

    $OUT["firstname"] = strtoupper($nome);
    $OUT["lastname"] = strtoupper($cognome);


    return $OUT;
}
```

"saluta" is also the template that is loaded with the same name of the function and that is in [templates/saluta.html]</pre>

In the template we have the variables that have been sent to the "saluta" method, in the form <b>$</b>variable :

```html
<p>Hi $firstname $lastname, <BR>
how <b>are</b> you ?</p>
```

