<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Mail</title>
</head>
<body>
    Hello <b>{{$user->fullname}}</b>, <br> 
    This is mail to confirm your registation <br>
    Please check out it <br>
    <a href="{{route('register.confirm', $user->access_token)}}">Click here</a>
</body>
</html>