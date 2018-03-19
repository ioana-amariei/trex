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
        document.getElementsByClassName("header")[0].classList.remove("header-relative");
    else
        document.getElementsByClassName("header")[0].classList.add("header-relative");
}


function transferCompleted(e) {
    alert(this.responseText);
}


function makeTestRequest() {
	var oReq = new XMLHttpRequest();
	oReq.addEventListener("load", transferCompleted, true);
//	oReq.open("GET", "http://localhost/TReX/tmp-test/books.php");
	//oReq.send();
}
