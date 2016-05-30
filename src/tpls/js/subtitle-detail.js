Vue.filter('langTrans',function (value){
    var pro = value.lang - 100000;
    if (pro >= 10000){
        let lang = "简体";
        if (pro >= 11000){
            let lang = "简繁双语";
            if (pro >= 11100) {
                let lang = "简繁日三语";
                return lang;
            }
            return lang;
        }
        else if (pro >= 10100){
            let lang = "简日双语";
            return lang;
        }
        return lang;
    }
    else if (pro >= 1000){
        let lang = "繁体";
        if (pro >= 1100){
            let lang = "繁日双语";
            return lang;
        }
        return lang;
    }
    else {
        let lang = "日语";
        return lang;
    }
})
Vue.filter('fontTrans',function (value) {
    var font = String(value);
    var fontCode = font[font.length -1];
    if (fontCode === "1") return "有";
    else if(fontCode === "0") return "无";
    else return "error!";
})
Vue.filter('effTrans',function (value) {
    var eff = String(value);
    var effCode = eff[eff.length - 2];
    if (effCode === "1") return "有";
    else if(effCode === "0") return "无";
    else return "error!";
})
var subDetail = new Vue({
    el:'#subDetail',
    data:{arrSubtitle:arrSubtitle}
})