<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Découvrez La Lunetterie Senlisienne, votre opticien expert en montures tendances et sur-mesure à Senlis.">

    <title>La lunetterie Senlisienne</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/headerFooter.css" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php include 'templates/header.php'; ?>

<body>

    <!-- <div class="name">
        <h1>La lunetterie Senlisienne</h1>
    </div> -->

    <!---------------------------------------- section main sous le header avec 3 photos * nom du de l'enseigne--------------------->


    <section class="entete">
        <div class="overlayEntete"></div>
        <div class="name">
            <h1>Bienvenue à la : <br> lunetterie Senlisienne</h1>
        </div>
        <div class="container_guide">

            <!-- <div class="post-it">

                <div class="scotch"></div>
                <img
                    src="assets/img/magasin/table-de-vente.jpg"
                    alt="Le magasin "
                    class="guide_img" />
                <a href="shop">
                    <p class="guide-text">Le magasin</p>
                </a>

            </div>

            <div class="post-it">
                <div class="scotch"></div>

                <img
                    src="assets/img/entretien-lunettes-en-corne-astuces-essentielles-1708421620.jpg"
                    alt="Bien choisir ses lunettes"
                    class="guide_img" />
                <a href="glasses">
                    <p class="guide-text">Guide pratique</p>
                </a>
            </div> -->

            <!-- <div class="post-it"> -->
            <!-- <div class="scotch"></div>

                <img
                    src="assets/img/sur-mesure2.jpg"
                    alt="examen_de_vue"
                    class="guide_img" />
                <a href="custom_made">
                    <p class="guide-text">Le sur-mesure</p>
                </a> 
             </div> -->

            <div class="horaires">

                <p>Le magasin vous accueil dans une ambiance chaleureuse le :</p>
                <table>
                    <tr>
                        <th>lundi</th>

                        <td colspan="2">
                            <span>Seulement sur rendez-vous</span>

                        </td>
                    </tr>
                    <tr>
                        <th>mardi</th>
                        <td colspan="2">
                            <span>09h30-13h00</span>
                            <span> 14h00-19h00</span>
                        </td>
                    </tr>
                    <tr>
                        <th>mercredi</th>
                        <td colspan="2">
                            <span>09h30-13h00</span>
                            <span> 14h00-19h00</span>
                        </td>
                    </tr>
                    <tr>
                        <th>jeudi</th>
                        <td colspan="2">
                            <span>09h30-13h00</span>
                            <span> 14h00-19h00</span>
                        </td>
                    </tr>
                    <tr>
                        <th>vendredi</th>
                        <td colspan="2">
                            <span>09h30-13h00</span>
                            <span> 14h00-19h00</span>
                        </td>
                    </tr>
                    <tr>
                        <th>samedi</th>
                        <td colspan="2">
                            <span>09h30-13h00</span>
                            <span> 14h00-18h00</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="informations">

                <p>11 Rue de l'Apport au Pain, 60300 Senlis</p>
                <p>03 44 72 89 07</p>
                <p>Parking 1h gratuite à proximité</p>

            </div>

        </div>
    </section>
    <main>
        <!--- -------------1ere section : offer------------ --->
        <section class="container-offre">

            <a href="offers">
                <h2>Offre du magasin</h2>
            </a>


            <div class="post-it-offre">
                <div class="scotch-offre"></div>
                <img
                    src="assets/img/offres/offre-tandem.jpg"
                    alt="offre"
                    class="photo_offre" />
            </div>
        </section>
        <!--- -------------2e section : les marques ------------ --->
        <section>

            <a href="brands">
                <h2>Nos marques</h2>
            </a>

            <div class="grid_container">

                <div class="photos-post-it2" id="friendly_frenchy">
                    <a href="brands">
                        <div class="scotch"></div>
                        <img
                            src="/assets/img//marques/Friendly-frenchy/plv/visuel-plv-quatro-pm-friendly-frenchy-mai-23.jpg"
                            alt="friendly_frenchy" />
                        <p><b>Friendly_Frenchy</b></p>
                    </a>
                </div>
                <div class="photos-post-it" id="woodys"><a href="brands">
                        <div class="scotch"></div>
                        <img src="/assets/img/marques/Woodyz/plv/WOODYS_ANIMA_JUNEE.jpg" alt="woodys" />
                        <p><b>Woodys</b></p>
                    </a>
                </div>
                <div class="photos-post-it2" id="brique"><a href="brands">
                        <div class="scotch"></div>
                        <img src="/assets/img/marques/brique-et-violette/plv/brique-et-violette-plv.jpg" alt="brique" />
                        <p><b>La brique et la violette</b></p>
                    </a>
                </div>
                <div class="photos-post-it" id="sunday"><a href="brands">
                        <div class="scotch"></div>
                        <img src="/assets/img/marques/Sunday-Somewhere/plv/sunday-som-car.jpg" alt=" sunday-somewhere">
                        <p><b>Sunday somewhere</b></p>
                    </a>
                </div>
                <div class="photos-post-it2" id="Demetz"><a href="brands">
                        <div class="scotch"></div>
                        <img src="/assets/img/marques/Demetz/plv/demetz-plv.jpg" alt="Demetz" />
                        <p><b>Demetz</b></p>
                    </a>
                </div>
                <div class="photos-post-it" id="brett"><a href="brands">
                        <div class="scotch"></div>
                        <img src="/assets/img/marques/brett/plv/brett-porsche.jpg" alt="brett" />
                        <p><b>Brett</b></p>
                    </a>
                </div>
                <div class="photos-post-it" id="Minamoto"><a href="brands">
                        <div class="scotch"></div>
                        <img src="/assets/img/marques/Minamoto/plv/minamoto-plv.png" alt="Minamoto" />
                        <p><b>Minamoto</b></p>
                    </a>
                </div>
                <div class="photos-post-it2" id="Paprika"><a href="brands">
                        <div class="scotch"></div>
                        <img src="/assets/img/marques/Paprika/plv/visuel-plv-optique-panthere-pm-paprika.jpg" alt="Paprika" />
                        <p><b>Paprika</b></p>
                    </a>
                </div>
                <div class="photos-post-it2" id="MALT"><a href="brands">
                        <div class="scotch"></div>
                        <img src="/assets/img/marques/Malt/plv/plv-optique-homme-malt-2023.jpg" alt="MALT" />
                        <p><b>MALT</b></p>
                    </a>
                </div>
                <div class="photos-post-it" id="Clémence-&-Margaux"><a href="brands">
                        <div class="scotch"></div>
                        <img src="/assets/img/marques/Clémence-&-Margaux/plv/PLV-Margaux-et-Clemence.jpg" alt="Clémence & Margaux" />
                        <p><b>Clémence & Margaux</b></p>
                    </a>
                </div>
                <div class="photos-post-it2" id="Cazal"><a href="brands">
                        <div class="scotch"></div>
                        <img src="/assets/img/marques/Cazal/plv/cazal-plv.jpg" alt="Cazal" />
                        <p><b>Cazal</b></p>
                    </a>
                </div>
                <div class="photos-post-it" id="Aponem"><a href="brands">
                        <div class="scotch"></div>
                        <img src="/assets/img/marques/Aponem/plv/plv-aponem.jpeg" alt="Aponem" />
                        <p><b>Aponem</b></p>
                    </a>
                </div>
                <div class="photos-post-it" id="bali"><a href="brands">
                        <div class="scotch"></div>
                        <img src="/assets/img/marques/Bali/plv/plv2-bali.jpeg" alt="bali" />
                        <p><b>Bali</b></p>
                    </a>
                </div>
                <div class="photos-post-it2" id="Andy-brook"><a href="brands">
                        <div class="scotch"></div>
                        <img src="/assets/img/marques/Andy-brook/plv/plv-andy-brook.jpg" alt="Andy brook" />
                        <p><b>Andy brook</b></p>
                    </a>
                </div>
            </div>

        </section>
        <!--- -------------3e section : le sur mesrure------------ --->
        <section>
            <a href="custom_made.php">
                <h2>Le sur-mesure</h2>
            </a>
            <div class="container-section">

                <div class="post-it-custom_made_img">
                    <div class="scotch-custom-made-img"></div>

                    <img src="assets/img/sur-mesure2.jpg" alt="gab's atelier" />
                    <p>
                        Le sur-mesure, est l'art de rendre un objet unique. L’alliance de
                        savoir faire et de technicité dont la finalité est la conception
                        d’un produit aux propriétés exclusives. Du visagisme à la
                        fabrication, en passant par des mesures précises, du dessin, des
                        échanges, nos lunettes sont le fruit d’un travail conjoint entre
                        l’artisan et le porteur.
                    </p>
                </div>
            </div>
        </section>
    </main>

    <?php if (isset($_SESSION['flash'])): ?>
        <script>
            Swal.fire({
                title: "<?= $_SESSION['flash']['type'] === 'success' ? 'Succès !' : 'Erreur' ?>",
                text: "<?= $_SESSION['flash']['message'] ?>",
                icon: "<?= $_SESSION['flash']['type'] ?>",
                confirmButtonColor: "#c89f36",
                customClass: {
                    popup: "custom-swal",
                    confirmButton: "custom-confirm-btn",
                }
            });
            // Une fois le message affiché, on supprime le flash de la session pour éviter qu'il ne se répète
            <?php unset($_SESSION['flash']); ?>
        </script>
    <?php endif; ?>

    <script>
        function hasCookieConsentExpired() {
            const consentTimestamp = localStorage.getItem("cookiesConsentTimestamp");
            if (!consentTimestamp) return true;

            const now = Date.now();
            const ninetyDays = 60 * 60 * 1000;
            return now - parseInt(consentTimestamp) > ninetyDays;
        }

        document.addEventListener("DOMContentLoaded", () => {
            const cookiesChoice = localStorage.getItem("cookiesChoice");

            if (!cookiesChoice || hasCookieConsentExpired()) {
                Swal.fire({
                    title: "🍪 Cookies",
                    text: "Ce site utilise des cookies pour améliorer votre expérience. Acceptez-vous ?",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonText: "J'accepte",
                    cancelButtonText: "Je refuse",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    reverseButtons: true,
                    customClass: {
                        popup: "custom-swal",
                        confirmButton: "custom-confirm-btn",
                        cancelButton: "custom-cancel-btn",
                        icon: "custom-icon"
                    }
                }).then((result) => {
                    const timestamp = Date.now();
                    if (result.isConfirmed) {
                        localStorage.setItem("cookiesChoice", "accepted");
                        localStorage.setItem("cookiesConsentTimestamp", timestamp);
                        // Place ici les fonctions qui nécessitent des cookies
                    } else {
                        localStorage.setItem("cookiesChoice", "refused");
                        localStorage.setItem("cookiesConsentTimestamp", timestamp);
                    }
                });
            }
        });
    </script>

</body>

<?php include 'templates/footer.php'; ?>

<div id="cookie-banner" class="cookie-banner hidden">
    <p>Ce site utilise des cookies pour vous garantir la meilleure expérience.</p>
    <button id="accept-cookies">Accepter</button>
</div>

</html>