/** 
 * Sets innerHTML of element to file list received by the server
 * @param conatiner, element id of the element which you want to set innerHTML to the list of articles [string]
 * @return void
*/
function getArticleList(container) {
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', function(e){
        document.getElementById(container).innerHTML = this.response;
    });
    xhr.open("POST", "fileList.php", true);
    xhr.send();
}
/** 
* Sends form to server. Does no file size checking or form completion checking
* @param formName, id of form a[s a string] to send
* @param progressName, id of progress bar [string]
* @param outputName, element id that innerHTML is set to on response
* @return void
*/
function uploadForm(formName, progressName, outputName) {
    var form = document.getElementById(formName);
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', function(e) {
        document.getElementById(outputName).innerHTML = this.response;
        document.getElementById(progressName).style.display= "none";
        document.getElementById(progressName).value = 0;
        document.getElementById(progressName).max = 100;
    });
    xhr.upload.addEventListener('progress', function(e) {
        document.getElementById(progressName).value = e.loaded;
        document.getElementById(progressName).max = e.total;
    });
    var fd = new FormData(document.getElementById(formName));
    xhr.open("POST", "upload.php", true);
    document.getElementById(progressName).style = "display:block";
    xhr.send(fd);
}
/**
* Checks if password is correct upload password. Then uploads the form
* @param password, [string] password
* @return void
* @see uploadForm this is called inside this function
*/
function checkPasswordUpload(password, formName, progressName, outputName) {
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', function(e){
        if(this.response == "true"){
            uploadForm(formName, progressName, outputName);
        }else{
            document.getElementById(outputName).innerHTML = "Incorrect password!";
        }
    });
    xhr.open("POST", "pass.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("pass=" + password);
}