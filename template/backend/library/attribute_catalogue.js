$(document).ready(function(){
	//===================album ảnh===================
	
	// Cập nhật trạng thái
	
	$(document).on('click','.pagination li a', function(){
		let _this = $(this);
		let page = _this.attr('data-ci-pagination-page');
		let view = $('.view').val();
		let keyword = $('.keyword').val();
		let perpage = $('.perpage').val();
		let object = {
			'view' : view,
			'keyword' : keyword,
			'perpage' : perpage,
			'page'    : page,
		}

        clearTimeout(time);
		if(keyword.length > 2){
			time = setTimeout(function(){
				get_list_object(object);
			},500);
		}else{
			time = setTimeout(function(){
				get_list_object(object);
			},500);
		}
		return false;
	});
	
	$(document).on('change','.publish',function(){
		let _this = $(this);
		let objectid = _this.attr('data-id');
		let formURL = 'article/ajax/catalogue/status';
			$.post(formURL, {
				objectid: objectid},
				function(data){
					
				});
	});
	var time;
	$(document).on('keyup change','.filter', function(){
		let view = $('.view').val();
		let keyword = $('.keyword').val();
		let perpage = $('.perpage').val();
		let object = {
			'view' : view,
			'keyword' : keyword,
			'perpage' : perpage,
			'page'    : 1,
		}
		keyword = keyword.trim();
		clearTimeout(time);
		if(keyword.length > 2){
			time = setTimeout(function(){
				get_list_object(object);
			},500);
		}else{
			time = setTimeout(function(){
				get_list_object(object);
			},500);
		}
	});
	
	
	
});

function get_list_object(param){
	let ajaxUrl = 'attribute/ajax/catalogue/listCatalogue';
	$.get(ajaxUrl, {
		perpage: param.perpage, view: param.view, keyword: param.keyword, page: param.page},
		function(data){
			let json = JSON.parse(data);
			$('#ajax-content').html(json.html);
			$('#pagination').html(json.pagination);
			$('#total_row').html(json.total_row);
		});
}
