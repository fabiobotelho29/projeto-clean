<?php $v->layout(VIEWS_THEME_FRONT_FILE); ?>
<?php include('header.php'); ?>
<div id="active-page" title="store"></div>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb__text">
					<h4>Finalizar Compra</h4>
					<div class="breadcrumb__links">
						<a href="<?= url(); ?>">Início</a>
						<a href="<?= url("/loja"); ?>">Loja</a>
						<span>Finalizar Compra</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
	<div class="container">
		<div class="checkout__form">
			<form action="#">
				<div class="row">
					<div class="col-lg-8 col-md-6">

						<h6 class="checkout__title">Detalhes do Comprador</h6>
						<div class="row">
							<div class="col-lg-6">
								<div class="checkout__input">
									<p>Primeiro Nome<span>*</span></p>
									<input type="text">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="checkout__input">
									<p>Sobrenome<span>*</span></p>
									<input type="text">
								</div>
							</div>
						</div>
						<div class="row" style="margin-bottom: 25px;">
							<div class="col-lg-12">
								<div class="checkout__input">
									<p>Endereço para entrega<span>*</span></p>
									<select class="checkout__input" style="display: flex; width: 100%" name="" id="">
										<option value="">Rua Rafael de Aguiar Lorem </option>
										<option value="">Rua Rafael de Aguiar</option>
										<option value="">Rua Rafael de Aguiar</option>
										<option value="">Rua Rafael de Aguiar</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="checkout__input">
									<p>Telefone<span>*</span></p>
									<input type="text">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="checkout__input">
									<p>Email<span>*</span></p>
									<input type="text">
								</div>
							</div>
						</div>
						
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="checkout__order">
							<h4 class="order__title">Seu Pedido</h4>
							<div class="checkout__order__products">Produto <span>Total</span></div>
							<ul class="checkout__total__products">
								<li>01. Vanilla salted caramel <span>$ 300.0</span></li>
								<li>02. German chocolate <span>$ 170.0</span></li>
								<li>03. Sweet autumn <span>$ 170.0</span></li>
								<li>04. Cluten free mini dozen <span>$ 110.0</span></li>
							</ul>
							<ul class="checkout__total__all">
								<li>Subtotal <span>$750.99</span></li>
								<li>Total <span>$750.99</span></li>
							</ul>
							
							<p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
								ut labore et dolore magna aliqua.</p>
							
							<button type="submit" class="site-btn">ENVIAR PEDIDO</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- Checkout Section End -->

<?php include 'footer.php'; ?>

<?php include 'search.php'; ?>