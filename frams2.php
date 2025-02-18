<?php

include __DIR__ . '/assets/datas/glasses.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <style>
            * {
                  margin: 0;
                  padding: 0;
                  box-sizing: border-box;
            }

            body {
                  width: 100%;
            }

            .container-cards {
                  width: 100%;
                  display: flex;
                  justify-content: center;
                  flex-wrap: wrap;
                  margin: auto;


            }

            .cards {
                  width: 300px;
                  margin: 15px;
                  border: 1px solid #ccc;
                  padding: 20px;
                  text-align: left;
                  box-shadow: 5px 5px 5px black;
            }

            .image {
                  width: 100%;
            }

            .image img {
                  width: 100%;

            }
      </style>
</head>

<body>
      <a href="account2.php">account 2</a>
      <div class="container-cards">
            <?php
            foreach ($glasses as $glasses) {

                  echo '
            <form method="get">
                  <div class="cards">
                        <div class="image">
                              <img src=' . $glasses['image'] . ' alt="' . $glasses['name'] . '">
                        </div>
                        Nom : ' . $glasses['name'] . '<br>
                        Prix : ' . $glasses['price'] . '<br>
                        Couleur : ' . $glasses['color'] . '<br>
                        Matériau : ' . $glasses['matiere'] . '<br>
                        Genre : ' . $glasses['genre'] . '<br>
                        Forme : ' . $glasses['forme'] . '<br>
                        <form method="get">
                        <input type="hidden" name="id" value="' . $glasses['id'] . '">
                        <button type="submit">Ajouter au panier</button>
                        </form>
                  </div>
            </form>';
            }

            ?>
      </div>
</body>

</html>