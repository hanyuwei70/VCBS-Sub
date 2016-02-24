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

// 注册组件
Vue.component('sub', {
  template: '#grid-template',
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


var sub = new Vue({
  el: '#sub_list',
  data: {
    searchQuery: '',
    gridColumns: ['title', 'lang', 'time', 'ID'],
    gridData: arr_subtitle
  }
})