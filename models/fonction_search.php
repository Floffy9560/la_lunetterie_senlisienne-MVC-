<?php
// Fonction pour rechercher un mot clef sur le site 

function searchInPHPFiles($dir, $search)
{
      $results = [];

      // Récupère tous les fichiers PHP dans le dossier "views"
      $files = glob($dir . "/*.php");

      foreach ($files as $file) {
            // Lit le contenu du fichier
            $content = file_get_contents($file);
            // Recherche insensible à la casse
            if (stripos($content, $search) !== false) {
                  $results[] = $file;
            }
      }
      return $results;
}
