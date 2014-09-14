function Subsid(id) {
	$.get("/ajax/distributor_load.php?q=" + id, function(data){
  		 $("#distributor").html(data); 
		});
}


function setCookie(c_name,value,expiredays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate()+expiredays);
document.cookie=c_name+ "=" +escape(value)+
((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}

function getCookie(c_name)
{
if (document.cookie.length>0)
  {
  c_start=document.cookie.indexOf(c_name + "=");
  if (c_start!=-1)
    { 
    c_start=c_start + c_name.length+1; 
    c_end=document.cookie.indexOf(";",c_start);
    if (c_end==-1) c_end=document.cookie.length;
    return unescape(document.cookie.substring(c_start,c_end));
    } 
  }
return "";
}

function checkCookie()
{
country=getCookie('country');
if (country!=null && country!="")
{
//alert('Country: '+country+'!');
}
else 
{
//country=prompt('Please enter your country name:',"");
jQuery.facebox({ image: 'images/flags.jpg' });
if (country!=null && country!="")
{
setCookie('country','set',365);
} 
}
}


//Document ready
$(document).ready(function(){
 		
//International Box
$("#choose_country").click(function() {
	$("#international_box").slideToggle("slow");
	
})

$("#int_close").click(function() {
	$("#international_box").slideToggle("slow");
	
})	
		
//Navigation   
$("li.submenu").hover(function () {
	$(".sub", this).show();
	},
	function () {
	$(".sub", this).hide();
	}
);

//Choose from the distributor drop down list
$("#country").change(function () {
	country= $("#country").val();
	$.get("/ajax/distributor_load.php?q=" + country, function(data){
  		 $("#distributor").html(data); 
		}); 
});

// Newsletter signup
$("#signup").submit( function() {
	email = $('#newsletter_email').val(); 
	name = $('#newsletter_name').val(); 
//	alert(email);
	$("#newsletter_inside").html("Adding email address...");
	$.get("/ajax/store-address.php?ajax=true&email=" + email+ "&name=" + name, function(data){
  		 $("#newsletter_inside").html(data); 
		});
	return false; 
});

$('table.product a.image').click(function(e) {
	e.preventDefault();
	var href = $(this).attr('href');
	PopupImage(href);
});

 
 }); //document ready