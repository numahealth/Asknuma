<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
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
                                <strong><b style="color:50965c">Hello</b>  <?php echo @$user_detail['name']; ?>,</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <p>We are a team of healthcare professionals and technology enthusiasts that are passionate about giving you more control of your healthcare and are building tools to help you do just that. Complete your health profile, ask our doctors your health questions and find health information relevant to you.
                                </p>			
                                <p>Have you requested for your password to be reset? If you have not, or you were not expecting this email, please get in touch with us urgently on <a href="mailto:info@numa.io">info@numa.io</a>. If it was you, your temporary login details are below. Please login & change your password from your Profile page immediately</p></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="300" border="0" cellspacing="5" cellpadding="0" style="font-weight:bold; color:#0ea04c;">
                                    <tr>
                                        <td width="45%">Email</td>
                                        <td width="5%">:</td>
                                        <td width="50%"><?php echo $user_detail['username']; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="45%">Password</td>
                                        <td width="5%">:</td>
                                        <td width="50%"><?php echo $user_detail['password']; ?></td>
                                    </tr >
                                    <tr>
                                        <td colspan="2">
                                            <a href="{{ url('') }}" style="text-decoration: none; font-size: 13px;">
                                                <div style="height:100%;width: 314%;margin-top: 15px;color: #1294dc; text-decoration:none;">
                                                    Click here to login securely
                                                </div></a>


                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <!--<td align="center"><a href="" style="background:#2ecc71;color:#fff;font-size:17px; width:200px;font-weight:normal;line-height:42px;font-family:Arial,Helvetica,sans-serif;min-height:42px;display:block;text-decoration:none" target="_blank">Verify Now</a></td>-->
                        </tr>
                        <tr>
                            <td align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong> Best wishes,</strong></td>
                        </tr>
                        <tr>
                            <td style="color: #666666;">Dr Tobi Obisanya</td> 
                        </tr>
                        <tr>
                            <td style="color: #666666;">Co Founder</td>
                        </tr>
                        <tr>
                            <td style="color:#666666;">Numa Health</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td bgcolor="efefef"><p style="padding:0 10px;">Have any questions? For a quick reply, drop us an email on <a style="text-decoration:none;color:#2b4bff" href="#" >info@numa.io</a></p></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </body>
</html>