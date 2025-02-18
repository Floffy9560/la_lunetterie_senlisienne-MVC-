<?php

//fonction qui va créer une page avec un atribu "page=xxx.php" sous forme de formulaire avc la method GET 

function createPage($page)
{

      echo "<form  method='get'>
      <input type='hidden' name='page' value='$page'.php>
      <button type='submit'>
            <a href='$page'.php>
                  <img src='assets/img/icons8-panier-40.png'
                        alt='cart'
                        id='kart'
                        class='logoNav' />
            </a>
      </button>
</form>";
}

createPage($kart);
