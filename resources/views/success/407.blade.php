<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name') }} | {{ $code }}</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
 
        <style>
         
         html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            background: #008F9B;
            color: #FFF;
            font-weight: 100;
            font-family: 'Lato', sans-serif;
        }

        .container {
            vertical-align: middle; 
            margin: 0 auto;
        }

        .content {
            text-align: center;
            margin: 0 auto;
        }

        .title {
            font-size: 72px;
            margin: 0 auto;
        }
    
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">{{ $title }}, {{ $code }}, {{ $message }}</div>
            </div>
        </div> 
    </body>
</html>
