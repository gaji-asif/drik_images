let imageTable = null;
let heightInput, widthInput, authorInput, countryInput, cityInput, stateInput, copyRightInput,
    postalCodeInput, titleInput, websiteInput, phoneInput, emailInput,
    headlineInput, captionInput, tagInput, editingImageId, orientationInput, noPeopleInput, peopleCompositionInput,
    specificPeopleInput, locationInput;
    document.addEventListener("DOMContentLoaded", function() {
    let buttonPanel = document.querySelector('.dt-buttons');

    heightInput = document.querySelector(".image-height");
    widthInput = document.querySelector(".image-width");
    authorInput = document.querySelector(".image-author");
    countryInput = document.querySelector(".image-country");
    cityInput = document.querySelector(".image-city");
    stateInput = document.querySelector(".image-state");
    copyRightInput = document.querySelector(".image-copyright");
    postalCodeInput = document.querySelector(".image-postal-code");
    titleInput = document.querySelector(".image-title");
    websiteInput = document.querySelector(".image-website");
    phoneInput = document.querySelector(".image-phone");
    emailInput = document.querySelector(".image-email");
    headlineInput = document.querySelector(".image-headline");
    captionInput = document.querySelector(".image-caption");
    tagInput = document.querySelector('.tags-input');
    orientationInput = document.querySelector('.orientation');
    noPeopleInput = document.querySelector('.no_people');
    peopleCompositionInput = document.querySelector('.people_composition');
    specificPeopleInput = document.querySelector('.specific_people');
    locationInput = document.querySelector('.location');

    price_0 = document.querySelector('.price_0');
    price_1 = document.querySelector('.price_1');
    price_2 = document.querySelector('.price_2');
    price_3 = document.querySelector('.price_3');
    price_4 = document.querySelector('.price_4');
    price_5 = document.querySelector('.price_5');
    image_id = document.querySelector('#image_id');

    if(buttonPanel) {
        buttonPanel.classList.add('d-none');
    }

    imageTable = $('#image-table').DataTable({
        "ajax": {
            "url": `${baseUrl}/get_all_images`,
            "dataSrc": ""
        },
        'columnDefs': [{
            'targets': 0,
            'searchable': false,

            'className': 'dt-body-center',
            'render': function (data, type, full, meta){
                return '<input type="checkbox" name="id" value="' + $('<div/>').text(data).html() + '">';
            }
         }],
        "buttons": [],
        "columns": [
            { "data": "id" },
            { "data": "id" },
            { "data": "image_name" },
            { "data": "thumbnail_url",
              "render": function ( data ) {
                  return '<img style="width: 50px" src="'+data+'">';
              } },
            { "data": "height" },
            { "data": "width" },
            {"data": "id",
                "render": function(data) {
                    return `<div>
                        <button onclick="deleteAnImage(${data})" type="button" class="btn btn-danger action-icon"><i class="fa fa-trash-o"></i></button>
                        <button onclick="editImage(${data})" type="button" class="btn btn-danger action-icon"><i class="fa fa-edit"></i></button>
                    </div>`;
            }}

        ]
    });
    $('#tags').tokenfield();
    $("#update_image_btn").on('click', updateImage);
    $("#btn-bulk-delete").on('click', bulkDelete);
});

function deleteAnImage(imageId) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this image!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let formData = new FormData();
         
                formData.append('imageId', imageId);
                fetch(`${baseUrl}/delete_image`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    body: formData
                })
                    .then(res => res.json())
                    .then(res => {
                       
                        swal("Image has been deleted!", {
                            icon: "success",
                        });
                        imageTable.ajax.reload();
                    })
            } else {
                swal("Your image is safe!");
            }
        });
}

function pendinDeleteAnImage(imageId) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this image!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let formData = new FormData();
         
                formData.append('imageId', imageId);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                  url: `${baseUrl}/pending_delete_image` ,
                  type: "post",
                  data: formData,
                  contentType: false,
                  processData: false,
                  datatype: "html",
                  success: function(data) {
                    swal("Image has been deleted!", {
                        icon: "success",
                    });

                    $("#inner_div").empty().html(data);
                    location.hash = page;

                  }
                });
            } else {
                swal("Your image is safe!");
            }
        });
}

function approveAnImage(imageId) {
    swal({
        title: "Are you sure?",
        text: "Once Approve, This image will be show in gallery",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willApprove) => {
            if (willApprove) {
                let formData = new FormData();
                formData.append('imageId', imageId);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                  url: `${baseUrl}/aprove_image` ,
                  type: "post",
                  data: formData,
                  contentType: false,
                  processData: false,
                  datatype: "html",
                  success: function( data ) {
                    swal("Image has been Approved!", {
                        icon: "success",
                    });
                    // console.log(data);
                    $("#inner_div").empty().html(data);
                    location.hash = page;

                  }
                });
            } else {
                swal("Your image is safe!");
            }
        });
}

function editImage(imageId) {
    if(imageId) {
        editingImageId = imageId;
        fetch(`${baseUrl}/image_details/${imageId}`, {
            method: 'GET'
        }).then(res => res.json())
            .then(res => {
                if(imageId) {
                    fetch(`${baseUrl}/image_details/${imageId}`, {
                        method: 'GET'
                    }).then(res => res.json())
                        .then(res => {
                           
                            let imageDetails = res.data;
                            let imageUsagePrice = res.imageUsagePrice;
                            let keywords = imageDetails["keywords"] || [];
                            let {author, height, width, caption, city,
                                copy_right, country, email, headline, phone,
                                postal_code, state, title, website,
                                orientation, no_people, people_composition, specific_people, location} = imageDetails;
                            heightInput.value = height;
                            widthInput.value = width;
                            authorInput.value = author;
                            countryInput.value = country;
                            cityInput.value = city;
                            stateInput.value = state;
                            copyRightInput.value = copy_right;
                            postalCodeInput.value = postal_code;
                            titleInput.value = title;
                            websiteInput.value = website;
                            phoneInput.value = phone;
                            emailInput.value = email;
                            headlineInput.value = headline;
                            captionInput.value = caption;
                            
                            image_id.value = imageId;
                            if(imageUsagePrice.length>0) {
                                price_0.value = imageUsagePrice[0].price;
                                price_1.value = imageUsagePrice[1].price;
                                price_2.value = imageUsagePrice[2].price;
                                price_3.value = imageUsagePrice[3].price;
                                price_4.value = imageUsagePrice[4].price;
                                price_5.value = imageUsagePrice[5].price;
                            }
                            else
                            {
                                price_0.value = "";
                                price_1.value = "";
                                price_2.value = "";
                                price_3.value = "";
                                price_4.value = "";
                                price_5.value = "";
                            }

                            $("#tags").tokenfield('setTokens', keywords);
                            if(orientation){
                                orientationInput.value = orientation;
                            }
                            if(no_people) {
                                noPeopleInput.value = no_people;
                            }
                            if(people_composition) {
                                peopleCompositionInput.value = people_composition;
                            }

                            if(specific_people) {
                                specificPeopleInput.value = specific_people ?? "";
                            }
                            if(location) {
                                locationInput.value = location;
                            }
                     
                           
                        });
                }
                $('#image-edit-modal').modal({show:true});
            })
    }
}

function updateImage() {
     let updates = {
         author: authorInput.value,
         country: countryInput.value,
         city: cityInput.value,
         state: stateInput.value,
         postal_code: postalCodeInput.value,
         copy_right: copyRightInput.value,
         phone: phoneInput.value,
         website: websiteInput.value,
         title: titleInput.value,
         email: emailInput.value,
         caption: captionInput.value,
         headline: headlineInput.value,
         keywords: $("#tags").tokenfield('getTokensList'),
        //  orientation: orientationInput.value,
        //  no_people: noPeopleInput.value,
        //  people_composition: peopleCompositionInput.value,
        //  specific_people: specificPeopleInput.value,
        //  location: locationInput.value
     };

     let formData = new FormData();
     Object.keys(updates).forEach(key => {
        formData.append(key, updates[key]);
     });
     fetch(`${baseUrl}/update_image/${editingImageId}`, {
         method: 'POST',
         headers: {
             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
         },
         body: formData
     })
         .then(res => res.json())
         .then(res => {
             $('#image-edit-modal').modal('hide');
             swal("Image updated successfully!");
         })


}

function bulkDelete(){
    let selectedImageIds = [];
    $("input:checkbox[name=id]:checked").each(function(){
        selectedImageIds.push($(this).val());
    });

    let formData = new FormData();
    formData.append('imageIds', JSON.stringify(selectedImageIds));

    fetch(`${baseUrl}/delete_bulk_image`, {
        method: 'POST',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        },
        body: formData
    })
        .then(res => res.json())
        .then(res => {
            swal("Image deleted successfully");
            imageTable.ajax.reload();
        });
}

$(document).ready(function () {
    $('#example-select-all').on('click', function(){
        // Get all rows with search applied
        var rows = imageTable.rows({ 'search': 'applied' }).nodes();
        // Check/uncheck checkboxes for all rows in the table
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
     });

     // Handle click on checkbox to set state of "Select all" control
     $('#image-table tbody').on('change', 'input[type="checkbox"]', function(){
        // If checkbox is not checked
        if(!this.checked){
           var el = $('#example-select-all').get(0);
           // If "Select all" control is checked and has 'indeterminate' property
           if(el && el.checked && ('indeterminate' in el)){
              el.indeterminate = true;

           }
        }
     });

     // Handle form submission event
     $('.get-all-selected').on('click', function(e){
        var form = $('.new_form');

        // Iterate over all checkboxes in the table
        imageTable.$('input[type="checkbox"]').each(function(){
           // If checkbox doesn't exist in DOM
           if(!$.contains(document, this)){
              // If checkbox is checked
              if(this.checked){
                 // Create a hidden element
                 $(form).append(
                    $('<input>')
                       .attr('type', 'hidden')
                       .attr('name', this.name)
                       .val(this.value)
                 );
              }
           }
        });
     });
});


function ImagePrice()
{
    let priceList = Array();
    priceList['0'] = $(".price_0").val();
    priceList["1"] = $(".price_1").val();
    priceList["2"] = $(".price_2").val();
    priceList["3"] = $(".price_3").val();
    priceList["4"] = $(".price_4").val();
    priceList["5"] = $(".price_5").val();
    priceList = JSON.stringify(priceList)
    url = $("#url").val();
    imageId = image_id.value;
// console.log(priceList);
    let formData = new FormData();
    formData.append('priceList', priceList);
    formData.append('imageId', imageId);

    fetch(`${baseUrl}/update_image_price`, {
        method: 'POST',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        },
        body: formData
    })
        .then(res => res.json())
        .then(res => {
            price_0.value = "";
            price_1.value = "";
            price_2.value = "";
            price_3.value = "";
            price_4.value = "";
            price_5.value = "";
            $('#image-edit-modal').modal('hide');
            swal("Image price updated successfully!");
        })

}

// function imageList(images){

//     images.forEach(image => console.log(image));

// }

function imageList(images){

    $("#inner_div").html('');
    let innerDiv;
    images.forEach(image => {
        innerDiv = 
        `<div class="card-block col-lg-3">
            <div class="card">
                <p style="margin-top: 15px; margin-left: 8px;">
                    <input type="checkbox" name="id" value="${image.id}">
                </p>
                <img class="card-img-top" src="${image.thumbnail_url}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">id#${image.id}</h5>
                    <p class="card-text">${image.title}</p>
                    <button  type="button" onclick="approveAnImage(${image.id})" class="btn btn-success action-icon"><i class="fa fa-check"></i></button>
                    <button onclick="deleteAnImage(${image.id})" type="button" class="btn btn-danger action-icon"><i class="fa fa-trash-o"></i></button>
                </div>
            </div>
        </div>`;
        $("#inner_div").append(innerDiv);
    })
};

function getImages()
{
    let contributor_id = $("#contributor_id").val();
    let formData = new FormData();
    formData.append('contributor_id', contributor_id);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
      url: `${baseUrl}/get_contributor_images` ,
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      datatype: "html",
      success: function( data ) {
        $("#inner_div").empty().html(data);
        location.hash = page;

      }
    });

}
  