## LARAVEL BOOK REVIEW API PROJECT

### PROJECT DESCRIPTION

*	The backend part of the full stack book review app project.
*	Provides api endpoints for uploading and managing authors, genres, books, reviews and user accounts.
*	Project includes authentication and supports two types of users: simple user and admin user with different access privileges.
*	Project uses Passport\'s Pasword Grant Client for stateless authentication.



### API ENDPOINTS
###### \* All routes need to be prepended with the app\'s base url, example: http://bookReviewApp.dev/
###### \* All endpoints return json data.

### Authentication Routes
---
#### api/register

* Registers a new user (with simple users privileges), then performs automatic login.  Returns access token details and authenticated users details.
* Method: POST
* Required Params \- Form Params
  * email \- a valid, unique email address
  * name \- a string composed of letters and spaces only
  * password \- a string of numeric characters between 8 and 20


#### api/login
* Authenticates users (both simple users and admins). Returns access token details and authenticated users details.
* Method: POST
* Required Params - Form Params
  * email  \- existing users valid email address
  * password  \-  existing users password


#### api/forgot-password
* Sends password reset link via email. Returns success message.
* Method: POST
* Required Params \- Form Params
  * email \- existing users valid email address.


#### api/reset-password
* Redirects a user to the frontend apps specific link for password reset. Returns success message.
* Method: POST
* Required Params \- Form Params
  * token \- a valid token that was sent via users email in forgot-password request.
  * email \- a valid existing users email.
  * password \-  new password. Must be a string of numeric characters, between 8 and 20

### Genre Routes
---
##### ROUTES THAT DO NOT REQUIRE AUTHENTICATION
#### api/genres
* Returns a list of all genres.
* Method: GET
* Optional Params - Query params
  * Paginate \- Paginates results by selected number, used as query param. Default: all results.

_Query with params example: api/genres?paginate=10_

#### api/genres/\{genre\}
* Returns details of a single genre.
* Method: GET
* Required Params \- URL params
  * genre - a valid genre id.

##### ROUTES THAT REQUIRE AUTHENTICATION AND ADMIN PRIVILEGES
#### api/genres
* Creates a new genre. Returns created genre details.
* Method: POST
* Required Params - Form Params
    * name  \- a unique string of alphabetical characters and spaces.

#### api/genres/{genre}
* Updates the details of a single genre.Returns updated genre details.
* Method: PUT / PATCH
* Required URL Params
    * genre  \- a valid genre id.
* Required Form Params
    * name'  \- a unique string of alphabetical characters and spaces.

#### api/genres/{genre}
* Deletes a single genre from database.Returns success message.
* Method: DELETE
* Required Params - URL Params
  * genre  \- a valid genre id.

### Author Routes
---
##### ROUTES THAT DO NOT REQUIRE AUTHENTICATION
#### api/authors
* Returns all list of all authors.
* Method: GET
* Optional Params \- Query params
  * paginate - Paginates results by selected number, used as query param. Default: all results.

_Query with params example: api/authors?paginate=10_
        
#### api/authors/{author}
* Returns details of a single author.
* Method: GET
* Required Params \- URL params
  * author \- a valid author id.

##### ROUTES THAT REQUIRE AUTHENTICATION
#### api/authors
* Creates a new author.Returns created authors details.
* Method: POST
* Required Params \- Form Params
  * name  \- a unique string of alphabetical characters and spaces.

##### ROUTES THAT REQUIRE AUTHENTICATION AND ADMIN PRIVILEGES
#### api/authors/{author}
* Updates the details of a single author. Returns updated genre details.
* Method: PUT / PATCH
* Required Params
  * URL Params
    * author  \- a valid author id.
  * Form Params
    * name \- a unique string of alphabetical characters and spaces.

#### api/authors/{author}
* Deletes a single author from database. Returns success message.
* Method: DELETE
* Required Params \- URL Params
  * author \- a valid author id.

### Book Routes
---     
##### ROUTES THAT DO NOT REQUIRE AUTHENTICATION
#### api/books
* Returns all list of all books
* Method: GET
* Optional Params \- Query params
* _The route accepts the following query params that allow result filtering, ordering and pagination:_
  * author_id \- Filters results by author.
  * genre_id \- Filters results by genre.
  * order_by \- Orders results by seleted property. Acceptable values are: id, created_at, author_id, genre_id, publication_year.
  * order \- Orders results in ascending or descending order. Acceptable values are: ASC and DESC. Default: DESC.
  * paginate \- Paginates results by selected number, used as query param. Default: all results.

_Query with params example: api/books?genre_id=9&order_by=created_at&order=ASC&paginate=10_

#### api/books/{book}
* Returns details of a single book.
* Method: GET
* Required Params \- URL params
  * book \- a valid book id.

##### ROUTES THAT REQUIRE AUTHENTICATION</div>
#### api/books
* Creates a new book. Uploads a book image to storage if an image  is sent along. Returns created book details.
* Method: POST
* Required Params - Form Params
  * title \- a unique string of characters, up to 191 characters in length. Allowed characters: letters, numbers, spaces, commas, dots, question marks and exclamation points.
  * description\- a unique string of characters, up to 1000 characters in length. Allowed characters: letters, numbers, spaces, commas, dots, question marks and exclamation points.
  * publication_year \-  an integer of exactly 4 digits, in the range from 1900 till the current year.
  * genre_id \- an existing genre id
  * author_id \- an existing author id
* Optional Params - Form Params
  * image \- an image encoded as base64 string. Allowed extensions are jpeg, jpg, png.


#### api/books/{book}
* Updates single book details. Returns updated book’s details.
* Method: PUT / PATCH
* Required Params
  * URL Params
    * book - a valid book id.
  * Form Params
    * title \- a unique string of characters, up to 191 characters in length. Allowed characters: letters, numbers, spaces, commas, dots, question marks and exclamation points.
    * description \- a unique string of characters, up to 1000 characters in length. Allowed characters: letters, numbers, spaces, commas, dots, question marks and exclamation points.
    * publication_year \-  an integer of exactly 4 digits, in the range from 1900 till the current year.
    * genre_id \- an existing genre id
    * author_id \- an existing author id
            
  * Optional Params \- Form Params
    * image \- an image encoded as base64 string. Allowed extensions are jpeg, jpg, png.

#### api/books/{book}
* Deletes a single book database. Returns success or error message.
* Method: DELETE
* Required Params \- URL Params
  * book \- a valid book id.

### Review Routes
---
##### ROUTES THAT DO NOT REQUIRE AUTHENTICATION
#### api/reviews
* Returns all list of all reviews.
* Method: GET
* Optional Params \- Query params
* _The route accepts the following query params that allow result filtering, ordering and pagination:_
  * book_id \- Filters results by book.
  * review_author_id \- Filters results by review author.
  * rating \- Filters results by rating.
  * order_by \- Orders results by seleted property. Acceptable values are: id, book_id, rating, created_at.
  * order \- Orders results in ascending or descending order. Acceptable values are: ASC and DESC. Default: DESC.
  * paginate \- Paginates results by selected number, used as query param. Default: all results.
_Query with params example: api/reviews?book_id=9&order_by=rating&order=DESC&paginate=10_
        
#### api/reviews/{review}
* Returns details of a single review.
* Method: GET
* Required Params - URL params
  * review - a valid review id.

##### ROUTES THAT REQUIRE AUTHENTICATION
#### api/reviews
* Creates a new review. Returns created review details.
* Method: POST
* Required Params \- Form Params
  * rating \- a single digit integer in range from 1 to 5 inclusively
  * review \- a string of characters up to 500 character in length. Allowed characters are: letters, numbers, spaces, commas, dots, question marks and exclamation points.
  * book_id \- a valid book id.
        
#### api/reviews/{review}
* Updates single review details. Returns updated review details.
* Method: PUT / PATCH
* Required Params
  * URL Params
    * review \- a valid review id.
  * Form Params
    * rating \- a single digit integer in range from 1 to 5 inclusively.
    * review \- a string of characters up to 500 character in length. Allowed characters are: letters, numbers, spaces, commas, dots, question marks and exclamation points.
    * book_id \- a valid book id.

#### api/reviews/{review}
* Deletes a single review from database. Returns a success message.
* Method: DELETE
* Required Params - URL Params
  * review \- a valid review id.

### User Account Management Routes
---
##### ROUTES THAT REQUIRE AUTHENTICATION
#### api/users/profile/
* Returns authenticated users account details.
* Method: GET

#### api/users/profile/
* Updates authenticated users account details. Returns updated authenticated users account details.
* Method: PUT / PATCH
* Required Params \- Form Params
  * email \- a valid, unique email address.
  * name \- a string of letters and spaces only.

#### api/users/resetPassword/
* Updates authenticated users password. Returns a success message.
* Method: PUT / PATCH
* Required Params \- Form Params
  * password \- a string of numeric characters between 8 and 20.
  * current_password \- current authenticated users password.

##### ROUTES THAT REQUIRE AUTHENTICATION AND ADMIN PRIVILEGES
#### api/users
* Returns a list of all simple users, i.e. excluding admins.
* Method: GET
* Optional Params \- Query Params
  * paginate - Paginates results by selected number, used as query param. Default: all results.

_Query with params example: api/users?paginate=10_

#### api/users/{user}
* Returns single user details. Can return details of any user, not only the authenticated user.
 * Method: GET
 * Required Params \- URL Params
   * user \- a valid user id.

#### api/users/{user}
* Deletes  single user form database. Returns success message.
* Method: DELETE
* Required Params \- URL Params
  * user \- a valid user id.

### App Statistics Routes
---
##### ROUTES THAT REQUIRE AUTHENTICATION AND ADMIN PRIVILEGES
#### api/statistics
* Returns app statistics\: number of authors, genres, books, reviews, users and admin users.
* Method: GET
---

### INSTALLATION

* Install composer dependencies
```bash
composer install
```
* Create .env file inside app directory (.env.example file can be used as a blueprint). The required settings in .env file are:
    * Database connection credentials.
    * Mail driver credentials. Required for password reset via email functionality.
    * Frontend app data. Project requires two additional settings in .env file required for communication with frontend app: FRONTEND_URL ( your frontend app url ) and FRONTEND_FORGOT_PASSWORD_BACKLINK (this should be set to /reset-password ). Include them in.env file like this:
    ```
    FRONTEND_URL = http://localhost:8080
    FRONTEND_FORGOT_PASSWORD_BACKLINK = /reset-password
    ```
* Create and seed database tables. Default data is available for all app components. 
```bash
php artisan migrate
php artisan db:seed
```
*Note: Default backend administrator is created when seeding database. These credentials can be used to access the admin area.*
* In order to use Laravel Passport authentication, specifically Password Grant authentication, create a Password Grant Client:
```bash
php artisan passport:client --password
```

* Install Javascript dependencies and compile the project:
```bash
npm install
npm run dev
```


