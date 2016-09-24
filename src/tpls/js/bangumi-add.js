/* global Vue */
/* global $ */
/* exported Vue showImg */

let form = new Vue({
    el: '.row',
    data: {
        ititle:arr_bangumi.title,
        itime:arr_bangumi.time,
        inumber:arr_bangumi.number,
        itag:arr_bangumi.tag,
        icover:arr_bangumi.cover,
        isummary:arr_bangumi.summary
    }
})