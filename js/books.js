/* Resources:
1. https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
2. https://developer.mozilla.org/en-US/docs/Web/API/Document/createElement
3. https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/Using_XMLHttpRequest
4. https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/open
5. https://developer.mozilla.org/en-US/docs/Learn/JavaScript/Objects/JSON
6. https://stackoverflow.com/questions/683366/remove-all-the-children-dom-elements-in-div/684013
7. https://stackoverflow.com/questions/15653145/using-google-text-to-speech-in-javascript
8. https://stackoverflow.com/questions/3007336/how-do-you-assign-a-javascript-onclick-attribute-dynamically
9. https://www.w3schools.com/howto/howto_js_trigger_button_enter.asp
10. https://developer.mozilla.org/en-US/docs/Web/API/GlobalEventHandlers/onkeydown
*/

var currentDisplayType = 'list-view';

function selectCurrentDisplayType(displayType, classToAdd, classToRemove) {
    currentDisplayType = classToAdd;

  var displayTypes = document.getElementsByClassName("selected-display-type");

  var index;
  for(index=0; index < displayTypes.length; index++){
    displayTypes[index].classList.remove("selected-display-type");
  }

  displayType.classList.add("selected-display-type");

  var resources = document.getElementsByClassName("resource");

  for(index=0; index < resources.length; index++){
    resources[index].classList.remove(classToRemove);
    resources[index].classList.add(classToAdd);
  }
}

function registerBooksEventHandlers() {
    var input = document.getElementById('search-books');

    input.addEventListener('keydown', function(event){
        handleEnterKeyForSearchBar(event);
    });
}

function handleEnterKeyForSearchBar(event){

    if(event.keyCode === 13){
        searchBooks();
    }
}

function searchBooks(){
    var uri = constructRequestUri();
    executeGetRequest(uri, displayBooks);
}

function constructRequestUri(){
    return "http://localhost/trex/api/books?" + constructQueryParamsSection();
}

function constructQueryParamsSection(){
    var searchTerms = document.getElementById('search-books').value;

    var ratingSelect = document.getElementById("simple-rating-select");
    var minimumRating = ratingSelect.options[ratingSelect.selectedIndex].value;

    var languageSelect = document.getElementById("simple-language-select");
    var language = languageSelect.options[languageSelect.selectedIndex].value;

    var fromYear = document.getElementById('from').value;
    var toYear = document.getElementById('to').value;

    var queryParams = "";
    queryParams = "terms=" + searchTerms;
    queryParams += "&minimumRating=" + minimumRating;
    queryParams += "&language=" + language;
    queryParams += "&from=" + fromYear;
    queryParams += "&to=" + toYear;

    return queryParams;
}

function clearCurrentlyDisplayedBooks(){
    var displayResults = document.getElementById('display-results');

    while (displayResults.hasChildNodes()) {
        displayResults.removeChild(displayResults.lastChild);
    }
}

function displayBooks(){
    // Handle error cases.
    if(this.status !== 200) {
        alert(this.response.message);
        return;
    }

    clearCurrentlyDisplayedBooks();
    var books = this.response.books;

    if(books.length === 0){
        var displayResults = document.getElementById('display-results');
        var noInfoAvailable = document.createElement('div');
        var text = document.createTextNode('There are no books that satisfy the search criteria.');
        noInfoAvailable.appendChild(text);
        displayResults.appendChild(noInfoAvailable);
    }

    for(var index = 0; index < books.length; index++){
        appendBookInfoToResultsArea(books[index]);
    }
}

function appendBookInfoToResultsArea(book){
    var displayResults = document.getElementById('display-results');
    var content =  createBookResourceDiv(book);
    displayResults.appendChild(content);
}


function createBookResourceDiv(book){
    var resourceDiv = document.createElement('div');
    resourceDiv.classList.add('resource', currentDisplayType);

    var bookImage = createBookImageDiv(book);
    resourceDiv.appendChild(bookImage);

    var bookInfo = createBookInfoDiv(book);
    resourceDiv.appendChild(bookInfo);

    var bookDescription = createBookDescriptionDiv(book);
    resourceDiv.appendChild(bookDescription);

    return resourceDiv;
}

function createBookInfoDiv(book){
    var bookInfo = document.createElement('div');
    bookInfo.classList.add('book-info');

    var bookTitle = createBookTitleDiv(book);
    bookInfo.appendChild(bookTitle);

    var bookAuthors = createBookAuthorsDiv(book);
    bookInfo.appendChild(bookAuthors);

    var bookYear = createBookYearDiv(book);
    bookInfo.appendChild(bookYear);

    var bookRating = createBookRatingDiv(book);
    bookInfo.appendChild(bookRating);

    if(book.tags.length > 0){
        var bookTags = createBookTagsDiv(book);
        bookInfo.appendChild(bookTags);
    }

    return bookInfo;
}

function createBookTitleDiv(book){
    var bookTitle = document.createElement('div');
    bookTitle.classList.add('book-title');

    var title = document.createTextNode(book.title);
    bookTitle.appendChild(title);

    return bookTitle;

}

function createBookAuthorsDiv(book){
    var bookAuthors = document.createElement('div');
    bookAuthors.classList.add('book-authors');

    if(book.authors.length > 2){
        book.authors[2] = 'et al.';
    }

    var authors = document.createTextNode(book.authors.join(', '));
    bookAuthors.appendChild(authors);

    return bookAuthors;
}

function createBookYearDiv(book){
    var bookYear = document.createElement('div');
    bookYear.classList.add('book-year');

    var year = document.createTextNode(book.date);
    bookYear.appendChild(year);

    return bookYear;
}

function createBookRatingDiv(book){
    var bookRating = document.createElement('div');
    bookRating.classList.add('book-rating');

    book.rating = Math.round(Number(book.rating));

    var index;
    for(index = 0; index < book.rating; index++){
        bookRating.appendChild(createCheckedStarSpan());
    }

    for(index = book.rating; index < 5; index++){
        bookRating.appendChild(createUncheckedStarSpan());
    }

    return bookRating;
}

function createCheckedStarSpan(){
    var star = document.createElement('span');
    star.classList.add('fa', 'fa-star', 'checked');

    return star;
}

function createUncheckedStarSpan(){
    var star = document.createElement('span');
    star.classList.add('fa', 'fa-star');

    return star;
}

function createBookTagsDiv(book){
    var bookTags = document.createElement('div');
    bookTags.classList.add('book-tags');

    var tags = document.createTextNode(book.tags.join('\n'));
    bookTags.appendChild(tags);

    return bookTags;
}

function createBookDescriptionDiv(book){
    var bookDescription = document.createElement('div');
    bookDescription.classList.add('book-description');

    var description = document.createTextNode(book.description);
    bookDescription.appendChild(description);

    bookDescription.onclick = function() { speak(book.description) };

    return bookDescription;
}

function createBookImageDiv(book){
    var bookImage = document.createElement('div');
    bookImage.classList.add('book-image');

    var link = document.createElement('a');
    link.href = book.url;
    link.target = "_blank";

    var image = document.createElement('img');
    image.src = book.image;
    image.alt = book.title;
    bookImage.appendChild(link).appendChild(image);

    return bookImage;
}
