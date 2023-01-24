/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

"use strict";

document.addEventListener('DOMContentLoaded', function() {
    const OPTION_NATIONAL_COSTS = 'MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COSTS';

    let input_pricing_national = document.querySelector('input[name="configuration[' + OPTION_NATIONAL_COSTS + ']"]');
    let dialog_pricing_national = document.querySelector('dialog#' + OPTION_NATIONAL_COSTS);

    /**
     * Input
     */
    input_pricing_national.setAttribute('readonly', 'readonly');
    input_pricing_national.addEventListener('focus', function () {
        this.blur();

        dialog_pricing_national.showModal();
    });

    /**
     * Add new row
     */
    let template_row = document.querySelector('template#grandeljaydhl_row');
    let button_add = document.querySelector('button[name="grandeljaydhl_add"]');

    button_add.addEventListener('click', function() {
        this.closest('.row').before(
            template_row.content.cloneNode(true)
        );
    });

    /**
     * Form submit
     */
    let form_module = document.querySelector('form[name="modules"');

    form_module.addEventListener('submit', function(event) {
        /** Disable module form submission on dialog close */
        if (event.submitter.getAttribute('name').includes('grandeljaydhl')) {
            event.preventDefault();

            let close_modal = [
                'grandeljaydhl_cancel',
                'grandeljaydhl_apply',
            ];

            if (close_modal.includes(event.submitter.getAttribute('name'))) {
                dialog_pricing_national.close();
            }
        }

        /** Apply values to original input field */
        if ('grandeljaydhl_apply' === event.submitter.getAttribute('name')) {
            let national_costs = {};

            dialog_pricing_national.querySelectorAll('.container > .row').forEach(row => {
                let input_weight = row.querySelector('.column .weight');
                let input_cost = row.querySelector('.column .cost');

                if (!input_weight || !input_cost) {
                    return;
                }

                let weight = input_weight.value;
                let cost = input_cost.value;

                if (!weight || !cost) {
                    return;
                }

                national_costs[weight] = cost;
            });

            input_pricing_national.value = JSON.stringify(national_costs);
        }
    });
});
