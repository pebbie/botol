# BOTOL #

web framework inspired by bottle (http://bottlepy.org)
written in PHP

---

uses external libraries such as : 

* Savant3 for templating
* RedBean for persistence (optional)
* PEAR-JSON (optional)

---

the simplest hello world in botol

* create any .php file in mod/ folder containing these lines

```php

<?php
route('/hello/:name','hello');
function hello($arg)
{
    echo "hello,".$arg['name'];
}

```

---

conventions :

* put your additional libraries/include codes (.php) in /ext directory
* put your app codes (.php) in /mod directory
* put your template codes (Savant3 .tpl files) in /tpl directory
