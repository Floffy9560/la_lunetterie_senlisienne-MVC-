<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Formulaire soumis en POST";
    var_dump($_POST);
} else {
    echo "Méthode de requête : " . $_SERVER['REQUEST_METHOD'];
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscription</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/headerFooter.css" />
    <link rel="stylesheet" href="assets/css/inscription.css" />
</head>

<?php include 'templates/header.php'; ?>

<body>

    <!-- ------------------------------------------------------>
    <!--------------- formulaire d'inscription----------------->
    <!-- ------------------------------------------------------>

    <main>
        <div class="formulaire">
            <div class="connection">
                <h2>Déja client ?</h2>

                <!-- ----------------------------------------------------------------------------------------->
                <!-- ------------------ Si client : proposer de rentré ses identifiant------------------------>
                <!-- ----------------------------------------------------------------------------------------->

                <form method="POST" action="account">
                    <div class="form_connection">
                        <p id="emailCustomerTcheck"><i class="bi bi-check-circle-fill"></i></p>
                        <label for="currentMail" id="labelCustomerMail">Email invalide ! veuillez saisir le format : exemple@exemple.fr</label>
                        <input
                            type="email"
                            id="currentMail"
                            name="currentMail"
                            placeholder="Adresse mail"
                            class="input"
                            pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                            autocomplete="email"
                            title="Veuillez renseigner un email valide" required />

                        <p id="currentPasswordCustomerTcheck"><i class="bi bi-check-circle-fill"></i></p>
                        <label for="currentPasswordCustomer" id="r">(min 8 caractères : 1 maj : 1min : 1 chiffre : 1 caractère special)</label>
                        <input
                            type="current-password"
                            id="currentPasswordCustomer"
                            name="currentPassword"
                            placeholder="Mot de passe"
                            class="input"
                            pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[&-+!*$@%_])([&-+!*$@%_\w]{8,15})$" required />
                        <i class='bi bi-eye-slash-fill-customer' id="closeEyeCustomer"></i>
                        <i class="bi bi-eye-fill-customer" id="eyeCustomer"></i>

                    </div>

                    <a href="#" id="passwordLost">Mot de passe oublié?</a>

                    <div class="button">
                        <button type="submit" class="btnSubmit" id="SubmitCustomer">Se connecter</button>
                    </div>
                </form>
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
                                <p id='labelLastname-tcheck'><i class="bi bi-check-circle-fill"></i></p>
                                <label for="lastname" id='labelLastname'>Veuillez saisir que des lettres</label>
                                <input
                                    type="text"
                                    name="lastname"
                                    placeholder="Nom"
                                    class="inputCivilityName"
                                    id="lastname"
                                    pattern="[A-Za-z]{3,}" minlength="2" required />
                            </div>

                            <div class="firstname">
                                <p id='labelFirstname-tcheck'><i class="bi bi-check-circle-fill"></i></p>
                                <label for="firstname" id='labelFirstname'>Veuillez saisir que des lettres</label>
                                <input
                                    type="text"
                                    name="firstname"
                                    placeholder="Prénom"
                                    class="inputCivilityName"
                                    id="firstname"
                                    pattern="[A-Za-z]{3,}" minlength="2" required />
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
                            <label for="currentPassword" id="labelPassword">(min 8 caractères : 1 maj : 1min : 1 chiffre : 1 caractère special)</label>
                            <input
                                type="password"
                                name="currentPassword"
                                placeholder="Mot de passe"
                                class="input"
                                id="currentPassword"
                                pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[&-+!*$@%_])([&-+!*$@%_\w]{8,15})$"
                                autocomplete="current-password"
                                required />
                            <i class='bi bi-eye-slash-fill' id="closeEye"></i>
                            <i class="bi bi-eye-fill" id="eye"></i>
                        </div>

                        <div class="birth">
                            <select name="days" id="days" required>
                                <option value="">Jours</option>
                                <?php
                                for ($i = 1; $i < 32; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>

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

                            <select name="year" id="year" required>
                                <option value="">Années</option>
                                <?php
                                for ($i = 2025; $i >= 1924; $i--) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>

                        </div>

                        <h5>À quel numéro de téléphone le transporteur peut-il vous contacter ?</i></h5>
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
                            <input
                                type="checkbox"
                                name="confidentiality"
                                value="confidentiality"
                                class="confirmation" required />
                            <p> En cochant cette case, je confirme avoir pris connaissance de la
                                <a href="#">politique de confidentialité</a> et accepter les
                                <a href="#">CGV *</a>
                            </p>

                        </div>
                        <div class="confirmation_container_div">
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
                    </p>
                    <div class="button">
                        <button type="submit" class="btnSubmit" id="submitNewCustomer">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="/assets/JS/inscription.js" defer></script>
</body>
<?php include 'templates/footer.php'; ?>

</html>