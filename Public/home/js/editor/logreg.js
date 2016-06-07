  $(document).ready(function() {
    var flag1 = true;
    $('#reg_userName').blur(function () {
       $('#reg-name-div').removeClass('has-warning');
       $('#reg-name-div').removeClass('has-success');
                var userName = $(this).val();
                if (userName.length > 1) {
                    $.post('/thinkweb/home/user/ajaxUserName', {userName:userName}, function(data, textStatus, xhr) {
                       if (textStatus == 'success') {
                          if (data == '1') {
                            $('#reg-name-div').addClass('has-warning');
                            $('#namespan').removeClass('glyphicon glyphicon-pencil');
                            $('#namespan').addClass('glyphicon glyphicon-warning-sign');
                            $('#name-tip').text('用户名已存在');
                              flag1 = false;
                          }else{
                            $('#reg-name-div').addClass('has-success');
                            $('#namespan').removeClass('glyphicon glyphicon-pencil');
                            $('#namespan').removeClass('glyphicon glyphicon-warning-sign');
                            $('#namespan').addClass('glyphicon glyphicon-ok');
                            $('#name-tip').text('');
                            flag1 = true;
                          }
                       }
                    });
                }
    })

    $('#reg_email').blur(function () {
       $('#reg-email-div').removeClass('has-warning');
       $('#reg-email-div').removeClass('has-success');
       var email = $(this).val();
        var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
        if (! reg.test(email)) {
              $('#reg-email-div').addClass('has-warning');
              $('#emailspan').removeClass('glyphicon glyphicon-pencil');
              $('#emailspan').addClass('glyphicon glyphicon-warning-sign');
              $('#email-tip').text('邮箱格式不正确');
              flag2 = false;
        }else{
              $('#reg-email-div').addClass('has-success');
              $('#emailspan').removeClass('glyphicon glyphicon-warning-sign');
              $('#emailspan').addClass('glyphicon glyphicon-ok');
               $('#email-tip').text('');
               flag2 = true;
        }
    })

    $('#reg_password').blur(function () {
       $('#reg-pwd-div').removeClass('has-warning');
       $('#reg-pwd-div').removeClass('has-success');
       var regpwd = $(this).val() ;
        if (regpwd.length < 6 || regpwd.length >20) {
              $('#reg-pwd-div').addClass('has-warning');
              $('#regpwdspan').removeClass('glyphicon glyphicon-pencil');
              $('#regpwdspan').addClass('glyphicon glyphicon-warning-sign');
              $('#pwd-tip').text('密码长度不符合规范');
              flag3 = false;
        }else{
              $('#reg-pwd-div').addClass('has-success');
              $('#regpwdspan').removeClass('glyphicon glyphicon-warning-sign');
              $('#regpwdspan').addClass('glyphicon glyphicon-ok');
              $('#pwd-tip').text('');
              flag3 = true;
        }
    })


    $('#confirmPwd').blur(function () {
       $('#reg-conpwd-div').removeClass('has-warning');
       $('#reg-conpwd-div').removeClass('has-success');
       var confirmPwd = $(this).val() ;
       var reg_pwd = $('#reg_password').val();
        if ( confirmPwd != reg_pwd || confirmPwd.length < 6) {
              $('#reg-conpwd-div').addClass('has-warning');
              $('#regcompwdspan').removeClass('glyphicon glyphicon-pencil');
              $('#regcompwdspan').addClass('glyphicon glyphicon-warning-sign');
              $('#conpwd-tip').text('确认密码不正确');
              flag4 = false;
        }else{
              $('#reg-conpwd-div').addClass('has-success');
              $('#regcompwdspan').removeClass('glyphicon glyphicon-warning-sign');
              $('#regcompwdspan').addClass('glyphicon glyphicon-ok');
              $('#conpwd-tip').text('');
              flag4 = true;
        }
    })


      $('#reg').click(function () { 
        return flag1 && flag2 && flag3 && flag4;
      })

      $('#loginu').click(function () {
        var vcode = $('#vcode').val();
        var password = $('#password').val();
        var email = $('#email').val();
        var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
        if (email == '' || ! reg.test(email)) {
           $('#log-emailspan').removeClass('glyphicon glyphicon-pencil');
           $('#log-emailspan').addClass('glyphicon glyphicon-remove');
           $('#log-emailspan').css('color', 'red');
          return false;
        }else{
           $('#log-emailspan').removeClass('glyphicon glyphicon-remove');
           $('#log-emailspan').addClass('glyphicon glyphicon-ok');
           $('#log-emailspan').css('color', 'green');
        }
        if (password.length < 6 || password.length >20) {
           $('#log-pwdspan').removeClass('glyphicon glyphicon-pencil');
           $('#log-pwdspan').addClass('glyphicon glyphicon-remove');
            $('#log-pwdspan').css('color', 'red');
          return false;
        }else{
           $('#log-pwdspan').removeClass('glyphicon glyphicon-remove');
           $('#log-pwdspan').addClass('glyphicon glyphicon-ok');
           $('#log-pwdspan').css('color', 'green');
        }
        if (vcode.length == 0 || vcode.length != 4) {
           $('#vcodespan').removeClass('glyphicon glyphicon-pencil');
           $('#vcodespan').addClass('glyphicon glyphicon-remove');
            $('#vcodespan').css('color', 'red');
            return false;
          }else{
           $('#vcodespan').removeClass('glyphicon glyphicon-remove');
           $('#vcodespan').addClass('glyphicon glyphicon-ok');
            $('#vcodespan').css('color', 'green');
          }
      })
    });