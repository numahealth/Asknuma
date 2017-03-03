<!DOCTYPE html>
<html>
    <head>
        <title>Numa Health Facebook Login</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{ URL::asset('public/front') }}/js/jquery-2.1.1.min.js"></script><!-- jQuery library --> 
    </head>
    <body>
        <div id="fb-root"></div>
        <script>
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1662987603995534";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
        </script>
        <script>
            function statusChangeCallback(response) {
                console.log('statusChangeCallback');
                //console.log(response);
                if (response.status === 'connected') {
                    // Logged into your app and Facebook.
                    getUserInfo();
                } else if (response.status === 'not_authorized') {
                    // The person is logged into Facebook, but not your app.
                    document.getElementById('status').innerHTML = 'Please log ' +
                            'into this app.';
                } else {
                    // The person is not logged into Facebook, so we're not sure if
                    // they are logged into this app or not.
                    document.getElementById('status').innerHTML = 'Please log ' +
                            'into Facebook.';
                }
            }

            // This function is called when someone finishes with the Login
            // Button.  See the onlogin handler attached to it in the sample
            // code below.
            function checkLoginState() {
                FB.getLoginStatus(function (response) {
                    statusChangeCallback(response);
                });
            }
            
            function getUserInfo() {
                FB.api('/me', {locale: 'en_US', fields: 'first_name, last_name, age_range, picture, email, location{location}'},
                        function (response) {
                            document.getElementById('status').innerHTML =
                                    JSON.stringify(response);
                            loginWithFB(response);
                        });
            }

            function loginWithFB(response) {
                document.getElementById('status').innerHTML =
                        JSON.stringify(response);
                $.ajax({
                    url: "<?php echo url('/loginWithFacebook') ?>",
                    method: 'POST',
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'id': response.id,
                        'first_name': response.first_name,
                        'last_name': response.last_name,
                        'email': response.email,
                        'gender': response.gender,
                        'age': response.age_range.min,
                        'country': 'NG',
                        'raw': response
                    },
                    success: function (result) {
                        $("#thanks").trigger('click');
                    }});
            }

        </script>

        <!--
          Below we include the Login Button social plugin. This button uses
          the JavaScript SDK to present a graphical Login button that triggers
          the FB.login() function when clicked.
        -->

        <div style="text-align: center; padding: 100px;">
            <fb:login-button max-rows="1" show-faces="false" auto-logout-link="false" size="xlarge" 
                             scope="public_profile,email" 
                             onlogin="checkLoginState();">
            </fb:login-button>
        </div>


    <center>
        <div id="status">
        </div>
    </center>

</body>
</html>