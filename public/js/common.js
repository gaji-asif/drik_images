const baseUrl = "http://localhost/drik";
const csrf = $('meta[name="csrf-token"]').attr('content');

const preLoader = $("\t<div class=\"theme-loader\">\n" +
    "\t\t<div class=\"loader-track\">\n" +
    "\t\t\t<div class=\"preloader-wrapper\">\n" +
    "\t\t\t\t<div class=\"spinner-layer spinner-blue\">\n" +
    "\t\t\t\t\t<div class=\"circle-clipper left\">\n" +
    "\t\t\t\t\t\t<div class=\"circle\"></div>\n" +
    "\t\t\t\t\t</div>\n" +
    "\t\t\t\t\t<div class=\"gap-patch\">\n" +
    "\t\t\t\t\t\t<div class=\"circle\"></div>\n" +
    "\t\t\t\t\t</div>\n" +
    "\t\t\t\t\t<div class=\"circle-clipper right\">\n" +
    "\t\t\t\t\t\t<div class=\"circle\"></div>\n" +
    "\t\t\t\t\t</div>\n" +
    "\t\t\t\t</div>\n" +
    "\t\t\t\t<div class=\"spinner-layer spinner-red\">\n" +
    "\t\t\t\t\t<div class=\"circle-clipper left\">\n" +
    "\t\t\t\t\t\t<div class=\"circle\"></div>\n" +
    "\t\t\t\t\t</div>\n" +
    "\t\t\t\t\t<div class=\"gap-patch\">\n" +
    "\t\t\t\t\t\t<div class=\"circle\"></div>\n" +
    "\t\t\t\t\t</div>\n" +
    "\t\t\t\t\t<div class=\"circle-clipper right\">\n" +
    "\t\t\t\t\t\t<div class=\"circle\"></div>\n" +
    "\t\t\t\t\t</div>\n" +
    "\t\t\t\t</div>\n" +
    "\t\t\t\t<div class=\"spinner-layer spinner-yellow\">\n" +
    "\t\t\t\t\t<div class=\"circle-clipper left\">\n" +
    "\t\t\t\t\t\t<div class=\"circle\"></div>\n" +
    "\t\t\t\t\t</div>\n" +
    "\t\t\t\t\t<div class=\"gap-patch\">\n" +
    "\t\t\t\t\t\t<div class=\"circle\"></div>\n" +
    "\t\t\t\t\t</div>\n" +
    "\t\t\t\t\t<div class=\"circle-clipper right\">\n" +
    "\t\t\t\t\t\t<div class=\"circle\"></div>\n" +
    "\t\t\t\t\t</div>\n" +
    "\t\t\t\t</div>\n" +
    "\t\t\t\t<div class=\"spinner-layer spinner-green\">\n" +
    "\t\t\t\t\t<div class=\"circle-clipper left\">\n" +
    "\t\t\t\t\t\t<div class=\"circle\"></div>\n" +
    "\t\t\t\t\t</div>\n" +
    "\t\t\t\t\t<div class=\"gap-patch\">\n" +
    "\t\t\t\t\t\t<div class=\"circle\"></div>\n" +
    "\t\t\t\t\t</div>\n" +
    "\t\t\t\t\t<div class=\"circle-clipper right\">\n" +
    "\t\t\t\t\t\t<div class=\"circle\"></div>\n" +
    "\t\t\t\t\t</div>\n" +
    "\t\t\t\t</div>\n" +
    "\t\t\t</div>\n" +
    "\t\t</div>\n" +
    "\t</div>");


const customPreloader = $(`<div style="width: 100vw; height: 100%; display: flex; justify-content: center; align-items: center; z-index: 1000; position: fixed; top: 0; left:0; background: #ffffff70" class="custom-preloader"><img style="width: 25%;" src="${baseUrl}/public/images/loader.gif"></div>`);


function showCustomLoader()
{
    $("body").append(customPreloader);
}

function showLoader() {
    $("body").append(preLoader);
}

function removeLoader() {
    let preLoader = document.querySelector(".theme-loader");
    if(preLoader) preLoader.remove();
}

function removeCustomLoader()
{
    let preLoader = document.querySelector(".custom-preloader");
    if(preLoader) preLoader.remove();
}

function imageGrid(imageObj) {
    let grid =  $(`<div class="grid-item grid-image">
                        <div class="img">
                            <img class="w-100" src="${imageObj.thumbnail_url}" alt="" />
                            <div class="img-details">
                                <p class="category-name">Mountains</p>
                                <h4 class="image-name">Mountains with Cloud and Lake</h4>
                            </div>
                            <div class="corner-top"></div>
                            <div class="corner-bottom"></div>
                            <a href="#" class="image-popup" data-toggle="modal" data-target="#image_details-${imageObj.id}"></a>
                        </div>
                        <div class="modal fade" id="image_details-${imageObj.id}" tabindex="-1" role="dialog" aria-labelledby="image_detailsTitle" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="modal-close" data-dismiss="modal">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <div class="form-row align-items-center">
                                            <div class="col-md-9">
                                                <div class="full-img">
                                                    <img class="w-100" src="${imageObj.thumbnail_url}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="author">
                                                    <div class="author-img">
                                                        <img class="w-100" src="${imageObj.thumbnail_url}" alt="">
                                                    </div>
                                                    <div class="author-info">
                                                        <span class="author-name">Author Name</span>
                                                    </div>
                                                </div>
                                                <div class="actions text-center">
                                                    <button class="btn author-action-button"><i class="icofont-like"></i>&nbsp;50</button>
                                                    <button class="btn author-action-button"><i class="icofont-star"></i>&nbsp;50</button>
                                                    <button class="btn author-action-button"><i class="icofont-share"></i>&nbsp;50</button>
                                                </div>
                                                <div class="purchase">
                                                    <h6>PURCHASE A LICENSE</h6>
                                                    <div class="list-group">
                                                        <div class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="image-sizes" id="smallRadio" value="small_price">
                                                                <label class="form-check-label" for="smallRadio">Small</label>
                                                            </div>
                                                            <span class="badge badge-pill">$ ${imageObj.small_price}</span>
                                                        </div>
                                                        <div class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="image-sizes" id="mediumRadios" value="medium_price">
                                                                <label class="form-check-label" for="mediumRadios">Medium</label>
                                                            </div>
                                                            <span class="badge badge-pill">$ ${imageObj.medium_price}</span>
                                                        </div>
                                                        <div class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="image-sizes" id="largeRadio" value="large_price">
                                                                <label class="form-check-label" for="largeRadio">Large</label>
                                                            </div>
                                                            <span class="badge badge-pill">$ ${imageObj.large_price}</span>
                                                        </div>
                                                    </div>
                                                    <div class="enter-promo_code">
                                                        <div class="form-group form-row align-items-center">
                                                            <label for="promo_code" class="col-sm-7 col-form-label">Discount/Promo Code&nbsp;&nbsp;:</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" id="promo_code" placeholder="Promo Code">
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-row align-items-center">
                                                            <label for="price" class="col-sm-7 col-form-label">Price (After discount)&nbsp;&nbsp;:</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" id="price" placeholder="0.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="download">
                                                        <button onclick="addToCart(${imageObj.id})" class="btn btn-block download-btn" data-dismiss="modal"><i class="icofont-download"></i> Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`);

    return grid[0];
}

function cartItem(product) {
    let row = $(`<tr>
             
                    <td class="v-align-middle">
                        <div class="product d-flex align-items-center">
                            <div class="product-image">
                                <img class="w-100" src="${product.thumbnail_url}" alt="">
                            </div>
                            <div class="product-info">
                                <table class="table table-bordered m-0">
                                    <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>${product.title}&nbsp;&nbsp;|&nbsp;&nbsp;1205797237</td>
                                    </tr>
                                    <tr>
                                        <td>Size</td>
                                        <td>4445 x 6668 px (14.82 x 22.23 in.) - 300 dpi - RGB File size on download 15 MB</td>
                                    </tr>
                                    <tr>
                                        <td>License type:</td>
                                        <td>Royalty-free|View license summaries</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                    <td class="v-align-middle w-10 text-right">৳ ${product.price}</td>
                    <td class="v-align-middle w-5 text-right">
                        <button onclick="removeFromCart(${product.id})" class="product-minus"><i class="icofont-close"></i></button>
                    </td>
                </tr>`);

    return row[0];
}

function refreshCart() {
    let drikCart = document.getElementById("drik-cart");
    let cartTotal = document.getElementById("cart-total");
    let cartCount = document.getElementById("cart-count");
    drikCart.innerHTML = "";

    fetch(`${baseUrl}/get_cart`)
        .then(res => res.json())
        .then(res => {
            let cart = res.data;
            let products = Object.values(cart);
            cartCount.textContent = products.length;
            let total = 0;
            products.forEach(product => {
                total += product.price;
                let productRow = cartItem(product);
                drikCart.append(productRow);
            });
            cartTotal.textContent = total;
        })
}

function addToCart(imageId) {

    let form = document.getElementById(`image_details-${imageId}`);
    // console.log(form);
    let size = form.querySelector('.form-check-input:checked').value;
    let formData = new FormData();
    formData.append('imageId', imageId);
    formData.append('size', size);
    fetch(`${baseUrl}/add_to_cart`, {
        method: 'POST',
        headers: {
            "X-CSRF-TOKEN": csrf
        },
        body: formData
    }).then(res => res.json())
        .then(res => {
            $(".add_to_card_icon").attr( "data-count", res['cart_item_count'] );
            refreshCart();
        })
}

function removeFromCart(productId) {
    let formData = new FormData();
    formData.append('productId', productId);
    fetch(`${baseUrl}/remove_from_cart`, {
        method: 'POST',
        headers: {
            "X-CSRF-TOKEN": csrf
        },
        body: formData
    }).then(res => res.json())
        .then(res => {
            $(".add_to_card_icon").attr( "data-count", res['cart_item_count'] );
            $(".cart_item_count").text( res['cart_item_count']);
        
            refreshCart();
        });
}
function getPromoCode(){
    let promoCode =  $("#promo-code_input").val();
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
      url: `${baseUrl}/get_promo_code`, 
      type: "post",
      data: {promoCode: promoCode},
      success: function( data ) {
        if(data.status == "success"){
            let subTotal = $("#subtotal").text();
            let promocodeAmount = data.data;
            //add subtotal with promocodeAmount 
            let total = Number(subTotal) - Number(promocodeAmount);
            if(total<=0){
                total = 0.0;     
            }
            $("#total").text(total.toFixed(2));
            $("#total_input").val(total.toFixed(2));
            $("#promo_code_input").val(promoCode);
            if(!$(".invalid_promo_code").hasClass("invalid_promo_code_display_none"))
            {
                $(".invalid_promo_code").addClass("invalid_promo_code_display_none");
            }
          
        }
        else{
            $(".promo_code_div").addClass("mb-2");
            $(".invalid_promo_code").removeClass("invalid_promo_code_display_none");
            let subTotal = $("#subtotal").text();
            $("#total").text(subTotal);
            $("#total_input").val(subTotal.toFixed(2));
            $("#promo_code_input").attr('value', '');
        }
      }
    });

 }
$(document).ready(function () {
    getTotal();
    function getTotal(){
        let total = 0;
        $(".price").each(function(){
            total += parseFloat($(this).val());
        });
        $("#subtotal").text(total.toFixed(2));
        $("#total").text(total.toFixed(2));
        $("#subtotal_input").val(total.toFixed(2));
        $("#total_input").val(total.toFixed(2));
    }

   
});
