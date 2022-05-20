<?php
// facturation edition
function recup_paiement_edition($recup_id_user, $recup_id_payment)
{
global $connection;
$sql =
"SELECT *
FROM carts
INNER JOIN
products ON products.id_product = cart.id_product
WHERE id_user = $recup_id_user AND id_payment = $recup_id_payment";
$sth = $connection->prepare($sql);
$sth->execute();

$resultat = $sth->fetchAll(PDO::FETCH_OBJ);
//var_dump($resultat);

return $resultat;
}
?>