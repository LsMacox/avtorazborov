@extends('layouts.admin.index')

@section('main_style')
    <link rel="stylesheet" href="{{asset('css/layouts/synonym.css')}}">
@endsection

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-primary m-2">{{ Session::get('success') }}</div>
    @endif
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex justify-content-center" style="max-width: 516px">
                <div class="col-sm-6">
                    <p class="m-0 p-0 text-dark text-center proposal_p">Синонимы</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="table-responsive">
            <div id="table_data">
                @include('components.admin.pagination.db.synonym_pagination')
            </div>
            <div class="synonym_add">
                <div class="add_word">
                    <a href="#">
                        Добавить группу слов
                    </a>
                </div>
                <div class="add_synonym">
                    <a href="#">
                        Добавить синоним в
                    </a>
                    <a href="#">группу слов</a>
                </div>
            </div>
            <div class="popup_synonym show">
                <div id="popup_add-word" class="hide">
                    <div class="popup_head">
                        <p>Добавить группу слов</p>
                    </div>
                    <div class="popup_body">
                        <input type="text" name="name">
                        <button><span>Добавить</span></button>
                    </div>  
                </div>
                <div id="popup_add-synonym" class="hide">
                    <div class="popup_head">
                        <p>Добавить синоним в группу слов</p>
                    </div>
                    <div class="popup_body">
                        <select class="synonym_word" id="synonym_word">

                        </select>
                        <input type="text" name="name">
                        <button><span>Добавить</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('main_script')
<script type="text/javascript">


    $('#synonym_word').niceSelect();
    addSynonymWord();


    $('.add_word').on('click', function () {
        closeAddWord();
    });
    $('.add_synonym').on('click', function () {
        closeAddSynonym();
    });

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        pagination_fetch_data(page);
    });

    // Add Word
    $('#popup_add-word button').on('click', function() {
        axios.post('{{route('admin.db.synonym.transport.word.store')}}', {
            name: $(this).parent().find('input[name="name"]').val(),
        })
        .then(response => {
            pagination_fetch_data(response);
            addSynonymWord();
        })
        .catch(error => {
            swal.fire({
                icon: 'error',
                title: 'Ошибка...',
                text: error.response.data.errors.name,
            });
        });
        $(this).parent().find('input[name="name"]').val('');
    });
    $('#popup_add-synonym button').on('click', function () {

        axios.post('{{route('admin.db.synonym.transport.synonym.store')}}', {
            name: $(this).parent().find('input[name="name"]').val(),
            synonym_transport_name_id: $(this).parent().find('#synonym_word').val()
        })
        .then(response => {
            pagination_fetch_data(response);
            addSynonymWord();
        })
        .catch(error => {
            let errors = '';

            for (key in error.response.data.errors) {
                errors += error.response.data.errors[key] + '\n'
            }
            console.log(errors);
            console.log(error.response.data);

            swal.fire({
                icon: 'error',
                title: 'Ошибка...',
                text: errors
            });
        });
        $(this).parent().find('input[name="name"]').val('');
    });


    function pagination(dataSources)
    {
        $('#data-pagination').pagination({
            dataSource: dataSources,
            pageSize: 6,
            callback: function (data, pagination) {
                var html = simpleTemplating(data);
                $('#data-container').html(html);
            }
        });
    }
    function pagination_fetch_data(page) {
        $.ajax({
            url: '{{route('admin.db.synonym.get-paginate')}}?page='+page,
            success: function (data) {
                $('#table_data').html(data);
            }
        })
    }
    function closeAddWord() {
        $('.popup_synonym #popup_add-synonym').removeClass('show').addClass('hide');
        if ($('.popup_synonym #popup_add-word').hasClass('hide')) {
            $('.popup_synonym #popup_add-word').removeClass('hide').addClass('show');
        }
        else{
            $('.popup_synonym #popup_add-word').removeClass('show').addClass('hide');
        }
    }
    function closeAddSynonym() {
        $('.popup_synonym #popup_add-word').removeClass('show').addClass('hide');
        if ($('.popup_synonym #popup_add-synonym').hasClass('hide')) {
            $('.popup_synonym #popup_add-synonym').removeClass('hide').addClass('show');
        }
        else{
            $('.popup_synonym #popup_add-synonym').removeClass('show').addClass('hide');
        }
    }
    function addSynonymWord() {
        $.ajax({
            url: '{{route('admin.db.synonym.get-all')}}',
            success: function (data) {
                $('#synonym_word').empty();
                data.forEach(function (value) {
                    $('#synonym_word').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
                $('#synonym_word').niceSelect('update');
            }
        });
    }
</script>
@endsection