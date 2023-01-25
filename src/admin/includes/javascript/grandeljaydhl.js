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
     * Form: Submit
     */
    let form_module = document.querySelector('form[name="modules"');

    form_module.addEventListener('submit', function(event) {
        /** Disable module form submission on dialog close */
        let input_submitter_name = event.submitter.getAttribute('name');

        if (input_submitter_name.includes('grandeljaydhl')) {
            event.preventDefault();

            let close_modal = [
                'grandeljaydhl_cancel',
                'grandeljaydhl_apply',
            ];

            if (close_modal.includes(input_submitter_name)) {
                dialog.close();
            }
        }

        /** Apply values to original input field */
        if ('grandeljaydhl_apply' === input_submitter_name) {
            let input_json = {};

            switch (option) {
                case 'MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COSTS':
                    dialog.querySelectorAll('.container > .row').forEach(row => {
                        let input_weight = row.querySelector('.column .weight');
                        let input_cost   = row.querySelector('.column .cost');

                        if (!input_weight || !input_cost) {
                            return;
                        }

                        let weight = input_weight.value;
                        let cost = input_cost.value;

                        if (!weight || !cost) {
                            return;
                        }

                        input_json[weight] = cost;
                    });
                    break;

                case 'MODULE_SHIPPING_GRANDELJAYDHL_SURCHARGES':
                    dialog.querySelectorAll('.container > .row').forEach(row => {
                        let input_surcharge = row.querySelector('.column .weight');
                        let input_cost   = row.querySelector('.column .cost');

                        if (!input_weight || !input_cost) {
                            return;
                        }

                        let weight = input_weight.value;
                        let cost = input_cost.value;

                        if (!weight || !cost) {
                            return;
                        }

                        input_json[weight] = cost;
                    });
                    break;
            }

            input.value = JSON.stringify(input_json);
        }
    });

    /**
     * Form: Close
     */
    let button_cancel = dialog.querySelector('button[name="grandeljaydhl_cancel"]');

    button_cancel.addEventListener('click', function() {
        dialog.close();
    });
}
