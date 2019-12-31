<h2 class="auth-type">
    <a data-toggle="collapse" href="#collapseReviews" role="button" aria-expanded="false" aria-controls="collapseReviews">
        Review Routes
  </a>
</h2>       
<div class="collapse" id="collapseReviews">
    <div class="card card-body">
        <div class="access-type">ROUTES THAT DO NOT REQUIRE AUTHENTICATION</div>

        <div class="endpoint">
        <span class="endpoint-link"><a href="{{url('api/reviews')}}">api/reviews</a></span>
            <div class="endpoint-desc">
                <span>– Returns all list of all reviews.</span>
            </div>
            <div class="endpoint-method">Method: GET</div> 
            <div class="endpoint-params">Optional Params - Query params</div>
            <div class="small">The route accepts the following query params that allow result filtering, ordering and pagination:</div>
            <ul>
                <li>book_id - Filters results by book.</li>
                <li>review_author_id - Filters results by review author.</li>
                <li>rating - Filters results by rating.</li>
                <li>order_by - Orders results by seleted property. Acceptable values are: id, book_id, rating, created_at</li>
                <li>order - Orders results in ascending or descending order. Acceptable values are: ASC and DESC. Default: DESC.</li>
                <li>paginate - Paginates results by selected number, used as query param. Default: all results.</li>
            </ul>
            <div class="example">Query with params example: api/reviews?book_id=9&order_by=rating&order=DESC&paginate=10</div>
        </div>

        <div class="endpoint">
            <span class="endpoint-link">api/reviews/{review}</span>
            <div class="endpoint-desc">
                <span>- Returns details of a single review. </span>
            </div>
            <div class="endpoint-method">Method: GET</div> 
            <div class="endpoint-params">Required Params - URL params</div>
            <ul>
                <li>review - a valid review id.</li>
            </ul>
        </div>

        <div class="access-type">ROUTES THAT REQUIRE AUTHENTICATION</div>

        <div class="endpoint">
            <span class="endpoint-link">api/reviews</span>
            <div class="endpoint-desc">
                <span>- Creates a new review.</span>
                <span>- Returns created review details.</span>
            </div>
            <div class="endpoint-method">Method: POST</div> 
            <div class="endpoint-params">Required Params - Form Params</div>
            <ul>
                <li>'rating' - a single digit integer in range from 1 to 5 inclusively</li>
                <li>'review' – a string of characters up to 500 character in length. Allowed characters are: letters, numbers, spaces, commas, dots, question marks and exclamation points. </li>
                <li>'book_id' – a valid book id.</li>
            </ul>
        </div>

        <div class="endpoint">
            <span class="endpoint-link">api/reviews/{review}</span>
            <div class="endpoint-desc">
                <span>- Updates single review details.</span>
                <span>- Returns updated review details.</span>
            </div>
            <div class="endpoint-method">Method: PUT / PATCH</div> 
            <div class="endpoint-params">Required Params</div>
            <span>URL Params</span>
            <ul>
                <li>review - a valid review id</li>
            </ul>
            <span>Form Params</span>
            <ul>
                <li>'rating' - a single digit integer in range from 1 to 5 inclusively</li>
                <li>'review' – a string of characters up to 500 character in length. Allowed characters are: letters, numbers, spaces, commas, dots, question marks and exclamation points. </li>
                <li>'book_id' – a valid book id.</li>
            </ul>
        </div>

        <div class="endpoint">
            <span class="endpoint-link">api/reviews/{review}</span>
            <div class="endpoint-desc">
                <span>- Deletes a single review from database.</span>
                <span>-  Returns a success message.</span>
            </div>
            <div class="endpoint-method">Method: DELETE</div> 
            <div class="endpoint-params">Required Params - URL Params</div>
            <ul>
                <li>review - a valid review id</li>
            </ul>
        </div>
    </div>
</div>