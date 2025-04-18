<header>
   <div class="smartphone-header">
      <div class="header-container">
         <div class="headerDiv">
            <a href="/"><img src="/./assets/img/logo/logo-magasin.png" alt="shop logo" id="logo" /></a>
         </div>
         <div class="headerDiv">
            <i class="bi bi-list" id="bi-list"></i>
         </div>
         <div class="headerDiv">
            <div class="logoCartBurger">
               <a href="cart"><i class="bi bi-basket3-fill logoNavCart"></i></a>
               <div class="nbrArticleBurger"></div>
            </div>
         </div>
      </div>
      <div class="burger-menu">
         <div class="searchContainerBtn">
            <form action="searchKeyWord" method="GET">
               <input
                  type="search"
                  id="site-search-burger"
                  name="search"
                  placeholder="rechercher...." />

               <button class="searchButton" type="submit">
                  <img
                     src="/./assets/img/icons8-loupe-40.png"
                     alt="search_logo"
                     class="searchLogo" />
               </button>
            </form>
         </div>
         <a href="agenda">
            <p>rendez-vous</p>
         </a>
         <a href="glasses">
            <p>Guide pratique</p>
         </a>
         <a href="shop">
            <p>Le magasin</p>
         </a>
         <a href="gallerie">
            <p>Gallerie</p>
         </a>
         <a href="frams">
            <p>Lunettes</p>
         </a>
         <a href="contactLenses">
            <p>lentilles</p>
         </a>
         <a href="inscription">
            <p>Compte</p>
         </a>
      </div>
   </div>

   <div class="menuContainer">
      <div id="containerLogo">
         <a href="/"><img src="/./assets/img/logo/logo-magasin.png" alt="logo du magasin La lunneterie Senlisienne" id="logo" /></a>
      </div>
      <div class="containerMenu">
         <div class="menu">
            <nav class="spans">
               <a href="shop" class="navLink">Le magasin</a>
               <a href="agenda" class="navLink">Rendez-vous</a>
               <a href="glasses" class="navLink"> Guide pratique</a>
               <a href="frams" class="navLink">Lunettes</a>
               <a href="contactLenses" class="navLink"> Lentilles</a>
               <a href="gallerie" class="navLink"> Gallerie</a>
            </nav>
            <div class="searchAccount">
               <div class="account">
                  <div class="searchContainer">
                     <div class="searchContainerLogo">
                        <?php
                        if (!empty($_SESSION['userInfos'])) {
                           if ($_SESSION['userInfos']['id_role'] == 2) {
                              echo  "<a href='inscription'> <i class='bi bi-person-check' style='color:green'></i></a>";
                           } else {
                              echo  "<a href='inscription'> <i class='bi bi-person-check' style='color:red'></i></a>";
                           }
                        } else {
                           echo " <a href='inscription'><i class='bi bi-person'></i></a>";
                        }
                        ?>
                        <div class="logoCart">
                           <a href="cart"><i class="bi bi-cart3 logoNavCart"></i></i></a>
                           <div class="nbrArticle"></div>
                        </div>

                     </div>
                     <div class="searchContainerBtn">
                        <form action="searchKeyWord" method="GET">
                           <input
                              type="search"
                              id="site-search"
                              name="search"
                              placeholder="rechercher...." />

                           <button class="searchButton" type="submit">
                              <img
                                 src="/./assets/img/icons8-loupe-40.png"
                                 alt="search_logo"
                                 class="searchLogo" />
                           </button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script defer>
      const biList = document.getElementById("bi-list");
      const burgerMenu = document.querySelector(".burger-menu");

      biList.addEventListener("click", () => {
         biList.classList.toggle("open");
         burgerMenu.classList.toggle("open");
      });

      // Récupérer les cartes stockées dans localStorage afin de mettre à jour l'affiche du nbr d'article ds le panier
      let totalInCart = JSON.parse(localStorage.getItem("totalInCart")) || [];

      // Afficher le nbr d'article dans le logo panier header laptop et tablette/smartphone
      document.querySelector(".nbrArticle").innerHTML = totalInCart;
      document.querySelector(".nbrArticleBurger").innerHTML = totalInCart;
   </script>
</header>