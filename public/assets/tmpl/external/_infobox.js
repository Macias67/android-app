function drawInfobox(category, infoboxContent, json, i) {

	if (json.data[i].app.color) {
		var color = json.data[i].app.color
	}
	else {
		color = ''
	}
	if (json.data[i].app.price) {
		var price = '<div class="price">' + json.data[i].app.price + '</div>'
	}
	else {
		price = ''
	}
	if (json.data[i].id) {
		var id = json.data[i].id
	}
	else {
		id = ''
	}
	if (json.data[i].app.url) {
		var url = json.data[i].app.url
	}
	else {
		url = ''
	}
	if (json.data[i].app.url_modal) {
		var url_modal = json.data[i].app.url_modal
	}
	else {
		url_modal = ''
	}
	if (json.data[i].subcategorias[0].subcategoria) {
		var type = json.data[i].subcategorias[0].subcategoria
	}
	else {
		type = ''
	}
	if (json.data[i].nombre) {
		var title = json.data[i].nombre
	}
	else {
		title = ''
	}
	if (json.data[i].calle && json.data[i].numero && json.data[i].colonia) {
		var location = json.data[i].calle +' '+ json.data[i].numero +' Col. '+ json.data[i].colonia;
	}
	else {
		location = ''
	}
	if (json.data[i].galeria.length > 0  && json.data[i].galeria[0].original) {
		var gallery = json.data[i].galeria[0].original
	}
	else {
		 gallery = '../assets/tmpl/img/default-item.jpg'
	}

	var ibContent = '';
	ibContent     =
		'<div class="infobox ' + color + '">' +
			'<div class="inner">' +
			'<div class="image">' +
			'<div class="item-specific">' + drawItemSpecific(category, json, i) + '</div>' +
			'<div class="overlay">' +
			'<div class="wrapper">' +
			'<a href="#" class="quick-view" data-toggle="modal" data-target="#modal" id="' + id + '" data-url = "' + url_modal + '"> Ver </a>' +
			'<hr>' +
			'<a href="' + url + '" class="detail">Detalles</a>' +
			'</div>' +
			'</div>' +
			'<a href="' + url + '" class="description">' +
			'<div class="meta">' +
			price +
			'<h2>' + title + '</h2>' +
			'<h6>' + type + '</h6>' +
			'<figure>' + location + '</figure>' +
			'<i class="fa fa-angle-right"></i>' +
			'</div>' +
			'</a>' +
			'<img src="' + gallery + '">' +
			'</div>' +
			'</div>' +
		'</div>';

	return ibContent;
}