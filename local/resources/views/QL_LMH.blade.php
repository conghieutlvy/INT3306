@extends('layouts.app')

@section('content')
    <div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
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
		</div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-6">
					<h3 class="text-info text-left">
						Thông tin lớp môn học
					</h3>
				</div>
				<div class="col-md-6">
					<h3 class="text-info text-left">
						Thông tin điểm
					</h3>
					<form action="import" enctype="multipart/form-data" method="POST">
	                {{ csrf_field() }}
	                <input type="file" name="filesTest" required="true">
	                <br/>
	                <input type="submit" value="Thêm">
            </form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				<h3 class="text-info text-left">
					Thông tin sinh viên lớp môn học
				</h3>
					<table class="table">
						<thead>
							<tr>
								<th>
									STT
								</th>
								<th>
									Mã sinh viên
								</th>
								<th>
									Tên sinh viên
								</th>
								<th>
									Lớp
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
					<a href="#" onclick="" class="btn btn-block btn-primary" type="button">Thêm</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
			$.ajax({
				url:'QL_LMH/tree',
				type: "POST",
				dataType: "json",
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				success:function(dataRespone){
					$('p').text("Call");
					$('#treeview').treeview({data:dataRespone});
				}
			});	
	});
</script>
@endsection