<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscription | Créez un compte chez Lunetterie Senlisienne</title>
    <meta name="description" content="Créez votre compte pour profiter des meilleures offres de la Lunetterie Senlisienne. Commandez en ligne et suivez vos achats facilement.">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/headerFooter.css" />
    <link rel="stylesheet" href="assets/css/inscription.css" />
</head>

<?php include_once 'templates/header.php'; ?>

<body>

    <!-- ------------------------------------------------------>
    <!--------------- formulaire d'inscription----------------->
    <!-- ------------------------------------------------------>

    <main>
        <h1>Inscription à Lunetterie Senlisienne</h1>
        <div class="formulaire">
            <div class="connection">
                <h2>Déjà client ?</h2>

                <!-- ----------------------------------------------------------------------------------------->
                <!-- ------------------ Si client : proposer de rentré ses identifiant------------------------>
                <!-- ----------------------------------------------------------------------------------------->

                <form method="POST" action="account">
                    <div class="form_connection">
                        <div><?php
                                if (!empty($_SESSION['verificationFalse'])) {
                                    echo "<p style='color:red; text-align:center'>⚠️<strong>Mot de passe ou adresse mail invalide</strong>⚠️</p>";
                                }
                                if (!empty($_SESSION['success'])) {
                                    echo "<p style='color:green'>" . $_SESSION['success'] . "</p>";
                                    unset($_SESSION['verificationFalse']);
                                }

                                ?></div>
                        <div class="mailCustomer">
                            <p id="emailCustomerTcheck"><i class="bi bi-check-circle-fill"></i></p>
                            <label for="customerMail" id="labelCustomerMail">Email invalide ! veuillez saisir le format : exemple@exemple.fr</label>
                            <input
                                type="email"
                                id="customerMail"
                                name="customerMail"
                                placeholder="Adresse mail"
                                class="input"
                                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                                autocomplete="email"
                                title="Veuillez renseigner un email valide" required />
                        </div>

                        <div class="passwordCustomer">
                            <p id="passwordCustomerTcheck"><i class="bi bi-check-circle-fill"></i></p>
                            <label for="passwordCustomer" id="labelPasswordCustomer">(min 8 caractères : 1 maj : 1min : 1 chiffre : 1 caractère special)</label>
                            <input
                                type="password"
                                id="passwordCustomer"
                                name="passwordCustomer"
                                placeholder="Mot de passe"
                                class="input"
                                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$" required />
                            <i class='bi bi-eye-slash-fill' id="closeEyeCustomer"></i>
                            <i class="bi bi-eye-fill" id="eyeCustomer" aria-label="Afficher le mot de passe"></i>
                        </div>
                    </div>
                    <a href="mail_controlle" id="passwordLost">Mot de passe oublié</a>
                    <div class="button">
                        <button type="submit" class="btnSubmit" id="submitCustomer">Se connecter</button>
                    </div>
                </form>

                <div class="consignes">
                    <ul>
                        <li><b>Consignes :</b></li>
                        <li>Le mot de passe doit contenir au moins 1 majuscule 1 minuscule 1 caractère spécial (&-+!*$@%_) et 1 nombre </li>
                        <li>Le mail doit être comme l'exemple ci-contre : exemple@exemple.fr</li>
                    </ul>
                </div>
            </div>

            <div class="inscription">
                <h2>Nouveau client ?</h2>
                <!-- --------------------------------------------------------------------------------------->
                <!-- -------------------- Si pas client proposer une inscription---------------------------->
                <!-- --------------------------------------------------------------------------------------->
                <form method="POST" action="account">
                    <div class="form_inscription">

                        <div class="civility_container">

                            <h3>Civilité :</h3>
                            <div class="civility_choice">
                                <input
                                    type="radio"
                                    name="civility"
                                    value="Mme"
                                    class="civility" id="civilityMme" required />
                                <label for="civilityMme">Mme</label>

                            </div>
                            <div class="civility_choice">
                                <input
                                    type="radio"
                                    name="civility"
                                    value="Mr"
                                    class="civility" id="civilityMr" required />
                                <label for="civilityMr">Mr</label>
                            </div>
                            <div class="civility_choice">
                                <input
                                    type="radio"
                                    name="civility"
                                    class="civility" id="civilityOther" required />
                                <label for="civilityOther">Autre</label>
                            </div>
                        </div>

                        <div class="containerIdentity">

                            <div class="lastname">
                                <p id='lastname-tcheck'><i class="bi bi-check-circle-fill"></i></p>
                                <label for="lastname" id='labelLastname'>Veuillez saisir que des lettres</label>
                                <input
                                    type="text"
                                    name="lastname"
                                    placeholder="Nom"
                                    class="inputCivilityName"
                                    id="lastname"
                                    pattern="^[A-ZÀÂÄÆÇÉÈÊËÎÏÔÖŒÙÛÜŸa-zàâäæçéèêëîïôöœùûüÿ' -]{2,50}$" minlength="2" required />
                            </div>

                            <div class="firstname">
                                <p id='firstname-tcheck'><i class="bi bi-check-circle-fill"></i></p>
                                <label for="firstname" id='labelFirstname'>Veuillez saisir que des lettres</label>
                                <input
                                    type="text"
                                    name="firstname"
                                    placeholder="Prénom"
                                    class="inputCivilityName"
                                    id="firstname" />
                            </div>

                        </div>

                        <div class="email">
                            <p id="email-tcheck"><i class="bi bi-check-circle-fill"></i></p>
                            <label for="email" id="labelEmail">Email invalide ! veuillez saisir le format : exemple@exemple.fr</label>
                            <input
                                type="email"
                                name="email"
                                placeholder="Adresse mail"
                                class="input"
                                id="email"
                                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                                autocomplete="email"
                                minlength="2" title="Veuillez renseigner un email valide" required />
                        </div>

                        <div class="postal-adress">
                            <p id="postal-adress-tcheck"><i class="bi bi-check-circle-fill"></i></p>
                            <label for="adressT" id="labelAdress">Veuillez saisir une adresse valide svp</label>
                            <textarea
                                name="postal_adress"
                                placeholder="Adresse postale"
                                class="input"
                                id="adressT"
                                required></textarea>
                        </div>

                        <div class="password">
                            <p id="password-tcheck"><i class="bi bi-check-circle-fill"></i></p>
                            <label for="password" id="labelPassword">(min 8 caractères : 1 maj : 1min : 1 chiffre : 1 caractère special)</label>
                            <input
                                type="password"
                                name="password"
                                placeholder="Mot de passe"
                                class="input"
                                id="password"
                                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$"
                                autocomplete="current-password"
                                required />
                            <i class='bi bi-eye-slash-fill' id="closeEye"></i>
                            <i class="bi bi-eye-fill" id="eye" aria-label="Afficher le mot de passe"></i>
                        </div>

                        <div class="birth">
                            <label for="days"></label>
                            <select name="days" id="days" required>
                                <option value="">Jour</option>
                                <?php
                                for ($i = 1; $i < 32; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>

                            <label for="month"></label>
                            <select name="month" id="month" required>
                                <option value="">Mois</option>
                                <option value="janvier">janvier</option>
                                <option value="février">février</option>
                                <option value="mars">mars</option>
                                <option value="avril">avril</option>
                                <option value="mais">mais</option>
                                <option value="juin">juin</option>
                                <option value="juillet">juillet</option>
                                <option value="aout">aout</option>
                                <option value="septembre">septembre</option>
                                <option value="octobre">octobre</option>
                                <option value="novembre">novembre</option>
                                <option value="décembre">décembre</option>
                            </select>

                            <label for="year"></label>
                            <select name="year" id="year" required>
                                <option value="">Année</option>
                                <?php
                                for ($i = 2025; $i >= 1924; $i--) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>

                        </div>

                        <h4>À quel numéro de téléphone le transporteur peut-il vous contacter ?</h4>

                        <div class="tel">
                            <p id="tel-tcheck"><i class="bi bi-check-circle-fill"></i></p>
                            <label for="tel" id='labelTel'>Veuillez saisir que des chiffres</label>
                            <input
                                type="tel"
                                id="tel"
                                name="tel"
                                placeholder="N° de téléphone"
                                class="inputTel"
                                pattern="^(?:\+33|0)(?:\s|-|\.)?[1-9](?:\s|-|\.|\d){8}$"
                                title="Ne saisir que des numéros" required />
                        </div>

                    </div>
                    <div class="confirmation_container">
                        <div class="confirmation_container_div">
                            <label for="confidentiality"></label>
                            <input
                                type="checkbox"
                                name="confidentiality"
                                value="confidentiality"
                                id="confidentiality"
                                class="confirmation" required />
                            <p> En cochant cette case, je confirme avoir pris connaissance de la
                                <a href="#">politique de confidentialité</a> et accepter les
                                <a href="#">CGV *</a>
                            </p>

                        </div>
                        <!-- <div class="confirmation_container_div">
                            <input
                                type="checkbox"
                                name="confidentiality"
                                value="confidentiality"
                                class="confirmation" />
                            <p>J’accepte de recevoir de la part de <span>lunetterie Senlisienne</span>,
                                des offres commerciales par mail et par sms portant sur des
                                produits et/ou services d’optique et de contactologie.</p>
                        </div>
                        <div class="confirmation_container_div">
                            <input
                                type="checkbox"
                                name="commercial_offers"
                                value="commercial_offers"
                                class="confirmation" />
                            <p>J’accepte de recevoir de la part de
                                <span>lunetterie Senlisienne</span> des offres commerciales par mail et
                                par sms portant sur des produits d’optique, de contactologie et
                                d’audiologie.
                            </p>

                        </div>
                    </div>
                    <p>
                        En créant un compte en ligne, vous êtes informé(e) que
                        <span>lunetterie Senlisienne</span>, en tant que responsable de
                        traitement, traite les données recueillies sur ce formulaire afin
                        notamment de créer votre compte, gérer vos commandes et si vous y
                        avez spécifiquement consenti, vous adresser des offres
                        personnalisées. Pour en savoir plus sur la gestion de vos données
                        personnelles et pour exercer vos droits, reportez-vous à notre
                        politique de confidentialité.
                    </p>
                    <p>
                        *La communication des informations marquées d’un astérisque est
                        obligatoire, à défaut vous ne pourrez pas valider le formulaire. En
                        créant un compte en ligne, vous êtes informé(e) que
                        <b>lunetterie Senlisienne</b>, en tant que responsable de
                        traitement, traite les données recueillies sur ce formulaire afin
                        notamment de créer votre compte, gérer vos commandes et si vous y
                        avez spécifiquement consenti, vous adresser des offres
                        personnalisées. Pour en savoir plus sur la gestion de vos données
                        personnelles et pour exercer vos droits, reportez-vous à notre
                        politique de confidentialité.
                    </p> -->
                        <div class="button">
                            <button type="submit" class="btnSubmit" id="submit">S'inscrire</button>
                        </div>
                </form>
            </div>
        </div>
    </main>
    <script src="/assets/JS/inscription.js" defer></script>
</body>
<?php include_once 'templates/footer.php'; ?>

</html>