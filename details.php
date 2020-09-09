<?php 

    include('config/db_connect.php');

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

        $sql = "DELETE from videogames WHERE id = $id_to_delete";

        if(mysqli_query($conn,$sql)){
            //success
            header('Location: index.php');
        }else{
            //failure
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    //check get request id param
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn,$_GET['id']);

        //make sql
        $sql = "SELECT * from videogames WHERE id = $id";

        //get query result
        $result = mysqli_query($conn,$sql);

        //fetch result in array format
        $videogame = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);

    }

?>

<!DOCTYPE html>
<html lang="en">

<?php include('template/header.php'); ?>

<div class="container center">
    <?php if($videogame): ?>
        <h4><?php echo htmlspecialchars($videogame['title']); ?></h4>
        <p>Created by: <?php echo htmlspecialchars($videogame['email']); ?></p>
        <p>Created at: <?php echo date($videogame['created_at']); ?></p>
        <h5>Consoles:</h5>
        <p><?php echo htmlspecialchars($videogame['console']); ?></p>

        <!-- Delete FORM -->
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $videogame['id']?>">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>

    <?php else: ?>
        <h5>No such videogame exist!</h5>
    <?php endif; ?>
</div>

<?php include('template/footer.php'); ?>

</html>