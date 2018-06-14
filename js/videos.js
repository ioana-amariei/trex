itemsPerPage = 12;
defaultItemsPerPage = 12;

function displayVideos(){
    var videoListDiv = document.getElementById('video-list');

    videoListDiv.innerHTML = "";

    if(this.status !== 200) {
        alert(this.response.message);
        return;
    }

    var videos = this.response.videos;
    
    if(videos.length>0)
    {
        var deleteInitialImage = document.getElementById('initialImage');
        deleteInitialImage.parentNode.removeChild(deleteInitialImage);
        var deleteInitialMessage = document.getElementById('initialMessage');
        deleteInitialMessage.parentNode.removeChild(deleteInitialMessage);
    }
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
        for(let i = 0; i < videos.length; i++)
        {
            var title = videos[i].title;
            var thumbnail = videos[i].image;
            var videoLink = videos[i].url;
            var description = videos[i].description;

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

            a.appendChild(img);

            gifDiv.appendChild(a);

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
}

function constructVideoRequest(){
    return "http://localhost/trex/api/videos?&termen=" + constructQueryParamVideos();
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
