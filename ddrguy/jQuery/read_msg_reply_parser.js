function reply() {
	
	var replyBox = $('#reply_box').val();
	
	if(replyBox != ""){
		// Add Ajax code here...

	var frm = $('#frmreply');
    
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
				document.getElementById("reply_box").value = "";
				$('#error_reply_msg').html('');
                $("div#pre_load_msg").html(data);
            }
        });
    
		
	}else{
		$('#error_reply_msg').html('Please enter a message.');
	}
}