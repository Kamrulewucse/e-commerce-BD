<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<style>
    body{
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    }

    @media  only screen and (max-width: 600px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

    @media  only screen and (max-width: 500px) {
        .button {
            width: 100% !important;
        }
    }
</style>

<body style="margin: 0; padding: 0;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="center" bgcolor="#fff" style="padding: 10px 0 10px 0;">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" height="40" style="display: block;" />
                        <h2>Bangladesh Drip</h2>
                    </td>
                </tr>
                <tr>
                    <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 35px; width: 570px; -premailer-cellpadding: 35px; -premailer-cellspacing: 0; -premailer-width: 570px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; color: #3d4852; font-size: 16px">
                        @yield('content')
                    </table>
                </tr>
                <tr>
                    <td bgcolor="black" style="padding: 10px 30px 10px 30px;">
                        <table class="footer" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="color: #ffffff; font-size: 14px; text-align: center">
                                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br/>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
