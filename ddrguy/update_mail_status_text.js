(function UpdateMailStatusText() {
  $.ajax({
	cache: false,
    url: 'update_mail_status_text.php', 
    success: function(data) {
      $('#result').html(data);
	  /*var sound = new Audio('./yougotmail.mp3');
	  sound.play();
	  sound.stop();*/
	  //document.getElementById('result').innerHTML = "";
	  /*setInterval(function(){
		  $('#result').fadeOut('slow');
	  }, 7000);*/
	   
    },
	
    complete: function() {
      // Schedule the next request when the current one's complete
	  
      setTimeout(UpdateMailStatusText, 5000); // Update the page every 5 seconds
											  // to load new content.
	  
    }
  });
})();

