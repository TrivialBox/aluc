function getUrlVars(url) {
    var hash;
    var myJson = {};
    var hashes = /(?:\?)(.*)/.exec(url)[1] || '';
    hashes = hashes.split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        myJson[hash[0]] = hash[1];
    }
    return myJson;
}

function populateFormFromUrl(form) {
    var data = getUrlVars(decodeURIComponent(window.location.href));
    console.log(data);
    $.each(data, function(key, value){
        $('[name='+key+']', form).val(value);
    });
}

$(document).ready(function () {
    populateFormFromUrl('#filter-form');
});
