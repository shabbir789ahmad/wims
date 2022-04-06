@extends('panel.master')
@section('content')


    <div style="text-align: center;">
        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG('11', 'C39')}}" alt="barcode" /><br><br>
       
    </div>

@endsection