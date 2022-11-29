<?php include("header.php"); ?>
<main>
    <article id="slogan">
        <h2> FORMULAIRE DE CONNEXION D'UN USER
            <?php
            if (isset($contenu)) {
                echo "<div class='erreur'>$contenu</div>";
            }
            ?></h2>
    </article>
    <section id='section'>
        <form action="../controllers/Controller.php" method="post" id="formLogin">
            <input type='hidden' name='todo' value='seConnecter'>
            <div>
                <label for="userMail">Entrez votre identifiant</label>
                <input type="text" name="userMail" id="userMail" required>
            </div>
            <div>
                <label for="userPassword"> Entrez votre mot de passe</label>
                <input type="password" name="userPassword" id="userPassword" required>
            </div>
            <div>
                <input type="submit" name="submitLogin" value="CONNEXION" id="submit">
            </div>
        </form>
        <a href='../controllers/Controller.php?todo=showForgot'>Forgot Password</a>

    </section>
</main>
<footer>
    <small>&copy; 2022 - boutiquebasique</small>
</footer>
</body>
</html>