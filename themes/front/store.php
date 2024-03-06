<?php $v->layout(VIEWS_THEME_FRONT_FILE); ?>
<?php include('header.php'); ?>
<div id="active-page" title="home"></div>


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb__text">
					<h4>Loja</h4>
					<div class="breadcrumb__links">
						<a href="<?= url(); ?>">Início</a>
						<span>Loja</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="shop__sidebar">
					<div class="shop__sidebar__search">
						<form action="#">
							<input type="text" placeholder="Search...">
							<button type="submit"><span class="icon_search"></span></button>
						</form>
					</div>
					<div class="shop__sidebar__accordion">
						<div class="accordion" id="accordionExample">
							<div class="card">
								<div class="card-heading">
									<a data-toggle="collapse" data-target="#collapseOne">Categorias</a>
								</div>
								<div id="collapseOne" class="collapse show" data-parent="#accordionExample">
									<div class="card-body">
										<div class="shop__sidebar__categories">
											<ul class="nice-scroll">
												<li><a href="#">Men (20)</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-heading">
									<a data-toggle="collapse" data-target="#collapseThree">Faixa de Preço</a>
								</div>
								<div id="collapseThree" class="collapse show" data-parent="#accordionExample">
									<div class="card-body">
										<div class="shop__sidebar__price">
											<ul>
												<li><a href="#">$0.00 - $50.00</a></li>
												<li><a href="#">$50.00 - $100.00</a></li>
												<li><a href="#">$100.00 - $150.00</a></li>
												<li><a href="#">$150.00 - $200.00</a></li>
												<li><a href="#">$200.00 - $250.00</a></li>
												<li><a href="#">250.00+</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-heading">
									<a data-toggle="collapse" data-target="#collapseFour">Tamanho</a>
								</div>
								<div id="collapseFour" class="collapse show" data-parent="#accordionExample">
									<div class="card-body">
										<div class="shop__sidebar__size">
											<label for="xs">xs
												<input type="radio" id="xs">
											</label>
											<label for="sm">s
												<input type="radio" id="sm">
											</label>
											<label for="md">m
												<input type="radio" id="md">
											</label>
											<label for="xl">xl
												<input type="radio" id="xl">
											</label>
											<label for="2xl">2xl
												<input type="radio" id="2xl">
											</label>
											<label for="xxl">xxl
												<input type="radio" id="xxl">
											</label>
											<label for="3xl">3xl
												<input type="radio" id="3xl">
											</label>
											<label for="4xl">4xl
												<input type="radio" id="4xl">
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-heading">
									<a data-toggle="collapse" data-target="#collapseFive">Cores</a>
								</div>
								<div id="collapseFive" class="collapse show" data-parent="#accordionExample">
									<div class="card-body">
										<div class="shop__sidebar__color">
											<label class="c-1" for="sp-1">
												<input type="radio" id="sp-1">
											</label>
											<label class="c-2" for="sp-2">
												<input type="radio" id="sp-2">
											</label>
											<label class="c-3" for="sp-3">
												<input type="radio" id="sp-3">
											</label>
											<label class="c-4" for="sp-4">
												<input type="radio" id="sp-4">
											</label>
											<label class="c-5" for="sp-5">
												<input type="radio" id="sp-5">
											</label>
											<label class="c-6" for="sp-6">
												<input type="radio" id="sp-6">
											</label>
											<label class="c-7" for="sp-7">
												<input type="radio" id="sp-7">
											</label>
											<label class="c-8" for="sp-8">
												<input type="radio" id="sp-8">
											</label>
											<label class="c-9" for="sp-9">
												<input type="radio" id="sp-9">
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-heading">
									<a data-toggle="collapse" data-target="#collapseSix">Palavra Chave</a>
								</div>
								<div id="collapseSix" class="collapse show" data-parent="#accordionExample">
									<div class="card-body">
										<div class="shop__sidebar__tags">
											<a href="#">Product</a>
											<a href="#">Bags</a>
											<a href="#">Shoes</a>
											<a href="#">Fashio</a>
											<a href="#">Clothing</a>
											<a href="#">Hats</a>
											<a href="#">Accessories</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-9">
				<div class="shop__product__option">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="shop__product__option__left">
								<p>Mostrando 1–12 of 126 resultados</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<?php for ($i = 0; $i <= 12; $i++) : ?>						
							<div class="col-lg-4 col-md-6 col-sm-6">
								<div class="product__item" onclick="teste('<?= url("/produto/sdafs"); ?>')">
									<div class="product__item__pic set-bg" data-setbg="<?= views_theme("front", "img/product/product-" . rand(1, 14) . ".jpg"); ?>">
										<ul class="product__hover">
											<li><a href="#"><img src="<?= views_theme("front", "/img/icon/heart.png"); ?>" alt=""></a></li>
											<li><a href="#"><img src="<?= views_theme("front", "/img/icon/compare.png"); ?>" alt=""> <span>Compare</span></a>
											</li>
											<li><a href="#"><img src="<?= views_theme("front", "/img/icon/search.png"); ?>" alt=""></a></li>
										</ul>
									</div>
									<div class="product__item__text">
										<h6>Piqué Biker Jacket</h6>
										<a href="#" class="add-cart">+ Add To Cart</a>
										<div class="rating">
											<i class="fa fa-star-o"></i>
											<i class="fa fa-star-o"></i>
											<i class="fa fa-star-o"></i>
											<i class="fa fa-star-o"></i>
											<i class="fa fa-star-o"></i>
										</div>
										<h5>$67.24</h5>
										<div class="product__color__select">
											<label for="pc-4">
												<input type="radio" id="pc-4">
											</label>
											<label class="active black" for="pc-5">
												<input type="radio" id="pc-5">
											</label>
											<label class="grey" for="pc-6">
												<input type="radio" id="pc-6">
											</label>
										</div>
									</div>
								</div>
							</div>
					<?php endfor; ?>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="product__pagination">
							<a class="active" href="#">1</a>
							<a href="#">2</a>
							<a href="#">3</a>
							<span>...</span>
							<a href="#">21</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Shop Section End -->

<?php include 'footer.php'; ?>

<?php include 'search.php'; ?>

<script>
	const teste = (url) => {

		window.location = url
	}
</script>