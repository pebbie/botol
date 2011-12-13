<!DOCTYPE html>
<html>
	<head>
        <title>Login</title>
    </head>
	<body>
        <h2>Login</h2>
        <form action="<?=$this->root?>/user/login" method="POST">
            <label for="uname"></label><input type="text" id="uname" name="uname"/>
            <input type="submit" />
        </form>
    </body>
</html>