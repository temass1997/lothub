import map from "./map";

let timeout;

$('.js-search-form').submit(function( e ) {
    e.preventDefault();
    $('.js-results').html('');
    $('.js-total').html('Searching...');

    let form = $('.js-search-form');
    let request = {
        'q': form.find('[name="q"]').val(),
        'pageSize': form.find('[name="pageSize"]').val(),
        'limit': form.find('[name="limit"]').val(),
    }

    let zip = form.find('[name="q"]').val();
    map.initGeneralMap(zip);

    console.log(request);

    searchAddress(request)
});

async function searchAddress(request) {
    
    const response = await searchAddressRequest(request);
    console.log(response);

    if (response && response.property) {
        $('.js-total').html('Total: ' + response.status.total + ' Received: ' + response.status.countElements + ' Multiple: ' + response.property.length);
        response.property.forEach(address => {
            console.log(address);
            console.log(address.summary);
            console.log(address.summary.legal1);
            const obj = $('.js-simple-search-result').clone();
            obj.find('.address').html(address.address.oneLine);
            obj.find('.legal1').html(address.summary.legal1);

            obj.removeClass('js-simple-search-result');
            obj.removeClass('simple-search-result');

            obj.data('lat', address.location.latitude);
            obj.data('lng', address.location.longitude);

            $('.js-results').append(obj);
        });
        initPopup();
    }
}

function initPopup() {
    $(".search-result__item").on('click', function(event) {
        fillPopup($(this));
        $('.js-popup').addClass('open');
        $('.js-popup').fadeIn();
    });
    $(".js-popup-close").on('click', function(event) {
        $('.js-popup').fadeOut();
        $('.js-popup').removeClass('open');
    });
}

function fillPopup(obj) {
    const lat = obj.data('lat') * 1;
    const lng = obj.data('lng') * 1;
    map.initPopupMap(lat, lng);
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
