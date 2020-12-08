//CLOCK
var clock = function(){ 

var date = new Date();  
var options = {    
   hour: "2-digit", minute: "2-digit", second: "2-digit"  
};  
showTime = date.toLocaleTimeString("en-us", options); 
document.getElementById("clock_main").innerHTML = showTime;
};

setInterval(clock, 1000);
clock();

//TO TOP

var mybutton = document.getElementById('to_top');

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
  }
  
mybutton.addEventListener('click',topFunction);


//SHOW MORE POSTS 
function start()
	{
	$('#more_button').on('click',function()
	{
	$('#more_posts').toggleClass('show')
	});
	}


$(start);

// DELETE CONFIRM
var buttons = document.getElementsByClassName('delete_icon');

for (var i = 0 ; i < buttons.length ; ++i)
	buttons[i].addEventListener("click",function(event)
	{
		if (confirm("Are you sure you want to delete post!")) {
		return true;
		} else {
			event.preventDefault();
			return false;
		}
	});


// SPIN MEEEEE

var spin = document.getElementsByClassName('spin');
	
for (var i = 0 ; i < spin.length ; ++i)
	spin[i].addEventListener("click",function(event)
	{
		{
			if (this.classList.contains('spinning'))
				this.classList.remove('spinning');
			else
				this.classList.add('spinning');
		}
	});
	



