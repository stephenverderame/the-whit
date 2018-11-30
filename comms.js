/** 
 * Sets innerHTML of element to file list received by the server
 * @param conatiner, element id of the element which you want to set innerHTML to the list of articles [string]
 * @return void
*/
function getArticleList(container, destination="fileList.php") {
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', function(e){
        document.getElementById(container).innerHTML = this.response;
    });
    xhr.open("POST", destination, true);
    xhr.send();
}
/** 
* Sends form to server. Does no file size checking or form completion checking
* @param formName, id of form a[s a string] to send
* @param progressName, id of progress bar [string]
* @param outputName, element id that innerHTML is set to on response
* @param location, where to send the form to [string]. Default parameter of upload.php
* @return void
*/
function uploadForm(formName, progressName, outputName, location="upload.php") {
    var form = document.getElementById(formName);
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', function(e) {
        document.getElementById(outputName).innerHTML = this.response;
        document.getElementById(progressName).style.display= "none";
        document.getElementById(progressName).value = 0;
        document.getElementById(progressName).max = 100;
        document.getElementById(formName).reset();
    });
    xhr.upload.addEventListener('progress', function(e) {
        document.getElementById(progressName).value = e.loaded;
        document.getElementById(progressName).max = e.total;
    });
    var fd = new FormData(document.getElementById(formName));
    xhr.open("POST", location, true);
    document.getElementById(progressName).style = "display:block";
    xhr.send(fd);
}
/**
* Checks if password is correct upload password. Then uploads the form
* @param password, [string] password
* @return void
* @see uploadForm this is called inside this function
*/
function checkPasswordUpload(password, formName, progressName, outputName, location="upload.php") {
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', function(e){
        if(this.response == "true"){
            uploadForm(formName, progressName, outputName, location);
        }else{
            document.getElementById(outputName).innerHTML = "Incorrect password!";
        }
    });
    xhr.open("POST", "pass.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("pass=" + password);
}
/** 
* Views specefied video or saved file on server
* @param path, [string] path of file to fetch
*/
function viewVid(name) {
    var form = document.createElement('form');
    form.method = 'post';
    form.enctype = "multipart/form-data";
    form.style = "display:none";
    form.action = "vid.php";
    var input = document.createElement('input');
    input.type = "text";
    input.name = "name";
    input.value = name;
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();

}
/**
* @see viewVid
* same as viewVid except also passes the input named "frame" to signify that vid.php should display an iframe instead of a video
*/
function viewFrame(name) {
    var form = document.createElement('form');
    form.method = 'post';
    form.enctype = 'multipart/form-data';
    form.style = 'display:none';
    form.action = 'vid.php';
    var input = document.createElement('input');
    input.type = "text";
    input.name = "name";
    input.value = name;
    var finput = document.createElement('input');
    finput.type = "text";
    finput.name = "frame";
    finput.value = "placeholder";
    form.appendChild(input);
    form.appendChild(finput);
    document.body.appendChild(form);
    form.submit();
}
/** 
 * returns list of all artists
 * @param tableId, id of table to set data
 * @return void
*/
function getArtistList(tableId){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', function(e){
        document.getElementById(tableId).innerHTML = xhr.response;
    });
    xhr.open("POST", "artistList.php");
    xhr.send();
}