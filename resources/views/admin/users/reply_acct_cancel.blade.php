<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Your Numa Subscription confirmation</title>
    </head>
    <body style="margin:0;">

        <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:Arial,Helvetica,sans-serif;
               font-size:14px; line-height:20px; color:#666666">
            <tr>
                <td>
                    <table width="100%" border="0" cellspacing="5" cellpadding="0" bgcolor="#fff">
                        <tr>
                            <td>
                                <a href="{{ url('') }}">
                                    <img src="{{ url('') }}/public/front/img/Numa_logo.png" alt="Numa Health">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td height="5"></td>
                        </tr>
                        <tr>
                            <td height="2" bgcolor="#ccc"></td>
                        </tr>
                        <tr>
                            <td height="5"></td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <b style="color:#50965c;">
                                        Dear 
                                    </b>  
                                    <?php echo $user['name']; ?>,
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    We are sorry to see you go. This email is to confirm that you would 
                                    like to cancel your <b>Numa Connect</b> subscription. Your cancellation 
                                    will be effective immediately. If this was done by mistake, please
                                    contact us. 
                                </p> 
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6
                                             col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
                                            <div class="panel price panel-green">
                                                <div class="panel-heading arrow_box text-center">
                                                    <h3>
                                                        Numa Connect
                                                        <br/>
                                                        <span style="font-size: 14px; font-style: italic;">
                                                            Free for 1yr
                                                        </span>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6
                                             col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
                                            <table class="table table-hover" style="margin-top: 15px;">
                                                <tbody>
                                                    <tr>
                                                        <th style="text-align: left; border: none; color:#50965c;">
                                                            Subscription Date
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td style="border: none;">
                                                            <?php echo date('D M j, Y h:i A', strtotime($user['date_subscribed'])); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align: left; border: none; color:#50965c;">
                                                            Expected Expiry Date
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td style="border: none;">
                                                            <?php echo date('D M j, Y h:i A', strtotime('+1 year', strtotime($user['date_subscribed']))); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align: left; border: none; color:#50965c;">
                                                            Cancellation Date
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td style="border: none;">
                                                            <?php echo date('D M j, Y h:i A'); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align: left; border: none; color:#50965c;">
                                                            Personal data deleted
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td style="border: none;">
                                                            <?php echo $user['delete_data']; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </p>			
                                <p>
                                    We would really like to learn more about why you cancelled your 
                                    subscription; we are always working to improve the services we 
                                    offer and your feedback would really help us!
                                </p>
                                <p>
                                    Simply reply to this email or contact us on info@numa.io.
                                </p>
                                <p>
                                    We hope to see you again soon!
                                </p>
                                <p>
                                    Sincerely, 
                                </p>
                                <p>
                                    The Numa Health Team 
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td bgcolor="efefef">
                                <p style="padding:0 10px;">
                                    Have any questions? For a quick reply, drop us an email on 
                                    <a style="text-decoration:none;color:#2b4bff" href="#" >info@numa.io</a>
                                </p>
                                <p style="text-align: center;">
                                    <span>
                                        &copy; <?php echo date('Y'); ?> All Rights Reserved by Numa Health
                                    </span>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </body>
</html>