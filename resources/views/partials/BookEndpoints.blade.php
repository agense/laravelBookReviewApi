<h2 class="auth-type">
    <a data-toggle="collapse" href="#collapseBooks" role="button" aria-expanded="false" aria-controls="collapseBooks">
        Book Routes
  </a>
</h2>       
<div class="collapse" id="collapseBooks">
    <div class="card card-body">
        <div class="access-type">ROUTES THAT DO NOT REQUIRE AUTHENTICATION</div>
    
        <div class="endpoint">
            <span class="endpoint-link"><a href="{{url('api/books')}}">api/books</a></span>
            <div class="endpoint-desc">
                <span>– Returns all list of all books.</span>
            </div>
            <div class="endpoint-method">Method: GET</div> 
            <div class="endpoint-params">Optional Params - Query params</div>
            <div class="small">The route accepts the following query params that allow result filtering, ordering and pagination:</div>
            <ul>
                <li>author_id - Filters results by author.</li>
                <li>genre_id - Filters results by genre.</li>
                <li>order_by - Orders results by seleted property. Acceptable values are: id, created_at, author_id, genre_id, publication_year.</li>
                <li>order - Orders results in ascending or descending order. Acceptable values are: ASC and DESC. Default: DESC.</li>
                <li>paginate - Paginates results by selected number, used as query param. Default: all results.</li>
            </ul>
            <div class="example">Query with params example: api/books?genre_id=9&order_by=created_at&order=ASC&paginate=10</div>
        </div>

        <div class="endpoint">
            <span class="endpoint-link">api/books/{book}</span>
            <div class="endpoint-desc">
                <span>- Returns details of a single book. </span>
            </div>
            <div class="endpoint-method">Method: GET</div> 
            <div class="endpoint-params">Required Params - URL params</div>
            <ul>
                <li>book - a valid book id.</li>
            </ul>
        </div>

        <div class="access-type">ROUTES THAT REQUIRE AUTHENTICATION</div>

        <div class="endpoint">
            <span class="endpoint-link">api/books</span>
            <div class="endpoint-desc">
                <span>- Creates a new book. Uploads a book image to storage if an image  is sent along.</span>
                <span>- Returns created book details.</span>
            </div>
            <div class="endpoint-method">Method: POST</div> 
            <div class="endpoint-params">Required Params - Form Params</div>
            <ul>
                <li>'title' - a unique string of characters, up to 191 characters in length. Allowed characters: letters, numbers, spaces, commas, dots, question marks and exclamationpoints.</li>
                <li>'description' - a unique string of characters, up to 1000 characters in length. Allowed characters: letters, numbers, spaces, commas, dots, question marks and exclamationpoints.</li>
                <li>'publication_year' -  an integer of exactly 4 digits, in the range from 1900 till the current year.</li>
                <li>'genre_id' - an existing genre id</li>
                <li>'author_id' - an existing author id</li>
            </ul>
            <div class="endpoint-params">Optional Params - Form Params</div>
            <ul>
                <li>'image' - an image encoded as base64 string. Allowed extensions are jpeg, jpg, png.</li>
            </ul>
        </div>

        <div class="endpoint">
            <span class="endpoint-link">api/books/{book}</span>
            <div class="endpoint-desc">
                <span>- Updates single book details.</span>
                <span>- Returns updated book’s details.</span>
            </div>
            <div class="endpoint-method">Method: PUT / PATCH</div> 
            <div class="endpoint-params">Required Params</div>
            <span> - URL Params</span>
            <ul>
                <li>book - a valid book id.</li>
            </ul>
            <span> - Form Params</span>
            <ul>
                <li>'title' - a unique string of characters, up to 191 characters in length. Allowed characters: letters, numbers, spaces, commas, dots, question marks and exclamationpoints.</li>
                <li>'description' - a unique string of characters, up to 1000 characters in length. Allowed characters: letters, numbers, spaces, commas, dots, question marks and exclamationpoints.</li>
                <li>'publication_year' -  an integer of exactly 4 digits, in the range from 1900 till the current year.</li>
                <li>'genre_id' - an existing genre id</li>
                <li>'author_id' - an existing author id</li>
            </ul>
            <div class="endpoint-params">Optional Params - Form Params</div>
            <ul>
                <li>'image' - an image encoded as base64 string. Allowed extensions are jpeg, jpg, png.</li>
            </ul>
        </div>

        <div class="endpoint">
            <span class="endpoint-link">api/books/{book}</span>
            <div class="endpoint-desc">
                <span>- Deletes a single book database.</span>
                <span>-  Returns success or error message.</span>
            </div>
            <div class="endpoint-method">Method: DELETE</div> 
            <div class="endpoint-params">Required Params - URL Params</div>
            <ul>
                <li>book - a valid book id.</li>
            </ul>
        </div>
    </div>
</div>