@extends('layouts.app')

@section('content')
<div id="add_sv" >	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3" style="border:1px inset; border-radius:10px">
			<h1> Tree</h1>
			</div>
			<div id="formAddSv" class="col-md-9" style="border:1px outset; border-radius:10px"> 
			<div class= "container-fluid" style="margin-left: 1%">
				<div class="row" >
					<div class="row">
						<div class="col-md-12">
							<h2 class="text-info " >
									Thêm sinh viên 
							</h2>
							<div class="col-md-6">
								<h3> Thêm bằng Form:</h3>
								<form>
									<div class="row">
										<div class="col-md-3">						 
											<label for="Tên">
												<h4>Mã Sinh Viên:</h4>
											</label> 
									</div>
									<div class="col-md-9">
										<input class="form-control" type="text" id="name" name="Tên"/>							
									</div>
								</div>
									<div class="row">
										<div class="col-md-3">						 
											<label for="Tên">
												<h4>Họ Và Tên:</h4>
											</label> 
									</div>
									<div class="col-md-9">
										<input class="form-control" type="text" id="name" name="Tên"/>							
									</div>
								</div>
									<div class="row">
										<div class="col-md-3">						 
											<label for="Tên">
												<h4>Ngày sinh:</h4>
											</label> 
									</div>
									<div class="col-md-9">
										<input class="form-control" type="text" id="name" name="Tên"/>							
									</div>
								</div>
								<div class="row">
										<div class="col-md-3">						 
											<label for="Tên">
												<h4>Lớp:</h4>
											</label> 
									</div>
									<div class="col-md-9">
										<input class="form-control" type="text" id="name" name="Tên"/>							
									</div>
								</div>
								</form>
								<button id="btImportSV_LMH" type="button" class="btn btn btn-primary pull-right" style="margin-left: 10%">
									Cập Nhập
								</button>
							</div>

							<div class="col-md-6 " >			
								<h3> Thêm bằng File:</h3>
								<div class="row">
									<div class="col-md-3">
										<label for ="fileSV"> <h4>Chọn File: </h4> </label>
									</div>
									<div class="col-md-9">
									<h5>
										<form action="" id="formImportSV_LMH" role="form" enctype="multipart/form-data" method="POST">
											<input  class="form-group" id="fileSV" type="file" name="fileSV" required="true">									
										</form>
									</h5>
										<p id="pImportSV"> </p>
									</div>
								</div>
								<button id="btImportSV_LMH" type="button" class="btn btn btn-primary pull-right" style="margin-right: 10%">
									Cập Nhập
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group has-feedback" style="margin-left: 70%">
					    <input type="text" class="form-control" id="inputSuccess2"/>
					    <span class="glyphicon glyphicon-search form-control-feedback"></span>
					</div>
					<div class="col-md-12">
						<table class="table" border="5">
							<thead>
								<tr>
									<th>
										STT
									</th>
									<th>
										Mã Sinh Viên
									</th>
									<th>
										Họ Và Tên
									</th>
									<th>
										Ngày Sinh
									</th>
									<th>
										Lớp
									</th>
									<th>
										Kích Hoạt
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										1
									</td>
									<td>
										15000000
									</td>
									<td>
										Fuck Gâu
									</td>
									<td>
										Fuck Gâu
									</td>
									<td>
										Fuck Gâu
									</td>
									<td>
										<div class="checkbox" style="margin-top: 0%">
											<label>
												<input type="checkbox" /> Kích hoạt
											</label>
										</div> 
									</td>
								</tr>
								<tr class="active">
									<td>
									</td>
									<td>
									</td>
									<td>
									</td>
									<td>
									</td>
									<td>
									</td>
									<td>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>	
	</div>
</div>			   
@endsection