<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Compte ADMIN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/headerFooter.css" />
    <link rel="stylesheet" href="assets/css/accountADMIN.css" />
</head>

<body>
    <?php include __DIR__ . '/../templates/header.php' ?>
    <main>
        <?php
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     if (!empty($_POST['glasseData'])) {
        //         echo "<pre>";
        //         print_r($_POST);  // Affiche les données soumises
        //         print_r($_FILES);
        //         echo "</pre>";
        //     } else {
        //         echo "Le formulaire n'a pas été soumis";
        //     }
        // }

        ?>
        <section>
            <div class="containerIdentity">
                <h2>Bonjour Mr le directeur : <?= $_SESSION['userInfos']['firstname'] ?></h2>
                <div class="identity">
                    <div class="nameAccount">
                        <div class="divName">
                            <label for="accountLastname" id="labelLastname">Nom</label>
                            <div class="accountIdentity">
                                <input type="text" id="accountLastname" value="<?= $_SESSION['userInfos']['lastname'] ?>" readonly>
                            </div>
                        </div>
                        <div class="divName">
                            <label for="accountFirstname" id="labelFirstname">Prénom</label>
                            <div class="accountIdentity">
                                <input type="text" id="accountFirstname" value="<?= htmlspecialchars($_SESSION['userInfos']['firstname'], ENT_QUOTES) ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <label for="accountAdress">Adresse</label>
                    <div class="accountIdentity">
                        <input type="text" id="accountAdress" value="<?= htmlspecialchars($_SESSION['userInfos']['address'], ENT_QUOTES) ?>" readonly>
                    </div>

                    <label for="accountEmail">Mail</label>
                    <div class="accountIdentity">
                        <input type="email" id="accountEmail" value="<?= htmlspecialchars($_SESSION['userInfos']['mail'], ENT_QUOTES) ?>" readonly>
                    </div>

                    <label for="accountTel">Numéro de téléphone</label>
                    <div class="accountIdentity">
                        <input type="tel" id="accountTel" value="<?= htmlspecialchars($_SESSION['userInfos']['phone'], ENT_QUOTES) ?>" readonly>
                    </div>
                </div>

                <div class="modification">
                    <form method="POST">
                        <label for="modify"></label>
                        <input type="submit" id="modify" name="modify" value="Modifier vos coordonnées" class='modification_user' />
                    </form>

                    <form method='POST'>
                        <label for='deconnexion'></label>
                        <input type='submit' id='deconnexion' name='deconnexion' value='Se déconnecter' class='modification_user' />
                    </form>

                    <form method='POST'>
                        <label for='supprimer'></label>
                        <input type='submit' id='supprimer' name='supprimer' value='Supprimer mon compte' class='modification_user' />
                    </form>
                </div>
            </div>

            <div class="BDD">

                <!-- <form method='POST'>
                    <label for='add'></label>
                    <button type='submit' id='add' name='add' class='modification_user'>Ajouter un produit</button>
                </form> -->

                <button class='modification_user'>Supprimer un produit</button>
                <button class='modification_user'>Modifier l'agenda</button>
                <button class='modification_user'>Modifier les horaires d'ouverture</button>
                <button class='modification_user'>Gestion des offres</button>
                <button class='modification_user'>Mailling client</button>
                <button class='modification_user'>Horaire d'ouverture</button>
                <button class='modification_user software'>Connexion avec votre logiciel</button>

            </div>
            <div class="addProduct">

                <h2>Ajouter un produit</h2>
                <form action="" method="POST" enctype="multipart/form-data" class="formGlasseData">
                    <input type="hidden" name="glasseData" value="glasseData">

                    <label for="brand">Choisir une marque :</label>
                    <select name="brand" id="brand">
                        <?php
                        $marques = displayBrand();
                        foreach ($marques as $marque) {
                            echo "<option value=\"" . strtolower(htmlspecialchars($marque['brand'])) . "\">" . htmlspecialchars($marque['brand']) . "</option>";
                        }
                        ?>
                    </select>

                    <label for="category">Choisir une catégorie :</label>
                    <select name="category" id="category">
                        <option value="solaires">Solaire</option>
                        <option value="optiques">Optique</option>
                    </select>

                    <label for="gender">Choisir un genre :</label>
                    <select name="gender" id="gender">
                        <option value="hommes">Homme</option>
                        <option value="femmes">Femme</option>
                        <option value="enfants">Enfant</option>
                        <option value="mixte">Mixte</option>
                    </select>

                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" require>

                    <label for="price">Prix</label>
                    <input type="text" name="price" id="price" require>

                    <label for="color">Couleur</label>
                    <input type="text" name="color" id="color" require>

                    <label for="image">Choisissez une image :</label>
                    <input type="file" name="image" id="image" require>

                    <label for="matter">Matière</label>
                    <input type="text" name="matter" id="matter" require>

                    <label for="shape">Forme</label>
                    <input type="text" name="shape" id="shape" require>

                    <label for="stock">Stock</label>
                    <input type="text" name="stock" id="stock" require>

                    <!-- <button type="submit" class="btnAddProduct">Envoyer</button> -->
                    <button type="submit" class="btnAdmin">Envoyer</button>
                </form>
                <?php ajoutLunette(); ?>
            </div>
    </main>


    <script src="assets/JS/accountADMIN.js"></script>
</body>
<?php include __DIR__ . '/../templates/footer.php' ?>

</html>