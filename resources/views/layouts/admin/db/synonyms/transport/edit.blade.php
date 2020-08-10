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
            <div class="row mb-2 d-flex justify-content-center">
                <div class="col-sm-6">
                    <p class="m-0 p-0 text-dark text-center proposal_p">Редактирования Синонимов</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <form action="{{route('admin.db.synonym.transport.update', $word->id)}}" method="post" id="form">
            @csrf
            @method('PATCH')
            <div class="input-group mb-3 ml-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Группа слов</span>
                </div>
                <input type="text" name="name" value="{{$word->name}}" class="form-control" style="max-width: 200px;">
            </div>
            <p class="text-left ml-5 text-bold">Группа синонимов</p>
            @foreach($word->synonym_transport_synonyms as $synonym)
                <div class="input-group mb-3 ml-3" style="transition: .6s ease">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #fff"><a class="delete-synonym" href="#" style="color: red"><i class="fas fa-trash-alt" style="font-weight: 400"></i></a></span>
                    </div>
                    <input type="hidden" name="SYNONYM_{{$synonym->id}}[id]" value="{{$synonym->id}}" >
                    <input type="text" name="SYNONYM_{{$synonym->id}}[name]" value="{{$synonym->name}}" class="form-control" style="max-width: 200px;">
                </div>
            @endforeach
            <button class="btn btn-success pull-right" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@section('main_script')
    <script type="text/javascript">
        $('.delete-synonym').click(function() {
            axios.delete(laroute.route('admin.db.synonym.transport.synonym.delete', {id: $(this).parent().parent().parent().find("[type='hidden']").val()}))
            .then(response => {
                $(this).parent().parent().parent().css({'opacity' : '0'});
                setTimeout(() => {
                    $(this).parent().parent().parent().remove();
                }, 600);
            });
        });


   </script>
@endsection