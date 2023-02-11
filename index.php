<?php
    include 'connect.php';

    $name = $email = $mobile = $dob = $gender = $role = "";
    $nameErr = $emailErr = $mobileErr = $dobErr = $genderErr = $roleErr = "";
    $errors = 0;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = test_input($_POST['name']);
        $email = test_input($_POST['email']);
        $mobile = test_input($_POST['mobile']);
        $dob = test_input($_POST['dob']);
        $gender = test_input($_POST['gender']);
        $role = test_input($_POST['role']);

        if(empty($name)){
            echo $nameErr = "Field cannot be empty";
            $errors++;
        }

        if(empty($email)){
            echo $emailErr = "Field cannot be empty";
            $errors++;
        }
        else{
            $check = "SELECT * FROM  contact WHERE email='$email'";
            $checkQuery = mysqli_query($con, $check);
            if(mysqli_num_rows($checkQuery) > 0){
                echo $emailErr = "Email already exist!";
                $errors++;
            }
        }

        if(empty($mobile)){
            echo $mobileErr = "Field cannot be empty";
            $errors++;
        }

        if(empty($dob)){
            echo $dobErr = "Field cannot be empty";
            $errors++;
        }

        if(empty($gender)){
            echo $genderErr = "Field cannot be empty";
            $errors++;
        }

        if(empty($role)){
            echo $roleErr = "Field cannot be empty";
            $errors++;
        }

        if(empty($errors)){
            $query  = "INSERT INTO contact (`name`, email, phone, d_o_b, gender, `role`) VALUES ('$name', '$email', '$mobile', '$dob', '$gender', '$role')";
            mysqli_query($con, $query);

            //echo "Added successfully";
        }
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $select = "SELECT * FROM contact";
    $fQuery = mysqli_query($con, $select);
    $rows  = mysqli_num_rows($fQuery);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Title</title>
</head>

<body>
<section class="content" id="content">
    <div class="header">
        <h1 id="title">Department Conact Form </h1>
        <p id="description">It's your time to fill out the contact form</p>
    </div>
    <form id="contact-form" method="post" action>
        <div class="row">
            <label id="name-label" for="name">Full name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
        </div>
        <div class="row">
            <label id="" for="email">Email address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email" required>
        </div>
        <div class="row">
            <label id for="number">Mobile number</label>
            <input type="number" name="mobile" id="number" class="form-control" placeholder="Enter your Mobile number" required>
        </div>
        <div class="row">
            <label id for="age">Date of birth </label>
            <input type="date" name="dob" id="age" class="form-control" placeholder="Age" required>
            <a href="https://en.wikipedia.org/wiki/Birthday" target="_blank">Why we are asking for this?</a>
        </div>
        <div class="row">
            <p>Gender</p>
            <label for="male"><input name="gender" value="Male" type="radio" class="input-radio" id="male" > Male</label>
            <label for="female"><input name="gender" value="Female" type="radio" class="input-radio" id="female" > Female</label>
            <label for="other"><input name="gender" value="Other" type="radio" class="input-radio" id="other">Other</label>
        </div>
        <div class="row">
            <p>Current role in the department?</p>
            <select id="dropdown" name="role" class="form-control" required>
                <option disabled selected >Select current role</option>
                <option value="Student">Student</option>
                <option value="Lecturer">Lecturer</option>

            </select>
        </div>

        <div class="row">
            <button type="submit" id="submit" name="submit" class="submit">Submit</button>
        </div>
    </form>

</section>

<section class="content">
    <table style="max-width:80%">
      <tr>
        <th colspan=5><h2>Conact List </h2></th>
      </tr>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone No.</th>
        <th>Date of Birth</th>
        <th>Role</th>
      </tr>
      <?php
        if($rows > 0){
            while($fetch = mysqli_fetch_assoc($fQuery)){
                echo "<tr><td>".$fetch['name']."</td><td>".$fetch['email']."</td><td>".$fetch['phone']."</td><td>".$fetch['d_o_b']."</td><td>".$fetch['role']."</td></tr>";
            }
        }else{
            echo "0 contacts in database";
        }
      ?>
    </table>
</section>
</body>
</html>