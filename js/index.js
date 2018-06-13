function showPage(selectedPage){
	var pages = document.getElementsByClassName("page");

	for(var index = 0; index < pages.length; index++){
		pages[index].style.display = 'none';
	}

	var pageToShow = document.getElementById(selectedPage);
	pageToShow.style.display = 'block';

    if(selectedPage === 'home') {
        document.getElementsByClassName("header")[0].classList.remove("header-relative");
    } else {
        document.getElementsByClassName("header")[0].classList.add("header-relative");
	}
}

function setSlidesBackground() {
	var slides = document.getElementsByClassName("slide");

	for(var i = 0; i < slides.length; i++) {
		slides.item(i).style.background = "url("+slides.item(i).getAttribute("data-source")+")";
	}
}

function displayDefaultRandomVideos() {
	executeGetRequest("/trex/api/videos?per_page=25&termen=java", showRandomVideosInDiv);
	executeGetRequest("/trex/api/videos?per_page=25&termen=scrum", showRandomVideosInDiv);
	executeGetRequest("/trex/api/videos?per_page=25&termen=C++", showRandomVideosInDiv);
	executeGetRequest("/trex/api/videos?per_page=25&termen=javascript", showRandomVideosInDiv);
	executeGetRequest("/trex/api/videos?per_page=25&termen=angular", showRandomVideosInDiv);
	executeGetRequest("/trex/api/videos?per_page=25&termen=dotnet", showRandomVideosInDiv);
}

function showRandomVideosInDiv() {
	const associations = [
		{ elementId: "col1", searchTerm: "java" },
		{ elementId: "col2", searchTerm: "scrum" },
		{ elementId: "col3", searchTerm: "C++" },
		{ elementId: "col4", searchTerm: "typescript" },
		{ elementId: "col5", searchTerm: "angular" },
		{ elementId: "col6", searchTerm: "dotnet" },
	]

	if(this.status !== 200) {
        alert(this.response.message);
        return;
    }

	var videos = JSON.parse(this.response);
	var randomVideo = Math.floor(Math.random() * 25) + 1;
	var videoResult = videos.data[randomVideo];

	associations.forEach(element => {
		if (this.responseURL.includes(element.searchTerm)) {
			const elementDiv = document.getElementById(element.elementId);
			const thumbnail = elementDiv.querySelector('img');
			const title = elementDiv.querySelector('p:first-of-type');
			
			thumbnail.src = videoResult.pictures.sizes[3].link;
			title.innerHTML = videoResult.name.substr(1, 25);
		}
	});
}