<?php include("header.php"); ?>
<main>
    <article id="slogan">
        <h2> FORMULAIRE DE Validation de code D'UN USER
            <?php
            if (isset($contenu)) {
                echo "<div class='erreur'>$contenu</div>";
            }
            ?></h2>
    </article>
    <section id='section'>
        <form action="../controllers/Controller.php" method="post" id="formLogin">
            <input type='hidden' name='todo' value='CodeCheck'>
            <div>
                <label for="codeCheck">Entrez votre CODE</label>
                <input type="tel" name="codeCheck" pattern="[0-9]{10}" id="codeCheck" required>
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