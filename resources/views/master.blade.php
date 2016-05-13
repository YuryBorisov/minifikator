@extends('layout')
@section('title', 'Минификатор')
@section('js')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('form').submit(function (e) {
                e.preventDefault();
                var url = $('input[name=url]').val();
                var checked = $('input[type=checkbox]:checked').length;
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: {
                        url: url,
                        checked: checked
                    },
                    success: function (data) {
                        data = $.parseJSON(data);
                        switch (data.response.status){
                            case 'ok':
                                $('input[name=url]').val('');
                                $('#add').css({'display':'block'});
                                $('#add span').text('Ваш короткий URL ');
                                $('#add span').append('<a target="_blank" href="http://' + data.response.url_short + '">' + data.response.url_short + '</a>');
                                break
                            default: console.log(data.response.status);
                        }
                    }
                });

            });
        });
    </script>
@endsection
@section('content')
    <div class="title"><span>Уменьши URL своего сайта :)</span></div>
    <div class="title" id="add"><span></span></div>
    <form action="/add" method="POST">
        <input type="text" placeholder="Введите URL" name="url"/>
        <input type="checkbox">Создать ссылку с ограниченным сроком годности? (1 час)
        <input type="submit" value="Уменьшить"/>
    </form>
    <div class="title"><span>Ваши уменьшенные URL :)</span></div>
    <div class="my-url-content">
        @foreach($data as $item)
            <div class="title"><a target="_blank" href="http://vk.com/id333114129">
                    <a target="_blank" href="http://{{$_SERVER['SERVER_NAME']}}/{{$item->url_short}}"><span>{{$_SERVER['SERVER_NAME']}}/{{$item->url_short}}</span></a>
                    <a class="p" target="_blank" href="statistics/{{$item->url_short}}">Статистика</a>
            </div>
        @endforeach
    </div>
@endsection
