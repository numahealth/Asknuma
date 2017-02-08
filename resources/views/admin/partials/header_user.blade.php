<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta information -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <!-- Title-->
        <title>Numa Health</title>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-83018761-1', 'auto');
            ga('send', 'pageview');
        </script>
        <!-- Favicons -->

        <link rel="shortcut icon" href="{{ URL::asset('public/front/img') }}/favicon.ico" type="image/x-icon">

        <!-- CSS Stylesheet-->
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('public/user/assets/css/bootstrap')}}/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('public/user/assets/css/bootstrap')}}/bootstrap-themes.css" />
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('public/user/assets/css')}}/style.css" />
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('public/user/css')}}/my_style.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

        <!-- Styleswitch if  you don't chang theme , you can delete -->
        <link type="text/css" rel="alternate stylesheet" media="screen" title="style1" href="{{ URL::asset('public/user/assets')}}/css/styleTheme1.css" />


    </head>
    <body>
