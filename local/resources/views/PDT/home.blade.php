@extends('layouts.app')

@section('content')
	<div class="container-fluid">
	<div class="row" style="margin-left: 0%" >
		<div class="col-md-4" style="text-align:center;">
		<a href = "#" >
			<img alt="Quản Lí Năm Học " src={{ asset('img\qln.jpg') }} class="img-rounded" style="width:150px;height:150px;border:0;"  />
			</a>
				<h2> Quản Lí Năm Học </h2>		
		</div>
		<div class="col-md-4" style="text-align:center;">
		<a href = {{route('pdt.QLSV')}} >
			<img alt="Quản Lý Sinh Viên " src={{ asset('img\qlsv.jpg') }} class="img-rounded" style="width:150px;height:150px;border:0;" />
			</a>
			<h2> Quản Lý Sinh Viên </h2>
		</div>
		<div class="col-md-4" style="text-align:center;">
		<a href = "#" >
			<img alt="Quản Lý Môn Học " src={{ asset('img\qlmh.jpg') }} class="img-rounded" style="width:150px;height:150px;border:0;" />
			</a>
			<h2> Quản Lý Môn Học </h2>
		</div>
	</div>
	<div class="row" style="margin-left: 0%">
	<a href = {{ route('pdt.QL_LMH')}} >
		<div class="col-md-4" style="text-align:center;">
			<img alt="Quản Lý Lớp Môn Học" src={{ asset('img\qllmh.jpg') }} class="img-rounded" style="width:150px;height:150px;border:0;" />
			</a>
			<h2>Quản Lý Lớp Môn Học</h2>
		</div>
	</div>
</div>
@endsection