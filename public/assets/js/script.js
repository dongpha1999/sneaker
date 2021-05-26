$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 500) {
            $('#scrollback').fadeIn();
        } else {
            $('#scrollback').fadeOut();
        }
    })
    $('#scrollback').click(function () {
        $('html,body').animate({ scrollTop: 0 }, 600);
    });
    // Handle choose city,district,ward
    $('#country').change(function(e){
        var countryId = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "/district",
            type: 'GET',
            data: {
                countryId:countryId,
                _token: token
            },
            beforeSend: function(xhr) {
              xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            }
        }).done(function(res){
            var html = '';
            if(res.length < 1){
                html += "<option value=''>--Chọn quận/huyện--</option>";
            }else{
                for(let x of res){
                    html+="<option value='"+x.maqh+"'>"+x.name+"</option>";
                }
            }
            $('#district').html(html);
        });
    });
    $('#district').change(function(e){
        var districtId = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "/ward",
            type: 'GET',
            data: {
                districtId:districtId,
                _token: token
            },
            beforeSend: function(xhr) {
              xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            }
        }).done(function(res){
            var html = '';
            if(res.length < 1){
                html += "<option value=''>--Chọn xã/phường--</option>";
            }else{
                for(let x of res){
                    html+="<option value='"+x.xaid+"'>"+x.name+"</option>";
                }
            }
            $('#ward').html(html);
        });
    });
    // Sort by price
    $('#form-select-filter').change(function(e){
        var choose = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "/sort",
            type: 'GET',
            data: {
                choose:choose,
                _token: token
            },
            beforeSend: function(xhr) {
              xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            }
        }).done(function(res){  
            var base_url = window.location.origin;
            var imgSrc = base_url + "/storage/images/products/";
            var html = '';
            if(res.data.length > 0){
                for(let x of res.data){
                    html+= 
                    "<div class='col-lg-3 mb-4'><div class='product-item-box'><div class='product-item'><div class='image'><a href='/product/id/"+
                    x.id+"'><img src='"+imgSrc+x.image_path+"' width='100%' height='100%' name='product-image' class='product-image' /></a><a href=/product/id/"+
                    x.id+" class='more-info'><i class='fas fa-search'></i> XEM THÊM</a></div><a href='/product/id/"+
                    x.id+"' class='product-name mt-4'>"+x.title+"</a><div class='price-new' name='price-new'>"+x.price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'})+
                    "</div></div></div></div>";
                }
            }
            $('#product-container').html(html);
        });
    });
});
function addQuantity(quan) {
    let sum = parseInt($("#product-detail-quantity-input").val()) + parseInt(quan);
    if (sum < 1) {
        $("#product-detail-quantity-input").val(1);
    } else {
        $("#product-detail-quantity-input").val(sum);
    }
}