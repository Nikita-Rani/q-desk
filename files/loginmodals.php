<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font" id="loginModalLabel">Log in to enjoy Q-Desk services</h5>
        <button type="button" class="close font" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="files/loginhandler.php" method="post">

        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control font" id="email" aria-describedby="emailHelp"name="user_email">
          <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>
        <div class="form-group">
          <label for="Password">Password</label>
          <input type="password" class="form-control font" id="Password1"name="user_pass">
        </div>
        <!-- <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
        <button type="submit" class="btn btn-success font">Submit</button>
        <p class="text-center Lead font">Not a member? <a href=""data-toggle="modal" data-target="#signupModal"data-dismiss="modal">Sign up</a></p>
        </form>
        <a href="reset.php">Forgot Your Password?</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary font" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
 