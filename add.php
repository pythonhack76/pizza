<?php

$errors = array('email' => '', 'title' => '', 'ingredients' => '');

if (isset($_POST['submit'])) {
    function preventAttack($data)
    {
        $data = htmlspecialchars($data);
        $data = htmlentities($data);
        $data = rtrim($data);
        $data = ltrim($data);


        return $data;
    }
    //check email 
    if (empty($_POST['email'])) {
        $errors['email'] = 'una email è richiesta <br />';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $errors['email'] = 'la mail non è scritta nel modo corretto';
        } else {
            echo preventAttack($_POST['email']);
        }
    }
    //check title
    if (empty($_POST['title'])) {
        $errors['title'] = 'devi selezionare una pizza <br />';
    } else {
        //echo preventAttack($_POST['title']);
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = 'il titolo deve avere solo lettere e spazi';
        } else {
            echo preventAttack($_POST['title']);
        }
    }

    //check ingredients 
    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'devi inserire almeno un ingrediente <br />';
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = 'Ci deve essere una virgola a separare gli ingredienti';
        } else {
            echo preventAttack($_POST['ingredients']);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include('./templates/header.php'); ?>

<section class="container grey-text">

    <h4 class="center">Aggiungi Pizza</h4>
    <form action="add.php" method="POST" class="white">

        <label for="email">La tua email:</label>
        <input type="text" name="email" id="email">
        <div class="red-text"><?php echo $errors['email']; ?> </div>
        <input type="hidden" <label for="title">Titolo Pizza:</label>
        <input type="text" name="title" id="title">
        <div class="red-text"><?php echo $errors['title']; ?> </div>
        <label for="ingredients">Ingredienti:(separare con virgola)</label>
        <input type="text" name="ingredients" id="ingredients">
        <div class="red-text"><?php echo $errors['ingredients']; ?> </div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">

        </div>

    </form>
</section>

<?php include('./templates/footer.php'); ?>



</html>