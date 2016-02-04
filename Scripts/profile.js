// JavaScript Document
function showDetails(s){}
function hideDetails(caller){}
function showCourseDetails(s){}
function hideCourseDetails(caller){}

function tileAnimator(){}
function scrollTile(tile_array){}

openDetails = [];

function showDetails(s)
{
	if (s==null) {}
	else
	{	
		var items = document.getElementsByClassName('tile_container');
		for (i=0;i<items.length;i++)
		{
			items[i].style.opacity='0';	
		}
		//document.getElementById(s).style.transitionTimingFunction='cubic-bezier(0,0,0.1,1)';
		document.getElementById(s).style.transition='margin-left 1s';
		document.getElementById(s).style.marginLeft='0vw';
		document.getElementById('close_box').style.marginRight="0";
		openDetails.push(document.getElementById(s));
	}
	
}

function hideDetails() {
	[].forEach.call(document.getElementsByClassName('tile_container'), function(i){i.style.opacity='1';});

	document.getElementById('close_box').style.marginRight="20vw";
	openDetails.forEach( function(a){
		a.style.transitionTimingFunction='linear';
		a.style.transition='margin-left .7s';
		a.style.marginLeft='82vw';
	} );
	openDetails = [];
}

/*
function hideDetails(caller)
{
	var items = document.getElementsByClassName('tile_container');
	for (i=0;i<items.length;i++)
	{
		items[i].style.opacity='1';	
	}

	document.getElementById('close_box').style.marginRight="20vw";

	document.getElementById(caller.id).style.transitionTimingFunction='linear';
	document.getElementById(caller.id).style.transition='margin-left .7s';
	document.getElementById(caller.id).style.marginLeft='82vw';
}
*/

function showCourseDetails(s) {
	
}

//tile initialize
//class TileSet

function TileSet(in_array)
{
	//constructor
	this.id_array=in_array;
	this.set_size=this.	id_array.length;
	
	if (this.set_size<2) {this.animatable=false;}
	else
	{
		this.animatable=true;
		this.prev=this.set_size-1;
		this.current=0;
		this.isResume = (this.id_array[0]=='resume_content_item1') ? true : false;
	}
	
	
	//methods
	this.setupNewTile=setupNewTile;
	function setupNewTile(callback)
	{
		if (this.isResume)
		{
			document.getElementById(this.id_array[this.prev]).style.zIndex=0;
			this.prev=this.current;
			this.current=(this.current+1)%this.set_size;
			document.getElementById(this.id_array[this.current]).style.transition='margin 0s';
			document.getElementById(this.id_array[this.current]).style.marginTop='17vh';
			document.getElementById(this.id_array[this.prev]).style.zIndex=1;
			document.getElementById(this.id_array[this.prev]).style.position='absolute';
			document.getElementById(this.id_array[this.current]).style.zIndex=2;
			document.getElementById(this.id_array[this.current]).style.position='relative';
			document.getElementById('resume_thumbnail'+(this.current+1)).style.left=(Math.random()*100)+'%';
		}
		else
		{
			document.getElementById(this.id_array[this.prev]).style.zIndex=0;
			this.prev=this.current;
			this.current=(this.current+1)%this.set_size;
			document.getElementById(this.id_array[this.current]).style.transition='margin 0s';
			document.getElementById(this.id_array[this.current]).style.marginTop='17vh';
			document.getElementById(this.id_array[this.prev]).style.zIndex=1;
			document.getElementById(this.id_array[this.prev]).style.position='absolute';
			document.getElementById(this.id_array[this.current]).style.zIndex=2;
			document.getElementById(this.id_array[this.current]).style.position='relative';
			//document.getElementById('work_content_item1').innerHTML='1';
		}
		setTimeout(function(){callback()},50);
	}
	
	this.moveUpNewTile=moveUpNewTile;
	function moveUpNewTile()
	{
		
		document.getElementById(this.id_array[this.current]).style.transition='margin .5s';
		document.getElementById(this.id_array[this.current]).style.marginTop='0vh';
		//document.getElementById(this.id_array[this.current]).innerHTML='lololol';
		//document.getElementById('work_content_item1').innerHTML='2';
		//document.getElementById('').style.transition='margin 1s';
		//document.getElementById(this.id_array[this.current]).style.marginTop='0';
	}
	this.scrollTile=scrollTile;
	function scrollTile()
	{
		if(this.animatable)
		{
			var object=this;
			this.setupNewTile(function(){object.moveUpNewTile()});
		}
	}
	
}

//Initialize Tiles
var animatable_tiles = new Array(//new TileSet(new Array('about_content_item1','about_content_item2','about_content_item3')),
								new TileSet(new Array('resume_content_item1','resume_content_item2','resume_content_item3')),
								new TileSet(new Array('learning_content_item1','learning_content_item2','learning_content_item3')),
								new TileSet(new Array('projects_content_item1','projects_content_item2','projects_content_item3')),
								new TileSet(new Array('work_content_item1','work_content_item2')),
								new TileSet(new Array('contact_content_item1','contact_content_item2')),
								new TileSet(new Array('skills_content_item1','skills_content_item2','skills_content_item3')),
								new TileSet(new Array('interests_content_item1','interests_content_item2','interests_content_item3'))
								);



function scrollTimed(i, delay)
{
	setTimeout(function(){i.scrollTile()},delay);
}

setInterval(function(){tileAnimator()},4000);
function tileAnimator()
{
	var delay=0
	for (i=0;i<animatable_tiles.length;i++)
	{
		
		if(Math.random()<.33)
		{
			delay+=200;
			scrollTimed(animatable_tiles[i],delay);
			//(animatable_tiles[i]).scrollTile();
			
		}
	}	
}