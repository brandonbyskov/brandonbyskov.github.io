<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="MainStyle.css" />
    <title>Home</title>
    <script type="text/javascript">
        function header_get_focus(event) {
                document.getElementById(event.currentTarget.id).style.color = "black";
                document.getElementById(event.currentTarget.id).style.background = "#8CDAF1";
        }
        function header_lost_focus(event) {
            if (event.currentTarget.id == "thisPage") {
                document.getElementById(event.currentTarget.id).style.color = "black";
                document.getElementById(event.currentTarget.id).style.background = "#E8E8E8";
            }
            else {
                document.getElementById(event.currentTarget.id).style.color = "#00ADE0";
                document.getElementById(event.currentTarget.id).style.background = "#505050";
            }
        }
    </script>
    <style type="text/css">
        .home_image
        {
            margin:auto;
            background-image:url('images/homeimage3.gif');
            background-repeat:no-repeat;
            border:2px solid #00ADE0;
            height:360px;
            width:640px;
        }
        #thisPage
        {
            background-color:#E8E8E8;
            border-bottom-color:#E8E8E8;
            color:Black;
        }
        #lastPage
        {
            border-bottom:3px solid black;
            background-color:transparent;
            border-width:0px;
            border-bottom:2px solid black;
            width:100%;
        }
    </style>
</head>
<body>
<div class="header" ><a href="home.php"><img border="" id="logo" src="./images/logo2.png" alt="Infinity" /></a><table class="headerlinks"><tr>
<td id="thisPage" onmouseover="header_get_focus(event)" onmouseout="header_lost_focus(event)"><a href="home.php">Home</a></td>
<td id="header2" onmouseover="header_get_focus(event)" onmouseout="header_lost_focus(event)"><a href="design.php">Products</a></td>
<td id="header3" onmouseover="header_get_focus(event)" onmouseout="header_lost_focus(event)"><a href="about.htm">About&nbsp;Infinity</a></td>
<td id="header4" onmouseover="header_get_focus(event)" onmouseout="header_lost_focus(event)"><a href="contact.htm">Contact&nbsp;Us</a></td>
<td id="lastPage"></td></tr></table></div>

<div class="MainPage">
<div class="home_image"></div></div>


</body>
</html>