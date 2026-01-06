const detailContent = (value) => {
    return (
        $('#detailContent').append(`<div class="absolute cursor-pointer hidden md:block -ml-4 left-0">
        <svg class="p-2 bg-cyan-500 shadow-md transition text-white hover:bg-white hover:text-slate-800 hover:shadow-slate-800/60 shadow-cyan-500/60 rounded-full w-9 h-9" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
        </svg>
    </div>`),
        value.forEach((tag) => {
            $('#detailContent').append(`<span class="hover:bg-white transition hover:text-slate-800 hover:shadow-slate-800/60 text-md text-white font-medium bg-cyan-500 shadow-md shadow-cyan-500/60 px-6 rounded-xl py-1">${tag}</span>`);
        }),
        $('#detailContent').append(`<div class="absolute cursor-pointer hidden md:block -mr-4 right-0">
    <svg class="p-2 bg-cyan-500 shadow-md transition text-white hover:bg-white hover:text-slate-800 hover:shadow-slate-800/60 shadow-cyan-500/60 rounded-full w-9 h-9" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
</svg>
</div>`)
    );
}

let result = localStorage.getItem('waifu');
result = JSON.parse(result);
result = result.images;
const inputId = document.querySelector('input').value;
const image = document.querySelector('img');

result.forEach((value) => {
    if (value.id === inputId) {
        document.body.style.backgroundImage = `url('${value.image.compressed.url}')`;
        image.src = value.image.compressed.url;
        image.alt = value.id;
        detailContent(value.tags);

        // artist detail
        const artist = document.querySelector('h1');
        artist.nextElementSibling.innerHTML = `Profile: <a class="text-cyan-500 underline" href="${value.attribution.artist.profile}" target="_blank">Artist Profile</a>`;
        artist.nextElementSibling.nextElementSibling.innerHTML = `Username: ${value.attribution.artist.username}`;
        artist.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML = `Source: <a class="text-cyan-500 underline" href="${value.source.url}" target="_blank">Source image</a>`;
        artist.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML = `Category: ${value.category}`;
        $('#copyright').html(`Copyright: ${value.attribution.copyright}`);
    }
})

// mousemove event
const mouseMove = document.getElementById('detailContent');
const arrowIconLeft = mouseMove.firstElementChild;
const arrowIconRight = mouseMove.lastElementChild;

arrowIconLeft.addEventListener('click', () => {
    mouseMove.scrollLeft -= 300;
})

arrowIconRight.addEventListener('click', () => {
    mouseMove.scrollLeft += 300;
})

let isDragging = false;
mouseMove.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    mouseMove.scrollLeft -= e.movementX;
});

mouseMove.addEventListener('mousedown', () => isDragging = true);
document.addEventListener('mouseup', () => isDragging = false);

const btnFavorite = document.querySelector('button');
btnFavorite.addEventListener('click', () => {
    const xhttp = new XMLHttpRequest();
    const altImg = document.querySelector('img').alt;
    xhttp.onload = function () {
        if(this.responseText == 'Favorite') {
            btnFavorite.innerHTML = `Favorite<svg class="w-8 h-8 text-rose-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z" />
                    </svg>`;
        } else {
            btnFavorite.innerHTML = `Rejected<svg class="w-8 h-8 text-rose-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>`;
        }
    }
    
    xhttp.open("POST", "cek_password.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send("btnFavorite=" + encodeURIComponent(altImg));
})