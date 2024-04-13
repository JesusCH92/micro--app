const tripModel = (function () {
    const create = function ({data, container}) {
        const url = '/api/trip-creator';

        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        };

        fetch(url, options)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Response:', data);
                _renderRowInTable({trip: data})
            })
            .catch(error => {
                console.error('There was a problem with your fetch operation:', error);
            });
    };

    const _renderRowInTable = function ({trip}) {
        const tbody = document.querySelector('table.table tbody');
        const newRow = document.createElement('tr');
        const idCell = document.createElement('th');

        idCell.setAttribute('scope', 'row');
        idCell.textContent = trip.id;

        const vehicleCell = document.createElement('td');
        vehicleCell.textContent = trip.vehicle;

        const driverCell = document.createElement('td');
        driverCell.textContent = trip.driver;

        const dateCell = document.createElement('td');
        dateCell.textContent = trip.date;

        newRow.appendChild(idCell);
        newRow.appendChild(vehicleCell);
        newRow.appendChild(driverCell);
        newRow.appendChild(dateCell);

        tbody.appendChild(newRow);
    };

    return {
        tripCreator: create,
    }
});

export default tripModel;