<?php
// Initialize variables with default values
$email = '';
$name = '';
$phone = '';
$carPlate = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $phone = isset($_POST['Phone']) ? $_POST['Phone'] : '';
    $carPlate = isset($_POST['numberInput']) ? $_POST['numberInput'] : '';

    // Database connection parameters
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'echarge';

    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Prepare the SQL query to update the user information
    $query = "UPDATE users SET name = :name, phone = :phone, carPlate = :carPlate WHERE email = :email";

    // Prepare and execute the query
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':carPlate', $carPlate);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->rowCount() > 0) {
        // Update successful
        echo "User information updated successfully.";
    } else {
        // Update failed
        echo "Failed to update user information.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/StyleExp.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Profile Page</title>
</head>
<body>
<nav class="MYnavbar">
        <div class="MYnavbaricon">
            <img src="img/logoNoSlogan-01.png" alt="logo">
        </div>
        <ul class="MYnavbar-nav">
        <li class="MYnav-item">
                <a class="MYnav-link" href="BookAppointment.php"><i class="fas fa-calendar-alt"></i> Booking</a>
            </li>
            <li class="MYnav-item">
                <a class="MYnav-link" href="profile_owner.php"><i class="fas fa-user"></i>ownerpage</a>
            </li>
            <li class="MYnav-item">
                <a class="MYnav-link" href="homePage.php"><i class="fas fa-sign-out-alt"></i> Log out</a>
            </li>

        </ul>
    </nav>   

<div class="wrapper userinfo">
    <div class="form-box">
        <h2>User Information</h2>
        <div class="profile">
            <form id="profile-form" enctype="multipart/form-data" method="post" action="">
                <img id="preview-image" src="img/profile_picture.jpeg" alt="Preview Image" class="profile-picture">
                <br>
                <label for="profile-picture" style="color: aliceblue;">Profile Picture</label>
                <br>
                <input type="file" id="profile-picture-input" name="profile-picture-input" style="display: none;">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
            </form>
        </div>
        <form method="post" id="profileinfo" action="profile_page.php">

            <div class="input-box">
                <input type="email" id="email" name="email" required value="<?php echo $email; ?>" style="color: aliceblue;">
                <label for="email" style="color: aliceblue;">Email:</label>
            </div>
            <div class="input-box">
                <input type="text" id="name" name="name" required value="<?php echo $name; ?>" style="color: aliceblue;" />
                <label for="passwordNew" style="color: aliceblue;">Name:</label>
            </div>
            <div class="input-box">
                <input type="text" id="Phone" name="Phone" value="<?php echo $phone; ?>" style="color: aliceblue;" oninput="limitNumberInput(event, 10)" />
                <label for="Phone" style="color: aliceblue;">Phone:</label>
            </div>
            <div class="input-box">
    <input type="text" id="numberInput" name="numberInput" maxlength="8" title="Please enter a number in the format XX-XXXXX" required value="<?php echo $carPlate; ?>">
    <label for="numberInput" style="color: aliceblue;">Car plate</label>
</div>

            <button type="submit" class="btnLogin">Update</button>
        </form>
    </div>
</div>

<script>
    function limitNumberInput(event, maxLength) {
        const input = event.target;
        const inputValue = input.value.replace(/\D/g, '');
        const limitedValue = inputValue.substring(0, maxLength);
        input.value = limitedValue;
    }
</script>

<script>
    // Get the preview image and file input elements
    const previewImage = document.getElementById('preview-image');
    const fileInput = document.getElementById('profile-picture-input');

    // Add a click event listener to the preview image
    previewImage.addEventListener('click', function() {
        // Trigger a click event on the file input field
        fileInput.click();
    });

    // Listen for changes in the file input
    fileInput.addEventListener('change', function(event) {
        // Get the selected file
        const file = event.target.files[0];

        // Create a FileReader instance
        const reader = new FileReader();

        // Set the image source when the file is loaded
        reader.onload = function(e) {
            previewImage.src = e.target.result;
        };

        // Read the file as a data URL
        reader.readAsDataURL(file);
    });
</script>

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
