function showPage(selectedPage){
	var pages = document.getElementsByClassName("page");

	var index;
	for(index = 0; index < pages.length; index++){
		var page = pages[index];
		page.style.display = 'none';
	}

	var pageToShow = document.getElementById(selectedPage);
	pageToShow.style.display = 'block';

    if(selectedPage == 'home')
        document.getElementsByClassName("header")[0].style.position = "absolute";
    else
        document.getElementsByClassName("header")[0].style.position = "relative";
}
