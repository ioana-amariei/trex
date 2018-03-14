function showPage(selectedPage){
	var pages = ['home', 'books', 'articles', 'videos', 'presentations'];

	var index;
	for(index = 0; index < pages.length; index++){
		var pageID = pages[index];
		var element = document.getElementById(pageID);
		element.style.display = 'none';
	}

	var elementToShow = document.getElementById(selectedPage);
	elementToShow.style.display = 'block';
}