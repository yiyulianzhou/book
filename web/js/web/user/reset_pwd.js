/**
 * Created by Administrator on 2017/11/21 0021.
 */
//创建一个json对象
var user_reset_pwd_ops = {
    //初始化的方法
    init:function(){
      this.eventBind();
    },
    //事件绑定的方法
    eventBind:function(){
        $('#save').click(function(){
            var btn_target = $(this);
            if (btn_target.hasClass('disabled')){
                common_ops.tip('正在处理，请不要频繁点击~~',$(this));
                return false;
            }

            var old_password = $('#old_password').val();
            var new_password = $('#new_password').val();
            if (old_password.length < 1) {
                common_ops.tip('请输入原密码!',$('#old_password'));
                return false;
            }
            if (new_password.length < 6) {
                common_ops.tip('请输入不少于六位数的新密码!',$('#new_password'));
                return false;
            }
            btn_target.addClass('disabled');

            $.ajax({
                url:common_ops.buildWebUrl('/user/reset_pwd'),
                type:'POST',
                data:
                {
                    old_password:old_password,
                    new_password:new_password,
                },
                dataType:'json',
                success:function(res){
                  btn_target.removeClass('disabled');
                  callback = null;
                  if(res.code == 200){
                      callback = function(){
                          window.location.href = window.location.href;
                      }

                  }
                  common_ops.alert(res.msg,callback);
                }
            });
        });
    }
};
//页面加载完成之后执行
$(document).ready(function(){
    user_reset_pwd_ops.init();
});

