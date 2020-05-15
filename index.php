<?php
    require "header.php";
?>

    <main>
        <?php
            if (isset($_SESSION['userId'])) {
                echo '<p>You are logged in!</p>';
            }
            else {
                echo '<p>You are logged out!</p>';
            }
        ?>
        <hr>
        <a href="https://youtu.be/LC9GaXkdxF8?t=1454" target="_blank">Tutorial - current position</a>
    </main>

<?php
    require "footer.php";
?>
