<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/StyleExp.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   <title> Contact Form </title>
   <style>
      body {
         font-family : Arial, sans-serif;
      }
      h1 {
         text-align : center;
      }
      form { margin : auto; max-width: 500px;
      }
      label { 
         display : block; margin-bottom: 10px;
      }
      input[type = "text"], input[type = "email"], textarea { padding: 10px; width: 100%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-bottom: 20px;
      }
      submit{ 
         background-color : #4CAF50;
         color : #fff;
         padding : 10px 20px; border :  none; border-radius : 4px; cursor : pointer;
      }
      button:hover { 
         background-color : #3e8e41;
      }
   </style>
</head> 
<body>
<nav class="navbar  MYnavbar navbar-expand-lg navbar-dark bg-black">
      <div class="container-fluid d-flex justify-content-center">
          <img src="img/logoNoSlogan-01.png" alt="logo" style="height: 50px;    filter: drop-shadow(1px 1px 0px var(--text-color));">
      </div>
      </nav>
  </nav>

   <h1> Contact Us </h1>
   <?php
    // Database connection parameters
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'echarge';

    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Adjust the table and column names according to your requirements
        $tableName = 'contact';
        $nameColumnName = 'name';
        $emailColumnName = 'email';
        $messageColumnName = 'message';

        // Insert the data into the table
        $query = "INSERT INTO $tableName ($nameColumnName, $emailColumnName, $messageColumnName) VALUES (:name, :email, :message)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        $stmt->execute();

        // Show a success message or redirect to a confirmation page
        echo "<p>Form submitted successfully!</p>";
    }
    ?>

   <form method="post">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" required>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>
      <label for="message">Message:</label>
      <textarea name="message" id="message" required></textarea>
      <button type="submit" name="submit">Submit</button>
   </form>
   <footer class="mt-5">
        <div class="FooterContainer">
            <div class="row">
                <div class="col l6 s12">
                    <h5>Links</h5>
                    <ul>
                        <li>
                            <a href="Terms.php"><i>Terms and Conditions</i></a>
                        </li>
                        <li>
                            <a href="contactus.php"><i>Contact Us</i></a>
                        </li>
                        <li>
                            <a href="About_us.php"><i>About Us</i></a>
                        </li>
                    </ul>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5>Connect</h5>
                    <ul>
                        <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                        <li><a href="https://twitter.com/"><i class="fab fa-twitter"></i> Twitter</a></li>
                        <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="FooterContainer copyRight">
            <div class="row">
                <div class="col s12">
                    <p>&copy; 2023 Electric Cars | Address | Phone Number | Email</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
