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
		</div>
		<div class="col-md-9">
			<!--<div id="detail" style="display: none">
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
			-->
			<div id="hocKy" style="padding-top: 5%; display: none">
				<div id="custom-search-input">
					<div class="input-group col-md-12">
						<input type="textSearch" id="textSearch" class="form-control input" onkeyup="" placeholder="Search" />
						<span class="input-group-btn">
							<button class="btn btn-info btn" type="button">
								<i class="glyphicon glyphicon-search"></i>
							</button>
						</span>
					</div>
				</div>
				<div style="margin-top: 15px">
					<table class="col-md-12" border="3">
						<tbody id="tbLMH">
						</tbody>
					</table>
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
            		$('#hocKy').show();
					search_data('');
                } else $('#hocKy').hide();
				
            });

			$("#textSearch").keyup(function(){
				search_data(this.value);
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

	function addFile(lopmonhoc_id){
        let file = $('#filePdf' + lopmonhoc_id).get()[0].files[0];
        let fileUpload = $('#filePdf' + lopmonhoc_id).val();
        if(!file){
            alert("Vui lòng chọn file");
            return;
            }
            if (fileUpload && (fileUpload.indexOf('pdf') === -1)) {
                alert("Vui lòng chọn file PDF");
                return;
            }
            $.ajax({
                url: "QL_LMH/addPdf/" + lopmonhoc_id,
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: new FormData($('#formAddFile'+ lopmonhoc_id)[0]),
                processData: false,
                contentType: false,
                success: function(data, status, xhr){
                    $('#formAddFile'+ lopmonhoc_id)[0].reset();
                    alert(data);
                }
            });
        return;
    }

	function search_data(data){
		let hocky_id = $('#treeview').jqxTree('getSelectedItem').id.split("-")[1];
		$.ajax({
            url: "QL_LMH/search/" + hocky_id + "/" + data,
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
					let subTitle = arr[temp]['Mã lớp môn học'] + " - " + arr[temp]['Tên lớp môn học'];
					$('#tbLMH').append(`
						<tr class='element-of-table-result'>
							<td class="col-md-12">
								<div class="row">
									<div class="form-group">
										<a ` + linkFile + ` class="` + aClass + `" title="`+ title +`"style="cursor:pointer;">
											<span class="">` + subTitle + `</span>
											<br>
											<span class="">` + score + `</span>
										</a> 
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<label> Cập nhật điểm:</label>
									</div>
									<div class="col-md-7">
										<form id="formAddFile`+arr[temp]['id']+`" action="" enctype="multipart/form-data" method="POST">
											<input id="filePdf`+arr[temp]['id']+`" class="form-group" type="file" name="filePdf" required="true">
										</form>
										<button id="btAddFile" onclick="addFile(`+arr[temp]['id']+`)" type="button" class="btn btn btn-primary pull-right" style="margin-right: 20%">
											Cập nhật
										</button>
									</div>
								</div>
							</td>
						</tr>
					`);
				}
            }
       });
	}
</script>
<style type="text/css">
	.element-of-table-result td > div > div{
		padding-top: 7px;
		padding-left: 7px; 
		margin-bottom: 7px!important;
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