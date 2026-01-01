const componentWaifu = function (value) {
    return $('#neko').append(`<div class="bg-white group transition duration-300 hover:scale-95 w-[90%] mx-auto overflow-hidden mb-4 rounded-xl">
        <img class="group-hover:scale-110 transition duration-300 group-hover:rotate-3" src="${value.image.compressed.url}" alt="${value.category}" />
        <div class="flex justify-between item-center p-4 bg-slate-800 relative z-10">
            <button type="submit">
                <svg class="w-10 h-10 text-rose-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z" />
                </svg>
            </button>
            <button type="submit">
                <svg class="w-10 h-10 text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd" />
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

if (typeof (Storage) !== "undefined") {
    const cnt = 8;
    if (localStorage.getItem('waifu') === null) {
        $.ajax({
            url: 'https://api.nekosia.cat/api/v1/images/blonde?count=' + cnt,
            type: 'GET',
            dataType: 'json',
            success: function (results) {
                let result = results.images;
                localStorage.setItem('waifu', JSON.stringify(result));
            }
        });
    }
    else {
        let result = localStorage.getItem('waifu');
        result = JSON.parse(result);
        // console.log(result);

        const category = document.getElementById('categories').getAttribute('name');
        // console.log(category);
        const categories = new Set();
        result.forEach(function (value) {
            categories.add(value.category);
        })
        if (category === 'null') {
            result.forEach(function (value) {
                componentWaifu(value);
            });
        } else {
            result.forEach((value) => {
                if (value.category === category) {
                    componentWaifu(value);
                }
            })
        }
        // categories
        $('#categories').append(`<div class="absolute cursor-pointer hidden md:block left-0 bg-gradient-to-r from-white py-2 pr-8 rounded-l-full">
        <svg class="p-2 bg-violet-700 shadow-md transition text-white hover:bg-white hover:text-slate-800 hover:shadow-slate-800/60 shadow-violet-700/60 rounded-full w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
        </svg>
    </div>`);
        $('#categories').append(`<a href="index.php" class="px-6 py-2 bg-violet-700 shadow-md transition hover:bg-white hover:text-slate-800 hover:shadow-slate-800/60 shadow-violet-700/60 rounded-full text-lg font-medium text-nowrap text-white">all</a>`);
        categories.forEach((category) => {
            $('#categories').append(`<a href="index.php?category=${category}" class="px-6 py-2 bg-violet-700 shadow-md transition hover:bg-white hover:text-slate-800 hover:shadow-slate-800/60 shadow-violet-700/60 rounded-full text-lg font-medium text-nowrap text-white">${category}</a>`);
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
                if(!isDragging) return;
                mouseMove.scrollLeft -= e.movementX;
            });

            mouseMove.addEventListener('mousedown', () => isDragging = true);
            document.addEventListener('mouseup', () => isDragging = false);
    }
}