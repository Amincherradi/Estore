$.noConflict();
jQuery(document).ready(function($) {
	
	$('#carouselExampleControls').carousel();
	contenutabetd("#searchdiv");
	Shopcart("#Shoppingcart");
	function Shopcart(element){
		$.ajax({
			url:'ShopCart.php',
		   success: function(data){
			   $(element).html(data);
		   }
		});
		
	}
	
	function contenutabetd(element){
		
        $("#searchid").keyup(function(){
			document.getElementById("searchdiv").style.display = 'block'; 
			var Product=$("#searchid").val();
			var pi='';
			$.ajax({
				method:"GET",
				url: "search.php",
				data: {'Pname' : Product,'pi':pi},
				success: function(data)
				{
					$(element).html(data);
				}
			});
			if($("#searchid").val()==""){
				document.getElementById("searchdiv").style.display = 'none'; 
				
			}
        });
		$(document).on('click', 'a[idp=firstpage]', function() {
			var idp = $(this).attr('idpage');
			var Pname=$("#searchid").val();
			$.ajax({
				url: 'search.php',
				method: 'GET',
				data: {idp:idp,'Pname' : Pname},
				success: function(data) {
					$('#searchdiv').html(data); 
				}
			});
		});
		
		$(document).on('click', 'a[idp=prevpage]', function() {
			var idp = $(this).attr('idpage');
			var Pname=$("#searchid").val();
			$.ajax({
				url: 'search.php',
				method: 'GET',
				data: { idp:idp,'Pname' : Pname},
				success: function(data) {
					$('#searchdiv').html(data); 
				}
			});
		});
		
		$(document).on('click', 'a[idp=nextpage]', function() {
			var idp = $(this).attr('idpage');
			var Pname=$("#searchid").val();
			$.ajax({
				url: 'search.php',
				method: 'GET',
				data: {idp:idp,'Pname' : Pname},
				success: function(data) {
					$('#searchdiv').html(data); 
				}
			});
		});
		
		$(document).on('click', 'a[idp=lastpage]', function() {
			var idp= $(this).attr('idpage');
			var Pname=$("#searchid").val();
			$.ajax({
				url: 'search.php',
				method: 'GET',
				data: { idp:idp,'Pname' : Pname},
				success: function(data) {
					$('#searchdiv').html(data); 
				}
			});
		});
	}
	
	//Message success
	function msgsuccess(txtsuccess){
		$.toast({
		  heading: 'Success',
		  text:txtsuccess,
		  showHideTransition: 'slide',
		  icon: 'success',
		  loaderBg: '#f96868',
		  position: 'top-center'
   	 });
	}
	$(document).ready(function() {
		$('.nav-tabs a').click(function() {
			$(this).tab('show');
		});
	});


	$('.order').click(function(e) {
		let button = $(this);
	
		var valide = true;
		for (var i = 0; i < 10; i++) {
			if (($("#ord" + i).val()).trim() == "") {
				$("#err" + i).text("*Field Required");
				valide = false;
			} else {
				$("#err" + i).text("");
			}
		}
	
		if (($("#ord2").val()).trim() != "") {
			var mailReg = /^[a-z0-9._%+-]+\@[a-z0-9.-]+\.[a-z]{2,4}$/gi;
			if (!$("#ord2").val().match(mailReg)) {
				$("#err2").text("non valide");
				valide = false;
			} else {
				$("#err2").text("");
			}
		}
	
		if (($("#ord3").val()).trim() != "") {
			var telReg = /^[0][0-9]{9}$/gi;
			if (!$("#ord3").val().match(telReg)) {
				$("#err3").text("Only Numbers");
				valide = false;
			} else {
				$("#err3").text("");
			}
		}
	
		if (valide == true) {
			var cash = $("#ord9").val();
			$.ajax({
				url: 'SendOrder.php',
				method: 'POST',
				data: {
					cash: cash
				},
				success: function(data) {
					var chaine = data.trim();
					var tab = chaine.split(",");
					if (tab[0].toLowerCase() === "success") {
						button.addClass('animate');
						setTimeout(() => {
							button.removeClass('animate');
							window.location.replace("?p=OrderCompleted");
						}, 10000);
					}
				}
			});
		} 
		return valide;
	});
	$(document).on('click', 'a[data-pc=addcart]', function() {
		var idprod = $(this).attr('idp');
		$.ajax({
			url: 'addtocart.php',
			method: 'GET',
			data: {idprod:idprod},
			success: function(data) {
				setTimeout(function() {
					$('#addedtocart').modal('hide');
				  const scrollPosition = window.scrollY;
				  location.reload();
				  window.scrollTo(0, scrollPosition);
				}, 1500);
			}
		});
	});
	$(document).on('click', 'a[data-pc=delete]', function() {
		$.ajax({
			url:'deleteshopcart.php',
		   success: function(data){
				location.reload();
		   }
		});
	});

	$('#orderstable').DataTable();
});
