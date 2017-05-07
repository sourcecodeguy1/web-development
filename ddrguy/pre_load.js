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
      //$('#result').html(data);
	  //("#result").html(data).load(url);
	  
    },
    complete: function() {
      // Schedule the next request when the current one's complete
      setTimeout(PreLoad, 5000);
    }
  });
})();

/*var msgid = getUrlVars()["msgid"];
	
	function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	vars[key] = value;
	});
	return vars;
	}
	
    $.ajax({
            url: 'pre_load.php',
            type: 'GET',   //change type to POST rather than GET because this POST method of sending data
            data: {msgid:msgid},
            success: function(data) {
                 //called when successful
                 $('#pre_load_msg').html(data);
                 //alert(msgid);
            },
            error: function(e) {
                 //called when there is an error
                 console.log(e.message);
                 alert("failed");
            }
    });*/