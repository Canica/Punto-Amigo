
{{ Form::open(['route' => 'comment', 'method' => 'PUT', 'role' => 'form', 'novalidate']) }}
        {{ Form::hidden('title') }}
        {{ Field::textarea('comment', '', ['placeholder' => 'Comenta este producto', 'class' => 'fildComentario']) }}

        {{ Form::hidden('user_id', '1') }}
        {{ Form::hidden('component_name', 'productos') }}
        {{ Form::hidden('component_item_id', $id) }}

        {{ Form::submit('Envíar', ['class' => 'button tiny']) }}
{{ Form::close() }}

<div class="comentarios">
    <h3>Comentarios</h3>
    @foreach($comments as $comment)
        <div class="comentario">
            <div class="row comentariosBottom">
                <div class="columns large-12 userDataComent"><i>Nicolás {{$comment->username}} -  <small>{{ Str::limit($comment->created_at, 10, '') }}</small></i></div>
                <div class="columns large-2"><ngcart-rate valor="{{$rate}}"></ngcart-rate></div>
                <div class="columns large-12">{{ $comment->comment}}</div>
            </div>
        </div>
    @endforeach
</div>
