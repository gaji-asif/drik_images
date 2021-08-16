let final_details_of_use_price = 0.0;
let final_image_size_price = 0.0;
let final_print_run_price = 0.0;
let final_inserts_price = 0.0;
let final_placement_price = 0.0;
let final_duration_price = 0.0;
let final_country_price = 0.0;
let final_industry_sector_price = 0.0;
let final_price = 0.0;
let isComplete = false;

imageUsage = function (obj,id){

    var cat_id = obj.value;
    $.ajax({
        url: `${baseUrl}/image_usages_sub_category`,
        type: "get",
        data: {
            cat_id: cat_id
        },
        cache: false,
        success: function(response){
            let res = JSON.parse(response);
            $(`#image_usage_sub_cat-${id}`).html('');
            $(`#image_usage_sub_cat-${id}`).html('`<option  data-price="0">Details of use</option>`');
            $.each(res,function(i, el) {
                let makeOption = `<option value="${el.id}" data-price="${el.price}"> ${el.sub_cat_name}</option>`;
                $(`#image_usage_sub_cat-${id}`).append(makeOption)
            });
        }
    });
};

detailsOfUse = function (obj,id){
    let optionId = obj.value;
    let price = $(obj).find(':selected').data('price');
    final_details_of_use_price = Number(price) ?? 0.0;
    isComplete ? processPrice(id) : '' ;
};

imageSize = function (obj,id){
    let optionId = obj.value;
    let price = $(obj).find(':selected').data('price');
    final_image_size_price = Number(price) ?? 0.0;
    isComplete ? processPrice(id) : '' ;

};

printRun = function (obj,id){
    let optionId = obj.value;
    let price = $(obj).find(':selected').data('price');
    final_print_run_price = Number(price) ?? 0.0;
    isComplete ? processPrice(id) : '' ;

};

insertss = function (obj,id){
    let optionId = obj.value;
    let price = $(obj).find(':selected').data('price');
    final_inserts_price = Number(price) ?? 0.0;
    isComplete ? processPrice(id) : '' ;
};

placement = function (obj,id){
    let optionId = obj.value;
    let price = $(obj).find(':selected').data('price');
    final_placement_price = Number(price) ?? 0.0;
    isComplete ? processPrice(id) : '' ;
};
duration = function (obj,id){
    let optionId = obj.value;
    let price = $(obj).find(':selected').data('price');
    final_duration_price = Number(price) ?? 0.0;
    isComplete ? processPrice(id) : '' ;
};

country = function (obj,id){
    let optionId = obj.value;
    let price = $(obj).find(':selected').data('price');
    final_country_price = Number(price) ?? 0.0;
    isComplete ? processPrice(id) : '' ;
};

industrySectors = function (obj,id){
    let optionId = obj.value;
    let price = $(obj).find(':selected').data('price');
    final_industry_sector_price = Number(price) ?? 0.0;
    // console.log(final_industry_sector_price);
    if(price)
    {
        processPrice(id);
        isComplete = true;
    }
    else
    {
        $(`#final_price-${id}`).html("");
        $(`#final_price-${id}`).html(`0.0`);
        isComplete = false;
        // final_price = 0.0;
        // final_details_of_use_price = 0.0;
        // final_image_size_price = 0.0;
        // final_print_run_price = 0.0;
        // final_inserts_price = 0.0;
        // final_placement_price = 0.0;
        // final_duration_price = 0.0;
        // final_country_price = 0.0;
        // final_industry_sector_price = 0.0;
       
    }
};

processPrice = function (id){

    final_price = 100+final_details_of_use_price + final_image_size_price + final_print_run_price + final_inserts_price + final_placement_price + final_duration_price + final_country_price + final_industry_sector_price;
    // console.log();
    final_price = Number(final_price).toFixed(2);
    $(`#final_price-${id}`).html("");
    $(`#final_price-${id}`).html(`${final_price}`);
    // document.getElementByClass('download-btn').disabled = false;
};


openOther = function (id){
    let form = document.getElementById(`image_details-${id}`);
    let size = form.querySelector('.form-check-input:checked');
    if(size !== null)
    {
        size.checked = false;
    }
    // document.getElementByClass('download-btn').disabled = true;
};