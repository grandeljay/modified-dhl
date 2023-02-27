<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

if (rth_is_module_disabled('MODULE_SHIPPING_GRANDELJAYDHL')) {
    return;
}

/** Only enqueue JavaScript when module settings are open */
$grandeljayups_admin_screen = array(
    'set'    => 'shipping',
    'module' => grandeljaydhl::class,
    'action' => 'edit',
);

parse_str($_SERVER['QUERY_STRING'] ?? '', $query_string);

if ($query_string !== $grandeljaydhl_admin_screen) {
    return;
}

$file_name    = '/' . DIR_ADMIN . 'includes/javascript/grandeljaydhl.js';
$file_path    = DIR_FS_CATALOG .  $file_name;
$file_version = hash_file('crc32c', $file_path);
$file_url     = $file_name . '?v=' . $file_version;
?>
<script type="text/javascript" src="<?= $file_url ?>" defer></script>
