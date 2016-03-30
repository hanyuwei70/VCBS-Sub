/* global Vue */
/* global $ */
/* exported Vue showImg */
$(function() {
    if (window.innerWidth) {
        if (window.innerWidth > 768) {
            let detail = $("#detail").height();
            $("#summary div").css("max-height", detail);
        }
    }
    //detail 封面内容动画
    // $(".hover").css("transform", 'translateY(' + $('.hover title').height() + 'px)');
    // $(".hover").hover(function() {
    //     $(".hover").css("transform", 'translateY(0)');
    // });
    // $(".hover").mouseleave(function() {
    //     $(".hover").css("transform", 'translateY(' + $('.hover ul').height() + 'px)');
    // });
})
function showImg(input) {
    let img = "test";
}