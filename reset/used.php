<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <title>Used Reset Password</title>
    <style>
        *{
            margin:0;
            padding: 0;
            outline: none;
            font-family: sans-serif;
        }


        body{
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(0deg, rgba(190,190,255,1) 29%, rgba(0,212,255,1) 100%);
        }

        .container{
            width: 330px;
            background: white;
            border-radius: 5px;
            text-align: center;
            padding: 0px 35px 10px 35px;
            overflow: hidden;
        }

        .container .form-outer{
            width: 100%;
            overflow: hidden;
        }

        .form-outer form{
            display: flex;
            width: 500%;
        }

        .form-outer form .page{
            width: 20%;
            transition: margin-left 0.5s ease-in-out;
        }

        div.title{
            text-align: center;
            margin: 20px 0;
            font-weight: 700;
            color: #3f89e7;
            font-size: 20px;
        }

        div.title_sub{
            text-align: center;
            margin: 20px 0;
            font-weight: 700;
            color: #3f89e7;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="container" style="width:330px; height:416.6px;">
        <div class="form-outer">
            <form action="#" method="POST" autocomplete="off">
                <div class="page">
                    <img src="../images/header_footer/logo.png" width="80%" style="margin: 0 auto; padding-top: 20px;">
                    <div class="title" style="font-size: 22px;">Oops!</div>
                    <div class="title_sub" style="text-align:center; padding-top: 10%; font-size: 15px;">This link is no longer avaliable.</div>
                    <div class="title_sub count_down" style="text-align: center; font-size: 10px; color: grey; padding-top:10%;">This window will close automatically within <span id="counter" style="color: red;">10</span> second(s).</div>
                </div>
            </form>
        </div>      
    </div>
    <script type="text/javascript">
        function countdown() {
            var i = document.getElementById('counter');
            i.innerHTML = parseInt(i.innerHTML)-1;
            
            if (parseInt(i.innerHTML)<=0)
            {
                window.close();
            }
        }
        setInterval(function(){ countdown(); },1000);
    </script>
</body>
</html>