<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModal">SignUp for an account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <form method="post" action="/forum/_handleSignup.php">
            <div class="modal-body">

                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" class="form-control" id="signupemail" placeholder="Enter your Email" name="signupemail">
                    </div>

                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input type="text" class="form-control" id="fname" placeholder="Enter your First Name"
                            name="fname">
                    </div>
                    <div class="form-group">
                        <label for="name">Last Name</label>
                        <input type="text" class="form-control" id="lname" placeholder="Enter your Last Name"
                            name="lname">
                    </div>

                    <div class="form-group">
                        <label for="password">Choose a password</label>
                        <input type="password" class="form-control" id="signuppassword" placeholder="Choose a password"
                            name="signuppassword">
                    </div>
                    <div class="form-group">
                        <label for="password2">Retype a password</label>
                        <input type="password" class="form-control" id="signuppassword2" placeholder="Retype your password"
                            name="signuppassword2">
                    </div>


                    <button type="submit" class="btn btn-danger mt-2">SignUp</button>
            </div>
                </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>