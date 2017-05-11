<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0"/>
        <title>@yield('title', 'Numa Health')</title>
        @yield('page_meta', '')
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
        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/css/style.css"/>
        <!-- template styles -->
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/css/color-default.css"/>
        <!-- default template color styles -->

        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/css/responsive.css"/>
        <!-- responsive styles -->
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/css/animate.css"/>
        <!-- animation for content -->

        <!-- Google Web fonts -->
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,100,200,500,600,800,700,900' rel='stylesheet' type='text/css'>
        <!-- Raleway font -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;.subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
        <!-- Open Sans -->
        <link rel="shortcut icon" href="{{ URL::asset('public/front/img') }}/favicon.ico" type="image/x-icon" sizes="16x16">
        <!-- Font icons -->
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/font-awesome/css/font-awesome.min.css"/>
        <!-- Font awesome icons -->
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/pixons/style.css" />
        <!-- Social icons font - -->
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/css/numa_style.css" />
        <!-- Social icons font -  -->
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/css/numa_media_query.css" />

        <!-- start Mixpanel -->
        <script type="text/javascript">
            (function (e, a) {
                if (!a.__SV) {
                    var b = window;
                    try {
                        var c, l, i, j = b.location, g = j.hash;
                        c = function (a, b) {
                            return(l = a.match(RegExp(b + "=([^&]*)"))) ? l[1] : null
                        };
                        g && c(g, "state") && (i = JSON.parse(decodeURIComponent(c(g, "state"))), "mpeditor" === i.action && (b.sessionStorage.setItem("_mpcehash", g), history.replaceState(i.desiredHash || "", e.title, j.pathname + j.search)))
                    } catch (m) {
                    }
                    var k, h;
                    window.mixpanel = a;
                    a._i = [];
                    a.init = function (b, c, f) {
                        function e(b, a) {
                            var c = a.split(".");
                            2 == c.length && (b = b[c[0]], a = c[1]);
                            b[a] = function () {
                                b.push([a].concat(Array.prototype.slice.call(arguments,
                                        0)))
                            }
                        }
                        var d = a;
                        "undefined" !== typeof f ? d = a[f] = [] : f = "mixpanel";
                        d.people = d.people || [];
                        d.toString = function (b) {
                            var a = "mixpanel";
                            "mixpanel" !== f && (a += "." + f);
                            b || (a += " (stub)");
                            return a
                        };
                        d.people.toString = function () {
                            return d.toString(1) + ".people (stub)"
                        };
                        k = "disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
                        for (h = 0; h < k.length; h++)
                            e(d, k[h]);
                        a._i.push([b, c, f])
                    };
                    a.__SV = 1.2;
                    b = e.createElement("script");
                    b.type = "text/javascript";
                    b.async = !0;
                    b.src = "undefined" !== typeof MIXPANEL_CUSTOM_LIB_URL ? MIXPANEL_CUSTOM_LIB_URL : "file:" === e.location.protocol && "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//) ? "https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js" : "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";
                    c = e.getElementsByTagName("script")[0];
                    c.parentNode.insertBefore(b, c)
                }
            })(document, window.mixpanel || []);
            mixpanel.init("039f1f76bc120c2f5f85ec6762153508");
        </script><!-- end Mixpanel -->

    </head>
    <body>
        <h2 class="landing_callout" style="display: none;">
            <div class="col-md-6 col-md-off-3 col-lg-6 col-lg-offset-3" 
                 style="background: transparent; background-color: transparent; 
                 margin-top: 0px; text-align: center; margin-top: 15%;">
                <h1 style="color: #fff">Your personal health assistant in a mobile app</h1>
                <h2 style="color: #fff">How can we help?</h2>
            </div>
        </h2>
        <div id="parallax_assist" style="display: block;">  