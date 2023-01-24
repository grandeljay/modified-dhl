<?php

/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

$file_name    = '/' . DIR_ADMIN . 'includes/javascript/grandeljaydhl.js';
$file_path    = DIR_FS_CATALOG .  $file_name;
$file_version = hash_file('crc32c', $file_path);
$file_url     = $file_name . '?v=' . $file_version;
?>
<script type="text/javascript" src="<?= $file_url ?>" defer></script>
