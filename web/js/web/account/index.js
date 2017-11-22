/**
 * Created by Administrator on 2017/11/22 0022.
 */
var account_index_ops = {
    init:function(){
     this.eventBind();
    },
    eventBind:function(){
       $('.search').click(function(){
          $('.wrap_search').submit();
       });
    }

};
$(document).ready(function(){
    account_index_ops.init();
});
