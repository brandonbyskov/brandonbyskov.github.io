// JavaScript Document

var zebra_colors_light=[['#CCC','#DDD'],
						['#FCC','#FDD'],
						['#CFC','#DFD'],
						['#CCF','#DDF'],
						['#FFC','#FFD'],
						['#FCF','#FDF'],
						['#CFF','#DFF']
]

var zebra_colors_prominent=[['#BBB','#EEE'],
						['#FBB','#FEE'],
						['#BFB','#EFE'],
						['#BBF','#EEF'],
						['#FFB','#FFE'],
						['#FBF','#FEF'],
						['#BFF','#EFF']
]
var exStart;
var exEnd;
var trial_count=0;
const MAX_TRIALS = 120;
var is_correct_click;

var date = new Date();
var start_time;
var end_time;

var results = new Array();

var border_type;
var zebra_striping;
var line_spacing_init;
var list_colour;
var correct_item;

function startExperiment()
{
	document.getElementById('startBox').style.display='none';
	document.getElementById('rulesBox').style.display='none';
	generateListStyle();
	generateWords();
	document.getElementById('wordBox').style.display='block';
	document.getElementById('wordBox').classList.add('wordBoxNormal');
	displayTrialCount();
	exStart=(new Date()).getTime();
	return false;
}

function generateListStyle()
{
	border_type = Math.floor(Math.random()*3);//ingeter from 0-2
	zebra_striping = Math.floor(Math.random()*3);//ingeter from 0-2
	line_spacing_init = Math.random();//float from 0-1
	list_colour = Math.floor(Math.random()*7)
	
	
	//normalize in case Math.random()==1
	if (border_type==3) border_type=2;
	if (zebra_striping==3) zebra_striping=2;
	if (list_colour==7) list_colour=6;
	
	var list_td = document.getElementById('listBox').getElementsByTagName('td');
	
	//max size test
	//border_type=2;
	//line_spacing=1;
	
	var border_style;
	if (border_type==0) //no border
	{
		border_style='none';
	} else if (border_type==1) //1px grey border
	{
		border_style='1px solid #999';
	} else if (border_type==2 || border_type==3) //2 px black border
	{
		border_style='2px solid #222';
	}
	for (var i = 1; i < list_td.length;i++)
	{
		list_td[i].style.borderTop=border_style;
	}
	
	
	if (zebra_striping==0) //no striping
	{
		document.getElementById('listTable').style.backgroundColor=zebra_colors_light[list_colour][0];
		for (var i = 0; i < list_td.length;i++)
		{
			list_td[i].style.backgroundColor='inherit';
		}
	} else if (zebra_striping==1) // faint striping
	{
		document.getElementById('listTable').style.backgroundColor=zebra_colors_light[list_colour][0];
		for (var i = 0; i < list_td.length;i+=2)
		{
			list_td[i].style.backgroundColor='inherit';
		}
		for (var i = 1; i < list_td.length;i+=2)
		{
			list_td[i].style.backgroundColor=zebra_colors_light[list_colour][1];
		}
	} else if (zebra_striping==2 || zebra_striping==3) //prominent striping
	{
		for (var i = 0; i < list_td.length;i+=2)
		{
			list_td[i].style.backgroundColor=zebra_colors_prominent[list_colour][0];
		}
		for (var i = 1; i < list_td.length;i+=2)
		{
			list_td[i].style.backgroundColor=zebra_colors_prominent[list_colour][1];
		}
	}
	
	var line_spacing=line_spacing_init*32;//add linespacing * 32 to top and bottom of each cell
	for (var i = 0; i < list_td.length;i++)
	{
		list_td[i].style.paddingBottom=line_spacing+'px';
		list_td[i].style.paddingTop=line_spacing+'px';
	}
	
}

function generateWords()
{

	correct_item = Math.floor(Math.random()*8)
	if (correct_item==8) correct_item=7;
	
	var list_slot = document.getElementsByClassName('listItem');
	
	for (i=0;i<8;i++)
	{
		var word_index = Math.floor(Math.random()*all_words.length);
		if (word_index==all_words.length) word_index = all_words.length-1;
		list_slot[i].id='incorrectItem';
		if (correct_item==i)
		{
			document.getElementById('wordBox').innerHTML=all_words[word_index];
			list_slot[i].id='correctItem';
		}
		
		list_slot[i].innerHTML=all_words[word_index];
	}
}

function startTimer()
{
	start_time = (new Date()).getTime();
}

function endTimer()
{
	end_time = (new Date()).getTime();	
}

function saveTrialResult()
{
	results[trial_count] = [trial_count, (end_time - start_time), is_correct_click,
							border_type, zebra_striping, ((line_spacing_init*2)+1), list_colour,
							correct_item];
	trial_count++;
}


function endExperiment()
{
	document.getElementById('listBox').style.display='none';
	document.getElementById('wordBox').style.display='none';
	document.getElementById('submitBox').style.display='block';
}

function errorTransition()
{
	document.getElementById('errorBox').style.opacity='1';
	window.setTimeout(function(){document.getElementById('errorBox').style.opacity='0';},480);

}

function displayTrialCount()
{
	document.getElementById('trialCountBox').innerHTML='Trial: '+(trial_count+1);
}

function clickWord()
{
	//document.getElementById('wordBox').style.display='none';
	document.getElementById('wordBox').classList.remove('wordBoxNormal');
	document.getElementById('wordBox').classList.add('wordBoxFaded');
	document.getElementById('listBox').style.display='block';
	startTimer();
	return false;
}

function clickListItem(caller)
{
	endTimer();
	if(caller.id=='correctItem') {
		is_correct_click=true;
	} else {
		is_correct_click=false;
		errorTransition();
	}
	saveTrialResult();
	document.getElementById('listBox').style.display='none';
	generateListStyle();
	generateWords();
	//document.getElementById('wordBox').style.display='block';
	document.getElementById('wordBox').classList.remove('wordBoxFaded');
	document.getElementById('wordBox').classList.add('wordBoxNormal');
	displayTrialCount();
	
	if (trial_count == MAX_TRIALS)
	{
		exEnd=(new Date()).getTime();
		endExperiment();
	}
	
	return false;
	
}

function submitFinalResults()
{
	var result_string='';
	for (i=0; i<MAX_TRIALS; i++)
	{
		result_string+=results[i];
		result_string+='<br />';
	}
	result_string+='Elapsed time: '+(exEnd-exStart);
	
	document.body.innerHTML=result_string;
	return false;
}