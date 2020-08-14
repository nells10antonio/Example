/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});
// cambiar precio de acorde al tamaño
$(document).ready(function(){
	$("#selSize").change(function(){
		var idSize = $(this).val();
		if (idSize ==""){
			return false;
		}
		$.ajax({
			type:'get',
			url:'/get-product-price',
			data:{idSize:idSize},
			success:function(resp){
				/*alert(resp);*/
				var arr = resp.split('#');
				$("#getPrice").html("Bs "+arr[0]);
				$("#price").val(arr[0]);
				if (arr[1]==0) {
					$("#cartButton").hide();
					$("#Availability").text("Sin Stock");
				}else{
					$("#cartButton").show();
					$("#Availability").text("En Stock");
				}
			},error:function(){
				alert("Error");
			}
		});
	});
});

// Validacion en registro
$().ready(function(){
	$("#registerForm").validate({
		rules:{
			name:{
				required:true,
				minLenght:2,
				accept: "[a-zA-Z]+"
			},
			password:{
				required:true,
				minLenght:6
			},
			email:{
				required:true,
				email:true,
				remote:"/check-email"
			}
		},
		messages:{
			name:{
				required:"Porfavor, Ingrese su Nombre",
				minLenght:"Su Nombre debe tener mas de 2 letras",
				accept:"Su nombre solo debe tener letras"
			},
			password:{
				required:"Porfavor, Ingrese su Contraseña",
				minLenght:"Su Contraseña debe tener mas de 6 dígitos"
			},
			email:{
				required:"Porfavor, Ingrese su Email",
				email:"Porfavor, Ingrese un Email válido",
				remote:"El Email ya existe!"
			}
		}
	});

// Validacion en update de usuario
	$("#accountForm").validate({
		rules:{
			name:{
				required:true,
				minLenght:2,
				accept: "[a-zA-Z]+"
			},
			address:{
				required:true,
				minLenght:6
			},
			city:{
				required:true,
				minLenght:2
			},
			state:{
				required:true,
				minLenght:2
			},
			country:{
				required:true
			}
		},
		messages:{
			name:{
				required:"Porfavor, Ingrese su Nombre",
				minLenght:"Su Nombre debe tener mas de 2 letras",
				accept:"Su nombre solo debe tener letras"
			},
			address:{
				required:"Porfavor, Ingrese su Dirección",
				minLenght:"Su Dirección debe tener mas de 6 dígitos"
			},
			city:{
				required:"Porfavor, Ingrese su Ciudad",
				minLenght:"Su Ciudad debe tener mas de 2 letras"
			},
			state:{
				required:"Porfavor, Ingrese su Departamento",
				minLenght:"Su Departamento debe tener mas de 2 letras"
			},
			country:{
				required:"Porfavor, Ingrese su País"
			},
		}
	});

// Validacion en login
	$("#loginForm").validate({
		rules:{
			email:{
				required:true,
				email:true
			},
			password:{
				required:true
			}
		},
		messages:{
			email:{
				required:"Porfavor, Ingrese su Email",
				email:"Porfavor, Ingrese un Email válido"
			},
			password:{
				required:"Porfavor, Ingrese su Contraseña"
			}
		}
	});
//Validacion de password usuario
	$("#passwordForm").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
			messages:{
				current_pwd:{
					required:"El campo es requerido",
					minlength:"Debe usar mas de 6 letras",
					maxlength:"Debe usar menos de 20 letras"
				},
				new_pwd:{
					required:"El campo es requerido",
					minlength:"Debe usar mas de 6 letras",
					maxlength:"Debe usar menos de 20 letras"
				},
				confirm_pwd:{
					required:"El campo es requerido",
					minlength:"Debe usar mas de 6 letras",
					maxlength:"Debe usar menos de 20 letras",
					equalTo:"Los Passwords no coinciden"
				}
			}
		/*errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}*/
	});
//Verificar contraseña actual de usuario
	$("#current_pwd").keyup(function(){
		var current_pwd = $(this).val();
		$.ajax({
			headers:{
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type:'post',
			url:'/check-user-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				/*alert(resp);*/
				if (resp=="false") {
					$("#chkPwd").html("<font color='red'>Password Actual es incorrecta</font>");
				}else if (resp=="true") {
					$("#chkPwd").html("<font color='green'>Password Actual es correcta</font>");
				}
			},error:function(){
				alert("Error");
			}
		});
	});

	//Copiar datos de factura a datos de envio
	$("#copyAddress").click(function(){
		if (this.checked) {
			$("#shipping_name").val($("#billing_name").val());
			$("#shipping_address").val($("#billing_address").val());
			$("#shipping_city").val($("#billing_city").val());
			$("#shipping_state").val($("#billing_state").val());
			$("#shipping_pincode").val($("#billing_pincode").val());
			$("#shipping_mobile").val($("#billing_mobile").val());
			$("#shipping_country").val($("#billing_country").val());
		}else{
			$("#shipping_name").val('');
			$("#shipping_address").val('');
			$("#shipping_city").val('');
			$("#shipping_state").val('');
			$("#shipping_pincode").val('');
			$("#shipping_mobile").val('');
			$("#shipping_country").val('');
		}
	});
});

