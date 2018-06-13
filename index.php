<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en-US">

<head>

    <meta charset="utf-8">

    <meta name="author" content="Birsan Ioana">
    <meta name="author" content="Gensthaler Octavian">
    <meta name="author" content="Loghin L Alexandru">
    <meta name="author" content="Luca Alexandru Gean">
    <meta name="description" content="...">

    <!--  Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="images/fav-icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/fav-icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/fav-icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/fav-icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/fav-icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/fav-icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/fav-icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/fav-icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/fav-icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="images/fav-icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/fav-icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="images/fav-icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/fav-icon/favicon-16x16.png">
    <link rel="manifest" href="images/fav-icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="images/fav-icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,900" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/topics.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/article.css">
    <link rel="stylesheet" href="css/books.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/videos.css">
    <link rel="stylesheet" href="css/presentations.css">
    <link rel="stylesheet" href="css/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="js/index.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/slider.js"></script>
    <script src="js/books.js"></script>
    <script src="js/articles.js"></script>
    <script src="js/videos.js"></script>
    <script src="js/utils.js"></script>

    <title>TReX</title>

</head>

<body>
    <?php
        if(isset($_SESSION['notification']) && isset($_SESSION['notification_type'])) {
            echo "<div onClick='this.remove()' class='notification notification-".$_SESSION['notification_type']."'>".$_SESSION['notification']."</div>";
            unset($_SESSION['notification']);
            unset($_SESSION['notification_type']);
        }
    ?>

    <!-- start Ioana Birsan -->
    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <nav id="menu">
            <div id="option-home" class="menu-option selected-menu-option" onClick="showPage('home'); selectCurrentMenuItem(this);">
                <p>Home</p>
                <i class="fa fa-home"></i>
            </div>
            <div id="option-books" class="menu-option" onClick="showPage('books'); selectCurrentMenuItem(this);">
                <p>Books</p>
                <i class="fa fa-book"></i>
            </div>
            <div id="option-articles" class="menu-option" onClick="showPage('articles'); selectCurrentMenuItem(this); fixArticleHeight();">
                <p>Articles</p>
                <i class="fa fa-newspaper-o"></i>
            </div>
            <div id="option-videos" class="menu-option" onClick="showPage('videos'); selectCurrentMenuItem(this);">
                <p>Videos</p>
                <i class="fa fa-camera"></i>
            </div>
        </nav>
    <?php endif; ?>
    <!-- end Ioana Birsan -->

    <!-- start Octavian Gensthaler -->
    <div class="header">
        <div class="logo">
            <h2>TReX</h2>
            <p>Topic-based Resource eXplorer.</p>
        </div>

        <div class="user-menu">
            <?php if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false): ?>
                <div class="menu-item" onclick="showPage('register')"><i class="fa fa-edit"></i> Register</div>
                <div class="menu-item" onclick="showPage('login')"><i class="fa fa-key"></i>Login</div>
            <?php else: ?>
                <div class="menu-item"><a href="php/logout.php"><i class="fa fa-door"></i> Log-out</a></div>
            <?php endif; ?>
        </div>

        <div class="nav-menu">
            <div class="menu-item"><a href="#">Home</a></div>
            <div class="menu-item"><a href="#">Echipa noastra</a></div>
            <div class="menu-item"><a href="#">Despre proiect</a></div>
            <div class="menu-item"><a href="#">Contact</a></div>
            <div class="menu-item"><a href="#"><i class="fa fa-search"></i></a></div>
        </div>
    </div>
    <!-- end Octavian Gensthaler -->

    <div id="login" class="page">
        <form class="login-form user-form" action="php/form_actions/login_submit.php" method="post">
            <formgroup>
                <input type="text" name="email" placeholder="E-mail address" />
            </formgroup>
            <formgroup>
                <input type="password" name="password" placeholder="Password" />
            </formgroup>
            <formgroup>
                <input type="submit" class="submit-button"></input>
            </formgroup>
        </form>
    </div>

    <div id="register" class="page">
        <form class="login-form user-form" action="php/form_actions/register_submit.php" method="post">
            <formgroup>
                <input type="text" name="firstName" placeholder="First name" />
            </formgroup>
            <formgroup>
                <input type="text" name="lastName" placeholder="Last name" />
            </formgroup>
            <formgroup>
                <input type="password" name="password" placeholder="Password" />
            </formgroup>
            <formgroup>
                <input type="password" name="passwordRepeat" placeholder="Repeat password" />
            </formgroup>
            <formgroup>
                <input type="text" name="email" placeholder="E-Mail" />
            </formgroup>
            <formgroup>
                <input type="submit" class="submit-button"></input>
            </formgroup>
        </form>
    </div>

    <div id="home" class="page">

        <!-- start Ioana Birsan -->
        <div id="slider">
            <figure>
                <div class="slide" data-source="images/slider/slide1.jpg"></div>
                <div class="slide" data-source="images/slider/slide2.jpg"></div>
                <div class="slide" data-source="images/slider/slide1.jpg"></div>
                <div class="slide" data-source="images/slider/slide3.jpg"></div>
                <div class="slide" data-source="images/slider/slide1.jpg"></div>
            </figure>
        </div>
        <!-- end Ioana Birsan -->

        <!-- start Loghin Alexandru  -->
        <div id="topics">
            <div id="topics-tag-row">
                <div class="tag">
                    <p>POO</p>
                </div>
                <div class="tag">
                    <p>Java</p>
                </div>
                <div class="tag">
                    <p>Matematica</p>
                </div>
                <div class="tag">
                    <p>LFAC</p>
                </div>
                <div class="tag">
                    <p>Retele</p>
                </div>
                <div class="tag">
                    <p>Logica</p>
                </div>
                <div class="tag">
                    <p>Web</p>
                </div>
            </div>

            <div id="topics-grid">
                <div id="topics-grid-title">
                    <h2>Advanced Programming</h2>
                    <button type="button" onclick="alert('Hi')">View all</button>
                </div>
                <div id="topics-grid-container">
                    <div class="col">
                        <img src="images/topics/topic1.jpg" alt="Random unsplash">
                        <p>Java Course 1</p>
                        <ul>
                            <li>
                                <div class="clock-h9m0 icon"></div>
                                <p>1 year</p>
                            </li>
                            <li>
                                <div class="profile icon"></div>
                                <p>Bahar Du</p>
                            </li>
                            <li>
                                <div class="tag icon"></div>
                                <p>License</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <img src="images/topics/topic2.jpg" alt="Random unsplash">
                        <p>Java Course 2</p>
                        <ul>
                            <li>
                                <div class="clock-h9m0 icon"></div>
                                <p>2 years</p>
                            </li>
                            <li>
                                <div class="profile icon"></div>
                                <p>A. Viorica</p>
                            </li>
                            <li>
                                <div class="tag icon"></div>
                                <p>Master</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <img src="images/topics/topic3.jpg" alt="Random unsplash">
                        <p>Java Course 3</p>
                        <ul>
                            <li>
                                <div class="clock-h9m0 icon"></div>
                                <p>3 months</p>
                            </li>
                            <li>
                                <div class="profile icon"></div>
                                <p>Sanda Iulia</p>
                            </li>
                            <li>
                                <div class="tag icon"></div>
                                <p>License</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <img src="images/topics/topic4.jpg" alt="Random unsplash">
                        <p>Java Course 4</p>
                        <ul>
                            <li>
                                <div class="clock-h9m0 icon"></div>
                                <p>1 year</p>
                            </li>
                            <li>
                                <div class="profile icon"></div>
                                <p>M. Manuela</p>
                            </li>
                            <li>
                                <div class="tag icon"></div>
                                <p>Master</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <img src="images/topics/topic5.jpg" alt="Random unsplash">
                        <p>Java Course 5</p>
                        <ul>
                            <li>
                                <div class="clock-h9m0 icon"></div>
                                <p>1 years</p>
                            </li>
                            <li>
                                <div class="profile icon"></div>
                                <p>C. Daniela</p>
                            </li>
                            <li>
                                <div class="tag icon"></div>
                                <p>Master</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <img src="images/topics/topic6.jpg" alt="Random unsplash">
                        <p>Java Course 6</p>
                        <ul>
                            <li>
                                <div class="clock-h9m0 icon"></div>
                                <p>1 month</p>
                            </li>
                            <li>
                                <div class="profile icon"></div>
                                <p>S. Angelica</p>
                            </li>
                            <li>
                                <div class="tag icon"></div>
                                <p>License</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Loghin Alexandru  -->
    </div>


    <!-- start Ioana Birsan  -->
    <div id="books" class="page">

        <form id="search-filter">
            <div id="search-bar">
                <input type="search" id="search-books" name="search-books">
                <div id="search-button" onclick="searchBooks();">
                    <img id="search-button-image" src="images/pages/books/search.svg" alt="Search button">
                </div>
            </div>

            <div id="search-fields">
                <div id="year" class="search-field">
                    <!-- <p>Year</p> -->
                    <label>Year:</label>
                    <div>
                        <input type="number" id="from" name="from" placeholder="From">
                        <input type="number" id="to" name="to" placeholder="To">
                    </div>
                </div>

                <div id="rating" class="search-field">
                    <!-- <p>Minimum rating</p> -->
                    <label for='simple-rating-select'>Minimum rating:</label>
                    <select id="simple-rating-select" name="simple-rating-select">
                      <option value="0" selected>Any</option>
                      <option value="5">⭐⭐⭐⭐⭐</option>
                      <option value="4">⭐⭐⭐⭐</option>
                      <option value="3">⭐⭐⭐</option>
                      <option value="2">⭐⭐</option>
                      <option value="1">⭐</option>
                </select>
                </div>

                <div id="language" class="search-field">
                    <label>Language:</label>
                    <select id="simple-language-select" name="simple-language-select">
                    <option value="any" selected>Any</option>
                    <option value="en">English</option>
                    <option value="fr">French</option>
                    <option value="ro">Romanian</option>
                </select>
                </div>

                <div id="display-format" class="search-field">
                    <label>Display type:</label>
                    <div>
                        <img class="display-type-option selected-display-type" src="images/pages/books/list.svg" onClick="selectCurrentDisplayType(this, 'list-view' , 'grid-view');" alt="List view">
                        <img class="display-type-option" src="images/pages/books/grid.svg" onClick="selectCurrentDisplayType(this, 'grid-view', 'list-view');" alt="Grid view">
                    </div>
                </div>
            </div>
        </form>

        <div id="display-results">

            <!-- DO NOT DELETE KEEP IT IN ORDER TO DOCUMENT THE STRUCTURE OF THE DISPLAYED INFORMATION -->
            <!-- <div class="resource list-view">
                <div class="book-image">
                    <a href="https://books.google.ro/books?id=bzp-BAAAQBAJ&dq=java+programming&source=gbs_navlinks_s" target="_blank">
                        <img src="https://books.google.ro/books/content?id=j5RTCwAAQBAJ&printsec=frontcover&img=1&zoom=1&imgtk=AFLRE73QnJIRAse5wItUcarKtzJYBYIJvSXkKItiz5XrLL5pVmgTw4w9NBxWywFbSxjHeFNtARjFrOUWKkR-p0F3jqwuU0A-tX3dzs-p89iXPMgQ1_vhIH_EFyuhR9qeckaEpQfcX0mY" alt="Book cover image">
                    </a>
                </div>
                <div class="book-info">
                    <div class="book-title">Java Programming</div>
                    <div class="book-authors">Joyce Farrell</div>
                    <div class="book-year">Jan 20, 2015</div>
                    <div class="book-rating">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
                <div class="book-description">Introduce your beginning programmers to the power of Java for developing applications with the engaging, hands-on approach in Farrell's JAVA PROGRAMMING, 8E. With this text, even first-time programmers can quickly develop useful programs while learning the basic principles of structured and object-oriented programming.</div>
            </div> -->

        </div>

        <button id="more-books-button" type="button" onclick="searchBooksToAppend();">See more</button>

    </div>
    <!-- end Ioana Birsan  -->


    <!-- start Loghin Alexandru  -->
    <div id="articles" class="page">
        <div id="aSearchForm">
            <div>
                <label>Sort By:</label>
                <select id="article-sortBy-select" name="article-sortBy-select">
                    <option value="relevance">Most Relevance</option>
                    <option value="lastUpdatedDate" selected>Last Updated</option>
                    <option value="submittedDate">Submitted Date</option>
                </select>
            </div>
            <div>
                <label>Sort Order:</label>
                <select id="article-sortOrder-select" name="article-sortOrder-select">
                    <option value="ascending" selected>Ascending</option>
                    <option value="descending">Descending</option>
                </select>
            </div>
            <fieldset>
                <input id="search-bar-articles" type="search" name="search-bar" placeholder="Search an article..." onclick="this.select()">
                <div class="fix-search-area" onclick="getDefaultRSS('newFeed');">
                    <img class="search_btn" src="images/article/search_btn.svg" alt="Search button">
                </div>
            </fieldset>
            <div class="article-display-type">
              <div class="fix-search-area absolute-left" onclick="selectArticleDisplayType('list-view')">
                <img class="view_btn" src="images/article/listview_inactive.svg" alt="Listview Button">
              </div>
              <div class="fix-search-area absolute-right" onclick="selectArticleDisplayType('grid-view')">
                <img class="view_btn" src="images/article/gridview_active.svg" alt="Gridview Button">
              </div>
            </div>
        </div>
        <section>
             <div id="display-art-results">
              <!--<li class="articleNo" style="max-height: 384px;">
                <a href="https://dev.to/howtocodejs/control-flow-the-beginners-guide-3mp9" target="_blank">
                  <img src="https://res.cloudinary.com/i/j7bp97fz7u35xzqydjaw.jpg" style="width: 100%; float: none;">
                  <div class="articlePostInfo">
                    <h3 style="padding-right: inherit; padding-left: inherit;">Control Flow: The Beginner's Guide</h3>
                    <p style="display: none; text-align: justify;">2018-05-26 17:22:27</p>
                    <h4>HowToCodejs</h4>
                  </div>
                </a>
              </li>  -->

              <!-- 404 -->
              <!-- <div class="notFound404">
                <div>
                  <h1>404</h1>
                  <h3>page not found</h3>
                </div>
                <div class="container404">
                  <div class="ghost-copy">
                    <div class="one"></div>
                    <div class="two"></div>
                    <div class="three"></div>
                    <div class="four"></div>
                  </div>
                  <div class="ghost">
                    <div class="face">
                      <div class="eye"></div>
                      <div class="eye-right"></div>
                      <div class="mouth"></div>
                    </div>
                  </div>
                  <div class="shadow"></div>
                </div>
              </div> -->
            </div>
            <button class="feed-button" type="button" onclick="getDefaultRSS();" style="display: none;">Get me more</button>
        </section>
    </div>
    <!-- end Loghin Alexandru  -->

    <!-- start Luca Alexandru  -->
    <div id="videos" class="page">
        <div id="VideoSearch">
            <!-- <select>
                <option selected>Design</option>
                <option>AJAX</option>
                <option>Algorithm</option>
                <option>BACK END</option>
                <option>FRONT END</option>
                <option>HTML/CSS</option>
                <option>Java</option>
                <option>JavaScript</option>
                <option>jQuery</option>
                <option>MySQL</option>
                <option>OOP</option>
                <option>PHP</option>
                <option>Python</option>
                <option>Ruby</option>
                <option>XML</option>
            </select> -->
            <fieldset>
                <input type="text" id="search-videos">
                <div class="VideoSearch" onclick="searchVideos()"></div>
            </fieldset>
        </div>
        <section>
            <div id="video-list">
                <!-- <div class="video">
                    <div class="gif under">
                        <a href="https://www.youtube.com/embed/WPvGqX-TXP0" target="_blank"><img src="images/videos/java.gif" alt="Java_Tutorial" class="videogif"></a>
                        <h5 class="timercolor">34:29</h5>
                    </div>
                    <div class="infovideo">
                        <h5 class="h5video"><a href="https://www.youtube.com/embed/WPvGqX-TXP0" target="_blank">Java</a></h5>
                        <p class="pvideo">Java is a programming language. There are ...</p>
                    </div>
                </div> -->
                <h1>SALUTARE COPIIIIII MEI</h1>
            </div>

            <button id="more-videos" class="feed-button" type="button">Get me more</button>
        </section>
    </div>

   <!--<script>
        window.onload = function() {
            displayDefaultVideoGrid();
        }
    </script>*/ -->
    <!-- end Luca Alexandru  -->

    <!-- start Loghin Alexandru -->
    <footer id="main-footer">
        <div>
            <div class="logo">
                <h2>TReX</h2>
                <p>Topic-based Resource eXplorer.</p>
            </div>
            <div id="footer-list">
                <ul>
                    <li>About us</li>
                    <li>Romania</li>
                    <li>Iasi</li>
                    <li>UAIC Informatica</li>
                </ul>
                <ul>
                    <li>Get in Touch</li>
                    <li>facebook</li>
                    <li>instagram</li>
                    <li>twitter</li>
                    <li>email</li>
                </ul>
                <ul>
                    <li>Team members</li>
                    <li><a href="https://github.com/ioanabirsan">Birsan Ioana</a></li>
                    <li><a href="https://github.com/G-Octav">Gensthaler Octavian</a></li>
                    <li><a href="https://github.com/logalex96">Loghin L Alexandru</a></li>
                    <li><a href="https://github.com/alexluca97">Luca Alexandru Gean</a></li>
                </ul>
            </div>

            <p id="footer-copy">&copy; 2018 TReX. All rights reserved.</p>
        </div>
    </footer>
    <!-- end Loghin Alexandru  -->

    <!-- https://stackoverflow.com/questions/3880307/trigger-event-on-body-load-complete-js-jquery -->
    <script type='text/javascript'>
     	showPage('home');
    	setSlidesBackground();
    	registerBooksEventHandlers();
    	registerArticlesEventHandlers();
        registerVideoEventHandlers();
        getDefaultRSS();
        displayDefaultVideoGrid();
    </script>

</body>

</html>
