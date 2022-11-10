<?php

/*
    Steps
    - Affichage (en vue d'une soumission)
    - Submit
    - Controls
    - Result (OK | KO)

    Variante avec une classe d'erreur
*/
// Champs acceptés dans ce formulaire (fait référence aux name='' dans le form du template)
$inputsAllowed = [
    'name',
    'email',
    'year',
    'job',
    'hobbies',
    'green',
    'desc'
];
// Variables de stockage des erreurs
// $errors = [];
// Variante avec la classe de référencement des erreurs
require 'ErrorCustom.php';
$error = new ErrorCustom;

// Variables de stockage du contact
$contact = [];
$hobbies = [];

if (isset($_POST) && !empty($_POST)) {
    // Test $_POST
    if (count(array_diff($inputsAllowed, array_keys($_POST))) == 0) { //array_diff - Retourne un tableau contenant toutes les entités du tableau $inputsAllowed qui ne sont présentes dans $_POST
        // $error->dump('Le Post', $_POST);
        // die;
        // Parcourir le post, pour déterminer s'il y a des erreurs
        foreach ($_POST as $attrName => $value) {
            // Test si la valeur est vide
            if (empty($value)) {
                // ajouter l'erreur au tableau d'erreur
                // array_push($errors, "Le champ $attrName est vide");
                $error->add("Le champ $attrName est vide");
            } else {
                switch ($attrName) {
                    case 'email': //si la valeur écrite dans le form correspond aux filtres du regex, alors, on push, sinon erreur
                        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { //FILTER_VALIDATE_EMAIL est un regex de php // On filtre la valeur du mail écrite dans le formulaire
                            array_push($contact, "$attrName : $value"); //on push dans $contact, la value correspondante à l'attribut
                        } else {
                            // array_push($errors, "Le champ $attrName ne contient pas un email valide (xxx@xxx.xx)");
                            $error->add("Le champ $attrName ne contient pas un email valide (xxx@xxx.xx)");
                        }
                        break;
                    case 'year':
                        if (preg_match('/^1|2{1}\d{3}/', $_POST['year'])) { //preg_match effectue une recherche de correspondance avec l'expression '/^1|2{1}\d{3}/' trouvée sur internet
                            array_push($contact, "$attrName : $value");
                        } else {
                            // array_push($errors, "Le champ $attrName ne contient pas une année valide (AAAA)");
                            $error->add("Le champ $attrName ne contient pas une année valide (AAAA)");
                        }
                        break;
                    case 'hobbies':
                        if (count($_POST['hobbies']) > 0) {
                            array_push($contact, "$attrName : " . implode(', ', $_POST['hobbies'])); //implode: permet de récupérer les éléments du tableau et de les mettre dans une seule string. Ex: hobbies = ['fishing', 'travel'] on aura hobbies = "fishing, travel"
                        } else {
                            // array_push($errors, "Le champ $attrName doit contenir au moins 1 loisir");
                            $error->add("Le champ $attrName doit contenir au moins 1 loisir");
                        }
                        break;
                    case 'desc':
                        if (strlen($_POST['desc']) > 14) { // stringlength doit être > 14 //trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
                            $convertData = trim(stripslashes(htmlspecialchars($value))); //stripslashes — Supprime les guilletmets d'une phrase à guillement
                            array_push($contact, "$attrName : $convertData"); //htmlspecialchars — Convertit les caractères spéciaux en entités HTML lisibles dans du php
                        } else {
                            // array_push($errors, "Le champ $attrName doit contenir au moins 15 caractères");
                            $error->add("Le champ $attrName doit contenir au moins 15 caractères");
                        }
                        break;

                    default:
                        // N'est utilisé que pour 'name, job, green'
                        array_push($contact, "$attrName : $value");
                        break;
                }
            }
        }
    } else {
        // array_push($errors, "Merci de remplir tous les champs et de ne pas bidouiller les attributs 'name'");
        $error->add("Merci de remplir tous les champs et de ne pas bidouiller les attributs 'name'"); //si je supprime un input du template.php, alors ce message apparaîtra 
    }

    // Check is errors exist
    // if (count($errors) > 0)
    if (count($error->getAll()) > 0)
        $contact = [];
}

// Affiche le form
include 'template.php';
