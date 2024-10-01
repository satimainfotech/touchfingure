<!-- product listing -->

     

      <section class="process-news">
        <div class="container">
          <div class="container">
            <div class="row">
              <div class="col-sm-3 col-md-3">
                <div
                  class="panel-box-new accordion-menu glyphicon-icon-rpad"
                  id="accordion"
                >
				<?php foreach($brand_data as $brand){ ?>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <span class=""> <?php echo $brand['brand_name']; ?> </span>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse">
                      <div class="panel-body">
                        <ul
                          class="nav flex-column nav-pills"
                          id="nav-tab"
                          role="tablist"
                        >
						<?php foreach($category_data as $row_cs){ ?>
                          <li>
                            <a
                              id="nav-articles-tab"
                              data-toggle="tab"
                              href="#articles"
                              role="tab"
                              aria-controls="articles"
                              aria-selected="true"
                              ><?php echo $row_cs['category_name']; ?></a
                            >
                          </li>
						<?php } ?>
					
                         
                        </ul>
                      </div>
                    </div>
                  </div>
				  <?php } ?>
                  </div>
              </div>
              <div class="col-sm-9 col-md-9">
                <div class="tab-content" id="nav-tabContent">
                  <div
                    class="tab-pane fade show active"
                    id="articles"
                    role="tabpanel"
                    aria-labelledby="nav-articles-tab"
                  >
                    <div class="row justify-content-center" id="set_product_data">
					<?php foreach($all_product as $row){ 
				$main_title = $row['product_name'];
				$final_main_title = str_replace(' ', '-', strtolower($main_title));
				
				$final_main_title2 = str_replace('_', '-', strtolower($final_main_title));
				?>
				
				
				
				
                      <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="post-box masonry-post post-item">
                          <div class="post-inner">
                            <div class="entry-media post-cat-abs">
                              <a href="<?php echo base_url(); ?>our_range/product_details/<?php echo $row['product_id']; ?>/<?php echo $final_main_title2; ?>">
                                <img
                                  src="<?php echo base_url(); ?>uploads/product_image/<?php echo $row['main_product_image']; ?>"
                                  alt=""
                              /></a>
                              <div class="post-cat">
                              
                              </div>
                            </div>
                            <div class="inner-post">
                              <div class="entry-header">
                                <div class="entry-meta">
                                  <span class="posted-on"
                                    ><a href="product-nexa-sf_4058.html"
                                      >Nexa</a
                                    ></span
                                  >
                                </div>

                                <h5 class="entry-title">
                                  <a
                                    class="title-link"
                                    href="product-nexa-sf_4058.html"
                                    ><?php echo $row['product_name']; ?></a
                                  >
                                </h5>
                              </div>
                             
                            </div>
                          </div>
                        </div>
                      </div>
					<?php } ?>
                    </div>
					<div class="row my-5" id="load_more_id">
							<div class="col-md-12 text-center">
							<input type="hidden" value="<?php echo current_url(); ?>" id="current_url">
						<input type="hidden" value="<?php echo base_url(); ?>" id="base_url">
								<?php if($total_pages > 1){ ?>
									<input type="hidden" class="next_page" id="next_page_<?php echo @$next_page; ?>" value="<?php echo @$next_page; ?>">
									<span class="btn btnRedOutline octf-btn" onclick="load_next_page();">LOAD MORE PRODUCTS</span>
								<?php } ?>
							</div>
						</div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

<?php /* ?>
<section>
	<div class="container posRel">
		<div class="row pt-5 pb-4">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="redTitle">
					<h1>List of Products </h1>
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<form class="filterForm">
					<div class="row">
						<input type="hidden" value="<?php echo current_url(); ?>" id="current_url">
						<input type="hidden" value="<?php echo base_url(); ?>" id="base_url">
						<div class="form-group col-xl-8 col-lg-8 col-md-12 offset-lg-4">
							<label for="sel1">FILTER BY:</label>
							<select class="form-control" id="sel1" name="sellist1" onchange="filter_category(this.value);">
								<option >Category</option>
								<?php if(@$category != ''){?>
									<option value="" style="color:#fff;background-color:#f00">Clear Filter</option>
								<?php } ?>
								<?php foreach($category_data as $row_c){ ?>
									<option value="<?php echo $row_c['category_id']; ?>" <?php if(@$category == $row_c['category_id']){ echo 'selected'; }?>><?php echo $row_c['category_name']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row" id="set_product_data">
			<?php foreach($all_product as $row){ 
				$main_title = $row['product_name'];
				$final_main_title = str_replace(' ', '-', strtolower($main_title));
				
				$final_main_title2 = str_replace('_', '-', strtolower($final_main_title));
				?>
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
					<div class="listWrapper">
						<img src="<?php echo base_url(); ?>uploads/product_image/<?php echo $row['main_product_image']; ?>" class="img-fluid">
						<h4 class="texture_name">
							<input class="product_textures" type="checkbox"> <label for="5943"><?php echo $row['product_name']; ?></label>
						</h4>
						<a href="<?php echo base_url(); ?>our_range/product_details/<?php echo $row['product_id']; ?>/<?php echo $final_main_title2; ?>"><img src="<?php echo base_url(); ?>uploads/images/arrow-right.png" class="ml-2 icn"></a>
						<a class="listingOverlay">
							<i class="fas fa-heart"></i>
						</a>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="row my-5" id="load_more_id">
			<div class="col-md-12 text-center">
				<?php if($total_pages > 1){ ?>
					<input type="hidden" class="next_page" id="next_page_<?php echo @$next_page; ?>" value="<?php echo @$next_page; ?>">
					<span class="btn btnRedOutline" onclick="load_next_page();">LOAD MORE PRODUCTS</span>
				<?php } ?>
			</div>
		</div>
	</div>
</section><?php */ ?>
<script>
	function filter_category(cat_id){
		var href = $('#current_url').val();
		if(href.indexOf("index.php")){
		   var urls = href.replace( "index.php/", "" );
		} 
		if(cat_id == ''){
			window.location.href = urls;
		}else{
			window.location.href = urls+"?category="+cat_id;
		}
		
	}
	function load_next_page(){
		var filter_category = "<?php echo @$category; ?>";
		var range_id = "<?php echo @$range_id; ?>";
		var next_page_number = $('.next_page').val();
		if(next_page_number == ''){
			
		}else{
			var base_url = $('#base_url').val();	
			$.ajax({
				url : base_url+'our_range/product_load',
				type: 'POST',
				dataType: 'html',
				data: {next_page_number:next_page_number,filter_category:filter_category,range_id:range_id},
				success: function(data){
					if(data == ''){
						load_more_id
						$('#load_more_id').remove();
					}else{
						$('#set_product_data').append(data);
						$('#next_page_'+next_page_number).remove();
					}
					
				}
			});
		}
	}
</script> 