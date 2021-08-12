let images = [];
let imageFile = null;
let masterId = null;
let lastForm = null;
let formCount = 1;
let contributor = null;

$(document).on('focus',".creation-date", function(){
    $(this).datepicker();
});
document.addEventListener("DOMContentLoaded", function(){
    let contributorIdField = document.getElementById("contributor");
    contributor = contributorIdField ? contributorIdField.value : null;

    let imageSubmitBtn = document.getElementById("image_upload_btn");

    // $(".js-example-basic-single-1").select2();

    $(function() {
        $(document).on("change",".uploadFile", function(){
            var uploadFile = $(this);
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return;
            // no file selected, or no FileReader support

            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
                imageFile = files[0];
                reader.onloadend = function(){ // set image data as background of div
                    //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                    let imageForm = uploadFile.closest(".row");
                    imageForm.find('.imagePreview').css("background-image", "url("+this.result+")");
                    readImageMetaData(files[0], imageForm);
                }
            }

        });

        $(".imgAdd").click(function(){
            if(!checkForContributor()) return;

            let imageAdded = addImageToList();
            if(!imageAdded) {
                imageFormValidationError();

            } else {
                lastForm.classList.remove("was-validated");
                let newForm = createNewImageForm();
                newForm.classList.add('dynamic-imgUp');
                document.querySelector(".form-rows").append(newForm);

                newForm.querySelector('.tags-input').setAttribute("id", `tags${newForm.dataset.index}`);

                $('.js-example-basic-single').select2();

                imageFile = null;
                $(`.tags-input`).tokenfield();
                $('.creation-date').datepicker();
                formCount++;
            }

            // console.log(images);

        });

        $(document).on("click", "i.del" , function(event) {
            let imgForm = event.target.closest(".imgUp");
            let imageInput = imgForm.querySelector(".uploadFile");
            if(imageInput.files.length > 0) {
                images.pop();
            }
            imgForm.remove();

        });
    });

    imageSubmitBtn.addEventListener("click", function() {
        // alert(contributor);
        if(!checkForContributor()) return;
        
        masterId = null;
        if(!addImageToList()) {
            // console.log("Image not added");
            imageFormValidationError();
        } else {
            // console.log("Image added");
            uploadImage();
        }

    });

    $('#tags').tokenfield({
        autocomplete:{
            source: [],
            delay:100
        },
        showAutocompleteOnFocus: true
    });

    $(".creation-date").datepicker();

    $(".main-category").change(getSubCategories);

});

function getSubCategories(e){
    let target = e.target,
        value = target.value;
    let imageForm = target.closest(".imgUp");
    let subCategoryElement = imageForm.querySelector(".sub-category");
    subCategoryElement.innerHTML = "";
    let formData = new FormData();
    formData.append("categoryId", value);
    fetch(`${baseUrl}/get_sub_categories`, {
        method: 'POST',
        headers: {
            "X-CSRF-TOKEN": csrf
        },
        body: formData
    }).then(res => res.json())
        .then(res => {
            let subCategories = res.subCategories;
            subCategories.forEach(function(category) {
                let option = document.createElement("option");
                option.setAttribute("value", category.id);
                option.textContent = category.cat_name;
                subCategoryElement.append(option);
            });

        })
}

function imageFormValidationError() {
    if(!imageFile) {
        swal({
            title: "Missing image file!",
            text: "Image is required",
            icon: "alert",
        });
    }
    lastForm.querySelector(".image-width").setAttribute("required","");
    lastForm.querySelector(".image-height").setAttribute("required","");
    lastForm.classList.add("was-validated");
}

function readImageMetaData(image, imageForm) {
    //showLoader();
    $('.loader_global').show();
    imageForm = imageForm[0];
    let formData = new FormData();
    formData.append("image", image);
  
    fetch(`${baseUrl}/get_image_metas`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrf
        },
        body: formData
    })
        .then(res => res.json())
        .then(res => {
            let metaData = res.data;
            let height = metaData["Height"];
            let width = metaData["Width"];

            let keywords = metaData["Keywords"] || [];
            imageForm.querySelector(".image-height").value = height;
            imageForm.querySelector(".image-width").value = width;
            imageForm.querySelector(".image-author").value = metaData["Author"];
            imageForm.querySelector(".image-country").value = metaData["Country"];
            imageForm.querySelector(".image-city").value = metaData["City"];
            imageForm.querySelector(".image-state").value = metaData["State"];
            imageForm.querySelector(".image-postal-code").value = metaData["PostalCode"];
            imageForm.querySelector(".image-email").value = metaData["Email"];
            imageForm.querySelector(".image-website").value = metaData["Website"];
            imageForm.querySelector(".image-phone").value = metaData["Phone"];
            imageForm.querySelector(".image-caption").value = metaData["Caption"];
            imageForm.querySelector(".image-headline").value = metaData["Headline"];
            imageForm.querySelector(".image-title").value = metaData["Title"];
            imageForm.querySelector(".image-copyright").value = metaData["Copyright"];
            imageForm.querySelector(".creation-date").value = metaData["CreationDate"];
            if(keywords.length > 0) {
                let tagInput = imageForm.querySelector('.tags-input');
                let id = tagInput.getAttribute("id");
                $(`#${id}`).tokenfield('setTokens', keywords);
            }

            // removeLoader();
            $('.loader_global').hide();

        }).catch(function(error) {
            console.log(error);
    })
}

function addImageToList() {
    let imageForms = [...document.querySelectorAll(".individual-image-form")];
    lastForm = imageForms[imageForms.length-1];
    let tagInputId = "tags";
    if(lastForm.dataset.index) {
        tagInputId = `tags${lastForm.dataset.index}`;

        console.log(tagInputId);
    }

    let imageFile = lastForm.querySelector(".uploadFile").files[0];

    let imageObj = {image: imageFile};

    let height= lastForm.querySelector(".image-height").value;
    let width = lastForm.querySelector(".image-width").value;
    let author = lastForm.querySelector(".image-author").value;
    let country = lastForm.querySelector(".image-country").value;
    let city = lastForm.querySelector(".image-city").value;
    let state = lastForm.querySelector(".image-state").value;
    let postalCode = lastForm.querySelector(".image-postal-code").value;
    let caption = lastForm.querySelector(".image-caption").value;
    let email = lastForm.querySelector(".image-email").value;
    let phone = lastForm.querySelector(".image-phone").value;
    let website = lastForm.querySelector(".image-website").value;
    let copyright = lastForm.querySelector(".image-copyright").value;
    let headline = lastForm.querySelector(".image-headline").value;
    let title = lastForm.querySelector(".image-title").value;
    let creationDate = lastForm.querySelector(".creation-date").value;
    let category = lastForm.querySelector(".main-category").value;
    let subCategory = lastForm.querySelector(".sub-category").value;
    let keywords = $(`#${tagInputId}`).tokenfield('getTokensList');
    let orientation = lastForm.querySelector(".orientation").value;
    let people = lastForm.querySelector(".no_people").value;
    let composition = lastForm.querySelector(".people_composition").value;
    let specificPeople = lastForm.querySelector(".specific_people").value;
    let location = lastForm.querySelector(".location").value;
    let metas = {};

    imageObj.height = height;
    imageObj.width = width;
    imageObj.category = category;
    imageObj.subCategory = subCategory;
    imageObj.orientation = orientation;
    imageObj.people = people;
    imageObj.composition = composition;
    imageObj.specificPeople = specificPeople;
    imageObj.location = location;
    metas.Author = author || "";
    metas.Country = country || "";
    metas.City = city || "";
    metas.Caption = caption || "";
    metas.Copyright = copyright || "";
    metas.Email = email || "";
    metas.Phone = phone || "";
    metas.Website = website || "";
    metas.Headline = headline || "";
    metas.Title = title || "";
    metas.State = state || "";
    metas.PostalCode = postalCode || "";
    metas.Keywords = keywords || "";
    metas.CreationDate = creationDate || "";
    imageObj.metas = metas;
    if(imageObj.image && imageObj.height && imageObj.width) {
        images.push(imageObj);
        return true;
    } else {
        return false;
    }
}

function uploadImage(event) {
    if(!checkForContributor()) return;
    showCustomLoader();
    let imageObj = images.pop();
    if(!imageObj) {
        swal({
            title: "Success!!",
            text: "Images are uploaded successfully!",
            icon: "success",
        });
        $(".dynamic-imgUp").remove();
        let mainForm = document.querySelector('.imgUp');
        mainForm.querySelector('.imagePreview').removeAttribute('style');
        [...mainForm.querySelectorAll('input')].forEach(input => {
            input.value = '';
        });
        $(".token").remove();
        removeCustomLoader();
        return ;
    }

    let image = imageObj.image;
    let formData = new FormData();
    formData.append("image", image);
    formData.append("width", imageObj.width || "");
    formData.append("height", imageObj.height || "");
    formData.append("category", imageObj.category || "");
    formData.append("subCategory", imageObj.subCategory || "");
    formData.append("contributor", contributor);
    formData.append("specificPeople", imageObj.specificPeople);
    formData.append("location", imageObj.location);
    formData.append("orientation", imageObj.orientation);
    formData.append("people", imageObj.people);
    formData.append("composition", imageObj.composition);
    formData.append("metas", JSON.stringify(imageObj.metas));
    if(masterId) {
        formData.append("masterId", masterId);
    }
    saveImage(formData)
}

function saveImage(formData) {
    fetch(`${baseUrl}/upload_image`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrf
        },
        body: formData
    })
        .then(res => res.json())
        .then(res => {
            masterId = res.data;
            uploadImage();

        })
}


function checkForContributor()
{
    if(contributor) return true;
    else if(!contributor) {
        let contributorSelect = document.getElementById("contributor");
        contributor = contributorSelect.value;
        if(!contributor) {
            swal("Select a contributor");
            return false;
        } else {
            return true;
        }
    }
}
