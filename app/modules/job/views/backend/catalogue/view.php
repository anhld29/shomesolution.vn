<div id="page-wrapper" class="gray-bg dashbard-1">

	<div class="row border-bottom">

		<?php $this->load->view('dashboard/backend/common/navbar'); ?>

	</div>

	<div class="row wrapper border-bottom white-bg page-heading">

		<div class="col-lg-10">

			<h2>Quản lý danh mục bài viết</h2>

			<ol class="breadcrumb">

				<li>

					<a href="<?php echo site_url('admin'); ?>">Home</a>

				</li>

				<li class="active"><strong>Quản lý danh mục bài viết</strong></li>

			</ol>

		</div>

	</div>

	<div class="wrapper wrapper-content animated fadeInRight">

		<div class="row">

			<div class="col-lg-12">

				<div class="ibox float-e-margins">

					<div class="ibox-title">

						<h5>Danh sách danh mục bài viết</h5>

						<div class="ibox-tools">

							<a class="collapse-link">

								<i class="fa fa-chevron-up"></i>

							</a>

							<a class="dropdown-toggle" data-toggle="dropdown" href="#">

								<i class="fa fa-wrench"></i>

							</a>

							<ul class="dropdown-menu dropdown-job">

								<li><a type="button" class="ajax-delete-all" data-title="Lưu ý: Khi bạn xóa danh mục bài viết, toàn bộ bài viết trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="job_catalogue">Xóa tất cả</a>

								</li>

							</ul>

							<a class="close-link">

								<i class="fa fa-times"></i>

							</a>

						</div>

					</div>

					<div class="ibox-content" style="position:relative;">

						<div class="table-responsive">

							<div class="uk-flex uk-flex-middle uk-flex-space-between">

								<div class="perpage">

									<div class="uk-flex uk-flex-middle mb10 hidden">

										<?php echo form_dropdown('perpage', $this->configbie->data('perpage'), set_value('perpage',$this->input->get('perpage')) ,'class="form-control input-sm perpage filter"  data-url="'.site_url('job/backend/catalogue/view').'"'); ?>

									</div>

								</div>

								<div class="toolbox">

									<div class="uk-flex uk-flex-middle uk-flex-space-between">

										<div class="uk-search uk-flex uk-flex-middle mr10">

											<form class="uk-form" id="search">

												<input type="search" name="keyword"  class="keyword form-control input-sm filter" placeholder="Nhập từ khóa tìm kiếm ..." autocomplete="off" value="<?php echo $this->input->get('keyword'); ?>" >

											</form>

										</div>

										<div class="uk-button">

											<a href="<?php echo site_url('job/backend/catalogue/create'); ?>" class="btn btn-danger"><i class="fa fa-plus"></i> Thêm danh mục bài viết mới</a>

										</div>

									</div>

								</div>

							</div>

							<div class="uk-flex uk-flex-middle uk-flex-space-between">

								<div class="text-small mb10">Hiển thị từ <?php echo $from; ?> đến <?php echo $to ?> trên tổng số <?php echo $config['total_rows']; ?> bản ghi</div>

								<div class="text-small text-danger">*Sắp xếp Vị trí hiển thị theo quy tắc: Số lớn hơn được ưu tiên hiển thị trước. </div>

							</div>
							<?php
							$listIS = $this->Autoload_Model->_get_where(array(
								'select' => '*',
								'table' => 'general_is',
								'where' => array('module' => 'job_catalogue', 'publish' => 1),
							), TRUE);
							?>
							<table class="table table-striped table-bordered table-hover dataTables-example" >

								<thead>

									<tr>

										<th style="width:40px;">

											<input type="checkbox" id="checkbox-all">

											<label for="check-all" class="labelCheckAll"></label>

										</th>

										<th style="width:45px;">ID</th>

										<th>Tiêu đề</th>

										<th class="text-center">Vị trí</th>

										<th >Người tạo</th>

										<th >Ngày tạo</th>
										<?php if(is_array($listIS) && count($listIS) && isset($listIS)){?>
											<?php foreach ($listIS as $key=>$val){?>
												<th style="width:80px;" class="text-center"><?php echo $val['title']?></th>
											<?php }?>
										<?php }?>
										<th>Trạng thái</th>

										<th style="width:100px;" class="text-center">Thao tác</th>

									</tr>

								</thead>

								<tbody id="ajax-content" >

									<?php if(isset($listCatalogue) && is_array($listCatalogue) && count($listCatalogue)){ ?>

										<?php foreach($listCatalogue as $key => $val){

											$href = rewrite_url($val['canonical'], true, true);

											?>

										<?php 

											$count = $this->Autoload_Model->_condition(array(

												'module' => 'job',

												'select' => '`object`.`id`',

												'catalogueid' => $val['id'],

												'count' => TRUE

											));

										?>

											<tr class="gradeX" id="cat-<?php echo $val['id']; ?>">

												<td>

													<input type="checkbox" name="checkbox[]" value="<?php echo $val['id']; ?>" class="checkbox-item">

													<label for="" class="label-checkboxitem"></label>

												</td>

												<td><?php echo $val['id']; ?></td>

												<td>

													<a class="maintitle" style="<?php echo ($val['level'] == 1) ? 'font-weight:600;' : ''; ?>" href="<?php echo site_url('job/backend/job/view?cataloguesid='.$val['id'].'')?>" title=""><?php echo str_repeat('|----', (($val['level'] > 0)?($val['level'] - 1):0)).$val['title']; ?> (<?php echo $count; ?>)</a>

													<a href="<?php echo $href ?>" title="Lấy địa chỉ liên kết" onclick="prompt('Lấy địa chỉ liên kết','<?php echo $val['canonical'] ?>.html'); return false;"><img border="0" src="template/backend/img/link.png"></a>

												</td>

												<td>

													<?php echo form_input('order['.$val['id'].']', $val['order'], 'data-module="job_catalogue" data-id="'.$val['id'].'"  class="form-control sort-order" placeholder="Vị trí" style="width:50px;text-align:right;"');?>

												</td>

												<td><?php echo $val['user_created']; ?></td>

												<td><?php echo gettime($val['created'],'d/m/Y'); ?></td>
												<?php if (is_array($listIS) && count($listIS) && isset($listIS)) { ?>
													<?php foreach ($listIS as $keyIS => $valIS) { ?>
														<td class="">
															<div class="switch">
																<div class="onoffswitch">
																	<input type="checkbox" <?php echo ($val['' . $valIS['is'] . ''] == 1) ? 'checked=""' : ''; ?>
																		   class="onoffswitch-checkbox publish_frontend"
																		   data-module="job_catalogue"
																		   data-title="<?php echo $valIS['is'] ?>"
																		   data-id="<?php echo $val['id']; ?>"
																		   id="publish_<?php echo $valIS['is'] ?><?php echo $val['id']; ?>">
																	<label class="onoffswitch-label"
																		   for="publish_<?php echo $valIS['is'] ?><?php echo $val['id']; ?>">
																		<span class="onoffswitch-inner"></span>
																		<span class="onoffswitch-switch"></span>
																	</label>
																</div>
															</div>
														</td>
													<?php } ?>
												<?php } ?>
												<td>

													<div class="switch">

														<div class="onoffswitch">

															<input type="checkbox" <?php echo ($val['publish'] == 0) ? 'checked=""' : ''; ?> class="onoffswitch-checkbox publish" data-id="<?php echo $val['id']; ?>" id="publish-<?php echo $val['id']; ?>">

															<label class="onoffswitch-label" for="publish-<?php echo $val['id']; ?>">

																<span class="onoffswitch-inner"></span>

																<span class="onoffswitch-switch"></span>

															</label>

														</div>

													</div>

												</td>

												<td class="text-center">

													<a type="button" href="<?php echo site_url('job/backend/catalogue/update/'.$val['id'].'') ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>

													<a <?php echo ($val['rgt'] - $val['lft'] > 1) ? 'disabled="disabled" ': ''; ?> type="button" class="btn btn-danger <?php echo ($val['rgt'] - $val['lft'] > 1) ? '" ': 'ajax-delete'; ?>" data-title="Lưu ý: Khi bạn xóa danh mục, toàn bộ bài viết trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!" data-router="<?php echo $val['canonical']; ?>" data-id="<?php echo $val['id'] ?>" data-module="job_catalogue" data-child="1"><i class="fa fa-trash"></i></a>

												</td>

											</tr>

										<?php }}else{ ?>

											<tr>

												<td colspan="12"><small class="text-danger">Không có dữ liệu phù hợp</small></td>

											</tr>

										<?php } ?>

									</tbody>

								</table>

							</div>

							<div id="pagination">

								<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

							</div>

							<div class="loader"></div>

						</div>

					</div>

				</div>

			</div>

		</div>

		<?php $this->load->view('dashboard/backend/common/footer'); ?>

	</div>