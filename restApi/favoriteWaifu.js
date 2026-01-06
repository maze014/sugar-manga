const componentWaifu = function (value) {
    return $('#neko').append(`<div class="bg-white group transition duration-300 hover:scale-95 w-[90%] mx-auto overflow-hidden mb-4 rounded-xl">
        <img class="group-hover:scale-110 transition duration-300 group-hover:rotate-3" src="${value.image.compressed.url}" alt="${value.id}" />
        <div class="flex justify-evenly item-center p-4 bg-slate-800 relative z-10">
            <button type="submit">
                <svg class="w-8 h-8 text-rose-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
            </button> 
            <span class="rounded-full flex group/item transition duration-300 items-center group hover:underline">
                <a href="detail.php?id=${value.id}" class="text-white transition duration-300 group-hover/item:text-cyan-500 font-light text-lg flex items-center">See detail
                    <svg class="w-8 h-8 text-white transition duration-300 group-hover/item:text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 16 4-4-4-4m6 8 4-4-4-4" />
                    </svg>
                </a>
            </span>
        </div>
    </div>`);
}

let result = localStorage.getItem('waifu');
result = JSON.parse(result);
result = result.images;

const inputImg = document.querySelector('input').value;
const arrayImg = inputImg.split(',');
arrayImg.pop();
const categories = new Set();

result.forEach((value) => {
    if (arrayImg.includes(value.id)) {
        categories.add(value.category);
    }
})

//category
if (arrayImg != '') {
    const category = document.getElementById('categories').getAttribute('name');
    if (category === 'null') {
        result.forEach(function (value) {
            if (arrayImg.includes(value.id)) {
                componentWaifu(value);
            }
        });
    } else {
        result.forEach((value) => {
            if (arrayImg.includes(value.id)) {
                if (value.category === category) {
                    componentWaifu(value);
                }
            }
        })
    }

    // categories
    $('#categories').append(`<div class="absolute cursor-pointer hidden md:block left-0 bg-gradient-to-r from-white py-2 pr-8 rounded-l-full">
        <svg class="p-2 bg-violet-700 shadow-md transition text-white hover:bg-white hover:text-slate-800 hover:shadow-slate-800/60 shadow-violet-700/60 rounded-full w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
        </svg>
        </div>`);
    $('#categories').append(`<a href="favorite.php" class="px-6 py-2 bg-violet-700 shadow-md transition hover:bg-white hover:text-slate-800 hover:shadow-slate-800/60 shadow-violet-700/60 rounded-full text-lg font-medium text-nowrap text-white">all</a>`);
    categories.forEach((category) => {
        $('#categories').append(`<a href="favorite.php?category=${category}" class="px-6 py-2 bg-violet-700 shadow-md transition hover:bg-white hover:text-slate-800 hover:shadow-slate-800/60 shadow-violet-700/60 rounded-full text-lg font-medium text-nowrap text-white">${category}</a>`);
    });
    $('#categories').append(`<div class="absolute cursor-pointer hidden md:block right-0 bg-gradient-to-l from-white py-2 pl-8 rounded-r-full">
    <svg class="p-2 bg-violet-700 shadow-md transition text-white hover:bg-white hover:text-slate-800 hover:shadow-slate-800/60 shadow-violet-700/60 rounded-full w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
    </svg>
    </div>`);

    // mousemove event
    const mouseMove = document.getElementById('categories');
    const arrowIconLeft = mouseMove.firstElementChild;
    const arrowIconRight = mouseMove.lastElementChild;

    arrowIconLeft.addEventListener('click', () => {
        mouseMove.scrollLeft -= 350;
    })

    arrowIconRight.addEventListener('click', () => {
        mouseMove.scrollLeft += 350;
    })

    let isDragging = false;
    mouseMove.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        mouseMove.scrollLeft -= e.movementX;
    });

    mouseMove.addEventListener('mousedown', () => isDragging = true);
    document.addEventListener('mouseup', () => isDragging = false);
}

// delete favorite
const favoriteBtn = document.querySelectorAll('button');
favoriteBtn.forEach((btn) => {
    btn.addEventListener('click', () => {
        const xhttp = new XMLHttpRequest();
        const altImg = btn.parentElement.previousElementSibling.alt;
        const parentWaifu = btn.parentElement.parentElement;
        xhttp.onload = function () {
            parentWaifu.classList.add(`${this.responseText}`);
        }
        xhttp.open("POST", "cek_password.php", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send("deleteFavorite=" + encodeURIComponent(altImg));
    })
});