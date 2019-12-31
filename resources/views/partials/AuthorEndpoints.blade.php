<h2 class="auth-type">
    <a data-toggle="collapse" href="#collapseAuthors" role="button" aria-expanded="false" aria-controls="collapseAuthors">
        Author Routes
  </a>
</h2>       
<div class="collapse" id="collapseAuthors">
    <div class="card card-body">
        <div class="access-type">ROUTES THAT DO NOT REQUIRE AUTHENTICATION</div>

        <div class="endpoint">
            <span class="endpoint-link"><a href="{{url('api/authors')}}">api/authors</a></span>
            <div class="endpoint-desc">
                <span>– Returns all list of all authors.</span>
            </div>
            <div class="endpoint-method">Method: GET</div> 
            <div class="endpoint-params">Optional Params - Query params</div>
            <ul>
                <li>paginate - Paginates results by selected number, used as query param. Default: all results.</li>
            </ul>
            <div class="example">Query with params example: api/authors?paginate=10</div>
        </div>

        <div class="endpoint">
            <span class="endpoint-link">api/authors/{author}</span>
            <div class="endpoint-desc">
                <span>- Returns details of a single author. </span>
            </div>
            <div class="endpoint-method">Method: GET</div> 
            <div class="endpoint-params">Required Params - URL params</div>
            <ul>
                <li>author - a valid author id.</li>
            </ul>
        </div>

        <div class="access-type">ROUTES THAT REQUIRE AUTHENTICATION</div>

        <div class="endpoint">
            <span class="endpoint-link">api/authors</span>
            <div class="endpoint-desc">
                <span>- Creates a new author.</span>
                <span>- Returns created authors details.</span>
            </div>
            <div class="endpoint-method">Method: POST</div> 
            <div class="endpoint-params">Required Params - Form Params</div>
            <ul>
                <li>'name'  - a unique string of alphabetical characters and spaces.</li>
            </ul>
        </div>
    
        <div class="access-type">ROUTES THAT REQUIRE AUTHENTICATION AND ADMIN PRIVILEGES</div>
        <div class="endpoint">
            <span class="endpoint-link">api/authors/{author}</span>
            <div class="endpoint-desc">
                <span>- Updates the details of a single author.</span>
                <span>- Returns updated genre details.</span>
            </div>
            <div class="endpoint-method">Method: PUT / PATCH</div> 
            <div class="endpoint-params">Required Params</div>
            <span>URL Params</span>
            <ul>
                <li>author  - a valid author id.</li>
            </ul>
            <span>Form Params</span>
            <ul>
                <li>'name'  - a unique string of alphabetical characters and spaces.</li>
            </ul>
        </div>

        <div class="endpoint">
            <span class="endpoint-link">api/authors/{author}</span>
            <div class="endpoint-desc">
                <span>- Deletes a single author from database.</span>
                <span>- Returns success message.</span>
            </div>
            <div class="endpoint-method">Method: DELETE</div> 
            <div class="endpoint-params">Required Params - URL Params</div>
            <ul>
                <li>author  - a valid author id.</li>
            </ul>
        </div>
    </div>
</div>