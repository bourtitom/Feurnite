<?php
session_start();
require('ControllerUser.php');


//ON INSTANCIE LES CONTROLLEURS DONT ON A BESOIN
$cc = new ControllerUser();


// ************************************************************************
// *****************   REQUETES EN GET VIA URL  ***************************
//RECUPERATION DE L ACTION A ACCOMPLIR VIA L'URL
if (isset($_GET['todo'])) {
    switch ($_GET['todo']) {

        // L'UTILISATEUR A CLIQUE SUR LE LIEN "NOUVEAU CLIENT" dans le menu
        case
        "creerClient":
        {
            //On appelle la méthode concernée dans la classe ControllerUser
            $cc->showCreate();
            break;
        }

        // L'UTILISATEUR A CLIQUE SUR LE LIEN "CLIENTS"
        case "afficherClients":
        {
            //On appelle la méthode concernée dans la classe ControllerUser
            $cc->showAll();
            break;
        }
        // L'UTILISATEUR A CLIQUE SUR LE LIEN "modifier le client" sur l'affichage d'un client
        case "modifierClient":
        {
            //On appelle la méthode concernée dans la classe ControllerUser
            $cc->showModify();
            break;
        }

        // L'UTILISATEUR A CLIQUE sur "se déconnecter"
        case "deconnexion":
        {
            //ON DECONNECTE LE CLIENT
            session_destroy();
            //On redirige vers le layout
            require('../views/Layout.php');
            break;
        }
        // L'UTILISATEUR A CLIQUE sur " FORGOT PASSSWORD"
        case "showForgot":
        {
            $cc->showForgot();

            //On redirige vers le layout
            break;
        }
        // L'UTILISATEUR A CLIQUE sur " FORGOT PASSSWORD"
        case "SenMailForgot":
        {
            $cc->Forgot();

            break;
        }
        //GESTION DES CAS D'ERREURS
        default :
        {
            echo "erreur de redirection!!!";
            break;
        }

    }//**********************  FIN  DU  SWITCH
}// FIN DES REQUETES EN GET VIA URL
//*************************************************
//*************************************************
//*************************************************


//*************************************************
//*************************************************
//*************************************************
//*************************************************
// REQUETES EN POST VIA FORMULAIRES
if (isset($_POST['todo'])) {

    switch ($_POST['todo']) {

        // L UTILISATEUR A POSTER LE FORMULAIRE DE LOGIN
        case "seConnecter":
        {
            //On appelle  la méthode concernée dans la classe ControllerUser
            $cc->login();
            break;
        }
        // L UTILISATEUR A POSTE LE FORMULAIRE DE CREATION D UN CLIENT
        case  "creerClient":
        {
            //On appelle la méthode concernée dans la classe ControllerUser
            $cc->store();
            break;
        }

        // L UTILISATEUR A POSTE LE FORMULAIRE DE MODIFICATION D UN CLIENT
        case
        "modifierClient":
        {
            //On appelle la méthode concernée dans la classe ControllerUser
            $cc->update();
            break;
        }

        // L UTILISATEUR A POSTE LE FORMULAIRE DE SUPPRESSION D UN CLIENT
        case
        "supprimerClient":
        {
            //On appelle la méthode concernée dans la classe ControllerUser
            $cc->delete();
            break;
        }
        // L'UTILISATEUR A CLIQUE sur " FORGOT PASSSWORD"
        case "showForgot":
        {
            $cc->showForgot();

            //On redirige vers le layout
            break;
        }
        // L'UTILISATEUR A CLIQUE sur " FORGOT PASSSWORD"
        case "SenMailForgot":
        {
            $cc->Forgot();

            break;
        }
        //GESTION DES CAS D'ERREURS
        default :
        {
            echo "erreur de redirection!!!";
            break;
        }

    }//**********************  FIN  DU  SWITCH
}// FIN DES REQUETES EN POST VIA LES FORMULAIRES
//*************************************************
//*************************************************
//*************************************************
