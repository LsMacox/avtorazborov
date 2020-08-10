@extends('layouts.shop.index')

@section('main_style')
    <link rel="stylesheet" href="{{asset('css/layouts/proposals.css')}}">
    <link rel="stylesheet" href="{{asset('css/layouts/pagination.css')}}">
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2 d-flex justify-content-center">
          <div class="col-sm-6">
            <p class="m-0 text-dark text-center proposal_p">Поданные заявки на поиск запчастей</p>
          </div>
        </div>
      </div>
    </div>
    @component('components.filterComponent', ['marks' => $marks, 'cities' => $cities])@endcomponent
    <div class="content">
      <div class="table-responsive">
        <table class="table table-main table-striped table-hover table-proposal" style="font-size: 14px;" id="proposals">
            <thead>
              <tr>
                <th class="bg-white border-0"></th>
                <th scope="col">№</th>
                <th scope="col">Дата</th>
                <th scope="col">Марка авто</th>
                <th scope="col">Модель авто</th>
                <th scope="col">Г/В</th>
                <th scope="col">VIN(Номер кузова)</th>
                <th scope="col">Номер двигателя</th>
                <th scope="col">Требуемые запчасти</th>
                <th scope="col">Номер</th>
                <th scope="col">Город</th>
              </tr>
            </thead>
            <tbody id="data-container">
            @forelse($proposals as $proposal)
              <tr onclick="document.location.href = '{{ route('shop.proposal.show', $proposal->id) }}'">
                  <td class="bg-white border-0"></td>
                  <td>{{$proposal->id}}</td>
                  <td>{{ date('d.m.Y', strtotime($proposal->created_at)) }}</td>
                  <td>{{$proposal->mark}}</td>
                  <td>{{$proposal->model}}</td>
                  <td>{{$proposal->year_of_issue}}</td>
                  <td>{{$proposal->vin}}</td>
                  <td>{{$proposal->engine_number}}</td>
                  <td>{{$proposal->spares}}</td>
                  <td>{{$proposal->phone}}</td>
                  <td>{{$proposal->city}}</td>
                </tr>
              @empty
                <tr>
                  <td class="bg-white border-0"></td>
                  <td class="text-muted text-center" style="font-size: 25px" colspan="10">Скоро здесь появятся заявки</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          {!! $proposals->render() !!}
          <div id="data-pagination" class="paginationjslib"></div>
      </div>
    </div>
@endsection
@section('main_script')
<script type="text/javascript">
    var models;

    $('.filter_marks').niceSelect();
    $('#filterModels').niceSelect();
    $('#filterCity').niceSelect();

    $('.filter_marks').change(function() {
        $('#filterModels').find('option').remove();

        axios.get(laroute.route('transport.cars.get-mark-models', {mark_name_or_mark_id: $(this).val()}))
            .then(response => {
                console.log(response.data);
                models = response.data;
                var option = document.createElement('option');
                var option2 = document.createElement('option');
                option.append('Модель');
                option.setAttribute('disabled', 'disabled');
                option.setAttribute('selected', 'selected');
                option2.append('Все модели');
                option2.setAttribute('value', 'all');
                option2.setAttribute('selected', 'selected');
                document.getElementById('filterModels').append(option);
                document.getElementById('filterModels').append(option2);
                models.forEach(element => {
                    var option = document.createElement('option');
                    option.append(element.title);
                    document.getElementById('filterModels').append(option);
                });
                $('#filterModels').niceSelect('update');
            });
    });

    $('#search').click(function() {
        if ($('#filterMarks').val() == 'all' && $('#filterModels').val() == 'all' && $('#filterMarks').val() == 'all' && $('#filterModels').val() == 'all')
        {
            axios.post(laroute.route('filter.proposal'), {
                mark: 'all',
                model: 'all',
                city: 'all'
            })
                .then((response) => {
                    addProposals(response.data);
                });

            return;
        }else if ($('#filterMarks').val() != 'all' && $('#filterModels').val() == 'all'
            || $('#filterMarks').val() == 'all' && $('#filterModels').val() == 'all' ) {
            return;
        }

        axios.post(laroute.route('filter.proposal'), {
            mark: $('#filterMarks').val(),
            model: $('#filterModels').val(),
            city: $('#filterCity').val()
        })
            .then((response) => {
                addProposals(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });

    function addProposals(data) {
        $("#proposals").find('tbody').find('tr').remove();
        $('.table-responsive').find('[role="navigation"]').remove();

        if (data.length == 0){
            var tdwhite = document.createElement('td');
            var tr = document.createElement('tr');
            var td = document.createElement('td');

            tdwhite.setAttribute('class', 'bg-white');
            td.setAttribute('class', 'text-muted text-center');
            td.setAttribute('style', 'font-size: 25px;');
            td.setAttribute('colspan', '10');

            td.append('Ничего не найдено');
            tr.append(tdwhite);
            tr.append(td);


            document.getElementById('data-container').append(tr);
            return;
        }
        //Paginate
        $('#data-pagination').pagination({
            dataSource: data,
            pageSize: 30,
            callback: function(data, pagination) {
                var html = simpleTemplating(data);
                $('#data-container').html(html);
            }
        });



        function simpleTemplating(data) {
            var result;
            $.each(data, function(index, item){
                var html = `<tr style="cursor: pointer;" id="${item.id}" onclick="document.location.href = '/cabinet/proposal/${item.id}'">`;
                html +=  '<td class="bg-white border-0"></td>';
                html +=  '<td scope="row">' + item.id + '</td>';
                html +=  '<td class="date">' + `${item.created_at ? item.created_at : ''}` +  '</td>';
                html +=  '<td>' + `${item.mark != null ? item.mark : ''}` + '</td>';
                html +=  '<td>' + `${item.model != null ? item.model : ''}` + '</td>';
                html +=  '<td>' + `${item.year_of_issue != null ? item.year_of_issue : ''}` + '</td>';
                html +=  '<td>' + `${item.vin != null ? item.vin : ''}` + '</td>';
                html +=  '<td>' + `${item.engine_number != null ? item.engine_number : ''}` + '</td>';
                html +=  '<td>' + `${item.spares != null ? item.spares : ''}` + '</td>';
                html +=  '<td>' + `${item.phone != null ? item.phone : ''}` + '</td>';
                html +=  '<td>' + `${item.city != null ? item.city : ''}` + '</td>';
                html += '</tr>';
                result += html;
            });

            return result;
        }
    }
</script>
@endsection