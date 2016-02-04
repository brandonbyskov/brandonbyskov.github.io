<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="MainStyle.css" />
    <script type="text/javascript" src="Headerscripts.js"></script>
    <title>Choose Computer - Choose Computer</title>
    <?php
    $user_type=$_POST['type'];
    $user_price=$_POST['price'];
    $user_OS=$_POST['OS'];
    $user_HDD1=$_POST['storage1'];
    $user_HDD2=$_POST['storage2'];
    $user_ODD=$_POST['optical'];

    $file=fopen("arrays/".$user_type.".arr","r");
    for($i=0; ! feof($file); $i++)
        {
        $system[$i]=fgetcsv($file);
        $available_systems=$i;
        }
    fclose($file);

    $file=fopen("components/OS.csv","r");
    for($i=0; ! feof($file); $i++)
        {
        $OS[$i]=fgetcsv($file);
        }
    fclose($file);

    $file=fopen("components/Storage.csv","r");
    for($i=0; ! feof($file); $i++)
        {
        $storage[$i]=fgetcsv($file);
        }
    fclose($file);

    $file=fopen("components/Optical.csv","r");
    for($i=0; ! feof($file); $i++)
        {
        $optical[$i]=fgetcsv($file);
        }
    fclose($file);

    $components_price=($OS[$user_OS][1]+$storage[$user_HDD1][2]+$storage[$user_HDD2][2]+$optical[$user_ODD][1]);

    $fix_price=$user_price-$components_price;

    if ($fix_price>=$system[0][0]) {
		$sys1=0;
    }
	elseif ($fix_price<=$system[$available_systems][0])
    {
		$sys1=$available_systems;
    }
	else
	{
		$pricediff=$system[0][0];
		for ($sys=$available_systems;$sys>=0;$sys--)
		{
			if (abs($fix_price-$system[$sys][0])<$pricediff)
			{
				$pricediff=abs($fix_price-$system[$sys][0]);
				$sys1=$sys;
			}
			else {
				break;
            }
		}

	}

    if ($sys1==0)
	{
		$sys1=2;
		$sys2=1;
		$sys3=0;
	}
	elseif ($sys1==$available_systems)
	{
		$sys1=$available_systems;
		$sys2=$available_systems-1;
		$sys3=$available_systems-2;
	}
	else
	{
		$sys2=$sys1;
        $sys1=$sys2+1;
        $sys3=$sys2-1;
	}

    $sys1price=$system[$sys1][0]+$components_price;
    $sys2price=$system[$sys2][0]+$components_price;
    $sys3price=$system[$sys3][0]+$components_price;

    ?>
    <script type="text/javascript">
        function formsubmit(sys,price) {
            document.getElementById("sys").value = sys;
            document.getElementById("sysprice").value = price;
            document.forms["purchaseform"].submit();
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
        .system_out_table
        {
            width:99%;
            text-align:center;
            margin-left:auto;
            margin-right:auto;
            border-collapse:collapse;
        }
        .system_out_table td
        {
            padding-top:4px;
            padding-bottom:4px;
            border:1px solid black;
        }
        .system_out_table tr
        {
            background-color:#999999;
        }
        .system_out_table tr.alt
        {
            background-color:#80B0D0;
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
        <h1>Awesome <?php
        if ($user_type=="Games") {
            echo 'Gaming';
        }
        elseif ($user_type=="Video") {
            echo 'Video Editing and Transcoding'; 
        } ?>
        Computers</h1><br />
        <form name="purchaseform" action="accessories.php" method="post" />
        <input type="hidden" name="type" <?php echo 'value="'.$user_type.'"' ?> />
        <input type="hidden" id="sys" name="sys" value="" />
        <input type="hidden" id="sysprice" name="sysprice" value="" />
        <input type="hidden" name="storage1" <?php echo 'value="'.$user_HDD1.'"' ?> />
        <input type="hidden" name="storage2" <?php echo 'value="'.$user_HDD2.'"' ?> />
        <input type="hidden" name="optical" <?php echo 'value="'.$user_ODD.'"' ?> />
        <input type="hidden" name="OS" <?php echo 'value="'.$user_OS.'"' ?> />
        <table class="system_out_table">
        <?php
        echo '<tr><td>Price</td><td>$'.$sys1price.'</td><td>$'.$sys2price.'</td><td>$'.$sys3price.'</td></tr>
        <tr class="alt"><td>Processor</td><td>'.$system[$sys1][1].'<br />'.$system[$sys1][2].'</td><td>'.$system[$sys2][1].'<br />'.$system[$sys2][2].'</td><td>'.$system[$sys3][1].'<br />'.$system[$sys3][2].'</td></tr>
        <tr><td>Memory</td><td>'.$system[$sys1][3].'</td><td>'.$system[$sys2][3].'</td><td>'.$system[$sys3][3].'</td></tr>
        <tr class="alt"><td>Graphics</td><td>'.$system[$sys1][4].'</td><td>'.$system[$sys2][4].'</td><td>'.$system[$sys3][4].'</td></tr>
        <tr><td>Storage</td><td>'.$storage[$user_HDD1][1].'</td><td>'.$storage[$user_HDD1][1].'</td><td>'.$storage[$user_HDD1][1].'</td></tr>';
        if ($user_HDD2 != 0) {
            echo '<tr class="alt"><td>Additional Storage</td><td>'.$storage[$user_HDD2][1].'</td><td>'.$storage[$user_HDD2][1].'</td><td>'.$storage[$user_HDD2][1].'</td></tr>
            <tr><td>Optical Disk Drive</td><td>'.$optical[$user_ODD][0].'</td><td>'.$optical[$user_ODD][0].'</td><td>'.$optical[$user_ODD][0].'</td></tr>
            <tr class="alt"><td>Operating System</td><td>'.$OS[$user_OS][0].'</td><td>'.$OS[$user_OS][0].'</td><td>'.$OS[$user_OS][0].'</td></tr>
            <tr><td></td><td><input type="button" onclick="formsubmit('.$sys1.','.$sys1price.')" value="Purchase" /></td><td><input type="button" onclick="formsubmit('.$sys2.','.$sys2price.')" value="Purchase" /></td><td><input type="button" onclick="formsubmit('.$sys3.','.$sys3price.')" value="Purchase" /></td></tr>';
        }
        else {
            echo '<tr class="alt"><td>Optical Disk Drive</td><td>'.$optical[$user_ODD][0].'</td><td>'.$optical[$user_ODD][0].'</td><td>'.$optical[$user_ODD][0].'</td></tr>
            <tr><td>Operating System</td><td>'.$OS[$user_OS][0].'</td><td>'.$OS[$user_OS][0].'</td><td>'.$OS[$user_OS][0].'</td></tr>
            <tr class="alt"><td></td><td><input type="button" onclick="formsubmit('.$sys1.','.$sys1price.')" value="Purchase" /></td><td><input type="button" onclick="formsubmit('.$sys2.','.$sys2price.')" value="Purchase" /></td><td><input type="button" onclick="formsubmit('.$sys3.','.$sys3price.')" value="Purchase" /></td></tr>';
        }
        ?>

        </table>
        </form>



    </div>
</body>
</html>
