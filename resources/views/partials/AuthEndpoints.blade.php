<h2 class="auth-type">
    <a data-toggle="collapse" class="show" href="#collapseAuth" role="button" aria-expanded="true" aria-controls="collapseAuth">
    Authentication Routes
  </a>
</h2>
<div class="collapse show" id="collapseAuth">
    <div class="card card-body">
        <div class="endpoint">
            <span class="endpoint-link">api/register</span>
            <div class="endpoint-desc">
                <span>- Registers a new user (with simple users privileges), then performs automatic login.</span>
                <span>- Returns access token details and authenticated users details.</span>
            </div>
            <div class="endpoint-method">Method: POST</div> 
            <div class="endpoint-params">Required Params - Form Params</div>
            <ul>
                <li>'email' - a valid, unique email address</li>
                <li>'name' - a string composed of letters and spaces only</li>
                <li>'password' - a string of numeric characters between 8 and 20</li>
            </ul>
        </div>

        <div class="endpoint">
            <span class="endpoint-link">api/login</span>
            <div class="endpoint-desc">
                <span>- Authenticates users (both simple users and admins).</span>
                <span>- Returns access token details and authenticated users details.</span>
            </div>
            <div class="endpoint-method">Method: POST</div> 
            <div class="endpoint-params">Required Params - Form Params</div>
            <ul>
                <li>'email'  - existing users valid email address</li>
                <li>'password'  -  existing users password</li>
            </ul>
        </div>

        <div class="endpoint">
            <span class="endpoint-link">api/forgot-password</span>
            <div class="endpoint-desc">
                <span>- Sends password reset link via email.</span>
                <span>- Returns success message.</span>
            </div>
            <div class="endpoint-method">Method: POST</div> 
            <div class="endpoint-params">Required Params - Form Params</div>
            <ul>
                <li>'email' - existing users valid email address.</li>
            </ul>
        </div>

        <div class="endpoint">
            <span class="endpoint-link">api/reset-password</span>
            <div class="endpoint-desc">
                <span>- Redirects a user to the frontend apps specific link for password reset.</span>
                <span>- Returns success message.</span>
            </div>
            <div class="endpoint-method">Method: POST</div> 
            <div class="endpoint-params">Required Params - Form Params</div>
            <ul>
                <li>'token' - a valid token that was sent via users email in forgot-password request.</li>
                <li>'email' - a valid existing users email.</li>
                <li>'password' -  new password. Must be a string of numeric characters, between 8 and 20</li>
            </ul>
        </div>
    </div>    
</div>  