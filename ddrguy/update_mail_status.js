(function UpdateMailStatus() {
  $.ajax({
	cache: false,
    url: 'update_mail_status.php', 
    success: function(data) {
      $('#span_message').html(data);
    },
    complete: function() {
      // Schedule the next request when the current one's complete
      setTimeout(UpdateMailStatus, 5000);
    }
  });
})();