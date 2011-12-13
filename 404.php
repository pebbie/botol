<!DOCTYPE html>
<html>
	<head>
        <title>404 Not Found!</title>
        <style type="text/css">
            body{font-family:"Trebuchet MS";}
        </style>
    </head>
	<body>
        <h1>Error 404</h1>
        <div style="background-color:#eee;width:90%;padding:1em;border:1px solid silver;">
            The Document you're looking for is not here.
            <?
            global $route;
            if(defined('DEBUG'))
                var_dump($route);
            ?>
        </div>
    </body>
</html>