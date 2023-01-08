function copytext(copied) {
    "use strict";
    var copyText = document.getElementById("data");
    copyText.select();
    document.execCommand("copy");
    document.getElementById("tool").innerHTML = copied;
}