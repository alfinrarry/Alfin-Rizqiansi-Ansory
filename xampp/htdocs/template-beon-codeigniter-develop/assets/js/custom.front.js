var codepage = $(".section").attr('data-codepage');
if (codepage == "category") {
  $('.wishlist').on('click', function() {
    var id_wishlist=$(this).attr('data-id');
    var id_product=$(this).attr('data-product');
    var type_wishlist=$(this).attr('data-wishlist');
		var _this = $(this);
		var img = $(this);
		$.ajax({
			method: "POST",
			url: location.origin+"/Wishlist/action",
			data: {
				id_wishlist: id_wishlist,
				id_product:id_product,
				type:type_wishlist
			},
			success: function(data) {
				if (type_wishlist=="add") {
					var json=jQuery.parseJSON(data);
					_this.addClass("wishlist product-cta__wishfull");
					_this.attr('data-id',json.id_wishlist);	
					img.attr("src", '<?php echo vendor_url(front/img/icon-wishlist-full.svg)');		
					_this.attr('data-wishlist','remove');
				} else if (type_wishlist=="remove") {        
					_this.attr('class','wishlist product-cta__wishempty');
					_this.removeAttr('data-id');	
					img.attr("src", '<?php echo vendor_url(front/img/icon-wishlist-empty.svg)');		
					_this.attr('data-wishlist','add');
				}
				location.reload();
			}
		});
	});
	$(".cart").on('click', function(){
		var product = $(this).attr('data-id');
		$.ajax({
				type: "POST",
				url: location.origin+"/Cart/addCartBylist",
				data: {product:product}
		});
	});
  //end wishlist
} else if(codepage == "profile_order"){
  // List Transaction
  // List Transaction
	var trx = $('#listOrder').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 3,
			targets: -3
		}
		]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		trx.responsive.recalc();
	});
}else if(codepage == "profile_order_detail"){
	$('form#formUlasan').submit(function (e) {
		$.ajax({
			type: 'POST',
			url: location.origin+"/Review/addReview",
			data: $('#formUlasan').serialize(),
			dataType:'json',
			success: function(data){
				location.reload();
			},
			error: function(data){
				console.log(data,'err');
			}
		})
		e.preventDefault();
	});
} else if(codepage == "profile_ticket"){
  // List Ticket
	var ticket = $('#listTicket').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 3,
			targets: -3
		}
		]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		ticket.responsive.recalc();
	});
} else if(codepage == "profile_address"){
  // List Transaction
	var txt = $('#listAddress').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 2,
			targets: -2
		}
		]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		txt.responsive.recalc();
  });
  $('.set-primary').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		swal({
			title: "Apakah Anda yakin untuk Menjadikan alamat utama?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Berhasil Menjadi Alamat Utama!",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
  });
  $('.del_address').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		swal({
			title: "Apakah Anda yakin untuk menghapus alamat  ini?",
			text: "Alamat yang telah dihapus tidak dapat dikembalikan!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Hapus Halaman Berhasil!",
							text: "Halaman Berhasil Dihapus.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
}else if(codepage == "profile_address_add"){
  $('.select-district').change(function(){
		var subdistrict=$(".select-district option:selected").text();
		$('input[name=subdistrict]').val(subdistrict);
	});

	$('.select-city').change(function(){
		var city=$(".select-city option:selected").text();
		$('input[name=city]').val(city);
		var id_city = $(".select-city").val();
		var url = $(this).attr('data-url');
		$.ajax({
			method: "POST",
			url: url,
			data: {
				id_city: id_city
			},
			success: function(data) {
				$('.select-district').html(data);
			}
		});
	});

	$('.select-province').change(function(){
		var province_name=$(".select-province option:selected").text();
		$('input[name=province_name]').val(province_name);
		var id_province = $(".select-province").val();
		var url = $(".codepage").attr('data-url');
        $.ajax({
            method: "POST",
            url: url,
            data: {
                id_province: id_province
            },
            success: function(data) {
                $('.select-city').html(data);
            }
        });
	});
}else if(codepage == "profile_wishlist"){ 
  // console.log(codepage);
  $('.wishlist').on('click', function() {
    var _url = $(this).attr('data-url');
    var id_wishlist=$(this).attr('data-id');
    var id_product=$(this).attr('data-product');
    var type_wishlist=$(this).attr('data-wishlist');
    var _this = $(this);
		$.ajax({
			method: "POST",
			url: _url,
			data: {
				id_wishlist: id_wishlist,
				id_product:id_product,
				type:type_wishlist
			},
			success: function(data) {
				if (type_wishlist=="add") {
					var json=jQuery.parseJSON(data);
					_this.addClass("wishlist product-cta__wishfull");
					_this.attr('data-id',json.id_wishlist);
					_this.attr('data-wishlist','remove');
				} else if (type_wishlist=="remove") {        
					_this.attr('class','wishlist product-cta__wishempty');
					_this.removeAttr('data-id');
					_this.attr('data-wishlist','add');
				}
				location.reload();
			}
		});
	});
    //end wishlist
}else if(codepage == "profile_ticket_add"){ 
  $('.type_ticket').change(function(){
    var type_ticket=$(".type_ticket option:selected").val();
    // console.log(type_ticket);
    if (type_ticket==1) {
      $('.invoice').show(500);
      $('.payment').hide(500);
      $('.upload').hide(500);
		} else if(type_ticket==2) {
			$('.invoice').hide(500);
      $('.payment').hide(500);
      $('.upload').hide(500);
		}else if(type_ticket==3) {
			$('.invoice').show(500);
      $('.payment').hide(500);
      $('.upload').show(500);
		}else if(type_ticket==4) {
			$('.invoice').show(500);
      $('.payment').show(500);
      $('.upload').show(500);
    }else if(type_ticket == 0){
      $('.invoice').hide(500);
      $('.payment').hide(500);
      $('.upload').hide(500);
    }
  });
} else if(codepage == "product-detail"){
	$('.wishlist').on('click', function() {
    var id_wishlist=$(this).attr('data-id');
    var id_product=$(this).attr('data-product');
    var type_wishlist=$(this).attr('data-wishlist');
		var _this = $(this);
		var img = $(this);
		$.ajax({
			method: "POST",
			url: location.origin+"/Wishlist/action",
			data: {
				id_wishlist: id_wishlist,
				id_product:id_product,
				type:type_wishlist
			},
			success: function(data) {
				if (type_wishlist=="add") {
					var json=jQuery.parseJSON(data);
					_this.addClass("wishlist product-cta__wishfull");
					_this.attr('data-id',json.id_wishlist);	
					img.attr("src", '<?php echo vendor_url(front/img/icon-wishlist-full.svg)');		
					_this.attr('data-wishlist','remove');
				} else if (type_wishlist=="remove") {        
					_this.attr('class','wishlist product-cta__wishempty');
					_this.removeAttr('data-id');	
					img.attr("src", '<?php echo vendor_url(front/img/icon-wishlist-empty.svg)');		
					_this.attr('data-wishlist','add');
				}
				location.reload();
			}
		});
	});
	$(document).ready(function(){
		$("#cart").submit(function(e){
				e.preventDefault();
				var action = $(this).attr('action');
				var product = $("#product").val();;
				var variation= $("#variation").val();
				var qty= $("#qty").val();
				$.ajax({
						type: "POST",
						url: action,
						data: {product:product,variation:variation,qty:qty}
				});
		});
	});

	$(".cart").on('click', function(){
		var product = $(this).attr('data-id');
		$.ajax({
				type: "POST",
				url: location.origin+"/Cart/addCartBylist",
				data: {product:product}
		});
	});
} else if(codepage == "cart"){
	//dynamic price qty
	$('input[name=qty]').change(function(){
		var qty=parseInt($(this).val());
		var price=$(this).attr('data-price');
		var id_cart=$(this).attr('data-id');
		var total_price=qty*price;
		var _url = $(this).attr('data-url');
		var max=parseInt($(this).attr('max'));
		if (qty<=max) {
			$('#price_'+id_cart).html("Rp "+formatMoney(total_price,0));
			$('#price_'+id_cart).attr('data-subprice',total_price);
			var sum = 0;
			$('.product_price').each(function(){
				sum += parseFloat($(this).attr('data-subprice'));
				console.log(sum);  
			});


			$('#subtotal').html("Rp "+formatMoney(sum,0));
			$.ajax({
					type: "POST",
					data:{
						id_cart:id_cart,
						qty:qty
					},
					url: _url,
					success: function (data) {},
					error: function (data) {
						console.log(data);
					}
			})
		}		
	});
	// delet item cart
	$('.del_item').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		swal({
			title: "Apakah Anda yakin untuk menghapus alamat  ini?",
			text: "Alamat yang telah dihapus tidak dapat dikembalikan!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Hapus Halaman Berhasil!",
							text: "Halaman Berhasil Dihapus.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
} else if(codepage == "checkout"){
	$('form#formAddress').submit(function (e) {
		var action = $(this).attr('action');
		console.log(action);
		$.ajax({
			type: 'POST',
			url: location.origin+"/Cart/change_address",
			data: $('#formAddress').serialize(),
			dataType:'json',
			success: function(data){
				$("#list-address").modal("hide");
				location.reload();
			},
			error: function(data){
				console.log(data,'err');
			}
		})
		e.preventDefault();
	});

	$('input[name=courier]').change(function(){
		$('.courier-type').html("");
		var courier = $('input[name=courier]:checked').val();
		var weight = $('input[name=weight]').val();
		var destination = parseInt(($(".id_subdistrict").val()));
		if (destination) {
			$('.loader').show();
			$.ajax({
				method: "POST",
				url: location.origin+"/Cart/getCost",
				data: {
					destination: destination,
					weight: weight,
					courier: courier,
				},
				success: function(data) {
					$('.loader').hide();
					$('.courier-type').html(data);
					var _this = $('input[name=courier_service]:checked');
					var price = _this.attr('data-price');
					$('#shipping_price').html(formatMoney(price,0));
					var total_price=parseInt($('#total_price').attr('data-totalprice'))+parseInt(price);
					$('#total_price').html(formatMoney(total_price,0));
					$('input[name=delivery_fee]').val(price);
				}
			});
		} else {
			swal("Harap Lengkapi Provinsi dan Kota!");
		}
	});
	$('.alert_address').click(function(){
		swal("Harap Tambahkan Alamat Terlebih Dahulu!");
	});

	$(document).on("change",".courier_service", function () {
		var service_name=$('input[name=courier_service]:checked').val();
		var price=$(this).attr('data-price');
		$('#shipping_price').html(formatMoney(price,0));
		var total_price=parseInt($('#total_price').attr('data-totalprice'))+parseInt(price);
		$('#total_price').html(formatMoney(total_price,0));
		$('input[name=delivery_fee]').val(price);
	})

	$('form#formCheckout').submit(function (e) {
		$.ajax({
			type: 'POST',
			url: location.origin+"/Cart/getInovice",
			data: $('#formCheckout').serialize(),
			dataType:'json',
			success: function(data){
				console.log(data);
				if (data.status==false) {
					var status=data.data;
					if (status.length>0) {
						var product="Produk ";
						for (var i = 0; i < status.length; i++) {
							if (i==status.length-1) {
								product+= status[i].title_product+' ';
							} else {
								product+= status[i].title_product+', ';
							}
						}
						product+=" melebebihi stok";
						swal("Harap Check jumlah produk anda pada keranjang", product);
					}
				} else {
					console.log(data,'err');
					window.location.href = data.url;
				}
			},
			error: function(data){
				console.log(data,'err');
			}
		})
		e.preventDefault();
	});

}


// global js
$('#userEmail').change(function(e){
	var email= $('#userEmail').val();
	var atpos = email.indexOf("@");
	var dotpos = email.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
		$('#alamat_email-valid').hide();
		$('#alamat_email-invalid').hide()
		$('#format-invalid').show();
		$(':input[type="submit"]').prop('disabled', true);
	} else {
		$.ajax({
			url: location.origin+"/checkemail",
			method: "POST",
			data: { email: email },
			dataType: "html",
			success:function(forgotpwd) {
				console.log(forgotpwd);
				var forgotpwd = jQuery.parseJSON(forgotpwd);
				if (forgotpwd == 0) {
					$('#forgot-valid').hide();
					$('#forgot-pwd-invalid').show();
					$('#format-pwd-invalid').hide();
					$(':input[type="submit"]').prop('disabled', true);
				} else {
					$('#forgot-valid').show();
					$('#forgot-pwd-invalid').hide();
					$('#format-pwd-invalid').hide();
					$(':input[type="submit"]').prop('disabled', false);
				}
			},error:function(forgotpwd) {
				console.log('error',forgotpwd);
			}
		});
	}
});
// console.log(location.origin);
$(document).ready(function(){
	setInterval(count_cart, 500);
})
function count_cart() {
	$.ajax({
		type:'POST',
		url: location.origin+"/Cart/count",
		'dataType':'json',
		success: function(data){
			$('.cart-notif').text(data);
		}
	});
}
// format money
function formatMoney(n, c, d, t) {
	var c = isNaN(c = Math.abs(c)) ? 2 : c,
	d = d == undefined ? "." : d,
	t = t == undefined ? "." : t,
	s = n < 0 ? "-" : "",
	i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
	j = (j = i.length) > 3 ? j % 3 : 0;

	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};