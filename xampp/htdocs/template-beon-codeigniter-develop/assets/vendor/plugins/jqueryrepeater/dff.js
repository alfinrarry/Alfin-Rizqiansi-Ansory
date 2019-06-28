var room = 1;

function product_variation() {

    room++;
    var objTo = document.getElementById('product_variation')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room);
    var rdiv = 'removeclass' + room;
    divtest.innerHTML = '<div class="row m-t-20"><div class="col-sm-4"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Variasi</span></div><input type="text" class="form-control" name="variation[]" id="variation"></div></div><div class="col-sm-3"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Stok</span></div><input type="number" class="form-control" name="qty[]" id="qty"></div></div><div class="col-sm-3"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Ukuran</span></div><input type="text" class="form-control" name="size[]" id="size"></div></div><div class="col-sm-2"><div class="form-group"> <button class="btn btn-danger" type="button" onclick="remove_product_variation(' + room + ');"> <i class="fa fa-minus"></i> </button> </div></div></div>';

    objTo.appendChild(divtest)
}

function remove_product_variation(rid) {
    $('.removeclass' + rid).remove();
}