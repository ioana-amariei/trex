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
