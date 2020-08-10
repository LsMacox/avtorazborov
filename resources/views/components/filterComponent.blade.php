<div class="filterComponent">
    <select name="filter_marks" class="filter_marks" id="filterMarks">
        <option disabled="">Марка</option>
        <option value="all" selected="">Все марки</option>
        @foreach ($marks as $mark)
            <option value="{{ $mark->title }}">{{ $mark->title }}</option>
        @endforeach
    </select>
    <select name="filter_models" class="filter_models" id="filterModels">
        <option disabled="">Модель</option>
        <option value="all" selected="">Все модели</option>
    </select>
    <select name="filter_city" class="filter_city" id="filterCity">
        <option disabled="">Город</option>
        <option value="all" selected="">Все города</option>
        @foreach ($cities as $city)
            <option value="{{ $city->title }}">{{ $city->title }}</option>
        @endforeach
    </select>
    <button class="btn_search" id="search">Поиск</button>
</div>