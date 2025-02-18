<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    @auth
     <p>You are logged in !</p>
    <form action="/logout" method="post">
     @csrf
     <button>Log out</button>
    </form>
    @else
    <form>
        @csrf
        <fieldset>
            <legend>Register</legend>
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button type="submit">Register</button>
        </fieldset>
    </form>
    
    <form action="/login" method="POST">
        @csrf
        <fieldset>
            <legend>Login</legend>
            <input name="loginname" type="text" placeholder="name">
            <input name="loginpassword" type="password" placeholder="password">
            <button type="submit">login</button>
        </fieldset>
    </form>
    @endauth
</body>
</html>