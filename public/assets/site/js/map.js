
$(document).ready(function () {
	var userIcon = mainurl + "/usermrker.png";
	//  let map = null; // تهيئة متغير الخريطة بقيمة null
	let userMarker = L.marker([35, 36], {
		draggable: true,
		icon: L.icon({
			iconUrl: userIcon,
			iconSize: [24, 24]
		})
	}).bindPopup('موقعك الحالي');

	//   var markersLayer = L.layerGroup();
	let map = L.map('map').setView([35, 36], 10);
	//	let markersLayer = L.layerGroup().addTo(map);
	let companyMarkers = L.layerGroup().addTo(map);
	//   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
	//light_nolabels
	L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png').addTo(map);

	function setUserLocation(lat, lng) {
		userLocation = {
			lat,
			lng
		};

		userMarker = L.marker([lat, lng], {
			draggable: true,
			icon: L.icon({
				iconUrl: userIcon,
				iconSize: [24, 24]
			})
		}).addTo(map).bindPopup('موقعك الحالي');
		userMarker.on("dragend", function (event) {
			let position = event.target.getLatLng();
			userLocation = {
				lat: position.lat,
				lng: position.lng
			};

		});

		//map.setView([lat, lng], 18);
		map.flyTo([lat, lng], 18, {
			animate: true,
			duration: 3
		});
	}
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(
			function (position) {
				setUserLocation(position.coords.latitude, position.coords.longitude);
			},
			function () {
				var url = 'https://api.ipgeolocation.io/ipgeo?apiKey=017f861c64cb4f9885c36061ccdf1eee&fields=geo&excludes=continent_code,continent_name';
				//	console.log("تعذر الحصول على الموقع من المتصفح، سيتم استخدام عنوان IP بدلاً من ذلك.");

				// في حالة الفشل، نحاول استخدام IP
				//	$.getJSON('http://ip-api.com/json/', function (data) {
				$.getJSON(url, function (data) {
					if (data) {
						setUserLocation(data.latitude, data.longitude);
					} else {
						//	console.log("تعذر الحصول على الموقع عبر عنوان IP.");
					}
				});
			}
		);
	}

 
	let userLocation = null;
	let selectedCompany = null;
/*
	let navigateControl = L.control({
		position: "topleft"
	});
	navigateControl.onAdd = function () {
		let div = L.DomUtil.create("div", "leaflet-bar leaflet-control leaflet-control-custom");
		div.innerHTML =
			`<button id="navigate-btn" style="background-color: white;border: 0;padding: 5px 2px;"><i class="fas fa-location-arrow xs no-color"   aria-hidden="true"></i></button>`;
		div.style.background = "white";
		div.style.padding = "1px";
		div.style.cursor = "pointer";
		div.style.width = "35px";	
		div.onclick = function (e) {
			e.preventDefault();
			if (userLocation && selectedCompany) {
				let url =
					`https://www.google.com/maps/dir/${userLocation.lat},${userLocation.lng}/${selectedCompany.latitude},${selectedCompany.longitude}`;
				window.open(url, "_blank");
			} else {
				swal("لم يتم تحديد موقعك بعد أو لم تحدد الوجهة .");
				//	alert("لم يتم تحديد موقعك بعد أو لا توجد شركات قريبة.");
			}
		};

		return div;
	};
	navigateControl.addTo(map);
	*/
	   // إضافة زر على اليمين
 // إضافة زر على اليمين باستخدام jQuery
 var $rightButton = $('<div>', {
	class: 'map-btn right show-modal',
	html: '<i class="fa fa-search fa-2x" aria-hidden="true"></i>',

	click: function() {
		$("#myModal").css("display", "block");
		
	}
}).appendTo(map.getContainer());
	 
 //
 var $rightBtnDir = $('<div>', {
	class: 'map-btn right2 ',
	html: '<img src ='+mainurl+'/get-directions.png'+'>',
	id:'nav-btn',
	click: function (e) {
		e.preventDefault();
		if (userLocation && selectedCompany) {
			let url =
				`https://www.google.com/maps/dir/${userLocation.lat},${userLocation.lng}/${selectedCompany.latitude},${selectedCompany.longitude}`;
			window.open(url, "_blank");
		} else {
			swal("لم يتم تحديد موقعك بعد أو لم تحدد الوجهة .");
			//	alert("لم يتم تحديد موقعك بعد أو لا توجد شركات قريبة.");
		}
	}
}).appendTo(map.getContainer());


	// تحميل الشركات عند اكتمال تحميل الخريطة
	map.on('load', function () {
		loadCompanies();
	});

	// تحديث النتائج عند تغيير حدود الخريطة
	map.on('moveend', function () {
		if (map) { // تأكيد وجود الخريطة
			loadCompanies();
		}
	});
	// دالة جلب البيانات
	function loadCompanies() {
		if (!map) { // التحقق من وجود الخريطة
			console.error('Map not initialized!');
			return;
		}

		const bounds = map.getBounds();
		var formData = $("#search_map").serialize();
		var cat=$('.select-filter').attr('id');
		cat=cat.replace('cat-','');
		$.ajax({
			url: '/searchmap',
			method: 'POST',
			data: {
				category: cat,
				srchtxt: $('#text-search-main').val().trim(),
				formdata: formData,
				bounds: JSON.stringify({
					north: bounds.getNorth(),
					south: bounds.getSouth(),
					east: bounds.getEast(),
					west: bounds.getWest()
				}),
				_token: token
			},
			success: function (companies) {
				companyMarkers.clearLayers();
				$.each(companies, function(key, company) {
				 
					var cat_title = '';
					var cat_icon = 'default.png';
					if (!((typeof company.category === 'undefined') || (company.category == null))) {
						cat_title = company.category.title;
						if (company.category.icon) {
							cat_icon = company.category.icon;
						}
					}
					var fulliconPath = mainurl + "/" + cat_icon;
					let latLng = L.latLng(company.latitude, company.longitude);
					const marker = L.marker([company.latitude, company.longitude], {
						icon: L.icon({
							iconUrl: fulliconPath,
							iconSize: [24]
						})
					}).addTo(companyMarkers)
						.bindPopup(
							`<a style="color:#fdc93a" href="` + companyurl + '/' + `${company.id}"><b>${company.title}</b></a><br>${cat_title}`
						);
					//  companyMarkers.addLayer(marker);
					marker.on("click", function () {
						if (userLocation) {
							let distance = map.distance([userLocation.lat,
							userLocation.lng
							], latLng) / 1000; // تحويل إلى كم
							distance = distance.toFixed(
								2); // تقريب الرقم إلى منزلتين عشريتين

							marker.setPopupContent(`<div style="text-align:center;">
                  <a  style="color:#fdc93a"  href="` + companyurl + '/' + `${company.id}">  <b>${company.title}</b></a>
					<br>${cat_title}
					<br>
                    🛣️ المسافة: <b>${distance} كم</b><br></div>`);
						}

						selectedCompany = company;
					//	$("#navigate-btn").prop("disabled", false) ;
						//$("#navigate-btn > i").removeClass('no-color').addClass('main-color');
					//	$('.leaflet-control-custom').attr('title',`الاتجاه إلى: ${company.title}`)
						$('#nav-btn').attr('title',`الاتجاه إلى: ${company.title}`)
					});
				});

				//   map.addLayer(companyMarkers);
			},
			error: function (errorresult) {
				var response = $.parseJSON(errorresult.responseText);


			},
			finally: function () {

			}
		});
	}

	// بدء التطبيق

	// تحديث النتائج عند تغيير التصنيف
	$('#category').change(function () {
		if (map) {
			loadCompanies();
		}
	});


	// filter


	$('#city_id').on('change', function (e) {

		var option = $(this).find(":selected").val();
		//loading('.city-load');
		getcities(option);
		//endloading() ;
		var cityLoc = [$(this).find(":selected").attr("data-lat"), $(this).find(":selected").attr("data-long")];
		loadCompanies();
		if (option != 0) {
			flyTOLoc(cityLoc);
		}


	});
	$('.cat-tag').on('click', function (e) {
		$('.cat-tag').removeClass('select-filter');
		$(this).addClass('select-filter');
		if (map) {
			loadCompanies();
		}
		//var option = $(this).find(":selected").val();
		//loading('.city-load');
	 
		//endloading() ;
	//	var cityLoc = [$(this).find(":selected").attr("data-lat"), $(this).find(":selected").attr("data-long")];
		//loadCompanies();
	 


	});

	$(document).on('change', '#subcity', function (e) {
		var option = $(this).find(":selected").val();

		var cityLoc = [$(this).find(":selected").attr("data-lat"), $(this).find(":selected").attr("data-long")];
		loadCompanies();
		if (option != 0) {
			flyTOLoc(cityLoc);
		}

	});
	function getcities(option) {
		if (option == 0) {
			var choose = "الكل";

			$("#subcity").html('<option title="" value="0" >' + choose + '</option>');
		} else {
			var newurl = subcityurl;
			newurl = newurl.replace("ItemId", option);

			$.ajax({
				url: newurl,
				type: "GET",
				//	contentType: false,
				//	processData: false,
				//contentType: 'application/json',
				success: function (data) {
					if (data.length == 0) {
					} else {
						fillCities(data);
					}

				}, error: function (errorresult) {

				}
			});
		}

	}

	function fillCities(data) {
		var choose = "الكل";
		$("#subcity").html('<option title="" value="0" >' + choose + '</option>');
		$.each(data, function (key, value) {

			// if (selcity == value.id) {
			// 	$("#city").append('<option selected value="' + value.id + '">' + value.name_ar + '</option>');

			// } else {
			$("#subcity").append('<option value="' + value.id + '" data-lat="' + value.latitude + '" data-long="' + value.longitude + '">' + value.subname + '</option>');
			//}
		}); // close each()'latitude', 'longitude',  data-lat="'+value.latitude+'" data-long="'+value.longitude+'"
	}

	//Buttn search click
	//register form 
	$('#search_map_btn').on('click', function (e) {
		e.preventDefault();

		if (map) { // تأكيد وجود الخريطة
			loadCompanies();
		}
		modal.css("display", "none");

	});


	function flyTOLoc(cityLoc) {
		map.flyTo(cityLoc, 13, {
			animate: true, // تفعيل التأثير
			duration: 3 // التأخير الزمني (0.5 ثانية)
		});
	}
	//end filter

	var modal = $("#myModal");
    var btn = $("#myBtn");
    var span = $(".close").first(); // أول عنصر يحتوي على الكلاس "close"

    // عند النقر على الزر، افتح الـ Modal
    btn.on("click", function() {
        modal.css("display", "block");
    });

    // عند النقر على <span> (x)، أغلق الـ Modal
    span.on("click", function() {
        modal.css("display", "none");
    });

    // عند النقر خارج الـ Modal، أغلق الـ Modal
    $(window).on("click", function(event) {
        if (event.target == modal[0]) {
            modal.css("display", "none");
        }
    });

});