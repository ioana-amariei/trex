/*  Resources:
    1. https://www.rss2json.com/
    2. https://www.developer.mozilla.org/en-US/docs/Web/Guide/Parsing_and_serializing_XML
*/

// TODO: add infinity scroll button
// TODO: fix grid view reset
// TODO: fix enter input problem

var getCurrentURL = window.location.href;
var displayType = 'grid-view';
var feedStart = 0;
var feedNext = 0;

function getDefaultRSS(requestedFeed) {
    var newSearch = false;
    var searchTermsBar = document.getElementById('search-bar-articles').value;
    var uri;

    if(requestedFeed && (requestedFeed === "newFeed") ) {
      clearDisplayedArticles();
      helpMe("loading");
      newSearch = true;
      feedStart = 0;
      feedNext = 0;
    }

    if (searchTermsBar.trim() === "") {
        uri = 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fdev.to%2Ffeed&api_key=frsnzjk8uuwmikwogktkshmwqicpqs4sb7lg45m1';
        document.getElementsByClassName('feed-button')[0].style.display = "none";
    } else {
      feedStart = feedNext;
      feedNext += 15;
        uri = getSearchUri();
    }
    getRequest(uri, displayArticles, newSearch);
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

    Params = 'ti=\"' + searchTerms + '\"';
    Params += "&sortBy=" + orderBySelect;
    Params += "&sortOrder=" + orderSortSelect;
    Params += "&start=" + feedStart;
    Params += "&max_results=15";

    return Params;
}

function clearDisplayedArticles() {
    var displayResults = document.getElementById('display-art-results');
    while (displayResults.hasChildNodes()) {
        displayResults.removeChild(displayResults.lastChild);
    }
}

function displayArticles(reqRes, newReq) {
    if(newReq) clearDisplayedArticles();

    var articles = reqRes.response;
    var index;

    if(articles === null) {
      helpMe("404");
      return;
    }

    if (articles['items'] !== undefined) {
        for (index = 0; index < articles['items'].length; index++) {
            var article = articles['items'][index];
            appendArticleInfoToResultsArea(article);
        }
    } else {
        document.getElementsByClassName('feed-button')[0].style.display = "initial";
        for (index = 0; index < articles.articles.length; index++) {
            var article = articles.articles[index];
            appendArticleInfoToResultsArea(article);
        }
    }
    selectArticleDisplayType(displayType);
}

function appendArticleInfoToResultsArea(article) {
    var displayResults = document.getElementById('display-art-results');
    var content = createArticlesDiv(article);
    displayResults.appendChild(content);
}

function createArticlesDiv(article) {
    var resourceDiv = document.createElement('li');
    resourceDiv.classList.add('articleNo');

    createArticleImageDiv(article, resourceDiv);
    return resourceDiv;
}

function createArticleImageDiv(article, resourceDiv) {
    var link = document.createElement('a');
    if (article.link !== undefined)
        link.href = article.link;
    else
        link.href = article.url[1]["@attributes"]['href'];
    link.target = "_blank";

    var image = document.createElement('img');
    if ((article.thumbnail == "") || (article.thumbnail === undefined)) {
        image.src = "images/article/dn_bg.png";
    } else {
        image.src = article.thumbnail;
    }
    var articlePostInfo = createArticlePostInfo(article);
    resourceDiv.appendChild(link).appendChild(image);
    resourceDiv.appendChild(link).appendChild(articlePostInfo);
}

function createArticlePostInfo(article) {
    var info = document.createElement('div');
    info.classList.add('articlePostInfo');

    // add Article title
    var h3 = document.createElement("h3");
    var title = document.createTextNode(article.title);
    h3.appendChild(title);
    info.appendChild(h3);

    // add pubDate
    var p = document.createElement("p");
    if (article.pubDate !== undefined)
        var description = document.createTextNode(article.pubDate);
    else
        var description = document.createTextNode(article.description);
    p.appendChild(description);
    info.appendChild(p);

    // add Article author
    var h4 = document.createElement("h4");
    if(article.authors != undefined) {
      var author = document.createTextNode(article.authors);
    }
    else {
      var author = document.createTextNode(article.author);
    }
    h4.appendChild(author);
    info.appendChild(h4);

    return info;
}

function selectArticleDisplayType(displayTemp) {
    displayType = displayTemp;
    var article = document.getElementsByClassName("articleNo");
    var articleInfo = document.getElementsByClassName("articlePostInfo");

    if (displayType == 'list-view') {
        document.getElementById("display-art-results").style.gridTemplateColumns = "1fr";
        for (var index = 0; index < article.length; index++) {
            var itemArticleInfoHeight = article[index].querySelector("div").offsetHeight;
            article[index].querySelector("img").style.width = "370px";
            article[index].querySelector("img").style.float = "left";
            article[index].querySelector("p").style.display = "block";
            article[index].querySelector("p").style.textAlign = "inherit";
            article[index].querySelector("h3").style.paddingRight = "100px";
            article[index].querySelector("h3").style.paddingLeft = "460px";
            article[index].style.maxHeight = 298.11 + "px";
        }
    } else {
        document.getElementById("display-art-results").style.gridTemplateColumns = "repeat(3, 1fr)";
        for (var index = 0; index < article.length; index++) {
            var itemArticleInfoHeight = article[index].querySelector("div").offsetHeight;
            article[index].querySelector("img").style.width = "100%";
            article[index].querySelector("img").style.float = "none";
            article[index].querySelector("p").style.display = "none";
            article[index].querySelector("p").style.textAlign = "justify";
            article[index].querySelector("h3").style.paddingRight = "inherit";
            article[index].querySelector("h3").style.paddingLeft = "inherit";
            article[index].style.maxHeight = 384 + "px";
        }
    }
}

function helpMe(withThis) {
  var displayNotFound = document.getElementById('display-art-results');
  var image = document.createElement('img');
  switch (withThis) {
    case "404":
          image.src = "images/pages/404_not_found.gif";
          image.style.maxWidth = "100%";
          image.style.margin = "0 auto";
          break;
    case "loading":
          image.src = "images/pages/loading.gif";
          image.style.maxWidth = "100%";
          image.style.margin = "0 auto";
          image.style.padding = "50px 0";
          break;
    default:
          break;
  }
  displayNotFound.appendChild(image);
  var articlePage = document.getElementById("articles").querySelector("section");
  articlePage.style.backgroundColor = "white";
  articlePage.querySelector("div").style.backgroundColor = "white";
  articlePage.querySelector("div").style.gridTemplateColumns = "1fr";
}
