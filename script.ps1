$pages = @('acte_deces','acte_mariage','copie_acte_naissance','declaration_acte_naissance','extrait_naissance','reservation_date_mariage')

foreach ($page in $pages) {
    $commande = "php artisan make:filament-page $page`_livraison"
    Invoke-Expression $commande
}
