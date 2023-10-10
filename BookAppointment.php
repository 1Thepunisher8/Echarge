<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/StyleExp.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Book Page</title>
</head>
<body>
    <nav class="MYnavbar">
        <div class="MYnavbaricon">
            <img src="img/logoNoSlogan-01.png" alt="logo">
        </div>
        <ul class="MYnavbar-nav">
            <li class="MYnav-item">
                <a class="MYnav-link" href="profile_page.php"><i class="fas fa-user"></i> Profile</a>
            </li>
            <li class="MYnav-item">
                <a class="MYnav-link" href="homePage.php"><i class="fas fa-sign-out-alt"></i> Log out</a>
            </li>
        </ul>
    </nav>

    <iframe src="https://www.google.com/maps/d/embed?mid=1LxTv1JWTofvnWH6KlG-euBMLCrkNiao&ehbc=2E312F" width="640" height="480"></iframe>

    <div class="row">
        <div class="wrapper booking">
            <div class="form-box login">
                <img id="logoIcon" src="img/logoicon-01.png" alt="icon" style="height: 50px;">
                <h2>Book Appointment</h2>
                <form action="" method="POST">
                    <div class="BookForm">
                        <label for="Select-Station" style="color: aliceblue;">
                            <i class="fas fa-train"></i> Select Station:
                        </label>
                        <select class="MYSelect" name="station" required>
                            <option value="" selected disabled>Select a station</option>
                            <?php
                            // Database connection parameters
                            $servername = 'localhost';
                            $username = 'root';
                            $password = '';
                            $dbname = 'echarge';

                            // Create a new PDO instance
                            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

                            // Fetch station names from the database
                            $query = "SELECT station_name FROM station_information";
                            $stmt = $pdo->query($query);

                            // Populate select options with station names
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$row['station_name']}'>{$row['station_name']}</option>"; 
                            }
                            ?>          
                         </select>
                    </div>
                    <div class="BookForm">                    
                        <label for="time-input" style="color: aliceblue;">
                            <span class="icon"><i class="fas fa-clock"></i></span>
                            Select Time:
                        </label>
                        <input type="time" id="time-input" name="time" required>
                        <br/>
                    </div>
                
                    <button type="submit" name="book" class="btnLogin">Book</button>
                </form>
               
                <?php
                if (isset($_POST['book'])) {
                    $station = $_POST['station'];
                    $time = $_POST['time'];

                    // Adjust the table and column names according to your requirements
                    $tableName = 'register';
                    $stationColumnName = 'station';
                    $timeColumnName = 'time';
                    // Database connection parameters
                    $servername = 'localhost';
                    $username = 'root';
                    $password = '';
                    $dbname = 'echarge';

                    // Create a new PDO instance
                    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

                    // Insert the data into the table
                    $query = "INSERT INTO $tableName ($stationColumnName, $timeColumnName) VALUES (:station, :time)";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':station', $station);
                    $stmt->bindParam(':time', $time);
                    $stmt->execute();

                    // Show a success message or redirect to a confirmation page
                    echo "<p><font color=blue> Booking successful; </font></p>";
                }
                ?>
                <div id="remaining-time"></div>
                <div id="gps-coordinates"></div>
            </div>
        </div>
    </div>

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
    
    <script>
        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var coordinatesText = "Latitude: " + latitude + "<br>Longitude: " + longitude;

            document.getElementById("gps-coordinates").innerHTML = coordinatesText;
        }

        function showError(error) {
            document.getElementById("gps-coordinates").innerHTML = "Error retrieving GPS coordinates: " + error.message;
        }

        function getGPSLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                document.getElementById("gps-coordinates").innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        // Call the getGPSLocation function to retrieve the GPS coordinates when the page loads
        window.onload = getGPSLocation;
    </script>

<script>
    var myInterval = '';

    function updateRemainingTime(userInputTime) {
        var currentTime = Date.now();

        if (userInputTime > currentTime) {
            var remainingTime = userInputTime - currentTime;
            var remainingHours = Math.floor(remainingTime / (1000 * 60 * 60));
            var remainingMinutes = Math.floor(
                (remainingTime % (1000 * 60 * 60)) / (1000 * 60)
            );
            var remainingSeconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

            var remainingTimeString =
                remainingHours +
                ' hours, ' +
                remainingMinutes +
                ' minutes, ' +
                remainingSeconds +
                ' seconds';


            // Show a popup window with the remaining time
            window.alert('Remaining Time: ' + remainingTimeString);
            return true;
        } else {
            window.alert('Time is up');
            return false;
        }
    }

    document.querySelector('.btnLogin').addEventListener('click', (e) => {
        if (myInterval) {
            clearInterval(myInterval);
            myInterval = '';
        }
        var arr = document.getElementById('time-input').value.split(':');
        var userInputTime = new Date().setHours(arr[0], arr[1]);
        var flag = updateRemainingTime(userInputTime);
        if (flag) {
            myInterval = setInterval(function () {
                updateRemainingTime(userInputTime);
            }, 1000);
        }
    });
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>