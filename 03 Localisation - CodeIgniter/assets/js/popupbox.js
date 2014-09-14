/* 	0.5b - 03/07/2009
	Intersurgical
	PopupBox 0.1
	16/06/2009
	
	#popupbox - Modal window div
*/


function getPageScroll() {
    var xScroll, yScroll;
    if (self.pageYOffset) {
      yScroll = self.pageYOffset;
      xScroll = self.pageXOffset;
    } else if (document.documentElement && document.documentElement.scrollTop) {	 // Explorer 6 Strict
      yScroll = document.documentElement.scrollTop;
      xScroll = document.documentElement.scrollLeft;
    } else if (document.body) {// all other Explorers
      yScroll = document.body.scrollTop;
      xScroll = document.body.scrollLeft;	
    }
    return new Array(xScroll,yScroll) 
  }

  // Adapted from getPageSize() by quirksmode.com
  function getPageHeight() {
    var windowHeight
    if (self.innerHeight) {	// all except Explorer
      windowHeight = self.innerHeight;
    } else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
      windowHeight = document.documentElement.clientHeight;
    } else if (document.body) { // other Explorers
      windowHeight = document.body.clientHeight;
    }	
    return windowHeight
  }

 function showOverlay() {
 	opacity = 0.7;      
     $("body").append('<div id="facebox_overlay" class="facebox_hide"></div>')

    $('#facebox_overlay').hide().addClass("facebox_overlayBG")
      .css('opacity', opacity)
      .click(function() { CloseBox() })
      .fadeIn(200)
 }

  function hideOverlay() {
      $('#facebox_overlay').fadeOut(200, function(){
      $("#facebox_overlay").removeClass("facebox_overlayBG")
      $("#facebox_overlay").addClass("facebox_hide") 
      $("#facebox_overlay").remove()
    })
  }


function ShowBox() {
		$('#popupbox').css({
	        top:	getPageScroll()[1] + (getPageHeight() / 10) + 60
	      })
		$('#popupbox').fadeIn('normal')
		//$("#popupbox").show();
		showOverlay();
	
}

function CloseBox() {
		$("#popupbox").hide();
		$("#popupbox").html("");
		hideOverlay();
}
	
function Fill_product(code) {
		$.get("/ajax/popupbox.php?code=" + code, function(data){
	  		 $("#popupbox").html(data);
			 $(".close_window").bind("click", function() { CloseBox(); });
			 $('#popupbox').css('left', $(window).width() / 2 -  ($('#popupbox').width() / 2)  );
			});			
}

function PopupBox(code) {
	Fill_product(code);
	ShowBox();
}

function PopupImage(href) {
	    data = '<div id="popupcontent"><div id="close_button" class="close_window"></div><div class="image"><img src="' + href + '" /></div></div>';
		$("#popupbox").addClass("image"); 
		$("#popupbox").html(data);
		 $(".close_window").bind("click", function() { CloseBox(); });
		 $('#popupbox').css('left', $(window).width() / 2 -  ($('#popupbox').width() / 2)  );
		ShowBox();
}
	
$(document).keyup(function(event){
    if (event.keyCode == 27) {
		CloseBox();
    }
});