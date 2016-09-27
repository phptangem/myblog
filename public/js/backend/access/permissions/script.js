$(function(){
    $('.show-permissions').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var role = $this.data('role');
        var permissions = $('.permission-list[data-role="'+role+'"]');
        var hideText  = $this.find(".hide-text");
        var showText  = $this.find(".show-text");

        hideText.toggleClass('hidden');
        showText.toggleClass('hidden');
        permissions.toggleClass('hidden');
    });
});