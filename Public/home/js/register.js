$(document).ready(function(){




    $("form :input").blur(function(){

        $(this).parent().find(".tips").remove();

        //判断username
        if ($(this).is("#username")){

            if (this.value=="" || ( this.value!="" && !/^\w+$/.test(this.value) )){

                var hdw1 = $("<span class='tips error'>× 用户名不合法</span>");

                $(this).parent().append(hdw1);

            }else{
                var hdw1 = $("<span class='tips correct'>√ 正确</span>");

                $(this).parent().append(hdw1);
            }

        }
        //end


        //判断password
        if ($(this).is("#password")){

            if (this.value=="" || this.value.length < 6){

                var hdw1 = $("<span class='tips error'>× 密码不得小于6位</span>");

                $(this).parent().append(hdw1);

            }else{
                var hdw1 = $("<span class='tips correct'>√ 正确</span>");

                $(this).parent().append(hdw1);
            }

        }
        //end


        //判断email
        if ($(this).is("#email")){

            if (this.value=="" || ( this.value!="" && !/.+@.+\.[a-zA-Z]{2,4}$/.test(this.value) )){

                var hdw1 = $("<span class='tips error'>× 邮件的格式不正确</span>");

                $(this).parent().append(hdw1);

            }else{

                var hdw1 = $("<span class='tips correct'>√ 正确</span>");

                $(this).parent().append(hdw1);
            }

        }
        //end

        //判断captcha
        if ($(this).is("#captcha")){

            if (this.value==""){

                var hdw1 = $("<span class='tips error'>× 验证码不能为空</span>");

                $(this).parent().append(hdw1);

            }else{

                var hdw1 = $("<span class='tips correct'>√ 正确</span>");

                $(this).parent().append(hdw1);
            }

        }
        //end


    });
    //blur  end



    //提交
    $("#reg").click(function(){

        $("form :input").trigger("blur");

        var hdw3 = $(".error").length;

        if (hdw3){

            return false;

        }

        alert("注册成功");

    });
    //end

});

