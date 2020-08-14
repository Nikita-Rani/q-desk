<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font" id="signupModalLabel">Sign Up to create an account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="files/signuphandler.php"method="post">


        <div class="form-group font">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email"name="user_email" aria-describedby="emailHelp">
          <small id="emailHelp" class="form-text text-muted font">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label form="Username">Username</label>
          <input type="text" class="form-control font"name="user_name" id="Username">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password"name="user_pass" class="form-control font" id="password">
        </div>
        <div class="form-group">
          <label for="cpassword">Confirm Password</label>
          <input type="password" class="form-control font" id="user_cpass"name="user_cpass">
        </div>

        <button type="submit" class="btn btn-success font"name="btn">Submit</button>
        <p class="text-center Lead font">Already a member? <a href=""data-toggle="modal" data-target="#loginModal"data-dismiss="modal">login</a></p>
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary font" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>