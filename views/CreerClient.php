<?php include("header.php"); ?>
<main>

    <article id="slogan">
        <h2> FORMULAIRE DE CRÉATION D'UN CLIENT </h2>
    </article>
        <section id='section'>
            <form action="../controllers/Controller.php" method="post" id="formCreate">
                <input type='hidden' name='todo' value='creerClient'>
                <div>
                    <label for="userPseudo">Pseudo</label>
                    <input type="text" name="userPseudo" required id="userPseudo">
                </div>
                <div>
                    <label for="userMail">Adresse mail</label>
                    <input type="email" name="userMail" id="userMail" required">
                </div>
                <div>
                    <label for="userPassword"> Mot de passe</label>
                    <input type="password" name="userPassword" id="userPassword" required">
                </div>

                <div>
                    <input type="submit" name="submitCreerClient" id="submit">
                </div>
            </form>
        </section>
</main>
<footer>
    <small>&copy; 2022 - boutiquebasique</small>
</footer>
</body>
</html>