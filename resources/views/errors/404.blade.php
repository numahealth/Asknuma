<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            .home_btn{text-decoration:none; color: #fff; text-transform:uppercase;    background-color: #337ab7;    border-color: #2e6da4;   display: inline-block;    padding: 6px 12px;   margin-bottom: 0;    font-size: 16px;    font-weight: bold;   line-height: 1.42857143;    text-align: center;    white-space: nowrap;    vertical-align: middle;
    -ms-touch-action: manipulation;    touch-action: manipulation;      letter-spacing: 2px;  cursor: pointer;   background-image: none;    border: 1px solid transparent;    border-radius: 4px; margin-top:50px;}
            
        </style>
    </head>
    <body style="background:#938f8e;">
        <div class="container">
            <div class="content">
            	<a href="{{url('')}}" class="home_btn">Go to Home</a>
                <img width="100%"src="{{ URL::asset('public/error') }}/error.jpg">
            </div>
        </div>
    </body>
</html>
