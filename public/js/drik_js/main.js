
!(function (e) {
    "use strict";
    e(window).on("load", function () {
        e(".preloader-wrap").fadeOut(1e3);
    });
})(jQuery);


$(document).ready(function () {
    // for cart
    function cart_open() {
        document.getElementById("mySidebar").style.marginRight = "0%";
        document.getElementById("mySidebar").style.transition = "all 0.3s";
        document.getElementById("openNav").style.display = "none";
    }
    function cart_close() {
        document.getElementById("mySidebar").style.marginRight = "-110%";
        document.getElementById("mySidebar").style.transition = "all 0.3s";
        document.getElementById("openNav").style.display = "inline-block";
    }
});

$(function () {
    "use strict";
    //for sticky
    $(window).scroll(function () {
        var scroll = $(this).scrollTop();
        if (scroll >= 100) {
            $(".header").addClass("sticky");
        } else {
            $(".header").removeClass("sticky");
        }
    });



    $(".form-control").on("input", function () {
        var $field = $(this).closest(".form-group");
        if (this.value) {
            $field.addClass("field--not-empty");
        } else {
            $field.removeClass("field--not-empty");
        }
    });

    $(".btn-light").click(function () {
        if ($(".calc_input").hasClass("needClear")) {
            if ($(this).hasClass("btn-num")) {
                $(".calc_input").val("");
            }

            $(".calc_input").removeClass("needClear");
            if ($(this).hasClass("btn-act")) {
                $(".calc_input").removeClass("needClear");
            }
        }

        var currente_val = $(".calc_input").val();
        var val = $(this).data("val");
        $(".calc_input").val(currente_val + val);
    });

    $(".btn-warning").click(function () {
        $(".calc_input").val("");
    });

    $(".btn-success").click(function () {
        var val = $(".calc_input").val().split(" ");

        if (val[1] == "/") {
            result = parseInt(val[0]) / parseInt(val[2]);
        }

        if (val[1] == "x") {
            result = parseInt(val[0]) * parseInt(val[2]);
        }

        if (val[1] == "-") {
            result = parseInt(val[0]) - parseInt(val[2]);
        }

        if (val[1] == "+") {
            result = parseInt(val[0]) + parseInt(val[2]);
        }

        $(".calc_input").val(result.toLocaleString());
        $(".calc_input").addClass("needClear");
    });


    // for Quantity
    document.querySelector(".qty_minus_btn").setAttribute("disabled", "disabled");
    var valueCount;

    document.querySelector(".qty_plus_btn").addEventListener("click", function () {
        valueCount = document.getElementById("qty").value;

        valueCount++;

        document.getElementById("qty").value = valueCount;

        if ((valueCount = 1)) {
            document.querySelector(".qty_minus_btn").removeAttribute("disabled");
        }
    });
    document.querySelector(".qty_minus_btn").addEventListener("click", function() {
        valueCount = document.getElementById("qty").value;

        valueCount--;

        document.getElementById("qty").value = valueCount;

        if(valueCount == 1){
            document.querySelector(".qty_minus_btn").setAttribute("disabled","disabled")
        }
    })
});
