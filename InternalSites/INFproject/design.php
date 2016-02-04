<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="MainStyle.css" />
    <script type="text/javascript" src="Headerscripts.js"></script>
    <title>Design Computer - Infinity</title>
    <?php
        $file=fopen("components/OS.csv","r");

        for($i=0; ! feof($file); $i++)
          {
          $option_OS[]=fgetcsv($file);
          $available_OS=$i;
          }
        fclose($file);

        $file=fopen("components/Storage.csv","r");

        for($i=0; ! feof($file); $i++)
          {
          $option_storage[$i]=fgetcsv($file);
          $available_storage=$i;
          }
        fclose($file);

        $file = fopen("components/Optical.csv","r");

        for($i=0; ! feof($file); $i++)
          {
          $option_optical[$i]=fgetcsv($file);
          $available_optical=$i;
          }
        fclose($file);
    ?>
    <script type="text/javascript">
        function temp_focus(event) {
            document.getElementById(event.currentTarget.id).style.background="#66CCFF";
        }
        function lost_focus(event) {
            document.getElementById(event.currentTarget.id).style.background="";
        }
    </script>
    <style type="text/css">
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
        div.imagebox
        {
        vertical-align:top;
        display:inline-block;
        width:200px;
        height:200px;
        border:3px solid black;
        }
        div.tablebox
        {
            display:inline-block;
            min-height:200px;
        }
        .inner_table
        {
            border-collapse:collapse;
        }
        .inner_table td
        {
            vertical-align:bottom;
            padding:3px 5px 4px 5px;
        }
        .inner_table colgroup
        {
            width:300px;
        }
        fieldset
        {
            
            border:1px solid black;
        }
    </style>
</head>
<body>
<div class="header" ><a href="home.htm"><img border="" id="logo" src="./images/logo2.png" alt="Infinity" /></a><table class="headerlinks"><tr>
<td id="header1" onmouseover="header_get_focus(event)" onmouseout="header_lost_focus(event)"><a href="home.htm">Home</a></td><td class="midpage"></td>
<td id="thisPage" onmouseover="header_get_focus(event)" onmouseout="header_lost_focus(event)"><a href="design.php">Products</a></td><td class="midpage"></td>
<td id="header3" onmouseover="header_get_focus(event)" onmouseout="header_lost_focus(event)"><a href="about.htm">About&nbsp;Infinity</a></td><td class="midpage"></td>
<td id="header4" onmouseover="header_get_focus(event)" onmouseout="header_lost_focus(event)"><a href="contact.htm">Contact&nbsp;Us</a></td>
<td id="lastPage"></td></tr></table></div>

<div class="MainPage">
<input type="hidden" name="sysprice" <?php echo 'value="'.$_POST['sysprice'].'"'; ?> />
<input type="hidden" name="sys" <?php echo 'value="'.$_POST['sys'].'"'; ?> />
<input type="hidden" name="OS" <?php echo 'value="'.$_POST['OS'].'"'; ?> />
<input type="hidden" name="Storage" <?php echo 'value="'.$_POST['storage'].'"'; ?> />
<input type="hidden" name="Optical" value="<?php echo 'value="'.$_POST['optical'].'"'; ?> />

<form name="input" action="systemout.php" method="post">
Computer's main purpose:
<select name="type">
<option value="Games">Gaming</option>
<option value="Video">Video Editing/Transcoding</option>
</select><br /><br />
Desired final price: $<input type="text" name="price" size='4' maxlength='6' onKeyPress="return numbersonly(this, event)" /><br /><br />

<fieldset>
<legend>Select Operating System</legend>
<table class="inner_table">
<colgroup />
<?php
$num=0;
foreach($option_OS as $x)
{
    if ($num==1)
        echo '<tr id="OStr'.$num.'" onmouseover="temp_focus(event)" onmouseout="lost_focus(event)"><td><input type="radio" name="OS" checked="checked" value="'.$num.'" />'.$x[0].'</td><td>[Item Cost: $'.$x[1].']</td></tr>';
    else
        echo '<tr id="OStr'.$num.'" onmouseover="temp_focus(event)" onmouseout="lost_focus(event)"><td><input type="radio" name="OS" value="'.$num.'" />'.$x[0].'</td><td>[Item Cost: $'.$x[1].']</td></tr>';
    $num++;
}
?>
</table></fieldset><br />

<fieldset>
<legend>Select Primary Storage</legend>
<table class="inner_table">
<colgroup />
<?php
$num=0;
foreach($option_storage as $x)
{
    if ($x[0]==0||$x[0]==1) 
    {
        if ($num==1)
            echo '<tr id="storage1tr'.$num.'" onmouseover="temp_focus(event)" onmouseout="lost_focus(event)"><td><input type="radio" name="storage1" checked="checked" value="'.$num.'" />'.$x[1].'</td><td>[Item Cost: $'.$x[2].']</td></tr>';
        else
            echo '<tr id="storage1tr'.$num.'" onmouseover="temp_focus(event)" onmouseout="lost_focus(event)"><td><input type="radio" name="storage1" value="'.$num.'" />'.$x[1].'</td><td>[Item Cost: $'.$x[2].']</td></tr>';
    }
    $num++;
}
?>
</table></fieldset><br />

<fieldset>
<legend>Select Additional Storage</legend>
<table class="inner_table">
<colgroup />
<?php
$num=0;
foreach($option_storage as $x)
{
    if ($x[0]==0||$x[0]==2) 
    {
        if ($num==0)
            echo '<tr id="storage2tr'.$num.'" onmouseover="temp_focus(event)" onmouseout="lost_focus(event)"><td><input type="radio" name="storage2" checked="checked" value="'.$num.'" />'.$x[1].'</td><td>[Item Cost: $'.$x[2].']</td></tr>';
        else
            echo '<tr id="storage2tr'.$num.'" onmouseover="temp_focus(event)" onmouseout="lost_focus(event)"><td><input type="radio" name="storage2" value="'.$num.'" />'.$x[1].'</td><td>[Item Cost: $'.$x[2].']</td></tr>';
    }
    $num++;
}
?>
</table></fieldset><br />

<fieldset>
<legend>Select Optical Disk Drive</legend>
<table class="inner_table">
<colgroup />
<?php
$num=0;
foreach($option_optical as $x)
{
        if ($num==0)
            echo '<tr id="opticaltr'.$num.'" onmouseover="temp_focus(event)" onmouseout="lost_focus(event)"><td><input type="radio" name="optical" checked="checked" value="'.$num.'" />'.$x[0].'</td><td>[Item Cost: $'.$x[1].']</td></tr>';
        else
            echo '<tr id="opticaltr'.$num.'" onmouseover="temp_focus(event)" onmouseout="lost_focus(event)"><td><input type="radio" name="optical" value="'.$num.'" />'.$x[0].'</td><td>[Item Cost: $'.$x[1].']</td></tr>';
    $num++;
}
?>
</table></fieldset><br />

<input type="submit" value="Design Computer" />
</form></div>

</body>
</html>