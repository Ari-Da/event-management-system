$(function() {
	$('h5.card-title').hover(
	  function() {
	    $(this).parent().parent().addClass('shadow-lg');
	  }, function() {
	    $(this).parent().parent().removeClass('shadow-lg');
	  }
	);

	$("p.info").fadeTo(2000, 500).slideUp(500, function(){
	    $("p.info").slideUp(500);
	});
});
