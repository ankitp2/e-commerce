$(document).ready(function(){
    $('.signup').hide();
    $('#register').click(function(){
        $('.login').hide();
        $('.signup').show();
    })
    $('#login').click(function(){
        $('.signup').hide();
        $('.login').show();
    })
    $('#sbbt').click(function(){
        var adr=$('#adr').val();
        $('#add-adr').val(adr);
    })
    $('#rr').click(function(){
        $('#addr-value').attr('disabled', false);
    })
    $('#stts').click(function(){
        $('.status').attr('disabled', false);
    })
    $('#sbbbt').click(function(){
        var addr_value=$('#addr-value').val();
        var status=$('.status').val();
        $('#ads').val(addr_value);
        $('#ssts').val(status);
    })
    $('#username-btn').click(function(){
        $('#username').attr('disabled', false);
        $('#userupdate').removeAttr('hidden');
    })
    $('#useremail-btn').click(function(){
        $('#useremail').attr('disabled', false);
        $('#userupdate').removeAttr('hidden');
    })
    $('#userupdate').click(function(){
         var username=$('#username').val();
         var useremail=$('#useremail').val();
         $('#newusername').val(username);
         $('#newemail').val(useremail);
    })
    $('#alert').fadeOut(5000);
    $('#chkout').click(function(){
        var crt=parseInt($('#crt').text());
        $('#gt').val(crt);
    })
    $('#prof').click(function(){
        $('#btn-drk').removeAttr('hidden'   );
    })
    $('#profile_pic_btn').click(function(){
        $('#profile_pic_btn').hide();
        $('#prof').removeAttr('hidden');
    })
    $('#about-sbt').click(function(){
        var floatingTextarea2=$('#floatingTextarea2').val();
        $('#abt').val(floatingTextarea2);
    })
    $("#coupon").keyup(function(){
       let vall=$("#coupon").val();
       $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "/user/coupon/desc",
        data : {'value' : vall},
        method : 'POST',
        dataType : 'json',
        success : function(data){
            $('#coupon_desc').text(data.description);
        }
       })
    })

})
function color(e){
    var sts=$('.sts'+e).text();
    if(sts=="confirmed"){
        $('.sts'+e).css("background-color","rgb(163, 243, 243)");
    }
    else if(sts=="shipped"){
        $('.sts'+e).css("background-color","rgb(241, 250, 162)");
    }
    else if(sts=="out for delivery"){
        $('.sts'+e).css("background-color","rgb(240, 201, 250)");
    }
    else if(sts=="delivered"){
        $('.sts'+e).css("background-color","rgb(121, 113, 233)");
    }
    else if(sts=="cancelled"){
        $('.sts'+e).css("background-color","rgb(255, 104, 104)");
    }
    }
     function plus(e){
        var value = parseInt($('.qty'+e).val());
        var price = parseInt($('.price'+e).text());
        var totalprice = parseInt($('.totalprice').text());
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $('.qty'+e).val(value);
            $('#itemtotal'+e).text(price * value);
            $('.totalprice').text(totalprice + price);
            $('.ttlprice').text(totalprice + price);
            var totalpr = parseInt($('.ttlprice').text());
            var discount = parseInt($('#discount').text());
            var crt = totalpr - discount;
            $('#crt').text(crt);
            $('#gt').val(crt);
        }
         $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/user/cart/quantity",
            data : {'value' : value,'id':e},
            method : 'POST',
            dataType : 'json',
            success : function(data){

                // alert();

            }
         })
    }
    function minus(e){
        var value = parseInt($('.qty'+e).val());
        var price = parseInt($('.price'+e).text());
        var totalprice = parseInt($('.totalprice').text());
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $('.qty'+e).val(value);
            $('#itemtotal'+e).text(price * value);
            $('.totalprice').text(totalprice - price);
            $('.ttlprice').text(totalprice - price);
            var totalpr = parseInt($('.ttlprice').text());
            var discount = parseInt($('#discount').text());
            var crt = totalpr - discount;
            $('#crt').text(crt);
            $('#gt').val(crt);
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/user/cart/quantity",
            data : {'value' : value,'id':e},
            method : 'POST',
            dataType : 'json',
            success : function(data){
                // alert(data.message);
            }
         })
    }
  function cnc(e){
    var sts=$('.sts'+e).text();
    if(sts=="cancelled"){
    $('#cnc'+e).hide();
    $('#order3'+e).css("gap","60px");
    }
  }
function coupon(){
    var coupon=$('#coupon').val();
    var ttlprice=parseInt($('.ttlprice').text());
    $("#c_code").val(coupon);
    try{
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "/cart/coupons",
        data : {'coupon' : coupon},
        method : 'POST',
        dataType : 'json',
        success : function(data){
            alert(data.message);
                if(data.data.discount==0){
                    $("#c_code").val(null);
                }
                if(data.data.discount_type=="percent"){
                let discount=Math.round((ttlprice*parseInt(data.data.discount))/100);
                $('#discount').text(discount);
                $('#crt').text(ttlprice-discount);
                $('#pro-discount').val(parseInt(data.data.discount));
                $('#pro-discount_type').val(data.data.discount_type);
                }else if(data.data.discount_type=="rupees"){
                    let discount=data.data.discount;
                    $('#discount').text(discount);
                    $('#crt').text(ttlprice-discount);
                    $('#pro-discount').val(parseInt(data.data.discount));
                    $('#pro-discount_type').val(data.data.discount_type);
                }
            },error: function(xhr, status, error) {
                console.log(error+":"+xhr+status);
            }
    })
}catch(err){
    console.log(err.message);
}
}



