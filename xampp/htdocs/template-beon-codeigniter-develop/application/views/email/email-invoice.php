<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Pasar Mbois</title>
</head>

<body style="margin:0px; background: #f8f8f8; ">
    <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
        <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
                <tbody>
                    <tr>
                        <td style="vertical-align: top; padding-bottom:30px;" align="center"><a href="<?php echo $base_url?>" target="_blank">
            <img src="<?php echo @$logo?>" alt="Pasar mbois" style="border:none"></a> </td>
                    </tr>
                </tbody>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="background:#36bea6; padding:20px; color:#fff; text-align:center;"> Terimakasih Telah melakukan Pembelian </td>
                    </tr>
                </tbody>
            </table>
            <div style="padding: 40px; background: #fff;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td><b><?php echo $fullname?></b>
                                <p style="margin-top:0px;">Invoice #<?php echo $invoice?></p>
                            </td>
                            <td align="right" width="100"> <?php echo $created?>-<?php echo $expired?> </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding:20px 0; border-top:1px solid #f6f6f6;">
                                <div>
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <?php foreach($detail as $p):?>
                                            <tr>
                                                <td style="font-family: 'arial'; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;"><?php echo $p['title_product']?></td>
                                                <td style="font-family: 'arial'; font-size: 14px; vertical-align: middle; margin: 0; padding: 9px 0;" align="right"><?php echo $total= $p['qty']*$p['selling_price']?></td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b></b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>