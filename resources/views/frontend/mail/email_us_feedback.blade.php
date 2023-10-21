<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
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
</head>
<body style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -webkit-text-size-adjust: none; background-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margin: 0; padding: 0; width: 100% !important;">

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #fff; margin: 0; padding: 0; width: 100%;">
    <tr>
        <td align="center" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;">
            <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;">
                <tr>
                    <td class="header"
                        style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; padding: 25px 0; text-align: center;">
                        <a href="{{ route('home') }}"
                           style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; color: #3d4852; font-size: 27px; font-weight: bold; text-decoration: none; display: inline-block;">
                            <img height="25px" src="{{ asset('img/logo.png') }}" alt=""> {{ config('app.name') }}
                        </a>
                    </td>
                </tr>

                <!-- Email Body -->
                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #fff; border-bottom: 1px solid #fff; border-top: 1px solid #fff; margin: 0; padding: 0; width: 100%;">
                        <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; background-color: #ffffff; border-color: #fff; border-radius: 2px; border-width: 1px; box-shadow:none; margin: 0 auto; padding: 0; width: 570px;">
                            <!-- Body content -->
                            <tr>
                                <td class="content-cell" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; max-width: 100vw; padding: 32px;">
                                    <h1 style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;">Hello!</h1>
                                    <h3 style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; color: #3d4852; font-size: 15px; font-weight: normal; margin-top: 0; text-align: left;">
                                       {{ $emailUs->name_title }} {{ $emailUs->first_name }}
                                    </h3>
                                    <h1 style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; color: #3d4852; font-size: 16px; font-weight: 600; margin-top: 0; text-align: left;">Welcome to Bangladesh Drip.</h1>
                                    <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-size: 18px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                        ‘Thanks for your email. We will get back to you as soon as possible’ email confirmation for Contact us page needs to be made with BD campaign photo and BD logo and branding.
                                        <br>
                                        We look forward to helping you with your shopping experience at <a target="_blank" href="https://www.bangladeshdrip.com/">Bangladeshdrip.com</a>.
                                    </p>

                                    <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-size: 19px; line-height: 1.5em; margin-top: 0; text-align: left;font-weight: bold">The Bangladesh Drip Team</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" height="25" style="line-height:1px;font-size:1px;height:25px">
                        <a href="{{ route('home') }}" target="_blank">
                            <img border="0" src="{{ asset('img/subscribe-email.jpeg') }}"
                                 style="display:block;height:auto;margin-bottom: 50px" width="560" class="CToWUd">
                        </a>
                    </td>
                </tr>

                <tr>
                    <td style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                               style="border-collapse:collapse;table-layout:fixed" bgcolor="#EDF2F7">
                            <tbody>
                            <tr>
                                <td align="center">
                                    <table align="center" width="640" border="0" cellpadding="0" cellspacing="0"
                                           style="border-collapse:collapse;width:640px" bgcolor="#EDF2F7"
                                           class="m_2559387181966715647w320">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                       style="border-collapse:collapse" bgcolor="#EDF2F7">
                                                    <tbody>
                                                    <tr>
                                                        <td class="m_2559387181966715647hide" width="30"
                                                            style="line-height:1px;font-size:1px;width:30px"><img
                                                                src="https://ci3.googleusercontent.com/proxy/fzyB-pC9uP45oKWO3aRuR4S2EnZKoWF8sXJJBDDvlCeeyqbr-e765PvaYKk5fWf45N_wKPlI5N2pWJDQk3UCYLNE9kc8wCWO9CmvGaO-zYC5qPr1fTOk7uW1D9_4mrgb-0F1C8SjnfnQpmvjeCudxscN2L_kM6rUYyySHpEyWDOJYyObrhnHhrib=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000EcUQL&amp;oid=00Di0000000HF7A&amp;lastMod=1516116991000"
                                                                alt="" width="30" height="1" style="display:block"
                                                                border="0" class="CToWUd" data-bit="iit"></td>
                                                        <td width="10" style="line-height:1px;font-size:1px;width:10px">
                                                            <img
                                                                src="https://ci3.googleusercontent.com/proxy/fzyB-pC9uP45oKWO3aRuR4S2EnZKoWF8sXJJBDDvlCeeyqbr-e765PvaYKk5fWf45N_wKPlI5N2pWJDQk3UCYLNE9kc8wCWO9CmvGaO-zYC5qPr1fTOk7uW1D9_4mrgb-0F1C8SjnfnQpmvjeCudxscN2L_kM6rUYyySHpEyWDOJYyObrhnHhrib=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000EcUQL&amp;oid=00Di0000000HF7A&amp;lastMod=1516116991000"
                                                                alt="" width="10" height="1" style="display:block"
                                                                border="0" class="CToWUd" data-bit="iit"></td>
                                                        <td>
                                                            <table width="100%" border="0" cellpadding="0"
                                                                   cellspacing="0" style="border-collapse:collapse">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:12px;line-height:normal;color:#666666;text-align:center;vertical-align:top;padding-top:25px">
                                                                        <font color="#666666">Contact Us</font>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>

                                                            <table width="100%" border="0" cellpadding="0"
                                                                   cellspacing="0" style="border-collapse:collapse">
                                                                <tbody>
                                                                <tr>
                                                                    <td align="center"
                                                                        style="padding-top:25px;padding-right:0px;padding-bottom:25px;padding-left:0px">
                                                                        <table align="center" width="350" border="0"
                                                                               cellpadding="0" cellspacing="0"
                                                                               style="width:350px;margin-left:auto;margin-right:auto"
                                                                               class="m_2559387181966715647stackIt">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td width="50%" valign="top">
                                                                                    <table width="100%" border="0"
                                                                                           cellpadding="0"
                                                                                           cellspacing="0"
                                                                                           style="border-collapse:collapse">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td align="center"><a
                                                                                                    href="mailto:contact@bangladeshdrip.com"
                                                                                                    title="Email Us"
                                                                                                    target="_blank"><img
                                                                                                        src="https://ci6.googleusercontent.com/proxy/9P0hSwPcStsvEcSulQOX_XPrUHSAVERHCY51z--9pz_jIHfQAcMhebFIA3WkreVBhN0WRnY5B98H6TP1Bb8BhWyuPN3ibmfzRQjrcGAXiNnDeYE0LyOhFig8EFz-LLFCSsIJd8nl--BOblKjfV19-lXthyAlzycrG8jvUu7znd9dxP77WlW4g16I=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000Fs2yZ&amp;oid=00Di0000000HF7A&amp;lastMod=1516098499000"
                                                                                                        width="30"
                                                                                                        height="30"
                                                                                                        alt="Email Us"
                                                                                                        border="0"
                                                                                                        style="display:block"
                                                                                                        class="CToWUd"
                                                                                                        data-bit="iit"></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="line-height:1px;font-size:1px;height:10px"
                                                                                                height="10"><img
                                                                                                    src="https://ci3.googleusercontent.com/proxy/fzyB-pC9uP45oKWO3aRuR4S2EnZKoWF8sXJJBDDvlCeeyqbr-e765PvaYKk5fWf45N_wKPlI5N2pWJDQk3UCYLNE9kc8wCWO9CmvGaO-zYC5qPr1fTOk7uW1D9_4mrgb-0F1C8SjnfnQpmvjeCudxscN2L_kM6rUYyySHpEyWDOJYyObrhnHhrib=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000EcUQL&amp;oid=00Di0000000HF7A&amp;lastMod=1516116991000"
                                                                                                    alt="" width="1"
                                                                                                    height="10"
                                                                                                    style="display:block"
                                                                                                    border="0"
                                                                                                    class="CToWUd"
                                                                                                    data-bit="iit"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:12px;line-height:normal;color:#666666;text-align:center;vertical-align:top">
                                                                                                <a href="mailto:contact@bangladeshdrip.com"
                                                                                                   title="Email Us"
                                                                                                   style="text-decoration:none;color:#666666"
                                                                                                   target="_blank"><font
                                                                                                        color="#666666">Email
                                                                                                        Us</font></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>

                                                                                <td width="50%" valign="top">
                                                                                    <table width="100%" border="0"
                                                                                           cellpadding="0"
                                                                                           cellspacing="0"
                                                                                           style="border-collapse:collapse">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td align="center"><a
                                                                                                    href="https://twitter.com/bangladeshdrip"
                                                                                                    title="@bangladeshdrip"
                                                                                                    target="_blank">
                                                                                                    <img
                                                                                                        src="https://ci6.googleusercontent.com/proxy/uWq54f5xsjcs5bnK81DOlYawueHk-ovi-BS2v4pQOCINubezMZBIhpdeQB9qMQSZ7g4QbTqEO_ck4E_i24VhW0p2rS9C1fIeYpZ8ToqJNwZbci48wkQR3GXWhhg6OwKRF34JI-PW1tS9C7Ggv1DR5FIovvfATQnWa7u3L6bd8ONGyUBfe-ZxgI3P=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000Fs2yj&amp;oid=00Di0000000HF7A&amp;lastMod=1516098578000"
                                                                                                        width="30"
                                                                                                        height="30"
                                                                                                        alt="@bangladeshdrip"
                                                                                                        border="0"
                                                                                                        style="display:block;margin-left:auto;margin-right:auto"
                                                                                                        class="CToWUd"
                                                                                                        data-bit="iit"></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="line-height:1px;font-size:1px;height:10px"
                                                                                                height="10">
                                                                                                <img
                                                                                                    src="https://ci3.googleusercontent.com/proxy/fzyB-pC9uP45oKWO3aRuR4S2EnZKoWF8sXJJBDDvlCeeyqbr-e765PvaYKk5fWf45N_wKPlI5N2pWJDQk3UCYLNE9kc8wCWO9CmvGaO-zYC5qPr1fTOk7uW1D9_4mrgb-0F1C8SjnfnQpmvjeCudxscN2L_kM6rUYyySHpEyWDOJYyObrhnHhrib=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000EcUQL&amp;oid=00Di0000000HF7A&amp;lastMod=1516116991000"
                                                                                                    alt="" width="1"
                                                                                                    height="10"
                                                                                                    style="display:block"
                                                                                                    border="0"
                                                                                                    class="CToWUd"
                                                                                                    data-bit="iit"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:12px;line-height:normal;color:#666666;text-align:center;vertical-align:top"
                                                                                                class="m_2559387181966715647fontSize11">
                                                                                                <a href="https://twitter.com/bangladeshdrip"
                                                                                                   title="@bangladeshdrip"
                                                                                                   style="text-decoration:none;color:#666666"
                                                                                                   target="_blank">
                                                                                                    <font
                                                                                                        color="#666666">@bangladeshdrip</font></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>


                                                            <table width="100%" border="0" cellpadding="0"
                                                                   cellspacing="0" style="border-collapse:collapse"
                                                                   bgcolor="#c1bbb5">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="line-height:1px;font-size:1px;height:1px;width:1px"
                                                                        width="1" height="1"><img
                                                                            src="https://ci3.googleusercontent.com/proxy/fzyB-pC9uP45oKWO3aRuR4S2EnZKoWF8sXJJBDDvlCeeyqbr-e765PvaYKk5fWf45N_wKPlI5N2pWJDQk3UCYLNE9kc8wCWO9CmvGaO-zYC5qPr1fTOk7uW1D9_4mrgb-0F1C8SjnfnQpmvjeCudxscN2L_kM6rUYyySHpEyWDOJYyObrhnHhrib=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000EcUQL&amp;oid=00Di0000000HF7A&amp;lastMod=1516116991000"
                                                                            alt="" width="1" height="1"
                                                                            style="display:block" border="0"
                                                                            class="CToWUd" data-bit="iit"></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>

                                                            <table width="100%" border="0" cellpadding="0"
                                                                   cellspacing="0" style="border-collapse:collapse">
                                                                <tbody>
                                                                <tr>
                                                                    <td valign="top"
                                                                        style="font-size:0;text-align:center;padding-top:25px;padding-right:0px;padding-bottom:25px;padding-left:0px">
                                                                        <table width="308" align="center" border="0"
                                                                               cellpadding="0" cellspacing="0"
                                                                               style="border-collapse:collapse;width:308px">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td width="176" valign="top"
                                                                                    style="width:176px">

                                                                                    <div
                                                                                        style="display:inline-block;vertical-align:top;width:100%;max-width:176px"
                                                                                        class="m_2559387181966715647w200">
                                                                                        <table border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="border-collapse:collapse">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                                                                                                    <a href="https://www.facebook.com/bangladeshdrip/"
                                                                                                       title="Facebook"
                                                                                                       target="_blank">
                                                                                                        <img
                                                                                                            src="https://ci5.googleusercontent.com/proxy/Gws_YBCsbhFBaKCZrPgX9emAlkw4JRZ2DwG66yz_Ebew_S8Flq51cI23rSnZfY9hHiKOCBLzAkEo1WV2sN95HpOjMOBUhV3uY3uxDvxsCv3squPLMCFXZwvslmPKpvrWZmAB-zaPJbrkDWCQDSmzeDeXsVXxHYv64QuLXJMiypO4gmxN4Eed5AGr=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000Fs2zN&amp;oid=00Di0000000HF7A&amp;lastMod=1516098967000"
                                                                                                            width="24"
                                                                                                            height="24"
                                                                                                            alt="Facebook"
                                                                                                            border="0"
                                                                                                            style="display:block"
                                                                                                            class="CToWUd"
                                                                                                            data-bit="iit"></a>
                                                                                                </td>
                                                                                                <td style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                                                                                                    <a href="https://twitter.com/bangladeshdrip/"
                                                                                                       title="Twitter"
                                                                                                       target="_blank">
                                                                                                        <img
                                                                                                            src="https://ci5.googleusercontent.com/proxy/TBzIjloeDyeoAQBoX0_lhYGJBetUvBeJm125z3t-f7MGiw8hDjgsfMxriby4bpul8_LiIqTyK_VjK98cp1ETrzrAkTJTjnIhbSuQoNnBxlLM5XF6DLeyO0cIMy4rO04QKSnfz9IloPRF_1B6eRXEkg1bhrBDRsBf1KQcnrAenKV7V5zhZPWXa2tB=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000Fs30G&amp;oid=00Di0000000HF7A&amp;lastMod=1516099480000"
                                                                                                            width="24"
                                                                                                            height="24"
                                                                                                            alt="Twitter"
                                                                                                            border="0"
                                                                                                            style="display:block"
                                                                                                            class="CToWUd"
                                                                                                            data-bit="iit"></a>
                                                                                                </td>
                                                                                                <td style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                                                                                                    <a href="https://www.youtube.com/channel/UCmwPxY_yThhlsAQ9uznyGKQ/"
                                                                                                       title="Youtube"
                                                                                                       target="_blank">
                                                                                                        <img
                                                                                                            src="https://ci6.googleusercontent.com/proxy/xDyUQrswODXLiQpNE78aiXnlclo___s4BhvmejdzvPafZv9KBVdC15ngG1n70rUb2kwVlwFMp5PQK0Sb-C-m_Z_N6u71Znj8NgkvEKbFhT-0jvWqzO7TQhEkxE_sECvHJ3zsEaAPiXTPOT_sTOsxbSMC0dxddLZTh7cjK_czC1lAe8tDEWUaFNJF=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000Fs30a&amp;oid=00Di0000000HF7A&amp;lastMod=1516099543000"
                                                                                                            width="24"
                                                                                                            height="24"
                                                                                                            alt="Youtube"
                                                                                                            border="0"
                                                                                                            style="display:block"
                                                                                                            class="CToWUd"
                                                                                                            data-bit="iit"></a>
                                                                                                </td>
                                                                                                <td style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                                                                                                    <a href="https://www.instagram.com/Bangladeshdrip/"
                                                                                                       title="Instagram"
                                                                                                       target="_blank"
                                                                                                       data-saferedirecturl="https://www.google.com/url?q=https://www.instagram.com/louisvuitton/&amp;source=gmail&amp;ust=1659065965480000&amp;usg=AOvVaw2tuTclq0XZe8ZRJVh0N3Rp"><img
                                                                                                            src="https://ci3.googleusercontent.com/proxy/O8faISjJa1t8xyP_dqYwW9Dnapdd4odolNCBCeorypRDm7Y6mczMWcsWG40GbREgo3WLtEI5bOW5D2p1s1pduxFzqknMWkw0EVamM7MXZZX2FTyXp6v3IiSa6gLMDIir02GFwMZKGo8xDWKPEB66rYVEsaPEOgvGzvIxkMvIzLeP6uW-6Hbk2sKI=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000Fs2zh&amp;oid=00Di0000000HF7A&amp;lastMod=1516099243000"
                                                                                                            width="24"
                                                                                                            height="24"
                                                                                                            alt="Instagram"
                                                                                                            border="0"
                                                                                                            style="display:block"
                                                                                                            class="CToWUd"
                                                                                                            data-bit="iit"></a>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>


                                                            <table width="100%" border="0" cellpadding="0"
                                                                   cellspacing="0" style="border-collapse:collapse"
                                                                   bgcolor="#c1bbb5">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="line-height:1px;font-size:1px;height:1px;width:1px"
                                                                        width="1" height="1"><img
                                                                            src="https://ci5.googleusercontent.com/proxy/BMOHWjrZTZannzu2ceMOpyS7tA8yC-80TJXbKRUWTdjN5wx5oKSwBudv_f9Ru-PMKd3PxIWrxOdkr3tc6RP51OaLVFO1JNHmI8xwLyxYoSJiqqurj5OIQwRkqBHmJQTfAcN0FconH3RW7XqIf0I_1S-Hbh3vH27i2mvFCnPTpcysLWBT5M4D2lVS=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000Fs3BY&amp;oid=00Di0000000HF7A&amp;lastMod=1516116991000"
                                                                            alt="" width="1" height="1"
                                                                            style="display:block" border="0"
                                                                            class="CToWUd" data-bit="iit"></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>

                                                            <table width="100%" border="0" cellpadding="0"
                                                                   cellspacing="0" style="border-collapse:collapse">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:11px;line-height:normal;color:#666666;text-align:center;vertical-align:top;padding-top:25px;padding-right:0px;padding-bottom:25px;padding-left:0px">
                                                                        <font color="#666666"><a
                                                                                href="https://bangladeshdrip.com"
                                                                                style="text-decoration:underline;color:#666666"
                                                                                target="_blank">
                                                                                <font
                                                                                    color="#666666"><u></u></font></a>
                                                                            © {{ date('Y') }} {{ config('app.name') }}<br><br>
                                                                            You have the right to access, modify and
                                                                            cancel your personal information.<br>
                                                                            To do so, please send an e-mail to <a
                                                                                href="mailto:contact@bangladeshdrip.com"
                                                                                style="text-decoration:underline;color:#666666"
                                                                                target="_blank"><font
                                                                                    color="#666666"><u>contact@bangladeshdrip.com</u></font></a></font>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>

                                                        </td>
                                                        <td width="10" style="line-height:1px;font-size:1px;width:10px">
                                                            <img
                                                                src="https://ci5.googleusercontent.com/proxy/BMOHWjrZTZannzu2ceMOpyS7tA8yC-80TJXbKRUWTdjN5wx5oKSwBudv_f9Ru-PMKd3PxIWrxOdkr3tc6RP51OaLVFO1JNHmI8xwLyxYoSJiqqurj5OIQwRkqBHmJQTfAcN0FconH3RW7XqIf0I_1S-Hbh3vH27i2mvFCnPTpcysLWBT5M4D2lVS=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000Fs3BY&amp;oid=00Di0000000HF7A&amp;lastMod=1516116991000"
                                                                alt="" width="10" height="1" style="display:block"
                                                                border="0" class="CToWUd" data-bit="iit"></td>
                                                        <td class="m_2559387181966715647hide" width="30"
                                                            style="line-height:1px;font-size:1px;width:30px"><img
                                                                src="https://ci5.googleusercontent.com/proxy/BMOHWjrZTZannzu2ceMOpyS7tA8yC-80TJXbKRUWTdjN5wx5oKSwBudv_f9Ru-PMKd3PxIWrxOdkr3tc6RP51OaLVFO1JNHmI8xwLyxYoSJiqqurj5OIQwRkqBHmJQTfAcN0FconH3RW7XqIf0I_1S-Hbh3vH27i2mvFCnPTpcysLWBT5M4D2lVS=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000Fs3BY&amp;oid=00Di0000000HF7A&amp;lastMod=1516116991000"
                                                                alt="" width="30" height="1" style="display:block"
                                                                border="0" class="CToWUd" data-bit="iit"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                       style="border-collapse:collapse" bgcolor="#666666">
                                                    <tbody>
                                                    <tr>
                                                        <td style="line-height:1px;font-size:1px;height:6px" height="6">
                                                            <img
                                                                src="https://ci5.googleusercontent.com/proxy/BMOHWjrZTZannzu2ceMOpyS7tA8yC-80TJXbKRUWTdjN5wx5oKSwBudv_f9Ru-PMKd3PxIWrxOdkr3tc6RP51OaLVFO1JNHmI8xwLyxYoSJiqqurj5OIQwRkqBHmJQTfAcN0FconH3RW7XqIf0I_1S-Hbh3vH27i2mvFCnPTpcysLWBT5M4D2lVS=s0-d-e1-ft#https://louisvuitton.force.com/servlet/servlet.ImageServer?id=0150H00000Fs3BY&amp;oid=00Di0000000HF7A&amp;lastMod=1516116991000"
                                                                alt="" width="1" height="6" style="display:block"
                                                                border="0" class="CToWUd" data-bit="iit"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>


                                                <div class="m_2559387181966715647hackgmail"
                                                     style="white-space:nowrap;font-size:15px;font-family:monospace;line-height:0">
                                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                    &nbsp; &nbsp; &nbsp;
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
