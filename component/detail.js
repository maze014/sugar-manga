const detailContent = (value) => {
    return (
        $('#detailContent').append(`<span class="text-sm inline-block text-white font-medium bg-violet-700 shadow-lg shadow-violet-700/60 px-6 rounded-full py-1">Tags:</span>`),
        value.forEach((tag) => {
            $('#detailContent').append(`<span class="text-sm block text-white font-medium bg-violet-700 shadow-lg shadow-violet-700/60 px-6 rounded-full py-1">${tag}</span>`);
        })
    );
}

let result = localStorage.getItem('waifu');
result = JSON.parse(result);
const inputId = document.querySelector('input').value;
const image = document.querySelector('img');

result.forEach((value) => {
    if (value.id === inputId) {
        document.body.classList.add(`bg-[url('${value.image.compressed.url}')]`);
        image.src = value.image.compressed.url;
        image.alt = value.category;
        detailContent(value.tags);
    }
})
console.log(result);