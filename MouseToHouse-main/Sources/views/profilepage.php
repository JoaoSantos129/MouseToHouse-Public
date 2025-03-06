<?php
ob_start();
?>
    <div class="center">
        <form style="box-shadow: none" action="index.php?action=logout" method="POST">
            <h1>Votre compte :</h1>
            <?php echo '<p class="accountInfos"> Username : ' . $_SESSION['username']. '</p>';
            echo '<p class="accountInfos"> Name : ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '</p>';
            echo '<p class="accountInfos"> E-mail : ' . $_SESSION['email'] . '</p></form>';
            if ($_SESSION['username'] == "Developer") {
                ?>
                <div style="display: inline-block;">
                    <form style="box-shadow: none" action="index.php?action=OurProjecteam" method="POST">
                        <input style="margin-top: 50px" type="submit" name="easterEgg" value="Notre Team">
                    </form>
                </div>
                <div style="display: inline-block;">
                    <form style="box-shadow: none" action="index.php?action=logout" method="POST">
                        <input style="margin-top: 50px" type="submit" name="logout" value="Se déconnecter">
                    </form>
                </div>
                <?php
            } else {
                ?>
            <form style="box-shadow: none" action="index.php?action=logout" method="POST">
                <input style="margin-top: 50px" type="submit" id='signaler' value='Se déconnecter'>
            </form>    
                <?php
            } ?>
    </div>
<?php
$content = ob_get_clean();
require "gabarit.php";
?>