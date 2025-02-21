# la_lunetterie_senlisienne-MVC-

Utilisation de htaccess qui redirige tout les liens vers le routeur ainsi :

✅ Avantages :
✔️ URLs plus propres (ex: /profil/john au lieu de index.php?page=profil/john).
✔️ Meilleur pour le référencement (SEO).
✔️ Sécurise l'accès aux fichiers sensibles (on évite d'afficher l'arborescence réelle du projet).
✔️ Meilleure séparation entre la logique de réécriture et le code PHP.
📌 Quand utiliser .htaccess plutôt que index.php ?
🔹 Si tu veux des URLs propres et SEO-friendly (/profil/john au lieu de index.php?page=profil).
🔹 Si ton site est dynamique avec un grand nombre de pages (ex: site e-commerce, blog).
🔹 Si tu veux empêcher l'accès direct à certains fichiers sensibles.
🔹 Si tu veux gérer les erreurs 404 proprement et ne pas exposer les vrais chemins des fichiers.
✅ Conclusion : Si ton site est un projet sérieux, .htaccess + un routeur en PHP est la meilleure approche pour avoir un site propre, sécurisé et performant.

Comme le site devrait être mit en ligne j'ai préféré utiliser la méthode avec htaccess
