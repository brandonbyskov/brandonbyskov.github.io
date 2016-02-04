<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="MainStyle.css" />
    <script type="text/javascript" src="Headerscripts.js"></script>
    <title>Acessories and Peripherals</title>
    <?php
        $file=fopen("Keyboard.csv","r");

        for($i=0; ! feof($file); $i++)
          {
          $option_keyboard[]=fgetcsv($file);
          $available_keyboard=$i;
          }
        fclose($file);

        $file=fopen("Mouse.csv","r");

        for($i=0; ! feof($file); $i++)
          {
          $option_mouse[$i]=fgetcsv($file);
          $available_mouse=$i;
          }
        fclose($file);

        $file = fopen("Monitor.csv","r");

        for($i=0; ! feof($file); $i++)
          {
          $option_monitor[$i]=fgetcsv($file);
          $available_monitor=$i;
          }
        fclose($file);
    ?>
    <script type="text/javascript">
        var keyboard_cost=<?php
        echo '[';
        for ($i=0 ;$i<$available_keyboard; $i++) {
            echo $option_keyboard[$i][1].',';
        }
        echo $option_keyboard[$available_keyboard][1].']';
        ?>;
        var mouse_cost=<?php
        echo '[';
        for ($i=0 ;$i<$available_mouse; $i++) {
            echo $option_mouse[$i][1].',';
        }
        echo $option_mouse[$available_mouse][1].']';
        ?>;
        var monitor_cost=<?php
        echo '[';
        for ($i=0 ;$i<$available_monitor; $i++) {
            echo $option_monitor[$i][1].',';
        }
        echo $option_monitor[$available_monitor][1].']';
        ?>;
        var sysprice=<?php echo $_POST['sysprice'] ?>;
        var totalprice = sysprice;
        var checked=new Array();
        checked['keyboard']=0;
        checked['mouse']=0;
        checked['monitor']=0;

        function temp_focus(event,id,item) {
            document.getElementById(event.currentTarget.id).style.background="#66CCFF";
            document.getElementById(id+"_image").src = "./images/"+id+"/"+item+".jpg";
        }
        function lost_focus(event,id) {
            document.getElementById(event.currentTarget.id).style.background="";
            document.getElementById(id + "_image").src = "./images/" + id + "/" + checked[id] + ".jpg";
        }
        function select_item(id,item) {
            if(document.getElementById(id + item).checked == true)
            {
                checked[id] = item;
                document.getElementById(id + "_image").src = "./images/" + id + "/" + checked[id] + ".jpg";
            }
            totalprice=sysprice + keyboard_cost[checked['keyboard']] + mouse_cost[checked['mouse']]+monitor_cost[checked['monitor']];
            document.getElementById("total_price").innerHTML=totalprice;
        }
    </script>
    <style type="text/css">
        div.imagebox
        {
        vertical-align:top;
        display:inline-block;
        width:200px;
        height:200px;
        border:2px solid black;
        }
        div.tablebox
        {
            display:inline-block;
            height-min:200px;
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
        #outer_table
        {
            <!--width:400px;-->
        }
        #outer_table td 
        {                                  
            vertical-align:top;
            min-width:50px;
        }
        .input_button
        {
            float:left;
            clear:both;
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
Total system cost: $<span id="total_price"><?php echo $_POST['sysprice'] ?></span><br /><br />
Choose Accessories and Peripherals:<br /><br />
<form name="input" action="file" method="get">
<input type="hidden" name="sysprice" <?php echo 'value="'.$_POST['sysprice'].'"'; ?> />
<input type="hidden" name="sys" <?php echo 'value="'.$_POST['sys'].'"'; ?> />
<input type="hidden" name="OS" <?php echo 'value="'.$_POST['OS'].'"'; ?> />
<input type="hidden" name="Storage" <?php echo 'value="'.$_POST['storage'].'"'; ?> />
<input type="hidden" name="Optical" value="<?php echo $_POST['optical']; ?>" />

<fieldset>
<legend>Select Keyboard</legend>
<div class="imagebox" ><img id="keyboard_image" border="0" src="./images/keyboard/0.jpg" alt="[Keyboard Image]" width="200" height="200" /></div>
<div class="tablebox"><table class="inner_table">
<?php
$num=0;
foreach($option_keyboard as $x)
{
    if ($num==0)
        echo '<tr id="keyboardtr'.$num.'" onmouseover="temp_focus(event,\'keyboard\','.$num.')" onmouseout="lost_focus(event,\'keyboard\')"><td><input type="radio" id="keyboard'.$num.'" name="keyboard" onclick="select_item(\'keyboard\','.$num.')" checked="checked" value="'.$num.'" />'.$x[0].'</td><td>[Item Cost: $'.$x[1].']</td></tr>';
    else
        echo '<tr id="keyboardtr'.$num.'" onmouseover="temp_focus(event,\'keyboard\','.$num.')" onmouseout="lost_focus(event,\'keyboard\')"><td><input type="radio" id="keyboard'.$num.'" name="keyboard" value="'.$num.'" onclick="select_item(\'keyboard\','.$num.')" />'.$x[0].'</td><td>[Item Cost: $'.$x[1].']</td></tr>';
    $num++;
}
?>
</table></div></fieldset><br />

<fieldset>
<legend>Select Mouse</legend>
<div class="imagebox"><img id="mouse_image" border="0" src="./images/mouse/0.jpg" alt="[Mouse Image]" width="200" height="200" /></div>
<div class="tablebox"><table class="inner_table">
<?php
$num=0;
foreach($option_mouse as $x)
{
    if ($num==0)
        echo '<tr id="mousetr'.$num.'" onmouseover="temp_focus(event,\'mouse\','.$num.')" onmouseout="lost_focus(event,\'mouse\')"><td><input type="radio" id="mouse'.$num.'" name="mouse" onclick="select_item(\'mouse\','.$num.')" checked="checked" value="'.$num.'" />'.$x[0].'</td><td>[Item Cost: $'.$x[1].']</td></tr>';
    else
        echo '<tr id="mousetr'.$num.'" onmouseover="temp_focus(event,\'mouse\','.$num.')" onmouseout="lost_focus(event,\'mouse\')"><td><input type="radio" id="mouse'.$num.'" name="mouse" value="'.$num.'" onclick="select_item(\'mouse\','.$num.')" />'.$x[0].'</td><td>[Item Cost: $'.$x[1].']</td></tr>';
    $num++;
}
?>
</table></div></fieldset><br />

<fieldset>
<legend>Select Monitor</legend>
<div class="imagebox"><img id="monitor_image" border="0" src="./images/monitor/0.jpg" alt="[monitor Image]" width="200" height="200" /></div>
<div class="tablebox"><table class="inner_table">
<?php
$num=0;
foreach($option_monitor as $x)
{
    if ($num==0)
        echo '<tr id="monitortr'.$num.'" onmouseover="temp_focus(event,\'monitor\','.$num.')" onmouseout="lost_focus(event,\'monitor\')"><td><input type="radio" id="monitor'.$num.'" name="monitor" onclick="select_item(\'monitor\','.$num.')" checked="checked" value="'.$num.'" />'.$x[0].'</td><td>[Item Cost: $'.$x[1].']</td></tr>';
    else
        echo '<tr id="monitortr'.$num.'" onmouseover="temp_focus(event,\'monitor\','.$num.')" onmouseout="lost_focus(event,\'monitor\')"><td><input type="radio" id="monitor'.$num.'" name="monitor" value="'.$num.'" onclick="select_item(\'monitor\','.$num.')" />'.$x[0].'</td><td>[Item Cost: $'.$x[1].']</td></tr>';
    $num++;
}
?>
</table></div></fieldset><br />

<input type="submit" value="Review and Purchase Computer" />
</form></div>

</body>
</html>