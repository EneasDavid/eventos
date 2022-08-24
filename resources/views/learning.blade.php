<h1>Revisão Laravel</h1>

{{--PHP puro em Laravel--}}
@php
    $name='David';
    echo $name;
@endphp

{{--Condição em Laravel--}}
@if(4 < 5)
    <p>condição verdadeira</p>
@else
    <p>condição falsa</p>
@endif

{{--Importando dados do routes/controller--}}
<p>Bem vindo {{$nome}}, fiquei sabendo que cê tem {{$idade}} anos e gostaria de trabalhasr com {{$profissao}}</p>

{{--for em Laravel--}}
@for($i=0;$i< count($array);$i++)
    <p>{{$array[$i]}} - {{$i}}</p>
    @if($i==3)
        <p1>o contador atingiu a terceira posição</p1>
    @endif
@endfor

{{--forEachem Laravel--}}
@foreach ($nomes as $nome)
    <p>{{$loop->index}}</p>
    <p>{{$nome}}</p>
@endforeach
@if($id!=null)
    <p>o id é {{$id}}</p>
@endif
@if($busca!=null)
    <p>Usuario procura por: {{$busca}}</p>
@endif

{{--Comentario em Laravel--}}
<!--Comentario em HTML-->