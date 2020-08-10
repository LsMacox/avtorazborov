<table class="table table-main table-striped table-hover table-proposal" style="max-width: 480px; font-size: 14px;">
    <thead>
    <tr>
        <th class="bg-white border-0"></th>
        <th>№</th>
        <th>Группа слов</th>
        <th>Синонимы</th>
        <th class="text-center">Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach($synonyms as $synonym)
        <tr onclick="document.location.href = ''">
            <th class="bg-white border-0"></th>
            <td>{{$synonym->id}}</td>
            <td>{{$synonym->name}}</td>
            <td>
                @if ($synonym->synonym_transport_synonyms->count() > 0)
                    @php $result = ''; @endphp
                    @foreach($synonym->synonym_transport_synonyms as $transportSynonym)
                        @php $result = $result.$transportSynonym->name.', ' @endphp
                    @endforeach
                    {{ mb_substr($result, 0, strlen($result)-2) }}
                @endif
            </td>
            <td scope="col" class="text-center align-middle pt-1 pb-1">
                <a href="{{route('admin.db.synonym.transport.edit', $synonym->id)}}" class="text-secondary mr-1 ml-1" style="font-size: 22px;" title="Редактировать" onclick="event.stopPropagation();">
                    <i class="fa fa-edit" style="font-weight: 400"></i>
                </a>
                <a href="#" class="text-secondary" style="font-size: 22px;" onclick="event.stopPropagation(); if(confirm('Вы дейстивтельно хотите удалить синоним?')) {event.preventDefault(); document.getElementById('synonym_del-{{$synonym->id}}').submit();}" title="Удалить">
                    <i class="fas fa-trash-alt" style="font-weight: 400"></i>
                </a>
                <form action="{{route('admin.db.synonym.transport.word.delete', $synonym->id)}}" method="POST" id="synonym_del-{{$synonym->id}}">
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $synonyms->links() !!}