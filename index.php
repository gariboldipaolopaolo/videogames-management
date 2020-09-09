<?php 

    include('config/db_connect.php');

    //query for all videogames
    $sql = 'SELECT title, console, id from videogames ORDER BY created_at';

    //get result
    $result = mysqli_query($conn,$sql);

    //fetch the resulting rows as an array
    $videogames = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free for memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);


?>
<!DOCTYPE html>
<html lang="en">
<?php 

include("template/header.php");?>

    <h4 class="center grey-text">VIDEOGAMES!</h4>

    <div class="container">
        <div class="row">

        <?php foreach($videogames as $videogame):?>

            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6><?php
                            echo htmlspecialchars($videogame['title']);
                        ?></h6>
                        <ul>
                            <?php foreach(explode(',',$videogame['console']) as $ing): ?>
                                <li><?php echo htmlspecialchars($ing); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-action right-align">
                        <a href="details.php?id=<?php echo $videogame['id'] ?>" class="brand-text">more info</a>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>

        </div>
    </div>

<?php include("template/footer.php");?>
</html>