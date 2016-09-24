/* global Vue */
/* global $ */
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

// register the grid component
Vue.component('sub-list', {
  template: '#sub-list-template',
  props: {
    data: Array,
    columns: Array,
    filterKey: String
  },
  data: function () {
    var sortOrders = {}
    this.columns.forEach(function (key) {
      sortOrders[key] = 1
    })
    return {
      sortKey: '',
      sortOrders: sortOrders
    }
  },
  methods: {
    sortBy: function (key) {
      this.sortKey = key
      this.sortOrders[key] = this.sortOrders[key] * -1
    }
  }
})

// bootstrap the demo
var demo = new Vue({
  el: '#sub',
  data: {
    searchQuery: '',
    gridColumns: ['title', 'lang','time','upload'],
    gridData: arr_subtitle
  }
})
