@extends('layouts.app')

@section('content')
    <div class="container-fluid">
	<div class="col-md-2">
	</div>
	<div class="col-md-8">
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
			<table style="margin-top:20px">
				<tbody id="tbLMH">
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-2">
	</div>
</div>
<script type="text/javascript">
	function search_data(data){
		$.ajax({
            url: "LMH/search/" + data,
            type: "POST",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data, status, xhr){
				let arr = jQuery.parseJSON(data);
				console.log(arr);
				let count = 0;
				$('#tbLMH').html('');
				for(temp in arr){
					let score;
					if(arr[temp]['score'])
						score = "Chưa có điểm";
					else score = "Đã có điểm";
					let subTitle = arr[temp]['Mã lớp môn học'] + " - " + arr[temp]['Tên lớp môn học'] + " - " + arr[temp]['Học kỳ'] + " - " + arr[temp]['Năm học']
					$('#tbLMH').append(`<tr>
											<td>
												<div class="form-group">
													<a class="" title="Môn này chưa có điểm">
														<span class="">` + subTitle + `</span>
														<br>
														<span class="">` +  + `</span>
													</a> 
												</div>
											</td>
										</tr>`);
				}
            }
       });
	}
    $(document).ready(function () {
		search_data('');
		$('#textSearch').keyup(function(){
			search_data(this.value);
		})
    });
</script>
@endsection