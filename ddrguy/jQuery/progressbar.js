function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	var file = _("music").files[0];
	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("music", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "addmusic_parser.php");
	ajax.send(formdata);
}
function progressHandler(event){
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("progress_status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
	_("progress_status").innerHTML = event.target.responseText;
	_("progressBar").value = 0;
}
function errorHandler(event){
	_("progress_status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("progress_status").innerHTML = "Upload Aborted";
}