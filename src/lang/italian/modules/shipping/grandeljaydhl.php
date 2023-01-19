<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

$translations_general = array(
    /** Module */
    'TITLE'            => 'grandeljay - DHL',
    'LONG_DESCRIPTION' => 'Metodo di spedizione DHL',
    'STATUS_TITLE'     => 'Attivare il modulo?',
    'STATUS_DESC'      => 'Consente la spedizione tramite DHL.',

    /** Zones */
    'ZONES_TITLE'      => 'Numero di zone',
    'ZONES_DESC'       => 'Specifichi quante zone di spedizione diverse (regole speciali) devono essere disponibili. Quando si modifica questo valore, è necessario reinstallare il modulo. Non dimentichi di creare un backup e poi di ripristinare le impostazioni.',

    'ALLOWED_TITLE'    => 'Paesi consentiti',
    'ALLOWED_DESC'     => 'Inserisca un elenco di codici paese verso i quali la spedizione con DHL dovrebbe essere generalmente possibile (ad esempio DE, AT). Lasciare vuoto per attivare tutti.',

    'HANDLING_TITLE'   => 'Tassa di gestione',
    'HANDLING_DESC'    => 'Tassa di gestione di base per questo metodo di spedizione, che generalmente si applica a tutte le zone.',

    'COST_TITLE'       => 'Supplemento per KG',
    'COST_DESC'        => 'Il supplemento viene calcolato per ogni chilogrammo sulla tariffa di movimentazione. Specifichi il mark-up e il Peso massimo per il mark-up (ad esempio, "0,15:10, 0,20:20" per un mark-up da 0,15 a 10 kg, eccetera).',
);

/**
 * Zones
 */
require_once DIR_FS_DOCUMENT_ROOT . 'includes/modules/shipping/grandeljaydhl.php';

$grandeljaydhl = new grandeljaydhl();

$translations_zones = array();

for ($i = 1; $i <= $grandeljaydhl->getZonesCount(); $i++) {
    $translations_zones = array_merge(
        $translations_zones,
        array(
            /** Zones */
            'ALLOWED_' . $i . '_TITLE'  => sprintf('Zona %d - Paesi consentiti', $i),
            'ALLOWED_' . $i . '_DESC'   => 'Specifichi un elenco di codici paese per definire una regola speciale per questa zona.',

            /** Handling */
            'HANDLING_' . $i . '_TITLE' => sprintf('Zone %d - Bearbeitungsgebühr', $i),
            'HANDLING_' . $i . '_DESC'  => 'Specifichi una guida all\'elaborazione per questa zona, in modo da ignorare la regola generale.',
        ),
    );
}

/**
 * Define
 */
$translations = array_merge(
    $translations_general,
    $translations_zones,
);

foreach ($translations as $key => $value) {
    $constant = 'MODULE_SHIPPING_' . strtoupper(pathinfo(__FILE__, PATHINFO_FILENAME)) . '_' . $key;

    define($constant, $value);
}
