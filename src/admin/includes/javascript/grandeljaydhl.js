/**
 * DHL
 *
 * @author  Jay Trees <dhl@grandels.email>
 * @link    https://github.com/grandeljay/modified-dhl
 * @package GrandelJayDHL
 */

"use strict";

document.addEventListener('DOMContentLoaded', function() {
    const MODULE_NAME = 'MODULE_SHIPPING_GRANDELJAYDHL';
    const OPTIONS = [
        MODULE_NAME + '_SHIPPING_NATIONAL_COSTS',
        MODULE_NAME + '_SHIPPING_INTERNATIONAL_EXCEPTIONS_DATA',
        MODULE_NAME + '_SURCHARGES',
        MODULE_NAME + '_SURCHARGES_PICK_AND_PACK'
    ];

    OPTIONS.every(function(OPTION) {
        expandInputToPopup(OPTION);

        return true;
    });
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
        let content = template_row.content.cloneNode(true);

        this.closest('.row').before(content);

        verifySelectOptions(this.closest('.container'));
    });

    function verifySelectOptions(container) {
        let rows = Array.from(container.querySelectorAll('.row'));

        rows.every(function(row, row_index) {
            /**
             * Skip header row
             */
            let input = row.querySelector('input');

            if (!input) {
                return true;
            }

            row_index--;

            /**
             * Input first
             */
            let input_first               = row.querySelector('.cfg_select_option > input[type="radio"]:first-of-type');
            let input_first_value_target  = input_first.checked;

            /** ID */
            let input_first_id_current = input_first.getAttribute('id');
            let input_first_id_target  = 'cfg_so_k_per-package-' + row_index;

            if (input_first_id_current !== input_first_id_target) {
                input_first.setAttribute('id', input_first_id_target);
            }

            /** Name */
            let input_first_name_current = input_first.getAttribute('name');
            let input_first_name_target  = 'configuration[per-package-' + row_index + ']';

            if (input_first_name_current !== input_first_name_target) {
                input_first.setAttribute('name', input_first_name_target);
            }

            input_first.checked = input_first_value_target;

            /**
             * Label first
             */
            let label_first = row.querySelector('.cfg_select_option > label:first-of-type');

            /** For */
            let label_first_for_current = label_first.getAttribute('for');
            let label_first_for_target  = input_first_id_target;

            if (label_first_for_current !== label_first_for_target) {
                label_first.setAttribute('for', label_first_for_target);
            }

            /**
             * Input last
             */
            let input_last               = row.querySelector('.cfg_select_option > input[type="radio"]:last-of-type');
            let input_last_value_target  = input_last.checked;

            /** ID */
            let input_last_id_current = input_last.getAttribute('id');
            let input_last_id_target  = 'cfg_so_k_per-package-' + row_index + '_1';

            if (input_last_id_current !== input_last_id_target) {
                input_last.setAttribute('id', input_last_id_target);
            }

            /** Name */
            let input_last_name_current = input_last.getAttribute('name');
            let input_last_name_target  = input_first_name_target;

            if (input_last_name_current !== input_last_name_target) {
                input_last.setAttribute('name', input_last_name_target);
            }

            input_last.checked = input_last_value_target;

            /**
             * Label last
             */
            let label_last = row.querySelector('.cfg_select_option > label:last-of-type');

            /** For */
            let label_last_for_current = label_last.getAttribute('for');
            let label_last_for_target  = input_last_id_target;

            if (label_last_for_current !== label_last_for_target) {
                label_last.setAttribute('for', label_last_for_target);
            }

            return true;
        });
    }

    /**
     * Apply
     */
    let button_apply = dialog.querySelector('button[name="grandeljaydhl_apply"]');

    button_apply.addEventListener('click', function() {
        let input_json     = [];
        let input_required = [];

        switch (option) {
            case 'MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_NATIONAL_COSTS':
                input_required = [
                    'weight',
                    'cost'
                ];
                break;

            case 'MODULE_SHIPPING_GRANDELJAYDHL_SHIPPING_INTERNATIONAL_EXCEPTIONS_DATA':
                input_required = [
                    'country',
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

        let rows = Array.from(dialog.querySelectorAll('.container > .row'));

        rows.every(function(row) {
            let row_values = {};
            let row_inputs = Array.from(row.querySelectorAll('.column [name]'));
            let row_add    = row_inputs.every(function(element) {
                let element_name = element.getAttribute('name');

                /** Skip rows with empty required fields */
                if (input_required.includes(element_name)) {
                    if (!element.value) {
                        return false;
                    }
                }

                /** Assign values */
                switch (element.type) {
                    case 'radio':
                        if (element.checked) {
                            row_values[element_name] = element.value;
                        }
                        break;

                    default:
                        row_values[element_name] = element.value;
                        break;
                }

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
