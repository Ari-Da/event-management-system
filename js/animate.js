$(function() {
	$('h5.card-title').hover(
	  function() {
	    $(this).parent().parent().addClass('shadow-lg');
	  }, function() {
	    $(this).parent().parent().removeClass('shadow-lg');
	  }
	);

	$("div.info").fadeTo(1500, 500).slideUp(200, function(){
	    $("div.info").slideUp(500);
	});
});
