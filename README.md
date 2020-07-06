# Post App
A social network built upon my [PHP-MVC-FRAMEWORK](https://github.com/IslamAliMuhammad/PHP-MVC-FRAMEWORK) that allows authenticated user to show other users tweets and perform operations on his tweets.

## Getting Started

1. Open command line then navigate to `xampp\htdocs`.
2. Enter `git clone https://github.com/IslamAliMuhammad/POST-APP.git`.
3. Navigate to app/config folder then open config.php file then enter DB_PASS if found. 
4. Create a database with the name shareposts.
5. Import tweet SQL file inside the database which will create two tables (posts, users).
6. Enter `http://localhost/post/` into your browser.

![](https://github.com/IslamAliMuhammad/POST-APP/blob/master/screenshot.PNG)

### Files structure 

- __posts__
   - [README.md](README.md)
   - __app__
     - [bootstrap.php](app/bootstrap.php)
     - __config__
       - [config.php](app/config/config.php)
     - __controllers__
       - [Pages.php](app/controllers/Pages.php)
       - [Posts.php](app/controllers/Posts.php)
       - [Users.php](app/controllers/Users.php)
     - __helpers__
       - [session\_helper.php](app/helpers/session_helper.php)
       - [url\_helper.php](app/helpers/url_helper.php)
     - __libraries__
       - [Controller.php](app/libraries/Controller.php)
       - [Core.php](app/libraries/Core.php)
       - [Database.php](app/libraries/Database.php)
     - __models__
       - [Post.php](app/models/Post.php)
       - [User.php](app/models/User.php)
     - __views__
       - __inc__
         - [footer.php](app/views/inc/footer.php)
         - [header.php](app/views/inc/header.php)
         - [navbar.php](app/views/inc/navbar.php)
       - __pages__
         - [about.php](app/views/pages/about.php)
         - [index.php](app/views/pages/index.php)
       - __posts__
         - [add.php](app/views/posts/add.php)
         - [edit.php](app/views/posts/edit.php)
         - [index.php](app/views/posts/index.php)
         - [show.php](app/views/posts/show.php)
       - __users__
         - [login.php](app/views/users/login.php)
         - [register.php](app/views/users/register.php)
   - [post.sql](post.sql)
   - __public__
     - __css__
       - [style.css](public/css/style.css)
     - [index.php](public/index.php)
     - __js__
       - [main.js](public/js/main.js)
   - [screenshot.PNG](screenshot.PNG)
