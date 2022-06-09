import $ from 'jquery';

export const pagination = (function () {
    function track_length_change(link) {
        const element = $('#' + link);

        element.on('change', function () {
            const params = Object.fromEntries(window.location.search.substr(1).split('&').map( group => group.split("=")));
            params.length = $( this ).val();

            const search = Object.entries(params).map(function (group) {
                return group.join('=');
            }).join('&');

            window.location.href = window.location.pathname + '?' + search;
        })
    }

    return {
        track_length_change: track_length_change
    };
});

window.pagination = pagination;
