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
			<table class="table-result-sss col-md-12" style="margin-top:20px">
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
					let score,aClass,title,linkFile;

					if(!arr[temp]['score']){
						score = "Chưa có điểm";
						aClass = 'notLinkToFile';
						title = 'Môn này chưa có điểm';
					}
					else {
						score = "Đã có điểm";
						aClass = 'haveLinkToFile';
						title = 'Môn này đã có điểm';
						linkFile = "target='_blank' href='pdf/lmh/" + arr[temp]['id'] +"'";
					}
					let subTitle = arr[temp]['Mã lớp môn học'] + " - " + arr[temp]['Tên lớp môn học'] + " - " + arr[temp]['Học kỳ'] + " - " + arr[temp]['Năm học'];
					$('#tbLMH').append(`<tr class="element-of-table-result">
											<td class='col-md-12'>
												<div class="form-group">
													<a ` + linkFile + ` class="` + aClass + `" title="`+ title +`" style="cursor:pointer;">
														<span class="">` + subTitle + `</span>
														<br>
														<span class="">` + score + `</span>
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
<style type="text/css">
	.element-of-table-result td > div{
		padding-top: 7px;
		height: 65px; 
		margin-bottom: 7px!important;
		border-radius: 10px;
	}

	.notLinkToFile {
		font-size: 17px;
		color:gray;
	}
	.notLinkToFile:hover {
		font-size: 20px;
		color:gray;
	}

	.haveLinkToFile {
		font-size: 17px;
		color:blue;
	}
	.haveLinkToFile:hover {
		font-size: 20px;
		color:blue;
	}
</style>
@endsection