/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

"use strict";

document.addEventListener('DOMContentLoaded', function() {
    const OPTIONS = [
        'MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COSTS',
        'MODULE_SHIPPING_GRANDELJAYDHL_SURCHARGES',
    ];

    OPTIONS.forEach(OPTION => {
        expandInputToPopup(OPTION);
    });

    /** Make field read only */
    document
    .querySelector('input[name="configuration[MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COSTS]"]')
    .setAttribute('readonly', 'readonly');
});

function expandInputToPopup(option) {
    let input  = document.querySelector('input[name="configuration[' + option + ']"]');
    let dialog = document.querySelector('dialog#' + option);

    /**
     * Input
     */
    input.addEventListener('focus', function () {
        this.blur();

        dialog.showModal();
    });

    /**
     * Add new row
     */
    let template_row = dialog.querySelector('template#grandeljaydhl_row');
    let button_add   = dialog.querySelector('button[name="grandeljaydhl_add"]');

    button_add.addEventListener('click', function() {
        this.closest('.row').before(
            template_row.content.cloneNode(true)
        );
    });

    /**
     * Apply
     */
    let button_apply = dialog.querySelector('button[name="grandeljaydhl_apply"]');

    button_apply.addEventListener('click', function() {
        let input_json, input_required;

        switch (option) {
            case 'MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COSTS':
                input_json     = {};
                input_required = [
                    'weight',
                    'cost'
                ];

                dialog.querySelectorAll('.container > .row').forEach(row => {
                    row.querySelectorAll('.column > [name]').forEach(element => {
                        /** Skip rows with empty required fields */
                        if (input_required.includes(element.getAttribute('name'))) {
                            if (!element.value) {
                                return;
                            }
                        }

                        /** Assign values */
                        let weight = row.querySelector('.column [name="weight"]').value;
                        let cost   = row.querySelector('.column [name="cost"]').value;

                        input_json[weight] = cost;
                    });
                });
                break;

            case 'MODULE_SHIPPING_GRANDELJAYDHL_SURCHARGES':
                input_json     = [];
                input_required = [
                    'surcharge',
                    'type'
                ];

                dialog.querySelectorAll('.container > .row').forEach(row => {
                    row.querySelectorAll('.column > [name]').forEach(element => {
                        /** Skip rows with empty required fields */
                        if (input_required.includes(element.getAttribute('name'))) {
                            if (!element.value) {
                                return;
                            }
                        }

                        /** Assign values */
                        let name           = row.querySelector('.column [name="name"').value;
                        let surcharge      = row.querySelector('.column [name="surcharge"').value;
                        let type           = row.querySelector('.column [name="type"').value;
                        let duration_start = row.querySelector('.column [name="duration-start"').value;
                        let duration_end   = row.querySelector('.column [name="duration-end"').value;

                        input_json.push(
                            {
                                'name'           : name,
                                'surcharge'      : surcharge,
                                'type'           : type,
                                'duration_start' : duration_start,
                                'duration_end'   : duration_end,
                            }
                        );
                    });
                });
                break;
        }

        input.value = JSON.stringify(input_json);

        dialog.close();
    });

    /**
     * Cancel
     */
    let button_cancel = dialog.querySelector('button[name="grandeljaydhl_cancel"]');

    button_cancel.addEventListener('click', function() {
        dialog.close();
    });
}
