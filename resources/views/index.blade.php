<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AppDoctrina</title>
        <link rel="icon" type="image/png" href="{{ url('img/favicon-32x32.png') }}" sizes="32x32" />
        <link rel="icon" type="image/png" href="{{ url('img/favicon-16x16.png') }}" sizes="16x16" />
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: 0;
            }

            html, body {
                height: 100%;
                overflow: hidden;
            }

            body {
                font-family: 'Nunito', sans-serif;
                background: #ebedef;
            }

            a {
                text-decoration: none;
                width: 100%;
                line-height: 30px;
                color: black;
            }

            a:hover {
                background: #81A505;
                color: white;
            }

            .box {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100%;
            }

            .box-inner {
                width: 400px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-between;
            }

            .logo {
                width: 400px;
                height: 370px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .logo img {
                padding: 10px;
                width: 90%;
                height: 90%;
            }

            .links {
                padding: 20px 0;
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                width: 100%;
                height: 30px;
                text-align: center;
            }

            hr {
                height: 0;
                -moz-box-sizing: content-box;
                box-sizing: content-box;
                width: 100%;
            }
            
            span {
                padding-top: 10px;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="box">
            <div class="box-inner">
                <div class="logo">
                    <img src="{{ url('/img/escudo-policia.png') }}">
                </div>
                <div class="links">
                    <!-- <a href="http://localhost:4200/" target="_blank">Doctrina Policial</a> -->
                    <a href="http://172.28.9.34/" target="_blank">Doctrina Policial</a>
                    <!-- <a href="http://192.168.1.171/doctrina/api/documentation" target="_blank">Servicio Web Doctrina</a> -->
                    <a href="http://apiadenunciarrnmc.policia.gov.co/doctrina/api/documentation" target="_blank">Servicio Web Doctrina</a>
                </div>
                <hr>
                <span>
                    &copy <?php echo strftime('%Y') ?> - Dirección General de la Policia Nacional - DIPON
                </span>
            </div>
        </div>
    </body>
</html>