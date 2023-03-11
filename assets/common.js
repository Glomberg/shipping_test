async function getApiResponse(route, data) {
    const apiUrl = 'http://localhost:8000/api/';
    let response = await fetch(apiUrl + route, {
        method: 'POST',
        body: data
    });

    if (response.ok) {
        return await response.json();
    } else {
        return response.status;
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    // Fill the dropdown list of the Delivery Companies
    let deliveryCompanies = await getApiResponse('get_companies', {});
    const selectDiv = document.getElementById('delivery_companies');
    if ( deliveryCompanies.companies !== undefined ) {
        for (let company in deliveryCompanies.companies) {
            let option = document.createElement('option');
            option.setAttribute('value', company);
            option.innerText = deliveryCompanies.companies[company];
            selectDiv.append(option);
        }
    }
    let submitButton = document.getElementById('submit_button');
    submitButton.innerText = 'Calculate';
    submitButton.removeAttribute('disabled');

    // Prevent default submission
    let calculatedForm = document.getElementById('ils_shipping_calculator_form');
    calculatedForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const resultDiv = document.getElementById('api_result');
        resultDiv.innerText = '';

        let formData = new FormData(e.target);

        let spinner = document.getElementById('spinner');
        spinner.style.display = 'block';

        submitButton.setAttribute('disabled', true);
        let deliveryDetails = await getApiResponse('get_price', formData);

        spinner.style.display = 'none';
        submitButton.removeAttribute('disabled');

        resultDiv.innerText = JSON.stringify(deliveryDetails);
    });
});
