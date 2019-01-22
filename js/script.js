$(document).ready(function(){


	/** post it plugin */
    var $dragging = null;

    $(document.body).on("mousemove", function(e) {
        if ($dragging) {
            $dragging.offset({
                top: e.pageY,
                left: e.pageX
            });
        }
    });

    $(document.body).on("mousedown", "div", function (e) {
        $dragging = $(e.target);
    });

    $(document.body).on("mouseup", function (e) {
        $dragging = null;
    });
	$("#cerrar").click(function(){
		$(".postit").hide('slow');
	});
});
