import {activated, disabled} from "../utils/utils.js";
import {renderSelect2} from "../utils/select2Module.js";

const tripController = (function ({model}) {
    const dateInput = document.querySelector('#date');
    const vehicleSelect = document.querySelector('select[name="vehicle"]');
    const driverSelect = document.querySelector('select[name="driver"]');
    const tripCreatorBtn = document.querySelector('#trip-creator--btn');

    const initAttrFormEvents = function () {
        dateInput.addEventListener('change', function () {
            const selectedDate = dateInput.value;

            if (selectedDate === '') {
                vehicleSelect.value = '';
                disabled({element: vehicleSelect});
                vehicleSelect.dispatchEvent(new Event('change'));
                return;
            }

            activated({element: vehicleSelect});

            renderSelect2({select: vehicleSelect, url: `/api/vehicles-from-trip?date=${selectedDate}`});

            $(vehicleSelect).on('change', function () {
                const vehicleSelected = vehicleSelect.value;

                if (vehicleSelected === '') {
                    driverSelect.value = '';
                    disabled({element: driverSelect});
                    return;
                }

                activated({element: driverSelect});
                renderSelect2({
                    select: driverSelect,
                    url: `/api/drivers-from-trip?date=${selectedDate}&vehicle=${vehicleSelected}`});
            });

            vehicleSelect.dispatchEvent(new Event('change'));
        });
    };

    const initSendFormEvents = function () {
        tripCreatorBtn.addEventListener('click', function(event) {
            event.preventDefault();
            console.log('no touch me!');

            if ([dateInput.value, vehicleSelect.value, driverSelect.value].includes('')) {
                console.log('is empty');
                return;
            }

            const data = {
                date: dateInput.value,
                vehicle: +vehicleSelect.value,
                driver: +driverSelect.value
            }

            model.tripCreator({data, selector: dateInput});
        });
    };

    return {
        initAttributesFormEvents: initAttrFormEvents,
        initSendFormEvents: initSendFormEvents,
    }
});

export default tripController;