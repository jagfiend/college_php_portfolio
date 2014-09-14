/* 	
	Intersurgical
	Search-autocomplete 0.5b
	03/07/2009
	
	#query - search input field
	#deleteDiv - delete button
	#searchDiv - search result
*/ 


 $(document).ready(function(){
  	
	function Init () {
		defSearchStr= $("#query").val();
		 $("#deleteDIV").hide();
		use=false;
	}

	function startSearch () {
		if (!use) { 
			 $("#query").val(""); 
		}
		if (use) {$("#searchDIV").show();};
		use=true;
		
	};
	
	function pauseSearch () {
		ab = $("#searchDIV");
		setTimeout (" ab.hide();", 240);	
	};
	
	function endSearch () {
		use=false;
		$("input").val(defSearchStr);
		 $("#searchDIV").html("");
		 $("#deleteDIV").hide();
	}

	function Search (query) {
			if (query.length > 0) {
				 $("#deleteDIV").show();
			};
			if (query.length > 2) {
				 $("#searchDIV").show();
				$.get("/ajax/autocomplete_search.php?q=" + query, function(data){
			  		 $("#searchDIV").html(data); 
					}); } else {
						 $("#searchDIV").html("");
					};
	}

	$("#query").focus(function (){
		startSearch();
	});

   	 $("#query").keyup(function (e) {
		switch (e.keyCode) {
			case 27:
			endSearch();
			$("input").val("");
			break;
			
			default:
			Search($("#query").val());
			break;
		}		
	
	 });
	
	 $("#deleteDIV").click(function(){
			endSearch();
	});

	$("input").blur( function () {
		pauseSearch();
		if ( $("input").val()=="" ) {
			endSearch();
			}
	});

		Init();

  });