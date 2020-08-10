<div class="popup popup_user_add_proposal" id="popup{{$popup_id}}">
    <div class="head">
      <div class="close" onclick="popup(-1)">&times;</div>
    </div>
    <div class="content">
		<form action="{{ route('user.proposal.store') }}" method="post">
		    @csrf
			<div class="labels">
				<p>Круглосуточно</p>
				<p>Бесплатно</p>
			</div>
			<p class="form_title willHide" id="form_title">ЗАПОЛНИТЕ ДЛЯ ПОИСКА ЗАПЧАСТИ</p>
			<p class="form_subtitle willHide mb2" id="form_subtitle">по всем авторазборкам и магазинам <br> <span>в г. {{Geo::get_value('city')}} и области</span> </p>
			<p class="form_title secondTitle hidden">ДЛЯ ОТПРАВКИ ЗАЯВКИ НА ПОИСК И ПОЛУЧЕНИЯ ОТВЕТОВ ОТ ВСЕХ автоРАЗБОРОК И МАГАЗИНОВ</p>

			<div class="form_control willHide" id="marks">
				<label><strong> 1</strong> </label>
				<input name="mark" class="marka">
			</div>
			<div class="clearfix willHide mb05"></div>
			<div class="form_control willHide"><label><strong>2</strong></label>
				<input type="text" name="model">
			</div>
			<div class="clearfix willHide mb05"></div>
			<div class="form_control willHide">
				<label style="z-index: 999999;"><strong> 3</strong> </label>
				<select name="year_of_issue" class="god" style="display: none;">
					<option selected="selected" disabled="disabled">Выберите год выпуска</option>
					@for($i=1990; $i < \Carbon\Carbon::now()->year+1; $i++)
						<option value="{{$i}}">{{$i}}</option>
					@endfor
				</select>
			</div>
			<div class="clearfix willHide mb05"></div>
			<div class="form_control willHide">
				<label><strong> 4</strong> </label>
				<input type="text" name="engine_number" placeholder="Введите номер двигателя" required="">
			</div>
			<div class="form_control willHide">
				<label><strong> 5</strong> </label>
				<input type="text" name="vin" placeholder="Введите VIN или номер кузова" required="">
			</div>
			<div class="form_control willHide">
				<label><strong> 6</strong> </label>
				<textarea name="spares" placeholder="Введите наименование  требуемых запчастей" required=""></textarea>
			</div>
			<div class="form_control willHide" id="text_sale">
				<button type="submit" class="btn goNext">
                    Узнать цены и наличие
                    <i class="fas fa-arrow-circle-right"></i>
				</button>
			</div>
	    </form>
    </div>
</div>