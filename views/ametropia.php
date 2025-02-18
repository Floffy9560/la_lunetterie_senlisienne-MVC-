<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Amétropie</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="/assets/css/headerFooter.css" />
  <link rel="stylesheet" href="/amétropia.html" />
</head>

<body>
  <header>
    <div class="burgerMenu">
      <div class="smartphoneHeader">
        <div id="containerLogo">
          <a href="/index.html"><img
              src="/assets/img/logo magasin.png"
              alt="shop logo"
              id="logo" /></a>
        </div>
        <label for="toggle" id="label">☰</label>
        <div class="account">
          <img src="/assets/img/icons8-panier-40.png" alt="cart" id="kart" />
        </div>
      </div>
      <input type="checkbox" id="toggle" />
      <div class="main_pages">
        <a href="#">Prendre rendez-vous</a>
        <a href="/shop.html">Le magasin</a>
        <a href="/frams.html">Lunettes</a>
        <a href="/contactLenses.html">lentilles</a>
        <a href="/glasses.html">Guide pratique</a>
        <a href="/glasses.html">Compte</a>
      </div>
    </div>
    <div class="menuContainer">
      <div id="containerLogo">
        <a href="/index.html"><img src="/assets/img/logo magasin.png" alt="shop logo" id="logo" /></a>
      </div>
      <div class="containerMenu">
        <div class="menu">
          <div class="spans">
            <a href="/shop.html" class="navLink">Le magasin</a>

            <a href="/agenda.html" class="navLink">Prendre rendez-vous</a>

            <a href="/glasses.html" class="navLink"> Guide pratique</a>
          </div>
          <div class="searchContainer">
            <input
              type="search"
              id="site-search"
              name="rechercher"
              placeholder="Rechercher...." />
            <button>
              <img
                src="/assets/img/icons8-loupe-40.png"
                alt="shop logo"
                id="searchLogo"
                width="25px"
                height="50%" />
            </button>
          </div>
        </div>
        <div class="menu">
          <div class="spans">
            <a href="/frams.html" class="navLink">Lunettes</a>
            <a href="/contactLenses.html" class="navLink"> Lentilles</a>
            <a href="/inscription.html" class="navLink">Compte</a>
          </div>
          <div class="account">
            <img
              src="/assets/img/icons8-panier-40.png"
              alt="cart"
              id="kart"
              class="logoNav" /><img
              src="/assets/img/icons8-facebook-nouveau-40.png"
              alt="facebook"
              class="logoNav" />
            <img
              src="/assets/img/icons8-insta-40.png"
              alt="instagram"
              class="logoNav" />
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="name">
    <h1>La lunetterie Senlisienne</h1>
  </div>
  <main></main>

  <footer>
    <div class="container-footer">
      <div class="contact">
        <p>Contact :</p>
        <p>Numéro de tèl : 0344856594</p>
        <p>Mail : LalunetterieSenlisienne@orange.fr</p>
      </div>
      <div class="links-footer">
        <a href="/frams.html" class="navLink">Lunettes</a>
        <a href="/contactLenses.html" class="navLink">Lentilles</a>
        <a href="/agenda.html" class="navLink">Prendre RDV</a>
      </div>
      <div class="container-follow">
        <div class="follow">
          <img src="/assets/img/icons8-insta-50.png" alt="insta" />
          <img
            src="/assets/img/icons8-facebook-nouveau-50.png"
            alt="facebook" />
        </div>
        <div class="copyright">
          <img
            src="/assets/img/icons8-copyright-40.png"
            alt="copyright"
            id="copyrightLogo" />
          <a href="#" class="navLink">Mentions légales</a>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>