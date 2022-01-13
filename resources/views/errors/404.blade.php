<!DOCTYPE html>
<html>
<head>
    <title>Page Not Found</title>
    <style>
         body{
            display: grid;
            place-items: center;
        }
        .img-div{
            height: 500px;
             min-width: 80vw;
        }

        .img-div img{
            width: 100%;
            height: auto;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h1>OOPS! What you search not found</h1>
        <a href="{{URL::previous()}}">Back One Step</a>
    <div class="img-div">

        <img src="{{asset('template/assets/img/404.jpeg')}}">
    </div>
</body>
</html>