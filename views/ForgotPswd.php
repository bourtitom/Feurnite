<?php include("header.php"); ?>
<main>
    <article id="slogan">
        <h2> FORMULAIRE DE FORGOT PASSWORD D'UN USER
            <?php
            if (isset($contenu)) {
                echo "<div class='erreur'>$contenu</div>";
            }
            ?></h2>
    </article>
    <section id='section'>
        <form action="../controllers/Controller.php" method="post" id="formLogin">
            <input type='hidden' name='todo' value='SenMailForgot'>
            <div>
                <label for="userMail">Entrez votre identifiant</label>
                <input type="text" name="userMail" id="userMail" required>
            </div>

            <div>
                <input type="submit" name="submitLogin" value="envoyer un mail" id="submit">
            </div>
        </form>
    </section>
</main>
<footer>
    <small>&copy; 2022 - boutiquebasique</small>
</footer>
</body>
</html>