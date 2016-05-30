/*global $*/
$(function () {
    //detail 封面内容动画
    $(".hover").css("transform", 'translateY(' + $('.hover ul').height() + 'px)');
    $(".hover").hover(function () {
        $(".hover").css("transform", 'translateY(0)');
    });
    $(".hover").mouseleave(function () {
        $(".hover").css("transform", 'translateY(' + $('.hover ul').height() + 'px)');
    });
    if (window.innerWidth) {
        if (window.innerWidth > 768) {
            let height = $("#detail").height();
            $("#s-form div").css("height", height);
            // $("#summary").max-height(detail);
        }
    }
})
function analyze(input) {
    let subName = input.files[0].name;
}