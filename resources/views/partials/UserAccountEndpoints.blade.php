<h2 class="auth-type">
    <a data-toggle="collapse" href="#collapseUsers" role="button" aria-expanded="false" aria-controls="collapseUsers">
        User Account Management Routes
  </a>
</h2>       
<div class="collapse" id="collapseUsers">
    <div class="card card-body">
        <div class="access-type">ROUTES THAT REQUIRE AUTHENTICATION</div>
        <div class="endpoint">
            <span class="endpoint-link">api/users/profile/</span>
            <div class="endpoint-desc">
                <span>- Returns authenticated users account details.</span>
            </div>
            <div class="endpoint-method">Method: GET</div> 
        </div>

        <div class="endpoint">
            <span class="endpoint-link">api/users/profile/</span>
            <div class="endpoint-desc">
                <span>- Updates authenticated users account details.</span>
                <span>- Returns updated authenticated users account details.</span>
            </div>
            <div class="endpoint-method">Method: PUT / PATCH</div> 
            <div class="endpoint-params">Required Params - Form Params</div>
            <ul>
                <li>'email' - a valid, unique email address</li>
                <li>'name' - a string composed of letters and spaces only</li>
            </ul>
        </div>

    <div class="endpoint">
        <span class="endpoint-link">api/users/resetPassword/</span>
        <div class="endpoint-desc">
            <span>- Updates authenticated users password.</span>
            <span>- Returns a success message.</span>
        </div>
        <div class="endpoint-method">Method: PUT / PATCH</div> 
        <div class="endpoint-params">Required Params - Form Params</div>
        <ul>
            <li>'password' - a string of numeric characters between 8 and 20</li>
            <li>'current_password - current authenticated users password.</li>
        </ul>
    </div>
    
    <div class="access-type">ROUTES THAT REQUIRE AUTHENTICATION AND ADMIN PRIVILEGES</div>
    <div class="endpoint">
        <span class="endpoint-link">api/users</span>
            <div class="endpoint-desc">
                <span>– Returns a list of all simple users, i.e. excluding admins.</span>
            </div>
            <div class="endpoint-method">Method: GET</div>
            <div class="endpoint-params">Optional Params - Query params</div>
            <ul>
                <li>paginate - Paginates results by selected number, used as query param. Default: all results.</li>
            </ul>
            <div class="example">Query with params example: api/users?paginate=10</div>
    </div>

    <div class="endpoint">
        <span class="endpoint-link">api/users/{user}</span>
            <div class="endpoint-desc">
                <span>– Returns single user details. Unlike the profile route, can return details of any user, not only the authenticated user.</span>
            </div>
            <div class="endpoint-method">Method: GET</div> 
            <div class="endpoint-params">Required Params - URL Params</div>
            <ul>
                <li>user  - a valid user id.</li>
            </ul>
        </div>

        <div class="endpoint">
            <span class="endpoint-link">api/users/{user}</span>
            <div class="endpoint-desc">
                <span>– Deletes  single user form database.</span>
                <span>– Returns success message.</span>
            </div>
            <div class="endpoint-method">Method: DELETE</div> 
            <div class="endpoint-params">Required Params - URL Params</div>
            <ul>
                <li>user  - a valid user id.</li>
            </ul>
         </div>
    </div>
</div>