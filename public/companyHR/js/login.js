$(document).ready(function() {
	Materialize.updateTextFields();
$("#formValidate").validate({
        rules: {
            email: {
                required: true,
                email:true
            },
            password: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            email: "อีเมล์ไม่ถูกต้อง",
            password:{
                required: "กรุณากรอกรหัสผ่าน",
                minlength: "รหัสผ่านผิดพลาด"

            }
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).html(error)
          } else {
            error.insertAfter(element);
          }
        }
     })
});