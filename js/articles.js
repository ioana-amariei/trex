var getCurrentURL = window.location.href;

function getDefaultRSS() {
    var searchTermsBar = document.getElementById('search-bar-articles').value;
    var uri;
    if (searchTermsBar.trim() === "") {
        uri = 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fdev.to%2Ffeed%2F';
    }
    else {
        uri = getSearchUri();
    }
    executeGetRequest(uri, displayArticles);
}

function getSearchUri() {
    return getCurrentURL + "php/view/articles.php?" + getAllParams();
}

function getAllParams() {
    var searchTerms = document.getElementById('search-bar-articles').value;

    var orderBy = document.getElementById("article-sortBy-select");
    var orderBySelect = orderBy.options[orderBy.selectedIndex].value;

    var orderSort = document.getElementById("article-sortOrder-select");
    var orderSortSelect = orderSort.options[orderSort.selectedIndex].value;

    var Params = "";
    Params = "search_query=ti:\"" + searchTerms + "\"";
    Params += "&sortBy=" + orderBySelect;
    Params += "&sortOrder=" + orderSortSelect;

    return Params;
}

function displayArticles() {
    // Handle error cases.
    if (this.status !== 200) {
        alert(this.response.message);
        return;
    }

    var articles = this.response;

    var index;
    for (index = 0; index < 9; index++) {
        var article = articles['items'][index];
        appendArticleInfoToResultsArea(article);
    }
}

function appendArticleInfoToResultsArea(article) {
    var displayResults = document.getElementById('display-art-results');
    var content = createArticlesDiv(article);
    displayResults.appendChild(content);
}

function createArticlesDiv(article) {
    var resourceDiv = document.createElement('div');
    resourceDiv.classList.add('articleNo');

    createArticleImageDiv(article, resourceDiv);

    var articlePostInfo = createArticlePostInfo(article);
    resourceDiv.appendChild(articlePostInfo);

    return resourceDiv;
}

function createArticleImageDiv(article, resourceDiv) {

    var link = document.createElement('a');
    link.href = article.link;
    link.target = "_blank";

    var image = document.createElement('img');
    if (article.thumbnail == "") {
        image.src = "images/article/dn_bg.png";
    }
    else {
        image.src = article.thumbnail;
    }

    resourceDiv.appendChild(link).appendChild(image);
}

function createArticlePostInfo(article) {
    var info = document.createElement('div');
    info.classList.add('articlePostInfo');

    // add Article title
    var h3 = document.createElement("h3");
    var title = document.createTextNode(article.title);
    h3.appendChild(title);
    info.appendChild(h3);

    // add Article author
    var h4 = document.createElement("h4");
    var author = document.createTextNode(article.author);
    h4.appendChild(author);
    info.appendChild(h4);

    return info;
}
