function speak(text){
    var msg = new SpeechSynthesisUtterance(text);
    window.speechSynthesis.cancel();
    window.speechSynthesis.speak(msg);
}

function executeGetRequest(uri, callbackMethod){
    var request = new XMLHttpRequest();
    request.open("GET", uri);
    request.responseType = 'json';
    request.addEventListener("load", callbackMethod);
    request.send();
}

function getRequest(uri, refreshCallback, newReq) {
    var req = new XMLHttpRequest();
    req.open("GET", uri, true);

    if (typeof(req) === "object") {
        req.responseType = 'json';
    } else {
        req.responseType = '';
    }

    req.onload = function () {
        if (req.readyState === req.DONE) {
            if (req.status === 200) {
                refreshCallback(this, newReq);
            } else
                alert(req.response.message);
        }
    };

    req.send(null);
}
