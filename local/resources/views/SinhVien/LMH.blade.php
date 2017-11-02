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
		</div>
	</div>
</div>
<script type="text/javascript">

        $(document).ready(function () {
            // Create jqxTree
            var tree = $('#treeview');
            var source = null;
            $.ajax({
                async: false,
                url:'LMH/hocky',
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
                    $('#detail').show();
                    var url = item.id.split('-')[2];
            		$.ajax({
	                    url: "LMH/lmh/" + url,
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
                        url: "LMH/hocky/" + loaderItem.value,
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