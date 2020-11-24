<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
</head>
<body>
    
@foreach($data as $value)
    <h1>{{ $value['name'] }}</h1>
    <h1>{{$value['email']}}</h1>
    <h1>{{ucfirst($value['role'])}}</h1>
    <h1>{{$value['created_at']}}</h1>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

@endforeach    

</body>
</html>