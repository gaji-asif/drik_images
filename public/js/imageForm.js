const dynamicImageForm = $($.parseHTML('<div class="row dynamic-imgUp">\n' +
    '                                                            <div class="col-md-3" style="padding-top: 12%;">\n' +
    '                                                                <div class="imagePreview"></div>\n' +
    '                                                                <label class="btn btn-primary theme-btn">\n' +
    '                                                                    Upload Your Image<input type="file" required class="uploadFile img" value="Upload Photo" >\n' +
    '                                                                </label>\n' +
    '                                                            </div>\n' +
    '\n' +
    '                                                            <div class="col-md-9">\n' +
    '\n' +
    '                                                        <div class="row loader_global">\n' +
    '                                                            <img style="margin: 0 auto; margin-bottom: 10px;" src="{{asset(\'public/images/loading.gif\')}}" width="10%">\n' +
    '                                                        </div>\n' +
    '                                                        <div class="">\n' +
    '                                                            <div class="iptc_metadata">\n' +
    '                                                                <div class="form-row">\n' +
    '                                                                    <div class="col-md-12 text-left">\n' +
    '                                                                        <h6 style="font-size: 21px; font-weight: bold; margin-bottom: 20px; margin-top: 20px;">IPTC Metadata</h6>\n' +
    '                                                                    </div>\n' +
    '                                                                    <div class="col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center category-select-group">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label style="font-weight: bold;" for="info1 mb-0">Category</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="form-group col-sm-9 col-md-10 col-lg-9">\n' +
    '                                                                            <select style="border: 1px solid #3434" required class="col-sm-12 main-category form-control" name="category" id="category">\n' +
    '                                                                            </select>\n' +
    '                                                                            <div class="invalid-feedback">\n' +
    '                                                                                Category is required\n' +
    '                                                                            </div>\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center sub-category-select-group">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info1 mb-0">Sub category</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="form-group col-sm-9 col-md-10 col-lg-9">\n' +
    '                                                                            <select style="border: 1px solid #3434" class="form-control col-sm-12 sub-category form-select sub-category" name="sub-category" id="sub-category">\n' +
    '                                                                            </select>\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center height-input-group">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info1 mb-0">Height</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-9 col-md-10 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-height" placeholder="Info-1">\n' +
    '                                                                            <div class="invalid-feedback">\n' +
    '                                                                                Height is required\n' +
    '                                                                            </div>\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info2 mb-0">Width</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-9 col-md-10 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-width" placeholder="Info-2">\n' +
    '                                                                            <div class="invalid-feedback">\n' +
    '                                                                                Width is required\n' +
    '                                                                            </div>\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="artist mb-0">Author</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-9 col-md-10 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-author" placeholder="Author">\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info4 mb-0">Country</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-9 col-md-10 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-country" placeholder="Country">\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info5 mb-0">City</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-9 col-md-10 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-city" placeholder="City">\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info7 mb-0">State</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-12 col-md-9 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-state" placeholder="State">\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info7 mb-0">Postal code</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-12 col-md-9 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-postal-code" placeholder="Postal code">\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info6 mb-0">Caption</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-9 col-md-10 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-caption" placeholder="Caption">\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info7 mb-0">Copyright</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-12 col-md-9 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-copyright" placeholder="Copyright">\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info7 mb-0">Email</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-12 col-md-9 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-email" placeholder="Email">\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info7 mb-0">Phone</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-12 col-md-9 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-phone" placeholder="Phone">\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info7 mb-0">Website</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-12 col-md-9 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-website" placeholder="Website">\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info7 mb-0">Headline</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-12 col-md-9 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-headline" placeholder="Headline">\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info7 mb-0">Title</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-12 col-md-9 col-lg-9">\n' +
    '                                                                            <input type="text" class="form-control mb-0 image-title" placeholder="Title">\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">\n' +
    '                                                                        <div class="col-sm-3 col-md-2 col-lg-3">\n' +
    '                                                                            <label for="info7 mb-0">Creation date</label>\n' +
    '                                                                        </div>\n' +
    '                                                                        <div class="col-sm-12 col-md-9 col-lg-9">\n' +
    '                                                                            <input id="creation-date" class="creation-date form-control" type="text" class="form-control">\n' +
    '                                                                        </div>\n' +
    '                                                                    </div>\n' +
    '                                                                    <div class="form-group col-sm-12 col-md-12 col-lg-12 text-left form-row align-items-center">\n' +
    '                                                                        <label>Keywords</label>\n' +
    '                                                                        <input type="text" class="form-control tags-input" id="tags" value="" />\n' +
    '                                                                    </div>\n' +
    '                                                                </div>\n' +
    '                                                            </div>\n' +
    '                                                        </div>\n' +
    '\n' +
    '                                                        <div class="row">\n' +
    '                                                           <div class="form-group col-lg-4">\n' +
    '\n' +
    '                                                            <label style="float: left;" for="role_id" class=" col-form-label">Select Oreientation: </label>\n' +
    '\n' +
    '                                                            <select class="js-example-basic-single col-sm-12 {{ $errors->has(\'role_id\') ? \' is-invalid\' : \'\' }}" name="orientation" id="orientation">\n' +
    '                                                                <option value="">Select Oreientation</option>\n' +
    '                                                                <option value="Vertical">Vertical</option>\n' +
    '                                                                <option value="Horizontal">Horizontal</option>\n' +
    '                                                                <option value="Square">Square</option>\n' +
    '                                                                <option value="Panaromic">Panaromic</option>\n' +
    '\n' +
    '                                                            </select>\n' +
    '\n' +
    '\n' +
    '\n' +
    '                                                        </div>\n' +
    '\n' +
    '\n' +
    '\n' +
    '\n' +
    '\n' +
    '                                                        <div class="form-group col-lg-4">\n' +
    '\n' +
    '                                                            <label  style="float: left;" for="role_id" class=" col-form-label">No of people: </label>\n' +
    '\n' +
    '                                                            <select class="js-example-basic-single col-sm-12 {{ $errors->has(\'no_people\') ? \' is-invalid\' : \'\' }}" name="no_people" id="no_people">\n' +
    '                                                                <option value="">Select No</option>\n' +
    '                                                                <option value="1">1 person</option>\n' +
    '                                                                <option value="2">2 person</option>\n' +
    '                                                                <option value="3">3 person</option>\n' +
    '                                                                <option value="0">Group of people</option>\n' +
    '                                                            </select>\n' +
    '\n' +
    '\n' +
    '\n' +
    '                                                        </div>\n' +
    '\n' +
    '                                                        <div class="form-group col-lg-4">\n' +
    '\n' +
    '                                                            <label  style="float: left;" for="role_id" class=" col-form-label">Select Composition: </label>\n' +
    '\n' +
    '                                                            <select class="js-example-basic-single col-sm-12 {{ $errors->has(\'people_composition\') ? \' is-invalid\' : \'\' }}" name="people_composition" id="people_composition">\n' +
    '                                                                <option value="">Select Composition</option>\n' +
    '                                                                <option value="Head Shot">Head Shot</option>\n' +
    '                                                                <option value="Waist Up">Waist Up</option>\n' +
    '                                                                <option value="Full Length">Full Length</option>\n' +
    '                                                                <option value="Three Quarter">Three Quarter</option>\n' +
    '\n' +
    '                                                            </select>\n' +
    '\n' +
    '\n' +
    '\n' +
    '                                                        </div>\n' +
    '                                                    </div>\n' +
    '\n' +
    '                                                        <div class="row mt-4">\n' +
    '\n' +
    '                                                        <div class="form-group col-lg-4">\n' +
    '\n' +
    '                                                            <label>Specific People: </label>\n' +
    '                                                            <input type="text" class="form-control" id="specific_people" value="" />\n' +
    '                                                        </div>\n' +
    '\n' +
    '                                                        <div class="form-group col-lg-4">\n' +
    '\n' +
    '                                                           <label>Location: </label>\n' +
    '                                                           <input type="text" class="form-control" id="location" value="" />\n' +
    '                                                       </div>\n' +
    '                                                   </div>\n' +
    '\n' +
    '                                               </div>\n' +
    '                                           </div>'));

let dynamicFormCount = 1;

function createNewImageForm(){
    // let formElement = dynamicImageForm[0];
    // let categorySelect = document.querySelector(".main-category");
    // formElement.querySelector(".main-category").innerHTML = categorySelect.innerHTML;
    // return formElement;

    let newForm = document.querySelector(".individual-image-form").cloneNode(true);

    newForm.querySelector(".imagePreview").setAttribute("style", "");

    [...newForm.querySelectorAll('input')].forEach(function(input) {
        input.value = "";
    });

    [...newForm.querySelectorAll('select')].forEach(select => {
        select.value = null;
    });

    [...newForm.querySelectorAll(["span.select2"])].forEach(span => span.remove());

    let tagInput = $($.parseHTML('<div class="form-group col-sm-12 col-md-12 col-lg-12 text-left form-row align-items-center">\n' +
        '                                                                                        <label>Keywords</label>\n' +
        '                                                                                        <input type="text" class="form-control tags-input" value="" />\n' +
        '                                                                                    </div>'));

    tagInput = tagInput[0];

    newForm.querySelector('.tags-input-container ').replaceWith(tagInput);

    let newDatepicker = newForm.querySelector('.hasDatepicker');

    newDatepicker.classList.remove('hasDatepicker');

    newDatepicker.removeAttribute("id");

    newForm.dataset.index = dynamicFormCount;

    dynamicFormCount++;


    return newForm;
}
