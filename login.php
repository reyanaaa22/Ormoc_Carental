<?php
// Start session for session variables
session_start();

// Check if the form is submitted
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // md5 hash for password

    // Database connection and query
    $sql = "SELECT EmailId, Password, FullName FROM tblusers WHERE EmailId=:email AND Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();

    // Fetch the result
    $results = $query->fetch(PDO::FETCH_OBJ);
    
    // Check if the query returned any results
    if($query->rowCount() > 0) {
        $_SESSION['login'] = $_POST['email'];  // Store email in session
        $_SESSION['fname'] = $results->FullName;  // Store full name in session

        // Redirect to the current page after login
        $currentpage = $_SERVER['REQUEST_URI'];
        echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
    } else {
        // Display error message if login details are invalid
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!-- Modal Login Form -->
<div class="modal fade" id="loginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title">Login</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email address*" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password*" required>
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember"> Remember Me
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Don't have an account? <a href="#signupform" data-toggle="modal" data-dismiss="modal">Signup Here</a></p>
        <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Forgot Password?</a></p>
      </div>
    </div>
  </div>
</div>
