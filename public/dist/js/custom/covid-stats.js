// Format number with comma
let numberWithCommas = (number) => number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

// Fetch data
$.get('https://covid19stats.ph/api/stats/quick', {}, function (data, textStatus, jqXHR) {
    let cases = data.cases;
    let world = data.world;

    $('#philippines-confirmed').html(numberWithCommas(cases.total));
    $('#philippines-recovered').html(numberWithCommas(cases.recovered));
    $('#philippines-deaths').html(numberWithCommas(cases.deaths));


    $('#world-wide-confirmed').html(numberWithCommas(world.total));
    $('#world-wide-recovered').html(numberWithCommas(world.recovered));
    $('#world-wide-deaths').html(numberWithCommas(world.deaths));
});

$.get('https://covid19stats.ph/api/stats/location', {}, function (data, textStatus, jqXHR) {
    let surigaoDelSurCities = data.cities.filter((city) => city.slug.includes(
        'surigao-del-sur'));
    let confirmedTotal = 0;
    let recoveredTotal = 0;
    let deathTotal = 0;

    surigaoDelSurCities.forEach((city, index) => {
        confirmedTotal += city.total;
        recoveredTotal += city.recovered;
        deathTotal += city.deaths;
    });


    $('#surigao-confirmed-case').html(numberWithCommas(confirmedTotal));
    $('#surigao-recovered').html(numberWithCommas(recoveredTotal));
    $('#surigao-deaths').html(numberWithCommas(deathTotal));
});

$('.update-category').click((e) => {

    // Get the selected category button
    let selectedCategory = e.target;
    let category = $(selectedCategory).attr('data-target');
    let categoryElement = $(`#${category}`);

    // Hide the remaining elements.
    $('.update-category').each((i, e) => {

        // Category buttons
        let id = $(e).attr('data-target');

        if (id !== category) {
            $(`#${id}`).addClass('hidden');
            $(e).removeClass('bg-theme-1')
                .addClass('bg-gray-200')
                .addClass('text-gray-600');
        } else {

            // Apply active color for button
            $(e).removeClass('text-gray-600')
                .addClass('bg-theme-1')
                .addClass('text-white');

            // Change the base title depending on the selected category
            $('#base-title').text('')
                .text(`COVID-19 Updates ${category.replace(/-/g, ' ')
                .toUpperCase()}`)
        }

    });

    // Display the selected category stats.
    categoryElement.removeClass('hidden');
});
