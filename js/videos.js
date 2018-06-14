itemsPerPage = 12;
defaultItemsPerPage = 12;

function displayDefaultVideoGrid(){
    executeGetRequest("api/videos", displayVideos);
}

function displayVideos(){
    var videoListDiv = document.getElementById('video-list');

    videoListDiv.innerHTML = "";

    if(this.status !== 200) {
        alert(this.response.message);
        return;
    }

    var videos = this.response.videos;

    if( videos.error !== undefined )
    {
        var eroare = document.createElement("h5");
        eroare.innerText = "Eroare la search";
        videoListDiv.appendChild(eroare);
        var deleteGetMoreButton = document.getElementById('more-videos');
        deleteGetMoreButton.parentNode.removeChild(deleteGetMoreButton);
        var deleteInitialImage = document.getElementById('initialImage');
        deleteInitialImage.parentNode.removeChild(deleteInitialImage);
        var deleteInitialMessage = document.getElementById('initialMessage');
        deleteInitialMessage.parentNode.removeChild(deleteInitialMessage);
    }
    else
    {
        if(itemsPerPage+defaultItemsPerPage>100)
        {
            var deleteGetMoreButton = document.getElementById('more-videos');
            deleteGetMoreButton.parentNode.removeChild(deleteGetMoreButton);
        }
        for(let i = 0; i < videos.data.length; i++)
        {
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
                p.appendChild(document.createTextNode(description.substr(0,250)));

            infoDiv.appendChild(p);
            videoDiv.appendChild(infoDiv);

            videoListDiv.appendChild(videoDiv);
       }
    }
}

function SearchBarVideos(event){

    if(event.keyCode === 13){
        searchVideos();
    }
}

function searchVideos(){
    var uriv = constructVideoRequest();
    executeGetRequest(uriv, displayVideos);

        var deleteInitialImage = document.getElementById('initialImage');
        deleteInitialImage.parentNode.removeChild(deleteInitialImage);
        var deleteInitialMessage = document.getElementById('initialMessage');
        deleteInitialMessage.parentNode.removeChild(deleteInitialMessage);
}

function constructVideoRequest(){
    return "http://localhost/trex/api/videos?per_page="+ itemsPerPage +"&termen=" + constructQueryParamVideos();
}

function constructQueryParamVideos(){
    var searchTermsVideo = document.getElementById('search-videos').value;
    return searchTermsVideo;
}

function registerVideoEventHandlers() {
    var input = document.getElementById('search-videos');
    var btnMore = document.getElementById('more-videos');

    input.addEventListener('keydown', function (event) {
        handleEnterKeyForVideosSearchBar(event);
    });

    btnMore.addEventListener('click', function(event) {
        itemsPerPage += defaultItemsPerPage;
        searchVideos();
    });
}

function handleEnterKeyForVideosSearchBar(event) {
    if (event.keyCode === 13) {
         searchVideos();
    }
}
