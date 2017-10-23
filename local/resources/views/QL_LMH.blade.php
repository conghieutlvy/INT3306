@extends('layouts.app')

@section('content')
    <div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<div class="row">
				<div class="col-md-12">
					<h3> Danh sách lớp môn học</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div id="treeview">
					</div>
					<p></p>
					
				</div>
			</div>
			<hr/>
			<!--
			<div class="row">
				<div class="col-md-12">
					<ul>
						<li>
							Lorem ipsum dolor sit amet
						</li>
					</ul>
					<ul class="pagination">
						<li>
							<a href="#">Prev</a>
						</li>
						<li>
							<a href="#">5</a>
						</li>
						<li>
							<a href="#">Next</a>
						</li>
					</ul>
				</div>
			</div>
			-->
		</div>
		<div id="detail" class="col-md-9">
			<div class="row">
				<div class="col-md-6">
					<h3 class="text-info text-left">
						Thông tin lớp môn học
					</h3>
					<div class="row">
						<div class="col-md-4">
							<label>
								Năm học:
							</label>
						</div>
						<div id="NH_LMH" class="col-md-8">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label>
								Học kỳ:
							</label>
						</div>
						<div id="HK_LMH" class="col-md-8">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label>
								Tên lớp môn học:
							</label>
						</div>
						<div id="TEN_LMH" class="col-md-8">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label>
								Mã lớp môn học:
							</label>
						</div>
						<div id="MA_LMH" class="col-md-8">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<h3 class="text-info text-left">
						Thông tin điểm
					</h3>
					<div class="row">
						<div class="col-md-4">
							<label>
								Trạng thái điểm:
							</label>
						</div>
						<div id="DIEM_LMH" class="col-md-8">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label> Cập nhật điểm:</label>
						</div>
						<div class="col-md-8">
							<form action="import" enctype="multipart/form-data" method="POST">
				                {{ csrf_field() }}
				                <input type="file" name="file" required="true">
				                <br/>
				                <button type="submit" class="btn btn btn-primary pull-right" style="margin-right: 10%">
									Cập nhật
								</button>
	            			</form>
	            		</div>
            		</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-info text-left">
							Thêm sinh viên vào lớp môn học:
					</h3>
					<div class="col-md-6">
						<h4> Thêm bằng Form:</h4>
						<form>
							
						</form>
					</div>
					<div class="col-md-6">
						<h4> Thêm bằng File:</h4>
						<div class="row">
							<div class="col-md-4">
								<label> Chọn File:</label>
							</div>
							<div class="col-md-8">
								<form action="import" enctype="multipart/form-data" method="POST">
					                {{ csrf_field() }}
					                <input type="file" name="file" required="true">
					                <br/>
					                <button type="submit" class="btn btn btn-primary pull-right" style="margin-right: 10%">
										Thêm
									</button>
		            			</form>
		            		</div>
	            		</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				<h3 class="text-info text-left">
					Thông tin sinh viên lớp môn học:
				</h3>
					<table class="table" border="5">
						<thead>
							<tr>
								<th width="5%">
									STT
								</th>
								<th width="15%">
									Mã sinh viên
								</th>
								<th with="50%">
									Tên sinh viên
								</th>
								<th width="30%">
									Lớp khóa học
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									1
								</td>
								<td>
									TB - Monthly
								</td>
								<td>
									01/04/2012
								</td>
								<td>
									Default
								</td>
							</tr>
							<tr class="active">
								<td>
									1
								</td>
								<td>
									TB - Monthly
								</td>
								<td>
									01/04/2012
								</td>
								<td>
									Approved
								</td>
							</tr>
						</tbody>
					</table> 
					
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$.ajax({
			url:'QL_LMH/hocky/namhoc_id/1',
			type: "POST",
			dataType: "json",
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			success:function(dataRespone){
				$('#treeview').treeview({
					data:dataRespone,
					levels:1,
				});
			}
		});

	});
	function expandNode(){
		$('#tree').treeview('getSelected', nodeId);

	}
</script>
@endsection