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

    OPTIONS.every(function(OPTION) {
        expandInputToPopup(OPTION);

        return true;
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
        let input_json     = [];
        let input_required = [];

        let rows = Array.from(dialog.querySelectorAll('.container > .row'));

        switch (option) {
            case 'MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COSTS':
                input_required = [
                    'weight',
                    'cost'
                ];
                break;

            case 'MODULE_SHIPPING_GRANDELJAYDHL_SURCHARGES':
                input_required = [
                    'surcharge',
                    'type'
                ];
                break;
        }

        rows.every(function(row) {
            let row_values = {};
            let row_inputs = Array.from(row.querySelectorAll('.column > [name]'));
            let row_add    = row_inputs.every(function(element) {
                let element_name = element.getAttribute('name');

                /** Skip rows with empty required fields */
                if (input_required.includes(element_name)) {
                    if (!element.value) {
                        return false;
                    }
                }

                /** Assign values */
                row_values[element_name] = element.value;

                return true;
            });

            if (
                   row_add
                && row_values
                && Object.keys(row_values).length > 0
            ) {
                input_json.push(row_values);
            }

            return true;
        });

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
