
$(document).ready(function () {
	var userIcon = mainurl + "/usermrker.png";

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


	}
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(
			function (position) {
				setUserLocation(position.coords.latitude, position.coords.longitude);
			},
			function () {

				$.getJSON('http://ip-api.com/json/', function (data) {
					if (data.status === "success") {
						setUserLocation(data.lat, data.lon);
					} else {

					}
				});
			}
		);
	}
	let navigateControl = L.control({
		position: "topleft"
	});
 
	let userLocation = null;

	let selectedCompany = null;
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

	map.on('load', function () {
		loadCompanies();
	});



	function loadCompanies() {
		if (!map) { // التحقق من وجود الخريطة
			console.error('Map not initialized!');
			return;
		}

		//	const bounds = map.getBounds();
		var formData = $("#search_map").serialize();
		$.ajax({
			url: '/searchbyid',
			method: 'POST',
			data: {
				id: comId,
				_token: token
			},
			success: function (company) {
				companyMarkers.clearLayers();


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
			  <a style="color:#fdc93a" href="` + companyurl + '/' + `${company.id}">  <b>${company.title}</b></a>
				<br>${cat_title}
				<br>
				🛣️ المسافة: <b>${distance} كم</b><br></div>`);
					}

					selectedCompany = company;
					$("#navigate-btn").prop("disabled", false) ;
					$("#navigate-btn > i").removeClass('no-color').addClass('main-color');
					$('.leaflet-control-custom').attr('title',`الاتجاه إلى: ${company.title}`)
				});
				flyTOLoc([company.latitude, company.longitude]);

				//   map.addLayer(companyMarkers);
			},
			error: function (errorresult) {
				var response = $.parseJSON(errorresult.responseText);


			},
			finally: function () {

			}
		});
	}
	function flyTOLoc(cityLoc) {
		map.flyTo(cityLoc, 13, {
			animate: true,
			duration: 3
		});
	}

	loadCompanies();

});