const { add } = require("lodash");

let timeout;

$('.js-search-form').on('submit', function(e) {
    e.preventDefault();
    $('.js-results').html('Searching...');

    let form = $('.js-search-form');
    let request = {
        'q': form.find('[name="q"]').val(),
        'pageSize': form.find('[name="pageSize"]').val(),
        'limit': form.find('[name="limit"]').val(),
    }

    console.log(request);

    searchAddress(request)
});


async function searchAddress(request) {
    
    const response = await searchAddressRequest(request);
    console.log(response);

    if (response && response.property) {
        $('.js-results').html('');
        $('.js-total').html('Total: ' + response.status.total + ' Multiple: ' + response.status.countMultiple + '. Got: ' + response.property.length);
        response.property.forEach(address => {
            console.log(address);
            console.log(address.summary);
            console.log(address.summary.legal1);
            const obj = $('.js-simple-result').clone();
            obj.find('.address').html(address.address.oneLine);
            obj.find('.legal1').html(address.summary.legal1);

            if (address.multiple) {
                obj.addClass('multiple');
            }

            obj.removeClass('js-simple-result');
            $('.js-results').append(obj);
        });
    }
}

async function searchAddressRequest(request) {
    var response = await $.ajax({
        type: "GET",
        url: '/search-zip',
        data: request,
        dataType: 'json',
    });

    return response;
}
