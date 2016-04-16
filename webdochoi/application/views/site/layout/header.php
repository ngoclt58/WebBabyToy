<table class="main" cellpadding="0" cellspacing="0" border="0">
	<tbody>
		<tr>
			<td>
				<div id="header">
					<div class="inner header">
						<a id="logo" href="">&nbsp;</a>
						<div class="helper" style="">
							<div style="height: 33px; text-align: right;">
								<a style="vertical-align: 12px; line-height: 10px;" href="">Giỏ
									hàng (<span id="totalItem">0</span>) <img
									src="/web/images/icon_cart.png">|
								</a> <a href="#" id="btnSearch"
									onclick="$('#searchBox').animate({opacity:'toggle'});"><img
									src="/web/images/btn_search.png"></a>
								<div id="searchBox" class="hide">
									<span class="close"
										onclick="$('#searchBox').animate({opacity:'toggle'});"></span>
									<form id="fSearch" action="" method="POST"></form>
								</div>
							</div>
							<form id="login" class="login" action="" method="post">
								<input class="ipt1" type="text" name="email" value=""
									placeholder="Email đăng nhập"
									onkeypress="return checkdangnhap(event)"> <input class="ipt1"
									type="password" name="pass" value="" placeholder="Mật khẩu"
									onkeypress="return checkdangnhap(event)"> <input
									name="dangnhap" value="Đăng nhập" type="button"
									class="btn-login"> <input name="dangnhap" value="Đăng ký"
									type="button" class="btn-login1">
							</form>


						</div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="inner">
					<div id="menu">
						<ul class="parent">
							<li><a href="" class="first lblue p1">Hàng mới về</a></li>
							<li><a href="" class="lblue p1">Thương hiệu</a></li>
							<li><a href="" class="lblue p1">Bé trai</a></li>
							<li><a href="" class="lblue p1">Bé gái</a></li>
							<li><a href="" class="lblue p1">Baby</a></li>
							<li><a href="" class="lblue p1">LEGO EDUCATION</a></li>
						</ul>
					</div>
				</div>
			</td>
		</tr>

		<script>
    updateTotalItem();
    $('#menu .parent li').each(function(){
        $(this).hover(function(){
            $(this).find('a').eq(0).addClass('active');
            $(this).find('ul').removeClass('hide');            
            $(this).find('ul li').each(function(){
                $(this).hover(function(){
                    $(this).find('div').eq(0).removeClass('hide');
                }, function(){
                    $(this).find('div').eq(0).addClass('hide');
                });
            });
        }, function(){
            $(this).find('a').eq(0).removeClass('active');
            $(this).find('ul').addClass('hide');
        });
    });
    $().ready(function(){
        $('#brand').change(function(){
            var val = $('#brand :selected').val();
            var url = '/index/get-subject';
            $.get(url,{
                "brandid" : val
            }, function(resp){
                if (resp != null) {
                    var html = '<select class="select ssub" id="subject" name="subject">';
                    $(resp).each(function(i,obj){
                        html += '<option label="'+obj.title+'" value="'+obj.id+'">'+obj.title+'</option>';
                    });                    
                    html += '</select>';
                    $('#sbblock').html(html);
                }
            }, 'json');
        });
        $('#adminSubMenuBlock').hover(function(){
            $('#adminSubMenu').show();
        }, function(){
            $('#adminSubMenu').hide();
        });
        
    }); 
		document.getElementsByClassName = 
Element.prototype.getElementsByClassName = function(class_names) {
    // Turn input in a string, prefix space for later space-dot substitution
    class_names = (' ' + class_names)
        // Escape special characters
        .replace(/[~!@$%^&*()_+\-=,./';:"?><[\]{}|`#]/g, '\\$&')
        // Normalize whitespace, right-trim
        .replace(/\s*(\s|$)/g, '$1')
        // Replace spaces with dots for querySelectorAll
        .replace(/\s/g, '.');
    return this.querySelectorAll(class_names);
};
        function showTrungthu(){
			var tt = document.getElementsByClassName("opentrungthu")[0];
			if (tt == null)
			{
				$("#highstreet").animate({
                    height: "+=450"
                }, {queue:false, duration:250});
				$(".highstreet-inner .btn-highstreet a").addClass("opentrungthu");	
			}
			else
			{
				$("#highstreet").animate({
                    height: "-=450"
                }, {queue:false, duration:250});
				$(".highstreet-inner .btn-highstreet a").removeClass('opentrungthu');	
			}
		}
function blink(){
    $(".highstreet-inner .btn-highstreet a span ").delay(100).fadeTo(100,0.2).delay(100).fadeTo(100,1, blink);
}

$(document).ready(function() {
    blink();
});
$('.btn-login1').click(function(e){            
            window.location = "/dang-ky.html";
            return false;
});	
$('.btn-login').click(function(e){            
    $.post('/dang-nhap.html',$('#login').serialize(), function(resp){
                $.each(resp, function(i, obj){
                    var id = obj.id; 
                    var msg = obj.msg; 
                    if (id=="ok") {
                        window.location = "/";
                    }
                    //$('#login #'+id).parent().append('<p class="errblock red" style="padding:3px 0 5px 0">'+msg+'</p>');                    
		    $('#login #'+id).addClass("berr");
                    $('#btnSubmitLogin').show();
                    $('#loader').hide();
		    if (id=="email"){alert(msg);}
                });
            },'json');
});	
function checkdangnhap(e) {
    if (e.keyCode == 13) {
        $('.btn-login').click();
    }
}
</script>
		<style>
.btn-login {
	background: url(/web/images/new_login/dangnhap.png) no-repeat right;
	width: 109px;
	height: 46px;
	border: none;
	cursor: pointer;
	color: rgb(255, 255, 255);
	text-transform: uppercase;
	font-size: 11px;
	padding-left: 25px;
	font-weight: bold;
	margin-right: 10px;
	float: right;
}

.btn-login1 {
	background: url(/web/images/new_login/dangnhap1.png) no-repeat right;
	width: 109px;
	height: 46px;
	border: none;
	cursor: pointer;
	color: rgb(255, 255, 255);
	text-transform: uppercase;
	font-size: 11px;
	padding-left: 25px;
	font-weight: bold;
	margin-right: 7px;
	float: right;
}

.btn-login:hover {
	background: url(/web/images/new_login/dangnhap-hover.png) no-repeat
		right;
}

.btn-login1:hover {
	background: url(/web/images/new_login/dangnhap1-hover.png) no-repeat
		right;
}

.ipt1 {
	background: #ffffff; /* Old browsers */
	background: -moz-linear-gradient(top, #ffffff 19%, #e8ebec 50%, #ffffff 91%);
	/* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(19%, #ffffff),
		color-stop(50%, #e8ebec), color-stop(91%, #ffffff));
	/* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #ffffff 19%, #e8ebec 50%, #ffffff 91%);
	/* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, #ffffff 19%, #e8ebec 50%, #ffffff 91%);
	/* Opera 11.10+ */
	background: -ms-linear-gradient(top, #ffffff 19%, #e8ebec 50%, #ffffff 91%);
	/* IE10+ */
	background: linear-gradient(to bottom, #ffffff 19%, #e8ebec 50%, #ffffff 91%);
	/* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff',
		endColorstr='#ffffff', GradientType=0); /* IE6-9 */
	width: 210px;
	margin-right: 10px;
	margin-bottom: 2px;
	margin-top: 2px;
	float: right;
}

#menu {
	height: auto;
	z-index: 100;
	width: 1200px
}

#menu ul.parent li {
	position: relative;
	float: left;
}

#menu ul.parent ul.sub {
	-moz-border-radius: 0 0 5px 5px;
	-webkit-border-radius: 0 0 5px 5px;
	border-radius: 0 0 5px 5px;
	border: 1px solid #f06f71;
	border-top: 0;
	position: absolute;
	left: 0;
	top: 40px;
	width: 171px;
}

#menu ul.parent ul.sub li a.p2 {
	color: #424594;
	font-size: 14px;
	width: 156px;
	display: block;
	text-align: left;
	padding-left: 15px;
}

#menu ul.parent ul.sub li:hover a.p2 {
	color: #cd0462;
	font-size: 14px;
	font-weight: bold;
}

#menu ul.parent ul.sub li {
	display: block;
	width: 171px;
	height: 22px;
	background: url('/web/images/top_menu.png') 0 0 no-repeat;
	line-height: 22px;
	border-bottom: 1px dashed #e5c2a1;
	position: relative
}

#menu ul.parent ul.sub li:hover {
	background: url('/web/images/top_menu_hover.png') 0 0 no-repeat;
}

#menu ul.parent ul.sub div.sub2 {
	position: absolute;
	left: 171px;
	top: 0;
	z-index: 99;
	background: #e1e1e1;
	min-width: 210px;
}

#menu ul.parent ul.sub div.sub2 div {
	height: 23px;
	text-align: left;
}

#menu ul.parent ul.sub div.sub2 div a {
	background: url(/web/images/icon_top_arrow.png) 5px 7px no-repeat;
	color: #eb318e;
	font-size: 13px;
	width: 190px;
	height: 23px;
	display: block;
	padding-left: 20px;
}

#menu ul.parent ul.sub div.sub2 div a:hover {
	color: #ffffff;
	background: #edc9b2 url(/web/images/icon_top_arrow_hover.png) 5px 7px
		no-repeat;
}

#menu ul.parent ul.sub div.sub2 div:first-child {
	border-right: 1px solid #f06f71;
	border-left: 1px solid #e1e1e1;
}

#menu ul.parent ul.sub div.sub2 div {
	border-right: 1px solid #f06f71;
	border-left: 1px solid #f06f71;
}

#menu ul.parent ul.sub div.sub2 div:last-child {
	border-right: 1px solid #f06f71;
	border-bottom: 1px solid #f06f71;
	-moz-border-radius: 0 0 5px 0;
	-webkit-border-radius: 0 0 5px 0;
	border-radius: 0 0 5px 0;
}

#adminMenu {
	position: relative
}

#adminSubMenu ul {
	padding: 10px 0 0 3px;
}

#adminSubMenu ul li a {
	color: #676767
}

#adminSubMenu ul li a:hover {
	color: #cd0462
}
</style>

	</tbody>
</table>