@extends('layouts.user.index')

@section('main_style')
    <link rel="stylesheet" href="{{asset('css/layouts/add_proposal.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/nice_select.css')}}">
@endsection

@section('content')
<section id="add_proposal">
	<div class="wrap">
	<h2>ВЫБЕРИТЕ ФИРМУ АВТО</h2>
	<p class="sub tac">ДЛЯ КОТОРОЙ ТРЕБУЕТСЯ НАЙТИ ЗАП.ЧАСТЬ</p>
	<ul class="car_types">
		<li class="active"><i class="fas fa-car"></i> Легковые</li>
		<li>
			<i class="fas fa-truck" style="transform: rotateY(180deg);"></i> Грузовые
			<p class="soon">Скоро!</p>
		</li>
		<li>
			<i class="fa fa-bus"></i> Спецтехника
			<p class="soon">Скоро!</p>
		</li>
	</ul>

	<!-- /.car_types -->
	<div class="logos">
		@foreach($marks as $mark)
			<a href="#x" class="logo-mini">
				<div class="img"><img src="{{asset('images'.$mark->logo)}}"></div>
				<p>{{ucfirst($mark->title)}}</p>
			</a>
		@endforeach
	</div>
	<!-- logos -->
	<div class="catalog_wrapper" style="display: none">
			@if ($errors->any())
				<div class="alert alert-danger mt-5">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			@if(session('ErrorProposalLimit'))
				<div class="alert alert-danger mt-5">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<ul>
						<li>{{session('ErrorProposalLimit')}}</li>
					</ul>
				</div>
			@endif
			@if(session('ErrorDblProposalToday'))
				<div class="alert alert-danger mt-5">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<ul>
						<li>{{session('ErrorDblProposalToday')}}</li>
					</ul>
				</div>
			@endif
			<div class="catalog">

			</div><!-- catalog-->
		</div> <!-- catalog_wrapper-->
		<div id="ajaxCatalog">
			<div class="close"><i class="fas fa-arrow-circle-right"></i></div>
			<p><strong>Вы выбрали:</strong></p>
			<p class="model">Toyota</p>
			<p><strong>Выберите модель авто:</strong></p>

			<div class="clearfix"></div>
			<div id="renderModels">
				<li class="big"><a href="#x" onclick="popup(123, this)">5-Series Gran Turismo</a></li>
			</div>
		</div>
	</div>
</section>
        
<div class="popup-bg" id="popup-bg">

  @component('components.popups.user.add_proposal', ['popup_id' => 123])@endcomponent

</div>
@endsection

@section('main_script')
<script type="text/javascript" defer>
$(document).ready(function(){

	var curPos=$(document).scrollTop();
	var height=$("body").height();
	var scrollTime=(height-curPos)/1.73;
	$("body,html").animate({"scrollTop":height},scrollTime);

	document.getElementById('popup-bg').onclick = function(e) {if (e.target != this) { return true; } popup(-1);}
	$('.god').niceSelect();
	showAllFirms();

});
$('#add_proposal .catalog, #add_proposal .popular').on('click', 'li', renderModels);
$('.logos').on('click', '.logo-mini', renderModels);
$('#ajaxCatalog .close').on('click', function(){
	$('#ajaxCatalog').slideUp();
	$("html:not(:animated),body:not(:animated)").animate({scrollTop: $('#add_proposal .logos').offset().top -50 }, 500);
});


function unique(arr) {
	var obj = {};

	for (var i = 0; i < arr.length; i++) {
		var str = arr[i];
		obj[str] = true; // запомнить строку в виде свойства объекта
	}

	return Object.keys(obj); // или собрать ключи перебором для IE8-
}

async  function renderModels () {

	$marka = $(this).text();
	$marka = $.trim($marka);

	$('#ajaxCatalog .model').html( $marka );

	$('#renderModels').html('');



	await axios.get(laroute.route('transport.cars.get-mark-models', {mark_name_or_mark_id: $marka}))
	.then ((response) => {
		window.$models = response.data;
	});

	//Добавление данных в массив из бд
	var list = [];
	var simvols = [];

	for (var i = 0; i < window.$models.length; i++){
		list.push(window.$models[i].title);
		simvols.push(window.$models[i].title.charAt(0));
	}

	//Сортировка по алфавиту
	list.sort();
	simvols.sort();

	//Вывод букв Алфавита в верхний регистр
	simvols = simvols.map(function (e) { return e.toUpperCase() });
	listComparison = list.map(function (e) { return e.toUpperCase().charAt(0) });
	//Удаление лишних символов (уникалификация)
	simvols = unique(simvols);


	var letters = {};

	for (var r = 0; r < simvols.length; r++) {
		letters[simvols[r]] = [];
		for (var i = 0; i < listComparison.length; i++) {
			if ( simvols[r].indexOf(listComparison[i]) !== -1 ){
				letters[simvols[r]].push(list[i]);
			}
		}
	}

	for (key in letters) {
		let block = document.createElement('div');
		block.classList.add('block');

		let p = document.createElement('p');
		p.className = 'letter';
		p.appendChild(document.createTextNode( key ) );
		block.appendChild(p);

		let ul = document.createElement('ul');

		let array = letters[key];

		block.setAttribute("data-model", $marka);

		for	( let i = 0; i < array.length; i++ ) {
			li = document.createElement('li');
			a = document.createElement('a');
			a.appendChild(document.createTextNode(array[i]));
			a.href= '#x';
			a.setAttribute("onclick", 'popup(123, this)');
			li.appendChild(a);
			ul.appendChild(li)
		}

		block.appendChild(ul);
		$('#renderModels').append(block);
	}

	$('#ajaxCatalog').slideDown();

	$("html:not(:animated),body:not(:animated)").animate({
		scrollTop: $('#add_proposal #ajaxCatalog').offset().top -50
	}, 500);

	if ( document.documentElement.clientWidth < 430 ) {
		$('#add_proposal .btn.close.mob').show().css('display', 'flex');
	}
}

function toggleMobMenu () {
	$('body, #menu').toggleClass('open_menu');
}

function scrollToCatalog() {
	$("html:not(:animated),body:not(:animated)").animate({
		scrollTop: $('#add_proposal .logo-mini:last-child').offset().top +50
	}, 500);
}

function showAllFirms () {
	$('.catalog_wrapper').slideToggle();
	$(this).toggleClass('active');

	if ( $(this).hasClass('active') ) {
		$(this).find('span').html('Скрыть все фирмы');
		scrollToCatalog();
	}else{
		$(this).find('span').html('Показать все фирмы');
		scrollToCatalog();
	}
}

function popup(nm, e) {
	popupElm = document.getElementById("popup-bg");

	if (nm == -1) {
		popupElm.classList.remove('visible');
		document.querySelector('body').style.overflow = 'auto';
		document.querySelector('body').style.overflowX = 'hidden';
	} else {
		elm = popupElm.getElementsByClassName('popup');
		if (typeof nm != 'undefined') {
			for (var i = elm.length - 1; i >= 0; i--) {
				if (elm[i].id == 'popup' + nm) {
					if ( typeof e !== 'undefined' && nm == 123 ) {
						$marka = $(e).parents('#ajaxCatalog').find('.model').text();
						currentMarka = $(e).parents('#ajaxCatalog').find('.model').text();

						$model = $(e).text();

						$(elm).find('[name="mark"]').val( $marka );
						$(elm).find('[name="mark"]').niceSelect('update');

						let models = $('.catalog .block[data-model="' + currentMarka + '"]');
						$.each(models, function(index, val) {
							let model_lists = $(models[index]).find('li');
							$.each(model_lists, function(index, val) {
								let model = $(model_lists[index]).text();
								$('select[name="model"]').append('<option>' + model + '</option>');
							});
						});
						$(elm).find('[name="model"]').val( $model );
						$(elm).find('[name="model"]').niceSelect('update');

						$(elm).find('[name="mark"]').attr( 'onkeyup', 'valSaveMarka(this)' );
						$(elm).find('[name="model"]').attr( 'onkeyup', 'valSaveModel(this)' );

					}
					elm[i].classList.add('visible');
					popupElm.classList.add('visible');
					document.querySelector('body').style.overflow = 'hidden';
				}else {
					elm[i].classList.remove('visible');
				}
			}
		}else {
			popupElm.classList.add('visible');
			document.querySelector('body').style.overflow = 'hidden';
		}
	}
}

$(document).ready(function(){
	document.getElementById('popup-bg').onclick = function(e) {if (e.target != this) { return true; } popup(-1);}
});

var $model;
var $marka;
function valSaveMarka(e){
	$(e).val($marka);
}
function valSaveModel(e){
	$(e).val($model);
}





$("a.scrollto").click(function() {
	var scrollSpeed = 500;
	var elementClick = $(this).attr("href");

	if ( $(this).hasClass('slowScroll') ) {
		scrollSpeed = 2000;
	}

	var destination = $(elementClick).offset.top;

	$("html:not(:animated),body:not(:animated)").animate({
		scrollTop: destination
	}, scrollSpeed);
	return false;
});

 $(document).ready(function(){
	axios.get(laroute.route('transport.cars.get-marks'))
		.then(function (response) {
			console.log(response.data);
		//Добавление данных в массив из бд
		var list = [];
		var simvols = [];

		for (var i = 0; i < response.data.length; i++){
			list.push(response.data[i].title);
			simvols.push(response.data[i].title.charAt(0));
		}

		//Сортировка по алфавиту
		list.sort();
		simvols.sort();

		//Вывод букв Алфавита в верхний регистр
		simvols = simvols.map(function (e) { return e.toUpperCase() });
		listComparison = list.map(function (e) { return e.toUpperCase().charAt(0) });

		//Удаление лишних символов (уникалификация)
		simvols = unique(simvols);

		var letters = {};

		for (var r = 0; r < simvols.length; r++) {
			letters[simvols[r]] = [];
			for (var i = 0; i < listComparison.length; i++) {
				if ( simvols[r].indexOf(listComparison[i]) !== -1 ){
					letters[simvols[r]].push(list[i]);
				}
			}
		}



		for (key in letters) {
			let block = document.createElement('div');
			block.classList.add('block');

			let p = document.createElement('p');
			p.className = 'letter';
			p.appendChild(document.createTextNode( key ) );
			block.appendChild(p)

			let ul = document.createElement('ul');

			let array = letters[key];

			for	( let i = 0; i < array.length; i++ ) {
				li = document.createElement('li');
				li.setAttribute("data-marka", array[i]);
				a = document.createElement('a');
				a.appendChild(document.createTextNode(array[i]));
				a.href= '#x';
				li.appendChild(a);
				ul.appendChild(li)
			}
			block.appendChild(ul);
			$('.catalog').append(block);
		}
	});
});
</script>
@endsection