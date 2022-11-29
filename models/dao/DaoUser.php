<?php
require_once('../models/User.php');
require_once('../config/config.php');
//***********************************************User  User  User
//***********************************************User  User  User
//***********************************************User  User  User
class DaoUser
{
    //ATTRIBUT DE LA CLASSE DaoUser
    private $maConnection;

    //CONSTRUCTEUR DE LA CLASSE DaoUser
    public function __construct()
    {
        //INSTANCIATION DE LA CONNEXION PAR APPEL AU CONSTRUCTEUR PDO ET VALORISATION DES ATTRIBUTS
        $this->maConnection = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        //PARAMETRAGE POUR AFFICHAGE DES ERREURS RELATIVES A LA CONNEXION
        $this->maConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

//CETTE FONCTION PERMET DE CREER UN NOUVEAU User
    function createUser(): array
    {
        $code = rand(9999999999, 1111111111);

        $user = new User(0, $_POST['userPseudo'], $_POST['userMail'], password_hash($_POST['userPassword'], PASSWORD_BCRYPT), $code);

        //ON UTILISE LA METHODE prepare() de PDO POUR FAIRE UNE REQUETE PARAMETREE
        $query = $this->maConnection->prepare("INSERT INTO `user`(`USER_PSEUDO`,`USER_MAIL`,`USER_PASSWORD`,`USER_CODE`) values(?, ?, ?, ?)");
        $result = $query->execute(array(
            $user->getUserPseudo(),
            $user->getUserMail(),
            $user->getUserPassword(),
            $user->getUserCode()

        ));
        //ON RECUPERE LID DU NOUVEAU User
        $user->setUserId($this->maConnection->lastInsertId());
        //ON RETOURNE LE PRODUIT DANS UN TABLEAU AU CONTROLLER
        //LE CONTROLEUR VA APPELER LA FONCTION "afficherProduits"
        // et lui passer le tableau en parametre
        $tabUsers = array();
        array_push($tabUsers, $user);
        return $tabUsers;
    }


//CETTE FONCTION PERMET DE METTRE A JOUR UN User
    function updateUser(): array
    {
        $code = rand(9999999999, 1111111111);

        $user = new User($_POST['userId'],$_POST['userMail'], password_hash($_POST['userPassword'], PASSWORD_BCRYPT), $code );

        //ON UTILISE LA METHODE prepare() de PDO POUR FAIRE UNE REQUETE PARAMETREE
        $query = $this->maConnection->prepare("UPDATE user SET USER_PSEUDO=?, USER_MAIL=?, USER_PASSWORD=?, USER_CODE=? WHERE USER_ID=?");
        $result = $query->execute(array(

            $user->getUserPseudo(),
            $user->getUserMail(),
            $user->getUserPassword(),
            $user->getUserCode(),
            $user->getUserId()
        ));
        //ON RETOURNE LE User DANS UN TABLEAU QUE L'ON DONNE AU CONTROLLER
        //LE CONTROLEUR VA APPELER LA FONCTION "afficherUsers"
        // et lui passer le tableau en parametre
        $tabUsers = array();
        array_push($tabUsers, $user);
        return $tabUsers;
    }

//CETTE FONCTION PERMET DE SUPPRIMER UN User
    function deleteUser(): void
    {
        $query = $this->maConnection->prepare("DELETE FROM user WHERE USER_ID =?");
       $query->execute(array($_POST['userId']));
    }

    //CETTE FONCTION PREND EN ARGUMENT UN JEU DE RESULTATS DE BDD ET LE TRANSFORME EN ARRAY D OBJETS DE TYPE PRODUITS
    function resultToObjects($result)
    {   //ON RECUPERE LE RÉSULTAT DE LA REQUETE DANS UN TABLEAU
        //QUI CONTIENDRA 1 OU PLUSIEURS OBJETS DE TYPE PRODUIT
        $listUsers = array();
        foreach ($result as $row) {
            $User = new User($row['USER_ID'], $row['USER_PSEUDO'], $row['USER_MAIL'], $row['USER_PASSWORD'], $row['USER_CODE']);
            array_push($listUsers, $User);
        }
        return $listUsers;
    }

    //CETTE METHODE PERMET DE TROUVER UN PRODUIT PAR SON ID
    function getUserByMail($mail): array
    {
        $query = $this->maConnection->prepare(" SELECT USER_ID,USER_PSEUDO, USER_MAIL , USER_PASSWORD, USER_CODE FROM user WHERE USER_MAIL =?");
        $query->execute(array(
            $mail));
        $result = $query->fetchAll();
        //ON TRANSFORME LE RESULTAT EN TABLEAU CONTENANT UN OU PLUSIEURS OBJETS DE TYPE PRODUIT
        return $this->resultToObjects($result);
    }

    //CETTE METHODE PERMET DE SELECTIONNER TOUS LES UserS
    function getAll(): array
    {
        $query = $this->maConnection->prepare("SELECT USER_ID,USER_PSEUDO, USER_MAIL , USER_PASSWORD, USER_CODE FROM user");
        $query->execute();
        $result = $query->fetchAll();
        //ON TRANSFORME LE RESULTAT EN TABLEAU CONTENANT UN OU PLUSIEURS OBJETS DE TYPE PRODUIT
        return $this->resultToObjects($result);
    }


    //CETTE METHODE PERMET DE TROUVER UN PRODUIT PAR SON ID
    function getUerById($id): array
    {
        $query = $this->maConnection->prepare(" SELECT USER_ID,USER_PSEUDO, USER_MAIL , USER_PASSWORD, USER_CODE  FROM user WHERE USER_ID =?");
        $query->execute(array(
            $id));
        $result = $query->fetchAll();
        //ON TRANSFORME LE RESULTAT EN TABLEAU CONTENANT UN OU PLUSIEURS OBJETS DE TYPE PRODUIT
        return $this->resultToObjects($result);
    }
    //CETTE METHODE PERMET DE TROUVER UN PRODUIT PAR SON ID
    function getUerByCode($Code): array
    {
        $query = $this->maConnection->prepare(" SELECT USER_ID,USER_PSEUDO, USER_MAIL , USER_PASSWORD, USER_CODE  FROM user WHERE USER_CODE =?");
        $query->execute(array(
            $Code));
        $result = $query->fetchAll();
        //ON TRANSFORME LE RESULTAT EN TABLEAU CONTENANT UN OU PLUSIEURS OBJETS DE TYPE PRODUIT
        return $this->resultToObjects($result);
    }


    //CETTE FONCTION PERMETS D'AFFICHER LES INFORMATIONS DU User
    function afficherUsers($tabUsers = null): string
    {
        $lesUsers = array();
        if (!empty($_POST['userId'])) {
            /* récupérer les données du formulaire en utilisant
               la valeur des attributs name comme clé*/
            $lesUsers = $this->getUerById($_POST['UserId']);
        }
        if (($tabUsers == null) && (!isset($_POST['UserId']))) {
            //ON APPELLE LA FONCTION QUI VA FAIRE LA REQUETE AUPRES DE LA BASE DE DONNEES
            //CETTE FONCTION RENVOIE UN TABLEAU CONTENANT UN OU PLUSIEURS OBJETS DE TYPE UserS
            $lesUsers = $this->getAll();
        }
        //SUITE A LA SUPPRESSION D UN User ON REAFFICHE TOUT LES UserS
        if ((isset($_POST['todo'])) && ($_POST['todo']=="supprimerUser")) {
            //ON AFFICHE TOUS LES UserS
            $lesUsers = $this->getAll();
        }

        if ($tabUsers != null) {
            $lesUsers = $tabUsers;
        }

        //ON AFFICHE LE HTML POUR LE FICHIER "AfficherUsers"
        if (isset($_SESSION["user"])) {
            $contenu =
                "<section id='slogan'>
        <h2>Mon profil</h2></div ></section><div id='menu'>";
        } else {
            $contenu =
                "<section id='slogan'>
        <h2>Liste des Users</h2></div ></section><div id='menu'>";
        }


        foreach ($lesUsers as $User) {
            $id = $User->getUserId();
            $contenu .= "<article class='article' >
            <div class='container' >";
            if (isset($_SESSION["User"])) {
                $contenu .= "<a href = '../../controllers/Controller.php?todo=commencerCommande'>ACHETER DES PRODUITS</a>";
            }
            $contenu .= "</div >
             <h2 > " . $User->getUserPseudo() . "</h2 >
            <br>
            <button id='submit'>
                <a href = '../controllers/Controller.php?todo=modifierUser&id=$id'>MODIFIER OU SUPPRIMER</a>
            </button><br> ";


             $contenu .= "</article > ";

        }
        return $contenu;
    }

//CETTE FONCTION PERMET D'AFFICHER UN FORMULAIRE DE RECHERCHE DE UserS
    function rechercheUser(): string
    {    //ON APPELLE LA FONCTION QUI VA FAIRE LA REQUETE AUPRES DE LA BASE DE DONNEES
        //CETTE FONCTION RENVOIE TOUS LES User SOUS FORME DE TABLEAU D'OBJETS
        $lesUsers = $this->getAll();

        //ON AFFICHE LE HTML POUR LE FICHIER "ModifierUsers"
        $recherche = "
<form name='searchProduct' action='#' method='post' class='search-form'>
    <label for='UserId' hidden></label>
    <select name='UserId' id='nomUser' class='header-select' onchange='this.form.submit()'>
        <option value=''>Choisir un User</option>";
        foreach ($lesUsers as $User) {
            $recherche .= "<option value=" . $User->getUserId() . ">" . $User->getUserPseudo() . "</option>";
        }

        $recherche .= "</select>
</form>";

        return $recherche;
    }

//CETTE FONCTION PREND EN GET DANS L URL UN ID User
//ET RENVOIE User
    function afficherFormModif(): User
    {
        //ON APPELLE LA FONCTION QUI VA FAIRE LA REQUETE AUPRES DE LA BASE DE DONNEES
        //CETTE FONCTION RENVOIE UN TABLEAU CONTENANT LE User A MODIFIER
        //ON RETOURNE CET OBJET User AU CONTROLEUR QUI A APPELLE LA FONCTION
        //LE CONTROLEUR RETOURNERA L'OBJET A LA VUE "ModifierUser";
        return $this->getUerById($_GET['id'])[0];
    }

    //CETTE FONCTION VERIFIE LE LOGIN ET MET LE User EN SESSION
    function login(): string
    {
        //ON VA CHERCHER DANS LA BASE DE DONNES SI LE MAIL FOURNI (POST) EXISTE
        //SI IL EXISTE ON RECUPERE LE User SOUS FORME D'OBJET DANS UN TABLEAU
        $tUser = $this->getUserByMail($_POST['userMail']);
        $ok = false;

        //SI LE TABLEAU CONTIENT UN ELEMENT
        //ON VERIFIE QUE LE MOT DE PASSE FOURNI (POST) CORRESPOND AU MOT DE PASSE CRYPTE DANS LA BASE DE DONNEES
        //SI TOUT EST BON ON PASSE LE BOOLEEN ok A TRUE
        if (count($tUser) == 1) {
            $User = $tUser[0];
            if (password_verify($_POST['userPassword'], $User->getUserPassword())) {
                $ok = true;
            }
        }

        //SI ok EST FALSE, ON RETOURNE UN MESSAGE D'ERREUR
        if (!$ok) {
            return "LE LOGIN EST ERRONE";
        }
        //SINON ON MET LE User EN SESSION ET ON APPELLE LA FONCTION QUI PERMETTRA
        //DE L'AFFICHER DANS "Layout'
        else {
            $_SESSION["user"] = [
                "id" => $User->getUserId(),
                "prenom" => $User->getUserPseudo()
            ];
            return $this->afficherUsers($tUser);
        }
    }

    function forgotpswd()
    {

        ini_set("SMTP", "smtp.orange.fr");
        ini_set("sendmail_from", "melcarpg@hotmail.com");

        $tUser = $this->getUserByMail($_POST['userMail']);
        if (count($tUser) == 1) {
            $User = $tUser[0];
            echo $User->getUserCode();
            if(mail($_POST['userMail'], "Forgot Password MelcaRPG", "Votre code : " . $User->getUserCode())) {
                echo "Mail envoyé avec succès.";
            }
            else {
                echo "Un problème est survenu.";
            }

        }
    }

    function CheckCode(){

    }

}