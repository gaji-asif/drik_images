
$(function(){
    // $(".datepicker").datepicker({
    //     dateFormat: "dd-mm-yy",
    //     yearRange: '1950:2080',
    //     changeMonth: true,
    //     changeYear: true,
    //     autoclose:true,
    //         endDate: "today",
    //         maxDate: today
    // });


    var today = new Date();
        $('.datepicker').datepicker({
            dateFormat: "dd-mm-yy",
        yearRange: '1950:2080',
        changeMonth: true,
        changeYear: true,
        autoclose:true,
            endDate: "today",
            maxDate: today
            
        }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });


        $('.datepicker').keyup(function () {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9^-]/g, '');
            }
        });
});

$(document).ready(function () {
        var today = new Date();
        $('.datepicker').datepicker({
            //format: 'mm-dd-yyyy',
            
        }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });


        $('.datepicker').keyup(function () {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9^-]/g, '');
            }
        });
    });


$('.input-effect input').each(function() {
	if ($(this).val().length > 0) {
		$(this).addClass('read-only-input');
	} else {
		$(this).removeClass('read-only-input');
	}

	$(this).on('keyup', function() {
		if ($(this).val().length > 0) {
			$(this).siblings('.invalid-feedback').fadeOut('slow');
		} else {
			$(this).siblings('.invalid-feedback').fadeIn('slow');
			$(this).removeClass('is-invalid');
		}
	});
});


$(document).ready(function(){
	// **Side bar changes 
	  	// get browser url,split and get last / url
		var get_url = $(location).attr("href").split('/').pop();


		//If there is home route which is / or "" then it will not process
		if(get_url != "") {
			// Get parent class of that last url, split, and get main class
			var get_parent_classes = $('.'+get_url).parent().parent().attr('class');
			//check for create,edit,update there is no parent class
			if(get_parent_classes != undefined) {
				var get_parent_classes = get_parent_classes.split(" ");
				var get_parent_class = '';
				for(var i = 0;i < get_parent_classes.length;i++) {
					if( get_parent_classes[i] != 'pcoded-hasmenu' || get_parent_classes[i] != 'pcoded-trigger' || get_parent_classes[i] != 'active' ) {
						get_parent_class = get_parent_classes[i];
					}
				}
				// this lines are for active those classes
				$('.pcoded-hasmenu').removeClass("active");
				$('.pcoded-hasmenu').removeClass("pcoded-trigger");
			    $('.'+get_parent_class).addClass("active");
			    $('.'+get_parent_class).addClass("pcoded-trigger");
			    $('.'+get_url).addClass("active");
			}
		}
});


// This lines for toggle credit and debit amount in add-new-coa module
$('input[name=debit_credit_amount]').change(function(){
	var value = $( 'input[name=debit_credit_amount]:checked' ).val();
	if( value == 'debit' ) {
		$('.debit_div').show();
		$('.credit_div').hide();
	} else if( value == 'credit' ) {
		$('.debit_div').hide();
		$('.credit_div').show();
	}
});

