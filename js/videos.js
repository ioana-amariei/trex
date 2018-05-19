function displayDefaultVideoGrid(){
    executeGetRequest("php/view/videos.php", displayVideos);
}

function displayVideos(){
    var videoListDiv = document.getElementById('video-list');

    // Handle error cases.
    if(this.status !== 200) {
        alert(this.response.message);
        return;
    }

    // clearCurrentlyDisplayedBooks();
    var videos = JSON.parse(this.response);

    for(let i = 0; i < videos.data.length; i++) {
        var title = videos.data[i].name;
        var thumbnail = videos.data[i].pictures.sizes[3].link;
        var videoLink = videos.data[i].link;
        var description = videos.data[i].description;
        var timeInSeconds = videos.data[i].duration;

        var videoDiv = document.createElement("div");
        videoDiv.classList.add('video');

        var gifDiv = document.createElement("div");
        gifDiv.classList.add('gif');
        gifDiv.classList.add('under');
        var a = document.createElement("a");
        a.href = videoLink;
        a.target = "_blank";

        var img = document.createElement("img");
        img.src = thumbnail;

        var h5Time = document.createElement("h5");
        h5Time.classList.add("timercolor");

        a.appendChild(img);
        h5Time.appendChild(document.createTextNode(timeInSeconds));
        
        gifDiv.appendChild(a);
        gifDiv.appendChild(h5Time);

        videoDiv.appendChild(gifDiv); 

        var infoDiv = document.createElement("div");
        infoDiv.classList.add('infovideo');
        
        var h5 = document.createElement("h5");
        h5.appendChild(document.createTextNode(title));
        h5.classList.add("h5video");

        infoDiv.appendChild(h5);
        
        var p = document.createElement("p");
        p.classList.add("pvideo");

        if(description !== null)
            p.appendChild(document.createTextNode(description.substr(0,50)));

        infoDiv.appendChild(p);
        videoDiv.appendChild(infoDiv);

        videoListDiv.appendChild(videoDiv);
    }
}
