<?php
  // include vs require_once
     # include - if error, the code will run but return and error
     # require_once - if error, the program will halt (Strict)
  require_once "Database.php";

  // Note: The logic of our application e.g.(CRUD - CREATE, READ, UPDATE, DELETE)
  class User extends Database{
    public function store($request){
      $first_name = $request['first_name'];
      $last_name = $request['last_name'];
      $username = $request['username'];
      $password = $request['password'];

      // Apply hahing algorithm
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // SQL query string
      $sql = "INSERT INTO users(`first_name`, `last_name`, `username`, `password`) VALUES('$first_name', '$last_name', '$username', '$hashed_password')";

      // Execute the query string
      # $this->conn - comes from the Database class
      if($this->conn->query($sql)){
        // go to index.php or login.php page.. we will create later
        header('location: ../views');
        exit;
      }else{
        die('Error in creating the user: ' . $this->conn->error);
      }

    }

    // LOGIN
    public function login($request){ //username and password
      $username = $request['username'];
      $password = $request['password'];

      // Query string
      $sql = "SELECT * FROM users WHERE username = '$username'";

      $result = $this->conn->query($sql);

      // Check the username
      if($result->num_rows == 1){
        # Check the password
        $user = $result->fetch_assoc();
        # Eg. $user = ['id' => 1, 'username' => 'john', 'password' => '$2y$...'];

        // Check if the password matches
        if(password_verify($password, $user['password'])){
          # Create a session variables
          session_start();
          $_SESSION['id'] = $user['id'];
          $_SESSION['username'] = $user['username'];
          $_SESSION['fullname'] = $user['first_name']. ' '.$user['last_name'];
// 404 is returned if the page was not found
          header('location:../views/dashboard.php');
        }else{
          die('password is incorrect');
        }
      }else{
        die('username does not exist');
      }
    }

    // LOGOUT
    public function logout(){
      session_start(); // use session variables
      session_unset(); // unset the session variables set in the login method 
      session_destroy(); // destroy|remove the session variables from the memory

      header("location: ../views"); // redirect the user to the login page
      exit;
    }

    # Retrieve all the users in the users table
    public function getAllUsers(){
      $sql = "SELECT id, first_name, last_name, username, photo FROM users";
      if($result = $this->conn->query($sql)){
        return $result;
      }else{
        die("Error in retrieving users." . $this->conn->error);
      }
    }

    # Retrieve one user
    # Note: The $id is the id of the user we want to retrieve
    public function getUser($id){
      $sql = "SELECT * FROM users WHERE id = $id";

      if($result = $this->conn->query($sql)){
        return $result->fetch_assoc();
      }else{
        die("Error in retrieving one user." . $this->conn->error);
      }
    }

    // UPDATE
    public function update($request, $files){
      session_start();
      $id = $_SESSION['id'];
      $first_name = $request['first_name'];
      $last_name = $request['last_name'];
      $username = $request['username'];

      # Note: The file is handled differently
      // The 'photo' is the name of the input field from the form
      // The 'name' - the name of the file
      $photo = $files['photo']['name'];

      // The 'photo' is the name of the input field from the form
      // The 'tmp_name' refires to the temporary storage of our computer where the image is temporarily saved
      $photo_tmp = $files['photo']['tmp_name'];

      // Query string to update the firstname, lastname, and username
      $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username='$username' WHERE id = $id";

      // Execute the query above
      if($this->conn->query($sql)){
        $_SESSION['username'] = $username;
        $_SESSION['fullname'] = "$first_name $last_name";

        // If there is an uploaded photo, save it to the DB and save the file to the images folder
        if($photo){ //is it true that the user uploaded a photo?
          // then execute
          $sql = "UPDATE users SET photo = '$photo' WHERE id = $id";
          // file destination folder
          $destination = "../assets/images/$photo";

          // Execute the query above to save the image to the DB, and move the uploaded file
          if($this->conn->query($sql)){
            if(move_uploaded_file($photo_tmp, $destination)){
              header("location: ../views/dashboard.php");
              exit;
            }else{
              die("Error in moving the photo.");
            }
          }else{
            die("Error in uploading photo: " . $this->con->error);
          }
        }
        header('location: ../views/dashboard.php');
        exit;
      }else{
        die("Error in updating the user. " . $this->conn->error);
      }

    }

    // DELETE
    public function delete(){
      session_start();
      $id = $_SESSION['id'];

      // query
      $sql = "DELETE FROM users WHERE id = $id";

      if($this->conn->query($sql)){
        $this->logout(); // call logout, contains header('location: ../views') - login page
      }else{
        die("Error in deleting your account. " . $this->conn->error);
      }
    }
  }
