@extends('layouts.admin.index')

@section('content')
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-model-tab" data-toggle="tab" href="#nav-model" role="tab" aria-controls="nav-model" aria-selected="true">Марки</a>
          <a class="nav-item nav-link" id="nav-mark-tab" data-toggle="tab" href="#nav-mark" role="tab" aria-controls="nav-mark" aria-selected="false">Модели</a>
        </div>
      </nav>
      @if(Session::has('success'))
          <div class="alert alert-primary m-2">{{ Session::get('success') }}</div>
      @endif
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-model" role="tabpanel" aria-labelledby="nav-model-tab">
            <form action="{{ route('admin.db.cars.mark.store') }}" method="post" class="mt-4 ml-3 mr-3">
                @csrf
                <div class="form-group">
                    <label for="title">Название марки авто</label>
                    <input name="title" type="text" class="form-control" id="title" aria-describedby="title" placeholder="Введите название марки авто" required>
                </div>
                <div class="form-group">
                    <label for="logo">Логотип авто (необязательно)</label>
                    <input name="logo" type="text" class="form-control" id="logo" aria-describedby="logo" placeholder="Введите ссылку к логотипу авто">
                </div>
                <div class="form-group">
                    <label for="published">Раздел популярные (0 или 1)</label>
                    <input name="published" type="text" class="form-control" id="published" aria-describedby="published" placeholder="Модель в разделе популярные">
                </div>
                <button type="submit" class="btn btn-success pull-right">Сохранить</button>
            </form>
       <div class="table-responsive">
        <table class="table table-main table-striped table-hover mt-5">
            <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Название марки</th>
                    <th scope="col">Ссылка на лого</th>
                    <th scope="col">Популярный</th>
                    <th scope="col">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($marks as $mark)
                        <tr>
                        <th scope="row"><a style="color: #212529; text-decoration: none;">{{$mark->id}}</a></th>
                        <td><a style="color: #212529; text-decoration: none;">{{$mark->title}}</a></td>
                        <td><a style="color: #212529; text-decoration: none;">{{$mark->logo}}</a></td>
                        <td><a style="color: #212529; text-decoration: none;">{{$mark->published}}</a></td>
                        <td>
                        <i  
                            onclick="event.stopPropagation(); if (confirm('Вы действительно хотите удалить Марку?')) { document.getElementById('admin_marks_destroy_{{ $mark->id }}').submit() }" 
                            style="font-size: 25px; margin-left: 20px; margin-bottom: 5px; cursor: pointer" 
                            class="fa fa-trash"></i>
                        <form action="{{ route('admin.db.cars.mark.destroy', $mark) }}" method="post" class="d-none" id="admin_marks_destroy_{{ $mark->id }}">
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
                <?php echo $marks->render(); ?>
              </ul>
        </nav>
      </div>
      </div>
        <div class="tab-pane fade" id="nav-mark" role="tabpanel" aria-labelledby="nav-profile-tab">
            <form action="{{ route('admin.db.cars.model.store') }}" method="post" class="mt-4 ml-3 mr-3">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="title">Модель авто</label>
                    <input name="title" type="text" class="form-control" id="title" aria-describedby="title" placeholder="Введите модель авто" required>
                </div>
                <div class="form-group">
                    <label for="transport_car_mark_id">Идентификатор нужной марки (можно узнать в вкладке "марки")</label>
                    <input name="transport_car_mark_id" type="text" class="form-control" id="transport_car_mark_id" aria-describedby="transport_car_mark_id" placeholder="Введите идентификатор марки" required>
                </div>
                <button type="submit" class="btn btn-success pull-right">Сохранить</button>
            </form>
            <div class="table-responsive">
        <table class="table table-main table-striped table-hover mt-5">
            <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Название модели</th>
                    <th scope="col">Идентификатор модели</th>
                    <th scope="col">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($models as $model)
                        <tr>
                        <th scope="row"><a style="color: #212529; text-decoration: none;">{{$model->id}}</a></th>
                        <td><a style="color: #212529; text-decoration: none;">{{$model->title}}</a></td>
                        <td><a style="color: #212529; text-decoration: none;">{{$model->transport_car_mark_id}}</a></td>
                        <th>
                            <i  
                                onclick="event.stopPropagation(); if (confirm('Вы действительно хотите удалить Модель?')) { document.getElementById('admin_models_destroy_{{ $model->id }}').submit() }" 
                                style="font-size: 25px; margin-left: 20px; margin-bottom: 5px; cursor: pointer" 
                                class="fa fa-trash"></i>
                            <form action="{{ route('admin.db.cars.model.destroy', $model) }}" method="post" class="d-none" id="admin_models_destroy_{{ $model->id }}">
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
                <?php echo $models->render(); ?>
              </ul>
        </nav>
      </div>
        </div>
      </div>
@endsection