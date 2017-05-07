(function UpdateMail() {
  $.ajax({
	cache: false,
    url: 'update_mail.php', 
    success: function(data) {
      $('#msg').html(data);
      //$('#result').html(data);
	  //("#result").html(data).load(url);
    },
    complete: function() {
      // Schedule the next request when the current one's complete
      setTimeout(UpdateMail, 5000);
    }
  });
})();