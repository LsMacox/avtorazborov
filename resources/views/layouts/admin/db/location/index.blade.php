@extends('layouts.admin.index')

@section('content')
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-model-tab" data-toggle="tab" href="#nav-model" role="tab" aria-controls="nav-model" aria-selected="true">Города</a>
            <a class="nav-item nav-link" id="nav-mark-tab" data-toggle="tab" href="#nav-mark" role="tab" aria-controls="nav-mark" aria-selected="false">Области</a>
        </div>
    </nav>
    @if(Session::has('message'))
        <div class="alert alert-primary m-2">{{ Session::get('message') }}</div>
    @endif
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-model" role="tabpanel" aria-labelledby="nav-model-tab">
            <form action="{{ route('admin.db.location.city.store') }}" method="post" class="mt-4 ml-3 mr-3">
                @csrf
                <div class="form-group">
                    <label for="title">Название города</label>
                    <input name="title" type="text" class="form-control" id="title" aria-describedby="title" placeholder="Введите название города" required>
                </div>
                <div class="form-group">
                    <label for="region_id">Идентификатор нужной марки (можно узнать в вкладке "области")</label>
                    <input name="region_id" type="text" class="form-control" id="region_id" aria-describedby="region_id" placeholder="Введите идентификатор области" required>
                </div>
                <button type="submit" class="btn btn-success pull-right">Сохранить</button>
            </form>
            <div class="table-responsive">
                <table class="table table-main table-striped table-hover mt-5">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Название города</th>
                        <th scope="col">Идентификатор области</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($cities as $city)
                        <tr>
                            <th scope="row"><a style="color: #212529; text-decoration: none;">{{$city->id}}</a></th>
                            <td><a style="color: #212529; text-decoration: none;">{{$city->title}}</a></td>
                            <td><a style="color: #212529; text-decoration: none;">{{$city->region_id}}</a></td>
                            <td>
                                <i
                                        onclick="event.stopPropagation(); if (confirm('Вы действительно хотите удалить город?')) { document.getElementById('admin_marks_destroy_{{ $city->id }}').submit() }"
                                        style="font-size: 25px; margin-left: 20px; margin-bottom: 5px; cursor: pointer"
                                        class="fa fa-trash"></i>
                                <form action="{{ route('admin.db.location.city.destroy', $city->id) }}" method="post" class="d-none" id="admin_marks_destroy_{{ $city->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-muted text-center" style="font-size: 25px" colspan="6">Нету данных</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <nav aria-label="Page navigation" style="float: right; margin-right: 17px;">
                    <ul class="pagination">
                        <?php echo $cities->render(); ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-mark" role="tabpanel" aria-labelledby="nav-profile-tab">
            <form action="{{ route('admin.db.location.region.store') }}" method="post" class="mt-4 ml-3 mr-3">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="title">Название области</label>
                    <input name="title" type="text" class="form-control" id="title" aria-describedby="title" placeholder="Введите название области" required>
                </div>
                <button type="submit" class="btn btn-success pull-right">Сохранить</button>
            </form>
            <div class="table-responsive">
                <table class="table table-main table-striped table-hover mt-5">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Название области</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($regions as $region)
                        <tr>
                            <th scope="row"><a style="color: #212529; text-decoration: none;">{{$region->id}}</a></th>
                            <td><a style="color: #212529; text-decoration: none;">{{$region->title}}</a></td>
                            <th>
                                <i
                                        onclick="event.stopPropagation(); if (confirm('Вы действительно хотите удалить область?')) { document.getElementById('admin_models_destroy_{{ $region->id }}').submit() }"
                                        style="font-size: 25px; margin-left: 20px; margin-bottom: 5px; cursor: pointer"
                                        class="fa fa-trash"></i>
                                <form action="{{ route('admin.db.location.region.destroy', $region->id) }}" method="post" class="d-none" id="admin_models_destroy_{{ $region->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </th>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-muted text-center" style="font-size: 25px" colspan="5">Нету данных</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <nav style="float: right; margin-right: 17px;">
                    <ul class="pagination">
                        <?php echo $regions->render(); ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection