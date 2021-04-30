var mess = "";
var count = 0;

function GetFileInfo() {
    var fileInput = document.getElementById("inputFile");
    var message = "";
    if ('files' in fileInput) {
        if (fileInput.files.length == 0) {
            message = "Please browse for one or more files.";
        } else {
            for (var i = 0; i < fileInput.files.length; i++) {
                count = count + 1;
                message += "<br /><b>File" + count + "</b><br />";
                var file = fileInput.files[i];
                if ('name' in file) {
                    message += "Name of file: " + file.name + "<br />";
                } else {
                    message += "Name of file: " + file.fileName + "<br />";
                }
                if ('size' in file) {
                    message += "Size of file: " + file.size + " bytes <br />";
                } else {
                    message += "Size of file: " + file.fileSize + " bytes <br />";
                }
                if ('mediaType' in file) {
                    message += "Type: " + file.mediaType + "<br />";
                }
            }
        }
    } else {
        if (fileInput.value == "") {
            message += "Please browse for one or more files!";
            message += "<br />Use the Control or Shift key for multiple selection.";
        } else {
            message += "Your browser doesn't support the files property!";
            message += "<br />The path of the selected file: " + fileInput.value;
        }
    }
    mess = mess + message;
    var info = document.getElementById("info");
    info.innerHTML = mess;

}