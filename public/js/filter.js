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
    // $('.grid').imagesLoaded( function() {
    //     $grid = $('.grid').masonry({
    //         itemSelector: '.grid-item'
    //     });
    // });
    $("#sort-menu").on('click', sortImages);
    $("#time-menu").on('click', filterByTime);
    $("#orientation-menu").on('click', filterByOrientation);
    $("#people-menu").on('click', filterByPeople);
    $("#people-composition").on('click', filterByPeopleComposition);
    // $("#photographer-menu").on('click', filterByPhotographer);
    $("#photographer-form").on('submit', filterByPhotographer);

    pagination = document.querySelector(".pagination");

    // if(pagination) {
    //     [...pagination.querySelectorAll('li')].forEach((item, index) => {
    //         item.dataset.page = index.toString();
    //     });
    //     pagination.onclick = changePage;
    // }

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

// function reCreatePagination(last_page) {
//     baseUrl = $('#base_url').val();
//     findKey = $('#find_key').val();
//     pagination.innerHTML = "";
//     let paginationHtml = '<li class="page-item disabled" aria-disabled="true" aria-label="« Previous" data-page="0">\n' +
//         '                <span class="page-link" aria-hidden="true">‹</span>\n' +
//         '            </li>';
//     for(let i=1; i<=last_page; i++) {

//         paginationHtml += `<li class="page-item ${i === 1 ? 'active' : ''}" data-page="${i}"><a class="page-link" href="${baseUrl}/search?search_key=${findKey}&page=${i}">${i}</a></li>`
//     }

//     paginationHtml += '<li class="page-item" data-page="3">\n' +
//         `                <a class="page-link" href="${baseUrl}/search?search_key=${findKey}&page=2" rel="next" aria-label="Next »">›</a>\n` +
//         '            </li>';

//     pagination.innerHTML = paginationHtml;
// }

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

 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
      url: `${baseUrl}/filter` ,
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      datatype: "html",
      success: function( data ) {
        //   console.log(data);
        $("#filter_inner_div").empty().html(data);
      }
    });

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

$(document).ready(function()
{
    $(document).on('click', '.pagination a',function(event)
    {
        event.preventDefault();

       
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        var myurl = $(this).attr('href');
        var page=$(this).attr('href').split('page=')[1];

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
        if(page) {
            formData.append('page', page);
        }
        if(photographer) {
            formData.append('photographer', photographer);
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax(
        {
            url: `${baseUrl}/filter`,
            type: "post",
            data: formData,
            datatype: "html",
            processData: false,
            contentType: false
        }).done(function(data){
            $("#filter_inner_div").empty().html(data);
            // location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    });

});

