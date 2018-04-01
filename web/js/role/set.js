;//因为多个js文件压缩合并的时候可能和上一个js文件代码冲突
var role_set_ops = {
    init:function () {//初始化方法
        this.eventBind();
    },

    eventBind:function () {
        
    }
}
$(document).ready(function () {
    role_set_ops.init();
});