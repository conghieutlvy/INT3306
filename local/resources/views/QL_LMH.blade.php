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
							<form action="{{ route('importPdf') }}" enctype="multipart/form-data" method="POST">
				                {{ csrf_field() }}
				                <input type="file" name="filePdf" required="true">
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
								<label> Chọn File CSV:</label>
							</div>
							<div class="col-md-8">
								<form action="" id="formImportSV" role="form" enctype="multipart/form-data" method="POST">
					                {{ csrf_field() }}
					                <input  class="form-group" id="fileSV" type="file" name="fileSV" required="true">
									<button id="btImportSV" type="button" class="btn btn btn-primary pull-right" style="margin-right: 10%">
										Thêm
									</button>
		            			</form>

		            			<p id="pImportSV"> </p>
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
						<tbody id="tbbody">
							
						</tbody>
					</table> 
					
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

        $(document).ready(function () {
        	$('#btImportSV').click(function(event){
                var file = $('#fileSV').get()[0].files[0];
                var fileUpload = $('#fileSV').val();
                if(!file){
                    alert("Vui lòng chọn file");
                    return;
                }
                if (fileUpload && (fileUpload.indexOf('csv') === -1)) {
                    alert("Vui lòng chọn file CSV");
                    return;
                }
                $.ajax({
                    url: "QL_LMH/importSV",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: new FormData($('#formImportSV')[0]),
                    processData: false,
                    contentType: false,
                    success: function(data, status, xhr){
                        $('#formImportSV')[0].reset();
                        alert('Lỗi: ' + data);
                        $('#pImportSV').html(data);
                    }

                });
               /* var file_data = $('#fileSV').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
	    		$.ajax({
	    			//async: false,
	    			url: "QL_LMH/importSV",
	    			type: "POST",
	    			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
	    			data: form_data,
	    			success: function(data, status, xhr){
	    				$('#pImportSV').html(data + "Xong");
	    			}
	    		});*/
                return;
    		})


            // Create jqxTree
            var tree = $('#treeview');
            var source = null;
            $.ajax({
                async: false,
                url:'QL_LMH/hocky',
                type: "POST",
                //dataType: "json",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (data, status, xhr) {
                    source = jQuery.parseJSON(data);
                }
            });

            tree.jqxTree({ source: source});

            tree.on('select', function (event){
            	var item = tree.jqxTree('getSelectedItem', event.args.element);
            	var label = item.label;
            	if(!label.includes("Học kỳ") && !label.includes("Năm học")){
            		var value = item.value;
            		var arr = value.split("-");
            		var url = arr[arr.length - 1];
            		$.ajax({
	                    url: "QL_LMH/lmh/" + url,
	                    type: "POST",
	                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
	                    success: function (data, status, xhr) {
	                    	var obj = jQuery.parseJSON(data);
                            $('#NH_LMH').html(obj['thong tin']['Năm học']);
                            $('#HK_LMH').html(obj['thong tin']['Học kỳ']);
	                    	$('#MA_LMH').html(obj['thong tin']['Mã lớp môn học']);
                            $('#TEN_LMH').html(obj['thong tin']['Tên lớp môn học']);
                            $('#DIEM_LMH').html(obj['thong tin']['Trạng thái điểm']?"Đã có điểm":"Chưa có điểm");
	                    	var count = 0;
	                    	$('#tbbody').html('');
	                    	var sinhviens = obj['sinh vien'];
	                    	var len = sinhviens.length;
	                    	while(count < len){
	                    		$('#tbbody').append("<tr>	<td>"+ (count++ + 1) +"</td><td>" + sinhviens[count-1]['username'] +"</td><td>"+ sinhviens[count-1]['name'] + "</td><td>Default</td>	</tr>");
	                    	};
	                    }
	                });
            	}
            });
            tree.on('expand', function (event) {
                var label = tree.jqxTree('getItem', event.args.element).label;
                var $element = $(event.args.element);
                var loader = false;
                var loaderItem = null;
                var children = $element.find('ul:first').children();
                $.each(children, function () {
                    var item = tree.jqxTree('getItem', this);
                    if (item && item.label == 'Loading...') {
                        loaderItem = item;
                        loader = true;
                        return false
                    };
                });
                if (loader) {
                    $.ajax({
                        url: "QL_LMH/hocky/" + loaderItem.value,
                        type: "POST",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        success: function (data, status, xhr) {
                            var items = jQuery.parseJSON(data);
                            tree.jqxTree('addTo', items, $element[0]);
                            tree.jqxTree('removeItem', loaderItem.element);
                        }
                    });
                }
            });
            
        });
</script>
@endsection