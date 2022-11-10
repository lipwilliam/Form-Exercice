<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire PHP</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.2/css/bootstrap.min.css' integrity='sha512-CpIKUSyh9QX2+zSdfGP+eWLx23C8Dj9/XmHjZY2uDtfkdLGo0uY12jgcnkX9vXOgYajEKb/jiw67EYm+kBf+6g==' crossorigin='anonymous' />
</head>

<body>
    <div class="container">
        <h1>Formulaire Création utilisateur</h1>
        <!-- Action fichier de traitement : action='/controller/contactForm.php' -->
        <form method="post" class='from-control'>
            <input type="text" name="name" placeholder="name" autofocus><br> <!-- autofocus met le curseur dessus dès le chargement de la page -->
            <input type="text" name="email" placeholder="email"><br>
            <input type="text" name="year" placeholder="year"><br>
            <select name="job">
                <option value="">Select a Job</option>
                <option value="meca">Mécano</option>
                <option value="driver">Chauffeur</option>
                <option value="cook">Cuisto</option>
            </select><br>
            Hobbies
            <input type="checkbox" name="hobbies[]" value='fish'>Pêche
            <input type="checkbox" name="hobbies[]" value='travel'>Voyage
            <input type="checkbox" name="hobbies[]" value='astro'>Astronomie
            <input type="checkbox" name="hobbies[]" value='glandouille'>Chill
            <input type="checkbox" name="hobbies[]" value='Autre' checked>Autre
            <br>
            Ecolo ?
            <input type="radio" name="green" value='yes' checked>Oui
            <input type="radio" name="green" value='no'>Non<br>
            <textarea name="desc" placeholder="Description"></textarea>
            <br>
            <button class='btn btn-primary' type="submit">Envoyer</button>
        </form>
    </div>

    <!-- Affichage des erreurs --> 
    <?php //if (isset($errors) && !empty($errors)) :
    ?>
    <?php if ($error->getAll()) : //appel de la méthode getAll se trouvant dans ErrorCustom.php
    ?>
        <section>
            <h2>Errors</h2>
            <ul>
                <?php //foreach ($errors as $error) :
                ?>
                <?php foreach ($error->getAll() as $error) :
                ?>
                    <?= "<li class='alert alert-danger'>$error</li>" ?> <!-- appel au message d'erreur de l'index-->
                <?php endforeach; ?>
            </ul>
        </section>
    <?php endif; ?>

    <!-- Affichage du contact soumis -->
    <?php if (isset($contact) && count($contact) > 0) : ?>
        <section>
            <h2>Mon Contact</h2>
            <ul class='alert alert-success'>
                <?php foreach ($contact as $info) : ?> <!-- les array_push de l'index l.48 etc... correspondent aux messages de validation -->
                    <?= '<li>' . $info . '</li>' ?>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php endif; ?>

</body>

</html>