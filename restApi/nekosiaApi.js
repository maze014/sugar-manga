const neko = document.getElementById('neko');

$.ajax({
    url: 'https://api.nekosia.cat/api/v1/images/blonde',
    type: 'GET',
    dataType: 'json',
    success: function(result) {
        neko.src = result.image.original.url;
    }
})