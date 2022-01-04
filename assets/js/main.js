jQuery.noConflict();(function($) {$(function() {
    var $body = $('body'), 
        $window = $(window);                          
    
    // таблицы    
    if ( screen.width < 1060 ) {
        fResponsTable();
    }    
    
    $("img[data-src]").lazyload(); 

	//reachGoal
	$body.on('click', 'a', function(event){
		if(this.href.indexOf('/alvexosignals') !== -1){
			var $this = $(this),
              url = $this.attr('href'),
              target = $this.attr('target');
			event.preventDefault();
			console.log(url);
			console.log('alvexosignals');
			yaCounter51700361.reachGoal('alvexosignals', function(){
				window.open(url, (target ? target : "_parent"));
				console.log('alvexosignals-go');
			});
		}
		if(this.href.indexOf('/alvexobook') !== -1){
			var $this = $(this),
              url = $this.attr('href'),
              target = $this.attr('target');
			event.preventDefault();
			console.log(url);
			console.log('alvexobook');
			yaCounter51700361.reachGoal('alvexobook', function(){
				window.open(url, (target ? target : "_parent"));
				console.log('alvexobook-go');
			});
		}
		if(this.href.indexOf('/buystocks') !== -1){
			var $this = $(this),
              url = $this.attr('href'),
              target = $this.attr('target');
			event.preventDefault();
			console.log(url);
			console.log('buystocks');
			yaCounter51700361.reachGoal('buystocks', function(){
				window.open(url, (target ? target : "_parent"));
				console.log('buystocks-go');
			});
		}
		if(this.href.indexOf('/realaccount') !== -1){
			var $this = $(this),
              url = $this.attr('href'),
              target = $this.attr('target');
			event.preventDefault();
			console.log(url);
			console.log('realaccount');
			yaCounter51700361.reachGoal('realaccount', function(){
				window.open(url, (target ? target : "_parent"));
				console.log('realaccount-go');
			});
		}
	});
	
    // открытие как ссылку
    $body.on('click', '.goto', function(){
        var $this = $(this),
            url = $this.data('goto'),
            target = $this.data('target');
        
        window.open(url, (target ? target : "_parent"));
    });         
    
   
    
    // меню в подвале
    $('#footer .menu>li>a').click(function() {
        if (screen.width <= 660 && !$(this).is('.active')) {
            $(this).addClass('active')
            $(this).next().slideToggle(200);
            return false;                
        }
    });
    
    // спойлер
    $('.spoiler-wrap .folded').click(function(){
        jQuery(this).next('.spoiler-body').slideToggle(100);
        jQuery(this).toggleClass('open');
    });               
    
	// адаптация таблиц
    function fResponsTable() {
        var $table = jQuery('table'),
            w_W = screen.width - 10;            

        if ( $table.length < 1 ) return false;
        
        $table.each(function() {
            var $this = jQuery(this);
            
            if ( $this.closest('.response-table').length == 0 ) {
                                    
                var respons = jQuery('<div/>', {
                    'class': 'response-table'
                });
                    
                $this.wrap(respons);
            }
        })
    }    
})})(jQuery);