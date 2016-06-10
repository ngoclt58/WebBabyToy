/**
 * 
 */
function removeItem(itemid) {
    var url = "/cart/remove-item?packet=packet&itemid=" + itemid;
    $.get(url, function(resp){
        updateCart();        
    })
}

        
function setQuanlity(itemId){    
    var quanlity = $('input[name="q'+itemId+'"]').val();
	//var anchors = document.getElementsByName('"t'+itemId+'"');

    if (parseInt(quanlity)>0){
        var _url = '/cart/set-quanlity?itemid='+itemId+'&packet=packet&quanlity='+parseInt(quanlity);        
        $.get(_url, function(resp){
			if(resp) alert(resp); //tb_show("","/index/cart-alert?width=380&height=170&text="+encodeURIComponent(resp));
            updateCart();
        });
    }else{
        alert("Vui lòng nhập số luong");        
        updateCart();       
    }
}

function updateCart(){
    var url = '/cart';
    var data = {isAjax:1};
    $.get(url, data, function(response){        
        $('.box-center').html(response);        
        window.location.reload();
    },'html');
}

function updateTotalItem() {
    var __url = '/cart/get-total/?rand='+Math.random();
    $.get(__url, function(_data){   
        $('#totalItem').html(_data);        
    });
}