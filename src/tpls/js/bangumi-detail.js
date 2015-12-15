$(function() {
    if (window.innerWidth) {
        if (window.innerWidth > 768) {
            var detail = $("#detail").height();
            $("#summary div").css("max-height", detail);
            // $("#summary").max-height(detail);
        }
    }
    //detail 封面内容动画
    $(".hover").css("transform", 'translateY(' + $('.hover ul').height() + 'px)');
    $(".hover").hover(function() {
        $(".hover").css("transform", 'translateY(0)');
    });
    $(".hover").mouseleave(function() {
        $(".hover").css("transform", 'translateY(' + $('.hover ul').height() + 'px)');
    });
})
