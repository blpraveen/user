<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; color: #74787E; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">
    <style>
        p {
            font-family: Avenir, Helvetica, sans-serif; 
            box-sizing: border-box; 
            color: #74787E; 
            font-size: 14px; 
            line-height: 1.5em; 
            margin-top: 0; 
            text-align: left;
        }
        .container {
            padding-top: 20px;
            padding-left: 20px;
        }
    </style>

<div class="container">    
    <p>Hello Admin</p>

    <p>To the Dish {{$dish['dish_name']}} qunatity is less.</p>

    <p>Regards, Team {{config('app.name')}}</p>    
</div>
</body>
</html>
