<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4>{{$post->title}}</h4>
    <p>{{$post->excerpt}}</p>
    <a href="{{route('post.detail',$post->slug)}}">Read more</a>
</body>
</html>
