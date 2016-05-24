$(document).ready(function() {
	$('.reply-info').each(function(){
		$(this).mouseover(function(){
			$(this).find('.thank-area').show();
		});
		$(this).mouseout(function(){
			$(this).find('.thank-area').hide();
		})
	})
	$('.reply').each(function(){
		$(this).click(function(){
			var par = $(this).parents('.reply-info');
			if (par.next().hasClass('reply-box')) {
				par.next().remove();
			}else{
				par.after('<form action="#" method="post" accept-charset="utf-8" class="reply-box"><br/><textarea name="reply" class="form-control" rows="2" placeholder="@ admin:"></textarea><input type="submit" class="btn btn-info btn-sm" style="margin-left: 50%"></input></form>');
			}
		})
	})

});