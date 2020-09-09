<?php 

    include('config/db_connect.php');

    $name = $email = $console = '';
    $errors = array('email' => '', 'name' => '', 'console' => '');

    if(isset($_POST['submit'])){
        //check email
        if(empty($_POST['email'])){
            $errors['email'] = 'Mandatory email contact required <br/>';
        }else{
           $email = $_POST['email'];
           if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
               $errors['email'] =  'email must be a valid email address';
           }
        }

        //check name
        if(empty($_POST['name'])){
            $errors['name'] = 'Mandatory name field required <br/>';
        }else{
            $name = $_POST['name'];
            
        }

        //check console
        if(empty($_POST['console'])){
            $errors['console'] = 'Mandatory console field required <br/>';
        }else{
            $ingr = $_POST['console'];
        }

        if(!array_filter($errors)){ //return true if we have errors
            
            $email = mysqli_real_escape_string($conn,$_POST['email']); 
            $name = mysqli_real_escape_string($conn,$_POST['name']); 
            $console = mysqli_real_escape_string($conn,$_POST['console']);

            // create sql
            $sql = "INSERT INTO videogames(title,email,console) VALUES('$name','$email','$console')";

            //save to db and check
            if(mysqli_query($conn,$sql)){
                header('Location: index.php');
            }else{
                echo 'query error: ' . mysqli_error($conn);
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<?php include("template/header.php"); ?>

<section class="container grey-text">
    <h4 class="center">Add a Videogame</h4>
    <form action="add.php" method="POST" class="white">
        <label>Your email</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors['email'] ?></div>
        <label>Videogame Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
        <div class="red-text"><?php echo $errors['name'] ?></div>
        <label>Supported consoles</label>
        <input type="text" name="console" value="<?php echo htmlspecialchars($console) ?>">
        <div class="red-text"><?php echo $errors['console'] ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class=" btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include("template/footer.php");?>
</html>