let sorting = 'asc';
let time = null;
let orientation = null;
let people = null;
let composition = null;
let photographer = null;
let $grid = null;
let pagination = null;
let searchKey = null
document.addEventListener("DOMContentLoaded", function(){
    let searchParams = new URLSearchParams(window.location.search);
    searchKey = searchParams.get("search_key");
    $('.grid').imagesLoaded( function() {
        $grid = $('.grid').masonry({
            itemSelector: '.grid-item'
        });
    });
    $("#sort-menu").on('click', sortImages);
    $("#time-menu").on('click', filterByTime);
    $("#orientation-menu").on('click', filterByOrientation);
    $("#people-menu").on('click', filterByPeople);
    $("#people-composition").on('click', filterByPeopleComposition);
    // $("#photographer-menu").on('click', filterByPhotographer);
    $("#photographer-form").on('submit', filterByPhotographer);

    pagination = document.querySelector(".pagination");

    if(pagination) {
        [...pagination.querySelectorAll('li')].forEach((item, index) => {
            item.dataset.page = index.toString();
        });
        pagination.onclick = changePage;
    }

});

function sortImages(event) {
    let selectedItem = event.target.closest('li');
    if(selectedItem) {
        makeOptionActive(selectedItem);
        sorting = selectedItem.dataset.value;
    }
    filterImages();
}


function filterByTime(event) {
    let target = event.target;
    let selectedItem = target.closest("li");
    makeOptionActive(selectedItem);
    time = selectedItem.dataset.value;

    filterImages();
}

function filterByOrientation(event)
{
    let target = event.target;
    let selectedItem = target.closest("li");
    makeOptionActive(selectedItem);
    orientation = selectedItem.dataset.value;
    filterImages();
}

function filterByPeople(event)
{
    let target = event.target;
    let selectedItem = target.closest("li");
    makeOptionActive(selectedItem);
    people = selectedItem.dataset.value;

    filterImages();
}

function filterByPeopleComposition(event)
{
    let target = event.target;
    let selectedItem = target.closest("li");
    makeOptionActive(selectedItem);
    composition = selectedItem.dataset.value;
    filterImages();
}

function filterByPhotographer(event) {
    event.preventDefault();
    let form = event.currentTarget;
    photographer = form.querySelector("#photographer_name").value;
    filterImages();
}

function reCreatePagination(last_page) {
    pagination.innerHTML = "";
    let paginationHtml = '<li class="page-item disabled" aria-disabled="true" aria-label="« Previous" data-page="0">\n' +
        '                <span class="page-link" aria-hidden="true">‹</span>\n' +
        '            </li>';
    for(let i=1; i<=last_page; i++) {

        paginationHtml += `<li class="page-item ${i === 1 ? 'active' : ''}" data-page="${i}"><a class="page-link" href="http://localhost/drik/filter/1?page=${i}">${i}</a></li>`
    }

    paginationHtml += '<li class="page-item" data-page="3">\n' +
        '                <a class="page-link" href="http://localhost/drik/filter/1?page=2" rel="next" aria-label="Next »">›</a>\n' +
        '            </li>';

    pagination.innerHTML = paginationHtml;
}

function filterImages(pageNumber=1, refreshPagination = false) {
    let formData = new FormData();
    formData.append("search_key", searchKey);
    if(sorting) {
        formData.append('sorting', sorting);
    }
    if(time) {
        formData.append('time', time);
    }
    if(orientation)
    {
        formData.append('orientation', orientation);
    }
    if(people)
    {
        formData.append('people', people);
    }
    if(composition)
    {
        formData.append('composition', composition);
    }
    if(pageNumber) {
        formData.append('page', pageNumber);
    }
    if(photographer) {
        formData.append('photographer', photographer);
    }
    if(orientation) {

    }
    fetch(baseUrl+"/filter", {
        method: 'POST',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        },
        body: formData
    }).then(res => res.json())
        .then(res => {
            //let images = res.images;
            let response = res.images;
            let images = response.data;
            let imageElements = [];
            let imagesContainerGrid = document.querySelector(".grid");
            imagesContainerGrid.innerHTML = "";
            images.forEach(image => {
                let imageGridElement = imageGrid(image);
                //imagesContainerGrid.append(imageGridElement);
                imageElements.push(imageGridElement);
            });

            let $elems = $( imageElements );

            $grid.append( $elems ).masonry( 'prepended', $elems );
            if(refreshPagination) {
                reCreatePagination(response.last_page);
            }
        })
}

function changePage(e) {
    e.preventDefault();
    let target = e.target;
    let listItem = target.closest('li');
    let page = listItem.dataset.page;
    filterImages(page, false);
    let previouslyActive = pagination.querySelector('.active');
    previouslyActive.classList.remove('active');
    listItem.classList.add('active');

}

function makeOptionActive(option)
{
    let list = option.closest('ul');
    let alreadyActive = list.querySelector('.active');
    if(alreadyActive) {
        alreadyActive.classList.remove('active');
    }
    option.classList.add('active');
}

