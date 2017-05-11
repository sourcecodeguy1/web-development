(function PreLoad() {
	
	var msgid = getUrlVars()["msgid"]; // pre_load.php will pick up this GET variable.
	
	function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	vars[key] = value;
	});
	return vars;
	}
	
  $.ajax({
	cache: false,
    url: 'pre_load.php',
    type: 'GET',
	data: {msgid:msgid},
    success: function(data) {
      $('#pre_load_msg').html(data);
	  
    },
    complete: function() {
      // Schedule the next request when the current one's complete
      setTimeout(PreLoad, 5000);
    }
  });
})();
