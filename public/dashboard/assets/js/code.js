


let walletType = (type, tr) => {

	$(".nav-wallets .active").removeClass('active');
    
    $(".items-button .active").removeClass('active');
	if(tr){
		$(tr).addClass('active');
	}

	switch (type) {
		case 1:
			$("#section_one").show();
			$("#section_two").show();
			break;

		case 2:
			$("#section_one").show();
			$("#section_two").hide();
			break;

		case 3:
			$("#section_one").hide();
			$("#section_two").show();
			break;
		default:
			break;
	}
} 

let walletSearch = (tr) => {

	var value = $(tr).val();
  	var patt = new RegExp(value.toUpperCase(), "i");


  	$('#section_one').find('.item-wallet-list').each(function() {
	    let list = $(this);

	    if (!(list.find('.is-search-js').text().search(patt) >= 0)) {
	      	$(this).hide();
	    }

	    if((list.find('.is-search-js').text().search(patt) >= 0)) {
	      $(this).show();
	    }
	    
	});

	$('#section_two').find('.crypto-wallet-list').each(function() {
	    let list = $(this);

	    if (!(list.find('.crypto-code-js').text().search(patt) >= 0)) {
	      	$(this).hide();
	    }

	    if((list.find('.crypto-code-js').text().search(patt) >= 0)) {
	      $(this).show();
	    }
	    
	});

  	//console.log(patt);
}


let pricesSearch = (tr) => {


	var value = $(tr).val();
  	var patt = new RegExp(value.toUpperCase(), "i");


  	$('#section_one').find('tr').each(function() {
	    let list = $(this);

	    if (!(list.find('.is-symbol-search-js').text().search(patt) >= 0)) {
	      	$(this).hide();
	    }

	    if ((list.find('.is-symbol-search-js').text().search(patt) >= 0)) {
	      $(this).show();
	    }
	    
	});


}


function relDiffPrivate(a, b) {
 return  100 * Math.abs( ( a - b ) / ( (a+b)/2 ) );
}


let maxPrivate = (input) => {
  if (toString.call(input) !== "[object Array]")  return false;
  return Math.max.apply(null, input);
}

let minPrivate = (array) => {
    return Math.min.apply( Math, array );
};


