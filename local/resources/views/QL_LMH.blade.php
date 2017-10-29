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
		<div class="col-md-9">
			<div id="detail" style="display: none">
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
								<form id="formAddFile" action="" enctype="multipart/form-data" method="POST">
									<input id="filePdf"class="form-group" type="file" name="filePdf" required="true">
								</form>
								<button id="btAddFile" type="button" class="btn btn btn-primary pull-right" style="margin-right: 10%">
									Cập nhật
								</button>
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
									<label> Chọn File CSV: (Chỉ gồm mã sinh viên)</label>
								</div>
								<div class="col-md-8">
									<form action="" id="formImportSV_LMH" role="form" enctype="multipart/form-data" method="POST">
										<input  class="form-group" id="fileSV_LMH" type="file" name="fileSV_LMH" required="true">
										<div class="form-group">
											<div class="progress">
												<div id="prcImportSV_LMH" class="progress-bar progress-bar-success" role="progressbar" style="width:0%">0%</div>
											</div>
										</div>
										<button id="btImportSV_LMH" type="button" class="btn btn btn-primary pull-right" style="margin-right: 10%">
											Thêm
										</button>
									</form>
								</div>
							</div>
						</div>
						<div class="row" style="padding-top: 3%">
							<div id="msgImportSV_LMH" class="col-md-12">
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
									<th width="10%">
										Mã sinh viên
									</th>
									<th with="45%">
										Tên sinh viên
									</th>
									<th width="20%">
										Ngày sinh
									</th>
									<th width="20%">
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
			<div id="importSV_HK" style="padding-top: 3%;display: none">
				<div class="row">
					<div class="col-md-12">
						<h3 class="text-info text-left">
							Thêm sinh viên vào các lớp môn học (Học kỳ hiện tại):
						</h3>
					</div>
				</div>
				<div class="row" style="padding-top: 3%">
					<div class="col-md-3" style="padding-left: 3%">
						<label> Chọn File CSV: (Chỉ gồm mã sinh viên và mã lớp môn học)</label>
					</div>
					<div class="col-md-9">
						<form action="" id="formImportSV_HK" role="form" enctype="multipart/form-data" method="POST">
							<input  class="form-group" id="fileSV_HK" type="file" name="fileSV_HK" required="true">
							<div class="form-group">
								<div class="progress">
									<div id="prcImportSV_HK" class="progress-bar progress-bar-success" role="progressbar" style="width:0%">0%</div>
								</div>
                    		</div>
						</form>
						<button id="btImportSV_HK" type="button" class="btn btn btn-primary pull-right" style="margin-right: 10%">
							Thêm
						</button>
					</div>
				</div>
				<div class="row" style="padding-top: 3%">
					<div id="msgImportSV_HK" class="col-md-12">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

        $(document).ready(function () {
			$('#btImportSV_HK').click(function () {
                var hocky_id = tree.jqxTree('getSelectedItem').id.split("-")[1];
                var url = 'QL_LMH/importSV_HK/' + hocky_id;
				var data = importSV(url,'formImportSV_HK','fileSV_HK','prcImportSV_HK','msgImportSV_HK');

            });
            $('#btImportSV_LMH').click(function () {
                var lopmonhoc_id = tree.jqxTree('getSelectedItem').id.split("-")[2];
                var url = 'QL_LMH/importSV_LMH/' + lopmonhoc_id;
                importSV(url,'formImportSV_LMH','fileSV_LMH','prcImportSV_LMH','msgImportSV_LMH');
            });
        	/*$('#btImportSV').click(function(event){
                var file = $('#fileSV')[0].files[0];
                var fileUpload = $('#fileSV').val();
                if(!file){
                    alert("Vui lòng chọn file");
                    return;
                }
                if (fileUpload && (fileUpload.indexOf('csv') === -1)) {
                    alert("Vui lòng chọn file CSV");
                    return;
                }
                var data = new FormData($('#formImportSV')[0]);
                console.log(data);

                $.ajax({
                    url: "QL_LMH/importSV",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: new FormData($('#formImportSV')[0]),
                    processData: false,
                    contentType: false,
                    success: function(data, status, xhr){
                        $('#formImportSV')[0].reset();
                        alert(data);
                        //$('#pImportSV').html(data);
                    }

                });
                return;
    		})
    		*/
            $('#btAddFile').click(function(event){
                var file = $('#filePdf').get()[0].files[0];
                var fileUpload = $('#filePdf').val();
                if(!file){
                    alert("Vui lòng chọn file");
                    return;
                }
                if (fileUpload && (fileUpload.indexOf('pdf') === -1)) {
                    alert("Vui lòng chọn file PDF");
                    return;
                }
                var lopmonhoc_id = tree.jqxTree('getSelectedItem').id.split("-")[2];
                $.ajax({
                    url: "QL_LMH/addPdf/" + lopmonhoc_id,
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: new FormData($('#formAddFile')[0]),
                    processData: false,
                    contentType: false,
                    success: function(data, status, xhr){
                        $('#formAddFile')[0].reset();
                        alert(data);
                    }

                });
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
            	if(label.includes("Học kỳ")) {
            	    // Show & Clear data
                    $('#importSV_HK').show();
                    $('form').each(function( index ) {
                        $('form')[index].reset();
                    });
                    $('#pImportSV_HK').removeClass('alert-danger alert-success').empty();
                    $('#detail').hide();
                } else
				if(!label.includes("Học kỳ") && !label.includes("Năm học")){
                    // Show & Clear data
					$('#detail').show();
					$('form').each(function( index ) {
                        $('form')[index].reset();
                    });
                    $('#importSV_HK').hide();
            		var url = item.id.split('-')[2];
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
	                    		$('#tbbody').append("<tr>	<td>"+ (++count) +"</td><td>" + sinhviens[count-1]['username'] +"</td><td>"+ sinhviens[count-1]['Họ tên'] + "</td><td>"+ sinhviens[count-1]['Ngày sinh'] + "</td><td>"+ sinhviens[count-1]['Lớp khóa học'] + "</td>	</tr>");
	                    	};
	                    }
	                });
            	} else {
                    $('#detail').hide();
                    $('#importSV_HK').hide();
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
	function importSV(url,formId,fileId,processId, msgId){
        fileId = '#' + fileId;
        formId = '#' + formId;
        processId = '#' + processId;
        msgId = '#' + msgId;
        var file = $(fileId).get()[0].files[0];
        var fileUpload = $(fileId).val();
        if(!file){
            alert("Vui lòng chọn file");
            return;
        }
        if (fileUpload && (fileUpload.indexOf('csv') === -1)) {
            alert("Vui lòng chọn file CSV");
            return;
        }
        $.ajax({
            url: url,
            type: "POST",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: new FormData($(formId)[0]),
            processData: false,
            contentType: false,
            beforeSend: function(jqXHR, settings) {
                var self = this;
                var xhr = settings.xhr;
                settings.xhr = function() {
                    var output = xhr();
                    output.onreadystatechange = function() {
                        if (typeof(self.readyStateChanged) == "function") {
                            self.readyStateChanged(this);
                        }
                    };
                    return output;
                };
            },
            // listen to the readyStates
            readyStateChanged: function(jqXHR) {
                // if it's '3', then it's an update,
                if (jqXHR.readyState == 3) {
                    var responeTxt = jqXHR.responseText.split(',');
                    var responeleng = responeTxt[0];
                    var processnow = (responeTxt.length == 1)? 0  : responeTxt[responeTxt.length - 1];
                    var percent = Math.floor(processnow/responeleng*100);
                    // update an element with the last number the script output. The script output is contained in jqXHR.responseText.
                    $(processId).css('width',percent + '%');
                    $(processId).text(percent + "%");
                }
            },
            // handle an error
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            },
            success: function(data, status, xhr){
                $(formId)[0].reset();
                var obj =  jQuery.parseJSON(data.substr(data.indexOf("{")));
                /*if(!obj['status'][0]){
                    var stringFail = '';
                    $.each(obj['exists'], function ( index, value ) {
                   		stringFail += value + "<br/>";
					});
                    $('#pImportSV_HK').removeClass('alert-success alert-danger').addClass('text-left alert alert-warning');
                	$('#pImportSV_HK').html("Vui lòng xem lại các trường sau, chúng đã được thêm trước đó: <br/>" + stringFail);
                } else*/
                if(!obj['status'][1]){
                    var stringFail = '';
                    $.each(obj['fail'], function ( index, value ) {
                        stringFail += value + "<br/>";
                    });
                    $(msgId).html("<p class = \"text-left alert alert-danger\">Các trường sau bị sai, vui lòng xem lại dữ liệu: <br/>" + stringFail + "</p>");
				} else {
                    $(msgId).html("<p class = \"text-left alert alert-success\">Thêm Thành công!</p>");
				};
            }
		});
	};
</script>
@endsection