@extends('layouts.app')

@section('content')
<div id="add_sv" >	
	<div class="container-fluid">
		<div class="row">
			<div id="formAddSv" class="col-md-12" > 
			<div class= "container-fluid" style="margin-left: 1%">
				<div class="row" >
					<div class="col-md-10  col-md-offset-1">
						<h3 class="text-info " >
								Thêm sinh viên 
						<button id="btShow" onclick="showForm()" style="display: inline-block; border-radius: 20%">
							+
						</button>
						</h3>
						<div id="divAddSV">
							<div class="col-md-6">
								<h4> Thêm bằng Form:</h4>
								<form>
									<div class="row">
										<div class="col-md-3">						 
											<label for="Tên">
												<h5>Mã Sinh Viên:</h5>
											</label> 
									</div>
									<div class="col-md-9">
										<input class="form-control" type="text" id="name" name="Tên"/>							
									</div>
								</div>
									<div class="row">
										<div class="col-md-3">						 
											<label for="Tên">
												<h5>Họ Và Tên:</h5>
											</label> 
									</div>
									<div class="col-md-9">
										<input class="form-control" type="text" id="name" name="Tên"/>							
									</div>
								</div>
									<div class="row">
										<div class="col-md-3">						 
											<label for="Tên">
												<h5>Ngày sinh:</h5>
											</label> 
									</div>
									<div class="col-md-9">
										<input class="form-control" type="text" id="name" name="Tên"/>							
									</div>
								</div>
								<div class="row">
										<div class="col-md-3">						 
											<label for="Tên">
												<h5>Lớp:</h5>
											</label> 
									</div>
									<div class="col-md-9">
										<input class="form-control" type="text" id="name" name="Tên"/>							
									</div>
								</div>
								</form>
								<button id="btImportSV_LMH" type="button" class="btn btn btn-primary pull-right" style="margin-left: 10%">
									Cập Nhật
								</button>
							</div>

							<div class="col-md-6 " >			
								<h4> Thêm bằng File:</h4>
								<div class="row">
									<div class="col-md-3">
										<label for ="fileSV"> <h5>Chọn File: </h5> </label>
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
									Cập Nhật
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row"  style="padding-top: 10px">
					<div class="col-md-10 col-md-offset-1">
						<div class="row col-md-12">
							<div id="custom-search-input">
								<div class="input-group col-md-12">
									<input maxlength ="40" type="textSearch" id="textSearch" class="form-control input-lg" placeholder="Search" />
									<span class="input-group-btn">
										<button class="btn btn-info btn-lg" type="button">
											<i class="glyphicon glyphicon-search"></i>
										</button>
									</span>
								</div>
							</div>
							<table class="table col-md-12" style="margin-top:20px" border="3">
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
								<tbody id="tbSV">
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-1">
					</div>
					<!--<div class="col-md-12">
						<table class="table" border="5">
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
					</div>-->
				</div>	
			</div>
		</div>	
	</div>
</div>
<script type="text/javascript">
	var show = 0;
	$(document).ready(function(){
		$('#divAddSV').hide(); 
	})
	function showForm() {
		if(!show){
			$('#divAddSV').show();
			show = 1;
		}
		else{ 
			$('#divAddSV').hide();
			show = 0;
		}
	}
</script>			   
@endsection