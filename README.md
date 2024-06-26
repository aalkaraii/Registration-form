# Registration-form

README for Registration Form
Description
This is a simple registration form built with HTML, CSS, and JavaScript. The form collects user information including name, phone number, email, address, gender, skills, and country. Upon submission, the form data is validated and sent to a PHP script (alkas.php) for processing and storage in a MySQL database.

Features
User input validation for each field.
Error messages displayed for invalid inputs.
Form data submission to a PHP script.
Responsive design for mobile view.
Structure
HTML: Structure of the registration form.
CSS: Styling for the form.
JavaScript: Client-side validation.
PHP: Server-side script to process and store the form data in a MySQL database.
Installation and Setup
Clone the repository:
bash
Copy code
git clone <repository_url>
Navigate to the project directory:
bash
Copy code
cd <project_directory>
Set up the database:
Create a MySQL database named web.
Create a table named form with the following structure:
sql
Copy code
CREATE TABLE form (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
phoneNumber VARCHAR(15) NOT NULL,
Email VARCHAR(255) NOT NULL,
gender VARCHAR(10) NOT NULL,
address VARCHAR(255) NOT NULL,
skills VARCHAR(255) NOT NULL,
country VARCHAR(50) NOT NULL
);
Update the PHP script (alkas.php):
Ensure the database connection variables ($server, $username, $password, $db) are set correctly.
Usage
Open the HTML file (index.html) in a web browser.
Fill out the registration form with valid information.
Submit the form. The form data will be validated and, if valid, sent to the PHP script for processing.
Check the database to verify the data has been stored.
Code Explanation
HTML
html
Copy code

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Form Webpage</title>
    <link rel="stylesheet" href="web.css" />
</head>
<body>
    <form method="POST" onsubmit="return validate()" action="alkas.php">
        <div class="login-box">
            <h1>Registration Form</h1>
            <!-- Input fields with associated labels and error messages -->
            <!-- Example for name field -->
            <div class="name">
                <label>Name :</label>
                <input type="text" id="name" name="firstField" placeholder="Enter your Name" />
                <p id="error1"></p>
            </div>
            <!-- Other input fields follow a similar structure -->
            <!-- Submit button -->
            <div class="submit">
                <button type="submit">Submit</button>
            </div>
        </div>
    </form>
    <script src="web.js"></script>
</body>
</html>
CSS (web.css)
css
Copy code
/* Basic styling for the form */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
background-color: rgb(246, 246, 246);
display: flex;
align-items: center;
justify-content: center;
height: 100vh;
}

.login-box {
display: flex;
flex-direction: column;
width: 600px;
height: 900px;
background-color: white;
padding: 80px 60px;
row-gap: 20px;
}

h1 {
text-align: center;
padding: 10px;
}

input[type=text], input[type=email], select {
width: 350px;
border: 1px solid;
border-radius: 4px;
height: 25px;
}

button {
background-color: black;
color: white;
padding: 10px 50px;
border-radius: 30px;
}
JavaScript (web.js)
javascript
Copy code
function validate(event) {
event.preventDefault();

const Name = document.getElementById("name").value;
const Phone = document.getElementById("phone").value;
const Email = document.getElementById("email").value;
const Address = document.getElementById("address").value;
const Gender = document.querySelector('input[name="Gender"]:checked');
const Skills = document.querySelectorAll('input[name="skll[]"]:checked');
const Country = document.getElementById("countri").value;

let valid = true;

// Clear previous error messages
document.getElementById("error1").innerHTML = "";
document.getElementById("error2").innerHTML = "";
document.getElementById("error3").innerHTML = "";
document.getElementById("error4").innerHTML = "";
document.getElementById("error5").innerHTML = "";
document.getElementById("error7").innerHTML = "";
document.getElementById("error8").innerHTML = "";

// Validate each field
if (Name === "") {
document.getElementById("error1").innerHTML = "\*Please enter your name";
valid = false;
}

if (Phone === "") {
document.getElementById("error2").innerHTML = "*Please enter your phone number";
valid = false;
} else if (isNaN(Phone) || Phone.length !== 10) {
document.getElementById("error2").innerHTML = "*Please enter a valid 10-digit phone number";
valid = false;
}

if (Email === "") {
document.getElementById("error3").innerHTML = "*Please enter your email address";
valid = false;
} else if (!Email.match(/^[A-Za-z\._\-0-9]+@[A-Za-z]+\.[a-z]{2,4}$/)) {
document.getElementById("error3").innerHTML = "*Please enter a valid email address";
valid = false;
}

if (Gender === null) {
document.getElementById("error4").innerHTML = "\*Please select your gender";
valid = false;
}

if (Address === "") {
document.getElementById("error5").innerHTML = "\*Please enter your address";
valid = false;
}

if (Skills.length === 0) {
document.getElementById("error7").innerHTML = "\*Please select at least one skill";
valid = false;
}

if (Country === "") {
document.getElementById("error8").innerHTML = "\*Please select your country";
valid = false;
}

if (valid) {
alert("Your form has been submitted!");
document.querySelector('form').submit();
} else {
alert("Please fill in all required fields.");
}
}

document.querySelector('form').addEventListener('submit', validate);
PHP (alkas.php)
php
Copy code

<?php
  // Database connection variables
  $server = "localhost";
  $username = "root";
  $password = "";
  $db = "web";

  // Create connection to database
  $connect = new mysqli($server, $username, $password, $db);
  
  // Check connection
  if($connect->connect_error){
      echo "Connection error!";
  }

  // Collecting data from form
  $name = $_POST['firstField'];
  $phone = $_POST['secondField'];
  $email = $_POST['thirdField'];
  $gender = $_POST['Gender'];
  $address = $_POST['fifthField'];
  $skills = implode(',', $_POST['skll']); // For multiple inputs
  $country = $_POST['contree'];

  // SQL query to insert data into table
  $sql = "INSERT INTO form (name, phoneNumber, Email, gender, address, skills, country) VALUES ('$name','$phone','$email','$gender','$address','$skills','$country')";

  // Execute query
  if($connect->query($sql)){
      echo "The data has been inserted.";
  } else {
      echo "Error: " . $sql . "<br>" . $connect->error;
  }
?>

License
This project is licensed under the MIT License.
