$(document).ready(function() {
     
});
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
            $(`#image_usage_sub_cat-${id}`).html('`<option >Details of use</option>`');
            $.each(res,function(i, el) {
                let makeOption = `<option value="${el.id}">${el.sub_cat_name}</option>`;
                $(`#image_usage_sub_cat-${id}`).append(makeOption)
            });
        }
    });
};