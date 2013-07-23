<?php
/* @var Controller $this */
?>
<!DOCTYPE html>
<!--suppress HtmlUnknownAttribute -->
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <link rel="icon" href="<?php echo baseUrl('/favicon.ico'); ?>" type="image/x-icon"/>

    <title><?php echo e($this->pageTitle); ?></title>
</head>

<body class="layout-email" bgcolor="#EEEEEE"
      style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #333333; padding: 80px 0;">

<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center" style="table-layout: fixed;">
    <tr>
        <td valign="top">
            <table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                    <td valign="top">
                        <div align="right" style="margin-bottom: 5px;">
                            <a href="{viewUrl}" style="text-decoration: none;"><?php echo t(
                                    'email',
                                    'Read this in your browser'
                                ); ?>.</a>
                        </div>
                    </td>
                </tr>
            </table>
            <table width="670" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF"
                   style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px;">
                <tr>
                    <td valign="top">
                        <div style="padding: 20px; text-align: left;">
                            <?php echo $content; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>