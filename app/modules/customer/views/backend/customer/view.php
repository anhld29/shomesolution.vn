<div id="page-wrapper" class="gray-bg dashbard-1">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar'); ?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Quản lý khách hàng</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Quản lý khách hàng</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content  animated fadeInRight">
		<div class="row">
			<div class="col-sm-8" style="padding-left:0;padding-right:0;">
				<div class="ibox">
					<div class="ibox-title">
						<h5>Danh sách khách hàng</h5>
						<div class="ibox-tools">
							<a class="collapse-link">
								<i class="fa fa-chevron-up"></i>
							</a>
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="fa fa-wrench"></i>
							</a>
							<ul class="dropdown-menu dropdown-customer">
								<li><a type="button" class="ajax-group-delete" data-title="Lưu ý: Số thành viên bị xóa sẽ không thể truy cập vào hệ thống quản trị được nữa!" data-module="customer">Xóa tất cả</a>
								</li>
							</ul>
							<a class="close-link">
								<i class="fa fa-times"></i>
							</a>
						</div>
					</div>
					
					
					<div class="ibox-content">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">	
							<div class="uk-button hidden">
								<a href="<?php echo site_url('customer/backend/customer/create'); ?>" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Thêm khách hàng</a>
							</div>
							<form class="customer-filter" method="get" action="">
								<div class="uk-flex uk-flex-middle">
									<div class="wrap-select mr5 hidden">
										<select class="form-control filter" id="perpage" name="perpage">
											<option value="10">Chọn 10 bản ghi</option>
											<option value="20">Chọn 20 bản ghi</option>
											<option value="30">Chọn 30 bản ghi</option>
											<option value="40">Chọn 40 bản ghi</option>
											<option value="50">Chọn 50 bản ghi</option>
											<option value="60">Chọn 60 bản ghi</option>
										</select>
									</div>
									<div class="perpage cat-wrap">
										<div class="uk-flex uk-flex-middle mr10">
											<?php
											$dropdown = $this->Autoload_Model->_get_where(array('table' => 'customer_catalogue', 'select' => 'id, title,level', 'order_by' => 'id desc', 'where' => array('publish' => 0,)), true);
											if(isset($dropdown) && is_array($dropdown)){
												$temp = NULL;
												$temp[0] = '[Root]';
												foreach($dropdown as $key => $val){
													$temp[$val['id']] = str_repeat('|-----', (($val['level'] > 0)?($val['level'] - 1):0)).$val['title'];
												}
											}
											?>
											<?php echo form_dropdown('catalogueid', $temp, set_value('catalogueid',$this->input->get('catalogueid')) ,'class="form-control input-sm perpage select3 filter catalogueid" style="width:200px !important"'); ?>
										</div>
									</div>
									<div class="input-group">
										<input type="text" style="width:250px;" name="keyword" id="keyword" value="<?php echo $this->input->get('keyword'); ?>" placeholder="Bạn muốn tìm gì ?" class="input keyword filter form-control">
									</div>
								</div>
							</form>
						</div>
						<div class="clients-list">
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i> Danh sách khách hàng</a></li>
							</ul>
							<div class="tab-content" id="customerData">
								<div id="tab-1" class="tab-pane active" style="height: 100%">
									<div class="full-height-scroll">
										<div class="table-responsive">
                                            <div class="uk-flex uk-flex-middle uk-flex-space-between mt10">
                                                <div class="text-small">Hiển thị từ <?php echo $from; ?> đến <?php echo $to ?> trên tổng số <?php echo $config['total_rows']; ?> bản ghi</div>
                                                <div class="text-small text-danger">*Sắp xếp Vị trí hiển thị theo quy tắc: Số lớn hơn được ưu tiên hiển thị trước. </div>
                                            </div>
											<table class="table table-striped table-hover">
												<thead>
													<tr>
														<th>
															<input type="checkbox" id="checkbox-all">
															<label for="check-all" class="labelCheckAll"></label>
														</th>
														<th class="text-left">Họ tên</th>
														<th class="text-left">Email</th>
														<th class="text-left">Nhóm</th>
<!--														<th class="text-left">Xuất bản</th>-->
                                                        <!--<th class="text-left">Cửa hàng nổi bật</th>-->
														<th class="text-center">Thao tác</th>
													</tr>
												</thead>
												<tbody id="ajax-content">
													<?php if(isset($listCustomer) && is_array($listCustomer) && count($listCustomer)){ ?>
														<?php foreach($listCustomer as $key => $val){ ?>
															<tr style="cursor:pointer;" class="choose" data-info="<?php echo base64_encode(json_encode($val)); ?>" >
																<td style="width: 40px;">
																	<input type="checkbox" name="checkbox[]" value="<?php echo $val['id']; ?>" class="checkbox-item">
																	<div for="" class="label-checkboxitem"></div>
																</td>
																<td><a data-toggle="tab" href="#contact-1" class="client-link"><?php echo $val['fullname']; ?></a></td>
																<td class="client-email"> <i class="fa fa-envelope" style="margin-right:5px;"> </i><?php echo (!empty($val['email'])) ? $val['email'] : '-'; ?></td>
																<td class="client-group"><?php echo $val['catalogue_title'];?></td>
																<td class="hidden">
																	<div class="switch">
																		<div class="onoffswitch">
																				<input type="checkbox" <?php echo ($val['publish'] == 1) ? 'checked=""' : ''; ?> class="onoffswitch-checkbox publish" data-id="<?php echo $val['id']; ?>" id="publish-<?php echo $val['id']; ?>">
																			<label class="onoffswitch-label" for="publish-<?php echo $val['id']; ?>">
																				<span class="onoffswitch-inner"></span>
																				<span class="onoffswitch-switch"></span>
																			</label>
																		</div>
																	</div>
																</td>
																<?php /*<td class="hide">
																	<div class="switch">
																		<div class="onoffswitch">
																			<input type="checkbox" <?php echo ($val['ishome'] == 1) ? 'checked=""' : ''; ?> class="onoffswitch-checkbox publish_frontend" data-module="customer" data-title="ishome" data-id="<?php echo $val['id']; ?>" id="publish_frontend-<?php echo $val['id']; ?>">
																			<label class="onoffswitch-label" for="publish_frontend-<?php echo $val['id']; ?>">
																				<span class="onoffswitch-inner"></span>
																				<span class="onoffswitch-switch"></span>
																			</label>
																		</div>
																	</div>
																</td>*/?>
																<td class="client-status" style="text-align:center;">
																	<a  type="button" href="<?php echo site_url('customer/backend/customer/update/'.$val['id']); ?>"   class="btn btn-sm btn-primary btn-update"><i class="fa fa-edit"></i></a>
																	<a type="button" class="btn btn-sm btn-danger ajax-delete" data-title="Lưu ý: Khi bạn xóa thành viên, người này sẽ không thể truy cập vào hệ thống quản trị được nữa." data-id="<?php echo $val['id'] ?>" data-module="customer"><i class="fa fa-trash"></i></a>
																</td>
															</tr>
														<?php }}else{ ?>
															<tr>
																<td colspan="5">
																	<small class="text-danger">Không có dữ liệu phù hợp</small>
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
											</div>
											<div id="paginationList">
												<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4" style="padding-right:0;">
					<div class="ibox ">
						<div class="ibox-content">
							<div class="tab-content">
								<div id="contact-1" class="tab-pane active">
									<div class="row m-b-lg">
										<div class="col-lg-4 text-center">
											<div class="m-b-sm img-cover">
												<img alt="image" class="img-circle" id="image" src="template/not-found.png" style="width: 100px;height:100px;">
											</div>
										</div>
										<div class="col-lg-8">
											<h2 class="fullname">Noname</h2>
											<p class="catalogue-title">-</p>
										</div>
									</div>
									<div class="client-detail">
										<div class="full-height-scroll">
											<strong>Thông tin cá nhân</strong>
											<ul class="list-group clear-list">
												<li class="list-group-item fist-item">
													<span class="pull-right fullname"> - </span>
													Họ tên:
												</li>
												<li class="list-group-item">
													<span class="pull-right phone"> - </span>
													Số điện thoại:
												</li>
												<li class="list-group-item">
													<span class="pull-right email" > - </span>
													Email:
												</li>
												<li class="list-group-item hide">
													<span class="pull-right tencuahang"> - </span>
													Tên cửa hàng:
												</li>

												<li class="list-group-item">
													<span class="pull-right address"> - </span>
													<span class="">Địa chỉ:</span>
												</li>
												<li class="list-group-item">
													<span class="pull-right updated"> - </span>
													<span class="">Ngày đăng ký:</span>
												</li>
												<li class="list-group-item hide">
													<span class="">Link :</span>
													<span class="linkcuahang"> - </span>

												</li>

											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('dashboard/backend/common/footer'); ?>
	</div>
	